<?php

namespace App\Http\Controllers;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Staff;
use App\Models\User;
use App\Models\Customers;
use App\Models\Categories;
use App\Models\ItemType;
use App\Models\Karigar;
use App\Models\Supplier;
use App\Models\StockItems;
use App\Models\MetalRates;
use App\Models\Repairs;
use App\Models\RepairOrder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\RepairOrderItem;
use App\Models\SalesPayment;

use App\Models\Sales;
use App\Models\NCSales;

use Hash;

class AdminController extends Controller
{
    public function getStaffList(Request $request)
    {
        $staffs = User::whereNotNull('access')->paginate();
        return view('admin.staff.staff-list', compact('staffs'));
    }

	public function searchcustomers(Request $request)
	{
		$query = $request->input('query');
		$customers = Customers::where('mobile_no', 'like', '%' . $query . '%')
			->orWhere('first_name', 'like', '%' . $query . '%')
			->orWhere('last_name', 'like', '%' . $query . '%')
			->get();

		return response()->json($customers);
	}
	
	public function showcustomer($id)
	{
		$customer = Customers::where('customer_id',$id)->first();
		
		$customer->countsale = Sales::where('customer_id', $customer->customer_id)->count();
			$customer->countncsale = NCSales::where('customer_id', $customer->customer_id)->count();
			$customer->countorder = Order::where('customer_id', $customer->customer_id)->count();
		

			$customer->totalcost = NCSales::where('customer_id', $customer->customer_id)->sum('total_cost');
			$customer->countrepairorder = RepairOrder::where('customer_id', $customer->customer_id)->count();
			
			$duenccost = NCSales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$saledue = Sales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$customer->dueamount =   $saledue;
			return response()->json($customer);
	}

    public function getAddStaff(Request $request)
    {
        return view('admin.staff.add-staff');
    }

