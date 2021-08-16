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
    public function getDropdowns($dropdowns){
        // dropdowns is an array of required dropdowns
        
        // try {
        //     // get all dropdowns
        //     $parameters = Parameter::where('type','dropdown')->with(['ParameterItemsGroup.Dropdowns'])->get(['id','name']);
        //     return $parameters;
        // } catch (\Exception $error) {
        //     return $error;
        // }

        try {
            // Get selected dropdowns
            $dropdown_list = [];

            foreach ($dropdowns as $key => $dropdown) {      
                try {
                    $parameter_id = Parameter::where('name',$dropdown)->first()->id;

                } catch (\ModelNotFoundException $error) {
                    echo "Could not find Parameter";
                    return $error;
                }       

                $dropdownItems = Dropdown::with(['ParameterItemsGroup'])
                ->whereHas('ParameterItemsGroup', function($query) use($parameter_id){
                    $query->where('parameter_id',$parameter_id);
                })->get();

                $dropdown_list[$dropdown] = $dropdownItems;
            }
            return $dropdown_list;

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
            $parameters = Parameter::with('ParameterItemsGroup.Values.InputType')->where('type','values')->findOrFail($id);
            return view('multiauth::parameter.values.edit',$parameters);
        } catch (\Exception $error) {
            return response($error->getMessage());
        }
    }

    public function updateValue(Request $request, $id) { 
        // get request parameters
        $requests = $request->except('_token','_method');
        
        // create array to structure db 
        $request_array =[]; 
        
        foreach ($requests as $key => $request) {
            $keyNew = str_replace("_"," ",$key);
            $request_array[$keyNew] = $request;
        }

        try{
            DB::transaction(function () use ($request_array, $id){
                foreach ($request_array as $key => $value) {
                    try {
                        
                        DB::table('values')
                            ->where('parameter_items_group_id',$id)
                            ->where('key', $key)
                            ->update(['value' => $value]);
                    } catch (\Exception $error) {
                        DB::rollback();
                        echo "Rolling Back...";
                        return $error->getMessage();
                    }     
                }
            });
        }catch(\Exception $error){
            DB::rollback();
            echo "Rolling Back... 2";
            return $error->getMessage();
        }

    }
}
