<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductCombinations;
use App\Models\Blog;
use App\Models\OnlineCustomers;
use App\Models\Tag;
use App\Models\Taxes;
use App\Models\Discount;
use App\Models\OnlineOrders;
use App\Models\AttributeValue;
use DB;
use Hash;
use Auth;

class FrontendController extends Controller
{

    public function getLogin(Request $request)
    {
      return view('online-frontend.auth.login');
    }

    public function postLogin(Request $request) {
        $remember = $request->filled('remember');
    
        // Attempt to authenticate the user using the 'online-customer' guard
        if (Auth::guard('online-customer')->attempt(
            ['email' => $request->email, 'password' => $request->password],
            $remember
        )) {
            // Redirect to the desired page after successful login
            return redirect('/home');
        } else {
            // Redirect back with an error message if authentication fails
            return redirect()->back()->withErrors(['error' => 'Please enter valid email, password, or you do not have admin access']);
        }
    }
    
    public function getRegister(Request $request)
    {
      return view('online-frontend.auth.register');
    }

    public function postRegister(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:online-customers,email',
            'password' => 'required|string|min:6',
            'mobile_no' => 'required|digits:10|unique:online-customers,mobile_no',
        ]);
    
        // Check if the mobile number exists in the customers table
        $offlineCustomer = DB::table('customers')->where('mobile_no', $request->mobile_no)->first();
    
        // Create a new OnlineCustomers record
        $customers = new OnlineCustomers;
        $customers->first_name = $request->first_name;
        $customers->email = $request->email;
        $customers->password = Hash::make($request->password);
        $customers->mobile_no = $request->mobile_no;
    
        // If mobile number exists, store the ID in offline_customer_id
        if ($offlineCustomer) {
            $customers->offline_customer_id = $offlineCustomer->customer_id;
        }
    
        // Save the record
        $customers->save();
    
        // Redirect to the login page with a success message
        return redirect('/customer-login')->with('success', 'Customer Registered successfully!');
    }

    public function postLogout(){
        Auth::guard('online-customer')->logout();
        return redirect(url('/customer-login'));
    }

    public function getHomePage(Request $request)
    {
      $products = ProductCategory::all();
        return view('online-frontend.home', compact('products'));
    }

    public function getCustomerProfile(Request $request)
    {
        return view('online-frontend.profile.view-profile');
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);
    
        $customer = Auth::guard('online-customer')->user();
        $customer->address = $request->address;
        $customer->save();
    
        return redirect()->back()->with('success', 'Address added successfully.');
    }

    public function editOnlineCustomer($online_customer_id)
    {
        // Fetch the customer data based on the ID
        $customer = OnlineCustomers::find($online_customer_id);

        // Check if the customer exists
        if (!$customer) {
            return redirect()->route('home')->with('error', 'Customer not found.');
        }

        // Return the view with customer data
        return view('online-frontend.profile.edit-customer-profile', compact('customer'));
    }

    public function updateCustomerProfile(Request $request, $online_customer_id)
    {
        

        // Find the customer and update their details
        $customer = OnlineCustomers::find($online_customer_id);

        if (!$customer) {
            return redirect()->route('home')->with('error', 'Customer not found.');
        }

        $customer->first_name = $request->input('first_name');
        $customer->email = $request->input('email');
        $customer->save();

        return redirect('/home')->with('success', 'Profile updated successfully.');
    }

    

    

    public function getProductList(Request $request)
    {
        $categoryId = $request->query('category');
        if ($categoryId) {
            // Use FIND_IN_SET to search for the category ID in the comma-separated column
            $products = Products::whereRaw("FIND_IN_SET(?, categories)", [$categoryId])->get();
        } else {
            $products = Products::all(); // Fetch all products if no category filter is applied
        }
    
        $metalTypeAttribute = DB::table('product_attributes')
            ->where('title', 'Metal Type')
            ->first();
    
        $metalTypesValues = [];
        if ($metalTypeAttribute) {
            $metalTypesValues = DB::table('attribute_values')
                ->where('product_attribute_id', $metalTypeAttribute->product_attribute_id)
                ->take(3)
                ->get();
        }
    
        // Fetch metal type images based on the product's metalType
        foreach ($products as $product) {
            $product->metalTypeValue = $metalTypesValues->firstWhere('value', $product->metalType);
        }
    
        // Check for empty results
        $errorMessage = $products->isEmpty() ? 'The selected category does not have any products.' : null;
    
        return view('online-frontend.product-list', compact('products', 'metalTypesValues', 'errorMessage'));
    }
    
    
    

    public function getProductDetails(Request $request, $sku, $productId)
    {
        $product = Products::where('product_id', $productId)
                            ->where('sku', $sku)
                            ->first();


        $shapes = DB::table('products_attr_values')
        ->where('product_id', $productId)
        ->where('attribute_name', 1)
        ->pluck('attribute_value')
        ->toArray();

        $shapesWithImages = [];

        foreach ($shapes as $shapeGroup) {
        $attributes = explode(',', $shapeGroup);

        foreach ($attributes as $attribute) {
            $attributeDetails = DB::table('attribute_values')
                ->where('title', $attribute) 
                ->select('title', 'attribute_image','attribute_value_id') 
                ->first();

            if ($attributeDetails) {
                $shapesWithImages[] = [
                    'title' => $attributeDetails->title,
                    'attribute_image' => $attributeDetails->attribute_image,
                    'attribute_value_id' =>$attributeDetails->attribute_value_id,
                ];
            }
        }
        }


        $metalTypes = DB::table('products_attr_values')
        ->where('product_id', $productId)
        ->where('attribute_name', 2)
        ->pluck('attribute_value')
        ->toArray();

        $metalTypeWithImages = [];

        foreach ($metalTypes as $metalTypesGroup) {
        $metalAttributes = explode(',', $metalTypesGroup);

        foreach ($metalAttributes as $attribute) {
            $metalAttributeDetails = DB::table('attribute_values')
                ->where('title', $attribute)
                ->select('title', 'attribute_image','attribute_value_id') 
                ->first();

            if ($metalAttributeDetails) {
                $metalTypeWithImages[] = [
                    'title' => $metalAttributeDetails->title,
                    'attribute_image' => $metalAttributeDetails->attribute_image,
                    'attribute_value_id' => $metalAttributeDetails->attribute_value_id,
                ];
            }
        }
        }


        $carats = DB::table('products_attr_values')
        ->where('product_id', $productId)
        ->where('attribute_name', 3)
        ->pluck('attribute_value')
        ->toArray();

        $caratWithImages = [];

        foreach ($carats as $shapeGroup) {
        $attributes = explode(',', $shapeGroup);

        foreach ($attributes as $attribute) {
            $attributeDetails = DB::table('attribute_values')
                ->where('title', $attribute) 
                ->select('title', 'attribute_image','attribute_value_id') 
                ->first();

            if ($attributeDetails) {
                $caratWithImages[] = [
                    'title' => $attributeDetails->title,
                    'attribute_image' => $attributeDetails->attribute_image,
                    'attribute_value_id' =>$attributeDetails->attribute_value_id,
                ];
            }
        }
        }
       
        return view('online-frontend.product-details', compact('product','shapesWithImages','metalTypeWithImages','caratWithImages'));
    }

    public function getVariations($shape, $metal_type)
    {
        $queryParams = [
            'shape' => $shape,
            'metal_type' => $metal_type,
        ];

        $attributes = AttributeValue::whereIn('attribute_value_id', array_values($queryParams))
            ->pluck('title', 'attribute_value_id')
            ->toArray();

        $attributeCombination = [];
        foreach ($queryParams as $key => $value) {
            if (isset($attributes[$value])) {
                $attributeCombination[] = $attributes[$value];
            }
        }

        $attributeCombinationString = implode(',', $attributeCombination);

        $variation = ProductCombinations::where('attribute_combination', $attributeCombinationString)
            ->first();
        if ($variation) {
            return response()->json([
                'top_view_image' => $variation->top_view_image, // Adjust to your actual column name
                'message' => 'Variations fetched successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'No variations found for the selected shape and metal type.',
            ], 404);
        }
    }

    

    public function getProducts(Request $request, $slug)
    {
            $product = Products::where('slug', $slug)->firstOrFail();
            return view('online-frontend.product', compact('product'));
    }

    public function getMetalImage(Request $request, $productId, $title)
    {
        $combinations = ProductCombinations::where('product_id', $productId)
            ->where('attribute_combination', 'like', '%' . $title . '%')
            ->get();
    
        if ($combinations->isNotEmpty()) {
            $results = $combinations->map(function ($combination) {
                $imagePath = $combination->combination_image ? asset($combination->combination_image) : asset('assets/product_images/default-image.jpg'); ;
                
                return [
                    'image' => $imagePath,
                    'price' => $combination->price,
                ];
            });
    
            return response()->json($results);
        }
        return response()->json([]);
    }

    
    public function fetchProductImage(Request $request)
    {
        $metalType = $request->query('metal_type');
        $shape = $request->query('shape');

        if (!$metalType || !$shape) {
            return response()->json(['error' => 'Both metal type and shape are required'], 400);
        }

        $combination = ProductCombinations::where('attribute_combination', 'like', '%' . $metalType . '%')
                                            ->where('attribute_combination', 'like', '%' . $shape . '%')
                                            ->first();

        if (!$combination) {
            return response()->json(['error' => 'No matching combination found'], 404);
        }

        return response()->json([
            'combination_image' => asset($combination->combination_image),
            'price' => $combination->price,
        ]);
    }
        
    public function blogs(Request $request)
    {
        $blogs = Blog::where('status', "Published")->get();
        return view('online-frontend.view-blogs', compact('blogs'));
    }

    public function blogSingle($category, $slug)
    {
        $catename = str_replace('-', ' ', $category);
        $blog = Blog::where('category_name', $catename)->where('slug', $slug)->where('status', "Published")->first();
        $featuredBlogs=Blog::where('status', "Published")->inRandomOrder()->limit(3)->get();
        $tags= Tag::all();
        return view('online-frontend.individual-blog', compact('blog', 'featuredBlogs', 'tags'));
    }
	
	public function blogSinglenew($subcategory, $category, $slug)
    {
        $catename = str_replace('-', ' ', $category);
        $subcatename = str_replace('-', ' ', $subcategory);
        $blog = Blog::where('category_name', $catename)->where('child_category_name', $subcatename)->where('slug', $slug)->where('status', "Published")->first();
        $featuredBlogs=Blog::where('status', "Published")->inRandomOrder()->limit(3)->get();
        $tags= Tag::all();
        return view('online-frontend.individual-blog', compact('blog', 'featuredBlogs', 'tags'));
    }

    public function tagname($tag) {
        $demotag = str_replace('-', ' ', $tag);
        $blogs = Blog::where('tags_name', 'like', '%' . $demotag . '%')
                     ->where('status', 'Published')
                     ->get(); 
        
        return view('online-fronten.tag-single', compact('blogs'));
    }

    public function getCart(Request $request, $online_order_id)
    {

        $orders = OnlineOrders::findOrFail($online_order_id);

        $products = Products::where('product_id', $orders->product_id)->first();

        $discount = Discount::where('product_id', $products->product_id)->first();
        $taxesArray = explode(',', $products->taxes);

        $taxes = Taxes::whereIn('name', $taxesArray)->get();
        return view('online-frontend.cart', compact('products','orders','taxes','discount'));
    }

    public function postOnlineOrders(Request $request)
    {
        $orders = new OnlineOrders();
        $orders->customer_id = $request->customer_id;
        $orders->product_id = $request->product_id;
        $orders->product_price = $request->product_price;
        $orders->carat_weight = $request->carat_weight;
        $orders->shape = $request->shape;
        $orders->metalType = $request->metalType;
        $orders->diamondType = $request->diamondType;
        $orders->ring_size = $request->ring_size;

        $orders->save();

        return redirect()->route('add.to.cart', ['online_order_id' => $orders->online_order_id]);


    }

    public function remove($orderId)
    {
        $order = OnlineOrders::find($orderId);
        if ($order) {
            $order->delete();
        }

        return redirect('/home')->with('success', 'Item removed from cart.');
    }

      public function checkout(Request $request, $online_order_id)
      {
          $orders = OnlineOrders::find($online_order_id);
          $orders->subtotal = $request->subtotal;
          $orders->grand_total = $request->grand_total;
      
          $orders->save();
      
          return redirect('/success');  
      }

      public function getSuccess(Request $request)
      {
            return view('online-frontend.success');
      }
      
    

}