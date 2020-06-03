<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function ticketcategory()
    {
        return $this->belongsTo('App\Ticketcategory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable =[
        'id',
        'ticketcategory_id',
        'title',
        'question',
        'user_id'
    ];
}
