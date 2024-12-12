<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\StockItems;
use App\Models\Sales;
use App\Models\SalesPayment;
use App\Models\Repairs;
use App\Models\RepairOrder;
use App\Models\MetalRates;
use App\Models\NCSales;
use App\Models\OrderItem;
use App\Models\Order;


use App\Models\Ncpaymentrecord;
use PDF;
use Carbon\Carbon;


class SaleController extends Controller
{
    public function getSalesList(Request $request)
	{
		// Fetch sales ordered by the 'created_at' column in descending order
		$sales = Sales::orderBy('created_at', 'desc')->get();

		return view('admin.sales.sales-list', compact('sales'));
	}

    public function getAddSale(Request $request)
    {
        $customers = Customers::all();
        return view('admin.sales.sale',compact('customers'));
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
        $customer->date_of_birth = $request->date_of_birth;
        $customer->gender = $request->gender;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->whatsapp_no = $request->whatsapp_no;
        $customer->address = $request->address;
     
        $customer->save();
    
        return redirect(('/sale'))->with('success', 'Customer Details Added Successfully!');
    }

   public function fetchItem(Request $request )
	{
		// Validate the incoming request
		$request->validate([
			'item_id' => 'required|string|max:255',
		]);

	   
		// Fetch the item details from the database
		$item = StockItems::where('item_id', $request->input('item_id'))
		->where('sub_location', '!=', 'NC') // Exclude items with sub_location as 'NC'
		->where('sub_location', '!=', 'Customer') // Exclude items that belong to the specified customer
		->first();

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
			return response()->json(['error' => 'Item not found or item already sale'], 404);
		}
	}


