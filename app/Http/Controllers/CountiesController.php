<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    public function index() {
        $counties = County::all();
        return response()->json(['counties' => $counties]);
    }

    public function show($id) {
        $county = County::find($id);
        return response()->json(compact('county'));
    }
}
