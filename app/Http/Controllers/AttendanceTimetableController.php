<?php

namespace App\Http\Controllers;

use App\Models\AttendanceTimetable;
use App\Models\OccurrenceType;
use App\Http\Requests\StoreAttendanceTimetableRequest;
use App\Http\Requests\UpdateAttendanceTimetableRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttendanceTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addAttendanceTimetable(Request $request)
    {
        try {
            // Your existing validation and user creation code
    
             // If validation passes, create user
            $attendance = AttendanceTimetable::create([
                'name' => $request->input('name'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
                'occurrence_id' => $request->input('occurrence_id'),
                'is_Delete' => $request->input('is_Delete'),
            ]);

            // Return success response with 200 status code
            return response()->json([
                'message' => 'Parent registered successfully',
                'attendance' => $attendance
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

    public function getAllAttendanceTimetable() {
        $data = AttendanceTimetable::with('occurrence')
                                   ->where('is_Delete', 0)
                                   ->get();
        return response()->json($data); // Return as JSON, adjust as needed
    }

    public function DeleteAttendanceTimetable(Request $request, $id)
    {

        // Retrieve the user by ID
        $attendance = AttendanceTimetable::find($id);

        // Check if the user exists
        if (!$attendance) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $attendance->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $attendance->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'attendance' => $attendance]);
    }

    public function checkAttendanceTimeTable(Request $request)
    {
        // Get current time and day
        $currentTime = now()->format('H:i');
        $currentDay = strtoupper(now()->format('l'));
    
        // Find timetable entries where current time falls between start_time and end_time
        $timetable = AttendanceTimetable::where('start_time', '<=', $currentTime)
                        ->where('end_time', '>=', $currentTime)
                        ->where('is_Delete', 0)
                        ->first();
    
        // Check if any timetable is found
        if (!$timetable) {
            return response()->json([
                'message' => 'Attendance cannot be recorded at this time.',
                'error' => $currentTime,
            ], 404);
        }
    
        // Retrieve the occurrence type associated with the timetable
        $occurrenceType = OccurrenceType::find($timetable->occurrence_id);
    
        // Check if the occurrence type is found
        if (!$occurrenceType) {
            return response()->json([
                'message' => 'Occurrence type not found.',
                'error' => $timetable->occurrence_id
            ], 404);
        }
    
        // Check if the current day matches any description in the occurrence type
        if (strpos($occurrenceType->description, $currentDay) !== false) {
            return response()->json([
                'message' => 'Attendance can be recorded for the current day and time.',
                'timetable' => $timetable,
                'occurrence_type' => $occurrenceType
            ], 200);
        } else {
            return response()->json([
                'message' => 'Attendance cannot be recorded for the current day and time.',
                'error' => 'Day does not match occurrence type description.',
                'DAY' => $currentDay,
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
    public function store(StoreAttendanceTimetableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceTimetable $attendanceTimetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceTimetable $attendanceTimetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceTimetableRequest $request, AttendanceTimetable $attendanceTimetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceTimetable $attendanceTimetable)
    {
        //
    }
}
