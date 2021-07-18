<?php

namespace App\Http\Controllers;

use App\Models\Sale;
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

    }
    public function report_date()
    {

    }
    public function report_results(Request $request)
    {
        
    }
}
