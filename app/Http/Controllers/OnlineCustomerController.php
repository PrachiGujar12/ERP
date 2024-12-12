<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineCustomers;

class OnlineCustomerController extends Controller
{
    public function getOnlineCustomerList(Request $request)
    {
        $onlineCustomers = OnlineCustomers::all();
        return view('online.customers.online-customers-list', compact('onlineCustomers'));
    }

    public function viewOnlineCustomer($online_customer_id)
    {
        $onlineCustomers = OnlineCustomers::where('online_customer_id', $online_customer_id)->first();

        return view('online.customers.view-customer', compact('onlineCustomers'));
    }
}
