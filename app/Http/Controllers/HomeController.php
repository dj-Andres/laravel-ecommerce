<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $compramensual = Purchase::select(DB::raw('month(purchase_date) as mes'), DB::raw('SUM(total) as totales'))
            ->where('status', "VALID")
            ->groupBy('purchase_date')
            ->orderBy('purchase_date', 'desc')
            ->limit(12)
            ->get();
        $ventamensual = Sale::select(DB::raw('month(sale_date) as mes'), DB::raw('SUM(total) as totalmes'))
            ->where('status', "VALID")
            ->groupBy('sale_date')
            ->orderBy('sale_date', 'desc')
            ->limit(12)
            ->get();
        $ventasdia = Sale::select(DB::raw('DATE_FORMAT(sale_date,"%Y-%m-%d") as dia'), DB::raw('SUM(total) as totaldia'))
            ->where('status', "VALID")
            ->groupBy('sale_date')
            ->orderBy('sale_date', 'desc')
            ->limit(15)
            ->get();
        $totalcompra = Purchase::select(DB::raw('COALESCE(sum(total),0) as totalcompra'))
            ->whereDate('purchase_date', DB::raw('curdate()'))
            ->where('status', "VALID")
            ->get();
        $totalventa = Sale::select(DB::raw('COALESCE(sum(total),0) as totalventa'))
            ->whereDate('sale_date', DB::raw('curdate()'))
            ->where('status', "VALID")
            ->get();
        $productosvendidos = Product::join('sale_details', 'sale_details.product_id', 'products.id')
            ->join('sales', 'sales.id', 'sale_details.sale_id')
            ->select('products.code', 'products.name', 'products.id', 'products.stock')
            ->selectRaw('SUM(sale_details.cantidad) as cantidad')
            ->where('sales.status', "VALID")
            ->whereYear('sales.sale_date', DB::raw('year(curdate())'))
            ->groupBy('products.code', 'products.name', 'products.id', 'products.stock')
            ->orderBy('sale_details.cantidad', 'desc')
            ->limit(10)
            ->get();
        return view('home', compact('compramensual', 'ventamensual', 'ventasdia', 'totalcompra', 'totalventa', 'productosvendidos'));
    }
}
