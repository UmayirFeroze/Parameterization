<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;

    protected $fillable = ['parameter_items_group_id', 'name', 'default', 'disabled', 'deleted'];

    public function ParameterItemsGroup(){
        return $this->belongsTo(ParameterItemsGroup::class);
    }
}
