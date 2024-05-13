<?php

namespace App\Http\Controllers;

use App\Models\SchoolSession;
use App\Http\Requests\StoreSchoolSessionRequest;
use App\Http\Requests\UpdateSchoolSessionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SchoolSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerSchoolSession(Request $request)
    {
        // Validate fields, including custom binary validation rule
        $attrs = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'year' => 'required|integer',
            'is_Delete' => 'required|integer',
        ]);

        // Create user
        $schoolSession = SchoolSession::create([
            'start_date' => $attrs['start_date'],
            'end_date' => $attrs['end_date'],
            'year' => $attrs['year'],
            'is_Delete' => $attrs['is_Delete'],
        ]);

        // Return user & token in response
        return response([
            'schoolSession' => $schoolSession
        ], 200);
    }

    public function getAllSchoolSession() {
        $data = SchoolSession::where('is_Delete',0)->get();
        return response()->json($data); // Return as JSON, adjust as needed
    }

    public function DeleteSchoolSession(Request $request, $id)
    {

        // Retrieve the user by ID
        $schoolSession = SchoolSession::find($id);

        // Check if the user exists
        if (!$schoolSession) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $schoolSession->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $schoolSession->save();

        // Return a success response
        return response()->json(['message' => 'School Session Deleted Successfully', 'schoolSession' => $schoolSession]);
    }

    public function updateSchoolSession(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'year' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $schoolSession = SchoolSession::find($id);

        // Check if the user exists
        if (!$schoolSession) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $schoolSession->start_date = $request->input('start_date');
        $schoolSession->end_date = $request->input('end_date');
        $schoolSession->year = $request->input('year');
        // Update other fields as needed

        // Save the changes to the database
        $schoolSession->save();

        // Return a success response
        return response()->json(['message' => 'School Session updated successfully', 'schoolSession' => $schoolSession]);
    }

    public function SchoolSessionData($id)
    {
        // Retrieve the user by their ID
        $schoolSession = SchoolSession::find($id);

        // Check if the user exists
        if ($schoolSession) {
            return response([
                'SchoolSession' => $schoolSession,
                'message' => 'Successfully retrieving data'
            ], 200);
        }
        else{

            return response([
                'message' => 'Invalid credentials.'
            ], 403);
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
    public function store(StoreSchoolSessionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolSession $schoolSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolSession $schoolSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolSessionRequest $request, SchoolSession $schoolSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolSession $schoolSession)
    {
        //
    }
}
