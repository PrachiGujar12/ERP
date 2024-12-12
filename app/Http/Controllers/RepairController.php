<?php

namespace App\Http\Controllers;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Http\Request;
use App\Models\Repairs;

use App\Models\Categories;
use App\Models\ItemType;
use App\Models\Customers;
use App\Models\Karigar;
use App\Models\RepairOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\OrderReturnPayment;
use App\Models\RepairOrderPayment;
use App\Models\RepairOrderItem;
use App\Models\RepairOrderReturnPayment;



class RepairController extends Controller
{
    public function getRepairItemsList(Request $request)
    {
        $pendingrepairOrders = RepairOrder::whereNotIn('order_status', ['Completed'])
								->orderBy('created_at', 'desc')
								->get();

        $completerepairOrders = RepairOrder::where('order_status', 'Completed')->with('orderItems')->orderBy('created_at', 'desc')->get();
        
        $repairOrders = RepairOrder::get();
		
        $categories = Categories::all();
        $itemTypes = ItemType::all();
        $customers = Customers::all();
		$karagirs = Karigar::where('status', 'active')->get();
        
        $today = date('Y-m-d');
        return view('admin.repairs.repair-items-list', compact('completerepairOrders','repairOrders','pendingrepairOrders','categories','itemTypes','customers','today','karagirs'));
		
        
    }
	
	public function getOrderList(Request $request)
    {
        $pendingrepairOrders = Order::whereIn('order_status', ['Pending','Assigned'])->orderBy('created_at', 'desc')->get();
        $completerepairOrders = Order::where('order_status', 'Completed')->with('orderItems')->orderBy('created_at', 'desc')->get();
        
        $repairOrders = Order::get();
		
        $categories = Categories::all();
        $itemTypes = ItemType::all();
        $customers = Customers::all();
		$karagirs = Karigar::where('status', 'active')->get();
        
        $today = date('Y-m-d');
        return view('admin.orders.index', compact('completerepairOrders','repairOrders','pendingrepairOrders','categories','itemTypes','customers','today','karagirs'));
    }
	
	public function showOrderDetails($order_no)
    {
        // Fetch items based on the repair order number
        $order = Order::where('id', $order_no)->first();
		
        $items = OrderItem::where('repair_order_no', $order_no)->get();
		
		//dd($items);
		$karagirs = Karigar::all();
		

		$orderpayments = OrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = OrderReturnPayment::where('order_id', $order_no)->get();
		
		$orderReturnPaymentsTotal = OrderReturnPayment::where('order_id', $order_no)->sum('amount');
        // Pass the data to a view
        return view('admin.orders.show', compact('items', 'karagirs','order','orderpayments','orderReturnPaymentsTotal','orderreturnpayments'));
    }
	
	
	
	public function showcustomerOrderDetails($order_no , $itemid)
    {
		$categories = Categories::all();
        $itemTypes = ItemType::all();
        // Fetch items based on the repair order number
        $order = Order::where('id', $order_no)->first();
		
        $item = OrderItem::where('repair_id', $itemid)->first();
		$karagirs = Karigar::all();
			
		$orderpayments = OrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = OrderReturnPayment::where('order_id', $order_no)->get();
			
		$orderReturnPaymentsTotal = OrderReturnPayment::where('order_id', $order_no)->sum('amount');

        // Pass the data to a view
        return view('admin.orders.customer-show', compact('item', 			'karagirs','order','orderpayments','orderreturnpayments','orderReturnPaymentsTotal','categories','itemTypes'));
    }
	
	
		public function showcustomerOrderitemDetails($order_no , $itemid)
    {
        // Fetch items based on the repair order number
        $order = Order::where('id', $order_no)->first();
		
        $item = OrderItem::where('repair_id', $itemid)->first();
		$karagirs = Karigar::all();
		$categories = Categories::all();
			$itemTypes = ItemType::all();
			
		$orderpayments = OrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = OrderReturnPayment::where('order_id', $order_no)->get();
			
		$orderReturnPaymentsTotal = OrderReturnPayment::where('order_id', $order_no)->sum('amount');

        // Pass the data to a view
        return view('admin.orders.view', compact('item','categories', 'itemTypes',			'karagirs','order','orderpayments','orderreturnpayments','orderReturnPaymentsTotal'));
    }
	
	
	public function showcustomerRepairOrderitemDetails($order_no , $itemid)
    {
        // Fetch items based on the repair order number
        $order = RepairOrder::where('id', $order_no)->first();
		
        $item = RepairOrderItem::where('repair_id', $itemid)->first();
		$karagirs = Karigar::all();
			
		$orderpayments = RepairOrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = RepairOrderReturnPayment::where('order_id', $order_no)->get();
			
		$orderReturnPaymentsTotal = RepairOrderReturnPayment::where('order_id', $order_no)->sum('amount');

        // Pass the data to a view
        return view('admin.repairs.view', compact('item', 			'karagirs','order','orderpayments','orderreturnpayments','orderReturnPaymentsTotal'));
    }
	
