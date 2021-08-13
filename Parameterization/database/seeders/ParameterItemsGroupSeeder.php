<?php

namespace Database\Seeders;

use App\Models\ParameterItemsGroup;
use Illuminate\Database\Seeder;

class ParameterItemsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of Parameter Item Groups
        $parameterGroups = [
            0=>["parameter_id"=>1, "name"=>"Common"],
            1=>["parameter_id"=>5, "name"=>"Common"],
            2=>["parameter_id"=>2, "name"=>"Residential"],
            3=>["parameter_id"=>2, "name"=>"Commercial"],
            4=>["parameter_id"=>3, "name"=>"Problems"],
            5=>["parameter_id"=>4, "name"=>"Common"], 
            
            6=>["parameter_id"=>6, "name"=>"Test Notifications"], 
        ];

        foreach ($parameterGroups as $key => $parameterGroup) {
            ParameterItemsGroup::create([
                'parameter_id' => $parameterGroup['parameter_id'],
                'name' => $parameterGroup['name'],
            ]);
        }
    }
}
