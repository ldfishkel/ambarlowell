<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Debt;
use App\Model\Balance;
use App\Model\Cost;
use App\Model\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\Logger\AmbarLogger;

class DebtController extends Controller
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

        $debts = Debt::where('payed', false)->skip($start)->take($length)->get();

        foreach ($debts as $debt) {
            $client = Client::find($debt->client_id);
            $row = [
                "id" => $debt->id,
                "debtor" => $client->name,
                "amount" => $debt->amount,
            ];
            $response[] = $row;
        }

        return Datatables::of($response)->make(true);
    }

    public function payed($id)
    {
        $debt = Debt::find($id);
        $debt->payed = true;
        $debt->save();

        Balance::create([
            'concept' => 'debt payed sale',
            'amount'  => $debt->amount,
            'date'    => date('Y-m-d')
        ]);
    }
}
