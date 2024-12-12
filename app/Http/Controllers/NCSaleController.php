<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\StockItems;
use App\Models\Sales;
use App\Models\NCSales;
use App\Models\Ncpaymentrecord;
use App\Models\NCPayment;


use App\Models\SalesPayment;
use App\Models\Repairs;
use App\Models\RepairOrder;
use App\Models\MetalRates;
use Carbon\Carbon;


class NCSaleController extends Controller
{
    public function getNCSalesList(Request $request)
    {
        $ncsales = NCSales::all();
        return view('admin.ncsales.ncsales-list', compact('ncsales'));
    }
	
    public function getAddNCSale(Request $request)
    {
        $customers = Customers::all();
        return view('admin.ncsales.ncsale',compact('customers'));
    }

    public function search(Request $request)
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

    public function postNewCustomer(Request $request)
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
        $customer->date_of_bith = $request->date_of_birth;
        $customer->gender = $request->gender;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->whatsapp_no = $request->whatsapp_no;
        $customer->address = $request->address;
     
        $customer->save();
    
        return redirect(('/sale'))->with('success', 'Customer Details Added Successfully!');
    }

   public function fetchItem(Request $request)
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


    public function storeNCSale(Request $request)
    {
		if ($request->total_amount == 0) {
       	  return redirect()->back()->with('error', 'Amount Cannot be 0');
    	}
       
        $itemIds = explode(',', $request->item_ids);
        $sales = new NCSales();
        $sales->customer_id = $request->customer_id;
        $sales->item_ids = $request->item_ids;
        $sales->selling_person_id = auth()->id();
      
        $sales->date = $request->date;
		$sales->total_cost = $request->total_amount;
		$sales->payment_type = $request->payment_type;
		$sales->duration = $request->duration;
        $sales->save();
		
		$duration =  $request->duration;
		$amount = $request->total_amount / $duration;
		$date = \Carbon\Carbon::parse($request->date);

		// Determine the number of days to add based on payment type
		if ($request->payment_type == 'monthly') {
			$daysToAdd = 30;
		} elseif ($request->payment_type == 'yearly') {
			$daysToAdd = 365;
		} else {
			// Handle any other cases if needed, or throw an error if invalid
			$daysToAdd = 0; // Or set a default behavior
		}

		for ($i = 0; $i < $duration; $i++) {
			$ncpaymentrecord = new Ncpaymentrecord();
			$ncpaymentrecord->nc_id = $sales->id;
			$ncpaymentrecord->amount = $amount;
			$ncpaymentrecord->date = $date;
			$ncpaymentrecord->status = 'pending'; // Or any default value for status
			$ncpaymentrecord->save(); // Save the record to the database

			// Add the appropriate number of days (30 for monthly, 365 for yearly)
			$date->addDays($daysToAdd);
		}

		
		$invoiceNo = 'NC_'.$sales->id;

		foreach ($itemIds as $itemId) {
			$item = StockItems::where('item_id', $itemId)->first();

			if ($item) {
				$item->update([
					'location' => 'NC',
					'sub_location' => 'NC',
					'invoice_no' => $invoiceNo,
				]);
			}
		}

        return redirect('/nc-sales-list')->with('success', 'Sales Details Added Successfully!!');
    }
    
	
	public function removeItems($id , $ncsale_id)
    {
		
        $sales = NCSales::where('id', $ncsale_id)->first();
		$item = StockItems::where('item_id' , $id )->first();

		// Get the item_ids, split them into an array
		$itemIds = explode(',', $sales->item_ids);

		// Remove the specific $item_id from the array
		$itemIds = array_diff($itemIds, [$id]);

		// Convert the array back into a comma-separated string
		$sales->item_ids = implode(',', $itemIds);
		
		
		$newtotal = $sales->total_cost - $item->sale_amount;
		
		$newdue = $sales->due_amount - $item->sale_amount;
		
		$sales->total_cost = $newtotal;
		$sales->due_amount = $newdue;
	
		// Update the sale with the new item_ids
		$sales->save();
		
		$item->update([
					'location' => 'purchase',
					'sub_location' => 'purchase',
					'invoice_no' => null,
					'sale_amount' => null,
				]);
        
        return redirect()->back()->with('success', 'Item Removed Successfully!!'); 
    }
	
		public function updateItemPrice(Request $request, $id , $ncsale_id)
    {
		
        $sales = NCSales::where('id', $ncsale_id)->first();
		$item = StockItems::where('item_id' , $id )->first();

		$pricediff = $request->amount - $item->sale_amount ;
		
		$newtotal = $sales->total_cost + $pricediff;
		
		$newdue = $sales->due_amount + $pricediff;
		
		$sales->total_cost = $newtotal;
		$sales->due_amount = $newdue;
	
		// Update the sale with the new item_ids
		$sales->save();
		
		$item->update([
					'sale_amount' => $request->amount,
				]);
        
        return redirect()->back()->with('success', 'Item Price update Successfully!!'); 
    }
	
	public function viewNCSalesItems($sale_id)
    {
        $salesItems = NCSales::where('id', $sale_id)->first();
        $itemIdString = $salesItems->item_ids; 
		//dd($itemIdString);
		
        $itemDetailsArray = explode(',', $itemIdString);

		
        $itemDetailsArray = array_map('trim', $itemDetailsArray);

        $stockItems = StockItems::whereIn('item_id', $itemDetailsArray)->get();

		$ncpaymentdeatils = NCPayment::where('order_id', $sale_id)->get();
		
		if ($stockItems->isEmpty()) {
			$stockItems = Repairs::whereIn('id', $itemDetailsArray)->get();
		}

        return view('admin.ncsales.view-nc-sale-items', compact('salesItems','stockItems','ncpaymentdeatils')); 
    }
	
	
	public function viewcustomerNCSalesItems($sale_id)
    {
        $salesItems = NCSales::where('id', $sale_id)->first();
        $itemIdString = $salesItems->item_ids; 
		//dd($itemIdString);
		
        $itemDetailsArray = explode(',', $itemIdString);

		
        $itemDetailsArray = array_map('trim', $itemDetailsArray);

        $stockItems = StockItems::whereIn('item_id', $itemDetailsArray)->get();

		$ncpaymentdeatils = NCPayment::where('order_id', $sale_id)->get();
		
		if ($stockItems->isEmpty()) {
			$stockItems = Repairs::whereIn('id', $itemDetailsArray)->get();
		}

        return view('admin.ncsales.customer-view-nc-sale-items', compact('salesItems','stockItems','ncpaymentdeatils')); 
    }
	
	
	public function updateNcSalesPayment(Request $request , $ncsaleid)
    {
        $NCsalesItems = NCSales::where('id', $ncsaleid)->first();

		$paid = $request->AmountPaidByCash + $request->AmountPaidByCard + $request->AmountPaidByGold;
		
		if($NCsalesItems->due_amount > $paid){
			$remainingamount = $NCsalesItems->due_amount - $paid;
		}else{
			$remainingamount = 0;
		}
		
		$newpaid = $NCsalesItems->paid_amount + $paid;
		
		$NCsalesItems->paid_amount = $newpaid;
		$NCsalesItems->due_amount = $remainingamount;
		$NCsalesItems->save();
		
		if($request->AmountPaidByCash){
			
			$payment = new NCPayment();
			$payment->order_id = $NCsalesItems->id;
			$payment->payment_type = "cash";
			$payment->invoice_type = "NC Sale";
			$payment->customer_id = $NCsalesItems->customer_id;
			$payment->amount = $request->AmountPaidByCash;
			$payment->save();
		}
			
		if($request->AmountPaidByCard){
        	
			$payment = new NCPayment();
			$payment->order_id = $NCsalesItems->id;
			$payment->payment_type = "card";
			$payment->invoice_type = "NC Sale";
			$payment->customer_id = $NCsalesItems->customer_id;
			$payment->amount = $request->AmountPaidByCard;
			$payment->ref_no = $request->transaction_id;
			$payment->save();
		}
			
		if( $request->AmountPaidByGold){
        	$payment = new NCPayment();
			$payment->order_id = $NCsalesItems->id;
			$payment->payment_type = "gold";
			$payment->invoice_type = "NC Sale";
			$payment->customer_id = $NCsalesItems->customer_id;
			$payment->amount = $request->AmountPaidByGold;
			$payment->ref_no = $request->InternalGoldREF;

			$payment->save();
		}
		
        return redirect()->back()->with('success', 'Payment Updated Successfully!!');
    }
		

}
