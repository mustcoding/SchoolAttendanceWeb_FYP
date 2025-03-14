<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\SchoolSession;
use App\Models\temporary_attendance;
use App\Models\StudentStudySession;
use App\Models\AttendanceTimetable;
use App\Models\AbsentSupportingDocument;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    public function recordAttendanceByDataEntry(Request $request)
    {
        try {
            // Your existing validation and user creation code

            // Retrieve the student's type from the database
            $studentType = Student::where('id', $request->input('student_id'))->value('type_student');

       

           // Check if the student's type is DAILY STUDENT
            if ($studentType == 'DAILY STUDENT') {
                // Retrieve the attendance timetable associated with the given attendance_timetable_id
                $attendanceTimetable = AttendanceTimetable::find($request->input('attendance_timetable_id'));


                // Extract the date part from the date_time_in
                $date = date_create_from_format('m/d/y H:i:s', $request->input('date_time_in'));
                $datePart = $date->format('m/d/y');

                // Get the day of the week (0 for Sunday, 6 for Saturday)
                $dayOfWeek = $date->format('w');

                // Check if the occurrence type of the attendance timetable is 'SUNDAY TO THURSDAY'
                if ($attendanceTimetable && $attendanceTimetable->occurrence->description === 'SUNDAY TO THURSDAY') {
                    // Ensure the day is between Sunday (0) and Thursday (4)
                    if ($dayOfWeek < 0 || $dayOfWeek > 4) {
                        return response()->json([
                            'error' => 'Attendance can only be recorded from Sunday to Thursday for DAILY STUDENT',
                        ], 400);
                    }

                    // Check if the current time is within the range of start_time and end_time
                    $startTime = strtotime($attendanceTimetable->start_time);
                    $endTime = strtotime($attendanceTimetable->end_time);
                    $currentTime = strtotime($date->format('H:i'));
                    $currentTimeFormatted = date('H:i', $currentTime);

                    if ($currentTime < $startTime || $currentTime > $endTime) {
                        return response()->json([
                            'error' => 'Attendance can only be recorded during specified time ranges for DAILY STUDENT',
                            'time' => $currentTimeFormatted,
                        ], 400);
                    }
                } else {
                    return response()->json([
                        'error' => 'Invalid attendance timetable or occurrence type for DAILY STUDENT',
                    ], 400);
                }
            }

            // Extract the date part from the date_time_in
            $date = date_create_from_format('m/d/y H:i:s', $request->input('date_time_in'));
            Log::info('date   ' . $date->format('m/d/y H:i:s'));

            $datePart = $date->format('m/d/y');
            Log::info('datePart   ' . $datePart);

            // Check if an attendance record already exists for the given session, timetable, and date
            $existingAttendance = Attendance::where('student_study_session_id', $request->input('student_study_session_id'))
                ->where('attendance_timetable_id', $request->input('attendance_timetable_id'))
                ->whereRaw('LEFT(date_time_in, 8) = ?', [$datePart])
                ->first();
            Log::info('existingAttendance   ' . $existingAttendance);
            // If an attendance record already exists, return a message indicating that attendance is already recorded for this session, timetable, and date
            if ($existingAttendance) {
                return response()->json([
                    'error' => 'Attendance already recorded for this session, timetable, and date',
                ], 404);
            }

            //record attendance when using data entry
            if($request->input('checkpoint_id') == 1){
                // If the student is not a DAILY STUDENT or if the occurrence type is not 'SUNDAY TO THURSDAY', proceed to record the attendance
                $attendance = Attendance::create([
                    'date_time_in' => $request->input('date_time_in'),
                    'date_time_out' => $request->input('date_time_out'),
                    'is_attend' => $request->input('is_attend'),
                    'checkpoint_id' => $request->input('checkpoint_id'),
                    'attendance_timetable_id' => $request->input('attendance_timetable_id'),
                    'student_study_session_id' => $request->input('student_study_session_id'),
                ]);
            }
            else{
               
                if ($request->input('attendance_timetable_id') == 8) {
                    // Extract the date part from date_time_in
                    $datePart = date_create_from_format('m/d/y H:i:s', $request->input('date_time_in'))->format('m/d/y');
                
                    // Check if a record with the same date part already exists in the temporary_attendance table
                    $existingTemporaryAttendance = temporary_attendance::where('attendance_timetable_id', $request->input('attendance_timetable_id'))
                        ->where('student_study_session_id', $request->input('student_study_session_id'))
                        ->where('checkpoint_id', $request->input('checkpoint_id'))
                        ->whereRaw('DATE(date_time_in) = ?', [$datePart])
                        ->first();
                
                    if ($existingTemporaryAttendance) {
                        // Check if the platform is different before adding to the Attendance table
                        if ($existingTemporaryAttendance->platform !== $request->input('platform')) {
                            // If the platform is different, proceed to record the attendance
                            $attendance = Attendance::create([
                                'date_time_in' => $request->input('date_time_in'),
                                'date_time_out' => $request->input('date_time_out'),
                                'is_attend' => $request->input('is_attend'),
                                'checkpoint_id' => $request->input('checkpoint_id'),
                                'attendance_timetable_id' => $request->input('attendance_timetable_id'),
                                'student_study_session_id' => $request->input('student_study_session_id'),
                            ]);
                        }
                        else{
                            // Return success response with 200 status code
                            return response()->json([
                                'message' => 'Waiting For Another Method',
                            ], 407);
                        }
                    } else {
                        // If no record exists with the same date, proceed to create the new record in temporary_attendance
                        $attendance = temporary_attendance::create([
                            'date_time_in' => $request->input('date_time_in'),
                            'date_time_out' => $request->input('date_time_out'),
                            'is_attend' => $request->input('is_attend'),
                            'checkpoint_id' => $request->input('checkpoint_id'),
                            'attendance_timetable_id' => $request->input('attendance_timetable_id'),
                            'student_study_session_id' => $request->input('student_study_session_id'),
                            'platform' => $request->input('platform'),
                        ]);
                    }
                }
                else{
                    // If the student is not a DAILY STUDENT or if the occurrence type is not 'SUNDAY TO THURSDAY', proceed to record the attendance
                    $attendance = Attendance::create([
                        'date_time_in' => $request->input('date_time_in'),
                        'date_time_out' => $request->input('date_time_out'),
                        'is_attend' => $request->input('is_attend'),
                        'checkpoint_id' => $request->input('checkpoint_id'),
                        'attendance_timetable_id' => $request->input('attendance_timetable_id'),
                        'student_study_session_id' => $request->input('student_study_session_id'),
                    ]);
                }
            }
            

            // Return success response with 200 status code
            return response()->json([
                'message' => 'Attendance Recorded Successfully',
                'attendance' => $attendance
            ], 200);

        } catch (QueryException $exception) {
            // Handle database exceptions (e.g., unique constraint violation)
            return response()->json([
                'message' => 'Information needed missed',
                'error' => $exception->getMessage()
            ], 404);
        }
    }

    public function getListAttend(Request $request)
    {
        $schoolSessionId = $request->input('schoolSession_id');
        $classroomId = $request->input('classroom_id');
        $attendanceTimetableId = $request->input('attendanceTimetable_id');
        $dateTimeIn = $request->input('attendanceDate');
    
        // Retrieve the current school session
        $currentSession = SchoolSession::find($schoolSessionId);
    
        if (!$currentSession) {
            // If there is no current session, return an empty array or appropriate response
            return response()->json([]);
        }
    
        // Retrieve all attendances for the specified parameters
        $attendances = Attendance::with(['studentStudySession.student.parentGuardian', 'checkpoint', 'attendanceTimetable', 'studentStudySession.schoolSessionClass.classroom'])
            ->whereHas('studentStudySession', function ($query) use ($classroomId, $currentSession) {
                $query->whereHas('schoolSessionClass', function ($subQuery) use ($classroomId, $currentSession) {
                    $subQuery->where('class_id', $classroomId)
                            ->where('school_session_id', $currentSession->id);
                });
            })
            ->where('attendance_timetable_id', $attendanceTimetableId)
            ->whereIn('is_attend', [0, 1, 2])
            ->where('date_time_in', 'like', "%$dateTimeIn%")
            ->get();
    
        // Extract student IDs who have attendance for that day
        $attendedStudentIds = $attendances->pluck('studentStudySession.student_id');
    
        // Retrieve students related to the classroom and school session who do not have attendance data for that day
        $studentsWithoutAttendance = Student::whereHas('studentStudySessions', function ($query) use ($classroomId, $currentSession) {
                $query->whereHas('schoolSessionClass', function ($subQuery) use ($classroomId, $currentSession) {
                    $subQuery->where('class_id', $classroomId)
                            ->where('school_session_id', $currentSession->id);
                });
            })
            ->whereDoesntHave('studentStudySessions.attendances', function ($query) use ($attendanceTimetableId, $dateTimeIn) {
                $query->where('attendance_timetable_id', $attendanceTimetableId)
                      ->where('date_time_in', 'like', "%$dateTimeIn%");
            })
            ->get();
    
        // Merge attendances and students without attendance
        $allStudents = $attendances->map(function ($attendance) use ($dateTimeIn) {
            $student = $attendance->studentStudySession->student;
            $parentName = $student->parentGuardian ? $student->parentGuardian->name : "";
            $phone_number = $student->parentGuardian ? $student->parentGuardian->phone_number : "";
            $cardRfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tagRfid = $student->tagRfid ? $student->tagRfid->number : "null";
    
            // Get the correct classroom and form number associated with this attendance
            $classroom = $attendance->studentStudySession->schoolSessionClass->classroom;
            $className = $classroom ? $classroom->name : "";
            $formNumber = $classroom ? $classroom->form_number : "";
    
            $attendanceDateTime = $attendance->is_attend == 2 ? "EXCUSED" : ($attendance->is_attend == 0 ? "ABSENT" : $attendance->date_time_in);
            $type_student = $student->type_student ? : "null";
    
            return [
                'student_id' => $student->id,
                'name' => $student->name,
                'date_of_birth' => $student->date_of_birth,
                'parent_name' => $parentName,
                'card_rfid' => $cardRfid,
                'tag_rfid' => $tagRfid,
                'class_name' => $className,
                'form_number' => $formNumber,
                'date_time_in' => $attendanceDateTime,
                'phone_number' => $phone_number,
                'type_student' => $type_student,
            ];
        });
    
        $studentsWithoutAttendance->each(function ($student) use ($allStudents, $currentSession, $classroomId) {
            $parentName = $student->parentGuardian ? $student->parentGuardian->name : "";
            $phone_number = $student->parentGuardian ? $student->parentGuardian->phone_number : "";
            $cardRfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tagRfid = $student->tagRfid ? $student->tagRfid->number : "null";
    
            // Ensure the correct classroom is used
            $classroom = $student->studentStudySessions->firstWhere('schoolSessionClass.class_id', $classroomId)->schoolSessionClass->classroom;
            $className = $classroom ? $classroom->name : "";
            $formNumber = $classroom ? $classroom->form_number : "";
            $type_student = $student->type_student ? : "null";
    
            $allStudents->push([
                'student_id' => $student->id,
                'name' => $student->name,
                'date_of_birth' => $student->date_of_birth,
                'parent_name' => $parentName,
                'card_rfid' => $cardRfid,
                'tag_rfid' => $tagRfid,
                'class_name' => $className,
                'form_number' => $formNumber,
                'date_time_in' => "ABSENT", // No attendance record
                'phone_number' => $phone_number,
                'type_student' => $type_student,
            ]);
        });
    
        return response()->json($allStudents);
    }
    


    public function totalPresent(Request $request){

      // Get the student_study_session_id from the request
        $studentStudySessionId = $request->input('student_study_session_id');
        Log::info('studentStudySessionId   ' . $studentStudySessionId);

        // Get the current year
        $currentYear = date('Y'); // Get the current year in four-digit format

        Log::info('currentYear   ' . $currentYear);

        // Calculate the total attendance where date_time_in is within the current year
        $totalAttendance = DB::table('attendances')
            ->where('student_study_session_id', $studentStudySessionId)
            ->where ('is_attend',1)
            ->whereYear('created_at', $currentYear)
            ->count();

        return response()->json(['total_attendance' => $totalAttendance], 200);
    }

    public function totalLeave(Request $request){

        // Get the student_study_session_id from the request
          $studentStudySessionId = $request->input('student_study_session_id');
          Log::info('studentStudySessionId   ' . $studentStudySessionId);
  
          // Get the current year
          $currentYear = date('Y'); // Get the current year in four-digit format
  
          Log::info('currentYear   ' . $currentYear);
  
          // Calculate the total attendance where date_time_in is within the current year
          $totalAttendance = DB::table('attendances')
              ->where('student_study_session_id', $studentStudySessionId)
              ->where ('is_attend',2)
              ->whereYear('created_at', $currentYear)
              ->count();
  
          return response()->json(['total_leave' => $totalAttendance], 200);
    }

    public function totalAbsent(Request $request)
{
    // Get the student_study_session_id from the request
    $studentStudySessionId = $request->input('student_study_session_id');
    Log::info('studentStudySessionId: ' . $studentStudySessionId);

    $schoolSessionDates = DB::table('student_study_sessions')
    ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
    ->join('school_sessions', 'school_session_classes.school_session_id', '=', 'school_sessions.id')
    ->select('school_sessions.start_date', 'school_sessions.end_date')
    ->where('student_study_sessions.id', $studentStudySessionId)
    ->first();
        
    if (!$schoolSessionDates) {
        // Handle if school session not found for the provided student_study_session_id
        return response()->json(['error' => 'School session not found'], 404);
    }

    // Initialize CarbonPeriod for the interval between start_date and the current date
    $period = CarbonPeriod::create($schoolSessionDates->start_date, now());

    // Get all attendance timetable IDs and their names
    $attendanceTimetables = DB::table('attendance_timetables')
        ->select('id', 'name', 'occurrence_id')
        ->get();

    // Get the description of occurrence types
    $occurrenceTypes = DB::table('occurrence_types')
        ->pluck('description', 'id');

    // Initialize an array to store absent attendances
    $absentAttendances = [];

    // Loop through each day in the interval
    foreach ($period as $date) {
        // Get the date string in 'Y-m-d' format
        $dateString = $date->format('Y-m-d');

        // Get the day of the week in uppercase (e.g., "MONDAY", "TUESDAY")
        $dayOfWeek = strtoupper($date->englishDayOfWeek);

        // Concatenate the date string with the day of the week
        $dateTimeIn = $dateString . ' (' . $dayOfWeek . ')';

        // Loop through each attendance timetable
        foreach ($attendanceTimetables as $timetable) {
            // Check if the occurrence type description includes the current day of the week
            if (strpos(strtoupper($occurrenceTypes[$timetable->occurrence_id]), $dayOfWeek) !== false || strpos($occurrenceTypes[$timetable->occurrence_id], 'EVERYDAY') !== false) {
                // Check if there is an attendance record for the current date and timetable ID
                $attendanceRecord = DB::table('attendances')
                    ->where('student_study_session_id', $studentStudySessionId)
                    ->where('attendance_timetable_id', $timetable->id)
                    ->whereDate(DB::raw("STR_TO_DATE(date_time_in, '%m/%d/%y %H:%i:%s')"), $date->format('Y-m-d'))
                    ->whereIn('is_attend', [1, 2])
                    ->first();

                // If no attendance record exists for this date and timetable, or if it exists but is marked as not attended, consider it absent
                if (!$attendanceRecord) {
                    $absentAttendances[] = [
                        'attendance_timetable_id' => $timetable->id,
                        'student_study_session_id' => $studentStudySessionId,
                        'is_attend' => 0, // Marked as absent
                        'date_time_in' => $dateTimeIn, // Date of absence with day of the week
                        'date_time_out' => null, // Not recorded
                        'name' => $timetable->name
                    ];
                }
            }
        }
    }

    // Count the total absent days
    $totalAbsentDays = count($absentAttendances);

    // Return the list of absent attendances along with the total absent days
    return response()->json(['total_absent' => $totalAbsentDays], 200);
}

    public function ListPresent(Request $request)
    {
        // Assume the student study session ID is passed in the request
        $studentStudySessionId = $request->input('student_study_session_id');
    
        // Get the current year
        $currentYear = Carbon::now()->year;
    
        // Query the attendances and select only the required columns
        $attendances = Attendance::where('student_study_session_id', $studentStudySessionId)
            ->where('is_attend', 1)
            ->whereYear('created_at', $currentYear)
            ->select('id', 'date_time_in', 'date_time_out', 'is_attend', 'checkpoint_id', 'attendance_timetable_id', 'student_study_session_id')
            ->with('attendanceTimetable:id,name') // Eager load the attendance timetable with only id and name
            ->get();
    
        Log::info('studentStudySessionId   ' . $studentStudySessionId);
    
        // Iterate through each attendance and modify the date_time_in format
        $attendancesWithFormattedDateTimeIn = $attendances->map(function ($attendance) {
            // Parse the date_time_in field as a Carbon instance
            $date = Carbon::parse($attendance->date_time_in);
    
            // Format the date_time_in as desired
            $formattedDateTimeIn = $date->format('m/d/y H:i:s (l)');
    
            // Update the date_time_in field in the attendance object
            $attendance->date_time_in = $formattedDateTimeIn;
    
            // Add only the timetable name to the response
            $attendance->name = $attendance->attendanceTimetable->name;
    
            // Unset the nested attendance timetable object
            unset($attendance->attendanceTimetable);
    
            return $attendance;
        });
    
        // Return the results, with date_time_in formatted as desired, as a JSON response
        return response()->json($attendancesWithFormattedDateTimeIn);
    }


    public function ListLeave(Request $request)
    {

       // Assume the student study session ID is passed in the request
       $studentStudySessionId = $request->input('student_study_session_id');
    
       // Get the current year
       $currentYear = Carbon::now()->year;
   
       // Query the attendances and select only the required columns
       $attendances = Attendance::where('student_study_session_id', $studentStudySessionId)
           ->where('is_attend', 2)
           ->whereYear('created_at', $currentYear)
           ->select('id', 'date_time_in', 'date_time_out', 'is_attend', 'checkpoint_id', 'attendance_timetable_id', 'student_study_session_id')
           ->with('attendanceTimetable:id,name') // Eager load the attendance timetable with only id and name
           ->get();
   
       Log::info('studentStudySessionId   ' . $studentStudySessionId);
   
       // Iterate through each attendance and modify the date_time_in format
       $attendancesWithFormattedDateTimeIn = $attendances->map(function ($attendance) {
           // Parse the date_time_in field as a Carbon instance
           $date = Carbon::parse($attendance->date_time_in);
   
           // Format the date_time_in as desired
           $formattedDateTimeIn = $date->format('m/d/y H:i:s (l)');
   
           // Update the date_time_in field in the attendance object
           $attendance->date_time_in = $formattedDateTimeIn;
   
           // Add only the timetable name to the response
           $attendance->name = $attendance->attendanceTimetable->name;
   
           // Unset the nested attendance timetable object
           unset($attendance->attendanceTimetable);
   
           return $attendance;
       });
   
       // Return the results, with date_time_in formatted as desired, as a JSON response
       return response()->json($attendancesWithFormattedDateTimeIn);
    }

    // public function ListAbsentS(Request $request)
    // {
    //     // Get the student_study_session_id from the request
    //     $studentStudySessionId = $request->input('student_study_session_id');
    //     Log::info('studentStudySessionId   ' . $studentStudySessionId);
    
    //     // Retrieve the start date and end date of the school session
    //     $schoolSessionDates = DB::table('student_study_sessions')
    //         ->join('school_sessions', 'student_study_sessions.ssc_id', '=', 'school_sessions.id')
    //         ->select('start_date', 'end_date')
    //         ->where('student_study_sessions.id', $studentStudySessionId)
    //         ->first();
    
    //     if (!$schoolSessionDates) {
    //         // Handle if school session not found for the provided student_study_session_id
    //         return response()->json(['error' => 'School session not found'], 404);
    //     }
    
    //     // Initialize CarbonPeriod for the interval between start_date and the current date
    //     $period = CarbonPeriod::create($schoolSessionDates->start_date, now());
    
    //     // Get all attendance timetable IDs and their names
    //     $attendanceTimetables = DB::table('attendance_timetables')
    //         ->select('id', 'name')
    //         ->get();
    
    //     // Initialize an array to store absent attendances
    //     $absentAttendances = [];
    
    //     // Loop through each day in the interval
    //     foreach ($period as $date) {
    //         // Check if the day is not a Friday or Saturday
    //         if ($date->dayOfWeek !== Carbon::FRIDAY && $date->dayOfWeek !== Carbon::SATURDAY) {
    //             // Loop through each attendance timetable
    //             foreach ($attendanceTimetables as $timetable) {
    //                 // Check if there is an attendance record for the current date and timetable ID
    //                 $attendanceRecord = DB::table('attendances')
    //                     ->where('student_study_session_id', $studentStudySessionId)
    //                     ->where('attendance_timetable_id', $timetable->id)
    //                     ->whereDate(DB::raw("STR_TO_DATE(date_time_in, '%m/%d/%y %H:%i:%s')"), $date->format('Y-m-d'))
    //                     ->whereIn('is_attend', [1, 2])
    //                     ->first();
    
    //                 // If no attendance record exists for this date and timetable, or if it exists but is marked as not attended, consider it absent
    //                 if (!$attendanceRecord) {
    //                     $absentAttendances[] = [
    //                         'attendance_timetable_id' => $timetable->id,
    //                         'student_study_session_id' => $studentStudySessionId,
    //                         'is_attend' => 0, // Marked as absent
    //                         'date_time_in' => $date->format('Y-m-d'), // Date of absence
    //                         'date_time_out' => null, // Not recorded
    //                         'name' => $timetable->name
    //                     ];
    //                 }
    //             }
    //         }
    //     }
    
    //     // Return the list of absent attendances
    //     return response()->json( $absentAttendances, 200);
    // }

    public function ListAbsent(Request $request)
    {
        // Get the student_study_session_id from the request
        $studentStudySessionId = $request->input('student_study_session_id');
        Log::info('studentStudySessionId: ' . $studentStudySessionId);

        // Retrieve the start date and end date of the school session
            $schoolSessionDates = DB::table('student_study_sessions')
            ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
            ->join('school_sessions', 'school_session_classes.school_session_id', '=', 'school_sessions.id')
            ->select('school_sessions.start_date', 'school_sessions.end_date')
            ->where('student_study_sessions.id', $studentStudySessionId)
            ->first();

        if (!$schoolSessionDates) {
            // Handle if school session not found for the provided student_study_session_id
            return response()->json(['error' => 'School session not found'], 404);
        }

        // Initialize CarbonPeriod for the interval between start_date and the current date
        $period = CarbonPeriod::create($schoolSessionDates->start_date, now());

        // Get all attendance timetable IDs and their names
        $attendanceTimetables = DB::table('attendance_timetables')
            ->select('id', 'name', 'occurrence_id')
            ->get();

        // Get the description of occurrence types
        $occurrenceTypes = DB::table('occurrence_types')
            ->pluck('description', 'id');

        // Initialize an array to store absent attendances
        $absentAttendances = [];

        // Loop through each day in the interval
        foreach ($period as $date) {
            // Get the date string in 'Y-m-d' format
            $dateString = $date->format('Y-m-d');

            // Get the day of the week in uppercase (e.g., "MONDAY", "TUESDAY")
            $dayOfWeek = strtoupper($date->englishDayOfWeek);

            // Concatenate the date string with the day of the week
            $dateTimeIn = $dateString . ' (' . $dayOfWeek . ')';

            // Loop through each attendance timetable
            foreach ($attendanceTimetables as $timetable) {
                // Check if the occurrence type description includes the current day of the week
                if (strpos(strtoupper($occurrenceTypes[$timetable->occurrence_id]), $dayOfWeek) !== false || strpos($occurrenceTypes[$timetable->occurrence_id], 'EVERYDAY') !== false) {
                    // Check if there is an attendance record for the current date and timetable ID
                    $attendanceRecord = DB::table('attendances')
                        ->where('student_study_session_id', $studentStudySessionId)
                        ->where('attendance_timetable_id', $timetable->id)
                        ->whereDate(DB::raw("STR_TO_DATE(date_time_in, '%m/%d/%y %H:%i:%s')"), $date->format('Y-m-d'))
                        ->whereIn('is_attend', [1, 2])
                        ->first();

                    // If no attendance record exists for this date and timetable, or if it exists but is marked as not attended, consider it absent
                    if (!$attendanceRecord) {
                        $absentAttendances[] = [
                            'attendance_timetable_id' => $timetable->id,
                            'student_study_session_id' => $studentStudySessionId,
                            'is_attend' => 0, // Marked as absent
                            'date_time_in' => $dateTimeIn, // Date of absence with day of the week
                            'date_time_out' => null, // Not recorded
                            'name' => $timetable->name
                        ];
                    }
                }
            }
        }

        // Return the list of absent attendances
        return response()->json($absentAttendances, 200);
    }

    public function recordAttendanceLeave(Request $request) {
        // Extract data from the request
        $date_time_in = $request->input('date_time_in');
        $is_attend = $request->input('is_attend');
        $checkpoint_id = $request->input('checkpoint_id');
        $student_study_session_id = $request->input('student_study_session_id');

        // Fetch the student study session based on the provided ID
        $studentStudySession = StudentStudySession::find($student_study_session_id);

        // Check if the student study session exists
        if (!$studentStudySession) {
            return response()->json(['error' => 'Student study session not found'], 404);
        }

        // Get the student type
        $studentType = $studentStudySession->student->type_student;

        // Retrieve all attendance timetable IDs based on the student type
        $attendanceTimetableIds = [];
        if ($studentType === 'DAILY STUDENT') {
            // For daily students, only use attendance timetable ID 1
            $attendanceTimetableIds[] = 1;
        } elseif ($studentType === 'BOARDING STUDENT') {
            // For boarding students, retrieve all attendance timetable IDs
            $attendanceTimetables = AttendanceTimetable::all();
            foreach ($attendanceTimetables as $timetable) {
                $attendanceTimetableIds[] = $timetable->id;
            }
        }

        // Record attendance for each timetable ID
        foreach ($attendanceTimetableIds as $timetableId) {
            // Create a new Attendance record
            $attendance = new Attendance();
            $attendance->date_time_in = $date_time_in;
            $attendance->is_attend = $is_attend;
            $attendance->checkpoint_id = $checkpoint_id;
            $attendance->attendance_timetable_id = $timetableId;
            $attendance->student_study_session_id = $student_study_session_id;
            // Save the attendance record
            $attendance->save();
        }

        // Return a success response
        return response()->json(['message' => 'Attendance recorded successfully'], 200);
    }

    public function getAttendanceWarning(Request $request)
    {
        $studentId = $request->input('studentId');
        $teacherId = $request->input('teacherId');

        Log::info('studentId: ' . $studentId);
        Log::info('teacherId: ' . $teacherId);

        // Define thresholds and conditions for warnings and suspension
        $firstWarningThreshold = 3;
        $secondWarningThreshold = 10;
        $thirdWarningThreshold = 17;
        $suspensionThreshold = 31;
        $firstWarningUncontinuous = 10;
        $secondWarningUncontinuous = 20;
        $thirdWarningUncontinuous = 40;
        $suspensionUncontinuous = 60;

        // Get the current year and session
        $currentYear = Carbon::now()->year;
        $currentSession = SchoolSession::where('year', $currentYear)->first();
        if (!$currentSession) {
            return response()->json(['error' => 'No school session found for the current year.'], 404);
        }

        // Retrieve class and study session information
        $schoolSessionClass = DB::table('school_session_classes')
            ->where('school_session_id', $currentSession->id)
            ->where('staff_id', $teacherId)
            ->first();

        if (!$schoolSessionClass) {
            return response()->json(['error' => 'No class found for the given teacher in the current session.'], 404);
        }

        $studentStudySession = DB::table('student_study_sessions')
            ->where('ssc_id', $schoolSessionClass->id)
            ->where('student_id', $studentId)
            ->first();
        if (!$studentStudySession) {
            return response()->json(['error' => 'No study session found for the given student in the specified class.'], 404);
        }

        // Retrieve all attendance records
        $attendances = Attendance::where('student_study_session_id', $studentStudySession->id)
            ->orderBy('date_time_in')
            ->get();

        Log::info('Retrieve all attendance records.', $attendances->toArray());

        // Generate all relevant dates from session start date to current date
        $sessionStartDate = Carbon::parse($currentSession->start_date);
        $currentDate = Carbon::now();
        $allDates = [];
        for ($date = $sessionStartDate; $date <= $currentDate; $date->addDay()) {
            if (in_array($date->dayOfWeek, [0, 1, 2, 3, 4])) {
                $allDates[] = $date->format('m/d/y');
            }
        }

        Log::info('all date: ', ['date' => $allDates]);


        // Initialize arrays for tracking absences
        $continuousAbsences = [];
        $nonContinuousAbsences = [];
        $currentContinuousCount = 0;
        $currentContinuousDates = [];
        $allAbsentDates = [];
        $previousDate = null;

        foreach ($allDates as $date) {
            Log::info('date records : ', ['date' => $date]);
        
            // Filter attendance records for the specific date and timetable ID
            $attendance = $attendances->filter(function ($att) use ($date) {
                return strpos($att->date_time_in, $date) !== false && $att->attendance_timetable_id == 1;
            })->first();
        
            if (!$attendance || $attendance->is_attend == 0) {
                Log::info('jumpa : ', ['attendance' => $attendance]);
                if ($previousDate) {
                    $daysDifference = Carbon::createFromFormat('m/d/y', $date)->diffInDays($previousDate);
                    if ($daysDifference == 1 && in_array(Carbon::createFromFormat('m/d/y', $date)->dayOfWeek, [0, 1, 2, 3, 4])) {
                        $currentContinuousCount++;
                        $currentContinuousDates[] = $date;
                    } else {
                        if ($currentContinuousCount > 0) {
                            $continuousAbsences[] = [
                                'count' => $currentContinuousCount,
                                'dates' => $currentContinuousDates,
                            ];
                        }
                        $currentContinuousCount = 1;
                        $currentContinuousDates = [$date];
                    }
                } else {
                    $currentContinuousCount = 1;
                    $currentContinuousDates = [$date];
                }
                $allAbsentDates[] = $date;
                $previousDate = $date;
                Log::info('previous date records : ', ['date' => $previousDate]);
            } else {
                if ($currentContinuousCount > 0) {
                    $continuousAbsences[] = [
                        'count' => $currentContinuousCount,
                        'dates' => $currentContinuousDates,
                    ];
                }
                $currentContinuousCount = 0;
                $currentContinuousDates = [];
                $previousDate = null;
            }
        }
        
        if ($currentContinuousCount > 0) {
            $continuousAbsences[] = [
                'count' => $currentContinuousCount,
                'dates' => $currentContinuousDates,
            ];
        }


        // Calculate non-continuous absences by excluding continuous absence dates
        $continuousAbsentDates = array_merge(...array_column($continuousAbsences, 'dates'));
        $filteredNonContinuousAbsences = array_filter($allAbsentDates, function($date) use ($continuousAbsentDates) {
            return !in_array($date, $continuousAbsentDates);
        });

        // Determine warnings based on continuous absences
        $warnings = [];
        $totalContinuousAbsences = array_sum(array_column($continuousAbsences, 'count'));
    
        // Aggregate all continuous absence dates
        $allContinuousDates = [];
        foreach ($continuousAbsences as $continuousAbsence) {
            $allContinuousDates = array_merge($allContinuousDates, $continuousAbsence['dates']);
        }

        // Sort the dates to ensure they are in order
        sort($allContinuousDates);
        $datesCount = count($allContinuousDates);

        // Generate warnings based on thresholds
        if ($totalContinuousAbsences >= $firstWarningThreshold) {
            $warnings[] = '1st warning: Continuous absences from ' . $allContinuousDates[0] . ' to ' . ($allContinuousDates[min(2, $datesCount - 1)] ?? end($allContinuousDates));
        }
        if ($totalContinuousAbsences >= $secondWarningThreshold) {
            $start = min(3, $datesCount - 1);
            $end = min(9, $datesCount - 1);
            $warnings[] = '2nd warning: Continuous absences from ' . $allContinuousDates[$start] . ' to ' . ($allContinuousDates[$end] ?? end($allContinuousDates));
        }
        if ($totalContinuousAbsences >= $thirdWarningThreshold) {
            $start = min(10, $datesCount - 1);
            $end = min(17, $datesCount - 1);
            $warnings[] = '3rd warning: Continuous absences from ' . $allContinuousDates[$start] . ' to ' . ($allContinuousDates[$end] ?? end($allContinuousDates));
        }
        if ($totalContinuousAbsences >= $suspensionThreshold)
        {
            $warnings[] = 'Student can be suspended due to continuous absences exceeding 31 days.';
        }
    

        // Determine warnings based on non-continuous absences
        $totalNonContinuousAbsences = count($filteredNonContinuousAbsences);
        
        if ($totalNonContinuousAbsences >= $firstWarningUncontinuous) {
            $warnings[] = '1st warning: Non-continuous absences on ' . implode(', ', array_slice($filteredNonContinuousAbsences, 0, $firstWarningUncontinuous));
        }
        if ($totalNonContinuousAbsences >= $secondWarningUncontinuous) {
            $warnings[] = '2nd warning: Non-continuous absences on ' . implode(', ', array_slice($filteredNonContinuousAbsences, $firstWarningUncontinuous, $secondWarningUncontinuous - $firstWarningUncontinuous));
        }
        if ($totalNonContinuousAbsences >= $thirdWarningUncontinuous) {
            $warnings[] = '3rd warning: Non-continuous absences on ' . implode(', ', array_slice($filteredNonContinuousAbsences, $secondWarningUncontinuous, $thirdWarningUncontinuous - $secondWarningUncontinuous));
        }
        if ($totalNonContinuousAbsences >= $suspensionUncontinuous){
            $warnings[] = 'Student can be suspended due to non-continuous absences exceeding 60 days.';
        }
        

        return response()->json(['warnings' => $warnings]);
    }

    //for web
    public function listOfWarning(Request $request)
    {
        Log::info('Fetching attendance warnings for all students.');

        // Define thresholds and conditions for warnings and suspension
        $firstWarningThreshold = 3;
        $secondWarningThreshold = 10;
        $thirdWarningThreshold = 17;
        $suspensionThreshold = 31;
        $firstWarningUncontinuous = 10;
        $secondWarningUncontinuous = 20;
        $thirdWarningUncontinuous = 40;
        $suspensionUncontinuous = 60;

        // Get the current year and session
        $currentYear = Carbon::now()->year;
        $currentSession = SchoolSession::where('year', $currentYear)->first();
        if (!$currentSession) {
            return response()->json(['error' => 'No school session found for the current year.'], 404);
        }

        // Retrieve all school session classes for the current session
        $schoolSessionClasses = DB::table('school_session_classes')
            ->join('classrooms', 'school_session_classes.class_id', '=', 'classrooms.id')
            ->where('school_session_id', $currentSession->id)
            ->select('school_session_classes.id as ssc_id', 'classrooms.form_number', 'classrooms.name as class_name')
            ->get();

        if ($schoolSessionClasses->isEmpty()) {
            return response()->json(['error' => 'No classes found for the current session.'], 404);
        }

        // Initialize results array
        $results = [];

        foreach ($schoolSessionClasses as $schoolSessionClass) {
            // Retrieve all students in the current class
            $studentStudySessions = DB::table('student_study_sessions')
                ->where('ssc_id', $schoolSessionClass->ssc_id)
                ->get();

            if ($studentStudySessions->isEmpty()) {
                continue; // No students in this class, skip
            }

            foreach ($studentStudySessions as $studentStudySession) {
                $studentId = $studentStudySession->student_id;

                // Retrieve the student's data
                $student = DB::table('students')->find($studentId);
                if (!$student) continue;

                // Retrieve all attendance records for the student
                $attendances = Attendance::where('student_study_session_id', $studentStudySession->id)
                    ->orderBy('date_time_in')
                    ->get();

                // Generate all relevant dates from session start date to current date
                $sessionStartDate = Carbon::parse($currentSession->start_date);
                $currentDate = Carbon::now();
                $allDates = [];
                for ($date = $sessionStartDate; $date <= $currentDate; $date->addDay()) {
                    if (in_array($date->dayOfWeek, [0, 1, 2, 3, 4])) {
                        $allDates[] = $date->format('m/d/y');
                    }
                }

                // Initialize arrays for tracking absences
                $continuousAbsences = [];
                $nonContinuousAbsences = [];
                $currentContinuousCount = 0;
                $currentContinuousDates = [];
                $allAbsentDates = [];
                $previousDate = null;

                foreach ($allDates as $date) {
                    // Filter attendance records for the specific date and timetable ID
                    $attendance = $attendances->filter(function ($att) use ($date) {
                        return strpos($att->date_time_in, $date) !== false && $att->attendance_timetable_id == 1;
                    })->first();
            
                    if (!$attendance || $attendance->is_attend == 0) {
                        if ($previousDate) {
                            $daysDifference = Carbon::createFromFormat('m/d/y', $date)->diffInDays($previousDate);
                            if ($daysDifference == 1 && in_array(Carbon::createFromFormat('m/d/y', $date)->dayOfWeek, [0, 1, 2, 3, 4])) {
                                $currentContinuousCount++;
                                $currentContinuousDates[] = $date;
                            } else {
                                if ($currentContinuousCount > 0) {
                                    $continuousAbsences[] = [
                                        'count' => $currentContinuousCount,
                                        'dates' => $currentContinuousDates,
                                    ];
                                }
                                $currentContinuousCount = 1;
                                $currentContinuousDates = [$date];
                            }
                        } else {
                            $currentContinuousCount = 1;
                            $currentContinuousDates = [$date];
                        }
                        $allAbsentDates[] = $date;
                        $previousDate = Carbon::createFromFormat('m/d/y', $date);
                    } else {
                        if ($currentContinuousCount > 0) {
                            $continuousAbsences[] = [
                                'count' => $currentContinuousCount,
                                'dates' => $currentContinuousDates,
                            ];
                        }
                        $currentContinuousCount = 0;
                        $currentContinuousDates = [];
                        $previousDate = null;
                    }
                }

                if ($currentContinuousCount > 0) {
                    $continuousAbsences[] = [
                        'count' => $currentContinuousCount,
                        'dates' => $currentContinuousDates,
                    ];
                }

                // Calculate non-continuous absences by excluding continuous absence dates
                $continuousAbsentDates = array_merge(...array_column($continuousAbsences, 'dates'));
                $filteredNonContinuousAbsences = array_filter($allAbsentDates, function($date) use ($continuousAbsentDates) {
                    return !in_array($date, $continuousAbsentDates);
                });

                // Determine warnings based on continuous absences
                $warnings = [];
                $totalContinuousAbsences = array_sum(array_column($continuousAbsences, 'count'));
            
                // Aggregate all continuous absence dates
                $allContinuousDates = [];
                foreach ($continuousAbsences as $continuousAbsence) {
                    $allContinuousDates = array_merge($allContinuousDates, $continuousAbsence['dates']);
                }

                // Sort the dates to ensure they are in order
                sort($allContinuousDates);
                $datesCount = count($allContinuousDates);

                $totalday = $totalContinuousAbsences;

                // Generate warnings based on thresholds
                if ($totalContinuousAbsences >= $firstWarningThreshold) {
                    $warnings[] = 'Amaran Pertama : Tidak hadir secara berturut-turut bermula ' . $allContinuousDates[0] . ' sehingga ' . ($allContinuousDates[min(2, $datesCount - 1)] ?? end($allContinuousDates));
                    
                }
                if ($totalContinuousAbsences >= $secondWarningThreshold) {
                    $start = min(3, $datesCount - 1);
                    $end = min(9, $datesCount - 1);
                    $warnings[] = 'Amaran Kedua :  Tidak hadir secara berturut-turut bermula ' . $allContinuousDates[$start] . ' sehingga ' . ($allContinuousDates[$end] ?? end($allContinuousDates));
                }
                if ($totalContinuousAbsences >= $thirdWarningThreshold) {
                    $start = min(10, $datesCount - 1);
                    $end = min(17, $datesCount - 1);
                    $warnings[] = 'Amaran Ketiga : Tidak hadir secara berturut-turut bermula ' . $allContinuousDates[$start] . ' sehingga ' . ($allContinuousDates[$end] ?? end($allContinuousDates));
                }
                if ($totalContinuousAbsences >= $suspensionThreshold) {
                    $warnings[] = 'Pelajar boleh digantung/dibuang sekolah kerana tidak hadir ke sekolah melebihi 31 hari waktu persekolahan.';
                }

                // Determine warnings based on non-continuous absences
                $totalNonContinuousAbsences = count($filteredNonContinuousAbsences);
                
                if ($totalNonContinuousAbsences >= $firstWarningUncontinuous) {
                    $warnings[] = 'Amaran Pertama : Tidak hadir secara berkala pada ' . implode(', ', array_slice($filteredNonContinuousAbsences, 0, $firstWarningUncontinuous));
                }
                if ($totalNonContinuousAbsences >= $secondWarningUncontinuous) {
                    $warnings[] = 'Amaran Kedua : Tidak hadir secara berkala pada ' . implode(', ', array_slice($filteredNonContinuousAbsences, $firstWarningUncontinuous, $secondWarningUncontinuous - $firstWarningUncontinuous));
                }
                if ($totalNonContinuousAbsences >= $thirdWarningUncontinuous) {
                    $warnings[] = 'Amaran Ketiga : Tidak hadir secara berkala pada ' . implode(', ', array_slice($filteredNonContinuousAbsences, $secondWarningUncontinuous, $thirdWarningUncontinuous - $secondWarningUncontinuous));
                }
                if ($totalNonContinuousAbsences >= $suspensionUncontinuous) {
                    $warnings[] = 'Pelajar boleh digantung/dibuang sekolah kerana tidak hadir ke sekolah melebihi 60 hari waktu persekolahan.';
                }

                // Combine form number and class name
                $combinedClassName =  $schoolSessionClass->form_number . ' ' . $schoolSessionClass->class_name;

                // Add student results to the final output
                $results[] = [
                    'student_name' => $student->name,
                    'student_id' => $student->id,
                    'class' => $combinedClassName, // Combined class name
                    'warnings' => $warnings,
                    'total_day' => $totalday
                ];
            }
        }

        return response()->json(['students' => $results]);
    }


    public function sendMessage(Request $request)
    {
        $date = $request->input('date');
        $isAttend = $request->input('is_attend'); // Get the is_attend from the request

        Log::info('Date:', ['date' => $date]);
        Log::info('Is Attend:', ['is_attend' => $isAttend]);

        // Fetch students with related data and filter attendances by date and is_attend
        $students = Student::with([
            'parentGuardian',
            'studentStudySessions.attendances' => function ($query) use ($date, $isAttend) {
                $query->where('date_time_in', 'like', $date . '%')
                    ->where('is_attend', $isAttend);
            },
            'studentStudySessions.attendances.attendanceTimetable'
        ])->where(function ($query) {
            $query->where('type_student', 'DAILY STUDENT')
                ->orWhere('type_student', 'BOARDING STUDENT');
        })->get();

        Log::info('Students:', ['students' => $students]);

        $result = [];

        foreach ($students as $student) {
            // Determine the status based on is_attend
            $status = 'unknown';
            switch ($isAttend) {
                case 0:
                    $status = 'absent';
                    break;
                case 1:
                    $status = 'attend to school';
                    break;
                case 2:
                    $status = 'on leave';
                    break;
            }

            $studentData = [
                'student_name' => $student->name,
                'parent_name' => $student->parentGuardian->name,
                'parent_username' => $student->parentGuardian->username,
                'status' => $status,
                'attendance' => []
            ];

            foreach ($student->studentStudySessions as $session) {
                foreach ($session->attendances as $attendance) {
                    $studentData['attendance'][] = $attendance->attendanceTimetable->name;
                }
            }

            if (!empty($studentData['attendance'])) {
                $result[] = $studentData;
            }
        }

        return response()->json($result);
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
