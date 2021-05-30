<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\StoreRequest;
use App\Models\Client;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::get();
        return view('admin.sale.index', compact('sales'));
    }

    public function create()
    {
        $clients = Client::get();
        return view('admin.sale.create', compact('clients'));
    }

    public function store(StoreRequest $request)
    {
        $sales = Sale::create($request->all());

        foreach ($request->product_id as $key) {
            $results[] = array("product_id" => $request->product_id[$key], "cantidad" => $request->cantidad[$key], "price" => $request->price[$key], "descuento" => $request->descuento[$key]);
        }

        $sales->saleDetails()->createMany($results);

        return redirect()->route('sale.index');
    }
    public function show(Sale $sale)
    {
        $clients = Client::get();

        return view('admin.sale.show', compact('clients'));
    }

    public function edit(Sale $sale)
    {
        $clients = Client::get();
        return view('admin.sale.edit', compact('clients'));
    }

    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
