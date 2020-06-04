<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAnswer extends Mailable
{
    use Queueable, SerializesModels;

    public $currentTicket;
    public $messageUser;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($currentTicket, $messageUser, $admin)
    {
        $this->currentTicket = $currentTicket;
        $this->messageUser = $messageUser;
        $this->admin = $admin;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('helpdesk@mail.com')
        ->subject('Je hebt een nieuw antwoord op jouw bericht.')
        ->view('newanswer');
    }
}
