<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    /**
     * @api {get} /api/counties 1. Megyék listázása
     * @apiVersion 1.0.0
     * @apiName GetCounties
     * @apiGroup Counties
     * @apiDescription Lekéri az összes megyét, opcionálisan névre szűrve.
     *
     * @apiQuery {String} [search] Részleges keresés a megye nevében (LIKE).
     *
     * @apiSuccess {Object[]} counties Megyék tömbje.
     * @apiSuccess {Number} counties.id Megye egyedi azonosítója.
     * @apiSuccess {String} counties.name Megye neve.
     * @apiSuccess {String} counties.badge_url Megye címerének URL-je.
     * @apiSuccess {String} counties.created_at Létrehozás dátuma.
     * @apiSuccess {String} counties.updated_at Utolsó módosítás dátuma.
     *
     * @apiSuccessExample {json} Sikeres válasz (200 OK):
     *     HTTP/1.1 200 OK
     *     {
     *         "counties": [
     *             {
     *                 "id": 1,
     *                 "name": "Pest megye",
     *                 "badge_url": "https://example.com/badges/pest.png",
     *                 "created_at": "2026-03-01T10:00:00.000000Z",
     *                 "updated_at": "2026-03-01T10:00:00.000000Z"
     *             }
     *         ]
     *     }
     */
    public function index(Request $request) {
        $query = County::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }

        $counties = $query->get();

        return response()->json(compact('counties'));
    }

    /**
     * @api {get} /api/counties/:id 2. Megye lekérése ID alapján
     * @apiVersion 1.0.0
     * @apiName GetCountyById
     * @apiGroup Counties
     * @apiDescription Lekéri egy adott megye adatait azonosító alapján.
     *
     * @apiParam {Number} id A megye egyedi azonosítója.
     *
     * @apiSuccess {Object} county Megye objektum.
     * @apiSuccess {Number} county.id Megye egyedi azonosítója.
     * @apiSuccess {String} county.name Megye neve.
     * @apiSuccess {String} county.badge_url Megye címerének URL-je.
     * @apiSuccess {String} county.created_at Létrehozás dátuma.
     * @apiSuccess {String} county.updated_at Utolsó módosítás dátuma.
     *
     * @apiSuccessExample {json} Sikeres válasz (200 OK):
     *     HTTP/1.1 200 OK
     *     {
     *         "county": {
     *             "id": 1,
     *             "name": "Pest megye",
     *             "badge_url": "https://example.com/badges/pest.png",
     *             "created_at": "2026-03-01T10:00:00.000000Z",
     *             "updated_at": "2026-03-01T10:00:00.000000Z"
     *         }
     *     }
     *
     * @apiError {Null} county Ha a megye nem található, a válasz null lehet (vagy üres objektum).
     */
    public function show($id) {
        $county = County::find($id);
        return response()->json(compact('county'));
    }

    /**
     * @api {post} /api/counties 3. Új megye létrehozása
     * @apiVersion 1.0.0
     * @apiName PostCounty
     * @apiGroup Counties
     * @apiDescription Létrehoz egy új megyét a megadott adatokkal.
     *
     * @apiBody {String} name Megye neve (kötelező, string).
     * @apiBody {String} badge_url Megye címerének URL-je (kötelező).
     *
     * @apiSuccess {Object} county Létrehozott megye objektum.
     * @apiSuccess {Number} county.id Megye egyedi azonosítója.
     * @apiSuccess {String} county.name Megye neve.
     * @apiSuccess {String} county.badge_url Megye címerének URL-je.
     * @apiSuccess {String} county.created_at Létrehozás dátuma.
     * @apiSuccess {String} county.updated_at Utolsó módosítás dátuma.
     *
     * @apiSuccessExample {json} Sikeres válasz (200 OK):
     *     HTTP/1.1 200 OK
     *     {
     *         "county": {
     *             "id": 2,
     *             "name": "Bács-Kiskun megye",
     *             "badge_url": "https://example.com/badges/bacs.png",
     *             "created_at": "2026-10-12T12:00:00.000000Z",
     *             "updated_at": "2026-10-12T12:00:00.000000Z"
     *         }
     *     }
     *
     * @apiError (Hiba: 422 Unprocessable Entity) {String} message Validációs hibaüzenet, ha a kötelező mezők hiányoznak.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'badge_url' => 'required'
        ]);

        $county = County::create($request->all());

        return response()->json(compact('county'));
    }

    /**
     * @api {put} /api/counties/:id 4. Meglévő megye frissítése
     * @apiVersion 1.0.0
     * @apiName PutCounty
     * @apiGroup Counties
     * @apiDescription Frissíti egy meglévő megye adatait azonosító alapján.
     *
     * @apiParam {Number} id A frissítendő megye egyedi azonosítója.
     *
     * @apiBody {String} name Megye neve (kötelező, string).
     * @apiBody {String} badge_url Megye címerének URL-je (kötelező).
     *
     * @apiSuccess {Object} county Frissített megye objektum.
     * @apiSuccess {Number} county.id Megye egyedi azonosítója.
     * @apiSuccess {String} county.name Megye neve.
     * @apiSuccess {String} county.badge_url Megye címerének URL-je.
     * @apiSuccess {String} county.created_at Létrehozás dátuma.
     * @apiSuccess {String} county.updated_at Utolsó módosítás dátuma.
     *
     * @apiSuccessExample {json} Sikeres válasz (200 OK):
     *     HTTP/1.1 200 OK
     *     {
     *         "county": {
     *             "id": 2,
     *             "name": "Bács-Kiskun Vármegye",
     *             "badge_url": "https://example.com/badges/bacs_new.png",
     *             "created_at": "2026-10-12T12:00:00.000000Z",
     *             "updated_at": "2026-10-12T12:30:00.000000Z"
     *         }
     *     }
     *
     * @apiError (Hiba: 404 Not Found) {String} error Ha a megadott azonosítójú megye nem létezik.
     * @apiError (Hiba: 422 Unprocessable Entity) {String} message Validációs hiba.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string',
            'badge_url' => 'required'
        ]);

        $county = County::findOrFail($id);
        $county->update($request->all());

        return response()->json(compact('county'));
    }

    /**
     * @api {delete} /api/counties/:id 5. Megye törlése
     * @apiVersion 1.0.0
     * @apiName DeleteCounty
     * @apiGroup Counties
     * @apiDescription Töröl egy megyét az azonosítója alapján.
     *
     * @apiParam {Number} id A törlendő megye egyedi azonosítója.
     *
     * @apiSuccess {String} message Sikeres törlési üzenet.
     *
     * @apiSuccessExample {json} Sikeres válasz (200 OK):
     *     HTTP/1.1 200 OK
     *     {
     *         "message": "County deleted successfully"
     *     }
     *
     * @apiError (Hiba: 404 Not Found) {String} error Ha a megye nem található.
     */
    public function destroy($id) {
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => 'County deleted successfully'
        ]);
    }
}
