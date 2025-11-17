<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model
{
    protected $connection = 'student_mysql';
    protected $fillable = ['student_id', 'file_path', 'original_name'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
