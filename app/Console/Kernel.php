<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\AttendanceTimetable;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UpdateAttendanceCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Retrieve all attendance timetables
        $timetables = AttendanceTimetable::all();

        foreach ($timetables as $timetable) {
            // Calculate the scheduled time 2 minutes before the start time of the attendance timetable
            $startTime = Carbon::parse($timetable->start_time);
            $scheduledTime = $startTime->subMinutes(2)->format('H:i');
            Log::info("Scheduled time for updating attendance: {$scheduledTime}");
            // Run the command to update attendance records at the scheduled time
            $schedule->command('attendance:update')->dailyAt($scheduledTime);
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}