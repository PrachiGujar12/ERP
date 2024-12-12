<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\StockItems;
use App\Models\Quotation;
use App\Models\MetalRates;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function getSalesQuotation(Request $request)
    {
        return view('admin.quotation.sales-quotation');
    }

	public function getSalesQuotationlist(Request $request)
    {
		$sales = Quotation::get();
        return view('admin.quotation.quotation-list', compact('sales'));
    }
	
    public function searchMobile(Request $request)
    {
        $mobileNo = $request->query('mobile_no');

        // Validate mobile number
        $request->validate([
            'mobile_no' => 'required|numeric'
        ]);

        $customer = Customers::where('mobile_no', $mobileNo)->first();

        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    public function storeNewCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'mobile_no' => 'required|string|max:15|unique:customers,mobile_no',
            'email' => 'nullable|email|max:255',
            'whatsapp_no' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
           
        ]);
    
        $customer = new Customers();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->gender = $request->gender;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->whatsapp_no = $request->whatsapp_no;
        $customer->address = $request->address;
     
        $customer->save();
    
        return redirect(('/sale'))->with('success', 'Customer Details Added Successfully!');
    }

    public function fetchItemDetails(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'item_id' => 'required|string|max:255',
    ]);

    // Fetch the item details from the database
    $item = StockItems::where('item_id', $request->input('item_id'))->first();

    if ($item) {
        // Fetch the rate for today's date based on metal_type and purity
        $todaysRate = MetalRates::where('rate', '<>', '')
            ->whereDate('date', Carbon::today())
            ->where('metal_type', $item->metal_type)
            ->where('purity', $item->purity)
            ->first();

        // Return item details along with today's rate as a JSON response
        return response()->json([
            'item_id' => $item->item_id,
            'category' => $item->category,
            'metalType' => $item->metal_type,
            'purity' => $item->purity,
            'item_weight' => $item->item_weight,
            'amount' => $item->amount,
            'todays_rate' => $todaysRate ? $todaysRate->rate : null, // Include today's rate, if found
        ]);
    } else {
        // Return an error response if the item is not found
        return response()->json(['error' => 'Item not found'], 404);
    }
}

    public function postSalesQuotation(Request $request)
    {
		  if ($request->total_amount == 0) {
       	  return redirect()->back()->with('error', 'Amount Cannot be 0');
    	}
    
        $itemIds = explode(',', $request->item_ids);
        $itemIdsString = implode(',', $itemIds);

        $quotation = new Quotation();
        $quotation->customer_id = $request->customer_id;
      
        $quotation->total_amount = $request->item_amount;
		
        $quotation->item_id = $itemIdsString;
        $quotation->save();

        return redirect()->back()->with('success', 'Quotation Added Successfully!!');
    }
	
	
	public function getSalesQuotationview($sale_id)
    {
		
		$salesItems = Quotation::where('quotation_id',$sale_id)->first();
		
		$items = explode(',', $salesItems->item_id);
		$amounts = explode(',', $salesItems->total_amount);
    	// Use whereIn to retrieve all stock items that match the IDs in $items array
    	$stockItems = StockItems::whereIn('item_id', $items)->get();
		
		foreach ($stockItems as $index => $stockItem) {
			// Ensure that $index corresponds to the position in the $amounts array
			if (isset($amounts[$index])) {
				$stockItem->aamount = $amounts[$index];
			} else {
				$stockItem->aamount = 0; // Default or handle missing amounts gracefully
			}
		}
		
		//dd($stockItems);

        return view('admin.quotation.quotation-view', compact('salesItems','stockItems'));
    }

}
