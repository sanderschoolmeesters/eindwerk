<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Review;
use App\Ticket;
use App\Chat;

class AdminController extends Controller
{
    public function showTicket(){
        $tickets = Ticket::get();
        return view('adminTicket')->with('tickets', $tickets);
    }

    public function showProfile(){
        $user =  User::find(auth()->user()->id);

        return view('adminProfile')->with('user', $user);
    }

    public function editImage(Request $request){
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

        return redirect('/adminProfile')->with('success', 'Uw profielfoto is aangepast');
    }

    public function review(Request $request, $user_id) {
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
        $review->admin_id = $user_id;
        $review->save();

        return redirect('/')->with('success', 'Review achtergelaten, route nog veranderen!');
    }

    public function chatAdmin($ticket_id){
        $currentTicket = Ticket::find($ticket_id);
        $returnChat = Chat::where('chat_id', $ticket_id)->get();

        return view('chatAdmin')->with('currentTicket', $currentTicket)->with('conversation', $returnChat);
    }

    public function sendChat(Request $request, $ticket_id){
        $this->validate($request, [
            'chat' => 'required'
        ]);

        // opslaan database
        $chat = new Chat();
        $chat->conversation = $request->input('chat');
        $chat->user_id = auth()->user()->id;
        $chat->chat_id = $ticket_id;
        $chat->save();

        $returnChat = Chat::where('chat_id', $ticket_id)->get();
        $currentTicket = Ticket::find($ticket_id);

        return view('chatAdmin')->with('conversation', $returnChat)->with('currentTicket', $currentTicket);
    }

    public function deleteChat($ticket_id){
        Ticket::find($ticket_id)->delete();
        Chat::where('chat_id', $ticket_id)->delete();

        return redirect('/adminTicket')->with('success', 'Ticket afgehandeld!');
    }

    public function adminProfileGuest($user_id){
       $admin = User::find($user_id);
       $reviews = Review::where('admin_id', $user_id)->get();

       return view('adminProfile')->with('user', $admin)->with('reviews', $reviews);
    }
}
