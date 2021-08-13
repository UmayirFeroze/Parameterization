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
            0 => ["name" => "Rent Due Notificaitons", "description" => "Lorem Ipsum to Pac", "type" => "values"],
            1 => ["name" => "Landlord Requirements", "description" => "Lorem Ipsum to Pac", "type" => "dropdown"],
            2 => ["name" => "Repair and Maintenance", "description" => "Lorem Ipsum to Pac", "type" => "selects"],
            3 => ["name" => "Type of Id", "description" => "Lorem Ipsum to Pac", "type" => "dropdown"],
            4 => ["name" => "Compliance Notifications", "description" => "Lorem Ipsum to Pac", "type" => "values"],
            
            5 => ["name" => "Notifications", "description" => "Test Groupings", "type" => "values"],
        ];

        foreach ($parameters as $key => $value) {
            Parameter::create([
                'name' => $value['name'],
                'description' => $value['description'],
                'type' => $value['type'],
            ]);
        }
    }
}
