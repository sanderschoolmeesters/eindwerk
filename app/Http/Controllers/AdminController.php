<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Review;
use App\Ticket;
use App\Chat;
use App\CompletedTicket;
use App\Mail\NewAnswer;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showTicket(){
        $tickets = Ticket::get();
        return view('adminTicket')->with('tickets', $tickets);
    }

    
    public function showProfile(){
        $user =  User::find(auth()->user()->id);
        $compTicket = CompletedTicket::where('admin_id', auth()->user()->id)->get();

        return view('adminProfile')->with('user', $user)->with('compTicket', $compTicket);
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

        return redirect('/')->with('success', 'Review achtergelaten!');
    }


    public function chatAdmin($ticket_id){
        $currentTicket = Ticket::find($ticket_id);
        $returnChat = Chat::where('chat_id', $ticket_id)->get();

        return view('chatAdmin')->with('currentTicket', $currentTicket)->with('conversation', $returnChat);
    }


    public function sendChat(Request $request, $ticket_id){
    // verstuur chat gedeelte
        $this->validate($request, [
            'chat' => 'required'
        ]);

        // opslaan database
        $chat = new Chat();
        $chat->conversation = $request->input('chat');
        $chat->user_id = auth()->user()->id;
        $chat->chat_id = $ticket_id;
        $chat->save();

    // mail naar user gedeelte
        //als huidige verzender admin is, verstuur email naar user
        if(auth()->user()->role_id == 1){
            $currentTicket = Ticket::find($ticket_id);
            $userToSend = User::find($currentTicket->user_id);
            $messageUser = $request->input('chat');
            $admin = auth()->user()->name;

            Mail::to($userToSend->email)->send(new NewAnswer($currentTicket, $messageUser, $admin));
        }

        $returnChat = Chat::where('chat_id', $ticket_id)->get();
        $currentTicket = Ticket::find($ticket_id);

        return view('chatAdmin')->with('conversation', $returnChat)->with('currentTicket', $currentTicket);
    }


    public function deleteChat($ticket_id){
        // completed tickets aanmaken
        $compTicket = New CompletedTicket;
        $compTicket->ticket_id = $ticket_id;
        $compTicket->admin_id = auth()->user()->id;
        $compTicket->save();


        // ticket + chat verwijderen, kan eventueel niet verwijderen...
        Ticket::find($ticket_id)->delete();
        Chat::where('chat_id', $ticket_id)->delete();

        return redirect('/adminTicket')->with('success', 'Ticket afgehandeld!');
    }


    public function adminProfileGuest($user_id){
       $user = User::find($user_id);
       $reviews = Review::where('admin_id', $user_id)->get();
       $compTicket = CompletedTicket::where('admin_id', $user_id)->get();

       return view('adminProfile')->with('user', $user)->with('reviews', $reviews)->with('compTicket', $compTicket);
    }


    public function showReviewsForAdmin($user_id){
        $reviews = Review::where('admin_id', $user_id)->get();

        return view('adminReviews')->with('reviews', $reviews);
    }
}
