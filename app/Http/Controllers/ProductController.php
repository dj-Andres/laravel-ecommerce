<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:product.index')->only(['index']);
        $this->middleware('can:product.create')->only(['create', 'store']);
        $this->middleware('can:product.edit')->only(['edit', 'update']);
        $this->middleware('can:product.destroy')->only(['destroy']);
        $this->middleware('can:product.change_status')->only(['change_status']);
    }

    public function index()
    {
        $products = Product::join('sub_categories', 'sub_categories.id', '=', 'products.subcategory_id')
            ->join('providers','providers.id','=','products.provider_id')
            ->select('products.id', 'products.name', 'products.stock', 'products.status', 'sub_categories.name as categoria','providers.name as proveedor')
            ->get();
        return view('admin.product.index', compact('products'));
    }

    public function search(Request $request)
    {
        if (isset($request)) {
            switch ($request->input('getSubCategory')) {
                case 'getProducts':
                    $products = Product::where('code', $request->code)->firstOrFail();
                    return response()->json($products->toArray());
                    break;
                case 'getProductById':
                    $product = Product::firstOrFail($request->product_id);
                    return response()->json($product->toArray());
                    break;
                case 'getSubCategory':
                    $subcategory = SubCategory::select('id','category_id','name')->where('category_id',$request->category_id)->get();
                    return response()->json(['status' => 'ok','code' => 200, 'data' => $subcategory->toArray()]);
                    break;
                default:
                    break;
            }
            return response()->json(['status' => 'error','code' => 400,'message' =>'Solicitud no encontrada']);
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
        $tags = Tag::get();
        $subcategories = SubCategory::all();
        return view('admin.product.create', compact('categories', 'providers', 'tags', 'subcategories'));
    }

    public function store(StoreRequest $request, Product $product)
    {
        $validated = $request->validated();
        try {
            $product->storeProduct($request);
            return response()->json(['status' => 'ok', 'code' => 200, 'message' => 'El Producto se  creo exitosamente.', 'data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $product = Product::join('sub_categories', 'sub_categories.id', '=', 'products.subcategory_id')
            ->join('providers', 'providers.id', '=', 'products.provider_id')
            ->select('products.id', 'products.code', 'providers.id as provider_id', 'sub_categories.id as category_id', 'products.name', 'products.sell_price', 'products.status', 'products.image', 'categories.name as categoria', 'providers.name as proveedor')
            ->where('products.id', '=', $id)
            ->first();
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        $providers = Provider::get();
        $tags = Tag::all();
        $subcategories = SubCategory::all();
        return view('admin.product.edit', compact('product', 'categories', 'providers', 'tags', 'subcategories'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            $product = Product::findOrFail($id);
            $product->updateProduct($request);
            return response()->json(['status' => 'ok', 'code' => 200, 'message' => 'El Producto se ' . $request->name . ' actualizo exitosamente.', 'data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->status = 'DESACTIVED';
            $product->update();
            return response()->json(['status' => 'ok', 'code' => 200, 'message' => 'El Producto se ' . $product->name . ' se anulo exitosamente.', 'data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }
    public function change_status(Product $product)
    {
        if ($product->status == 'ACTIVE') {
            $product->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } else {
            $product->update(['status' => 'ACTIVE']);
            return redirect()->back();
        }
    }
    public function upload(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/image'), $image_name);
            $urlimage = '/image/' . $image_name;
        }
        $product->images()->create(['url' => $urlimage]);
    }
}
