<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;
use App\Models\Parameter;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        DB::table('parameters')->delete();
        
        $path = public_path('Seeders\parameters.csv');
        $records = Helper::import_csv($path);

        foreach ($records as $key => $record) {
            Parameter::create([
                'name' => $record['name'],
                'description' => $record['description'],
                'type' => $record['type'],
            ]);
        }
        // // List of parameters
        // $parameters = [
        //     0 => ["name" => "Rent Due Notificaitons", "description" => "Lorem Ipsum to Pac", "type" => "values"],
        //     1 => ["name" => "Landlord Requirements", "description" => "Lorem Ipsum to Pac", "type" => "dropdown"],
        //     2 => ["name" => "Repair and Maintenance", "description" => "Lorem Ipsum to Pac", "type" => "selects"],
        //     3 => ["name" => "Type of Id", "description" => "Lorem Ipsum to Pac", "type" => "dropdown"],
        //     4 => ["name" => "Compliance Notifications", "description" => "Lorem Ipsum to Pac", "type" => "values"],
            
        //     5 => ["name" => "Notifications", "description" => "Test Groupings", "type" => "values"],
        // ];

        // foreach ($parameters as $key => $value) {
        //     Parameter::create([
        //         'name' => $value['name'],
        //         'description' => $value['description'],
        //         'type' => $value['type'],
        //     ]);
        // }
    }
}
