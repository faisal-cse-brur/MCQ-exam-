<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exams_attempt extends Model
{
	public $table="exams_attempts";
   protected $fillable=['exam_id','user_id'];

   public function user()
   {
   	 return $this->hasOne(User::class,'id','user_id');
   }
   public function exam()
   {
   	 return $this->hasOne(Exam::class,'id','exam_id');
   }
}
