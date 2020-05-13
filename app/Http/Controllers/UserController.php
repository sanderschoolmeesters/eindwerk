<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function makeTicket(){
        return view('userTicket');
    }

    public function showProfile(){
        return view('userProfile');
    }
}
