<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = ['parameter_items_group_id', 'input_type_id', 'key', 'value', 'disabled', 'deleted'];

    public function InputType(){
        return $this->belongsTo(InputType::class);
    }

    public function ParameterItemsGroup(){
        return $this->belongsTo(ParameterItemsGroup::class);
    }
}
