<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    // Get all
    public function getAll()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }
}
