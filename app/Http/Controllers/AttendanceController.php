<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\SchoolSession;
use App\Models\StudentStudySession;
use App\Models\AttendanceTimetable;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

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
            $datePart = $date->format('m/d/y');

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

            // If the student is not a DAILY STUDENT or if the occurrence type is not 'SUNDAY TO THURSDAY', proceed to record the attendance
            $attendance = Attendance::create([
                'date_time_in' => $request->input('date_time_in'),
                'date_time_out' => $request->input('date_time_out'),
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
        $attendances = Attendance::with(['studentStudySession.student', 'checkpoint', 'attendanceTimetable'])
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
            $phone_number = $student->parentGuardian ? $student->parentGuardian-> phone_number : "";
            $cardRfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tagRfid = $student->tagRfid ? $student->tagRfid->number : "null";
            $className = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->name : "";
            $formNumber = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->form_number : "";
            $attendanceDateTime = $attendance->is_attend == 2 ? "EXCUSED" :($attendance->is_attend == 0 ? "ABSENT" : $attendance->date_time_in);
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
    
        $studentsWithoutAttendance->each(function ($student) use ($allStudents) {
            $parentName = $student->parentGuardian ? $student->parentGuardian->name : "";
            $phone_number = $student->parentGuardian ? $student->parentGuardian->phone_number : "";
            $cardRfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tagRfid = $student->tagRfid ? $student->tagRfid->number : "null";
            $className = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->name : "";
            $formNumber = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->form_number : "";
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