		public function showcustomersRepairOrderitemDetails($order_no , $itemid)
    {
        // Fetch items based on the repair order number
        $order = RepairOrder::where('id', $order_no)->first();
		
        $item = RepairOrderItem::where('repair_id', $itemid)->first();
		$karagirs = Karigar::all();
			
		$orderpayments = RepairOrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = RepairOrderReturnPayment::where('order_id', $order_no)->get();
			
		$orderReturnPaymentsTotal = RepairOrderReturnPayment::where('order_id', $order_no)->sum('amount');

        // Pass the data to a view
        return view('admin.repairs.customer-detail', compact('item', 			'karagirs','order','orderpayments','orderreturnpayments','orderReturnPaymentsTotal'));
    }
	
		public function showRepairOrderitemDetails($order_no , $itemid)
    {
        // Fetch items based on the repair order number
        $order = RepairOrder::where('id', $order_no)->first();
		
        $item = RepairOrderItem::where('repair_id', $itemid)->first();
		$karagirs = Karigar::all();
			
		$orderpayments = RepairOrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = RepairOrderReturnPayment::where('order_id', $order_no)->get();
			
		$orderReturnPaymentsTotal = RepairOrderReturnPayment::where('order_id', $order_no)->sum('amount');

        // Pass the data to a view
        return view('admin.repairs.view', compact('item', 			'karagirs','order','orderpayments','orderreturnpayments','orderReturnPaymentsTotal'));
    }
	
