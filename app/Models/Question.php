<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['question'];
    
     public function answers_method(){
    	return $this->hasMany(Answer::class,'question_id','id');
    }
}
