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


Route::get('parameters/{id}/editDropdown', [ParameterController::class, 'editDropdown'] )->name('parameters.editDropdown');
Route::patch('parameters/{id}/updateDropdown', [ParameterController::class, 'updateDropdown'])->name('parameteres.dropdown.update');

Route::get('parameters/{id}/editValue', [ParameterController::class, 'editValue'] )->name('parameters.editValue');
// Route::put('parameters/{id}', [ParameterController::class, 'updateValue'])->name('parameteres.value.edit');
// Route::get('parameters/{id}/edit', [ParameterController::class, 'editSelect'] )->name('parameters.editSelect');
// Route::put('parameters/{id}', [ParameterController::class, 'updateValue'])->name('parameteres.select.edit');
