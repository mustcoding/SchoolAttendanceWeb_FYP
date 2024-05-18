<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Staff;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    //Register user
   //Register user
    // Register user
    public function registerStaff(Request $request)
    {
        // Validate fields, including custom binary validation rule
        $attrs = $request->validate([
            'name' => 'required|string',
            'username' => 'required|unique:staff,username',
            'password' => 'required|min:6|confirmed',
            'position' => 'required|string',
            'nickname' => 'required|string',
            'image' => [
                'nullable', // Make the 'image' field nullable
                function ($attribute, $value, $fail) {
                    if (!is_string($value) || !preg_match('~[^\x20-\x7E\t\r\n]~', $value)) {
                        $fail('The '.$attribute.' must contain binary data.');
                    }
                },
            ],
            'is_Delete' => 'required|string'
        ]);

        // Create user
        $staff = Staff::create([
            'name' => $attrs['name'],
            'username' => $attrs['username'],
            'password' => bcrypt($attrs['password']),
            'position' => $attrs['position'],
            'nickname' => $attrs['nickname'],
            'image' => $attrs['image'],
            'is_Delete' => $attrs['is_Delete'],
        ]);

        // Return user & token in response
        return response([
            'staff' => $staff,
            'token' => $staff->createToken('secret')->plainTextToken
        ], 200);
    }

    public function login(Request $request)
    {
        // Validate fields
        $attrs = $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6'
        ]);

        // Attempt login
        if (!Auth::guard('staff')->attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        // Return user & token in response
        $staff = Auth::guard('staff')->user();
        return response([
            'staff' => $staff,
            'token' => $staff->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logout(Request $request)
    {
        // Revoke all tokens for the authenticated user using the 'staff' guard
        auth()->guard('staff')->user()->tokens()->delete();
        
        return response([
            'message' => 'Logout success.'
        ], 200);
    }

    public function totalTeacher()
    {
        try {
            $totalTeacher = Staff::where('position', 'teacher')->count();
            return response()->json(['count' => $totalTeacher]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function UserData($id)
    {
        // Retrieve the user by their ID
        $staff = Staff::find($id);

        // Check if the user exists
        if ($staff) {
            return response([
                'staff' => $staff,
                'message' => 'Successfully retrieving data'
            ], 200);
        }
        else{

            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
    }

    public function updateStaff(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'nickname' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $staff = Staff::find($id);

        // Check if the user exists
        if (!$staff) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $staff->username = $request->input('username');
        $staff->nickname = $request->input('nickname');
        // Update other fields as needed

        // Save the changes to the database
        $staff->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'staff' => $staff]);
    }

    public function addImage(Request $request, $id)
    {
        // Retrieve the user by ID
        $staff = Staff::find($id);

        // Check if the user exists
        if (!$staff) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Retrieve the binary image data from the request
        $imageData = $request->input('image');


        // Update the user's attributes with the binary image data
        $staff->image = $imageData;

        // Save the changes to the database
        $staff->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'staff' => $staff]);
    }

    public function getAllTeachers() {
        $teachers = Staff::where('position', 'TEACHER')->get();
        return response()->json($teachers); // Return as JSON, adjust as needed
    }

    public function getAllStaffs() {
        $staffs = Staff::where('is_Delete',0)->get();
        return response()->json($staffs); // Return as JSON, adjust as needed
    }

    public function DeleteStaff(Request $request, $id)
    {

        // Retrieve the user by ID
        $staff = Staff::find($id);

        // Check if the user exists
        if (!$staff) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $staff->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $staff->save();

        // Return a success response
        return response()->json(['message' => 'Staff Deleted Successfully', 'staff' => $staff]);
    }

    public function updateStaffs(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'nickname' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $staff = Staff::find($id);

        // Check if the user exists
        if (!$staff) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $staff->name = $request->input('name');
        $staff->nickname = $request->input('nickname');
        // Update other fields as needed

        // Save the changes to the database
        $staff->save();

        // Return a success response
        return response()->json(['message' => 'User updated successfully', 'staff' => $staff]);
    }

    public function verifyPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'staffId' => 'required|integer',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid JSON format. staffId and password are required.'], 400);
        }

        $staff = Staff::where('id', $request->staffId)->first();

        if ($staff) {
            // Check if the provided password matches the encrypted password in the database
            if (Hash::check($request->password, $staff->password)) {
                return response()->json([
                    'staffId' => $staff->id,
                    'staffName' => $staff->name,
                    'nickName' => $staff->nickname,
                    'username' => $staff->username,
                    'password' => $staff->password,
                    'image' => $staff->image,
                    'position' => $staff->position,
                ], 200);
            } else {
                return response()->json(['error' => 'Incorrect password.'], 400);
            }
        } else {
            return response()->json(['error' => 'User not exist.'], 400);
        }
    }

    public function updatePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'staffId' => 'required|integer',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'Invalid JSON format. staffId and password are required.'], 400);
    }

    try {
        $staff = Staff::find($request->staffId);

        if ($staff) {
            // Encrypt the password before saving
            $staff->password = Hash::make($request->password);
            $staff->save();
            return response()->json(['success' => 'Password updated successfully.'], 200);
        } else {
            return response()->json(['error' => 'Failed to update profile.'], 400);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error occurred ' . $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
