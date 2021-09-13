<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:categories.index')->only(['index']);
        $this->middleware('can:categories.create')->only(['create','store']);
        $this->middleware('can:categories.edit')->only(['edit','update']);
        $this->middleware('can:categories.destroy')->only(['destroy']);
    }
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories.index',compact('categories'));
    }
    public function search(Request $request){
        if($request->ajax()){
            switch ($request->input('getCategories')){
                case 'getCategories':
                    $categories = Category::get();
                    return compact('categories');
                break;
                default:
                break;
            }
            return response()->json(['status' => 'error','code' => 400,'message' =>'Solicitud no encontrada']);
        }
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $category = Category::create($request->all());
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'La categoria ha sido guardada exitosamente','data' => $category],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }

    public function show(Category $category)
    {
        return view('admin.categories.show',compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    public function update(UpdateRequest $request,$id)
    {
        $validated = $request->validated();
        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'La categoria '.$request->name.'  ha sido actualizada exitosamente','data' => $category],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            return response()->json(['status' => 'ok','code'=>200,'message' => 'La categoria se elimino correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','code'=>400,'message' => $e->getMessage()], 400);
        }
    }
}
