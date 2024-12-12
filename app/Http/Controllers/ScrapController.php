<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\ItemType;
use App\Models\Customers;
use App\Models\ScrapGold;
use App\Models\ScrapGoldItems;

class ScrapController extends Controller
{
    public function getScrapGold(Request $request)
    {
       $scrapgolds = ScrapGold::orderBy('scrap_id', 'desc')->get();
        return view('admin.scrap.scrap-gold-list', compact('scrapgolds'));
    } 
    
    public function getAddScrapGold(Request $request)
    {
        $categories = Categories::all();
        $itemTypes = ItemType::all();
        return view('admin.scrap.add-scrap-gold',compact('categories','itemTypes'));
    }
    
    public function searchMobileNumber(Request $request)
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

    public function addNewCustomer(Request $request)
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

    public function getPurityDetails($itemTypeId)
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

    public function postScrapGold(Request $request)
    {
		//dd($request);
		$request->validate([
            'customer_id' => 'required',
            'grand_total' => 'required',
        ]);
		
        $scrap = new ScrapGold();
    
        $scrap->customer_id = $request->customer_id;
        $scrap->grand_total = $request->grand_total;
		
		$deuamount = $request->grand_total - $request->cashAmount;
		
		$scrap->due_amount = $deuamount;
			
		if($request->grand_total <= $request->cashAmount){
        	$scrap->status = "complete";
		}
		
		if($request->grand_total > $request->cashAmount){
        	$scrap->status = "pending";
		}
		
        $scrap->save();
    
        $scrapId = $scrap->scrap_id; 

        $categories = $request->input('categories', []);
        $itemPurity = $request->input('purities', []);
        $itemMetalType = $request->input('metal_types', []);
        $itemWeight = $request->input('item_weight', []);
        $amounts = $request->input('amount', []);

        $newItems =  $request;
      
        // Get the length of the arrays (assuming all arrays are of the same length)
        $length = max(count($categories), count($itemMetalType), count($itemPurity), count($itemWeight), count($amounts));
    
        // Loop through each item
        for ($index = 0; $index < $length; $index++) {
            // Create a new repair item instance
            $scrapItem = new ScrapGoldItems();
            $scrapItem->scrap_id = $scrapId;
            $scrapItem->category = $categories[$index] ?? null;
            $scrapItem->purity =$itemPurity[$index] ?? null;
            $scrapItem->metal_type = $itemMetalType[$index] ?? null;
            $scrapItem->item_weight = $itemWeight[$index] ?? null;
            $scrapItem->amount = $amounts[$index] ?? null;
            $scrapItem->save();
        }
    
        return redirect('/scrap-gold')->with('success', 'Scrap Gold Added Successfully!!');
    }

    public function viewScrapItems($scrap_id)
    {
        $scrapItems = ScrapGoldItems::where('scrap_id', $scrap_id)->get();

        return view('admin.scrap.view-scrap-items', compact('scrapItems')); 
    }
    
}
