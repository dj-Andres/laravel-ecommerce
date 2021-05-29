<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::get();
        return view('admin.provider.index',compact('providers'));
    }

    public function create()
    {
        return view('admin.provider.create');
    }
    public function store(StoreRequest $request)
    {
        Provider::create($request->all());
        return  redirect()->route('provider.index');
    }
    public function show(Provider $provider)
    {
        return view('admin.provider.show',compact('provider'));
    }

    public function edit(Provider $provider)
    {
        return view('admin.provider.edit',compact('provider'));
    }
    public function update(UpdateRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        return redirect()->route('provider.index');
    }
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('provider.index');
    }
}
