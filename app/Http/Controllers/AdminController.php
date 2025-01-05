<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    // Get data user
    public function getDataUser()
    {
        // Get admin
        $admin = auth('admin')->user();

        // Check if admin
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Get data
        $data = User::all();

        // Response
        return response()->json([
            'success' => true,
            'message' => 'Data user',
            'data' => $data,
        ], 200);
    }
}
