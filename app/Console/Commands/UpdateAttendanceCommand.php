<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudentStudySession;
use App\Models\Attendance;
use App\Models\AttendanceTimetable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateAttendanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update attendance for all students based on student study sessions and attendance timetables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current time
        $currentTime = Carbon::now();

        // Extract the time part in the format HH:mm
        $currentTimeTime = $currentTime->format('H:i');

        // Log the current time for debugging
        Log::info("UpdateAttendanceCommand executed at: {$currentTimeTime}");

        // Find the relevant attendance timetable based on the current time
        $attendanceTimetable = AttendanceTimetable::where('start_time', '<=', $currentTimeTime)
            ->where('end_time', '>=', $currentTimeTime)
            ->first();

        // Check if there is an active attendance timetable
        if ($attendanceTimetable) {
            // Log the found timetable for debugging
            Log::info("Found active timetable: " . $attendanceTimetable->id);

            // Get all student study sessions
            $studentStudySessions = StudentStudySession::all();

            // Iterate over each student study session
            foreach ($studentStudySessions as $session) {
                // Check if attendance record already exists for the current session and date
                $existingAttendance = Attendance::where('student_study_session_id', $session->id)
                    ->whereDate('date_time_in', $currentTime->toDateString())
                    ->exists();

                // Format the current time to your desired format
                $formattedTime = $currentTime->format('m/d/y H:i:s');

                Log::info("Attendance created for session: " . $formattedTime);

                // If attendance record does not exist, create a new record
                if (!$existingAttendance) {
                    Attendance::create([
                        'date_time_in' => $formattedTime, // Use the formatted time here
                        'is_attend' => 0,
                        'checkpoint_id' => 1,
                        'attendance_timetable_id' => $attendanceTimetable->id,
                        'student_study_session_id' => $session->id,
                    ]);
                    Log::info("Attendance created for session: " . $session->id);
                } else {
                    Log::info("Attendance already exists for session: " . $session->id);
                }
            }

            $this->info('Attendance updated successfully.');
        } else {
            $this->warn('No active attendance timetable found.');
            Log::warning('No active attendance timetable found at: ' . $currentTimeTime);
        }
    }
}