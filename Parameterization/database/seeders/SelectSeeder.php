<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Select;
use App\Helper\Helper;

class SelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $table = 'selects';
        
        DB::table($table)->delete();
        
        $path = public_path('Seeders/'.$table.'.csv');
        $records = Helper::import_csv($path);

        foreach ($records as $key => $record) {
            Select::create([
                'parameter_items_group_id' => $record['parameter_items_group_id'],
                'sub_group_id' => $record['sub_group_id']=="null" ? null : $record['sub_group_id'],
                'name' => $record['name'],
                'disabled' => array_key_exists('disabled', $record) ? $record['disabled'] : false,
                'deleted' => array_key_exists('deleted', $record) ? $record['deleted'] : false,
            ]);
        }
    }
}
