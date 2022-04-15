<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function question() {

        return $this->belongsTo('App\Models\Question');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function users() {

        return $this->belongsToMany('App\Models\User');
    }

    public function slove() {

        // return $this->hasOne(Question::class, 'id');
        return $this->hasOne('App\Models\Question');
        // return $this->hasMany(Item::class, 'buyer_id');
    }
}
