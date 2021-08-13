<?php

use App\Http\Controllers\ParameterController;
use App\Models\Parameter;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('parameters', [ParameterController::class, 'index'] )->name('parameters.index');
Route::get('parameters/list', [ParameterController::class, 'AllParameterListView'] )->name('parameters.AllParameterListView');
Route::get('parameters/dropdowns', [ParameterController::class, 'getDropdowns'] )->name('parameters.dropdowns');
Route::get('parameters/values', [ParameterController::class, 'getValues'] )->name('parameters.values');


Route::get('parameters/dropdown/{id}/edit', [ParameterController::class, 'editDropdown'] )->name('parameters.editDropdown');
Route::patch('parameters/dropdown/{id}/update', [ParameterController::class, 'updateDropdown'])->name('parameteres.dropdown.update');

Route::get('parameters/value/{id}/edit', [ParameterController::class, 'editValue'] )->name('parameters.value.edit');
Route::patch('parameters/value/{id}/update', [ParameterController::class, 'updateValue'])->name('parameteres.value.update');

// Route::get('parameters/{id}/edit', [ParameterController::class, 'editSelect'] )->name('parameters.editSelect');
// Route::put('parameters/{id}', [ParameterController::class, 'updateValue'])->name('parameteres.select.edit');

        // DB::table('sections')->delete();
        // $json = File::get("database/data/sections.json");
        // $data = json_decode($json);
        // foreach ($data as $obj) {
        //     Section::create(array(
        //     'id' => $obj->id,
        //     'portal_id' => $obj->portal_id,
        //     'name' => $obj->name
        //   ));
        // }