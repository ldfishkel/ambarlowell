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

class CostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cost/cost');
    }

    public function add()
    {
        return view('cost/cost_add');
    }

    public function view($id)
    {
        $cost = Cost::find($id);

        return view('cost/cost_view', [ "cost" => $cost ]);
    }

    public function data()
    {
        return Datatables::of(Cost::query())->make(true);
    }

    public function create()
    {
        $data = Input::all();
        
        $supplier = $data["supplier"];

        $supplierId = null;
        
        if (!isset($supplier["id"])) {
            $supplier = Supplier::create([
                'info' => isset($supplier["info"]) ? $supplier["info"] : "",
            ]);

            $supplierId = $supplier->id;
        } else 
            $supplierId = $supplier["id"];

        $cost = Cost::create([
            'supplier_id'  => $supplierId,
            'payment_type' => $data["type"],
            'amount'       => $data["amount"],
            'concept'      => $data["concept"],
            'date'         => date('Y-m-d'),
        ]);

        if ($data['type'] == "Real") 
            Balance::create([
                'amount' => -$cost->amount,
                'concept' => $cost->concept,
                'date' => date('Y-m-d'),
            ]);
        else if ($data['type'] == "Virtual") 
            Credit::create([
                'supplier_id' => $cost->supplier_id,
                'cost_id' => $cost->id,
                'amount' => $cost->amount,
                'date' => date('Y-m-d'),
                'payed' => false
            ]);
    }

    public function autocomplete() {
        $term = Input::get('term');
        
        $results = array();
        
        $queries = Supplier::where('info', 'LIKE', '%'. $term .'%')
            ->take(5)->get();
        
        foreach ($queries as $query) {
            $results[] = [ 
               'id' => $query->id, 
               'value' => $query->info
            ];
        }
        
        return Response::json($results);
    }
}