public function storeSale(Request $request)
    { 
		$request->validate([
            'customer_id' => 'required|integer',
            'item_ids' => 'required|string',
        ]);
			
		
		if ($request->invoice_type == 'nc') {
		if ($request->total_amount == 0) {
       	  return redirect()->back()->with('error', 'Amount Cannot be 0');
    	}
       
        $itemIds = explode(',', $request->item_ids);
        $sales = new NCSales();
        $sales->customer_id = $request->customer_id;
        $sales->item_ids = $request->item_ids;
        $sales->selling_person_id = auth()->id();
      
        $sales->date = $request->date;
			
		$paid = $request->cash_payment + $request->card_payment + $request->gold_Amount;
		
		if($request->total_amount > $paid){
			$remainingamount = $request->total_amount - $paid;
		}else{
			$remainingamount = 0;
		}
			
		$sales->total_cost = $request->total_amount;
		$sales->paid_amount = $paid;
		$sales->due_amount = $remainingamount;
		$sales->card_payment = $request->card_payment;
		$sales->cash_payment = $request->cash_payment;
		$sales->transaction_id = $request->transaction_id;
		$sales->payment_type = $request->payment_type;
		$sales->duration = $request->duration;
		$sales->note = $request->note;
			
        $sales->save();
		
		$duration =  $request->duration;
		$amount = $remainingamount / $duration;
		$date = \Carbon\Carbon::parse($request->date);

		// Determine the number of days to add based on payment type
		if ($request->payment_type == 'monthly') {
			$daysToAdd = 30;
		} elseif ($request->payment_type == 'yearly') {
			$daysToAdd = 365;
		} else {
			// Handle any other cases if needed, or throw an error if invalid
			$daysToAdd = 1; // Or set a default behavior
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

			
			$itemAmounts = explode(',', $request->item_amount); // '10,20,30,40'

			foreach ($itemIds as $index => $itemId) {
				$item = StockItems::where('item_id', $itemId)->first();

				if ($item) {
					// Get the corresponding amount for this item
					$itemAmount = $itemAmounts[$index]; // Match the amount to the item ID by index

					// Update the item with both location and amount
					$item->update([
						'location' => 'NC',
						'sub_location' => 'NC',
						'invoice_no' => $invoiceNo,
						'sale_amount' => $itemAmount, // Assuming the column name for amount is 'amount'
					]);
				}
			}
        return redirect('/nc-sales-list')->with('success', 'Sales Details Added Successfully!!');
		
	}else{
			
		if ($request->total_amount == 0) {
       	  return redirect()->back()->with('error', 'Amount Cannot be 0');
    	}
       
        $itemIds = explode(',', $request->item_ids);
        $sales = new Sales();
        $sales->customer_id = $request->customer_id;
        $sales->item_id = $request->item_ids;
        $sales->selling_person_id = $request->selling_person_id;
       
        $sales->due_date = $request->due_payment_date;
			
		$paid = $request->cash_payment + $request->card_payment + $request->gold_Amount;
		
			
		if($request->total_amount > $paid){
			$remainingamount = $request->total_amount - $paid;
		}else{
			$remainingamount = 0;
		}
			
		$sales->note = $request->note;
			
		$sales->total_amount = $request->total_amount;

		$sales->paid_amount = $paid;
		$sales->due_amount = $remainingamount;
			
        $sales->save();
			
		$sales->invoice_no = $sales->sale_id;
		$sales->save();
		
		$invoiceNo = $sales->invoice_no;
			
			$itemAmounts = explode(',', $request->item_amount); // '10,20,30,40'

			foreach ($itemIds as $index => $itemId) {
				$item = StockItems::where('item_id', $itemId)->first();

				if ($item) {
					// Get the corresponding amount for this item
					$itemAmount = $itemAmounts[$index]; // Match the amount to the item ID by index

					// Update the item with both location and amount
					$item->update([
						'location' => 'Customer',
						'sub_location' => 'Customer',
						'invoice_no' => $invoiceNo,
						'sale_amount' => $itemAmount, // Assuming the column name for amount is 'amount'
					]);
				}
			}

        $salesId = $sales->sale_id; 
			
		if($request->cash_payment){
			
			$payment = new SalesPayment();
			$payment->order_id = $salesId;
			$payment->payment_type = "cash";
			$payment->invoice_type = "sale";
			$payment->customer_id = $request->customer_id;
			$payment->amount = $request->cash_payment;
			$payment->save();
		}
			
		if($request->card_payment){
        	
			$payment = new SalesPayment();
			$payment->order_id = $salesId;
			$payment->payment_type = "card";
			$payment->invoice_type = "sale";
			$payment->customer_id = $request->customer_id;
			$payment->amount = $request->card_payment;
			$payment->ref_no = $request->transaction_id;
			$payment->save();
		}
			
		if( $request->gold_Amount){
        	$payment = new SalesPayment();
			$payment->order_id = $salesId;
			$payment->payment_type = "gold";
			$payment->invoice_type = "sale";
			$payment->customer_id = $request->customer_id;
			$payment->amount = $request->gold_Amount;
			$payment->save();
		}
			
        return redirect('/sales-list')->with('success', 'Sales Details Added Successfully!!');
	}
    }

    
	    public function storeSaleRepair(Request $request)
    {
        
	$request->validate([
            'customer_id' => 'required|integer',
            'item_ids' => 'required|string',
        ]);
			
		
		if ($request->invoice_type == 'nc') {
		if ($request->total_amount == 0) {
       	  return redirect()->back()->with('error', 'Amount Cannot be 0');
    	}
       
        $itemIds = explode(',', $request->item_ids);
        $sales = new NCSales();
        $sales->customer_id = $request->customer_id;
        $sales->item_ids = $request->item_ids;
        $sales->selling_person_id = auth()->id();
      
        $sales->date = $request->date;
			
		$paid = $request->cash_payment + $request->card_payment + $request->gold_Amount;
		
		if($request->total_amount > $paid){
			$remainingamount = $request->total_amount - $paid;
		}else{
			$remainingamount = 0;
		}
			
		$sales->total_cost = $request->total_amount;
		$sales->paid_amount = $paid;
		$sales->due_amount = $remainingamount;
		$sales->card_payment = $request->card_payment;
		$sales->cash_payment = $request->cash_payment;
		$sales->transaction_id = $request->transaction_id;
		$sales->payment_type = $request->payment_type;
		$sales->duration = $request->duration;
			
        $sales->save();
		
		$duration =  $request->duration;
		$amount = $remainingamount / $duration;
		$date = \Carbon\Carbon::parse($request->date);

		// Determine the number of days to add based on payment type
		if ($request->payment_type == 'monthly') {
			$daysToAdd = 30;
		} elseif ($request->payment_type == 'yearly') {
			$daysToAdd = 365;
		} else {
			// Handle any other cases if needed, or throw an error if invalid
			$daysToAdd = 1; // Or set a default behavior
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

			
			$itemAmounts = explode(',', $request->item_amount); // '10,20,30,40'

			foreach ($itemIds as $index => $itemId) {
				$item = StockItems::where('item_id', $itemId)->first();

				if ($item) {
					// Get the corresponding amount for this item
					$itemAmount = $itemAmounts[$index]; // Match the amount to the item ID by index

					// Update the item with both location and amount
					$item->update([
						'location' => 'NC',
						'sub_location' => 'NC',
						'invoice_no' => $invoiceNo,
						'sale_amount' => $itemAmount, // Assuming the column name for amount is 'amount'
					]);
				}
			}
        return redirect('/nc-sales-list')->with('success', 'Sales Details Added Successfully!!');
		
	}else{
			
		if ($request->total_amount == 0) {
       	  return redirect()->back()->with('error', 'Amount Cannot be 0');
    	}
			
			
       
        $itemIds = explode(',', $request->item_ids);
        $sales = new Sales();
        $sales->customer_id = $request->customer_id;
        $sales->item_id = $request->item_ids;
        $sales->repair_order_no = $request->repair_order_no;
			
        $sales->selling_person_id = $request->selling_person_id;
       
        $sales->due_date = $request->due_payment_date;
			
		$paid = $request->cash_payment + $request->card_payment + $request->gold_Amount;
		
			
		if($request->total_amount > $paid){
			$remainingamount = $request->total_amount - $paid;
		}else{
			$remainingamount = 0;
		}
			
			
		$sales->total_amount = $request->total_amount;

		$sales->paid_amount = $paid;
		$sales->due_amount = $remainingamount;
			
        $sales->save();
			
		$sales->invoice_no = $sales->sale_id;
		$sales->save();
		
		$order = Order::where('id', $request->repair_order_no)->first();
			
		
		$invoiceNo = $sales->invoice_no;
			
			$order->invoice_id = $invoiceNo;
			$order->payment_status = "Completed";
			$order->save();
			
			$itemAmounts = explode(',', $request->item_amount); // '10,20,30,40'

			foreach ($itemIds as $index => $itemId) {
				$item = OrderItem::where('repair_id', $itemId)->first();

				if ($item) {
					// Get the corresponding amount for this item
					$itemAmount = $itemAmounts[$index]; // Match the amount to the item ID by index

					// Update the item with both location and amount
					$item->update([
						'location' => 'Customer',
						'sub_location' => 'Customer',
						'invoice_no' => $invoiceNo,
						'sale_amount' => $itemAmount, // Assuming the column name for amount is 'amount'
					]);
				}
			}

        $salesId = $sales->sale_id; 
			
		if($request->cash_payment){
			
			$payment = new SalesPayment();
			$payment->order_id = $salesId;
			$payment->payment_type = "cash";
			$payment->invoice_type = "sale";
			$payment->customer_id = $request->customer_id;
			$payment->amount = $request->cash_payment;
			$payment->save();
		}
			
		if($request->card_payment){
        	
			$payment = new SalesPayment();
			$payment->order_id = $salesId;
			$payment->payment_type = "card";
			$payment->invoice_type = "sale";
			$payment->customer_id = $request->customer_id;
			$payment->amount = $request->card_payment;
			$payment->ref_no = $request->transaction_id;
			$payment->save();
		}
			
		if( $request->gold_Amount){
        	$payment = new SalesPayment();
			$payment->order_id = $salesId;
			$payment->payment_type = "gold";
			$payment->invoice_type = "sale";
			$payment->customer_id = $request->customer_id;
			$payment->amount = $request->gold_Amount;
			$payment->save();
		}
			
        return redirect('/sales-list')->with('success', 'Sales Details Added Successfully!!');
	}
        }
    
	
public function viewSalesItems($sale_id)
    {
        $salesItems = Sales::where('sale_id', $sale_id)->first();

        $itemIdString = $salesItems->item_id; 
	
        $itemDetailsArray = explode(',', $itemIdString);

        $itemDetailsArray = array_map('trim', $itemDetailsArray);

		$payments = SalesPayment::where('order_id', $sale_id)->get();

		if ($salesItems->repair_order_no) {
			$stockItems = OrderItem::whereIn('repair_id', $itemDetailsArray)->get();
		}else{
			$stockItems = StockItems::whereIn('item_id', $itemDetailsArray)->get();
		}

        return view('admin.sales.view-sale-items', compact('payments', 'salesItems','stockItems')); 
    }
	
	
	public function viewcustomerSalesItems($sale_id)
    {
        $salesItems = Sales::where('sale_id', $sale_id)->first();

        $itemIdString = $salesItems->item_id; 
	
        $itemDetailsArray = explode(',', $itemIdString);

        $itemDetailsArray = array_map('trim', $itemDetailsArray);

        
		
		$payments = SalesPayment::where('order_id', $sale_id)->get();

		if ($salesItems->repair_order_no) {
			$stockItems = OrderItem::whereIn('repair_id', $itemDetailsArray)->get();
		}else{
			$stockItems = StockItems::whereIn('item_id', $itemDetailsArray)->get();
		}

        return view('admin.sales.customer-sale-list', compact('payments', 'salesItems','stockItems')); 
    }
	
	public function updateSales(Request $request)
    {
        $salesItems = Sales::where('sale_id', $request->sale_id)->first();

		$paid = $request->AmountPaidByCash + $request->AmountPaidByCard + $request->AmountPaidByGold;
		
		
			
		if($salesItems->due_amount > $paid){
			$remainingamount = $salesItems->due_amount - $paid;
		}else{
			$remainingamount = 0;
		}
		
	
		$newpaid = $salesItems->paid_amount + $paid;
		$salesItems->paid_amount = $newpaid;
		$salesItems->due_amount = $remainingamount;
		$salesItems->save();
		
		if($request->AmountPaidByCash){
			
			$payment = new SalesPayment();
			$payment->order_id = $salesItems->sale_id;
			$payment->payment_type = "cash";
			$payment->invoice_type = "sale";
			$payment->customer_id = $salesItems->customer_id;
			$payment->amount = $request->AmountPaidByCash;
			$payment->save();
		}
			
		if($request->AmountPaidByCard){
        	
			$payment = new SalesPayment();
			$payment->order_id = $salesItems->sale_id;
			$payment->payment_type = "card";
			$payment->invoice_type = "sale";
			$payment->customer_id = $salesItems->customer_id;
			$payment->amount = $request->AmountPaidByCard;
			$payment->ref_no = $request->transaction_id;
			$payment->save();
		}
			
		if( $request->AmountPaidByGold){
        	$payment = new SalesPayment();
			$payment->order_id = $salesItems->sale_id;
			$payment->payment_type = "gold";
			$payment->invoice_type = "sale";
			$payment->customer_id = $salesItems->customer_id;
			$payment->amount = $request->AmountPaidByGold;
			$payment->ref_no = $request->InternalGoldREF;

			$payment->save();
		}
		
        return redirect()->route('view.sales.items', $salesItems->sale_id)->with('success', 'Updated Successfully!!');
    }
	
	
	public function editSalesItems($sale_id)
    {
        $salesItems = Sales::where('sale_id', $sale_id)->first();

        $itemIdString = $salesItems->item_id; 
        $itemDetailsArray = explode(',', $itemIdString);

        $itemDetailsArray = array_map('trim', $itemDetailsArray);

        $stockItems = StockItems::whereIn('item_id', $itemDetailsArray)->get();

		if ($stockItems->isEmpty()) {
			$stockItems = Repairs::whereIn('id', $itemDetailsArray)->get();
		}

        return view('admin.sales.edit-sale-items', compact('salesItems','stockItems')); 
    }
		
	public function invoiceprint($sale_id)
	{
		$invoice = Sales::find($sale_id);
		$customer = Customers::find($invoice->customer_id);
//dd($invoice);
		$items = [];
		if ($invoice->repair_order_no) {
			
			$itemIds = explode(',', $invoice->item_id);
			
			foreach ($itemIds as $itemId) {
				
				$item = Repairs::where('id', $itemId)->first();
				
				if ($item) {
					$items[] = $item;
				}
			}
		} else {
			$itemIds = explode(',', $invoice->item_id);
			foreach ($itemIds as $itemId) {
				$item = StockItems::find($itemId);
				if ($item) {
					$items[] = $item;
				}
			}
		}

		
	
		
		return view('admin.sales.invoice', [
            'invoice' => $invoice,
			'customer' => $customer,
			'items' => $items
        ]);
	}
	
	public function downloadPdf($sale_id)
	{
		$invoice = Sales::find($sale_id);
		$customer = Customers::find($invoice->customer_id);
		$items = [];
		if ($invoice->repair_order_no) {
			
			$itemIds = explode(',', $invoice->item_id);
			
			foreach ($itemIds as $itemId) {
				
				$item = Repairs::where('id', $itemId)->first();
				
				if ($item) {
					$items[] = $item;
				}
			}
		} else {
			$itemIds = explode(',', $invoice->item_id);
			foreach ($itemIds as $itemId) {
				$item = StockItems::find($itemId);
				if ($item) {
					$items[] = $item;
				}
			}
		}

		// Load the Blade view with the invoice data
		$pdf = PDF::loadView('admin.sales.invoice', compact('invoice', 'customer', 'items'));
		// Download the PDF with a specified filename
		return $pdf->download('invoice_' . $sale_id . '.pdf');
	}
	


}
