<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;
use App\Models\Parameter;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        $table = 'parameters';
        
        DB::table($table)->delete();
        
        $path = public_path('Seeders/'.$table.'.csv');
        $records = Helper::import_csv($path);

        foreach ($records as $key => $record) {
            Parameter::create([
                'name' => $record['name'],
                'description' => $record['description'],
                'type' => $record['type'],
            ]);
        }
    }
}
