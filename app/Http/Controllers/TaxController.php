<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxes;

class TaxController extends Controller
{
    public function getTaxList(Request $request)
    {
        $taxes = Taxes::all();
        return view('online.taxes.tax-list', compact('taxes'));
    }

    public function addNewTax(Request $request)
    {
        return view('online.taxes.add-tax');
    }

    public function postNewTax(Request $request)
    {
        $taxes = new Taxes();

        $taxes->name = $request->name;
        $taxes->percentage = $request->percentage;
        $taxes->status = $request->status;

        $taxes->save();

        return redirect('/tax-list')->with('success', 'Tax Added Succesfully');

    }

    public function getEditTax($id)
    {
        $tax = Taxes::findorFail($id);

        return view('online.taxes.edit-tax', compact('tax'));
    }

    public function updateTax(Request $request, $id)
    {
       
            $tax = Taxes::findOrFail($id);
            $tax->name = $request->name;
            $tax->percentage = $request->percentage;
            $tax->status = $request->status;

         
            $tax->save();

            return redirect('/tax-list')->with('success', 'Tax Updated Successfully');
    }

    public function deleteTax($id)
    {
        $tax = Taxes::findOrFail($id);

        $tax->delete();

        return redirect('tax-list')->with('error', 'Tax deleted successfully!');
    }
}
