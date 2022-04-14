<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function category() {

        return $this->belongsTo('App\Models\Category');
    }

    public function answers() {

        return $this->hasMany('App\Models\Answer');
    }

    public function best_answer() {

        return $this->hasOne(Answer::class, 'best_answer_id');
        // return $this->hasMany(Item::class, 'buyer_id');
    }
}
