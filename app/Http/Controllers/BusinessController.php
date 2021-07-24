<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Http\Requests\Business\UpdateRequest;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:business.index')->only(['index']);
        $this->middleware('can:business.update')->only(['update']);
    }

    public function index()
    {
        $business = Business::where('id',1)->firstOrFail();
        return view("admin.business.index",compact("business"));

    }
    public function update(UpdateRequest $request,Business $business)
    {
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/images/business/"),$image_name);
        }

        $business->update($request->all()+[
            'logo'=>$image_name
        ]);

        return redirect()->route('business.index');
    }

}
