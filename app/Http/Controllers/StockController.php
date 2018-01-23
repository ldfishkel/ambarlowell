<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use App\Models\Stock;
use App\Logger\AmbarLogger;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        return view('stock/stock', [ "product_id" => $id ]);
    }

    public function add($id)
    {
        return view('stock/stock_add', [ "product_id" => $id ]);
    }

    public function data($id)
    {
        return Datatables::of(Stock::where('product_id', $id)->get())->make(true);
    }

    public function create($id)
    {
        $data = Input::all();

        Stock::create([
            'product_id'       => $id,
            'initial'          => $data['amount'],
            'current'          => $data['amount'],
            'settlement'       => $data['settlement'],
            'entrance'         => date('Y-m-d'),
        ]);
    }
}
