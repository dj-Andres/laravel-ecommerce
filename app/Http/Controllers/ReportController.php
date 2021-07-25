<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:report.report_day')->only(['report_day']);
        $this->middleware('can:report.report_date')->only(['report_date']);
        $this->middleware('can:report.report_results')->only(['report_results']);
    }

    public function report_day()
    {
        $sales = Sale::whereDate('sale_date',Carbon::today('America/Guayaquil'))->get();
        $total = $sales->sum('total');
        return view('admin.report.report_day',compact('sales','total'));
    }
    public function report_date()
    {
        $sales = Sale::whereDate('sale_date',Carbon::today('America/Guayaquil'))->get();
        $total = $sales->sum('total');
        return view('admin.report.report_date', compact('sales', 'total'));
    }
    public function report_results(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $sales = Sale::whereBetween('sale_date', [$fi, $ff])->get();
        $total = $sales->sum('total');
        return view('admin.report.report_results', compact('sales', 'total')); 
    }
}
