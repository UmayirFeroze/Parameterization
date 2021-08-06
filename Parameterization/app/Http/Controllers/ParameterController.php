<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Dropdown;
use Illuminate\Http\Request;

use App\Models\Parameter;
use App\Models\Value;
use GrahamCampbell\ResultType\Success;

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
        // update request parameters
        $requests = $request->request->all();
        // The request should be in the following format [{id: 1, parameter_items_group_id: 1, name: 'dropdownItem', default: true, disabled: false, deleted: false}] 
        try {
            DB::transaction(function () use ($requests){
                foreach ($requests as $key => $request) {   
                    try {
                            $result = DB::table('dropdowns')->where('id',$request['id'])->update([
                                'parameter_items_group_id'=> $request['parameter_items_group_id'],
                                'name' => $request['name'],
                                'default' => $request['default'],
                                'disabled' => $request['disabled'],
                                'deleted' => $request['deleted'],
                            ]);
                            return $result;
                    } catch (\Exception $error) {
                        DB::rollback();
                        echo "Rolling Back...1";
                        return $error;
                    }
                }       
            });
        } catch (\Exception $error) {
            echo "Rolling Back...2";
            DB::rollback();
            return $error;
        }
    }

    public function getValues(){
        $parameters = Parameter::where('type','values')->with(['ParameterItemsGroup.Values'])->get(['id','name']);
        return $parameters;
    }

    public function editValues(){

    }


}
