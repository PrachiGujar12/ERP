<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use App\Models\Products;
use App\Models\ProductAttributeValue;
use App\Models\ProductCombinations;
use App\Models\Taxes;
use App\Imports\VariationsImport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProductCategory()
    {
        $categories = ProductCategory::with('children')->whereNull('parent_id')->get();
        return view('online.category.product-category', compact('categories'));
    }

    public function postProductCategory(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:product_category,id',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft,pending',
        ]);

        // Create a new category instance
        $category = new ProductCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        // Handle image upload
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/product_category_images'), $imageName);
            $category->category_image = $imageName;
        }

        // Set the status
        $category->status = $request->status;

        // Save the category
        $category->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category created successfully!');
    }

    private function buildCategoryTree($categories, $parentId = null)
    {
        $branch = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $children = $this->buildCategoryTree($categories, $category->id);
                $category->children = collect($children); // Ensure children is a collection
                $branch[] = $category;
            }
        }
        return $branch;
    }

    public function editProductCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        $categories = ProductCategory::whereNull('parent_id')->with('children')->get();

        return view('online.category.edit-product-category', compact('category', 'categories'));
    }

    public function updateProductCategory(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:product_category,id',
            'description' => 'nullable|string',
            'status' => 'required|in:published,draft,pending',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added validation for image
        ]);
        
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/product_category_images'), $imageName);
        
            // Update only the category image if it's uploaded
            $category->category_image = $imageName;
        }
        
        $category->fill($validated);
        $category->save();
        

        return redirect('/product-categories')->with('success', 'Category updated successfully.');
    }

    public function deleteProductCategory($id)
    {
        $category = ProductCategory::findOrFail($id);

        if ($category->children->isNotEmpty()) {
            return redirect()->back()->with('error', 'Cannot delete a category with subcategories.');
        }

        $category->delete();

        return redirect('/product-categories')->with('success', 'Category deleted successfully.');
    }

    public function getProductAttributeList(Request $request)
    {
        $productAttributes = ProductAttribute::all();
        return view('online.attributes.attribute-list',compact('productAttributes'));
    }

    public function getAddNewAttribute(Request $request)
    {
        
        return view('online.attributes.add-attribute');
    }

    public function postNewAttribute(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'attribute_title.*' => 'nullable|string|max:255',
            'attribute_slug.*' => 'nullable|string|max:255',
            'attribute_color.*' => 'nullable|string|max:7',
            'attribute_image.*' => 'nullable|image|max:2048', // Validate image files
        ]);

        // Save the parent attribute
        $productAttribute = new ProductAttribute();
        $productAttribute->title = $request->title;
        $productAttribute->slug = $request->slug ?: Str::slug($request->title);
        $productAttribute->save();

        // Save child attributes
        if ($request->has('attribute_title')) {
            foreach ($request->attribute_title as $index => $title) {
                if (empty($title) || empty($request->attribute_slug[$index])) {
                    continue; // Skip empty child rows
                }

                $childAttribute = new AttributeValue();
                $childAttribute->product_attribute_id = $productAttribute->product_attribute_id;
                $childAttribute->title = $title;
                $childAttribute->slug = $request->attribute_slug[$index];
                $childAttribute->color = $request->attribute_color[$index] ?? null;


                $childAttribute->is_default = ($request->is_default == $index) ? 1 : 0;
                $childAttribute->status = 'Published'; // Set default status

                 // Handle image upload
                 if ($request->hasFile('attribute_image.' . $index)) {
                    $image = $request->file('attribute_image.' . $index);
                    
                    // Generate a unique name for the image
                    $imageName = uniqid() . '_' . $image->getClientOriginalName();
                    
                    // Move the file to the public directory
                    $image->move(public_path('assets/attribute_images'), $imageName);
                    
                    // Save the path to the database
                    $childAttribute->attribute_image = 'assets/attribute_images/' . $imageName;
                }
                
                $childAttribute->save();
            }

        }

        return redirect('product-attribute-list')->with('success', 'Product Attribute and details added successfully!');
    }

    public function getEditAttribute($id)
    {
        // Eager load 'attributeValues' with the product attribute
        $productAttribute = ProductAttribute::with('attributeValues')->find($id);
    
        if (!$productAttribute) {
            return redirect()->route('product-attribute-list')->with('error', 'Product attribute not found.');
        }
    
        // Passing product attribute and its values to the edit view
        return view('online.attributes.edit-product-attribute', compact('productAttribute'));
    }

    public function updateAttribute(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'attribute_title.*' => 'nullable|string|max:255',
            'attribute_slug.*' => 'nullable|string|max:255',
            'attribute_color.*' => 'nullable|string|max:7',
            'attribute_image.*' => 'nullable|image|max:2048', // Validate image files
        ]);

        // Find the existing product attribute
        $productAttribute = ProductAttribute::findOrFail($id);
        $productAttribute->title = $request->title;
        $productAttribute->slug = $request->slug ?: Str::slug($request->title);
        $productAttribute->save();

        // Get all existing child attribute IDs for the current product attribute
        $existingChildIds = AttributeValue::where('product_attribute_id', $productAttribute->product_attribute_id)
                                        ->pluck('attribute_value_id')
                                        ->toArray();

        // Handle each child attribute
        if ($request->has('attribute_title') && is_array($request->attribute_title)) {
            foreach ($request->attribute_title as $index => $title) {
                if (empty($title) || empty($request->attribute_slug[$index])) {
                    continue; // Skip empty child rows
                }

                // Check if the child attribute ID is passed (existing attribute)
                $childAttributeId = $request->attribute_id[$index] ?? null;

                // If it's an existing attribute, update it, otherwise create a new one
                if ($childAttributeId) {
                    $childAttribute = AttributeValue::find($childAttributeId);
                } else {
                    $childAttribute = new AttributeValue();
                }

                // If no child attribute was found, continue with creating a new one
                if (!$childAttribute) {
                    $childAttribute = new AttributeValue();
                }

                // Update the child attribute's details
                $childAttribute->product_attribute_id = $productAttribute->product_attribute_id;
                $childAttribute->title = $title;
                $childAttribute->slug = $request->attribute_slug[$index] ?? ''; // Fallback if slug is null
                $childAttribute->color = $request->attribute_color[$index] ?? null;

                   // Handle image upload
                   if ($request->hasFile('attribute_image.' . $index)) {
                    $image = $request->file('attribute_image.' . $index);
                    
                    // Generate a unique name for the image
                    $imageName = uniqid() . '_' . $image->getClientOriginalName();
                    
                    // Move the file to the public directory
                    $image->move(public_path('assets/attribute_images'), $imageName);
                    
                    // Save the path to the database
                    $childAttribute->attribute_image = 'assets/attribute_images/' . $imageName;
                }
                

                // Set default status for the child attribute
                $childAttribute->is_default = ($request->is_default == $index) ? 1 : 0;
                $childAttribute->status = 'Published'; // Set default status
                $childAttribute->save();

                // Remove the used ID from the existing list of child IDs
                if (($key = array_search($childAttribute->attribute_value_id, $existingChildIds)) !== false) {
                    unset($existingChildIds[$key]);
                }
            }
        }

        // Now, delete any child attributes that were not updated (removed)
        if (count($existingChildIds) > 0) {
            AttributeValue::destroy($existingChildIds);
        }

        return redirect('product-attribute-list')->with('success', 'Product Attribute and details updated successfully!');
    }

    public function deleteAttribute($id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);

        AttributeValue::where('product_attribute_id', $id)->delete();

        $productAttribute->delete();

        return redirect('product-attribute-list')->with('success', 'Product Attribute deleted successfully!');
    }


    public function getProductList(Request $request)
    {
        $products = Products::all();
        
        return view('online.products.product-list', compact('products'));
    }

    public function addNewProduct(Request $request)
    {
        $attributes = ProductAttribute::all();
        $attributeValues = AttributeValue::all(); 
        $categories = ProductCategory::with('children')->whereNull('parent_id')->get();
        $taxes = Taxes::all();

        return view('online.products.add-product', compact('attributes', 'attributeValues','categories','taxes'));
    }


    public function postAddProduct(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'description' => 'required|string',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric',
            'attribute_name' => 'nullable|array', 
            'attribute_value' => 'nullable|array', 
            'categories' => 'nullable|array', 
            'product_image' => 'nullable|image',
        ]);
    
         // Handle the product image if it's uploaded
        $imageName = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/product_images'), $imageName);
        }

        $topViewImageName = null; // Initialize variable for top view image
        if ($request->hasFile('top_view_image')) {
            $topViewImage = $request->file('top_view_image');
            $topViewImageName = time() . '_' . $topViewImage->getClientOriginalName();
            $topViewImage->move(public_path('assets/product_images'), $topViewImageName); // Move top view image to storage
        }

        $slug = Str::slug($request->product_name);
    
        // Create the product
        $product = Products::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'slug' => $slug,
            'permalink' => $request->permalink,
            'sku' => $request->sku,
            'price' => $request->price,
            'categories' => $request->categories ? implode(',', $request->categories) : null,
           'product_image' => $imageName, // Store the image name here
            'top_view_image' => $topViewImageName, // Store the top view image name here
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'taxes' => is_array($request->taxes) ? implode(',', $request->taxes) : $request->taxes,




        ]);
    
    // Prepare the 'metalTypes' field from attribute names (product_attribute_id)
            $metalTypes = null;

            if ($request->attribute_name) {
                // Ensure attribute_name contains valid product_attribute_id values
                $metalTypes = implode(',', $request->attribute_name); // Combine the IDs into a comma-separated string
            }

            // Save 'metalTypes' in the product table
            if ($metalTypes) {
                $product->metalTypes = $metalTypes;
                $product->save(); // Save the updated product
            }
    
        // If there are selected attributes and values, store them in the product_attr_values table
        if ($request->attribute_name && $request->attribute_value) {
            $attributeNames = $request->attribute_name; // No need to explode here as it's already an array
            $attributeValues = $request->attribute_value; // Same as above
    
            // Loop through the selected attributes and their values
            foreach ($attributeNames as $index => $attributeName) {
                $productAttrValue = new ProductAttributeValue();
                $productAttrValue->product_id = $product->product_id;
                $productAttrValue->attribute_name = $attributeName;
                $productAttrValue->attribute_value = $attributeValues[$index] ?? null; // Ensure the value exists
                $productAttrValue->save();
            }
        }
        // dd($productAttrValue);
    
        // Redirect or respond after saving the product
        return redirect('product-list')->with('success', 'Product created successfully!');
    }
    

    
    public function getAttributeValues(Request $request)
    {
        $attributeId = $request->input('product_attribute_id'); // Get the selected attribute ID

        // Fetch values from the attribute_values table where product_attribute_id matches
        $values = AttributeValue::where('product_attribute_id', $attributeId)->get(['attribute_value_id', 'title']);

        // Return the values as a JSON response
        return response()->json($values);
    }

    public function getEditProduct($id)
    {
        $product = Products::findOrFail($id);
        $taxes = Taxes::all();

        $attributeNames = DB::table('products_attr_values')
                    ->join('product_attributes', 'products_attr_values.attribute_name', '=', 'product_attributes.product_attribute_id')
                    ->where('products_attr_values.product_id', $id)
                    ->get(['product_attributes.title as title']);
                    // dd($attributeNames);

        // $attributeValues = DB::table('products_attr_values')
        //             ->join('attribute_values', 'products_attr_values.attribute_value', '=', 'attribute_values.attribute_value_id')
        //             ->where('products_attr_values.product_id', $id)
        //             ->get(['attribute_values.title as title']);
                    
        // dd($attributeValues);

        $variations = ProductCombinations::where('product_id', $id)->get();
        // dd($variations);

        $categories = ProductCategory::with('children')->whereNull('parent_id')->get();

        $selectedCategories = DB::table('products')
        ->join('product_category', function ($join) use ($id) {
            $join->whereRaw("FIND_IN_SET(product_category.id, (SELECT categories FROM products WHERE product_id = ?))", [$id]);
        })
        ->distinct()
        ->get(['product_category.id', 'product_category.name']);

        if (!$product) {
            return redirect('product-list')->with('error', 'Product not found.');
        }
    
        return view('online.products.edit-product', compact('product','attributeNames','categories','selectedCategories','variations','taxes'));
    }

   

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'required',
            'description' => 'required|string',
            'categories' => 'nullable|array',
        ]);
    
        $product = Products::findOrFail($id);
    
        $product->product_name = $request->product_name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
    
        $product->categories = $request->categories ? implode(',', $request->categories) : null;
    
        $product->taxes = is_array($request->taxes) ? implode(',', $request->taxes) : ($request->taxes ?: null);

    
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/product_images'), $imageName);
            $product->product_image = $imageName;
        }

        if ($request->hasFile('top_view_image')) {
            $image = $request->file('top_view_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/product_images'), $imageName);
            $product->top_view_image = $imageName;
        }
    
        $product->save();
        // if ($request->has('variations')) {
        //     foreach ($request->input('variations') as $variation) {
        //         // Ensure $variation is an array before processing
        //         if (!is_array($variation)) {
        //             $variation = explode(',', $variation); // If it's a string, convert it to an array
        //         }
        
        //         // Convert the variation array to a comma-separated string
        //         $combination = implode(',', $variation);
        
        //         // Check if the combination already exists to avoid duplicates
        //         $existingCombination = DB::table('product_combinations')
        //             ->where('product_id', $id)
        //             ->where('attribute_combination', $combination)
        //             ->first();
        
        //         if (!$existingCombination) {
        //             // Insert new combination into the product_combinations table
        //             DB::table('product_combinations')->insert([
        //                 'product_id' => $id,
        //                 'attribute_combination' => $combination, // Store as comma-separated string
        //                 'price' => $product->price,
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ]);
        //         }
        //     }
        // }
        
        return redirect('/product-list')->with('success', 'Product Updated Successfully!');
    }
    

    public function generateVariations(Request $request, $id)
    {
        // Fetch the product details
        $product = DB::table('products')->where('product_id', $id)->first();
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        // Split the `metalTypes` field into an array
        $metalTypes = explode(',', $product->metalTypes);
    
        $variations = [];
    
        // Loop through each metalType and fetch possible values from the `products_attr_values` table
        foreach ($metalTypes as $metalType) {
            // Fetch attribute values for the current metalType
            $attributeValues = DB::table('products_attr_values')
                ->where('attribute_name', trim($metalType))
                ->where('product_id', $id)
                ->pluck('attribute_value')
                ->toArray();
    
            // Ensure attributeValues are split into individual values
            $attributeValues = array_map('trim', explode(',', implode(',', $attributeValues)));
            // Generate combinations
            if (empty($variations)) {
                // Initialize variations with the first set of attribute values
                foreach ($attributeValues as $value) {
                    $variations[] = [$metalType => $value];
                }
            } else {
                // Generate combinations for subsequent attributes
                $newVariations = [];
                foreach ($variations as $existingVariation) {
                    foreach ($attributeValues as $value) {
                        $newVariations[] = array_merge($existingVariation, [$metalType => $value]);
                    }
                }
                $variations = $newVariations;
            }
        }
    
        // Insert combinations without checking for duplicates
        foreach ($variations as $variation) {
            // Flatten the variation to a comma-separated string
            $combinationString = implode(',', array_values($variation));
    
            // Check if the combination already exists in the product_combinations table
            $existingCombination = DB::table('product_combinations')
                ->where('product_id', $id)
                ->where('attribute_combination', $combinationString)
                ->first();
    
            if (!$existingCombination) {
                // Insert the new combination directly if it does not exist
                DB::table('product_combinations')->insert([
                    'product_id' => $id,
                    'attribute_combination' => $combinationString, // Store as comma-separated string
                    'price' => $product->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        return redirect()->back();
    }
    
        

    public function updateVariations(Request $request)
    {
       
        $attribute = ProductCombinations::find($request->id);
            $attribute->price = $request->price;
            if ($request->hasFile('combination_image')) {
                $image = $request->file('combination_image');
                $imageName = $image->getClientOriginalName();
                $relativeBasePath = '/assets/product_images';
                $image->move(public_path($relativeBasePath), $imageName);
                $relativeImagePath = $relativeBasePath . '/' . $imageName;
                $attribute->combination_image = $relativeImagePath;
            }

            if ($request->hasFile('top_view_image')) {
                $image = $request->file('top_view_image');
                $imageName = $image->getClientOriginalName();
                $relativeBasePath = '/assets/product_images';
                $image->move(public_path($relativeBasePath), $imageName);
                $relativeImagePath = $relativeBasePath . '/' . $imageName;
                $attribute->top_view_image = $relativeImagePath;
            }
            $attribute->save();

        return redirect()->back()->with('success', 'Attribute updated successfully!');
    }

    public function deleteVariations($id)
    {
        $variation = ProductCombinations::find($id);
        // dd($variation);
        if ($variation) {
            $variation->delete();
            return redirect()->back()->with('success','Variation Deleted Successfully!!');
        } else {
            return response()->json(['success' => false, 'message' => 'Variation not found']);
        }
    }


	public function uploadVariationsExcel(Request $request)
    {
        $request->validate([
            'variationsExcel' => 'required|mimes:xlsx,csv',
        ]);

        try {
            $file = $request->file('variationsExcel');

            // Process the Excel file
            $data = Excel::toArray(new VariationsImport, $file);

            // Assuming the first sheet contains the data
            $variations = $data[0];

            foreach ($variations as $row) {
                $id = $row['id']; // Excel column name for ID
                $price = $row['price']; // Excel column name for price
                $imageFilePath = $row['combination_image']; 
                $topViewFilePath = $row['top_view_image'];
            
                // Define the base relative path dynamically
                $relativeBasePath = '/assets'; 
                $relativeImagePath = $relativeBasePath . $imageFilePath; 
                $topViewRelativeImagePath = $relativeBasePath . $topViewFilePath;
                
            
                // Prepare data for updating
                $updateData = [
                    'price' => $price,
                    'combination_image' => $relativeImagePath, 
                    'top_view_image' => $topViewRelativeImagePath
                ];
            
                // Update the database record for the variation
                DB::table('product_combinations')
                    ->where('id', $id)
                    ->update($updateData);
            }
            
            return redirect()->back()->with('success', 'Variations updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing the file: ' . $e->getMessage());
        }
    }

	
    public function uploadImages(Request $request)
    {

        $uploadedFiles = [];
        // Loop through each uploaded file
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('assets/product_images'), $imageName); 
                $uploadedFiles[] = $imageName;
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }



    
    
}