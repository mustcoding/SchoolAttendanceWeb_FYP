<?php

namespace App\Http\Controllers;

use App\Models\SchoolSessionClass;
use App\Http\Requests\StoreSchoolSessionClassRequest;
use App\Http\Requests\UpdateSchoolSessionClassRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SchoolSessionClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerSchoolSessionClass(Request $request)
    {
        try {
            // Check if a record with the same school_session_id, class_id, and staff_id exists
            $existingRecord = SchoolSessionClass::where([
                'school_session_id' => $request->input('school_session_id'),
                'class_id' => $request->input('class_id'),
                'staff_id' => $request->input('staff_id'),
            ])->first();

            // If the record already exists, return a response indicating the conflict
            if ($existingRecord) {
                return response()->json([
                    'message' => 'Record already exists',
                    'attendance' => $existingRecord,
                ], 200); // 409 Conflict status code
            }

            // If the record doesn't exist, create a new one
            $schoolSessionClass = SchoolSessionClass::create([
                'school_session_id' => $request->input('school_session_id'),
                'class_id' => $request->input('class_id'),
                'staff_id' => $request->input('staff_id'),
                'is_Delete' => $request->input('is_Delete'),
            ]);

            // Return success response with 200 status code
            return response()->json([
                'message' => 'School Session Class registered successfully',
                'attendance' => $schoolSessionClass
            ], 200);

        } catch (QueryException $exception) {
            // Handle database exceptions (e.g., unique constraint violation)
            return response()->json([
                'message' => 'Information needed missed',
                'error' => $exception->getMessage()
            ], 400);

        } catch (\Exception $exception) {
            // Handle other exceptions
            return response()->json([
                'message' => 'Information needed missed',
                'error' => $exception->getMessage()
            ], 500);
        }
    }


    public function totalClassroomTeacher()
    {
        try {
            $totalRecords = SchoolSessionClass::count();
            return response()->json(['count' => $totalRecords]);
        } catch (\Exception $e) {
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
    public function store(StoreSchoolSessionClassRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolSessionClass $schoolSessionClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolSessionClass $schoolSessionClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolSessionClassRequest $request, SchoolSessionClass $schoolSessionClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolSessionClass $schoolSessionClass)
    {
        //
    }
}
