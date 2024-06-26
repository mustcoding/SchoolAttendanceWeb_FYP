<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SchoolSessionController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\ParentGuardianController;
use App\Http\Controllers\OccurrenceTypeController;
use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\AttendanceTimetableController;
use App\Http\Controllers\AbsentSupportingDocumentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentImageController;
use App\Http\Controllers\SchoolSessionClassController;
use App\Http\Controllers\StudentStudySessionController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Http\Request;

//------------------ WEB PAGE ------------------------------------

//public used

Route::get('/login', function () {
    return view('SMAJU.login');
});

Route::get('/welcomePage', function(){
    return view('SMAJU.displayStudentWeb');
});

//admin

Route::get('/adminProfile', function () {
    return view('SMAJU.adminProfile');
})->name('adminProfile');

Route::get('/teacherProfile', function () {
    return view('SMAJU.teacherProfile');
})-> name('teacherProfile');

Route::get('/indexAdmin', function () {
    return view('SMAJU.indexAdmin');
})->name('indexAdmin');

Route::get('/add-student', function () {
    return view('SMAJU.registerStudent');
})->name('add-student');

Route::get('/add-staff', function () {
    return view('SMAJU.registerStaff');
})->name('add-staff');

Route::get('/add-class', function () {
    return view('SMAJU.registerClass');
})->name('add-class');

Route::get('/add-RFID', function () {
    return view('SMAJU.registerRFID');
})->name('add-RFID');

Route::get('/add-attendanceTimetable', function () {
    return view('SMAJU.registerStudent');
})->name('add-attendanceTimetable');

Route::get('/add-school-session', function () {
    return view('SMAJU.registerSchoolSession');
})->name('add-school-session');

Route::get('/add-activity-occurrences', function () {
    return view('SMAJU.registerActivityOccurrences');
})->name('add-activity-occurrences');

Route::get('/add-attendance-timetable', function () {
    return view('SMAJU.registerAttendanceTimetable');
})->name('add-attendance-timetable');

Route::get('/add-classroom-by-session', function () {
    return view('SMAJU.studentClassroom');
})->name('add-classroom-by-session');

Route::get('/add-student-in-classroom', function () {
    return view('SMAJU.addStudentInClassroom');
})->name('add-student-in-classroom');

Route::get('/editStudent', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editStudent', ['id' => $id]);
})->name('editStudent');

Route::get('/editStaff', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editStaff', ['id' => $id]);
})->name('editStaff');

Route::get('/editRFID', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editRFID', ['id' => $id]);
})->name('editRFID');

Route::get('/editSchoolSession', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editSchoolSession', ['id' => $id]);
})->name('editSchoolSession');

Route::get('/editActivityOccurrence', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editActivityOccurrence', ['id' => $id]);
})->name('editActivityOccurrence');

Route::get('/editClassroom', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editClassroom', ['id' => $id]);
})->name('editClassroom');

Route::get('/editAttendanceTimetable', function (Illuminate\Http\Request $request) {
    $id = $request->query('id');
    return view('SMAJU.editAttendanceTimetable', ['id' => $id]);
})->name('editAttendanceTimetable');

//teacher

Route::get('/indexTeacher', function () {
    return view('SMAJU.indexTeacher');
})->name('indexTeacher');

Route::get('/studentManagement', function () {
    return view('SMAJU.studentManagement');
})->name('studentManagement');

Route::get('/staffManagement', function () {
    return view('SMAJU.staffManagement');
})->name('staffManagement');

Route::get('/classroomManagement', function () {
    return view('SMAJU.classManagement');
})->name('classroomManagement');


Route::get('/attendanceTimetableManagement', function () {
    return view('SMAJU.attendanceTimetableManagement');
})->name('attendanceTimetableManagement');

Route::get('/schoolSessionManagement', function () {
    return view('SMAJU.schoolSessionManagement');
})->name('schoolSessionManagement');

Route::get('/activityOccurrenceManagement', function () {
    return view('SMAJU.activityOccurrenceManagement');
})->name('activityOccurrenceManagement');

