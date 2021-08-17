<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;
use App\Models\ParameterItemsGroup;
class ParameterItemsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'parameter_items_groups';
        
        DB::table($table)->delete();
        
        $path = public_path('Seeders/'.$table.'.csv');
        $records = Helper::import_csv($path);

        foreach ($records as $key => $record) {
            ParameterItemsGroup::create([
                'parameter_id' => $record['parameter_id'],
                'name' => $record['name'],
            ]);
        }
    }
}
