<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Credit;
use App\Model\Balance;
use App\Model\Cost;
use App\Model\Supplier;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Logger\AmbarLogger;

class CreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data()
    {
        $response = [];
        $data = Input::all();

        $start = $data["start"];
        $length = $data["length"];

        $credits = Credit::where('payed', false)->skip($start)->take($length)->get();

        foreach ($credits as $credit) {
            $supplier = Supplier::find($credit->supplier_id);
            $row = [
                "id" => $credit->id,
                "creditor" => $supplier->info,
                "amount" => $credit->amount,
            ];
            $response[] = $row;
        }

        return Datatables::of($response)->make(true);
    }

    public function payed($id)
    {
        $credit = Credit::find($id);
        $credit->payed = true;
        $credit->save();

        Balance::create([
            'concept' => 'credit payed cost',
            'amount'  => -$credit->amount,
            'date'    => date('Y-m-d')
        ]);
    }
}
