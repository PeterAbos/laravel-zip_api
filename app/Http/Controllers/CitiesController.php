<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * @api {get} /api/cities List Cities
     * @apiVersion 1.0.0
     * @apiName GetCities
     * @apiGroup Cities
     * @apiDescription Retrieve a list of all cities. Supports optional filtering by county and search term.
     *
     * @apiQuery {Number} [county] Filter cities by county ID.
     * @apiQuery {String} [search] Partial search query for city name.
     *
     * @apiSuccess {Object[]} cities List of city objects.
     * @apiSuccess {Number} cities.id City unique ID.
     * @apiSuccess {String} cities.zip_code 4-digit zip code.
     * @apiSuccess {String} cities.name City name.
     * @apiSuccess {Number} cities.population City population.
     * @apiSuccess {Number} cities.county_id County foreign key ID.
     * @apiSuccess {String} cities.created_at Creation timestamp.
     * @apiSuccess {String} cities.updated_at Last update timestamp.
     * @apiSuccess {Object} cities.county Associated county object.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "cities": [
     *             {
     *                 "id": 12,
     *                 "zip_code": "2120",
     *                 "name": "Dunakeszi",
     *                 "population": 45000,
     *                 "county_id": 3,
     *                 "created_at": "2026-03-01T10:00:00.000000Z",
     *                 "updated_at": "2026-03-01T10:00:00.000000Z",
     *                 "county": {
     *                     "id": 3,
     *                     "name": "Pest megye"
     *                 }
     *             }
     *         ]
     *     }
     */
    public function index(Request $request) {
        $query = City::query();

        if ($request->filled('county')) {
            $query->where('county_id', '=', $request->county);
        }
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }

        $cities = $query->with('county')->get();

        return response()->json(compact('cities'));
    }

    /**
     * @api {get} /api/cities/:id Get City Details
     * @apiVersion 1.0.0
     * @apiName GetCity
     * @apiGroup Cities
     * @apiDescription Retrieve details of a specific city including its county relationship.
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccess {Number} id City unique ID.
     * @apiSuccess {String} zip_code 4-digit zip code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Number} population City population.
     * @apiSuccess {Number} county_id County ID.
     * @apiSuccess {Object} county Associated county details.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "id": 12,
     *         "zip_code": "2120",
     *         "name": "Dunakeszi",
     *         "population": 45000,
     *         "county_id": 3,
     *         "county": {
     *             "id": 3,
     *             "name": "Pest megye"
     *         }
     *     }
     *
     * @apiError CityNotFound The id of the city was not found.
     */
    public function show($id) {
        $city = City::with('county')->find($id);
        return response()->json($city);
    }

    /**
     * @api {post} /api/cities Create City
     * @apiVersion 1.0.0
     * @apiName PostCity
     * @apiGroup Cities
     * @apiDescription Create a new city record.
     *
     * @apiBody {String{4}} zip_code Exact 4-character zip code.
     * @apiBody {String} name Name of the city.
     * @apiBody {Number} population Population count.
     * @apiBody {Number} county_id Associated county ID.
     *
     * @apiSuccess {Number} id Created city unique ID.
     * @apiSuccess {String} zip_code 4-digit zip code.
     * @apiSuccess {String} name City name.
     * @apiSuccess {Number} population Population count.
     * @apiSuccess {Number} county_id County ID.
     *
     * @apiError (422 Unprocessable Entity) ValidationError Validation failed for one or more fields.
     */
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

    /**
     * @api {put} /api/cities/:id Update City
     * @apiVersion 1.0.0
     * @apiName PutCity
     * @apiGroup Cities
     * @apiDescription Update an existing city record completely.
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiBody {String{4}} zip_code Exact 4-character zip code.
     * @apiBody {String} name Name of the city.
     * @apiBody {Number} population Population count.
     * @apiBody {Number} county_id Associated county ID.
     *
     * @apiSuccess {Number} id City unique ID.
     * @apiSuccess {String} zip_code Updated zip code.
     * @apiSuccess {String} name Updated city name.
     * @apiSuccess {Number} population Updated population count.
     * @apiSuccess {Number} county_id Updated county ID.
     *
     * @apiError (404 Not Found) CityNotFound The city with the given ID was not found.
     * @apiError (422 Unprocessable Entity) ValidationError Validation failed.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'zip_code' => 'required|min:4|max:4',
            'name' => 'required',
            'population' => 'required',
            'county_id' => 'required'
        ]);

        $city = City::findOrFail($id);
        $city->update($request->all());

        return response()->json($city);
    }

    /**
     * @api {delete} /api/cities/:id Delete City
     * @apiVersion 1.0.0
     * @apiName DeleteCity
     * @apiGroup Cities
     * @apiDescription Delete a city record by its ID.
     *
     * @apiParam {Number} id City unique ID.
     *
     * @apiSuccess {String} message Success message.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "message": "City deleted successfully"
     *     }
     *
     * @apiError (404 Not Found) CityNotFound The city with the given ID was not found.
     */
    public function destroy($id) {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully'
        ]);
    }
}
