<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $groups = Group::with('users')->get(); // Gets all the groups from DB.
        return response()->json($groups, 200, [], JSON_PRETTY_PRINT); // Returns a JSON response listing the groups.
    }


    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // Make sure the request data is valid // 
        // Error handling: Using validate, Lavarel will provide JSON response with errors in case of failure. 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'group_code' => 'required|string|unique:groups',
            'description' => 'nullable|string',
        ]);
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Data is valid, creating a new group using request data.. // 
        $group = Group::create($request->all());

        // Returns a JSON response listing the group and successful post request(201).
        return response()->json($group, 201, [], JSON_PRETTY_PRINT);
    }


    /**
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show( int $id){

        $group = Group::with('users')->findOrFail($id);
        
        return response()->json($group,200,[], JSON_PRETTY_PRINT);

    }


    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // Make sure the request data is valid // 
        $request->validate([
            'name' => 'required|string',
            'group_code' => 'required|string|unique:groups,group_code,' . $id,
            'description' => 'nullable|string',
        ]);

        try{
            $group = Group::findOrFail($id); // Find the group using its ID.

            $group->update($request->all()); // Update the found group with the request data. 

            return response()->json($group,200,[]); // Return JSON response.

        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Group not found'], 404);
        }
        
    }

    /**
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        try{
            $group = Group::with('users')->findOrFail($id); // Find the group using its ID.
            
            if ($group->users->isNotEmpty()) {
                $group->users()->detach();
            }  
            //$group = users()-> detach();
            $group->delete(); // Delete group.

            
            return response()->json(null, 204,  [], JSON_PRETTY_PRINT); // Return JSON response with no content HTTP staus 204.
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Group not found'], 404);
        }
    }

}
