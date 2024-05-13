<?php

namespace App\Http\Controllers;

use App\Models\Checkpoint;
use App\Http\Requests\StoreCheckpointRequest;
use App\Http\Requests\UpdateCheckpointRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckpointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addCheckpoint(Request $request)
{
    // Define custom validation rule
    $rules = [
        'name' => 'required|string',
        'is_Delete' => [function ($attribute, $value, $fail) {
            if ($value != 0) {
                $fail('The '.$attribute.' must be 0.');
            }
        }],
    ];

    // Validate fields
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // If validation passes, create checkpoint
    $checkpoint = Checkpoint::create([
        'name' => $request->name,
        'is_Delete' => $request->is_Delete,
    ]);

    // Return checkpoint in response
    return response()->json(['checkpoint' => $checkpoint], 200);
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
    public function store(StoreCheckpointRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkpoint $checkpoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkpoint $checkpoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheckpointRequest $request, Checkpoint $checkpoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkpoint $checkpoint)
    {
        //
    }
}
