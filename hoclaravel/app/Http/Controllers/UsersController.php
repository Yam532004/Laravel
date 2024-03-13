<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    public function index(){
        $title = "List user";
        $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
        return view('clients.users.users-list', compact('title', 'users'));
    }
}
