<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolSession;
use App\Models\SchoolSessionClass;
use App\Models\StudentImage;
use App\Models\ParentGuardian;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerStudent(Request $request)
    {
        // Validate fields, including custom binary validation rule
        $attrs = $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'parent_guardian_id' => 'required|integer',
            'card_rfid' => 'required|integer',
            'tag_rfid' => 'required|integer',
            'is_Delete' => 'required|integer',
            'type_student' => 'required|string',
            
        ]);

        // Create user
        $student = Student::create([
            'name' => $attrs['name'],
            'date_of_birth' => $attrs['date_of_birth'],
            'parent_guardian_id' => $attrs['parent_guardian_id'],
            'card_rfid' => $attrs['card_rfid'],
            'tag_rfid' => $attrs['tag_rfid'],
            'is_Delete' => $attrs['is_Delete'],
            'type_student' => $attrs['type_student'],
        ]);

        // Return user & token in response
        return response([
            'student' => $student
        ], 200);
    }

    public function totalStudents()
    {
        try {
            $totalStudents = Student::where('is_Delete',0)->count();
            return response()->json(['count' => $totalStudents]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function totalAlumni()
    {
        try {
            $totalStudents = Student::where('is_Delete',1)->count();
            return response()->json(['count' => $totalStudents]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function getStudentByBirthYear(Request $request)
    {
        try {
            // Get the birth year from the request
            $birthYear = $request->date_of_birth;

            // Query students using parameter binding
            $students = Student::whereYear('date_of_birth', $birthYear)
                ->whereNotIn('id', function($query) {
                    $query->select('student_id')->from('student_study_sessions')
                    ->where('is_Delete',0);
                })
                ->get();

            // Check if any student is found
            if ($students->isEmpty()) {
                return response()->json([
                    'message' => 'No student found for the given birth year or all students are already in study sessions.',
                ], 404);
            }

            // Return the found students
            return response()->json(['students' => $students], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 400);
        }
    }
    
    public function getAllStudents()
    {
        // Retrieve the current school session
        $currentSession = SchoolSession::where('is_Delete', 0)->whereYear('start_date', '<=', now())->whereYear('end_date', '>=', now())->first();

        if (!$currentSession) {
            // If there is no current session, return an empty array or appropriate response
            return response()->json([]);
        }

        // Retrieve all students enrolled in the current school session
        $data = Student::with(['parentGuardian', 'tagRfid', 'cardRfid', 'classrooms'])
                        ->where('is_Delete', 0)
                        ->whereHas('classrooms.schoolSessionClasses', function ($query) use ($currentSession) {
                            $query->where('school_session_id', $currentSession->id);
                        })
                        ->get();

        // Transform the data as needed, for example, extract required fields
        $formattedData = $data->map(function ($student) {
            $parentName = $student->parentGuardian ? $student->parentGuardian->name : "";
            $card_rfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tag_rfid = $student->tagRfid ? $student->tagRfid->number : "null";
            $className = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->name : "";
            $formNumber = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->form_number : "";

            return [
                'student_id' => $student->id,
                'name' => $student->name,
                'date_of_birth' => $student->date_of_birth,
                'parent_name' => $parentName,
                'card_rfid' => $card_rfid,
                'tag_rfid' => $tag_rfid,
                'class_name' => $className,
                'form_number' => $formNumber,
            ];
        });

        return response()->json($formattedData);
    }


    public function getAllStudentsManagement()
    {
        // Retrieve the current school session
        $currentSession = SchoolSession::where('is_Delete', 0)->whereYear('start_date', '<=', now())->whereYear('end_date', '>=', now())->first();

        if (!$currentSession) {
            // If there is no current session, return an empty array or appropriate response
            return response()->json([]);
        }

        // Retrieve all students enrolled in the current school session
        $data = Student::with(['parentGuardian', 'tagRfid', 'cardRfid', 'classrooms'])
                        ->where('is_Delete', 0)
                        ->get();

        // Transform the data as needed, for example, extract required fields
        $formattedData = $data->map(function ($student) {
            $parentName = $student->parentGuardian ? $student->parentGuardian->name : "";
            $card_rfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tag_rfid = $student->tagRfid ? $student->tagRfid->number : "null";
            $className = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->name : "";
            $formNumber = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->form_number : "";

            return [
                'student_id' => $student->id,
                'name' => $student->name,
                'date_of_birth' => $student->date_of_birth,
                'parent_name' => $parentName,
                'card_rfid' => $card_rfid,
                'tag_rfid' => $tag_rfid,
                'class_name' => $className,
                'form_number' => $formNumber,
            ];
        });

        return response()->json($formattedData);
    }

    public function studentById(Request $request)
    {
        // Get the student ID from the request
        $id = $request->id;

        // Retrieve the student with the specified ID along with their associated parent/guardian and RFIDs
        $student = Student::with(['parentGuardian', 'cardRfid', 'tagRfid'])->where('id', $id)->first();

        if (!$student) {
            // If the student with the given ID is not found, return an error response
            return response()->json(['error' => 'Student not found'], 404);
        }

        // Transform the data as needed
        $formattedData = [
            'student_id' => $student->id,
            'name' => $student->name,
            'date_of_birth' => $student->date_of_birth,
            'parent_name' => $student->parentGuardian->name,
            'nickname' => $student->parentGuardian->nickname,
            'phone_number' => $student->parentGuardian->phone_number,
            'address' => $student->parentGuardian->address,
            'card_rfid_number' => $student->cardRfid->number,
            'tag_rfid_number' => $student->tagRfid->number,
            'parent_id' => $student->parentGuardian->id,
        ];

        return response()->json($formattedData);
    }

    public function updateStudent(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $student = Student::find($id);

        // Check if the user exists
        if (!$student) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $student->name = $request->input('name');
        $student->date_of_birth = $request->input('date_of_birth');
        // Update other fields as needed

        // Save the changes to the database
        $student->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'student' => $student]);
    }

    public function DeleteStudent(Request $request, $id)
    {

        // Retrieve the user by ID
        $student = Student::find($id);

        // Check if the user exists
        if (!$student) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $student->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $student->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'student' => $student]);
    }


    public function studentDataByRfid(Request $request)
    {
        try {
            // Get the RFID values from the request
            $rfidNumber = $request->rfidNumber;
    
            // Query students using parameter binding with OR condition
            // Include the parent guardian information
            $students = Student::with('parentGuardian')
                                ->where('tag_rfid', $rfidNumber)
                                ->orWhere('card_rfid', $rfidNumber)
                                ->get();
    
            // Check if any student is found by tag_rfid or card_rfid
            if ($students->isEmpty()) {
                return response()->json([
                    'message' => 'No student found for the given RFID values.',
                ], 404);
            }
    
            // Prepare the response data to include parent username
            $response = $students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'date_of_birth' => $student->date_of_birth,
                    'parent_guardian' => [
                        'id' => $student->parentGuardian->id,
                        'username' => $student->parentGuardian->username,
                    ],
                    'card_rfid' => $student->card_rfid,
                    'tag_rfid' => $student->tag_rfid,
                    'type_student' => $student->type_student,
                ];
            });
    
            // Return the found students with parent username
            return response()->json(['students' => $response], 200);
    
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function getStudentBySSC_ClassId(Request $request)
    {
        try {
            // Get the school session ID and classroom ID from the request
            $schoolSessionId = $request->schoolSessionId;
            $classroomId = $request->classroomId;

            // Query to retrieve student data with related parent's name and phone number
            $students = Student::select('students.*', 'parent_guardians.name as parent_name', 'parent_guardians.phone_number as parent_phone_number')
                ->join('parent_guardians', 'students.parent_guardian_id', '=', 'parent_guardians.id')
                ->join('student_study_sessions', 'students.id', '=', 'student_study_sessions.student_id')
                ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
                ->where('school_session_classes.school_session_id', $schoolSessionId)
                ->where('school_session_classes.class_id', $classroomId)
                ->where('student_study_sessions.is_Delete', 0)
                ->get();

            // Return the retrieved student data
            return response()->json($students);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function getTotalStudentInClassroom(Request $request)
    {
        $staffId = $request->input('staff_id'); 
    
        // Fetch the classroom IDs associated with the teacher's staff_id
        $classrooms = SchoolSessionClass::where('staff_id', $staffId)->pluck('class_id');

    
        $totalStudents = 0;
        $currentYear = date('Y');
        $classroomDetails = []; // Initialize as an empty array
        
        foreach ($classrooms as $classroomId) {
            $details = \DB::table('student_study_sessions')
                ->select('classrooms.id as class_id', 'classrooms.name', 'classrooms.form_number')
                ->join('students', 'student_study_sessions.student_id', '=', 'students.id')
                ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
                ->join('school_sessions', 'school_session_classes.school_session_id','=','school_sessions.id')
                ->join('classrooms', 'school_session_classes.class_id','=','classrooms.id')
                ->where('school_sessions.year', $currentYear)
                ->where('school_session_classes.class_id', $classroomId)
                ->get();
            $classroomDetails = array_merge($classroomDetails, $details->toArray()); // Merge arrays
            $totalStudents += count($details);
        }

    
        return response()->json([
            'total_students' => $totalStudents,
            'classroom_details' => $classroomDetails
        ]);
    }
    public function getListStudentInClassroom(Request $request)
    {
        $classId = $request->input('id'); // Assuming classId is sent as a parameter in the request

        // Retrieve the current school session
        $currentSession = SchoolSession::where('is_Delete', 0)
                                        ->whereYear('start_date', '<=', now())
                                        ->whereYear('end_date', '>=', now())
                                        ->first();

       
        if (!$currentSession) {
            // If there is no current session, return an empty array or appropriate response
            return response()->json([]);
        }

        // Retrieve all students enrolled in the current school session and the specified class ID
        $data = Student::with(['parentGuardian', 'tagRfid', 'cardRfid', 'classrooms'])
                        ->where('is_Delete', 0)
                        ->whereHas('classrooms.schoolSessionClasses', function ($query) use ($currentSession, $classId) {
                            $query->where('school_session_id', $currentSession->id)
                                ->where('class_id', $classId); // Filter by the specified class ID
                        })
                        
                        ->get();

        // Transform the data as needed, for example, extract required fields
        $formattedData = $data->map(function ($student) {
            $parentName = $student->parentGuardian ? $student->parentGuardian->name : "";
            $card_rfid = $student->cardRfid ? $student->cardRfid->number : "null";
            $tag_rfid = $student->tagRfid ? $student->tagRfid->number : "null";
            $className = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->name : "";
            $formNumber = $student->classrooms->isNotEmpty() ? $student->classrooms->first()->form_number : "";

            return [
                'student_id' => $student->id,
                'name' => $student->name,
                'date_of_birth' => $student->date_of_birth,
                'parent_name' => $parentName,
                'card_rfid' => $card_rfid,
                'tag_rfid' => $tag_rfid,
                'class_name' => $className,
                'form_number' => $formNumber,
            ];
        });

        return response()->json($formattedData);
    }

    public function TotalChildren(Request $request)
    {
        $id = $request->input('id'); 
    
        // Fetch the classroom IDs associated with the teacher's staff_id
        $totalStudent = Student::where('parent_guardian_id', $id)->count();

        if(!$totalStudent){
            return response()->json([
                'No Children Registered In This School',
            ]);
        }

    
        return response()->json([
            'total_students' => $totalStudent,
        ]);
    }
    
    public function ListChildren(Request $request)
{
    $parentId = $request->input('parent_id');
    $currentYear = Carbon::now()->year;

    $students = Student::with([
            'studentStudySessions.schoolSessionClass.schoolSession',
            'studentStudySessions.schoolSessionClass.classroom',
            'studentStudySessions.schoolSessionClass.staff'
        ])
        ->where('parent_guardian_id', $parentId)
        ->whereHas('studentStudySessions.schoolSessionClass.schoolSession', function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        })
        ->get()
        ->map(function ($student) {
            $currentSessionClass = $student->studentStudySessions->first()->schoolSessionClass;

            return [
                'id' => $student->id,
                'name' => $student->name,
                'teacher_id' => $currentSessionClass->staff->id,
                'teacher_name' => $currentSessionClass->staff->name,
                'class_name' => $currentSessionClass->classroom->name,
                'form_number' => $currentSessionClass->classroom->form_number,
            ];
        });

    return response()->json($students);
}


    // Handle the data sent from Arduino IDE
   public function displayStudent(Request $request)
   {
       // Get the RFID values from the request
       $student_id = $request->student_id;
       $attendance_id = $request->attendance_id;

       Cache::put('student_id', $student_id);
       Cache::put('attendance_id', $attendance_id);
   }
   
   public function toDisplayStudent()
    {
        // Retrieve the RFID value from the cache
        $student_id = Cache::get('student_id');
        $attendance_id = Cache::get('attendance_id');

        // Return the RFID number
        return response()->json([
            'student_id' => $student_id,
            'attendance_id' => $attendance_id
        ]);
    }

    public function getDisplayStudent(Request $request)
    {
        $id = $request->student_id;

        // Retrieve the student by ID
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'No Children Registered In This School',
            ], 404);
        }

        // Retrieve the official image of the student
        $officialImage = StudentImage::where('student_id', $id)
                                    ->where('is_official', 1)
                                    ->first();

        // Retrieve the parent information
        $parent = ParentGuardian::find($student->parent_guardian_id);

        if (!$parent) {
            return response()->json([
                'message' => 'Parent information not found',
            ], 404);
        }

        return response()->json([
            'student' => $student,
            'official_image' => $officialImage,
            'parent_username' => $parent->username,
        ], 200);
    }

    public function getStudentStudySessionByName(Request $request)
    {
        try {
            // Get the student name from the request
            $name = $request->name;

            // Get the current year
            $currentYear = now()->year;

            // Retrieve the student study session ID for the current year
            $studentStudySessions = Student::where('name', $name)
                ->join('student_study_sessions', 'students.id', '=', 'student_study_sessions.student_id')
                ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
                ->join('school_sessions', 'school_session_classes.school_session_id', '=', 'school_sessions.id')
                ->where('school_sessions.year', $currentYear)
                ->where('student_study_sessions.is_Delete', 0)
                ->select('student_study_sessions.id as student_study_session_id')
                ->get();

            // Check if any study sessions are found
            if ($studentStudySessions->isEmpty()) {
                return response()->json([
                    'message' => 'No study session found for the given student name and current year.',
                ], 404);
            }

            // Return the found study session IDs
            return response()->json($studentStudySessions);

        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 400);
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
    public function store(StoreStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function checkImages(Request $request)
    {
        $id = $request->student_id;
    
        // Retrieve the official image of the student
        $image = StudentImage::where('student_id', $id)->where('is_official', 1)->first();

        if ($image && $image->image) {
            // Return the image as a response
            return response()->json([
                'status' => 'success',
                'image' => base64_encode($image->image)
            ]);
        } else {
            // Return a default image or an error message
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found'
            ], 404);
        }
    }

    public function getParentInfo($id)
    {
        // Retrieve the student by their ID
        $student = Student::with('parentGuardian')->find($id);

        // Check if the student and their parent exist
        if ($student && $student->parentGuardian) {
            $parentName = $student->parentGuardian->name;
            $parentAddress = $student->parentGuardian->address;

            return response([
                'parent_name' => $parentName,
                'parent_address' => $parentAddress,
                'message' => 'Successfully retrieved parent information'
            ], 200);
        } else {
            return response([
                'message' => 'Parent information not found for the given student ID.'
            ], 404);
        }
    }
}
