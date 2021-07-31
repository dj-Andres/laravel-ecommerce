<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

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
        try {
            Client::create($request->all());
            return response()->json(array('status' => 'ok', 'code'=>200, 'message'=>'El cliente ha sido guardado'));
        } catch (\Exception $e) {
            return response()->json(array('status' => 'error', 'code'=>400, 'message'=>$e->getMessage()));
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
        return redirect()->route('client.index');
    }
}
