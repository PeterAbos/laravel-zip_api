<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    public function index(Request $request) {
        $query = County::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }

        $counties = $query->get();

        return response()->json(compact('counties'));
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

    public function destroy($id) {
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => 'County deleted successfully'
        ]);
    }
}
