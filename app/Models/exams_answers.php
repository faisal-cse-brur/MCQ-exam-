<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exams_answers extends Model
{
      public $table="exams_answers";
	  protected $fillable=['attempt_id','question_id','answer_id'];
	  public function question(){
	  		return $this->hasOne(question::class,'id','question_id');
	  }
	   public function answers(){
	  		return $this->hasOne(answer::class,'id','answer_id');
	  }
}