Route::get('/recordAttendanceByRfid', function () {
    return view('SMAJU.recordAttendance');
})->name('recordAttendanceByRfid');

Route::get('/AttendanceRecordManagement', function () {
    return view('SMAJU.AttendanceRecordManagement');
})->name('AttendanceRecordManagement');

Route::get('/Student-In-Class', function () {
    return view('SMAJU.classroomDetailManagementMenu');
})->name('Student-In-Class');

Route::get('/Student-In-Class-Detail', function () {
    return view('SMAJU.classroomDetail');
})->name('Student-In-Class-Detail');

Route::get('/attendance-in-classroom', function () {
    return view('SMAJU.AttendanceForTeacherUsed');
})->name('attendance-in-classroom');

Route::get('/attend-to-school', function () {
    return view('SMAJU.searchAttendForAdmin');
})->name('attend-to-school');


Route::get('/list-attend-to-school', function () {
    return view('SMAJU.listAttendForAdmin');
})->name('list-attend-to-school');

Route::get('/attendance-to-school', function () {
    return view('SMAJU.searchAttendForTeacher');
})->name('attendance-to-school');

Route::get('/list-attendance-to-school', function () {
    return view('SMAJU.listAttendanceForTeacher');
})->name('list-attendance-to-school');

Route::get('/applied-leave-management', function () {
    return view('SMAJU.appliedLeaveManagement');
})->name('appliedLeaveManagement');

Route::get('/pdf/{documentPath}', function(){
    return view('SMAJU.absentiesDocument');
});

Route::get('/absentiesDocument', function (Illuminate\Http\Request $request) {
    $document_path = $request->query('document_pth');
    return view('SMAJU.absentiesDocument', ['document_path' => $document_path]);
});


//parent



//------------------------------- REST API -------------------------------------------------------

// public used 

Route::post('login',[StaffController::class,'login'])->name('login');

Route::post('ParentLogin',[ParentGuardianController::class,'ParentLogin']);

Route::post('getDisplayStudent',[StudentController::class,'getDisplayStudent']);

// from arduino IDE
Route::post('rfid',[RfidController::class, 'getArduinoRfid']);

Route::get('rfidArduino',[RfidController::class, 'getArduinoStudentRfid']);

Route::post('toDisplay',[StudentController::class, 'displayStudent']);

Route::get('toDisplayStudent',[StudentController::class, 'toDisplayStudent']);

Route::get('attendanceType',[AttendanceTimetableController::class, 'attendanceType']);


//----- admin module -----

Route::post('register',[StaffController::class,'registerStaff']);



// Protected routes
Route::prefix('user')->middleware(['auth:staff'])->group(function() {

    Route::post('logout', [StaffController::class, 'logout']);
    Route::post('{id}',[StaffController::class,'UserData']);

});

Route::prefix('admin')->middleware(['auth:staff'])->group(function() {

    Route::put('{id}',[StaffController::class,'updateStaff']);
    Route::put('image/{id}',[StaffController::class,'addImage']);

});

Route::prefix('staff')->middleware(['auth:staff'])->group(function() {

    Route::get('all-data', [StaffController::class, 'getAllTeachers']);
    Route::get('totalTeacher', [StaffController::class, 'totalTeacher']);
    Route::get('all-staff-data', [StaffController::class, 'getAllStaffs']);
    Route::put('delete/{id}',[StaffController::class,'DeleteStaff']);
    Route::put('update/{id}',[StaffController::class,'updateStaffs']);
    Route::put('findClass',[StaffController::class,'findClass']);
    //Route::post('/check-password', [StaffController::class, 'verifyPassword']);
    //Route::put('/change-password', [StaffController::class, 'updatePassword']);

});

Route::prefix('staff')->middleware(['auth:sanctum'])->group(function() {
    Route::post('/check-password', [StaffController::class, 'verifyPassword']);
    Route::put('/change-password', [StaffController::class, 'updatePassword']);
});


