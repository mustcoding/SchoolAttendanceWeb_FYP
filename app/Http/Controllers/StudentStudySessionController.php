<?php

namespace App\Http\Controllers;

use App\Models\StudentStudySession;
use App\Http\Requests\StoreStudentStudySessionRequest;
use App\Http\Requests\UpdateStudentStudySessionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentStudySessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerStudentStudySession(Request $request)
    {
        // Validate fields
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'ssc_id' => 'required|integer',
            'is_Delete' => 'required|integer',
        ]);
    
        try {
            // Start a database transaction
            DB::beginTransaction();
    
            // Create the StudentStudySession record
            $ssc = StudentStudySession::create([
                'student_id' => $validatedData['student_id'],
                'ssc_id' => $validatedData['ssc_id'],
                'is_Delete' => $validatedData['is_Delete'],
            ]);
    
            // Commit the transaction
            DB::commit();
    
            // Return a successful response
            return response()->json([
                'message' => 'Student Study Session registered successfully',
                'ssc' => $ssc
            ], 200);
        } catch (\Exception $exception) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
    
            // Return an error response
            return response()->json([
                'message' => 'Failed to register Student Study Session',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getIdByStudentId(Request $request)
    {
        try {

            // Get the RFID values from the request
            $student_id = $request->student_id;

            // Query students using parameter binding with OR condition
            $SSS = StudentStudySession::where('student_id', $student_id)->get();

            // Check if any student is found by tag_rfid
            if ($SSS->isEmpty()) {
               
                return response()->json([
                    'message' => 'No student found for the given RFID values.',
                ], 404);
              
            }

            // Return the found students
            return response()->json(['study' => $SSS], 200);

        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function deleteStudentFromClass(Request $request)
    {
        // Validate incoming request data if necessary

        // Retrieve student_id and ssc_id from the request
        $student_id = $request->input('student_id');
        $ssc_id = $request->input('ssc_id');

        // Find the student_study_session entry
        $studentStudySession = StudentStudySession::where('student_id', $student_id)
                                ->where('ssc_id', $ssc_id)
                                ->first();

        // Check if the student_study_session entry exists
        if (!$studentStudySession) {
            return response()->json(['message' => 'Student study session not found'], 404);
        }

        // Update the is_Delete field to mark the student as deleted
        $studentStudySession->is_Delete = 1;

        // Save the changes to the database
        $studentStudySession->save();

        // Return a success response
        return response()->json(['message' => 'Student deleted from class successfully']);
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
    public function store(StoreStudentStudySessionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentStudySession $studentStudySession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentStudySession $studentStudySession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentStudySessionRequest $request, StudentStudySession $studentStudySession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentStudySession $studentStudySession)
    {
        //
    }
}
