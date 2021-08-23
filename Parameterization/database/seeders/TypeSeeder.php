<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            0 => ["name"=>"dropdowns"],
            1 => ["name" => "values"],
            2 => ["name" => "selects"],
        ];

        foreach ($types as $key => $type) {
            Type::create([
                'name' => $type['name']
            ]);
        }
    }
}
