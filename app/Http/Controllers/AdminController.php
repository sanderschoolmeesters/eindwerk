<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function showTicket(){
        return view('adminTicket');
    }

    public function showProfile(){
        $loggedInUser = auth()->user();
         $user =  User::find($loggedInUser->id);
        return view('adminProfile')->with('user', $user);
    }

    public function editImage(Request $request){
        //validatie
        $this->validate($request, [
            'image' => 'required |image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //image opslaan in de app
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('storage/userimage');
            $image->move($destinationPath, $name);
        }

        //image path opslaan database
        if ($request->hasFile('image')) {
        $loggedInUser = auth()->user();
        $user = User::find($loggedInUser->id);
            $user->image = $name;
        $user->save();
    }

        return redirect('/adminProfile')->with('success', 'Uw profielfoto is aangepast');
    }
}
