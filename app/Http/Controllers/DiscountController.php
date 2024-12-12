<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Products;
use App\Models\ProductCategory;


class DiscountController extends Controller
{
    public function getDiscountList(Request $request)
    {
        $discounts = Discount::all();
        return view('online.discount.discount-list', compact('discounts'));
    }

    public function addNewDiscount(Request $request)
    {
        return view('online.discount.add-discount');
    }

    public function postNewDiscount(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:255|unique:discount,coupon_code',
            'discount_on' => 'required|string|in:product,category', 
            'discount_type' => 'required|string|in:percentage,fixed',
            'percentage_discount_value' => 'nullable|numeric|min:0|max:100|required_if:discount_type,percentage',
            'fixed_discount_value' => 'nullable|numeric|min:0|required_if:discount_type,fixed',
            'start_date' => 'required|date|before_or_equal:end_date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required|date_format:H:i',
        ]);
        $discount = new Discount();
        $discount->coupon_code =  $request->coupon_code;
        $discount->discount_on = $request->discount_on;
        $discount->product_id = $request->product_id;
        $discount->category_id = $request->category_id;
        $discount->discount_type = $request->discount_type;
        $discount->percentage_discount_value = $request->percentage_discount_value;
        $discount->fixed_discount_value = $request->fixed_discount_value;
        $discount->start_date = $request->start_date;
        $discount->start_time = $request->start_time;
        $discount->end_date = $request->end_date;
        $discount->end_time = $request->end_time;


        $discount->save();

        return redirect('/discount-list')->with('success', 'Discount Added Successfully');

    }

    public function getEditDiscount($id)
    {
        $discount = Discount::findorFail($id);
        $products = Products::all();

        return view('online.discount.edit-discount', compact('discount','products'));
    }

    public function updateDiscount(Request $request, $id)
    {
        $request->validate([
            'coupon_code' => "required|string|max:255",
            'discount_on' => 'required|string|in:product,category',
            'discount_type' => 'required|string|in:percentage,fixed',
            'percentage_discount_value' => 'nullable|numeric|min:0|max:100|required_if:discount_type,percentage',
            'fixed_discount_value' => 'nullable|numeric|min:0|required_if:discount_type,fixed',
            'start_date' => 'required|date|before_or_equal:end_date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required|date_format:H:i',
        ]);
       
            $discount = Discount::findOrFail($id);

            $discount->coupon_code =  $request->coupon_code;
            $discount->discount_on = $request->discount_on;
            $discount->discount_type = $request->discount_type;
            $discount->product_id = $request->product_id;
            $discount->category_id = $request->category_id;
            $discount->percentage_discount_value = $request->percentage_discount_value;
            $discount->fixed_discount_value = $request->fixed_discount_value;
            $discount->start_date = $request->start_date;
            $discount->start_time = $request->start_time;
            $discount->end_date = $request->end_date;
            $discount->end_time = $request->end_time;

         
            $discount->save();

            return redirect('/discount-list')->with('success', 'Discount Updated Successfully');
    }

    public function deleteDiscount($id)
    {
        $discount = Discount::findOrFail($id);

        $discount->delete();

        return redirect('/discount-list')->with('error', 'Discount deleted successfully!');
    }

    public function getProducts()
    {
        $products = Products::all(); 
        return response()->json($products);
    }

    public function getProductCategory()
    {
        $productCatgeory = ProductCategory::all(); 
        return response()->json($productCatgeory);
    }

}
