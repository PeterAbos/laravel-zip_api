<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['id' => 1, 'zip_code' => 2300, 'name' => 'Ráckeve', 'population' => 10700, 'county_id' => 14],
            ['id' => 2, 'zip_code' => 2310, 'name' => 'Szigetszentmiklós', 'population' => 39000, 'county_id' => 14],
            ['id' => 3, 'zip_code' => 2314, 'name' => 'Halásztelek', 'population' => 11000, 'county_id' => 14],
            ['id' => 4, 'zip_code' => 2315, 'name' => 'Szigethalom', 'population' => 17500, 'county_id' => 14],
            ['id' => 5, 'zip_code' => 2316, 'name' => 'Tököl', 'population' => 10500, 'county_id' => 14],
            ['id' => 6, 'zip_code' => 2317, 'name' => 'Szigetcsép', 'population' => 2300, 'county_id' => 14],
            ['id' => 7, 'zip_code' => 2318, 'name' => 'Szigetszentmárton', 'population' => 2200, 'county_id' => 14],
            ['id' => 8, 'zip_code' => 2319, 'name' => 'Szigetújfalu', 'population' => 2000, 'county_id' => 14],
            ['id' => 9, 'zip_code' => 2330, 'name' => 'Dunaharaszti', 'population' => 23000, 'county_id' => 14],
            ['id' => 10, 'zip_code' => 2335, 'name' => 'Taksony', 'population' => 6500, 'county_id' => 14],
            ['id' => 11, 'zip_code' => 2336, 'name' => 'Dunavarsány', 'population' => 8000, 'county_id' => 14],
            ['id' => 12, 'zip_code' => 2337, 'name' => 'Délegyháza', 'population' => 5000, 'county_id' => 14],
            ['id' => 13, 'zip_code' => 2338, 'name' => 'Majosháza', 'population' => 1600, 'county_id' => 14],
            ['id' => 14, 'zip_code' => 2340, 'name' => 'Kiskunlacháza', 'population' => 8800, 'county_id' => 14],
            ['id' => 15, 'zip_code' => 2344, 'name' => 'Dömsöd', 'population' => 5600, 'county_id' => 14],
            ['id' => 16, 'zip_code' => 2345, 'name' => 'Apaj', 'population' => 1200, 'county_id' => 14],
            ['id' => 17, 'zip_code' => 2347, 'name' => 'Bugyi', 'population' => 5200, 'county_id' => 14],
            ['id' => 18, 'zip_code' => 2351, 'name' => 'Alsónémedi', 'population' => 5400, 'county_id' => 14],
            ['id' => 19, 'zip_code' => 2360, 'name' => 'Gyál', 'population' => 24000, 'county_id' => 14],
            ['id' => 20, 'zip_code' => 2363, 'name' => 'Felsőpakony', 'population' => 3600, 'county_id' => 14],
            ['id' => 21, 'zip_code' => 2364, 'name' => 'Ócsa', 'population' => 9500, 'county_id' => 14],
            ['id' => 22, 'zip_code' => 2365, 'name' => 'Inárcs', 'population' => 4500, 'county_id' => 14],
            ['id' => 23, 'zip_code' => 2366, 'name' => 'Kakucs', 'population' => 3100, 'county_id' => 14],
            ['id' => 24, 'zip_code' => 2367, 'name' => 'Újhartyán', 'population' => 2700, 'county_id' => 14],
            ['id' => 25, 'zip_code' => 2370, 'name' => 'Dabas', 'population' => 17000, 'county_id' => 14],
            ['id' => 26, 'zip_code' => 2371, 'name' => 'Dabas', 'population' => 17000, 'county_id' => 14],
            ['id' => 27, 'zip_code' => 2373, 'name' => 'Dabas', 'population' => 17000, 'county_id' => 14],
            ['id' => 28, 'zip_code' => 2376, 'name' => 'Hernád', 'population' => 4100, 'county_id' => 14],
            ['id' => 29, 'zip_code' => 2377, 'name' => 'Örkény', 'population' => 4800, 'county_id' => 14],
            ['id' => 30, 'zip_code' => 2378, 'name' => 'Pusztavacs', 'population' => 1500, 'county_id' => 14],
            ['id' => 31, 'zip_code' => 2381, 'name' => 'Táborfalva', 'population' => 3200, 'county_id' => 14],
        ];
 
        DB::table('cities')->insert($cities);
    }
}
