<?php

namespace App\Http\Controllers;
 use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Categories;
use App\Models\ItemType;
use App\Models\StockItems;
use App\Models\Customers;

class PurchaseController extends Controller
{
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

    public function getPurchaseList(Request $request)
    {
        $purchases = Purchase::all();
        $suppliers = Supplier::all();
        $categories =  Categories::all();
        $itemTypes = ItemType::all();

        $purchaseId =  Purchase::latest('purchase_id')->pluck('purchase_id')->first();
        return view('admin.purchase.purchase-list',compact('purchases','suppliers','categories','itemTypes','purchaseId'));
    }
	
	    public function createAddPurchase(Request $request)
    {
        $purchases = Purchase::all();
        $suppliers = Supplier::all();
        $categories =  Categories::all();
        $itemTypes = ItemType::all();

        $purchaseId =  Purchase::latest('purchase_id')->pluck('purchase_id')->first();
        return view('admin.purchase.create',compact('purchases','suppliers','categories','itemTypes','purchaseId'));
    }

    public function postAddPurchase(Request $request)
    {
       
        // Return response with the new purchase ID to handle item addition
        return response()->json(['purchase_id' => $purchase->purchase_id]);
    }


     public function getPurchaseItemList($purchase_id)
     {
        $purchase= Purchase::find($purchase_id);
		 
		$supplier = $purchase->suppliers->full_name; 
		 
        $stockItems = StockItems::where('purchase_id', $purchase->purchase_id)->get();
        $totalAmount = $stockItems->sum('amount');
		 
	
        $categories =  Categories::all();
        $itemTypes = ItemType::all();

        $hasStockItems = $stockItems->isNotEmpty();
         return view('admin.purchase.purchase-items', compact('purchase','categories','itemTypes','stockItems','hasStockItems','totalAmount','supplier')); 
     }
	
 
	public function storePurchaseItem(Request $request)
	{
		
		 $request->validate([
          'po_number' => 'required|unique:purchase,po_number',
			'supplier' => 'required|string',
			'date' => 'required|date',
        ]);

		// Save the purchase
		$purchase = new Purchase();
		$purchase->po_number = $request->po_number;
		$purchase->supplier = $request->supplier;
		$purchase->date = $request->date;
		$purchase->save();

		// Get the purchase ID
		$purchaseId = $purchase->purchase_id;

		// Get the items from the request
		$categories = $request->input('categories');
		$metalTypes = $request->input('metal_types');
		$purities = $request->input('purities', []);
		$weights = $request->input('weights', []);
		$locations = $request->input('locations', []);
		$subLocations = $request->input('sub_locations', []);
		$quantities = $request->input('quantities', []);
		$amounts = $request->input('amounts', []);

		// Check if all arrays are of the same length
		$length = count($categories);

		// Loop through each item
		for ($index = 0; $index < $length; $index++) {
			$quantity = $quantities[$index] ?? 1; // Default to 1 if not provided

			// Create entries based on the quantity
			for ($q = 0; $q < $quantity; $q++) {
				$purchaseItem = new StockItems();
				$purchaseItem->purchase_id = $purchaseId; // Link item to the purchase
				$purchaseItem->category = $categories[$index] ?? null;
				$purchaseItem->metal_type = $metalTypes[$index] ?? null;
				$purchaseItem->purity = $purities[$index] ?? null;
				$purchaseItem->item_weight = $weights[$index] ?? null;
				$purchaseItem->amount = $amounts[$index] ?? null;
				$purchaseItem->location = 'purchase';
				$purchaseItem->sub_location = 'purchase';
				$purchaseItem->quantity = 1; // Set quantity to 1 for each entry
				$purchaseItem->save();
				
				 // Generate barcode for the newly created item
           	 	$this->generateBarcode($purchaseItem);
			}
		}

		// Redirect with success message
		return redirect('/purchase-list')->with('success', 'Items Added Successfully!');
	}

	private function generateBarcode($item)
	{
		// Instantiate the BarcodeGeneratorPNG class
		$generator = new BarcodeGeneratorPNG();
		$barcodeValue = $item->item_id; // Ensure this is the correct property for the item ID

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
	}    
    
}