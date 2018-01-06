<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table= 'events';
    protected $primaryKey= 'event_id';
    public $timestamps= false;

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
