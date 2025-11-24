<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function getAll()
    {
        return Student::with('files')->get();
    }

    public function findById($id)
    {
        return Student::with('files')->find($id);
    }

    public function findByEmail($email)
    {
        return Student::where('email', $email)::with('files')->first();
    }


    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update($id, array $data)
    {
        if ($student = Student::find($id)) {
        }
        $student->update($data);
        return $student::with('files');
    }

    public function delete($id)
    {
        $student = Student::find($id);
        return $student->delete();
    }

    // public function uploadFile($student, $file)
    // {
    //     $filePath = $file->store('students', 'public');

    //     if ($filePath) {
    //         $student->profile_image = $filePath;
    //         $student->save();
    //         return $filePath;
    //     }

    //     return false;
    // }

    public function uploadFiles($student, $files)
    {
        $uploadedFiles = [];

        foreach ($files as $file) {
            $filePath = $file->store('students', 'public');
            if ($filePath) {
                $studentFile = $student->files()->create([
                    'file_path' => $filePath,
                    'original_name' => $file->getClientOriginalName(),
                ]);
                $uploadedFiles[] = [
                    'file_url' => $studentFile->url,
                    'original_name' => $studentFile->original_name,
                ];
            }
        }

        return $uploadedFiles;
    }

    function query()
    {
        // return Student::where('age','>','90')
        // ->get();
        // return Student::where('score','>','50')
        // ->Where(function($query){
        //     $query->orWhere('age','>','90');
        // })
        // ->get();


        //Scope Function
        // return Student::male()->get();


        //Search Query
        // $search = "E";

        // return Student::whereAny([
        //         'name',
        //         'email',
        //         'gender',
        //         'phone'
        //     ], 'like', "%{$search}%")->get();

        // return Student::when($search, function ($query) use ($search) {
        //     return $query->whereAny([
        //         'name',
        //         'email',
        //         'gender',
        //         'phone'
        //     ], 'like', "%{$search}%");
        // })->get();

        return Student::paginate(perPage:10, page:4);
    }
}
