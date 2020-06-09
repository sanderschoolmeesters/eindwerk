<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticketcategory;
use App\Ticket;
use DB;

class UserController extends Controller
{

    public function cat(){

        $categories = DB::select('select * from ticketcategories');
        return view('userTicket', ['ticketcategories' => $categories] );
    }



    public function makeTicket(Request $request){



        Ticket::create([

            'id'=> $request->id,
            'ticketcategory_id'=> $request->ticketcategorie,
            'title'=>$request->title,
            'question'=>$request->question,
            'user_id'=>Auth()->user()->id

        ]);//->ticketcategory()->match(request('ticketcategory'));

        return view('userTickets');

                }



    public function showProfile(){
        $loggedInUser = auth()->user();
        $user =  User::find($loggedInUser->id);
        return view('userProfile')->with('user', $user);


    }

    public function homeProfile(){
        $loggedInUser = auth()->user();
        $user =  User::find($loggedInUser->id);
        return view('home')->with('user', $user);


    }

    public function index() {
         $amount = Ticket::all();
         return view('home', compact('$amount'));
     }

     public function editImageUser(Request $request){
        //validatie
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        return redirect('/userProfile')->with('success', 'Uw profielfoto is aangepast');
    }


    public function showTickets(){
        return view('userTickets');

        $tickets = Ticket::where('user_id', auth()->user()->id);
        return view('userTickets', ['tickets' => $tickets]);
    }
}