Route::prefix('classroom')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [ClassroomController::class, 'registerClass']);
    Route::get('totalClassroom', [ClassroomController::class, 'totalClassroom']);
    Route::get('all-data', [classroomController::class, 'getAllClassroom']);
    Route::post('get-classroom/{id}',[ClassroomController::class,'GetClassroom']);
    Route::get('list-classroom', [classroomController::class, 'getListClassroom']);
    Route::put('delete/{id}',[ClassroomController::class,'DeleteClassroom']);
    Route::put('update/{id}',[ClassroomController::class,'updateClass']);

});

Route::prefix('SchoolSession')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [SchoolSessionController::class, 'registerSchoolSession']);
    Route::get('all-data', [SchoolSessionController::class, 'getAllSchoolSession']);
    Route::put('delete/{id}',[SchoolSessionController::class,'DeleteSchoolSession']);
    Route::put('update/{id}',[SchoolSessionController::class,'updateSchoolSession']);
    Route::post('{id}',[SchoolSessionController::class,'SchoolSessionData']);

});

Route::prefix('rfid')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [RfidController::class, 'registerRFID']);
    Route::get('all-data', [RfidController::class, 'get0RFID']);
    Route::get('all-data-tag', [RfidController::class, 'get0TagRFID']);
    Route::get('getAll', [RfidController::class, 'getRFID']);
    Route::put('delete/{id}',[RfidController::class,'DeleteRFID']);
    Route::put('update/{id}',[RfidController::class,'updateRFID']);
    Route::post('{id}',[RfidController::class,'RFIDData']);
});

Route::prefix('rfids')->middleware(['auth:staff'])->group(function() {

    Route::post('retrieve-rfid-id',[RfidController::class,'getRFIDid']);

});

Route::prefix('parent')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [ParentGuardianController::class, 'registerParent']);
    Route::POST('checkExistence', [ParentGuardianController::class, 'CheckParent']);
    Route::put('update/{id}',[ParentGuardianController::class,'updateProfile']);

});

Route::prefix('OccurrenceType')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [OccurrenceTypeController::class, 'addOccurrenceType']);
    Route::get('all-data', [OccurrenceTypeController::class, 'getAllOccurrences']);
    Route::put('delete/{id}',[OccurrenceTypeController::class,'DeleteOccurrence']);
    Route::put('update/{id}',[OccurrenceTypeController::class,'updateOccurrence']);
    Route::post('{id}',[OccurrenceTypeController::class,'OccurrenceData']);

});

Route::prefix('Checkpoint')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [CheckpointController::class, 'addCheckpoint']);

});

Route::prefix('AttendanceTimetable')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [AttendanceTimetableController::class, 'addAttendanceTimetable']);
    Route::get('all-data', [OccurrenceTypeController::class, 'getAllOccurrences']);
    Route::get('all-timetable-data', [AttendanceTimetableController::class, 'getAllAttendanceTimetable']);
    Route::put('delete/{id}',[AttendanceTimetableController::class,'DeleteAttendanceTimetable']);
    Route::get('checkAttendance-by-time', [AttendanceTimetableController::class, 'checkAttendanceTimeTable']);
    Route::post('attendanceDisplay', [AttendanceTimetableController::class, 'attendanceDisplay']);
    Route::post('get-attendance/{id}',[AttendanceTimetableController::class,'getAttendance']);
    Route::put('update/{id}',[AttendanceTimetableController::class,'updateTimetable']);

});

Route::prefix('ADS')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [AbsentSupportingDocumentController::class, 'addAbsentSupportingDocument']);
    Route::get('applied-leave', [AbsentSupportingDocumentController::class, 'getAppliedLeave']);
    Route::get('/documents/{id}',[AbsentSupportingDocumentController::class, 'viewDocument'])->name('documents.show');
    Route::put('updateStatus',[AbsentSupportingDocumentController::class,'updateStatus']);
});

