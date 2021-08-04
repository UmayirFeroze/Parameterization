<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterItemsGroup extends Model
{
    use HasFactory;

    protected $fillable=['parameter_id', 'name'];

    public function Parameter(){
        return $this->belongsTo(Parameter::class);
    }

}
