<?php

namespace App\Http\Controllers;

use App\Models\AttendanceTimetable;
use App\Models\OccurrenceType;
use App\Http\Requests\StoreAttendanceTimetableRequest;
use App\Http\Requests\UpdateAttendanceTimetableRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

    // public function checkAttendanceTimeTable(Request $request)
    // {
    //     // Get current time and day
    //     $currentTime = now()->format('H:i');

    //     Log::info('Current day: ' . $currentTime);
    
    //     // Find timetable entries where current time falls between start_time and end_time
    //     $timetable = AttendanceTimetable::where('start_time', '<=', $currentTime)
    //                     ->where('end_time', '>=', $currentTime)
    //                     ->where('is_Delete', 0)
    //                     ->first();
    
    //     // Check if any timetable is found
    //     if (!$timetable) {
    //         return response()->json([
    //             'message' => 'Attendance cannot be recorded at this time.',
    //             'error' => $currentTime,
    //         ], 404);
    //     }
    
    //     // Retrieve the occurrence type associated with the timetable
    //     $occurrenceType = OccurrenceType::find($timetable->occurrence_id);

    //     Log::info('Current day: ' . $occurrenceType);

    //     // Check if the occurrence type is found
    //     if (!$occurrenceType) {
    //         return response()->json([
    //             'message' => 'Occurrence type not found.',
    //             'error' => $timetable->occurrence_id
    //         ], 404);
    //     }
    
    //     // Get the current day of the week (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
    //     $currentDayOfWeek = date('w');

    //     // Convert the day of the week to a textual representation
    //     $daysOfWeek = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
    //     $currentDay = $daysOfWeek[$currentDayOfWeek];
  

    //     // Parse the occurrence type description to extract the range
    //     $descriptionParts = explode(' TO ', $occurrenceType->description);
        
    //     Log::info('Description parts: ' . json_encode($descriptionParts));

    //     // Check if the array has at least two elements
    //     if (count($descriptionParts) >= 2) {
    //         $startDay = trim($descriptionParts[0]);
    //         $endDay = trim($descriptionParts[1]);

    //         // Check if the current day falls within the range
    //         if ($currentDayOfWeek >= array_search($startDay, $daysOfWeek) && $currentDayOfWeek <= array_search($endDay, $daysOfWeek)) {
    //             return response()->json([
    //                 'message' => 'Attendance can be recorded for the current day and time.',
    //                 'timetable' => $timetable,
    //                 'occurrence_type' => $occurrenceType
    //             ], 200);
    //         }
    //         else{

    //             // Check if the occurrence type description matches the current day
    //             if ($currentDay === $descriptionParts[0]) {
    //                 return response()->json([
    //                     'message' => 'Attendance can be recorded for the current day and time.',
    //                     'timetable' => $timetable,
    //                     'occurrence_type' => $occurrenceType
    //                 ], 200);
    //             }
    //         }

    //     } else if (count($descriptionParts) === 1){
    //         // Check if the occurrence type description matches the current day
    //         if ($currentDay === $descriptionParts[0]) {
    //             return response()->json([
    //                 'message' => 'Attendance can be recorded for the current day and time.',
    //                 'timetable' => $timetable,
    //                 'occurrence_type' => $occurrenceType
    //             ], 200);
    //         }
    //     }

    // }

    public function checkAttendanceTimeTable(Request $request)
    {
        // Get current time and day
        $currentTime = now()->format('H:i');
        Log::info('Current time: ' . $currentTime);

        // Get the current day of the week (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
        $currentDayOfWeek = date('w');

        // Convert the day of the week to a textual representation
        $daysOfWeek = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
        $currentDay = $daysOfWeek[$currentDayOfWeek];
        Log::info('Current day: ' . $currentDay);

        // Find timetable entries where current time falls between start_time and end_time
        $timetable = AttendanceTimetable::where('start_time', '<=', $currentTime)
                        ->where('end_time', '>=', $currentTime)
                        ->where('is_Delete', 0)
                        ->orderBy('id', 'desc') // Modify the order as needed
                        ->get();

        // Check if any timetable is found
        if ($timetable->isEmpty()) {
            return response()->json([
                'message' => 'Attendance cannot be recorded at this time.',
                'error' => $currentTime,
            ], 404);
        }

        foreach ($timetable as $entry) {
            // Retrieve the occurrence type associated with the timetable
            $occurrenceType = OccurrenceType::find($entry->occurrence_id);
            Log::info('Occurrence type: ' . $occurrenceType);

            // Check if the occurrence type is found
            if (!$occurrenceType) {
                return response()->json([
                    'message' => 'Occurrence type not found.',
                    'error' => $entry->occurrence_id
                ], 404);
            }

            // Parse the occurrence type description to extract the range
            $descriptionParts = explode(' TO ', $occurrenceType->description);
            Log::info('Description parts: ' . json_encode($descriptionParts));

            // Check if the array has at least two elements
            if (count($descriptionParts) >= 2) {
                $startDay = trim($descriptionParts[0]);
                $endDay = trim($descriptionParts[1]);

                // Check if the current day falls within the range
                if ($currentDayOfWeek >= array_search($startDay, $daysOfWeek) && $currentDayOfWeek <= array_search($endDay, $daysOfWeek)) {
                    return response()->json([
                        'message' => 'Attendance can be recorded for the current day and time.',
                        'timetable' => $entry,
                        'occurrence_type' => $occurrenceType
                    ], 200);
                }
            } else if (count($descriptionParts) === 1) {
                // Check if the occurrence type description matches the current day
                if ($currentDay === $descriptionParts[0]) {
                    return response()->json([
                        'message' => 'Attendance can be recorded for the current day and time.',
                        'timetable' => $entry,
                        'occurrence_type' => $occurrenceType
                    ], 200);
                }
            }
        }

        // If no matching timetable entry is found for the current day
        return response()->json([
            'message' => 'Attendance cannot be recorded for the current day and time.',
            'error' => $currentDay
        ], 404);
    }

    public function attendanceDisplay(Request $request)
    {
        $day = $request->input('day');
        $currentTime = $request->input('currentTime');

        $attendanceTimetables = AttendanceTimetable::where('start_time', '<=', $currentTime)
            ->where('end_time', '>=', $currentTime)
            ->get();

        $matchingTimetable = null;

        foreach ($attendanceTimetables as $timetable) {
            if ($timetable->occurrenceType && $this->isDayInRange($day, $timetable->occurrenceType->description)) {
                $matchingTimetable = $timetable;
                break;
            }
        }

        if ($matchingTimetable) {
            return response()->json(['attendanceTimetable' => ['id' => $matchingTimetable->id, 'name' => $matchingTimetable->name]]);
        } else {
            return response()->json(['error' => 'No matching timetable found'], 404);
        }
    }

    public function isDayInRange($day, $range)
    {
        // Convert the day to a Carbon instance
        $day = Carbon::parse($day)->dayOfWeek;
        
        // Parse the range
        $parts = explode(' TO ', strtoupper($range));
        if (count($parts) != 2) {
            return false;
        }

        // Convert the days to Carbon dayOfWeek constants
        $startDay = Carbon::parse($parts[0])->dayOfWeek;
        $endDay = Carbon::parse($parts[1])->dayOfWeek;

        // Check if the day is within the range
        if ($startDay <= $endDay) {
            return $day >= $startDay && $day <= $endDay;
        } else {
            // Handle the case where the range wraps around the week
            return $day >= $startDay || $day <= $endDay;
        }
    }


    public function attendanceType()
    {
        // Get the current time and day
        $currentTime = now()->format('H:i');
        $currentDay = now()->format('l'); // Get the full name of the day (e.g., Monday)
        
        // Retrieve all timetables
        $attendanceTimetables = DB::table('attendance_timetables')
            ->join('occurrence_types', 'attendance_timetables.occurrence_id', '=', 'occurrence_types.id')
            ->select('attendance_timetables.name', 'attendance_timetables.start_time', 'attendance_timetables.end_time', 'occurrence_types.description')
            ->where('attendance_timetables.is_Delete', 0)
            ->whereTime('attendance_timetables.start_time', '<=', $currentTime)
            ->whereTime('attendance_timetables.end_time', '>=', $currentTime)
            ->get();
        
        // Filter timetables based on the current day in description
        $filteredTimetables = $attendanceTimetables->filter(function ($timetable) use ($currentDay) {
            return $this->isCurrentDayInDescription($timetable->description, $currentDay);
        });
    
        return response()->json($filteredTimetables, 200);
    }
    
    function isCurrentDayInDescription($description, $currentDay) {
        // Split the description into parts
        $parts = explode(', ', $description);
    
        foreach ($parts as $part) {
            // Check if the part contains "TO"
            if (strpos($part, ' TO ') !== false) {
                list($startDay, $endDay) = explode(' TO ', $part);
    
                // Convert days to their numerical representation
                $daysOfWeek = ['SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'];
                $startIndex = array_search(strtoupper($startDay), $daysOfWeek);
                $endIndex = array_search(strtoupper($endDay), $daysOfWeek);
                $currentIndex = array_search(strtoupper($currentDay), $daysOfWeek);
    
                if ($startIndex !== false && $endIndex !== false && $currentIndex !== false) {
                    if ($startIndex <= $endIndex) {
                        // Check if current day is within the range
                        if ($currentIndex >= $startIndex && $currentIndex <= $endIndex) {
                            return true;
                        }
                    } else {
                        // Handle the case where the range wraps around the week (e.g., FRIDAY TO MONDAY)
                        if ($currentIndex >= $startIndex || $currentIndex <= $endIndex) {
                            return true;
                        }
                    }
                }
            } else {
                // Check for individual days
                if (strtoupper($part) == strtoupper($currentDay)) {
                    return true;
                }
            }
        }
    
        return false;
    }

    public function getAttendance($id)
    {
        // Retrieve the user by their ID
        $timetable= AttendanceTimetable::find($id);

        // Check if the user exists
        if ($timetable) {
            return response([
                'timetable' => $timetable,
                'message' => 'Successfully retrieving data'
            ], 200);
        }
        else{

            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
    }

    public function updateTimetable(Request $request, $id)
    {
     
        // Retrieve the user by ID
        $timetable = AttendanceTimetable::find($id);

        // Check if the user exists
        if (!$timetable) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        // Update the user's attributes
        $timetable->name = $request->input('name');
        $timetable->start_time = $request->input('start_time');
        $timetable->end_time = $request->input('end_time');
        $timetable->occurrence_id = $request->input('occurrence_id');
        // Update other fields as needed

        // Save the changes to the database
        $timetable->save();

        // Return a success response
        return response()->json(['message' => 'Classroom updated successfully', 'timetable' => $timetable]);
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
