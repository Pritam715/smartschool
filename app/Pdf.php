<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    protected $table='pdf';

    protected $fillable = [

        'class_id',
        'subject_id',
        'teacher_id',
        'topic_id',
        'pdf_name',
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
