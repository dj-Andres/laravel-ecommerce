<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StoreRequest;
use App\Http\Requests\Purchase\UpdateRequest;
use App\Models\Provider;
use App\Models\Purchase;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::get();
        return view('admin.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $providers = Provider::get();
        return view('admin.purchase.create', compact('providers'));
    }

    public function store(StoreRequest $request)
    {
        $purchase = Purchase::create($request->all());

        foreach ($request->product_id as $key) {
            $results[] = array("product_id" => $request->product_id[$key], "cantidad" => $request->cantidad[$key], "price" => $request->price[$key]);
        }

        //$purchase->purchaseDatails()->createMany($results);
        $purchase->shoppingDatails()->createMany($results);

        return redirect()->route('purchase.index');
    }

    public function show(Purchase $purchase)
    {
        return view('admin.purchase.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $providers = Provider::get();
        return view('admin.purchase.edit', compact('providers'));
    }

    public function update(UpdateRequest $request, Purchase $purchase)
    {
        /*$purchase->update($request->all());
        return redirect()->route('purchase.index');*/
    }

    public function destroy(Purchase $purchase)
    {
        /*$purchase->delete();
        return redirect()->route('purchase.index');*/
    }
}
