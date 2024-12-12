<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use App\Models\Customers;
use App\Models\Categories;
use App\Models\ItemType;
use App\Models\Karigar;
use App\Models\Supplier;
use App\Models\StorageLocation;
use App\Models\SubLocation;
use App\Models\StockItems;
use App\Models\MetalRates;
use App\Models\StockOut;
use App\Models\StockIn;
use App\Models\CategorySize;
use App\Models\CategoryShape;
use App\Models\DiamondType;
use App\Models\DiamondShape;


class StockController extends Controller
{
    
    public function getCategoryList(Request $request)
    {
        $categories = Categories::all();
        return view('admin.category.catgeories-list', compact('categories'));
    }
	
	public function createCategory(Request $request)
    {
        $categories = Categories::all();
        return view('admin.category.create', compact('categories'));
    }

    public function postCategory(Request $request)
    {
		 // Validation
        $request->validate([
            'category_name' => 'required|unique:categories,category_name|regex:/^[a-zA-Z\s]+$/',
            'category_description'      => 'required|max:255',
        ]);
        $categories = new Categories();

        $categories->category_name = $request->category_name;
        $categories->category_description = $request->category_description;
        

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('asset/categories_images'), $imageName);
            $categories->category_image = $imageName;
        }

        $categories->save();

        return redirect('/categories-list')->with('success', 'Category Added Successfully!');

    }

    public function editCategory($category_id)
    {
        $category= Categories::find($category_id);
        return view('admin.category.edit-category', compact('category')); 
    }

    public function updateCategory(Request $request)
    {
		$request->validate([
			'category_name' => [
				'required',
				Rule::unique('categories')->ignore($request->category_name, 'category_name'),
				'regex:/^[a-zA-Z\s]+$/',
			],
			'category_description' => 'required|max:255',
		]);
        $dataId = $request->category_id;
        $category = Categories::find($dataId);

        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
       

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('asset/categories_images'), $imageName);
            $category->category_image = $imageName;
        }

        $category->save();

        return redirect('/categories-list')->with('success', 'Category Updated Successfully');
    }

    public function getCategorySizeList(Request $request)
    {
        $categories = Categories::all();
        $sizes = CategorySize::all();
        return view('admin.categorysize.catgeories-size-list', compact('categories','sizes'));
    }
	
	    public function createCategorySizeList(Request $request)
    {
        $categories = Categories::all();
        $sizes = CategorySize::all();
        return view('admin.categorysize.create', compact('categories','sizes'));
    }

    public function postCategorySize(Request $request)
    {
		 // Validation
        // Validate the request data
        $validatedData = $request->validate([
            'category' => 'required|exists:categories,category_id', // Ensure the category exists
            'category_size' => 'required|string', // Assume the size is provided as a string
        ]);

        // Create a new category size record
        CategorySize::create([
            'category_id' => $validatedData['category'], // Associate with the correct category
            'size' => $validatedData['category_size'],
        ]);

        return redirect()->back()->with('success', 'Category size added successfully!');

    }

    public function editCategorySize($category_id)
    {
        $size = CategorySize::find($category_id);
        return view('admin.categorysize.edit-category-size', compact('size')); 
    }

    public function updateCategorySize(Request $request , $category_id)
    {
        
		$request->validate([
			'category_description' => 'required|max:255',
		]);

        $size = CategorySize::find($category_id);
       
        $size->size = $request->category_description;

        $size->save();

        return redirect('/categories-size-list')->with('success', 'Category Size Updated Successfully');
    }

    public function getCategoryshapeList(Request $request)
    {
        $categories = Categories::all();
        $shapes = CategoryShape::all();
        return view('admin.categoryshape.catgeories-shape-list', compact('categories','shapes'));
    }
	
	    public function createCategoryshapeList(Request $request)
    {
        $categories = Categories::all();
        $shapes = CategoryShape::all();
        return view('admin.categoryshape.create', compact('categories','shapes'));
    }

    public function postCategoryshape(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|exists:categories,category_id', // Ensure the category exists
            'category_shape' => 'required|string', // Assume the size is provided as a string
        ]);

        // Create a new category size record
        CategoryShape::create([
            'category_id' => $validatedData['category'], // Associate with the correct category
            'shape' => $validatedData['category_shape'],
        ]);

        return redirect()->back()->with('success', 'Category shape added successfully!');
    }

    public function editCategoryshape($category_id)
    {
        $shape = CategoryShape::find($category_id);
        return view('admin.categoryshape.edit-category-shape', compact('shape')); 
    }

    public function updateCategoryshape(Request $request , $category_id)
    {
		$request->validate([
			'category_shape' => 'required|max:255',
		]);

        $shape = CategoryShape::find($category_id);
       
        $shape->shape = $request->category_shape;

        $shape->save();

        return redirect('/categories-shape-list')->with('success', 'Category Shape Updated Successfully');
    }


    public function getdiamondshapeList(Request $request)
    {
        $diamondshapes = DiamondShape::all();
        return view('admin.diamondshape.diamond-shape-list', compact('diamondshapes'));
    }
	
	public function creatediamondshapeList(Request $request)
    {
        $diamondshapes = DiamondShape::all();
        return view('admin.diamondshape.create', compact('diamondshapes'));
    }

    public function postdiamondshape(Request $request)
    {
        $validatedData = $request->validate([
            'diamond_shape' => 'required|string', // Assume the size is provided as a string
        ]);

        // Create a new category size record
        DiamondShape::create([
            'shape' => $validatedData['diamond_shape'],
        ]);

        return redirect()->back()->with('success', 'Diamond shape added successfully!');
    }

    public function editdiamondshape($category_id)
    {
        $diamondshape = DiamondShape::find($category_id);
        return view('admin.diamondshape.edit-diamond-shape', compact('diamondshape')); 
    }

    public function updatediamondshape(Request $request , $diamondshape_id)
    {
		$request->validate([
			'diamond_shape' => 'required|max:255',
		]);

        $shape = DiamondShape::find($diamondshape_id);
       
        $shape->shape = $request->diamond_shape;

        $shape->save();

        return redirect('/diamond-shape-list')->with('success', 'Diomand Shape Updated Successfully');
    }


    public function getdiamondsizeList(Request $request)
    {
        $diamondtypes = DiamondType::all();
        return view('admin.diamondtype.diamond-type-list', compact('diamondtypes'));
    }
	
	public function creatediamondsize(Request $request)
    {
        $diamondtypes = DiamondType::all();
        return view('admin.diamondtype.create', compact('diamondtypes'));
    }

    public function postdiamondsize(Request $request)
    {
        $validatedData = $request->validate([
            'diamond_type' => 'required', // Ensure the category exists
             // Assume the size is provided as a string
        ]);

        // Create a new category size record
        DiamondType::create([
            'type' => $validatedData['diamond_type'], // Associate with the correct category
        ]);

        return redirect()->back()->with('success', 'Diamond type added successfully!');
    }

    public function editdiamondsize($category_id)
    {
        $diamondtype = DiamondType::find($category_id);
        return view('admin.diamondtype.edit-diamond-type', compact('diamondtype')); 
    }

    public function updatediamondsize(Request $request , $diamondsize_id)
    {
		$request->validate([
			'diamond_type' => 'required|max:255',
		]);

        $shape = DiamondType::find($diamondsize_id);
       
        $shape->type = $request->diamond_type;

        $shape->save();

        return redirect('/diamond-type-list')->with('success', 'Diamond Type Updated Successfully');
    }

    public function getCategoryDetails($category_id)
    {
        // Get the category information
        $category = Categories::where('category_id', $category_id)->first();
    
        // Initialize sizes and shapes based on category_id
        $sizes = CategorySize::where('category_id', $category_id)->pluck('size', 'id');
        $shapes = CategoryShape::where('category_id', $category_id)->pluck('shape', 'id');
    
        // Check if category name contains "diamond"
        if (strpos(strtolower($category->category_name), 'diamond') !== false) {
            // Fetch diamond types and shapes
            $diamondtypes = DiamondType::get()->pluck('type', 'id');
            $diamondshapes = DiamondShape::get()->pluck('shape', 'id');
        } else {
            // Set diamond types and shapes to empty arrays
            $diamondtypes = [];
            $diamondshapes = [];
        }
    
        // Return response with sizes, shapes, and diamond types and shapes (if applicable)
        return response()->json([
            'sizes' => $sizes,
            'shapes' => $shapes,
            'diamondtypes' => $diamondtypes,
            'diamondshapes' => $diamondshapes,
        ]);
    }
    

    public function getStorageList(Request $request)
    {
        $locations = StorageLocation::all();
        return view('admin.storageLocation.storage-location-list', compact('locations'));
    }
	
	public function addlocationStorageList(Request $request)
    {
        $locations = StorageLocation::all();
        return view('admin.storageLocation.createlocation', compact('locations'));
    }

    public function postStorageList(Request $request)
    {
        // Validation
        $request->validate([
            'location_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/|unique:storage_location,location_name',
            'description'   => 'nullable|string|max:1000',
        ]);

        // Creating a new StorageLocation
        $location = new StorageLocation();

        $location->location_name = $request->location_name;
        $location->description = $request->description;
        $location->save();

        return redirect('/locations-list')->with('success', 'Location Added Successfully!');
    }

    public function editLocation($location_id)
    {
        $location = StorageLocation::find($location_id);
        return view('admin.storageLocation.edit-location', compact('location')); 
    }


    public function updateStorageLocation(Request $request)
    {
        // Validation
      $request->validate([
            'location_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'description'   => 'nullable|string|max:1000',
        ]);

        // Finding the existing StorageLocation
        $dataId = $request->location_id;
        $location = StorageLocation::find($dataId);

        // Updating the StorageLocation
        $location->location_name = $request->location_name;
        $location->description = $request->description;
        $location->save();

        return redirect('/locations-list')->with('success', 'Location Updated Successfully');
    }

    public function getSubLocationList(Request $request)
    {
       
        $sublocations = SubLocation::all();
        $locations = StorageLocation::all();

        return view('admin.storageLocation.sub-location-list', compact('sublocations', 'locations'));
    }
	
	
	    public function createSubLocation(Request $request)
    {
       
        $sublocations = SubLocation::all();
        $locations = StorageLocation::all();

        return view('admin.storageLocation.createsublocation', compact('sublocations', 'locations'));
    }

    public function postSubLocationList(Request $request)
    {
		 
        // Validation
        $request->validate([
            'sub_location_name' => 'required|unique:sub_locations,sub_location_name|regex:/^[a-zA-Z\s]+$/',
            'weight'      => 'required',
			'capacity' => 'required|min:1',
			'location' => 'required',
        ]);

        $sub_location = new SubLocation();

        $sub_location->sub_location_name = $request->sub_location_name;
        $sub_location->location = $request->location;
        $sub_location->capacity = $request->capacity;
        $sub_location->weight = $request->weight;

        $sub_location->save();

        return redirect('/sub-locations-list')->with('success', 'Sub Location Added Successfully!');
    }

    public function editSubLocation($sub_location_id)
    {
		
		
        $sub_location = SubLocation::find($sub_location_id);
        $locations = StorageLocation::all();
        return view('admin.storageLocation.edit-sub-location', compact('sub_location','locations')); 
    }


    public function updateSubLocation(Request $request)
    {
        // Validation
        $request->validate([
            'sub_location_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'weight'      => 'required',
			'capacity' => 'required|min:1',
			'location' => 'required',
        ]);
		
		
		$count = StockItems::where('location',$request->location)->count();
		
		if($count <= $request->capacity){
			
        $dataId = $request->sub_location_id;
        $sub_location = SubLocation::find($dataId);

        $sub_location->sub_location_name = $request->sub_location_name;
        $sub_location->weight = $request->weight;
        $sub_location->location = $request->location;
        $sub_location->capacity = $request->capacity;

        $sub_location->save();

        return redirect('/sub-locations-list')->with('success', 'Sub Location Updated Successfully');
		
		}else{
        return redirect('/sub-locations-list')->with('error', 'Capacity should be greater than pre-assigned items!!');
			
		}

    }

    public function getStockFilling(Request $request)
    {
        $sublocations = SubLocation::all();
        $locations = StorageLocation::all();
	
		
        return view('admin.stockItems.stock-filling', compact('sublocations', 'locations'));
    }

