<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Model\ProductTag;
use App\Model\Tag;
use App\Logger\AmbarLogger;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product/product');
    }

    public function add()
    {
        return view('product/product_add');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $tags = [];

        $productTags = ProductTag::where("product_id", $product->id)->get();

        foreach ($productTags as $prodTags) 
            $tags[] = Tag::find($prodTags->tag_id);

        return view('product/product_edit', [ "product" => $product, "tags" => $tags ]);
    }

    public function view($id)
    {
        $product = Product::find($id);

        $tags = [];

        $productTags = ProductTag::where("product_id", $product->id)->get();

        foreach ($productTags as $prodTags) 
            $tags[] = Tag::find($prodTags->tag_id);
        
        return view('product/product_view', [ "product" => $product, "tags" => $tags ]);
    }

    public function viewImages($id) 
    {
        $product = Product::find($id);

        return view('product/product_images', [ "product" => $product ]);
    }

    public function data($type)
    {
        return Datatables::of(Product::where('model', 'like', $type.'%'))->make(true);
    }

    public function create()
    {
        $data = Input::all();

        $product = Product::create([
            'model'       => $data['model'],
            'description' => $data['description'],
            'fabricated'  => (int)$data['fabricated'],
            'cost'        => $data['cost'],
            'wholesale'   => $data['wholesale'],
            'retail'      => $data['retail'],
        ]);

        $tags = $data["tags"];

        foreach ($tags as $tag) {
            ProductTag::create([
                "product_id" => $product->id,
                "tag_id" => $tag["id"]
            ]);
        }
    }

    public function update()
    {
        $data = Input::all();

        $product = Product::find($data['id']);

        $product->model       = $data['model'];
        $product->description = $data['description'];
        $product->fabricated  = (int)$data['fabricated'];
        $product->cost        = $data['cost'];
        $product->wholesale   = $data['wholesale'];
        $product->retail      = $data['retail'];

        $product->save();

        ProductTag::where("product_id", $product->id)->delete();

        $tags = $data["tags"];

        foreach ($tags as $tag) {
            ProductTag::create([
                "product_id" => $product->id,
                "tag_id" => $tag["id"]
            ]);
        }
    }

    public function images($id) 
    {
        $data = Input::all();

        foreach ($data["photos"] as $image) {
            $imageName = $image->hashName();

            if(!\Storage::disk('public_uploads')->put($id, $image)) {
                AmbarLogger::log("failed to save " . $imageName);
            }
        }

    }

    public function autocomplete() {
        $term = Input::get('term');
        
        $results = array();
        
        $queries = Product::where('model', 'LIKE', '%'.$term.'%')
            ->orWhere('description', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query) {
            $results[] = [ 
               'id' => $query->id, 
               'value' => $query->model . " - " . $query->description,
               'model' => $query->model,
               'description' => $query->description,
               'wholesale' => $query->wholesale,
               'retail' => $query->retail,
               'stock' => $query->totalStock()
            ];
        }
        
        return Response::json($results);
    }

    public function autocompleteTag() {
        $term = Input::get('term');
        
        $results = array();
        
        $queries = Tag::where('name', 'LIKE', '%'.$term.'%')->take(5)->get();
        
        foreach ($queries as $query) {
            $results[] = [ 
               'id' => $query->id, 
               'value' => $query->name,
               'name' => $query->name,
            ];
        }
        
        return Response::json($results);
    }

    public function createTag() {
        $data = Input::all();

        Tag::create([
            "name" => $data["name"]
        ]);
    }
}
