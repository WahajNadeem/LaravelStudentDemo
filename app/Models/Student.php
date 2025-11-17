<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $connection = 'student_mysql';
    protected $fillable = ['name', 'email', 'phone'];

    public function files()
    {
        return $this->hasMany(StudentFile::class);
    }
}
