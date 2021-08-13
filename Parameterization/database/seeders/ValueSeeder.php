<?php

namespace Database\Seeders;

use App\Models\Value;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of Key  Value pairs
        $values = [
            0 => ["parameter_items_group_id" => 1, "input_type_id" => 2, "key" => "Notification Period Value", "value" => "3", "disabled" => false, "deleted" => false],
            1 => ["parameter_items_group_id" => 1, "input_type_id" => 1, "key" => "Notification Period Interval", "value" => "Days", "disabled" => false, "deleted" => false],
            2 => ["parameter_items_group_id" => 1, "input_type_id" => 1, "key" => "Notification Message", "value" => "Expired!", "disabled" => false, "deleted" => false],

            3 => ["parameter_items_group_id" => 2, "input_type_id" => 2, "key" => "Notification Period Value", "value" => "2", "disabled" => false, "deleted" => false],
            4 => ["parameter_items_group_id" => 2, "input_type_id" => 1, "key" => "Notification Period Interval", "value" => "Months", "disabled" => false, "deleted" => false],
            5 => ["parameter_items_group_id" => 2, "input_type_id" => 1, "key" => "Notification Message", "value" => "Pay the Rent!", "disabled" => false, "deleted" => false],
            
            6 => ["parameter_items_group_id" => 7, "input_type_id" => 1, "key" => "Test Notification Message", "value" => "Test the Rent!", "disabled" => false, "deleted" => false],
        ];

        foreach ($values as $key => $value) {
            Value::create([
                'parameter_items_group_id' => $value['parameter_items_group_id'],
                'input_type_id' => $value['input_type_id'],
                'key' => $value['key'],
                'value' => $value['value'],
                'disabled' => $value['disabled'],
                'deleted' => $value['deleted'],
            ]);
        }
    }
}
