<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;
use App\Models\Dropdown;

class DropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'dropdowns';
        
        DB::table($table)->delete();
        
        $path = public_path('Seeders/'.$table.'.csv');
        $records = Helper::import_csv($path);

        foreach ($records as $key => $record) {
            Dropdown::create([
                'parameter_items_group_id' => $record['parameter_items_group_id'],
                'name' => $record['name'],
                'default' => $record['default'],
                'disabled' => $record['disabled'],
                'deleted' => $record['deleted'],
            ]);
        }
    }
}
