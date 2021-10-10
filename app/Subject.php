<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grade;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subject_code',
        'class_id',
        'teacher_id',
        'description'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class,'class_id');
    }

    

}
