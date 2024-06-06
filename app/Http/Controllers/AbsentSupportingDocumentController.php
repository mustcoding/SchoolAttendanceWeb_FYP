<?php

namespace App\Http\Controllers;

use App\Models\AbsentSupportingDocument;
use App\Http\Requests\StoreAbsentSupportingDocumentRequest;
use App\Http\Requests\UpdateAbsentSupportingDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
                'is_Delete' => $request->input('is_Delete'),
                'start_date_leave' => $request->input('start_date_leave'),
                'end_date_leave' => $request->input('end_date_leave'),
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

    // public function ListLeaves(Request $request)
    // {
    //     // Get the parent_id from the request
    //     $parent_id = $request->input('parent_id');

    //     // Get the current date time
    //     $currentDateTimeDBFormat = Carbon::now()->format('Y-m-d');

    //     // Retrieve data based on the provided conditions
    //     $data = AbsentSupportingDocument::where('parent_guardian_id', $parent_id)
    //         ->where('uploaded_date_time', '>=', $currentDateTimeDBFormat)
    //         ->select('reason', 'verification_status')
    //         ->with(['student' => function ($query) {
    //             $query->select('id', 'name');
    //         }])
    //         ->get();
    //         return response()->json([
    //             'data' => $data, // Change this line
    //             'currentDateTime' => $currentDateTimeDBFormat
    //         ], 200);
    // }

    public function ListLeaves(Request $request)
    {
        // Get the parent_id from the request
        $parent_id = $request->input('parent_id');
        
        // Get the current date formatted as 'Y-m-d'
        $currentDateTimeDBFormat = Carbon::now()->format('Y-m-d');


        $data = DB::table('absent_supporting_documents')
            ->join('students', 'absent_supporting_documents.parent_guardian_id', '=', 'students.parent_guardian_id')
            ->join('student_study_sessions', 'students.id', '=', 'student_study_sessions.student_id')
            ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
            ->join('staff', 'school_session_classes.staff_id', '=', 'staff.id')
            ->where('students.parent_guardian_id', $parent_id)
            ->where('absent_supporting_documents.start_date_leave', '>=', $currentDateTimeDBFormat)
            ->select('students.name as name', 'absent_supporting_documents.verification_status', 'absent_supporting_documents.reason',
            'absent_supporting_documents.start_date_leave', 'absent_supporting_documents.end_date_leave')
            ->get();
        return response()->json($data, 200);
    }

    public function getAppliedLeave(){
        
        $results = AbsentSupportingDocument::select(
            'absent_supporting_documents.id as absent_supporting_document_id',
            'absent_supporting_documents.file_name',
            'absent_supporting_documents.document_path',
            'absent_supporting_documents.uploaded_date_time',
            'absent_supporting_documents.verification_status',
            'absent_supporting_documents.verified_date_time',
            'absent_supporting_documents.reason',
            'absent_supporting_documents.start_date_leave',
            'absent_supporting_documents.end_date_leave',
            'students.name as student_name',
            'student_study_sessions.id as student_study_session_id',
            'parent_guardians.name as parent_name',
            'classrooms.name as class_name',
            'classrooms.form_number',
            'staff.name as teacher_name'
        )
        ->join('parent_guardians', 'absent_supporting_documents.parent_guardian_id', '=', 'parent_guardians.id')
        ->join('students', 'parent_guardians.id', '=', 'students.parent_guardian_id')
        ->join('student_study_sessions', 'students.id', '=', 'student_study_sessions.student_id')
        ->join('school_session_classes', 'student_study_sessions.ssc_id', '=', 'school_session_classes.id')
        ->join('classrooms', 'school_session_classes.class_id', '=', 'classrooms.id')
        ->join('staff', 'school_session_classes.staff_id', '=', 'staff.id')
        ->where('absent_supporting_documents.verification_status', 'PENDING')
        ->get();

        return response()->json($results, 200);
        
    }

    public function viewDocument(Request $request)
    {

        $document_path = $request->input('document_path');
        $absent_supporting_document_id = $request->input('absent_supporting_document_id');
        // Retrieve the document from the database by ID
        $document = AbsentSupportingDocument::select('document_path')
        ->where('id',$absent_supporting_document_id);

        // Serve the PDF file to the browser
        return response()->streamDownload(function () use ($document) {
            echo $document->content; // Output the PDF content stored in the database
        }, 'document.pdf', ['Content-Type' => 'application/pdf']);
    }

    public function updateStatus(Request $request)
    {
        // Extract the request ID
        $requestId = $request->input('id');

        // Find the absent_supporting_document record by ID
        $document = AbsentSupportingDocument::find($requestId);

        // Check if the document exists
        if (!$document) {
            return response()->json(['error' => 'Absent supporting document not found'], 404);
        }

        // Update the verification_status to "APPROVED"
        $document->verification_status = 'APPROVED';
        $document->save();

        // Return a success response
        return response()->json(['message' => 'Verification status updated successfully'], 200);
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
