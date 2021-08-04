<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'min', 'max', 'step'];

    public static $rules = array();


}