public function postStockFilling(Request $request)
    {
        $subLocationId = $request->input('sub_location_id');
        $itemIds = explode(',', $request->input('item_ids'));
        
        $alreadyAssignedItems = []; // To collect already assigned item IDs
        $customerAssignedItems = []; // To collect items that are already assigned to 'Customer'
		$ncAssignedItems = [];  // To collect items that are already assigned to 'NC SALE'
        foreach ($itemIds as $itemId) {
            $item = StockItems::find($itemId);
            
            if ($item) {
                if ($item->sub_location == $subLocationId) {
                    // If the item is already in the specified sub-location
                    $alreadyAssignedItems[] = $itemId;
                } elseif ($item->sub_location == 'Customer') {
                    // If the item is already assigned to 'Customer'
                    $customerAssignedItems[] = $itemId;
                }elseif ($item->sub_location == 'NC') {
                    // If the item is already assigned to 'NC'
                    $ncAssignedItems[] = $itemId;
                } else {
                    // Update the sub-location of the item
                    $item->sub_location = $subLocationId;
                    $item->save();
                }
            }
        }
        
        if (!empty($alreadyAssignedItems)) {
            $alreadyAssignedIds = implode(', ', $alreadyAssignedItems);
            return redirect()->back()->with('error', "Item(s) with ID {$alreadyAssignedIds} are already in this sub-location.");
        }
        
        if (!empty($customerAssignedItems)) {
            $customerAssignedIds = implode(', ', $customerAssignedItems);
            return redirect()->back()->with('error', "Item(s) with ID {$customerAssignedIds} is already Sale'.");
        }
	
		  if (!empty($ncAssignedItems)) {
            $ncAssignedItemsIds = implode(', ', $ncAssignedItems);
            return redirect()->back()->with('error', "Item(s) with ID {$ncAssignedItemsIds} is already NC Sale'.");
        }
        
    
        return redirect()->back()->with('success', 'Stock items updated successfully.');
    }

    public function fetchSublocations($location_id)
    {
        $subLocations = SubLocation::where('location', $location_id)->get();
        return response()->json($subLocations);
    }

    public function showStockItems($subLocationId)
    {
        $sublocation = Sublocation::findOrFail($subLocationId);
        $stockItems = StockItems::where('sub_location', $subLocationId)->get();

        return view('admin.storageLocation.view-stock-items', compact('sublocation', 'stockItems'));
    }

    public function getItemsExcludingSubLocation($subLocationId)
    {
        $excludedItemsIds = StockItems::where('sub_location', $subLocationId)
                                         ->pluck('item_id')
                                         ->toArray();

        
        $filteredItems = StockItems::whereNotIn('item_id', $excludedItemsIds)
                                    ->with(['location', 'subLocation'])
                                    ->get();
        
        return response()->json($filteredItems);
    }
	
	public function getItemsLocations($itemId)
	{
		$filteredItems = StockItems::where('item_id', $itemId)
			->with(['location', 'subLocation'])
			->first();

		if ($filteredItems && $filteredItems->location === 'purchase'  && $filteredItems->sub_location === 'purchase') {
			
			$response = $filteredItems->toArray(); // Convert model to an array

			// Modify location and sub-location names
			$response['location']['location_name'] = 'purchase';
			$response['sub_location']['sub_location_name'] = 'purchase';

			return response()->json($response);
			
		}

		return response()->json($filteredItems);
	}


    public function fill(Request $request, $subLocationId)
    {
        $subLocation = SubLocation::findOrFail($subLocationId);
        return response()->json([
            'sub_location_name' => $subLocation->sub_location_name,
            'success' => true
        ]);
    }

   

    public function getStockItems(Request $request)
    {
        $items = StockItems::with(['location', 'subLocation'])->get();
		$suppliers = Supplier::all();
        $categories = Categories::all();
        $itemTypes = ItemType::all();
        $storageLocations = StorageLocation::all();
        $subLocations = SubLocation::all();
        return view('admin.stockItems.items-list', compact('items','categories','itemTypes','storageLocations','subLocations','suppliers'));
    }
	
	 public function assign(Request $request)
	{
		$itemIds = explode(',', $request->input('item_ids', '')); 
		$itemIds = array_map('intval', $itemIds); 

		$itemscount = count($itemIds); 
		
		$sublocation = Sublocation::where('sub_location_id',$request->sub_location)->first();
		
		$stockcount = StockItems::where('sub_location',$request->sub_location)->count();
		
		$count = $sublocation->capacity - $stockcount ;

		if($itemscount <= $count){
		// Update all selected stock items
		StockItems::whereIn('item_id', $itemIds)->update([
			'location' => $request->input('location'),
			'sub_location' => $request->input('sub_location'),
			'assign' => 1,
		]);

		return redirect('/items-list')->with('success', 'Selected items have been assigned.');
		}else{
		return redirect('/items-list')->with('error', 'Sublocation remaining capacity is =' .$count);
		}
	}


    public function postAddStockItems(Request $request)
    {
        
        $item = new StockItems();
        
        // Assign the request data to the item model
		$item->supplier_id = $request->supplier_id;
        $item->item_sku = $request->item_sku;
        $item->item_description = $request->item_description;
        $item->item_location = $request->item_location;
        $item->sub_location = $request->sub_location;
        $item->category = $request->category;
        $item->material = $request->material;
        $item->purity = $request->purity;
        $item->item_weight = $request->item_weight;

        
        // Save the item to generate the ID
        $item->save();
	
        $ids = auth()->id();
		
		$stockIn = new StockIn();
		$stockIn->item_name = $request->item_name;
		$stockIn->supplier_id = $request->supplier_id;
		$stockIn->created_by = $ids;
		
		$stockIn->save();
       

        $metalMarketPrice = MetalRates::where('metal_type', $request->material)->first();
        // dd($metalMarketPrice->rate);

        if ($metalMarketPrice) {
            if ($request->purity == 24) {
                // Directly take the rate price from MetalRates table
                $itemPerPrice = $metalMarketPrice->rate;
            } elseif ($request->purity == 18 || $request->purity == 22) {
                // Apply the calculation based on purity
                $itemPerPrice = ($metalMarketPrice->rate * $request->purity) / 24;
            } else {
                $itemPerPrice = null; 
            }
        
        } 
      

        return redirect('/items-list')->with('success', 'Stock Item Added Successfully!!');
    }
	
	  public function editItem($item_id)
    {
        $item = StockItems::find($item_id);
        $categories = Categories::all();
        $storageLocations = StorageLocation::all();
        $subLocations = SubLocation::all();
        $itemTypes = ItemType::all();
        return view('admin.stockItems.edit-item', compact('item','categories','storageLocations','subLocations','itemTypes')); 
    }


    public function updateItem(Request $request)
    {

        $item = StockItems::findOrFail($request->item_id);

        $item->item_sku = $request->item_sku;
        $item->item_description = $request->item_description;
        $item->item_location = $request->item_location;
        $item->sub_location = $request->sub_location;
        $item->category = $request->category;
        $item->material = $request->material;
        $item->purity = $request->purity;
        $item->item_weight = $request->item_weight;

        // Save the updated details to the database
        $item->save();

        // Redirect back with a success message
        return redirect('/items-list')->with('success', 'Item Updated Successfully');
    }
    
    public function getStockAdjustmentList(Request $request)
    {
         $stocks = StockOut::all();
        $items = StockItems::where('sub_location', '6')->get();
		$bags = StockItems::where('sub_location', '!=', '6')->get();
		
        $staffs = User::all();
        $storageLocations = StorageLocation::all();
        return view('admin.stockItems.stock-adjustment-list', compact('stocks','items','staffs','bags','storageLocations'));
    }
	
	    public function stockAdjustment(Request $request)
    {
         $stocks = StockOut::all();
        $items = StockItems::where('sub_location', '6')->get();
		$bags = StockItems::where('sub_location', '!=', '6')->get();
		
        $staffs = User::all();
        $storageLocations = StorageLocation::all();
        return view('admin.stockItems.create', compact('stocks','items','staffs','bags','storageLocations'));
    }


    public function postAdjustStock(Request $request)
    {
		
		if($request->transfer_type == 'individual'){
			// Store the stock adjustment details
        $stock = new StockOut();
        $stock->item_name = $request->item_name;
        $stock->staff_name = $request->staff_name;
        $stock->movement_date = $request->movement_date;
        $stock->from_location = $request->from_location;
        $stock->to_location = $request->to_location;
       
        $stock->save();
			
			        // Update the item location in the StockItems table
        $item = StockItems::where('item_name', $request->item_name)->first();
        // dd($item);
        if ($item) {
            $item->item_location = 'Transfer'; // Update the item_location
            $item->save(); // Save the updated item back to the database
			
        }
		return redirect('/stock-adjustment-list')->with('success', 'Stock Transferred Successfully!!');
			
		}else{
			$items = StockItems::where('sub_location', $request->item_name)->get();
			$itemcount = StockItems::where('sub_location', $request->item_name)->count();
			
				foreach ($items as $item) {
					$item->item_location = 'Transfer'; // Update the item_location
					$item->save(); // Save the updated item back to the database
				}
		foreach ($items as $item) {	
				$stock = new StockOut();
        		$stock->item_name = $item->item_name;
				$stock->staff_name = $request->staff_name;
				$stock->movement_date = $request->movement_date;
				$stock->from_location = $request->from_location;
				$stock->to_location = $request->to_location;
       
        		$stock->save();
        }}
				return redirect('/stock-adjustment-list')->with('success', 'Stock Transferred Successfully!!');
		}
        
	
	public function getItems(Request $request)
	{
        $transfertype = $request->transfertype;
    
		if($transfertype == 'individual'){
		$items = StockItems::where('sub_location', '1')->get();
			
			        return response()->json([
            			'items' => $items
        			]);
			
		}else{
			 $items = StockItems::where('sub_location', '!=', '1')
                            ->with('subLocation') // Include the subLocation relationship
                            ->get();
			
			$subLocation = $items->pluck('subLocation');
			
			 return response()->json([
            					'subLocation' => $subLocation
        						]);
		}

	}
   
	public function getItemTypeList(Request $request)
    {
        $itemTypes = ItemType::all();
        return view('admin.itemType.item-type-list', compact('itemTypes'));
    }
	
	public function addItemTypeList(Request $request)
    {
        $itemTypes = ItemType::all();
        return view('admin.itemType.create', compact('itemTypes'));
    }

    public function postItemType(Request $request)
    {
        $purities = $request->input('purity', []);
        $puritiesString = implode(', ', $purities);

        $itemType = new ItemType();

        $itemType->item_type_name = $request->item_type_name;
        $itemType->item_type_description = $request->item_type_description;
        $itemType->purity = $puritiesString;
        
        $itemType->save();

        return redirect('/item-type-list')->with('success', 'Item Type Added Successfully!');

    }

    public function editItemType($item_type_id)
    {
        $itemType= ItemType::find($item_type_id);
        return view('admin.itemType.edit-item-type', compact('itemType')); 
    }

    public function updateItemType(Request $request)
    {
        $dataId = $request->item_type_id;

        $purities = $request->input('purity', []);
        $puritiesString = implode(', ', $purities);

        $itemType = ItemType::find($dataId);
        $itemType->item_type_name = $request->item_type_name;
        $itemType->item_type_description = $request->item_type_description;
        $itemType->purity = $puritiesString;

       
        $itemType->save();

        return redirect('/item-type-list')->with('success', 'Item Type Updated Successfully');
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


}