	public function viewcustomerOrderDetails($order_no)
    {
        // Fetch items based on the repair order number
        $order = Order::where('id', $order_no)->first();
		
        $items = OrderItem::where('repair_order_no', $order_no)->get();
		$karagirs = Karigar::all();
			
		$orderpayments = OrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = OrderReturnPayment::where('order_id', $order_no)->get();
			
		$orderReturnPaymentsTotal = OrderReturnPayment::where('order_id', $order_no)->sum('amount');

        // Pass the data to a view
        return view('admin.orders.customer-view', compact('items', 'karagirs','order','orderpayments','orderreturnpayments','orderReturnPaymentsTotal'));
    }
	
	
    public function assignKarigar(Request $request)
    {
        
        if($request->received_date){
            
            $itemrepair_id = []; 
            $itemIds = explode(',', $request->input('item_ids')); 
            
            foreach ($itemIds as $index => $itemId) {
           
            $item = OrderItem::find($itemId);
				
            $item->status = "Received";
            $item->category = $request->categoryy;
            $item->metal_type = $request->metal_type;
            $item->item_weight = $request->item_weight;
            $item->description = $request->description;
				
				
            $item->received_date = date('Y-m-d');
            $item->save();
            $itemrepair_id[] = $item->repair_id;

            $repairitemcount = OrderItem::where('repair_order_no',$item->repair_order_no)->count();
            $repairitemcompletecount = OrderItem::where('repair_order_no',$item->repair_order_no)
                                        ->where('status', 'Received')
                                        ->count();
              
            if($repairitemcount == $repairitemcompletecount){
                $repairorder = Order::where('id',$item->repair_order_no)->first();
                $repairorder->order_status = 'Completed';
                $repairorder->save();
            
            }
            if (!empty($itemrepair_id)) {
                $itemrepairIds = implode(', ', $itemrepair_id);
                $successMessage = "Item with ID {$itemrepairIds} were successfully Upadated.";
            }
			}
           
        }
        else{
        // Validate the input fields
//        $request->validate([
  //          'item_ids' => 'required',
   //         'itemInputPrice' => 'required',
     //       'karigar' => 'required',
    //    ], [
    //        'item_ids.required' => 'Item IDs are required.',
    //        'itemInputPrice.required' => 'Item prices are required.',
    //        'karigar.required' => 'Karigar ID is required.',
    //    ]);


    
        $karigarId = $request->input('karigar'); 
        $itemIds = explode(',', $request->input('item_ids')); 
			
        $itemPrices = explode(',', $request->input('itemInputPrice')); 
    
        // Initialize arrays to hold items in different states
        $alreadyAssignedItems = []; 
        $nonExistentItems = []; 
        $successfullyUpdatedItems = []; 
    
        foreach ($itemIds as $index => $itemId) {
			
            $item = OrderItem::find($itemId); 
    
            if ($item) {
                if ($item->status == 'Assigned' || $item->status == 'Received'  ) {
                    // If the item is already assigned to the selected karigar
					
					$item->category = $request->categoryy;
					$item->metal_type = $request->metal_type;
					$item->item_weight = $request->item_weight;
					$item->description = $request->description;
					 $item->save();
                    $alreadyAssignedItems[] = $itemId;
                } else {
                    // Assign the selected karigar and price to the item
                    $item->karigar_id = $karigarId;
                    $item->status = 'Assigned';
                    $item->assigned_date = date('Y-m-d');
					$item->category = $request->categoryy;
					$item->metal_type = $request->metal_type;
					$item->item_weight = $request->item_weight;
					$item->description = $request->description;
    
                    // Assign the corresponding price to the item
                    if (isset($itemPrices[$index])) {
                        $item->price = $itemPrices[$index]; // Assuming the column is 'price'
                    }
    
                    $item->save();
                    $successfullyUpdatedItems[] = $itemId; // Add to successfully updated items
                }
            } else {
                // If the item does not exist
                $nonExistentItems[] = $itemId;
            }
        }
			
			$assignitemcount = OrderItem::where('repair_order_no',$item->repair_order_no)->count();
            $assignitemcompletecount = OrderItem::where('repair_order_no',$item->repair_order_no)
                                        ->whereIn('status',['Assigned', 'Received'])
                                        ->count();
              
            if($assignitemcount == $assignitemcompletecount){
                $repairorder = Order::where('id',$item->repair_order_no)->first();
                $repairorder->order_status = 'Assigned';
                $repairorder->save();
            
            }
    
        // Check for errors and success messages
        $errorMessages = [];
        $successMessage = '';
    
        if (!empty($nonExistentItems)) {
            $nonExistentIds = implode(', ', $nonExistentItems);
            $errorMessages[] = "Item with ID {$nonExistentIds} do not exist.";
        }
    
        if (!empty($alreadyAssignedItems)) {
            $alreadyAssignedIds = implode(', ', $alreadyAssignedItems);
            $errorMessages[] = "Item with ID {$alreadyAssignedIds} updated successfully.";
        }
    
        if (!empty($successfullyUpdatedItems)) {
            $updatedIds = implode(', ', $successfullyUpdatedItems);
            $successMessage = "Item with ID {$updatedIds} were successfully assigned to the karigar.";
        }
    
        // If there are any error messages, return them with the success message if available
        if (!empty($errorMessages)) {
            return redirect()->back()->with([
                'error' => implode(' ', $errorMessages),
                'success' => $successMessage
            ]);
        }
        }
        // If no errors, return only the success message
        return redirect()->back()->with('success', $successMessage);
    
    }
	
	
	public function assignRepairKarigar(Request $request)
    {
        
        if($request->received_date){
            
            $itemrepair_id = []; 
            $itemIds = explode(',', $request->input('item_ids')); 
            
            foreach ($itemIds as $index => $itemId) {
           
            $item = RepairOrderItem::find($itemId);
				
            $item->status = "Received";
            $item->received_date = date('Y-m-d');
            $item->save();
            $itemrepair_id[] = $item->repair_id;

            $repairitemcount = RepairOrderItem::where('repair_order_no',$item->repair_order_no)->count();
            $repairitemcompletecount = OrderItem::where('repair_order_no',$item->repair_order_no)
                                        ->where('status', 'Received')
                                        ->count();
              
            if($repairitemcount == $repairitemcompletecount){
                $repairorder = RepairOrder::where('id',$item->repair_order_no)->first();
                $repairorder->order_status = 'Completed';
                $repairorder->save();
            
            }
            if (!empty($itemrepair_id)) {
                $itemrepairIds = implode(', ', $itemrepair_id);
                $successMessage = "Item with ID {$itemrepairIds} were successfully Upadated.";
            }
			}
           
        }
        else{
        // Validate the input fields
        $request->validate([
            'item_ids' => 'required',
            'itemInputPrice' => 'required',
            'karigar' => 'required',
        ], [
            'item_ids.required' => 'Item IDs are required.',
            'itemInputPrice.required' => 'Item prices are required.',
            'karigar.required' => 'Karigar ID is required.',
        ]);


    
        $karigarId = $request->input('karigar'); 
        $itemIds = explode(',', $request->input('item_ids')); 
			
        $itemPrices = explode(',', $request->input('itemInputPrice')); 
    
        // Initialize arrays to hold items in different states
        $alreadyAssignedItems = []; 
        $nonExistentItems = []; 
        $successfullyUpdatedItems = []; 
    
        foreach ($itemIds as $index => $itemId) {
			
            $item = RepairOrderItem::find($itemId); 
    
            if ($item) {
                if ($item->status == 'Assigned' || $item->status == 'Received'  ) {
                    // If the item is already assigned to the selected karigar
                    $alreadyAssignedItems[] = $itemId;
                } else {
                    // Assign the selected karigar and price to the item
                    $item->karigar_id = $karigarId;
                    $item->status = 'Assigned';
                    $item->assigned_date = date('Y-m-d');
    
                    // Assign the corresponding price to the item
                    if (isset($itemPrices[$index])) {
                        $item->price = $itemPrices[$index]; // Assuming the column is 'price'
                    }
    
                    $item->save();
                    $successfullyUpdatedItems[] = $itemId; // Add to successfully updated items
                }
            } else {
                // If the item does not exist
                $nonExistentItems[] = $itemId;
            }
        }
			
			$assignitemcount = RepairOrderItem::where('repair_order_no',$item->repair_order_no)->count();
            $assignitemcompletecount = RepairOrderItem::where('repair_order_no',$item->repair_order_no)
                                        ->whereIn('status',['Assigned', 'Received'])
                                        ->count();
              
            if($assignitemcount == $assignitemcompletecount){
                $repairorder = RepairOrder::where('id',$item->repair_order_no)->first();
                $repairorder->order_status = 'Assigned';
                $repairorder->save();
            
            }
    
        // Check for errors and success messages
        $errorMessages = [];
        $successMessage = '';
    
        if (!empty($nonExistentItems)) {
            $nonExistentIds = implode(', ', $nonExistentItems);
            $errorMessages[] = "Item with ID {$nonExistentIds} do not exist.";
        }
    
        if (!empty($alreadyAssignedItems)) {
            $alreadyAssignedIds = implode(', ', $alreadyAssignedItems);
            $errorMessages[] = "Item with ID {$alreadyAssignedIds} are already assigned to the karigar.";
        }
    
        if (!empty($successfullyUpdatedItems)) {
            $updatedIds = implode(', ', $successfullyUpdatedItems);
            $successMessage = "Item with ID {$updatedIds} were successfully assigned to the karigar.";
        }
    
        // If there are any error messages, return them with the success message if available
        if (!empty($errorMessages)) {
            return redirect()->back()->with([
                'error' => implode(' ', $errorMessages),
                'success' => $successMessage
            ]);
        }
        }
        // If no errors, return only the success message
        return redirect()->back()->with('success', $successMessage);
    
    }
    
    

