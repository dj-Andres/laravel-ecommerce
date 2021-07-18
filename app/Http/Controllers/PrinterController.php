<?php

namespace App\Http\Controllers;

use App\Models\Printer;
use App\Http\Requests\Printer\UpdateRequest;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:printer.index')->only(['index']);
        $this->middleware('can:printer.update')->only(['update']);
    }

    public function index()
    {
        $printer = Printer::where('id','=',1)->firstOrFail();
        return view("admin.printer.index",compact("printer"));

    }
    public function update(UpdateRequest $request,Printer $printer)
    {
        $printer->update($request->all());
        return redirect()->route('printer.index');
    }
}
