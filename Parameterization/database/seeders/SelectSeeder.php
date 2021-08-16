<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Select;

class SelectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('selects')->delete();

        function import_csv($filename, $delimiter = ',')
        {
            if (!file_exists($filename) || !is_readable($filename))
                return false;

            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false)
            {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
                {
                    if (!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            return $data;
        }
        
        $path = public_path('selects.csv');
        $records = import_csv($path);
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