Route::prefix('Student')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [StudentController::class, 'registerStudent']);
    Route::get('total-students', [StudentController::class, 'totalStudents']);
    Route::post('add-image/{id}',[StudentImageController::class,'addImage']);
    Route::post('get-by-birthYear',[StudentController::class,'getStudentByBirthYear']);
    Route::get('all-data', [StudentController::class, 'getAllStudents']);
    Route::post('{id}',[StudentController::class,'studentById']);
    Route::put('update/{id}',[StudentController::class,'updateStudent']);
    Route::put('delete/{id}',[StudentController::class,'DeleteStudent']);
    Route::get('total-alumni', [StudentController::class, 'totalAlumni']);

});

Route::prefix('student-data')->middleware(['auth:staff'])->group(function() {

    Route::post('searchByRfid',[StudentController::class,'studentDataByRfid']);
    Route::post('get-student-with-ssc-class',[StudentController::class,'getStudentBySSC_ClassId']);
    Route::get('all-data', [StudentController::class, 'getAllStudentsManagement']);
    Route::post('total-students-in-classroom', [StudentController::class, 'getTotalStudentInClassroom']);
    Route::post('list-students-in-classroom', [StudentController::class, 'getListStudentInClassroom']);
    
});

Route::prefix('StudentImage')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [StudentImageController::class, 'addStudentMainImage']);

});

Route::prefix('SchoolSessionClass')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [SchoolSessionClassController::class, 'registerSchoolSessionClass']);
    Route::get('totalClassroomTeacher', [SchoolSessionClassController::class, 'totalClassroomTeacher']);
    Route::get('session-class', [SchoolSessionClassController::class, 'registerSchoolSessionClass']);

});

Route::prefix('StudentStudySession')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [StudentStudySessionController::class, 'registerStudentStudySession']);
    Route::post('get-id-by-studentId',[StudentStudySessionController::class,'getIdByStudentId']);
    Route::put('delete-student',[StudentStudySessionController::class,'deleteStudentFromClass']);
    Route::put('delete',[StudentStudySessionController::class,'deleteStudent']);
    Route::post('findClass',[StudentStudySessionController::class,'findClass']);
});

Route::prefix('Attendance')->middleware(['auth:staff'])->group(function() {

    Route::post('recordAttendance', [AttendanceController::class, 'recordAttendanceByDataEntry']);
    Route::post('list-attend', [AttendanceController::class, 'getListAttend']);
    Route::post('recordAttendanceLeave', [AttendanceController::class, 'recordAttendanceLeave']);
});

Route::prefix('ParentGuardianApps')->middleware(['auth:sanctum'])->group(function() {

    Route::post('TotalChildren', [StudentController::class, 'TotalChildren']);
    Route::post('ListChildren', [StudentController::class, 'ListChildren']);
    Route::post('ApplyLeaves', [AbsentSupportingDocumentController::class, 'addAbsentSupportingDocument']);
    Route::post('ListLeaves', [AbsentSupportingDocumentController::class, 'ListLeaves']);
    Route::post('studentStudySession', [StudentStudySessionController::class, 'studentStudySession']);
    Route::post('totalPresent', [AttendanceController::class, 'totalPresent']);
    Route::post('totalLeave', [AttendanceController::class, 'totalLeave']);
    Route::post('totalAbsent', [AttendanceController::class, 'totalAbsent']);
    Route::post('ListPresent', [AttendanceController::class, 'ListPresent']);
    Route::post('ListLeave', [AttendanceController::class, 'ListLeave']);
    Route::post('ListAbsent', [AttendanceController::class, 'ListAbsent']);
});

//record attendance by arduino

Route::post('retrieve-rfid-id',[RfidController::class,'getRFIDid']);
Route::post('searchByRfid',[StudentController::class,'studentDataByRfid']);
Route::post('get-id-by-studentId',[StudentStudySessionController::class,'getIdByStudentId']);
Route::get('checkAttendance-by-time', [AttendanceTimetableController::class, 'checkAttendanceTimeTable']);
Route::post('recordAttendance', [AttendanceController::class, 'recordAttendanceByDataEntry']);

Route::get('studentId', [StudentController::class, 'checkImages']);