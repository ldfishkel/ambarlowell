<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Order;
use App\Model\Item;
use App\Model\Client;
use App\Models\Product;
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

    public function data()
    {
        $orders = Order::join('clients', 'orders.client_id', '=', 'clients.id')
            ->select(['orders.id', 'orders.type', 'clients.name', 'orders.status', 'orders.date']);

        return Datatables::of($orders)->make(true);
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
        
        foreach ($items as $item) {
            $product = Product::where('id', $item->product_id)->first();
            $data = [
                "product_id" => $product->id,
                "model" => $product->model,
                "amount" => $item->amount,
                "unit_price" => $item->unit_price,
            ];
            $total += $item->amount * $item->unit_price;
            $itemsResult[] = $data;
        }

        return view('order/order_view', [ "order" => $order, "client" => $client, "items" => $itemsResult, "total" => $total ]);
    }

    public function create()
    {
        $data = Input::all();
        AmbarLogger::log("order creation", [$data]);
        
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
            'type'      => $data["type"],
        ]);

        foreach ($items as $item)
            Item::create([
                'order_id'   => $order->id,
                'product_id' => $item["product_id"],
                'amount'     => $item["amount"],
                'unit_price' => $item["unit_price"],
            ]);
    }

    public function update()
    {
        $data = Input::all();
        AmbarLogger::log("order update", [$data]);
    }
}
