<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:product.index')->only(['index']);
        $this->middleware('can:product.create')->only(['create','store']);
        $this->middleware('can:product.edit')->only(['edit','update']);
        $this->middleware('can:product.destroy')->only(['destroy']);
        $this->middleware('can:product.change_status')->only(['change_status']);
    }

    public function index()
    {
        $products = Product::join('categories','categories.id','=','products.category_id')
                            ->select('products.id','products.name','products.stock','products.status','categories.name as categoria')
                            ->get();
        return view('admin.product.index', compact('products'));
    }

    public function search(Request $request)
    {
        $a = $request->all();
        if(isset($a['action'])){
            switch($a['action']){
                case 'getProducts':
                    $products = Product::where('code',$request->code)->firstOrFail();
                    return response()->json($products->toArray());
                break;
                case 'getProductById':
                    $product = Product::firstOrFail($request->product_id);
                    return response()->json($product->toArray());
                break;
                default:
                break;
            }
            return ['success' => false,'message' => 'No se encontro la accion'];
        }
        /*if($request->ajax()){
            switch ($request->input('getProducts')) {
                case 'getProducts':
                    $products = Product::where('code',$request->code)->firstOrFail();
                    return response()->json($products->toArray());
                    break;
                default:
                    break;
            }
            switch ($request->input('getProductById')) {
                case 'getProductById':
                    $product = Product::firstOrFail($request->product_id);
                    return response()->json($product->toArray());
                    break;
                default:
                    break;
            }
        }*/
    }

    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.create', compact('categories', 'providers'));
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $file = $request->file('image');
            $file->move(public_path("/images/productos"),$file->getClientOriginalName());
            $product = Product::create($request->all()+['image'=>$file]);
            $product->update(['code' => $product->id]);
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'El Producto se  creo exitosamente.','data' => $product],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }

    public function show($id)
    {
        $product = Product::join('categories','categories.id','=','products.category_id')
                    ->join('providers','providers.id','=','products.provider_id')
                    ->select('products.id','products.code','providers.id as provider_id','categories.id as category_id','products.name','products.sell_price','products.status','products.image','categories.name as categoria','providers.name as proveedor')
                    ->where('products.id','=',$id)
                    ->first();
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.edit', compact('product', 'categories', 'providers'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path("/images/productos"),$image_name);
        }


        $product->update($request->all()+[
            'image' => $image_name
        ]);

        return redirect()->route('product.index');
    }
    public function destroy($id)
    {   $product = Product::findOrFail($id);
        $product->status = 'DESACTIVED';
        $product->update();
        return redirect()->route('product.index');
    }
    public function change_status(Product $product)
    {
        if ($product->status == 'ACTIVE') {
            $product->update(['status'=>'DEACTIVATED']);
            return redirect()->back();
        } else {
            $product->update(['status'=>'ACTIVE']);
            return redirect()->back();
        }
    }
}
