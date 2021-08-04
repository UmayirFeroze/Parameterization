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

    public function Dropdowns(){
        return $this->hasMany(Dropdown::class, 'parameter_items_group_id', 'id');
    }
  
    public function Values(){
        return $this->hasMany(Value::class, 'parameter_items_group_id', 'id');
    }

}
