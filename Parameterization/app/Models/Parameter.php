<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
    
    public function ParameterItemsGroup(){
        return $this->hasMany(ParameterItemsGroup::class, 'parameter_id', 'id');
    }
}
