<?php

namespace App\Http\Controllers;

use App\Models\Printer;
use App\Http\Requests\Printer\UpdateRequest;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
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
