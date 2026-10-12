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
}
