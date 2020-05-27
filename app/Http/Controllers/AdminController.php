<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Review;
use App\Ticket;

class AdminController extends Controller
{
    public function showTicket(){
        $tickets = Ticket::get();
        return view('adminTicket')->with('tickets', $tickets);
    }

    public function showProfile(){
        $loggedInAdmin = auth()->user();
        $user =  User::find($loggedInAdmin->id);
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

    public function review(Request $request) {
        //validatie
        $this->validate($request, [
            'review' => 'nullable',
            'stars' => 'required'
        ]);

        // opslaan database
        $review = new Review();
        $review->review = $request->input('review');
        $review->stars = $request->input('stars');
        $review->author_id = auth()->user()->id;
        $review->save();

        return redirect('/adminProfile')->with('success', 'Review achtergelaten!');
    }
}
