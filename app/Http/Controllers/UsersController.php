<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::get(); // Gets all the users from DB.
        return response()->json($users, 200, [], JSON_PRETTY_PRINT); // Returns a JSON response listing the groups.
    }
}
