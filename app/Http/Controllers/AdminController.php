<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    // Get data user
    public function getDataUser()
    {
        $admin = auth('admin')->user();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $data = User::all();

        return response()->json([
            'success' => true,
            'message' => 'Data user',
            'data' => $data,
        ], 200);
    }
}
