<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create(Request $request)
    {
        $order = new Order();
        $order->brand = $request->brand;
        $order->brand_desc = $request->brand_desc;
        $order->issue = $request->issue;
        $order->issue_desc = $request->issue_desc;
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }
}
