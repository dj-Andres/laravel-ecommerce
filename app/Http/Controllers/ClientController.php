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
        ///$validator = Validator::make($request->all(), $rules, $messages);
        /*if($validated->passes()){
                
            }else{
                return response()->json(['type'=> 'validate','errors' => $validated->errors()]);
            }*/
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
        $validated = $request->validated();
        try {
            $client->update($request->all());
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'El cliente '.$client['name'].' fue actualizado exitosamente ','data' => $client],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index');
    }
}
