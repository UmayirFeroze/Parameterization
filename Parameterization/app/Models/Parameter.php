<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type'];

    public function ParameterItemsGroup()
    {
        return $this->hasMany(ParameterItemsGroup::class, 'parameter_id', 'id');
    }

    public function Dropdowns()
    {
        return $this->hasManyThrough(Dropdown::class, ParameterItemsGroup::class, 'parameter_id', 'parameter_items_group_id', 'id', 'id');
    }

    public function Values()
    {
        return $this->hasManyThrough(Value::class, ParameterItemsGroup::class, 'parameter_id', 'parameter_items_group_id', 'id', 'id');
    }
    
    public function Type(){
        return $this->belongsTo(Type::class);
    }

}
