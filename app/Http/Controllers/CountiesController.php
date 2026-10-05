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

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'badge_url' => 'required'
        ]);

        $county = County::create($request->all());

        return response()->json(compact('county'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string',
            'badge_url' => 'required'
        ]);

        $county = County::findOrFail($id);
        $county->update($request->all());

        return response()->json(compact('county'));
    }
}
