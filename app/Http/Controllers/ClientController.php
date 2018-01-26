<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use App\Model\Client;
use App\Logger\AmbarLogger;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function autocomplete(){
        $term = Input::get('term');
        
        $results = array();
        
        $queries = Client::where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('instagram', 'LIKE', '%'.$term.'%')
            ->orWhere('phone', 'LIKE', '%'.$term.'%')
            ->orWhere('facebook', 'LIKE', '%'.$term.'%')
            ->orWhere('email', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query) {
            $results[] = [ 
               'id' => $query->id, 
               'value' => $query->name . " - " . 
                $query->instagram . " - " .
                $query->facebook . " - " .
                $query->phone . " - " .
                $query->email,
               'name' => $query->name,
               'instagram' => $query->instagram,
               'facebook' => $query->facebook,
               'phone' => $query->phone,
               'email' => $query->email,
               'address' => $query->address,
            ];
        }
        
        return Response::json($results);
    }
}