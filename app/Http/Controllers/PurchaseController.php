<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StoreRequest;
use App\Http\Requests\Purchase\UpdateRequest;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use function GuzzleHttp\Promise\all;


class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $purchases = Purchase::join('providers', 'providers.id', '=', 'purchases.provider_id')
            ->select('purchases.id as compra_id', 'providers.id', 'providers.name as proveedor', 'purchases.purchase_date', 'purchases.impuesto', 'purchases.total', 'status')
            ->get();
        return view('admin.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $providers = Provider::get();
        $products = Product::get();
        return view('admin.purchase.create', compact('providers', 'products'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

                $purchase = Purchase::create($request->all() + [
                    'user_id' => Auth::user()->id,
                    'purchase_date' => Carbon::now('America/Guayaquil')
                ]);
            
                $purchase->save();

                $contador = 0;

                while($contador < count($request->product_id))
                {
                    $detalle  = new PurchaseDetails();
                    $detalle->pruchase_id = $purchase['id'];
                    $detalle->product_id = $request->product_id[$contador];
                    $detalle->cantidad = $request->cantidad[$contador];
                    $detalle->price = $request->price[$contador];
                    
                    $detalle->save();
                    $contador= $contador+1;
                }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('purchases.index');
    }

    public function show(Purchase $purchase)
    {   
        $subtotal = 0;

        $purchaseDetails = PurchaseDetails::where('pruchase_id','=',$purchase->id)->get();
        
        foreach ($purchaseDetails as $detalle) {
            $subtotal += $detalle->cantidad*$detalle->price;
        }

        return view('admin.purchase.show', compact('purchase','purchaseDetails','subtotal'));
    }

    public function edit(Purchase $purchase)
    {
        $providers = Provider::get();
        $products = Product::get();
        return view('admin.purchase.edit', compact('providers','products'));
    }

    public function update(UpdateRequest $request, Purchase $purchase)
    {
        /*$purchase->update($request->all());
        return redirect()->route('purchase.index');*/
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->status = "CANCELED";
        $purchase->update();
        return redirect()->route('purchase.index');
    }
    public function pdf(Purchase $purchase)
    {
        $subtotal = 0;

        $purchaseDetails = PurchaseDetails::where('pruchase_id','=',$purchase->id)->get();
        
        foreach ($purchaseDetails as $detalle) {
            $subtotal += $detalle->cantidad*$detalle->price;
        }

        $pdf = PDF::loadView('admin.purchase.pdf', compact('purchase','subtotal','purchaseDetails'));
        return $pdf->download('reporte_compra_'.$purchase->id.'_'.$purchase->purchase_date.'.pdf');    
    }
}
