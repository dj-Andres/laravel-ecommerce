<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\StoreRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sales.index')->only(['index']);
        $this->middleware('can:sales.create')->only(['create', 'store']);
        $this->middleware('can:sales.edit')->only(['edit', 'update']);
        $this->middleware('can:sales.destroy')->only(['destroy']);
        $this->middleware('can:sales.change_status')->only(['change_status']);
        $this->middleware('can:sales.pdf')->only(['pdf']);
        $this->middleware('can:sales.print')->only(['print']);
    }

    public function index()
    {
        $sales = Sale::join('clients', 'clients.id', '=', 'sales.client_id')
            ->select('sales.id', 'clients.name', 'sale_date', 'impuesto', 'total', 'status')
            ->get();
        return view('admin.sale.index', compact('sales'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            switch ($request->input('getClients')) {
                case 'getClients':
                    $clients = Client::get();
                    return compact('clients');
                    break;
                default:
                    break;
            }
        }
    }

    public function create()
    {
        $clients = Client::get();
        $products = Product::get();
        return view('admin.sale.create', compact('clients', 'products'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $sales = Sale::create($request->all() + [
                'user_id' => Auth::user()->id,
                'sale_date' => Carbon::now('America/Guayaquil')
            ]);

            $sales->save();

            $contador = 0;

            while ($contador < count($request->product_id)) {
                $detalle  = new SaleDetail();
                $detalle->sale_id = $sales['id'];
                $detalle->product_id = $request->product_id[$contador];
                $detalle->cantidad = $request->cantidad[$contador];
                $detalle->price = $request->price[$contador];
                $detalle->descuento = $request->descuento[$contador];

                $detalle->save();
                $contador = $contador + 1;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('sales.index');
    }
    public function show(Sale $sale)
    {
        $subtotal = 0;

        $saleDetails = SaleDetail::where('sale_id', '=', $sale->id)->get();

        foreach ($saleDetails as $detalle) {
            $subtotal += $detalle->cantidad * $detalle->price - $detalle->cantidad * $detalle->price * $detalle->descuento / 100;
        }

        return view('admin.sale.show', compact('sale', 'saleDetails', 'subtotal'));
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
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = "CANCELED";
        $sale->update();
        return redirect()->route('sales.index');
    }
    public function pdf(Sale $sale)
    {
        $subtotal = 0;

        $saleDetails = SaleDetail::where('sale_id', '=', $sale->id)->get();

        foreach ($saleDetails as $detalle) {
            $subtotal += $detalle->cantidad * $detalle->price - $detalle->cantidad * $detalle->price * $detalle->descuento / 100;
        }

        $pdf = PDF::loadView('admin.sale.pdf', compact('sale', 'subtotal', 'saleDetails'));
        return $pdf->download('reporte_compra_' . $sale->id . '_' . $sale->sale_date . '.pdf');
    }
    public function print(Request $request)
    {
        try {

            $sale = Sale::Detalle()
                ->select('sales.id', 'sale_date', 'impuesto', 'total', 'status', 'users.name as usuario', 'clients.name as cliente', 'clients.cedula', 'clients.address', 'clients.email', 'clients.phone')
                ->where('sales.id', $request->id)->get();

            $subtotal = 0;

            $saleDetails = SaleDetail::where('sale_id', $request->id)->get();

            foreach ($saleDetails as $detalle) {
                $subtotal += $detalle->cantidad * $detalle->price - $detalle->cantidad * $detalle->price * $detalle->descuento / 100;
            }

            $data = ['sale' => $sale, 'saleDetails' => $saleDetails->toArray(), 'subtotal' => $subtotal];

            return response()->json(['status' => 'ok', 'code' => 200, 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code' => 400, 'message' => $e->getMessage()]);
        }
    }
    public function change_status(Sale $sale)
    {
        if ($sale->status == "VALID") {
            $sale->update(['status' => 'CANCELED']);
            return redirect()->back();
        } else {
            $sale->update(['status' => 'VALID']);
            return redirect()->back();
        }
    }
}
