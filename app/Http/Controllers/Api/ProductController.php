<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all('id', 'name', 'stock', 'sell_price', 'status', 'category_id', 'provider_id')->where('status', 'ACTIVE');
        return response(['products' => ProductResource::collection($products), 'message' => 'Retrieved successfully'], 200);
    }
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            /*$file = $request->file('image');
            $file->move(public_path("/images"), $file->getClientOriginalName());*/
            $product = Product::create($request->all()/* + ['image' => $file]*/);
            if ($request->code == "") {
                $numero = $product->id;
                $numeroConCeros = str_pad($numero, 8, "0", STR_PAD_LEFT);
                $product->update(['code' => $numeroConCeros]);
            }
            return response(['status' => 'ok', 'code' => 200, 'message' => 'El Producto se  creo exitosamente.', 'data' => new ProductResource($product)], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    public function show($id)
    {
        $product = Product::join('categories', 'categories.id', 'products.category_id')
            ->join('providers', 'providers.id', 'products.provider_id')
            ->select('products.id', 'products.code', 'providers.id as provider_id', 'categories.id as category_id', 'products.name', 'products.sell_price', 'products.status', 'products.image', 'categories.name as categoria', 'providers.name as proveedor')
            ->where('products.id', $id)
            ->first();
        return response(['product' => new ProductResource($product), 'message' => 'Retrieved successfully'], 200);
    }
    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return response(['status' => 'ok', 'code' => 200, 'message' => 'El Producto se ' . $request->name . ' actualizo exitosamente.', 'data' => new ProductResource($product)], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()],400);
        }
    }
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->status = 'DESACTIVED';
            $product->update();
            return response(['status' => 'ok', 'code' => 200, 'message' => 'El Producto se ' . $product->name . ' se anulo exitosamente.', 'data' => new ProductResource($product)], 200);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()],400);
        }
    }
}
