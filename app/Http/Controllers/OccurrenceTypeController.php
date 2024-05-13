<?php

namespace App\Http\Controllers;

use App\Models\OccurrenceType;
use App\Http\Requests\StoreOccurrenceTypeRequest;
use App\Http\Requests\UpdateOccurrenceTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OccurrenceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addOccurrenceType(Request $request)
    {
        // Validate fields, including custom binary validation rule
        $attrs = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_Delete' => 'nullable|integer', // Ensure description is either provided or nullable
        ]);

        // Create user
        $OccurrenceType = OccurrenceType::create([
            'name' => $attrs['name'],
            'description' => $attrs['description'],
            'is_Delete' => $attrs['is_Delete'],
        ]);

        // Return user & token in response
        return response([
            'OccurrenceType' => $OccurrenceType
        ], 200);
    }

    public function getAllOccurrences() {
        $data = OccurrenceType::where('is_Delete',0)->get();
        return response()->json($data); // Return as JSON, adjust as needed
    }

    public function DeleteOccurrence(Request $request, $id)
    {

        // Retrieve the user by ID
        $occurrence = OccurrenceType::find($id);

        // Check if the user exists
        if (!$occurrence) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $occurrence->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $occurrence->save();

        // Return a success response
        return response()->json(['message' => 'Activity Occurrence updated successfully', 'occurrence' => $occurrence]);
    }

    public function updateOccurrence(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $occurrence = OccurrenceType::find($id);

        // Check if the user exists
        if (!$occurrence) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $occurrence->name = $request->input('name');
        $occurrence->description = $request->input('description');
        // Update other fields as needed

        // Save the changes to the database
        $occurrence->save();

        // Return a success response
        return response()->json(['message' => 'Activity Occurrence updated successfully', 'occurrence' => $occurrence]);
    }

    public function OccurrenceData($id)
    {
        // Retrieve the user by their ID
        $occurrence = OccurrenceType::find($id);

        // Check if the user exists
        if ($occurrence) {
            return response([
                'occurrence' => $occurrence,
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
    public function store(StoreOccurrenceTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OccurrenceType $occurrenceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OccurrenceType $occurrenceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOccurrenceTypeRequest $request, OccurrenceType $occurrenceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OccurrenceType $occurrenceType)
    {
        //
    }
}
