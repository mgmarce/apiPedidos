<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){
        //me trae todas los usuarios
        $users = User::all();

        if(count($users)>0){
            return response()->json($users,200);
        }
        return response()->json([],200);
    }


    public function users_by_initial($letter){
        //SELECT * FROM users WHERE name LIKE 'R%';
        $users = User::where('name', 'LIKE', $letter . '%')->get();
        
        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'No users found with names starting with ' . $letter,
            ], 404);
        }
    
        return response()->json($users, 200);

    }
}
