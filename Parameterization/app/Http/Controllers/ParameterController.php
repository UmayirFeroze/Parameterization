<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Dropdown;
use Illuminate\Http\Request;

use App\Models\Parameter;


class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {
            // Get all parameters
            $parameters = Parameter::all();
            return $parameters;
        } catch (\Exception $error) {
            // return error
            return $error;
        }
    }

    public function AllParameterListView(){
        try {
            // Get all Parameters for List View
            $parameters = Parameter::all();
            // dd(csrf_token());
            return $parameters;
        } catch (\Exception $error) {
            // return error
            return $error;
        }

    }

    // Get route to use dropdown parameters
    public function getDropdowns(){
        try {
            // get all dropdowns
            $parameters = Parameter::where('type','dropdown')->with(['ParameterItemsGroup.Dropdowns'])->get(['id','name']);
            return $parameters;
        } catch (\Exception $error) {
            return $error;
        }
    }

    public function editDropdown($id){
        try {
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
        } catch (\Exeception $error) {
            // return error
            return $error;
        }

    }
    
    public function updateDropdown(Request $request, $id){
        // get request parameters
        $requests = $request->request->all();
        // IMPORTANT: The request should be in the following format [{id: 1, parameter_items_group_id: 1, name: 'dropdownItem', default: true, disabled: false, deleted: false}] 
        try {
            DB::transaction(function () use ($requests){
                foreach ($requests as $key => $request) {   
                    try {
                        DB::table('dropdowns')
                        ->where('id',$request['id'])
                        ->where('parameter_items_group_id',$request['parameter_items_group_id'])
                        ->update([
                            'parameter_items_group_id'=> $request['parameter_items_group_id'],
                            'name' => $request['name'],
                            'default' => $request['default'],
                            'disabled' => $request['disabled'],
                            'deleted' => $request['deleted'],
                        ]);
                            
                    } catch (\Exception $error) {
                        DB::rollback();
                        echo "Rolling Back...";
                        return $error;
                    }
                }       
            });
        } catch (\Exception $error) {
            echo "Rolling Back...";
            DB::rollback();
            return $error;
        }
    }

    // Get route to use value parameters
    public function getValues(){
        try {
            $parameters = Parameter::where('type','values')->with(['Values'])->get(['id','name']);
            return $parameters;
        } catch (\Exception $error) {
            throw $error;
        }
        
    }

    public function editValue($id){
        try {
            $parameters = Parameter::with('Values.InputType')->findOrFail($id);
            return $parameters;
        } catch (\Exception $error) {
            return response($error->getMessage());
        }
    }

    public function updateValue(Request $request, $id) {
        // get request parameters
        $requests = $request->request->all();

        // IMPORTANT: The request should be in the following format [{id: 1,parameter_items_group_id: 1,input_type_id: 2,key: "Notification Period Value",value: "3",disabled: 0, deleted: 0}] 

        try {
            DB::transaction(function () use ($requests){
                foreach ($requests as $key => $request) {   
                    error_log($request['value']);
                    try {
                        DB::table('values')
                            ->where('id',$request['id'])
                            ->where('parameter_items_group_id',$request['parameter_items_group_id'])
                            ->update(['value' => $request['value']]);
                        
                    } catch (\Exception $error) {
                        DB::rollback();
                        echo "Rolling Back...";
                        return $error->getMessage();
                    }
                }       
            });
        } catch (\Exception $error) {
            echo "Rolling Back...";
            DB::rollback();
            return $error->getMessage();
        }

    }

}
