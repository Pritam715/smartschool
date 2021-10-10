<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grade;
use App\Teacher;
use App\user;
use App\Subject;

class SubjectTopic extends Model
{
    protected $table="subject_topic";
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'category_id',
        'topic_name',
        'slug',
    ];

    public function class() 
    {
        return $this->belongsTo(Grade::class);
    }
    public function teacher() 
    {
        return $this->belongsTo(User::class);
    }
    public function subject() 
    {
        return $this->belongsTo(Subject::class);
    }


}
