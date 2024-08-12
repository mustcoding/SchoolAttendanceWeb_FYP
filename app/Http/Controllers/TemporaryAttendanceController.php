<?php

namespace App\Http\Controllers;

use App\Models\temporary_attendance;
use App\Http\Requests\Storetemporary_attendanceRequest;
use App\Http\Requests\Updatetemporary_attendanceRequest;

class TemporaryAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function truncateTable()
    {
        
        temporary_attendance::truncate();
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
    public function store(Storetemporary_attendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(temporary_attendance $temporary_attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(temporary_attendance $temporary_attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatetemporary_attendanceRequest $request, temporary_attendance $temporary_attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(temporary_attendance $temporary_attendance)
    {
        //
    }
}
