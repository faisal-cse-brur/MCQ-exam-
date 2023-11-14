<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $fillable=['subject'];
    public function exam_model(){
    	return $this->belongsTo(Exam::class,'subject_id');
    }
}
