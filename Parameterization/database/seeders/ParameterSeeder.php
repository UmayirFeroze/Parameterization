<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        // List of parameters
        $parameters = [
            0 => ["name" => "Notificaitons", "type" => "values"],
            1 => ["name" => "Landlord Requirements", "type"=> "dropdown"],
            2 => ["name" => "Repair and Maintenance", "type" => "selects"],
            3 => ["name" => "Type of Id", "type" => "dropdown"]
        ];

        foreach ($parameters as $key => $value) {
            Parameter::create([
                'name' => $value['name'],
                'type' => $value['type'],
            ]);
        }
    }
}
