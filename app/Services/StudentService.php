<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Log;

class StudentService
{
    protected $studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function getAllStudents()
    {
        return $this->studentRepo->getAll();
    }

    public function getStudent($id)
    {
        return $this->studentRepo->findById($id);
    }


    public function findByEmail($email)
    {
        return $this->studentRepo->findByEmail($email);
    }


    public function createStudent(array $data)
    {
        Log::info('Creating student: ' . json_encode($data));
        return $this->studentRepo->create($data);
    }

    public function updateStudent($id, array $data)
    {
        return $this->studentRepo->update($id, $data);
    }

    public function deleteStudent($id)
    {
        return $this->studentRepo->delete($id);
    }

    // public function uploadFile($student, $file)
    // {
    //     return $this->studentRepo->uploadFile($student, $file);
    // }

    public function uploadFiles($student, $files)
    {
        return $this->studentRepo->uploadFiles($student, $files);
    }
}
