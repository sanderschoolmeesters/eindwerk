<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function ticketcategory()
    {
        return $this->belongstoone('App\Ticketcategory');
    }
}
