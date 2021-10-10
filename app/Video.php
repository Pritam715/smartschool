<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table='video';

    protected $fillable = [

        'class_id',
        'subject_id',
        'teacher_id',
        'topic_id',
        'title_name',
        'link',
        'slug',
        
    ];

    public function class() 
    {
        return $this->belongsTo(Grade::class);
    }
    public function subject() 
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic() 
    {
        return $this->belongsTo(SubjectTopic::class);
    }
}
