<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

use App\Http\Requests\SubCategory\StoreRequest;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /* agregar permisos de seeders para los procesos de subcategoria */
    }
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategories.index',compact('subcategories'));
    }

    public function create()
    {
        return view('admin.subcategories.create');
    }
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $subcategory = SubCategory::create([
                'name' => $request->name,
                'slug' => Str::of($request->name)->slug('-'),
                'category_id' => $request->icategory_id,
                'description ' => $request->description
            ]);
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'La Sub Categoria ha sido guardada exitosamente','data' => $subcategory],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }

    public function show(SubCategory $subCategories)
    {
        return view('admin.subcategories.show',compact('subCategories'));
    }
    public function edit(SubCategory $subCategories)
    {
        return view('admin.subcategories.edit',compact('subCategories'));
    }
    public function update(Request $request, $id)
    {
        try {
            $subcategory = SubCategory::findOrFail($id);
            $subcategory->update($request->all());
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'La Subcategoria '.$request->name.'  ha sido actualizada exitosamente','data' => $subcategory],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $subcategory = SubCategory::find($id);
            $subcategory->delete();
            return response()->json(['status' => 'ok','code'=>200,'message' => 'La subcategoria ha sido anulada correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','code'=>400,'message' => $e->getMessage()], 400);
        }
    }
}
