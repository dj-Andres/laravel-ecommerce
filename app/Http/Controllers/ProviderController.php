<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:providers.index')->only(['index']);
        $this->middleware('can:providers.create')->only(['create', 'store']);
        $this->middleware('can:providers.edit')->only(['edit', 'update']);
        $this->middleware('can:providers.destroy')->only(['destroy']);
    }

    public function index()
    {
        $providers = Provider::get();
        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.providers.create');
    }
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $provider = Provider::create($request->all());
            return response()->json(['status' => 'ok', 'code' => 200, 'message' => 'El proveedor ha sido guardado', 'data' => $provider], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }
    public function show(Provider $provider)
    {
        return view('admin.providers.show', compact('provider'));
    }

    public function edit(Provider $provider)
    {
        return view('admin.providers.edit', compact('provider'));
    }
    public function update(Request $request, Provider $provider)
    {
        $provider->update($request->all());
        return redirect()->route('providers.index');
    }
    public function destroy($id)
    {
        try {
            $provider = Provider::find($id);
            $provider->delete();
            return response()->json(['status' => 'ok','message' => 'El Proveedor se elimino correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','message' => $e->getMessage()], 400);
        }
    }
}
