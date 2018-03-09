<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Requested;
use App\Model\Debt;
use App\Model\Balance;
use App\Model\Sale;
use App\Model\Order;
use App\Model\Item;
use App\Model\Client;
use App\Models\Product;
use App\Models\Stock;
use App\Logger\AmbarLogger;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('order/order');
    }

    public function pending()
    {
        $response = [];
        $data = Input::all();

        $start = $data["start"];
        $length = $data["length"];

        $orders = Order::where('status', 'Pending')->skip($start)->take($length)->get();

        foreach ($orders as $order) 
        {
            $client = Client::find($order->client_id);
            $row = [
                "id" => $order->id,
                "type" => $order->type,
                "date" => $order->date,
                "name" => $client->name,
                "fabricator" => $order->fabricator,
                "stock" => $this->enoughStock($order)
            ];
            $response[] = $row;
        }

        return Datatables::of($response)->make(true);
    }

    public function sold()
    {
         $orders = Order::join('clients', 'orders.client_id', '=', 'clients.id')->where('status', 'Sold')
            ->select(['orders.id', 'orders.type', 'clients.name', 'orders.date']);
        return Datatables::of($orders)->make(true);
    }

    public function cancelled()
    {
         $orders = Order::join('clients', 'orders.client_id', '=', 'clients.id')->where('status', 'Cancelled')
            ->select(['orders.id', 'orders.type', 'clients.name', 'orders.date']);
        return Datatables::of($orders)->make(true);
    }

    private function enoughStock($order) 
    {
        $items = Item::leftJoin("stock", "order_item.product_id", "stock.product_id")
                     ->where("order_id", $order->id)
                     ->groupBy(["product_id", "amount"])
                     ->select(["order_item.product_id", "order_item.amount", DB::raw("sum(stock.current) as current")])
                     ->get();

        foreach ($items as $item) 
        {
            if ($item->amount > $item->current)
                return false;
        }

        return true;
    }

    public function add()
    {
        return view('order/order_add');
    }

    public function view($id)
    {
        $order = Order::find($id);
        $client = Client::find($order->client_id);
        $itemsResult = [];
        $items = Item::where('order_id', $order->id)->get();
        $total = 0;
        
        foreach ($items as $item) 
        {
            $product = Product::where('id', $item->product_id)->first();
            $data = [
                "product_id" => $product->id,
                "model" => $product->model,
                "image" => $product->image,
                "amount" => $item->amount,
                "unit_price" => $item->unit_price,
                "comment" => $item->comment,
                "stock" => Stock::where('product_id', $product->id)->sum('current')
            ];
            $total += $item->amount * $item->unit_price;
            $itemsResult[] = $data;
        }

        return view('order/order_view', [ "order" => $order, "client" => $client, "items" => $itemsResult, "total" => $total ]);
    }

    public function create()
    {
        $data = Input::all();
        
        $client = $data["client"];
        $items = $data["items"];

        $clientId = null;
        
        if (!isset($client["client_id"])) {
            $client = Client::create([
                'name'      => isset($client["name"]) ? $client["name"] : "",
                'phone'     => isset($client["phone"]) ? $client["phone"] : "",
                'instagram' => isset($client["instagram"]) ? $client["instagram"] : "",
                'facebook'  => isset($client["facebook"])? $client["facebook"] : "", 
                'email'     => isset($client["email"]) ? $client["email"] : "",
                'address'   => isset($client["address"]) ? $client["address"] : "",
            ]);

            $clientId = $client->id;
        } else 
            $clientId = $client["client_id"];

        $order = Order::create([
            'client_id' => $clientId,
            'date'      => date('Y-m-d'),
            'status'    => 'Pending',
            'fabricator' => $data["fabricator"],
            'type'      => $data["type"],
        ]);


        foreach ($items as $item) 
        {     
            $comment = $item["comment"];
            if (!$comment || count($comment))
                $comment = ".";
            
            $newItem = Item::create([
                'order_id'   => $order->id,
                'product_id' => $item["product_id"],
                'amount'     => $item["amount"],
                'unit_price' => $item["unit_price"],
                'comment'    => $comment,
            ]);
            
            $currentStock = Stock::where('product_id', $newItem->product_id)->sum('current');
            
            if ($currentStock < $newItem->amount) {
                $amount = $newItem->amount - $currentStock;
                $requested = Requested::where('product_id', $newItem->product_id)->first(); 
                
                if ($requested) {
                    $requested->amount += $amount;
                    $requested->save();
                } else
                    Requested::create([
                        'product_id' => $newItem->product_id,
                        'amount' => $amount
                    ]);
            }
        }
    }

    public function comment() 
    {
        $data = Input::all();
        
        $item = Item::where("order_id", $data["order_id"])->where("product_id", $data["product_id"])->first();

        $comment = $item["comment"];
        if (!$comment || count($comment))
            $comment = ".";

        $item->comment = $comment;

        $item->save();
    }

    public function fabricator() 
    {
        $data = Input::all();
        
        $order = Order::find($data["order_id"]);

        $order->fabricator = $data["fabricator"];

        $order->save();
    }

    public function finished()
    {
        $data = Input::all();
        
        if (isset($data["id"]))
        {
            $item = Item::find($data["id"]);

            $item->finished = true;

            $item->save();

            if ($data["stock"] == true)
            {
                Stock::create([
                    'product_id'       => $item->product_id,
                    'initial'          => $item->amount,
                    'current'          => $item->amount,
                    'settlement'       => 90,
                    'entrance'         => date('Y-m-d'),
                ]);

                $requested = Requested::where('product_id', $item->product_id)->first(); 
                        
                if ($requested) {
                    if ($requested->amount > $item->amount)
                        $requested->amount -= $item->amount;
                    else
                        $requested->amount = 0;

                    $requested->save();
                }
            }
        }
    }

    public function status($id)
    {
        $data = Input::all();

        $order = Order::find($id);

        if ($data['status'] == 'Sold') 
            $this->soldOrder($order, $data);

        $order->status = $data['status'];

        $order->save();
    }

    private function soldOrder($order, $data) 
    {
        $items = Item::where('order_id', $order->id)->get();
        $amount = 0;

        foreach ($items as $item) 
        {
            $amount += $item->amount * $item->unit_price;

            $allStock = Stock::where('product_id', $item->product_id)
                          ->where('current', '>', 0)
                          ->orderBy('id', 'asc')
                          ->get();


            $amountToTake = $item->amount;
            
            foreach ($allStock as $stock) 
            {
                if ($stock->current < $amountToTake) {
                    $amountToTake -= $stock->current;
                    $stock->current = 0;
                    $stock->save();
                } else if ($stock->current >= $amountToTake) {
                    $stock->current -= $amountToTake;
                    $stock->save();
                    break;
                }          
            }
        }

        $sale = Sale::create([
            'order_id' => $order->id,
            'payment_type' => $data['payment_type'],
            'sale_type' => $order->type,
            'amount' => $amount,
            'date' => date('Y-m-d')
        ]);

        if ($data['payment_type'] == "Real") 
            Balance::create([
                'amount' => $amount,
                'concept' => $order->type . ' sale',
                'date' => date('Y-m-d'),
            ]);
        else if ($data['payment_type'] == "Virtual") 
            Debt::create([
                'client_id' => $order->client_id,
                'sale_id' => $sale->id,
                'amount' => $sale->amount,
                'concept' => $order->type . ' sale',
                'date' => date('Y-m-d'),
                'payed' => false
            ]);
        
    }
}
