<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index() {
        $cities = City::with('county')->get();
        return response()->json(compact('cities'));
    }

    public function show($id) {
        $city = City::with('county')->find($id);
        return response()->json($city);
    }

    public function store(Request $request) {
        $request->validate([
            'zip_code' => 'required|min:4|max:4',
            'name' => 'required',
            'population' => 'required',
            'county_id' => 'required'
        ]);

        $city = City::create($request->all());

        return response()->json($city);
    }
}
