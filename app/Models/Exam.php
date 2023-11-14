<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable=['exam_name','subject_id','date','time','attempt'];

    public function subjects_method(){
    	return $this->hasMany(subject::class,'id','subject_id');
    }
    public function getQnaExam(){
    	return $this->hasMany(QnaExam::class,'exam_id','id');
    }
}
