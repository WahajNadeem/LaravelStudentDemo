<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    function studentList()
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Students fetched successfully',
            'data'    => $this->studentService->getAllStudents()
        ], 200);

    }

    function addStudent(Request $req)
    {
        try {

            $validated = $req->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'phone' => 'required|string|max:20',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

        $student =  $this->studentService->createStudent($validated);

        if ($student) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Student added successfully',
                'data'    => $student
            ], 201);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Operation failed'
        ], 500);
    }
    function deleteStudent($id)
    {
        $student = $this->studentService->getStudent($id);

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        if ($this->studentService->deleteStudent($id)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Student deleted successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Operation failed'
        ], 500);
    }

    function getStudentById($id)
    {
        $student = $this->studentService->getStudent($id);

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $student
        ]);
    }

    function updateStudent(Request $req, $id)
    {
        $student = $this->studentService->getStudent($id);

        if (!$student) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        $validated = $req->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:20',
        ]);

        if ($this->studentService->updateStudent($id, $validated)) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Student updated successfully',
                'data'    => $student
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Operation failed'
        ], 500);
    }


    function updateStudentInfo(Request $req, $id)
    {
        $student = $this->studentService->getStudent($id);

        if (!$student) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Student not found'
            ], 400);
        }

        $validated = $req->validate([
            'name'  => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $id,
            'phone' => 'sometimes|required|string|max:20',
        ]);

        if ($this->studentService->updateStudent($id, $validated)) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Student updated successfully',
                'data'    => $student
            ]);
        }
    }

    // public function uploadFile(Request $req, $id)
    // {
    //     $student = $this->studentService->getStudent($id);

    //     if (!$student) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Student not found'
    //         ], 404);
    //     }

    //     $req->validate([
    //         'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);

    //     $filePath = $this->studentService->uploadFile($student, $req->file('file'));

    //     if ($filePath) {
    //         return response()->json([
    //             'status'  => 'success',
    //             'message' => 'File uploaded successfully',
    //             'data'    => [
    //                 'file_url' => asset('storage/' . $filePath),
    //             ]
    //         ], 201);
    //     }

    //     return response()->json([
    //         'status'  => 'error',
    //         'message' => 'File upload failed'
    //     ], 500);
    // }

    public function uploadFiles(Request $req, $id)
    {
        $student = $this->studentService->getStudent($id);
        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        $req->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $uploadedFiles = $this->studentService->uploadFiles($student, $req->file('files'));

        if ($uploadedFiles) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Files uploaded successfully',
                'data'    => $uploadedFiles
            ], 201);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'File upload failed'
        ], 500);
    }

    function query(){
       return $this->studentService->query();
    }
}
