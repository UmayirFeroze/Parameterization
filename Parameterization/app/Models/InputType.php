<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'min', 'max', 'step', 'row', 'col'];

    public static $rules = array();

    public function Values(){
        return $this->hasMany(Value::class, 'input_type_id', 'id');
    }
}
