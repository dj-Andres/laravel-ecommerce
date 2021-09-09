<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:client.index')->only(['index']);
        $this->middleware('can:client.create')->only(['create','store']);
        $this->middleware('can:client.edit')->only(['edit','update']);
        $this->middleware('can:client.destroy')->only(['destroy']);
    }

    public function index()
    {
        $clients = Client::get();
        return view('admin.client.index', compact('clients'));
    }
    public function create()
    {
        return view('admin.client.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $client = Client::create($request->all());
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'El cliente ha sido guardado','data' => $client],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
    public function show(Client $client)
    {
        return view('admin.client.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    public function update(UpdateRequest $request, Client $client)
    {
        $client->update($request->all());
        return redirect()->route('client.index');
    }
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index')->with("message","El Cliente ha sido anulado existosamente .$client->name");
    }
}
