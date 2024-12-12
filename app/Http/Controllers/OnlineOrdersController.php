<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineOrders;

class OnlineOrdersController extends Controller
{
    public function getOnlineOrders(Request $request)
    {
        $onlineorders = OnlineOrders::all();
        return view('online.orders.orders-list', compact('onlineorders'));
    }

    public function viewOnlineOrder($id)
    {
        $order = OnlineOrders::with(['customer', 'product'])->findOrFail($id);

        return view('online.orders.view-order', compact('order'));
    }
}
