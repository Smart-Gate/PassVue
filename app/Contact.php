<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name','phone'];
    public function user(){
        return $this->belongTo(User::class);
    }
    
}
