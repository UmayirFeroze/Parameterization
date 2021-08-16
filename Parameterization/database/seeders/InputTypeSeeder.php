<?php

namespace Database\Seeders;

use App\Models\InputType;
use Illuminate\Database\Seeder;

class InputTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Input Seeder
        $inputTypes = [
            0 => ["name" => "text", "type" => "text"],
            1 => ["name" => "integer", "type" => "number", "min" => 0, "max" => 9999],
            2 => ["name" => "percentage", "type" => "number", "min" => 0, "max" => 100, "step" => 0.2],
            3 => ["name" => "description", "type" => "textarea", "row" => 3, "col" => 50],
            
        ];

        foreach ($inputTypes as $key => $value) {
            InputType::create([
                'name' => $value['name'],
                'type' => $value['type'],
                'min' => (array_key_exists('min', $value)) ? $value['min'] : null,
                'max' => (array_key_exists('max', $value)) ? $value['max'] : null,
                'step' => (array_key_exists('step', $value)) ? $value['step'] : null,
                'row' => (array_key_exists('row', $value)) ? $value['row'] : null,
                'col' => (array_key_exists('col', $value)) ? $value['col'] : null,

            ]);
        }
    }
}
