<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StoreRequest;
use App\Http\Requests\Purchase\UpdateRequest;
use App\Models\Business;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;


use function GuzzleHttp\Promise\all;


class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:purchases.index')->only(['index']);
        $this->middleware('can:purchases.create')->only(['create', 'store']);
        $this->middleware('can:purchases.edit')->only(['edit', 'update']);
        $this->middleware('can:purchases.destroy')->only(['destroy']);
        $this->middleware('can:purchase.change_status')->only(['change_status']);
        $this->middleware('can:purchase.upload')->only(['upload']);
    }
    public function index()
    {
        $purchases = Purchase::join('providers', 'providers.id', '=', 'purchases.provider_id')
            ->select('purchases.id as compra_id', 'providers.id', 'providers.name as proveedor', 'purchases.purchase_date', 'purchases.impuesto', 'purchases.total', 'purchases.status')
            ->get();
        return view('admin.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $providers = Provider::get();
        $products = Product::where('status', 'ACTIVE')->get();
        return view('admin.purchase.create', compact('providers', 'products'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::create($request->all() + ['user_id' => Auth::user()->id, 'purchase_date' => Carbon::now('America/Guayaquil')]);
            $purchase->save();
            $contador = 0;
            while ($contador < count($request->product_id)) {
                $detalle  = new PurchaseDetails();
                $detalle->pruchase_id = $purchase['id'];
                $detalle->product_id = $request->product_id[$contador];
                $detalle->cantidad = $request->cantidad[$contador];
                $detalle->price = $request->price[$contador];

                $detalle->save();
                $contador = $contador + 1;
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

        $purchaseDetails = PurchaseDetails::where('pruchase_id', '=', $purchase->id)->get();

        foreach ($purchaseDetails as $detalle) {
            $subtotal += $detalle->cantidad * $detalle->price;
        }

        return view('admin.purchase.show', compact('purchase', 'purchaseDetails', 'subtotal'));
    }

    public function edit(Purchase $purchase)
    {
        $subtotal = 0;
        $providers = Provider::get();
        $products = Product::where('status', 'ACTIVE')->get();
        $purchaseDetails = PurchaseDetails::where('pruchase_id', $purchase->id)->get();
        foreach ($purchaseDetails as $detalle) {
            $subtotal += $detalle->cantidad * $detalle->price;
        }
        return view('admin.purchase.edit', compact('purchase', 'providers', 'products', 'purchaseDetails', 'subtotal'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $purchase = Purchase::findOrFail($id);
            $purchase->update($request->all());

            foreach ($purchase->shoppingDatails as $purchaseDetails) {
                $purchase->shoppingDatails()->update(['pruchase_id' => $purchase['id'], 'product_id' => $purchaseDetails->product_id, 'cantidad' => $purchaseDetails->cantidad, 'price' => $purchaseDetails->price]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('purchases.index');
    }

    public function destroy($id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->status = "CANCELED";
            $purchase->update();
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'La Compra con Codigo '.$id. ' se anulo exitosamente.','data' => $purchase],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
    public function pdf(Purchase $purchase)
    {
        //$business = Business::where('id',1)->firstOrFail();

        $subtotal = 0;

        $purchaseDetails = PurchaseDetails::where('pruchase_id', '=', $purchase->id)->get();

        foreach ($purchaseDetails as $detalle) {
            $subtotal += $detalle->cantidad * $detalle->price;
        }

        $pdf = PDF::loadView('admin.purchase.pdf', compact('purchase', 'subtotal', 'purchaseDetails'));
        return $pdf->download('reporte_compra_' . $purchase->id . '_' . $purchase->purchase_date . '.pdf');
    }
    public function upload(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());
        return redirect()->route('purchase.index');
    }
    public function change_status($id)
    {
        try {
            $purchase = Purchase::find($id);
            if ($purchase->status == "VALID") {
                $purchase->update(['status' => 'CANCELED']);
            } else {
                $purchase->update(['status' => 'VALID']);
            }
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'La Compra con Codigo '.$id. ' ha cambiado el estado.','data' => $purchase],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
}
