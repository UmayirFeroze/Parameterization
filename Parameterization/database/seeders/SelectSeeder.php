<?php

namespace Database\Seeders;

use App\Models\Select;
use Illuminate\Database\Seeder;

class SelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of Selects
        $selects = [
            0 => ["parameter_items_group_id" => 5, "sub_group_id" => null, "name" => "Bathroom and Toilet ", "disabled" => false, "deleted" => false],
            1 => ["parameter_items_group_id" => 5, "sub_group_id" => 1, "name" => "Basin", "disabled" => false, "deleted" => false],
            2 => ["parameter_items_group_id" => 5, "sub_group_id" => 1, "name" => "Bath", "disabled" => false, "deleted" => false],
            3 => ["parameter_items_group_id" => 5, "sub_group_id" => 2, "name" => "Basin on Brackets", "disabled" => false, "deleted" => false],
            4 => ["parameter_items_group_id" => 5, "sub_group_id" => 2, "name" => "Basin not on Brackets", "disabled" => false, "deleted" => false],
            5 => ["parameter_items_group_id" => 5, "sub_group_id" => 3, "name" => "Pipe Leak", "disabled" => false, "deleted" => false],
            6 => ["parameter_items_group_id" => 5, "sub_group_id" => 4, "name" => "Basin Blocked", "disabled" => false, "deleted" => false],
            7 => ["parameter_items_group_id" => 5, "sub_group_id" => 4, "name" => "Other", "disabled" => false, "deleted" => false],
        ];

        foreach ($selects as $key => $select) {
            Select::create([
                'parameter_items_group_id' => $select['parameter_items_group_id'],
                'sub_group_id' => $select['sub_group_id'],
                'name' => $select['name'],
                'disabled' => $select['disabled'],
                'deleted' => $select['deleted'],
            ]);
        }
    }
}
