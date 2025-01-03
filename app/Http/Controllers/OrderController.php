<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class OrderController extends Controller
{
    // Create
    public function create(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string',
            'model' => 'required|string',
            'issue' => 'required|string',
            'detail' => 'required|string',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get current user
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Create data
        $data = new Order();
        $data->user_id = $user->id;
        $data->brand = $request->brand;
        $data->model = $request->model;
        $data->issue = $request->issue;
        $data->detail = $request->detail;
        $data->save();

        // Response
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $data,
        ], 201);
    }


    // Get all
    public function getAll()
    {
        // Get current user
        $user = auth('user')->user();
        $admin = auth('admin')->user();

        // Check if user or admin
        if (!$user && !$admin) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        // If auth as admin
        if ($admin) {
            $orders = Order::with('user')->get();
            return response()->json([
                'message' => 'Orders retrieved successfully',
                'data' => $orders
            ]);
        }

        // If auth as user
        if ($user) {
            $orders = Order::with('user')->where('user_id', $user->id)->get();

            // Check data is exist
            if ($orders->isEmpty()) {
                return response()->json([
                    'message' => 'No orders found for this user',
                    'data' => $orders
                ], 404);
            }

            // Response
            return response()->json([
                'message' => 'Orders retrieved successfully',
                'data' => $orders
            ]);
        }
    }


    // Update
    public function update(Request $request, $id)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Selesai,Belum Selesai,Tidak Selesai',
            'information' => 'required|string',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get current user
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Update data
        $data = Order::find($id);
        $data->status = $request->status;
        $data->information = $request->information;
        $data->save();

        // Response
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => $data,
        ]);
    }
}
