<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showTicket(){
        return view('adminTicket');
    }

    public function showProfile(){
        return view('adminProfile');
    }
}
