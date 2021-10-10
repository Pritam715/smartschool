<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImpQ extends Model
{
    protected $table='important_question';

    protected $fillable = [

        'class_id',
        'subject_id',
        'teacher_id',
        'topic_id',
        'paper_name',
        'file_name',
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
