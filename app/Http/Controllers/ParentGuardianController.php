<?php

namespace App\Http\Controllers;
use App\Models\ParentGuardian;
use App\Http\Requests\StoreParentGuardianRequest;
use App\Http\Requests\UpdateParentGuardianRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request; // Import the Request class

class ParentGuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerParent(Request $request)
    {
        try {
            // Your existing validation and user creation code
    
             // If validation passes, create user
            $parent = ParentGuardian::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'nickname' => $request->input('nickname'),
                'is_Delete' => $request->input('is_Delete'),
            ]);

            // Return success response with 200 status code
            return response()->json([
                'message' => 'Parent registered successfully',
                'parent' => $parent
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

    public function CheckParent(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'nickname' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'is_Delete' => 'required|integer',
       
        ]);

        // Search for the user
        $user = ParentGuardian::where('name', $request->name)
             ->where('phone_number', $request->phone_number)
             ->where('address', $request->address)
             ->first();


        if ($user) {
            // User found, return user data
            return response()->json(['id' => $user->id], 200);
        } else {
            // User not found, create and save new user
            $newUser = new ParentGuardian([
                'name' => $request->name,
                'nickname' => $request->nickname,
                'username' => $request->username,
                'password' => $request->password,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'is_Delete' => $request->is_Delete,
            ]);

            $newUser->save();

            return response()->json(['id' => $newUser->id], 200);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'nickname' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $parent = ParentGuardian::find($id);

        // Check if the user exists
        if (!$parent) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $parent->name = $request->input('name');
        $parent->phone_number = $request->input('phone_number');
        $parent->address = $request->input('address');
        $parent->nickname = $request->input('nickname');
        // Update other fields as needed

        // Save the changes to the database
        $parent->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'parent' => $parent]);
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
    public function store(StoreParentGuardianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ParentGuardian $parentGuardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentGuardian $parentGuardian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParentGuardianRequest $request, ParentGuardian $parentGuardian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentGuardian $parentGuardian)
    {
        //
    }
}
