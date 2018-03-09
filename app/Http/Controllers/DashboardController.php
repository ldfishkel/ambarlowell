<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Models\Stock;
use App\Model\Investment;
use App\Model\Requested;
use App\Model\Balance;
use App\Model\Credit;
use App\Model\Debt;
use App\Model\Order;
use App\Model\Item;
use App\Logger\AmbarLogger;

class DashboardController extends Controller
{
    public function index() {
    	
    	$adminUsers = array(
			"ldfishkel@gmail.com"
		);

		$fabricatorUsers = array(
			"pela@ambarlowell.com",
			"felix@ambarlowell.com"
		);
		
		$user = Auth::user();

		$isAdmin = $user ? in_array($user->email, $adminUsers) : false;
		$isFabricator = $user ? in_array($user->email, $fabricatorUsers) : false;

		$stock = [
			"different" => $this->different(),
			"units" => $this->units(),
			"requested" => $this->requested(),
			"settlement" => $this->settlement(),
			"withoutStock" => $this->withoutStock(),
			"entranceThisMonth" => $this->entranceThisMonth(),
		];

		if ($isAdmin) {
			$monthCosts = $this->monthCosts();
			$realBalance = $this->realBalance();
			$clientsDebts =  $this->clientsDebts();
			$suppliersDebts = $this->suppliersDebts();
			$lastMonthCosts = $this->lastMonthCosts();
			
			return view('welcome', [
				"isAdmin" => $isAdmin,
				"realBalance" => $realBalance,
				"monthCosts" => $monthCosts,
				"monthProfits" => $this->monthProfits($monthCosts),
				"suppliersDebts" => $suppliersDebts,
				"clientsDebts" => $clientsDebts,
				"virtualBalance" => $realBalance + $clientsDebts + $suppliersDebts,
				"lastMonthCosts" => $lastMonthCosts,
				"lastMonthProfits" => $this->lastMonthProfits($lastMonthCosts),
				"investments" => $this->investments(),
				"stock" => $stock 
			]);
			
		} 
		else if ($isFabricator) 
		{
			$orders = Order::where('fabricator', $user->name)->where('status', 'Pending')->get();
			$ordersResponse = [];
			
			foreach ($orders as $order) 
			{
				$itemsResponse = [];
				$items = Item::where('order_id', $order->id)->where('finished', false)->get();
				
				foreach ($items as $item) 
				{
					$product = Product::find($item->product_id);
					$itemsResponse[] = [
						'id' => $item->id,
						'product' => $product,
						'comment' => $item->comment,
						'amount' => $item->amount,
						'delayed' => $item->delayed
					];
				}

				$ordersResponse[] = [
					'order' => $order, 
					'items' => $itemsResponse
				];
			}

			return view('fabricator', [
				"orders" => $ordersResponse 
			]);
		} else 
			return view('welcome', [
				"isAdmin" => $isAdmin,
				"stock" => $stock 
			]);
    }

    public function investment() {
    	$data = Input::all();

    	Investment::create([
    		"amount" => $data["amount"],
    		"investor" => $data["investor"]
    	]);

    	Balance::create([
    		"amount" => $data["amount"],
    		"concept" => "investment",
    		"date" => date("Y-m-d")
    	]);
    }

    private function realBalance() {
    	return Balance::sum("amount");
    }

    private function monthProfits($monthCosts) {
    	$val = $monthCosts + Balance::where('concept', 'like', '%sale')
    								 ->whereMonth('date', '=', date('m'))
    								 ->sum("amount");
    	return ($val > 0) ? $val : 0;
    }

	private function monthCosts() {
		return Balance::where('concept', 'like', '%cost')
    								 ->whereMonth('date', '=', date('m'))
    								 ->sum("amount");
	}

	private function clientsDebts() {
		return Debt::where('payed', false)->sum('amount');
	}

	private function suppliersDebts() {
		return -Credit::where('payed', false)->sum('amount');
	}
	
	private function lastMonthProfits($lastMonthCosts) {
		$val = $lastMonthCosts + Balance::where('concept', 'like', '%sale')
    								 ->whereMonth('date', '=', date('m',strtotime("-1 month")))
    								 ->sum("amount");
    	return ($val > 0) ? $val : 0;
	}

	private function lastMonthCosts() {
		return Balance::where('concept', 'like', '%cost')
					 ->whereMonth('date', '=', date('m',strtotime("-1 month")))
					 ->sum("amount");
	}

	private function different() {
		return Product::count();
	}

	private function units() {
		return Stock::sum("current");
	}

	private function requested() {
		return Requested::sum("amount");	
	}

	private function settlement() {
		return 0;
	}

	private function withoutStock() {
		$count1 = Product::whereNotIn('id', function($query) {
							    $query->select('product_id')
							    ->from(with(new Stock)->getTable());
							})->count();

		$count2 = count(DB::select( DB::raw("select product_id from stock group by product_id having sum(current) = 0") ));

		return $count1 + $count2;
	}

	private function entranceThisMonth() {
		return Stock::whereMonth('entrance', '=', date('m'))->sum("initial");
	}

	private function investments() {
		$investments = Investment::selectRaw("investor, sum(amount) as amount")->groupBy("investor")->get();

		return $investments;
	}

	public function requestedProducts()
    {
    	$requested = Requested::where("amount", ">", 0)->get();

    	$response = [];
    	foreach ($requested as $r) {
			$product = Product::find($r->product_id);

    		$item = [
    			"id" => $r->product_id,
    			"model" => $product->model,
    			"amount" =>$r->amount
    		];

    		$response[] = $item;
    	}
        return Datatables::of($response)->make(true);
    }
}