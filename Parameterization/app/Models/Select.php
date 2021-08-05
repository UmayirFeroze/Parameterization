<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Select extends Model
{
    use HasFactory;

    protected $fillable = ['parameter_items_group_id', 'sub_group_id', 'name', 'disabled', 'deleted'];

    public static $rules = array();

    public function InputTypes(){
        return $this->belongsTo(InputType::class);
    }

    public function ParameterItemsGroup(){
        return $this->belongsTo(ParameterItemsGroup::class);
    }

    public function Parent()
    {
        return $this->belongsTo(Select::class, 'sub_group_id')->with('Parent');
    }
    public function Children()
    {
        return $this->hasMany(Select::class, 'sub_group_id')->with('Children');
    }
}
