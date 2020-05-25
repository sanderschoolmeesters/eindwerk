<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticketcategory extends Model
{
    public function ticket()
    {
        return $this->belongstomany('App\Ticket');
    }
}