    public function searchCustomer(Request $request)
    {
        $mobile_no = $request->input('mobile_no');
        
        // Fetch customers by mobile number
        $customers = Customers::where('mobile_no', 'like', "%{$mobile_no}%")->get();

        // Return the customers as a JSON response
        return response()->json($customers);
    }


    public function getCustomerDetails($customer_id)
    {
        $customer = Customers::find($customer_id);
        if ($customer) {
            return response()->json([
                'first_name' => $customer->first_name,
                'email' => $customer->email,
                'gender' => $customer->gender,
                'date_of_birth' => $customer->date_of_birth,
            ]);
        }
        return response()->json(['error' => 'Customer not found'], 404);
    }


    public function getPurity($itemTypeId)
    {
        $itemType = ItemType::where('item_type_name', $itemTypeId)->first();
    
        if ($itemType) {
            // Ensure purity data is properly formatted as a comma-separated string
            $purity = $itemType->purity;
            return response()->json(['purity' => $purity]);
        }
    
        // Return an empty string if item type is not found
        return response()->json(['purity' => '']);
    }
	
	
	public function storeRepairOrder(Request $request)
    {
      
	  $request->validate([
			'customer_id' => 'required',  // Validation rule
			'categories1' => 'required',  // Validation rule
		  
		], [
			'customer_id.required' => 'Please Select Customer',  // Custom error message
			'categories1.required' => 'Please Add item',  // Custom error message
		
	  ]);
		
		$Paidtotal = $request->DepositPaidByGold + $request->DepositPaidByCard + $request->DepositPaidByCash;
		//dd($Paidtotal);
		
		$Order = Order::create([
			'customer_id' => $request->customer_id,
			'estimate_amount' => $request->estimateamount,
			'order_status' => "Pending",
			'order_date' => $request->order_date,
			'estimated_delivery_date' => $request->order_due_date,
			'payment_status' => "Pending",
			'paid_amount' => $Paidtotal,
			'created_by' => auth()->id(),
		]);
		
		
		if($request->DepositPaidByGold){
			
			$Order_payment = OrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Gold",
			'invoice_type' => "Order",
			'amount' => $request->DepositPaidByGold,
			'ref_no' => $request->InternalGoldREF,
			]);
		}
		
		if($request->DepositPaidByCard){
			
			$Order_payment = OrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Card",
			'invoice_type' => "Order",
			'amount' => $request->DepositPaidByCard,
			'ref_no' => $request->DepositPaidByCardref,
			]);
		}
		
		
		if($request->DepositPaidByCash){
			
			$Order_payment = OrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Cash",
			'invoice_type' => "Order",
			'amount' => $request->DepositPaidByCash,
			]);
		}
		
		 $maxEntries = 20; // Adjust based on the number of items you can receive

		// Loop through each possible item from 1 to max entries
		for ($i = 1; $i <= $maxEntries; $i++) {
		
			if ($request->has("categories$i")) {
			// Create a new model instance for each set of input
			$item = new OrderItem();

			// Assign values from the request to the model's fields
			$item->repair_order_no = $Order->id;
			$item->category = $request->input("categories$i");
			$item->size = $request->input("CategorySize$i");
			$item->shape = $request->input("CategoryShape$i");
			$item->diamond_type = $request->input("Diamondtype$i");
			$item->diamond_shape = $request->input("Diamondshape$i");
			$item->centre_diamond_weight = $request->input("CentreDiamondWeight$i");
			$item->total_diamond_weight = $request->input("TotalDiamondWeight$i");
			$item->matching_wedding_band = $request->input("matching_band$i");
			$item->half_et = $request->input("HalfET$i");
			$item->full_et = $request->input("FullET$i");
			$item->cost_center_diamond = $request->input("CostCentreDiamond$i");
			$item->mount_cost = $request->input("MountCost$i");
			$item->wedding_band_cost = $request->input("WeddingBandCost$i");
			$item->metal_type = $request->input("metal_types$i");
			$item->item_weight = $request->input("weights$i");
			$item->description = $request->input("note$i");
			$item->amount = $request->input("amounts$i");
				
			if ($request->input("form_input_karigar$i") !== null) {
				
				$item->karigar_id = $request->input("form_input_karigar$i");
				$item->status = 'Assigned';
				$item->assigned_date = $request->order_date;
				$item->price = $request->input("karigaramounts$i");
				
			}
			$imagePaths = [];
			
			 if ($request->hasFile("item_image$i")) {
				
				foreach ($request->file("item_image$i") as $image) {
					// Generate a unique filename
					$filename = time() . '-' . $image->getClientOriginalName();

					// Move the file to the public/assets directory
					$image->move(public_path('asset/images/orderitems'), $filename);

					// Set the file permission to 755
					chmod(public_path('asset/images/orderitems/' . $filename), 0755);

					$imagePaths[] = $filename;
				}

				// Construct the JSON string manually
				$jsonImagePaths = '[' . implode(',', array_map(function ($path) {
					return '"' . $path . '"';
				}, $imagePaths)) . ']';
			} else {
				$jsonImagePaths = null;
			}

			$item->photo = $jsonImagePaths;

			// Save the model to the database
			$item->save();

		}
		}
		
		$itemcount = OrderItem::where('repair_order_no', $Order->id)->count();
		$assignitemcount = OrderItem::where('repair_order_no', $Order->id)
										->where('status', 'Assigned')
										->count();
		

		if($assignitemcount == $itemcount){
			$Order->order_status = "Assigned";
			$Order->save();
		}

		
        return redirect('/order-list')->with('success', 'Order Created Successfully!!');
    }
	
	public function newstoreRepairOrder(Request $request)
    {
      
	  $request->validate([
			'customer_id' => 'required',  // Validation rule
			'categories1' => 'required',  // Validation rule
		  
		], [
			'customer_id.required' => 'Please Select Customer',  // Custom error message
			'categories1.required' => 'Please Add item',  // Custom error message
		
	  ]);
		
		$Paidtotal = $request->DepositPaidByGold + $request->DepositPaidByCard + $request->DepositPaidByCash;
		//dd($Paidtotal);
		
		$Order = RepairOrder::create([
			'customer_id' => $request->customer_id,
			'estimate_amount' => $request->estimateamount,
			'order_status' => "Pending",
			'order_date' => $request->order_date,
			'estimated_delivery_date' => $request->order_due_date,
			'payment_status' => "Pending",
			'paid_amount' => $Paidtotal,
			'created_by' => auth()->id(),
		]);
		
		
		if($request->DepositPaidByGold){
			
			$Order_payment = RepairOrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Gold",
			'invoice_type' => "Repair",
			'amount' => $request->DepositPaidByGold,
			'ref_no' => $request->InternalGoldREF,
			]);
		}
		
		if($request->DepositPaidByCard){
			
			$Order_payment = RepairOrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Card",
			'invoice_type' => "Repair",
			'amount' => $request->DepositPaidByCard,
			'ref_no' => $request->DepositPaidByCardref,
			]);
		}
		
		
		if($request->DepositPaidByCash){
			
			$Order_payment = RepairOrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Cash",
			'invoice_type' => "Repair",
			'amount' => $request->DepositPaidByCash,
			]);
		}
		
		 $maxEntries = 20; // Adjust based on the number of items you can receive

		// Loop through each possible item from 1 to max entries
		for ($i = 1; $i <= $maxEntries; $i++) {
		
			if ($request->has("categories$i")) {
			// Create a new model instance for each set of input
			$item = new RepairOrderItem();

			// Assign values from the request to the model's fields
			$item->repair_order_no = $Order->id;
			$item->category = $request->input("categories$i");
			$item->size = $request->input("CategorySize$i");
			$item->shape = $request->input("CategoryShape$i");
			$item->diamond_type = $request->input("Diamondtype$i");
			$item->diamond_shape = $request->input("Diamondshape$i");
			$item->centre_diamond_weight = $request->input("CentreDiamondWeight$i");
			$item->total_diamond_weight = $request->input("TotalDiamondWeight$i");
			$item->matching_wedding_band = $request->input("matching_band$i");
			$item->half_et = $request->input("HalfET$i");
			$item->full_et = $request->input("FullET$i");
			$item->cost_center_diamond = $request->input("CostCentreDiamond$i");
			$item->mount_cost = $request->input("MountCost$i");
			$item->wedding_band_cost = $request->input("WeddingBandCost$i");
			$item->metal_type = $request->input("metal_types$i");
			$item->item_weight = $request->input("weights$i");
			$item->description = $request->input("note$i");
			$item->amount = $request->input("amounts$i");
				
			if ($request->input("form_input_karigar$i") !== null) {
				
				$item->karigar_id = $request->input("form_input_karigar$i");
				$item->status = 'Assigned';
				$item->assigned_date = $request->order_date;
				$item->price = $request->input("karigaramounts$i");
				
			}
			$imagePaths = [];
			
			 if ($request->hasFile("item_image$i")) {
				
				foreach ($request->file("item_image$i") as $image) {
					// Generate a unique filename
					$filename = time() . '-' . $image->getClientOriginalName();

					// Move the file to the public/assets directory
					$image->move(public_path('asset/images/orderitems'), $filename);

					// Set the file permission to 755
					chmod(public_path('asset/images/orderitems/' . $filename), 0755);

					$imagePaths[] = $filename;
				}

				// Construct the JSON string manually
				$jsonImagePaths = '[' . implode(',', array_map(function ($path) {
					return '"' . $path . '"';
				}, $imagePaths)) . ']';
			} else {
				$jsonImagePaths = null;
			}

			$item->photo = $jsonImagePaths;

			// Save the model to the database
			$item->save();

		}
		}
		
		$itemcount = RepairOrderItem::where('repair_order_no', $Order->id)->count();
		$assignitemcount = OrderItem::where('repair_order_no', $Order->id)
										->where('status', 'Assigned')
										->count();
		

		if($assignitemcount == $itemcount){
			$Order->order_status = "Assigned";
			$Order->save();
		}

		
        return redirect('/repair-order-list')->with('success', 'Order Created Successfully!!');
    }

        public function storeRepairItem(Request $request)
    {
      
	  $request->validate([
			'customer_id' => 'required',  // Validation rule
			'categories1' => 'required',  // Validation rule
		  
		], [
			'customer_id.required' => 'Please Select Customer',  // Custom error message
			'categories1.required' => 'Please Add item',  // Custom error message
		
	  ]);
		
		$Paidtotal = $request->DepositPaidByGold + $request->DepositPaidByCard + $request->DepositPaidByCash;
		//dd($Paidtotal);
		
		$Order = Order::create([
			'customer_id' => $request->customer_id,
			'estimate_amount' => $request->estimateamount,
			'order_status' => "Pending",
			'order_date' => $request->order_date,
			'estimated_delivery_date' => $request->order_due_date,
			'payment_status' => "Pending",
			'paid_amount' => $Paidtotal,
			'created_by' => auth()->id(),
		]);
		
		
		if($request->DepositPaidByGold){
			
			$Order_payment = OrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Gold",
			'invoice_type' => "Order",
			'amount' => $request->DepositPaidByGold,
			'ref_no' => $request->InternalGoldREF,
			]);
		}
		
		if($request->DepositPaidByCard){
			
			$Order_payment = OrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Card",
			'invoice_type' => "Order",
			'amount' => $request->DepositPaidByCard,
			'ref_no' => $request->DepositPaidByCardref,
			]);
		}
		
		
		if($request->DepositPaidByCash){
			
			$Order_payment = OrderPayment::create([
			'customer_id' => $request->customer_id,
			'order_id' => $Order->id,
			'payment_type' => "Cash",
			'invoice_type' => "Order",
			'amount' => $request->DepositPaidByCash,
			]);
		}
		
		 $maxEntries = 20; // Adjust based on the number of items you can receive

		// Loop through each possible item from 1 to max entries
		for ($i = 1; $i <= $maxEntries; $i++) {
		
			if ($request->has("categories$i")) {
			// Create a new model instance for each set of input
			$item = new OrderItem();

			// Assign values from the request to the model's fields
			$item->repair_order_no = $Order->id;
			$item->category = $request->input("categories$i");
			$item->size = $request->input("CategorySize$i");
			$item->shape = $request->input("CategoryShape$i");
			$item->diamond_type = $request->input("Diamondtype$i");
			$item->diamond_shape = $request->input("Diamondshape$i");
			$item->centre_diamond_weight = $request->input("CentreDiamondWeight$i");
			$item->total_diamond_weight = $request->input("TotalDiamondWeight$i");
			$item->matching_wedding_band = $request->input("matching_band$i");
			$item->half_et = $request->input("HalfET$i");
			$item->full_et = $request->input("FullET$i");
			$item->cost_center_diamond = $request->input("CostCentreDiamond$i");
			$item->mount_cost = $request->input("MountCost$i");
			$item->wedding_band_cost = $request->input("WeddingBandCost$i");
			$item->metal_type = $request->input("metal_types$i");
			$item->item_weight = $request->input("weights$i");
			$item->description = $request->input("note$i");
			$item->amount = $request->input("amounts$i");
				
			if ($request->input("form_input_karigar$i") !== null) {
				
				$item->karigar_id = $request->input("form_input_karigar$i");
				$item->status = 'Assigned';
				$item->assigned_date = $request->order_date;
				$item->price = $request->input("karigaramounts$i");
				
			}
			$imagePaths = [];
			
			 if ($request->hasFile("item_image$i")) {
				
				foreach ($request->file("item_image$i") as $image) {
					// Generate a unique filename
					$filename = time() . '-' . $image->getClientOriginalName();

					// Move the file to the public/assets directory
					$image->move(public_path('asset/images/orderitems'), $filename);

					// Set the file permission to 755
					chmod(public_path('asset/images/orderitems/' . $filename), 0755);

					$imagePaths[] = $filename;
				}

				// Construct the JSON string manually
				$jsonImagePaths = '[' . implode(',', array_map(function ($path) {
					return '"' . $path . '"';
				}, $imagePaths)) . ']';
			} else {
				$jsonImagePaths = null;
			}

			$item->photo = $jsonImagePaths;

			// Save the model to the database
			$item->save();

		}
		}
		
		$itemcount = OrderItem::where('repair_order_no', $Order->id)->count();
		$assignitemcount = OrderItem::where('repair_order_no', $Order->id)
										->where('status', 'Assigned')
										->count();
		

		if($assignitemcount == $itemcount){
			$Order->order_status = "Assigned";
			$Order->save();
		}

        return redirect('/repair-items-list')->with('success', 'Repair Order Created Successfully!!');
    }

    
	private function generateBarcode($item)
{
    try {
        // Instantiate the BarcodeGeneratorPNG class
        $generator = new BarcodeGeneratorPNG();
        $barcodeValue = 'RI_' . $item->repair_id;

        // Generate the barcode as a PNG image
        $barcodeImage = $generator->getBarcode($barcodeValue, $generator::TYPE_CODE_128);

        // Define the file path to save the image
        $filePath = 'barcodes/' . $barcodeValue . '.png';

        // Ensure the barcodes directory exists
        if (!file_exists(public_path('barcodes'))) {
            mkdir(public_path('barcodes'), 0777, true);
        }

        // Save the barcode image to the specified path
        file_put_contents(public_path($filePath), $barcodeImage);

        // Update the item's barcode path
        $item->barcode = $filePath;
        $item->save();
    } catch (\Exception $e) {
        // Handle any exceptions that occur
        \Log::error('Error generating barcode: ' . $e->getMessage());
    }
}

    public function showDetails($order_no)
    {
       // Fetch items based on the repair order number
        $order = RepairOrder::where('id', $order_no)->first();
		
        $items = RepairOrderItem::where('repair_order_no', $order_no)->get();
		
		//dd($items);
		$karagirs = Karigar::all();
		

		$orderpayments = RepairOrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = RepairOrderReturnPayment::where('order_id', $order_no)->get();
		
		$orderReturnPaymentsTotal = RepairOrderReturnPayment::where('order_id', $order_no)->sum('amount');
        // Pass the data to a view
        return view('admin.repairs.repair-items-details', compact('items', 'karagirs','order','orderpayments','orderReturnPaymentsTotal','orderreturnpayments'));

    }
	
	
	    public function showCustomerDetails($order_no)
    {
       // Fetch items based on the repair order number
        $order = RepairOrder::where('id', $order_no)->first();
		
        $items = RepairOrderItem::where('repair_order_no', $order_no)->get();
		
		//dd($items);
		$karagirs = Karigar::all();
		

		$orderpayments = RepairOrderPayment::where('order_id', $order_no)->get();
		$orderreturnpayments = OrderReturnPayment::where('order_id', $order_no)->get();
		
		$orderReturnPaymentsTotal = OrderReturnPayment::where('order_id', $order_no)->sum('amount');
        // Pass the data to a view
        return view('admin.repairs.customer-view', compact('items', 'karagirs','order','orderpayments','orderReturnPaymentsTotal','orderreturnpayments'));

    }

    public function repairinvoice($repair_order_no)
    {
        $repairorder =  Order::where('id',$repair_order_no)->first();
		
	
        // Fetch items based on the repair order number
        $customer =  Customers::where('customer_id',$repairorder->customer_id)->first();
		
        $items = OrderItem::where('repair_order_no', $repair_order_no)->get();
		
        $itemstotalamount = OrderItem::where('repair_order_no', $repair_order_no)->sum('amount');

		$karagirs = Karigar::all();
        // Pass the data to a view
        return view('admin.orders.repair-invoice', compact('items','itemstotalamount','customer','repairorder', 'karagirs','repair_order_no'));
    }
	
	
	public function repairorderinvoice($repair_order_no)
    {
        $repairorder =  RepairOrder::where('id',$repair_order_no)->first();
	
        // Fetch items based on the repair order number
        $customer =  Customers::where('customer_id',$repairorder->customer_id)->first();
		
        $items = RepairOrderItem::where('repair_order_no', $repair_order_no)->get();
		
        $itemstotalamount = RepairOrderItem::where('repair_order_no', $repair_order_no)->sum('amount');

		$karagirs = Karigar::all();
        // Pass the data to a view
        return view('admin.orders.repair-invoice', compact('items','itemstotalamount','customer','repairorder', 'karagirs','repair_order_no'));
    }

    public function storeCustomer(Request $request)
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
    
        return redirect(('/repair-items-list'))->with('success', 'Customer Details Added Successfully!');
    }

	
	public function removeItems(Request $request)
    {
		
        // Validate that 'items' is an array of item IDs
        $request->validate([
            'items' => 'required|array',
        ]);

        // Remove the selected items from the database
       $OrderItems = OrderItem::whereIn('repair_id', $request->items)->get();

		foreach($OrderItems as $OrderItem){
			$OrderItem -> status = "Cancel";
				$OrderItem -> save();
		}
		//dd($OrderItems);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Items cancelled successfully.');
    }
	
	
	public function removeRepairItems(Request $request)
    {
		
        // Validate that 'items' is an array of item IDs
        $request->validate([
            'items' => 'required|array',
        ]);

        // Remove the selected items from the database
       $OrderItems = RepairOrderItem::whereIn('repair_id', $request->items)->get();

		foreach($OrderItems as $OrderItem){
			$OrderItem -> status = "Cancel";
				$OrderItem -> save();
		}
		//dd($OrderItems);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Items cancelled successfully.');
    }
	
	public function removeOrder(Request $request)
    {
		
		$repairorder =  Order::where('id', $request->orderid)->first();

		$repairorder->order_status = "Cancel";

		$repairorder->save();
			
		$OrderItems = OrderItem::where('repair_order_no', $request->orderid)->get();

		foreach($OrderItems as $OrderItem){
			$OrderItem -> status = "Cancel";
			$OrderItem -> save();
		}
		
		
		if($request->cardamount){
			
			$Order_payment = OrderReturnPayment::create([
			'customer_id' => $repairorder->customer_id,
			'order_id' => $repairorder->id,
			'payment_type' => "Card",
			'invoice_type' => "Order",
			'amount' => $request->cardamount,
			'ref_no' => $request->DepositPaidByCardref,
			]);
		}
		
		
		if($request->cashamount){
			
			$Order_payment = OrderReturnPayment::create([
			'customer_id' => $repairorder->customer_id,
			'order_id' => $repairorder->id,
			'payment_type' => "Cash",
			'invoice_type' => "Order",
			'amount' => $request->cashamount,
			]);
		}
		
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }
	
	
		public function removeRepairOrder(Request $request)
    {
		
		$repairorder =  RepairOrder::where('id', $request->orderid)->first();

		$repairorder->order_status = "Cancel";

		$repairorder->save();
			
		$OrderItems = RepairOrderItem::where('repair_order_no', $request->orderid)->get();

		foreach($OrderItems as $OrderItem){
			$OrderItem -> status = "Cancel";
			$OrderItem -> save();
		}
		
		
		if($request->cardamount){
			
			$Order_payment = RepairOrderReturnPayment::create([
			'customer_id' => $repairorder->customer_id,
			'order_id' => $repairorder->id,
			'payment_type' => "Card",
			'invoice_type' => "Order",
			'amount' => $request->cardamount,
			'ref_no' => $request->DepositPaidByCardref,
			]);
		}
		
		
		if($request->cashamount){
			
			$Order_payment = RepairOrderReturnPayment::create([
			'customer_id' => $repairorder->customer_id,
			'order_id' => $repairorder->id,
			'payment_type' => "Cash",
			'invoice_type' => "Order",
			'amount' => $request->cashamount,
			]);
		}
		
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }
    
}