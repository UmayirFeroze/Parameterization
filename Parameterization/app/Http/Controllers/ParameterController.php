<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use Illuminate\Http\Request;

use App\Models\Parameter;
use App\Models\ParameterItemsGroup;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // Get all parameters
        $parameters = Parameter::all();
        return $parameters;
    }

    public function AllParameterListView(){
        // Get all Parameters for List View
        $parameters = Parameter::all();
        return $parameters;
    }

    public function getDropdowns(){
        // get all dropdowns
        $parameters = Parameter::where('type','dropdown')->with(['ParameterItemsGroup.Dropdowns'])->get();
        return $parameters;
    }

    public function editDropdown($id){
        // Parameter -> Parameter Group -> DropdownItems
        // $parameters = Parameter::with(['ParameterItemsGroup.Dropdowns'])->get(['id','name'])->find($id);
        
        // Parameter Group -> Dropdown Items
        // $parameters_group = ParameterItemsGroup::with(['Dropdowns'])->where('parameter_id',$id)->get(['id','name']);

        // Parameter Group <- Dropdown Items
        $dropdownItems = Dropdown::with(['ParameterItemsGroup'])
            ->whereHas('ParameterItemsGroup', function($query) use($id){
                $query->where('parameter_id',$id);
        })->get();
        return $dropdownItems;
    }
    
    public function updateDropdown(Request $request, $id){
        // update request parameters
    }

    // public function editValues(){

    // }


}
