<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function usersList(){
        $users= User::with('weather')->get();
        return response()->json([
            'message' => 'all systems are a go',
            'users' => $users,
        ]);
    }
}
