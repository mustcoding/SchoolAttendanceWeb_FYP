<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    public function recordAttendanceByDataEntry(Request $request)
    {
        try {
            // Your existing validation and user creation code

            // Extract the date part from the date_time_in
            $date = date_create_from_format('m/d/y H:i:s', $request->input('date_time_in'));
            $datePart = $date->format('m/d/y');;

            // Check if an attendance record already exists for the given session, timetable, and date
            $existingAttendance = Attendance::where('student_study_session_id', $request->input('student_study_session_id'))
                ->where('attendance_timetable_id', $request->input('attendance_timetable_id'))
                ->whereDate('date_time_in', $datePart)
                ->first();

            // If an attendance record already exists, return a message indicating that attendance is already recorded for this session, timetable, and date
            if ($existingAttendance) {
                return response()->json([
                    'error' => 'Attendance already recorded for this session, timetable, and date',
                ], 404);
            }

            else{
                // If validation passes and no existing attendance record is found, create a new attendance record
                $attendance = Attendance::create([
                    'date_time_in' => $request->input('date_time_in'),
                    'date_time_out'=> $request->input('date_time_out'),
                    'is_attend' => $request->input('is_attend'),
                    'checkpoint_id' => $request->input('checkpoint_id'),
                    'attendance_timetable_id' => $request->input('attendance_timetable_id'),
                    'student_study_session_id' => $request->input('student_study_session_id'),
                ]);

                // Return success response with 200 status code
                return response()->json([
                    'message' => 'Attendance Recorded Successfully',
                    'attendance' => $attendance
                ], 200);
            }

            
        
        } catch (QueryException $exception) {
            // Handle database exceptions (e.g., unique constraint violation)
            return response()->json([
                'message' => 'Information needed missed',
                'error' => $exception->getMessage()
            ], 404);

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
    public function store(StoreAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
