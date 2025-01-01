<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    // Get all
    public function getAll()
    {
        $data = Issue::all();
        return response()->json($data);
    }
}
