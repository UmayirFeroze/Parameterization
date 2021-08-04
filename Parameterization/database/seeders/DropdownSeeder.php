<?php

namespace Database\Seeders;

use App\Models\Dropdown;
use Illuminate\Database\Seeder;

class DropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of Dropdown Items
        $dropdowns = [
            0 => ["parameter_items_group_id" => 3, "name" => "Residential Sales", "default" => true, "disabled" => false, "deleted" => false],
            1 => ["parameter_items_group_id" => 3, "name" => "Residential Lettings", "default" => false, "disabled" => false, "deleted" => false],
            2 => ["parameter_items_group_id" => 4, "name" => "Commercial Sales", "default" => false, "disabled" => false, "deleted" => false],
            3 => ["parameter_items_group_id" => 4, "name" => "House in Multiple Occupation", "default" => false, "disabled" => false, "deleted" => false],
            4 => ["parameter_items_group_id" => 4, "name" => "Commercial Lettings", "default" => false, "disabled" => false, "deleted" => false],
        ];

        foreach ($dropdowns as $key => $value) {
            Dropdown::create([
                'parameter_items_group_id' => $value['parameter_items_group_id'],
                'name' => $value['name'],
                'default' => $value['default'],
                'disabled' => $value['disabled'],
                'deleted' => $value['deleted'],
            ]);
        }
    }
}
