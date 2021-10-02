<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }
    public function create()
    {
        return view('admin.tags.create', compact('tags'));
    }
    public function store(Request $request)
    {
        $validated = $request->validated();
        try {
            $tag = Tag::create([
                'name' => $request->name,
                'slug' => Str::of($request->name)->slug('-'),
                'description' => $request->description
            ]);
            return response()->json(['status' => 'ok', 'code' => 200, 'message' => 'El Tag se  creo exitosamente.', 'data' => $tag], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }
    public function show(Tag $tag)
    {
        return view('admin.tags.show',compact('tag'));
    }
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit',compact('tag'));
    }
    public function update(Request $request, $id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->update($request->all());
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'El Tag '.$request->name.'  ha sido actualizada exitosamente','data' => $tag],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $tag = Tag::find($id);
            $tag->delete();
            return response()->json(['status' => 'ok','code'=>200,'message' => 'El Tag se elimino correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','code'=>400,'message' => $e->getMessage()], 400);
        }
    }
}
