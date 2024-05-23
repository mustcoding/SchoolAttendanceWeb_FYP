<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    ////
    public function registerClass(Request $request)
    {
        // Validate fields, including custom binary validation rule
        $attrs = $request->validate([
            'name' => 'required|string',
            'form_number' => 'required|integer',
            'max_capacity' => 'required|integer',
            'is_Delete' => 'required|integer',
        ]);
///
        // Create user
        $class = Classroom::create([
            'name' => $attrs['name'],
            'form_number' => $attrs['form_number'],
            'max_capacity' => $attrs['max_capacity'],
            'is_Delete' => $attrs['is_Delete'],
        ]);

        // Return user & token in response
        return response([
            'class' => $class
        ], 200);
    }

    public function totalClassroom()
    {
        try {
            $totalClassroom = Classroom::count();
            return response()->json(['count' => $totalClassroom]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function getAllClassroom() {
        // Get classrooms that are not present in the school_session_classes table
        $classroomsNotInSchoolSessionClasses = Classroom::whereNotIn('id', function($query) {
            $query->select('class_id')->from('school_session_classes');
        });
    
        // Get classrooms with number of students below max_capacity
        $classroomsBelowMaxCapacity = Classroom::whereHas('students', function ($query) {
            // Add condition to check if number of students is below max_capacity
            $query->havingRaw('COUNT(*) < max_capacity');
        });
    
        // Combine both conditions using union
        $classrooms = $classroomsNotInSchoolSessionClasses->union($classroomsBelowMaxCapacity)->get();
    
        // Calculate current available size for each classroom
        $classrooms->each(function($classroom) {
            $currentSize = $classroom->students->count();
            $availableSize = $classroom->max_capacity - $currentSize;
            $classroom->setAttribute('available_size', $availableSize);
        });
    
        return response()->json($classrooms);
    }

    public function getListClassroom() {
        $classroom = Classroom::where('is_Delete',0)->get();
        return response()->json($classroom); // Return as JSON, adjust as needed
    }

    public function GetClassroom($id)
    {
        // Retrieve the user by their ID
        $classroom = Classroom::find($id);

        // Check if the user exists
        if ($classroom) {
            return response([
                'classroom' => $classroom,
                'message' => 'Successfully retrieving data'
            ], 200);
        }
        else{

            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
    }

    public function DeleteClassroom(Request $request, $id)
    {

        // Retrieve the user by ID
        $classroom = Classroom::find($id);

        // Check if the user exists
        if (!$classroom) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $classroom->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $classroom->save();

        // Return a success response
        return response()->json(['message' => 'Classroom Deleted Successfully', 'classroom' => $classroom]);
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
    public function store(StoreClassroomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
