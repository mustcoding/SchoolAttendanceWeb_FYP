<?php

namespace App\Http\Controllers;

use App\Models\AbsentSupportingDocument;
use App\Http\Requests\StoreAbsentSupportingDocumentRequest;
use App\Http\Requests\UpdateAbsentSupportingDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AbsentSupportingDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addAbsentSupportingDocument(Request $request)
    {
        try {
            // Your existing validation and user creation code
    
             // If validation passes, create user
            $supportingdoc = AbsentSupportingDocument::create([
                'file_name' => $request->input('file_name'),
                'document_path' => $request->input('document_path'),
                'uploaded_date_time' => $request->input('uploaded_date_time'),
                'verification_status' => $request->input('verification_status'),
                'verified_date_time' => $request->input('verified_date_time'),
                'reason' => $request->input('reason'),
                'parent_guardian_id' => $request->input('parent_guardian_id'),
                'staff_id' => $request->input('staff_id'),
            ]);

            // Return success response with 200 status code
            return response()->json([
                'message' => 'Absent Supporting Document has been send successfully',
                'supportingdoc' => $supportingdoc
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
    public function store(StoreAbsentSupportingDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AbsentSupportingDocument $absentSupportingDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AbsentSupportingDocument $absentSupportingDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsentSupportingDocumentRequest $request, AbsentSupportingDocument $absentSupportingDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AbsentSupportingDocument $absentSupportingDocument)
    {
        //
    }
}
