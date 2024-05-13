<?php

namespace App\Http\Controllers;

use App\Models\StudentImage;
use App\Http\Requests\StoreStudentImageRequest;
use App\Http\Requests\UpdateStudentImageRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function addImage(Request $request, $id)
    {

        try{

            // If validation passes, create user
            $studentImage = StudentImage::create([
                'image' => $request->input('image'),
                'is_official' => $request->input('is_official'),
                'student_id' => $request->input('student_id'),
            ]);

            // Return success response with 200 status code
            return response()->json([
                'message' => 'Parent registered successfully',
                'parent' => $studentImage
            ], 200);


        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentImage $studentImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentImage $studentImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentImageRequest $request, StudentImage $studentImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentImage $studentImage)
    {
        //
    }
}
