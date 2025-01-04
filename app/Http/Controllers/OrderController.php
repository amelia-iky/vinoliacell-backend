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

    // Get by id
    public function getByID($id)
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
            $order = Order::with('user')->find($id);

            // Check if order exists
            if (!$order) {
                return response()->json([
                    'message' => 'Order not found',
                ], 404);
            }

            // Response
            return response()->json([
                'message' => 'Order retrieved successfully',
                'data' => $order
            ]);
        }

        // If auth as user
        if ($user) {
            $order = Order::with('user')->where('user_id', $user->id)->find($id);

            // Check if order exists
            if (!$order) {
                return response()->json([
                    'message' => 'Order not found for this user',
                ], 404);
            }

            // Response
            return response()->json([
                'message' => 'Order retrieved successfully',
                'data' => $order
            ]);
        }
    }

    // Update
    public function update($id, Request $request)
    {
        // Get current admin
        $admin = auth('admin')->user();

        // Check if admin is authenticated
        if (!$admin) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        // Find the order by ID
        $order = Order::find($id);

        // Check if order exists
        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Proses Perbaikan,Perbaikan Selesai,Pesanan Ditolak',
            'information' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update order with validated data
        $order->update([
            'status' => $request->input('status'),
            'information' => $request->input('information'),
        ]);

        // Response
        return response()->json([
            'message' => 'Order updated successfully',
            'data' => $order,
        ]);
    }

    // Delete by id
    public function delete($id)
    {
        // Get current admin
        $admin = auth('admin')->user();

        // Check if admin is authenticated
        if (!$admin) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        // Find the order by ID
        $order = Order::find($id);

        // Check if order exists
        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        // Delete order
        $order->delete();

        // Response
        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}