    public function postAddStaff(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'mobile_no' => 'required|string|max:20',
        ]);

        
        $staff = new User();
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->email = $request->email;
        $staff->mobile_no = $request->mobile_no;
		$staff->department = 'staff';
    
        $staff->password = Hash::make($request->password);
    
        // // Handle profile image upload
        // if ($request->hasFile('profile_image')) {
        //     $image = $request->file('profile_image');
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('assets/staff_profile_images'), $imageName);
        //     $staff->profile_image = $imageName;
        // }
    
      
        $staff->access = implode(',', $request->access);
    
        $staff->save();
    
        return redirect('/staff-list')->with('success', 'Staff Added Successfully!');
    }
    

    public function editStaff($id)
    {
        $staff= User::find($id);
        // dd($carclass);
        return view('admin.staff.edit-staff', compact('staff')); 
    }


    public function updateStaff(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'mobile_no' => 'required|string|max:20',
        ]);
        
        // Find the staff member by ID
        $staff = User::findOrFail($request->id);

        // Update the staff member's details
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->email = $request->email;
        $staff->mobile_no = $request->mobile_no;

        // Handle access rights if available
        if ($request->has('access')) {
            $staff->access = implode(',', $request->access);
        }

        // Save the updated details to the database
        $staff->save();

        // Redirect back with a success message
        return redirect('/staff-list')->with('success', 'Staff Updated Successfully');
    }


  

	public function getCustomerList(Request $request)
	{
		$customers = Customers::orderBy('first_name', 'asc')->get();


		// For each customer, calculate the count of sales and attach it to the customer
		foreach ($customers as $customer) {
			$customer->countsale = Sales::where('customer_id', $customer->customer_id)->count();
			$customer->countncsale = NCSales::where('customer_id', $customer->customer_id)->count();
			$customer->countrepairorder = RepairOrder::where('customer_id', $customer->customer_id)->count();
			$customer->totalcost = NCSales::where('customer_id', $customer->customer_id)->sum('total_cost');
			$customer->countorder = Order::where('customer_id', $customer->customer_id)->count();
			
			$duenccost = NCSales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$saledue = Sales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$customer->dueamount =   $saledue;
		}

		return view('admin.customer.customers-list', compact('customers'));
	}
	
	
		public function getDueCustomerList(Request $request)
		{
			// Get all sales with a due amount greater than zero
			$dueSales = Sales::where('due_amount', '>', 0)->get();

			// Initialize an array to hold customer data
			$customerIds = [];

			// Collect unique customer IDs from the due sales
			foreach ($dueSales as $dueSale) {
				$customerIds[] = $dueSale->customer_id;
			}

			// Fetch customers using the unique customer IDs
			$customers = Customers::whereIn('customer_id', $customerIds)->get();
			
					foreach ($customers as $customer) {
			$customer->duecountsale = Sales::where('customer_id', $customer->customer_id)->where('due_amount', '>', 0)->count();
			$customer->countncsale = NCSales::where('customer_id', $customer->customer_id)->count();
			$customer->countrepairorder = Order::where('customer_id', $customer->customer_id)->count();
			$customer->totalcost = NCSales::where('customer_id', $customer->customer_id)->sum('total_cost');
			
			$duenccost = NCSales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$saledue = Sales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$customer->dueamount =  $saledue;
		}

			return view('admin.customer.due-customers-list', compact('customers'));
		}
	
		public function getDueCustomerView($id)
		{
			
			// Initialize an array to hold customer data
			$customerId = $id;

			// Fetch customers using the unique customer IDs
			$customer = Customers::where('customer_id', $customerId)->first();
			
				
			$customer->countsale = Sales::where('customer_id', $customer->customer_id)->count();
			$customer->countncsale = NCSales::where('customer_id', $customer->customer_id)->count();
			$customer->countrepairorder = Order::where('customer_id', $customer->customer_id)->count();
			$customer->totalcost = NCSales::where('customer_id', $customer->customer_id)->sum('total_cost');
			
			$duenccost = NCSales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$saledue = Sales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$customer->dueamount =  $saledue;
		

			$sales = Sales::orderBy('created_at', 'desc')
						->where('customer_id', $customer->customer_id)
						->where('due_amount', '>', 0)
						->get();
			return view('admin.customer.due-customers-view', compact('customer','sales'));
		}

		public function getDueDetailView($id)
		{
			$sale = Sales::where('sale_id', $id)->first();
			// Initialize an array to hold customer data
			$customerId = $sale->customer_id;
			
			$itemIds = explode(',', $sale->item_id);

			$payments = SalesPayment::where('order_id', $id)->get();
			
			// Fetch all items with the matching item IDs
			$items = StockItems::whereIn('item_id', $itemIds)->get();
			//dd($items);
			// Fetch customers using the unique customer IDs
			$customer = Customers::where('customer_id', $customerId)->first();

			$customer->countsale = Sales::where('customer_id', $customer->customer_id)->count();
			$customer->countncsale = NCSales::where('customer_id', $customer->customer_id)->count();
			$customer->countrepairorder = Order::where('customer_id', $customer->customer_id)->count();
			$customer->totalcost = NCSales::where('customer_id', $customer->customer_id)->sum('total_cost');
			
			$duenccost = NCSales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$saledue = Sales::where('customer_id', $customer->customer_id)->sum('due_amount');
			
			$customer->dueamount =  $saledue;
			
			return view('admin.customer.due-detail-view', compact('customer','sale','items','payments'));
	}


    public function getAddCustomer(Request $request)
    {
        return view('admin.customer.create');
    }

    public function postAddCustomer(Request $request)
    {
		
		$request->merge([
			'mobile_no' => str_replace(' ', '', $request->input('mobile_no')),
			'whatsapp_no' => str_replace(' ', '', $request->input('whatsapp_no'))
		]);
		 $request->validate([
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',  
			
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
        $customer->town = $request->town;
        $customer->county = $request->county;
        $customer->note = $request->note;
		
        $customer->post_code = $request->post_code;
        $customer->instagram = $request->instagram;
        $customer->facebook = $request->facebook;
        $customer->tiktok = $request->tiktok;
        $customer->religion = $request->religion;
     
        $customer->save();
    
        return redirect('/customers-list')->with('success', 'Customer Details Added Successfully!');
    }
	
	public function storeAddCustomer(Request $request)
    {
		$request->merge([
			'mobile_no' => str_replace(' ', '', $request->input('mobile_no')),
			'whatsapp_no' => str_replace(' ', '', $request->input('whatsapp_no'))
		]);
		 $request->validate([
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',  
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
        $customer->town = $request->town;
        $customer->county = $request->county;
        $customer->note = $request->note;
		
        $customer->post_code = $request->post_code;
        $customer->instagram = $request->instagram;
        $customer->facebook = $request->facebook;
        $customer->tiktok = $request->tiktok;
        $customer->religion = $request->religion;
     
        $customer->save();
    	return redirect()->back()->with([
        'success' => 'Customer Details Added Successfully!',
        'customer' => $customer
    ]);
    }
    

    public function editCustomer($customer_id)
    {
		
        $customer= Customers::find($customer_id);
        // dd($carclass);
        return view('admin.customer.edit-customer', compact('customer')); 
    }

    public function updateCustomer(Request $request)
	{
		$request->merge([
			'mobile_no' => str_replace(' ', '', $request->input('mobile_no')),
			'whatsapp_no' => str_replace(' ', '', $request->input('whatsapp_no'))
		]);
		$request->validate([
			'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
			'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
			'date_of_birth' => 'nullable|date',
			'gender' => 'nullable|string|max:10',
			'mobile_no' => [
				'required',
				'string',
				'max:15', // Use max:15 for the mobile number length
				 // Only numbers allowed for mobile number
				Rule::unique('customers')->ignore($request->customer_id, 'customer_id')
			],
			'email' => 'nullable|email|max:255',
			'whatsapp_no' => 'nullable|string|max:15',
			'address' => 'nullable|string|max:255',
		]);

		$dataId = $request->customer_id;
		$customer = Customers::find($dataId);

		// Update the customer data
		$customer->first_name = $request->first_name;
		$customer->last_name = $request->last_name;
		$customer->date_of_birth = $request->date_of_birth;
		$customer->gender = $request->gender;
		$customer->mobile_no = $request->mobile_no;
		$customer->email = $request->email;
		$customer->whatsapp_no = $request->whatsapp_no;
		$customer->address = $request->address;
		$customer->town = $request->town;
		$customer->note = $request->note;
		$customer->county = $request->county;
		
        $customer->post_code = $request->post_code;
        $customer->instagram = $request->instagram;
        $customer->facebook = $request->facebook;
        $customer->tiktok = $request->tiktok;
        $customer->religion = $request->religion;

		$customer->save();
		return redirect('/customers-list')->with('success', 'Customer Updated Successfully');
	}
	
	 public function viewCustomer($customer_id)
    {
        $customer= Customers::find($customer_id);
        $Orders = Order::where('customer_id', $customer_id)->get();
		 $RepairOrders = RepairOrder::where('customer_id', $customer_id)->get();
        $sales = Sales::where('customer_id', $customer_id)
              ->where('due_amount', '>', 0)
              ->get();

		$ncsales = NCSales::where('customer_id', $customer_id)->get();
        return view('admin.customer.view-customer', compact('customer','Orders','sales','ncsales','RepairOrders')); 
    }

   public function getRatesList(Request $request)
   {
        $rates = MetalRates::all();
        $itemTypes = ItemType::all();
        return view('admin.metalRates.metal-rates', compact('rates','itemTypes'));
   }

   public function postRate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'metal_type' => 'required|string|max:255',
            'purity' => 'required|integer|in:18,22,24',
            'date' => 'required|date',
            'rate' => 'required|numeric',
        ]);

        // Check if a rate for the given metal type, purity, and date already exists
        $existingRate = MetalRates::where('metal_type', $request->metal_type)
            ->where('purity', $request->purity)
            ->where('date', $request->date)
            ->first();

        if ($existingRate) {
            // If the rate exists, update it
            $existingRate->rate = $request->rate;
            $existingRate->save();

            return redirect()->back()->with('success', 'Rate updated successfully!');
        } else {
            // If the rate doesn't exist, create a new record
            MetalRates::create([
                'metal_type' => $request->metal_type,
                'purity' => $request->purity,
                'date' => $request->date,
                'rate' => $request->rate,
            ]);

            return redirect()->back()->with('success', 'New rate added successfully!');
        }
    }

    public function editRate($metal_id)
    {
        $rates= MetalRates::find($metal_id);
        return view('admin.metalRates.edit-metal-rate', compact('rates'));
    }

    public function updateRate(Request $request, $metal_id)
    {
        // Validate the incoming request
        $request->validate([
            'rate' => 'required|numeric',
        ]);

        // Find the metal rate by ID
        $rate = MetalRates::find($metal_id);
        // dd($rate);
        if ($rate) {
            // Update the rate
            $rate->rate = $request->input('rate');
            $rate->save();

            return redirect('/metal-rates-list')->with('success', 'Rate updated successfully!');
        } else {
            return redirect('/metal-rates-list')->with('error', 'Rate not found.');
        }
    }


	public function getSupplierList(Request $request)
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.supplier-list', compact('suppliers'));
    }
	
	public function addSupplier(Request $request)
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.create', compact('suppliers'));
    }

    public function postAddSupplier(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
        ]);
		    
            $supplier = new Supplier();
            $supplier->full_name = $request->full_name;
            $supplier->email = $request->email;
            $supplier->mobile_no = $request->mobile_no;
            $supplier->address = $request->address;
            $supplier->company = $request->company;
		
            $supplier->note = $request->note;
            $supplier->country = $request->country;
            $supplier->post = $request->post;
            $supplier->city = $request->city;
            $supplier->town = $request->town;
		
            $supplier->supplier_code = $request->supplier_code;
            $supplier->contact_person_name = $request->contact_person_name;
            $supplier->save();
    
            return redirect('/supplier-list')->with('success', 'Supplier Added Successfully!!');
    }

    public function editSupplier($supplier_id)
    {
        $supplier= Supplier::find($supplier_id);
        // dd($carclass);
        return view('admin.supplier.edit-supplier', compact('supplier')); 
    }
	
	    public function viewSupplier($supplier_id)
    {
        $supplier= Supplier::find($supplier_id);
        // dd($carclass);
        return view('admin.supplier.view', compact('supplier')); 
    }

    public function updateSupplier(Request $request)
    {
       $request->validate([
            'full_name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $dataId = $request->supplier_id;
        $supplier = Supplier::find($dataId);
        	$supplier->full_name = $request->full_name;
            $supplier->email = $request->email;
            $supplier->mobile_no = $request->mobile_no;
            $supplier->address = $request->address;
            $supplier->company = $request->company;
            $supplier->note = $request->note;
            $supplier->country = $request->country;
            $supplier->post = $request->post;
            $supplier->city = $request->city;
            $supplier->town = $request->town;
            $supplier->supplier_code = $request->supplier_code;
            $supplier->contact_person_name = $request->contact_person_name;
        	$supplier->save();
        return redirect('/supplier-list')->with('success', 'Supplier Updated Successfully');
    }

    public function getKarigarList(Request $request)
{
    $karagirs = Karigar::all();
    
    foreach($karagirs as $karigir) {
        $karigir->count = OrderItem::where('karigar_id', $karigir->karigar_id)->count(); // Use $karigir->id instead of $karigar_id
    }
		
	foreach($karagirs as $karigir) {
        $karigir->repaircount = RepairOrderItem::where('karigar_id', $karigir->karigar_id)->count(); // Use $karigir->id instead of $karigar_id
    }
    
    return view('admin.karagir.karagir-list', compact('karagirs'));
}


    public function getAddKarigar(Request $request)
    {
		$karagirs = Karigar::all();
    
    foreach($karagirs as $karigir) {
        $karigir->count = OrderItem::where('karigar_id', $karigir->karigar_id)->count(); // Use $karigir->id instead of $karigar_id
    }
        return view('admin.karagir.add-karagir', compact('karagirs'));
    }

    public function postAddKarigar(Request $request)
    {
        $request->validate([
            'karigar_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',  
        ]);

        $karagir = new Karigar();

        $karagir->karigar_name = $request->karigar_name;
        $karagir->email = $request->email;
        $karagir->contact_no = $request->contact_no;
        $karagir->address = $request->address;
        $karagir->specialization = $request->specialization;
        $karagir->status = $request->status;
        $karagir->karigar_nick_name = $request->karigar_nick_name;
		

        $karagir->save();

        return redirect('/karigar-list')->with('success', 'Karagir Added Successfully!!');
    }

    public function editkarigar($karigar_id)
    {
        $karagir= Karigar::find($karigar_id);
        // dd($carclass);
        return view('admin.karagir.edit-karagir', compact('karagir')); 
    }

    public function updatekarigar(Request $request)
    {
        $request->validate([
            'karigar_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_no' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
        ]);
        

        $dataId = $request->karigar_id;
        $karagir = Karigar::find($dataId);

        $karagir->karigar_name = $request->karigar_name;
        $karagir->email = $request->email;
        $karagir->contact_no = $request->contact_no;
        $karagir->address = $request->address;
        $karagir->specialization = $request->specialization;
        $karagir->status = $request->status;

        $karagir->save();
        return redirect('/karigar-list')->with('success', 'Karagir Updated Successfully');
    }
	
	 public function getAssignedItemsList($karigar_id)
    {
        $karagirs = Karigar::where('karigar_id', $karigar_id)->first();
        $Orderitems = OrderItem::where('karigar_id', $karigar_id)->get();
		 $RepairOrderitems = RepairOrderItem::where('karigar_id', $karigar_id)->get();
//dd($Orderitems);
        return view('admin.karagir.view-karagir-items', compact('karagirs','Orderitems','RepairOrderitems')); 
    }
	
		 public function settleKarigarAccount($karigar_id)
    {
        $karagirs = Karigar::where('karigar_id', $karigar_id)->first();
        $Orderitems = OrderItem::where('karigar_id', $karigar_id)->get();
		 $RepairOrderitems = RepairOrderItem::where('karigar_id', $karigar_id)->get();
//dd($Orderitems);
        return view('admin.karagir.settleaccount', compact('karagirs','Orderitems','RepairOrderitems')); 
    }

    public function updateStatus(Request $request, $karigar_id)
    {
        // Validate the incoming request
        $request->validate([
            'status' => 'required|in:complete,incomplete',
        ]);
    
        // Find the karagir record
        $karagir = Repairs::where('repair_id', $karigar_id)->first();
    
        if ($karagir) {
            // Update the status
            $karagir->status = $request->status;
            $karagir->save();
    
            return redirect()->back()->with('success', 'Status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Repair item not found.');
        }
    }


}