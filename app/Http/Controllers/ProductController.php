<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::join('categories','categories.id','=','products.category_id')
                            ->select('products.id','products.name','products.stock','products.status','categories.name as categoria')
                            ->where('products.status','=','ACTIVE')
                            ->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.create', compact('categories', 'providers'));
    }

    public function store(StoreRequest $request)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path("/images/productos"),$image_name);
        }

        $product = Product::create($request->all()+[
            'image' => $image_name
        ]);

        $product->update(['code' => $product->id]);

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::join('categories','categories.id','=','products.category_id')
                    ->join('providers','providers.id','=','products.provider_id')
                    ->select('products.id','products.name','products.sell_price','products.status','categories.name as categoria','providers.name as proveedor')
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
}
