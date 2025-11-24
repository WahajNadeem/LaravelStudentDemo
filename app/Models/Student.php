<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = ['name', 'email', 'phone'];

    public function files()
    {
        return $this->hasMany(StudentFile::class);
    }

    public function scopeMale($query){
        return $query->where('gender','=','m');
    }
}
