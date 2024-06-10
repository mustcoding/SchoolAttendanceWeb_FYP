<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Rfid;
use App\Http\Requests\StoreRfidRequest;
use App\Http\Requests\UpdateRfidRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class RfidController extends Controller
{
    private $student_rfid = '';
    /**
     * Display a listing of the resource.
     */
    public function registerRFID(Request $request)
    {
        // Validate fields, including custom binary validation rule
        $attrs = $request->validate([
            'number' => 'required|string',
            'type' => 'required|string',
            'is_Delete' => 'required|integer',
        ]);

        // Create user
        $rfid = Rfid::create([
            'number' => $attrs['number'],
            'type' => $attrs['type'],
            'is_Delete' => $attrs['is_Delete'],
        ]);

        // Return user & token in response
        return response([
            'rfid' => $rfid
        ], 200);
    }

    //get RFID that is not belongs to everyone
    public function get0RFID() {
        $RFID = Rfid::doesntHave('students')-> where('type','CARD')->get();
        return response()->json($RFID); // Return as JSON, adjust as needed
    }

    //get RFID that is not belongs to everyone
    public function get0TagRFID() {
        $RFID = Rfid::doesntHave('tagStudents')-> where('type','TAG')->get();
        return response()->json($RFID); // Return as JSON, adjust as needed
    }

    public function getRFID() {
        $RFIDs = Rfid::with('student')
        ->where('is_Delete',0)
        ->get()->map(function($rfid) {
            // If the RFID has a student, return the student's name
            // Otherwise, return an empty string
            return [
                'id' => $rfid->id,
                'number' => $rfid->number,
                'type' => $rfid->type,
                'student_name' => $rfid->student ? $rfid->student->name : ''
            ];
        });
    
        return response()->json($RFIDs);
    }

    public function DeleteRFID(Request $request, $id)
    {

        // Retrieve the user by ID
        $rfid = Rfid::find($id);

        // Check if the user exists
        if (!$rfid) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $rfid->is_Delete = $request->input('is_Delete');
    
        // Update other fields as needed

        // Save the changes to the database
        $rfid->save();

        // Return a success response
        return response()->json(['message' => 'RFID Deleted Successfully', 'rfid' => $rfid]);
    }

    public function updateRFID(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'number' => 'required|string',
            'type' => 'required|string',
            // Add validation rules for other fields you want to update
        ]);

        // Retrieve the user by ID
        $rfid = Rfid::find($id);

        // Check if the user exists
        if (!$rfid) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's attributes
        $rfid->number = $request->input('number');
        $rfid->type = $request->input('type');
        // Update other fields as needed

        // Save the changes to the database
        $rfid->save();

        // Return a success response
        return response()->json(['message' => 'RFID updated successfully', 'rfid' => $rfid]);
    }

    public function RFIDData($id)
    {
        // Retrieve the user by their ID
        $rfid = Rfid::find($id);

        // Check if the user exists
        if ($rfid) {
            return response([
                'rfid' => $rfid,
                'message' => 'Successfully retrieving data'
            ], 200);
        }
        else{

            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
    }

    public function getRFIDid(Request $request)
    {
        try {

            // Get the RFID values from the request
            $number = $request->number;

            Log::info('RFID retrieved from cache: ' . $number);

            // Query students using parameter binding with OR condition
            $rfid = Rfid::where('number', $number)->get();

            // Check if any student is found by tag_rfid
            if ($rfid->isEmpty()) {
               
                return response()->json([
                    'message' => 'No RFID found for the given RFID values.',
                ], 404);
              
            }
            return response([
                'rfid' => $rfid,
            ], 200);
         

        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

   // Handle the data sent from Arduino IDE
   public function getArduinoRfid(Request $request)
   {
       // Get the RFID values from the request
       $number = $request->rfid;
       

       Cache::put('student_rfid', $number);
       
   }
   
   // Called from HTML to get the stored RFID value
   public function getArduinoStudentRfid()
   {
       // Retrieve the RFID value from the cache
        $rfid = Cache::get('student_rfid');

        // Return the RFID number
        return response()->json($rfid);
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
    public function store(StoreRfidRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rfid $rfid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rfid $rfid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRfidRequest $request, Rfid $rfid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rfid $rfid)
    {
        //
    }
}
