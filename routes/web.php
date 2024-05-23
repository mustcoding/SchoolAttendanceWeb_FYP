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



//parent



//------------------------------- REST API -------------------------------------------------------

// public used 

Route::post('login',[StaffController::class,'login'])->name('login');


//----- admin module -----

Route::post('register',[StaffController::class,'registerStaff'])->name('register');


// Protected routes
Route::prefix('user')->middleware(['auth:staff'])->group(function() {

    Route::post('logout', [StaffController::class, 'logout'])->name('logout');
    Route::post('{id}',[StaffController::class,'UserData'])->name('findUser');

});

Route::prefix('admin')->middleware(['auth:staff'])->group(function() {

    Route::put('{id}',[StaffController::class,'updateStaff'])->name('update-staff');
    Route::put('image/{id}',[StaffController::class,'addImage'])->name('admin.add-image');

});

Route::prefix('staff')->middleware(['auth:staff'])->group(function() {

    Route::get('all-data', [StaffController::class, 'getAllTeachers'])->name('staff.all-data');
    Route::get('totalTeacher', [StaffController::class, 'totalTeacher'])->name('totalTeacher');
    Route::get('all-staff-data', [StaffController::class, 'getAllStaffs'])->name('all-staff-data');
    Route::put('delete/{id}',[StaffController::class,'DeleteStaff'])->name('staff.delete');
    Route::put('update/{id}',[StaffController::class,'updateStaffs'])->name('staff.update');
    Route::put('findClass',[StaffController::class,'findClass'])->name('staff.findClass');
    //Route::post('/check-password', [StaffController::class, 'verifyPassword']);
    //Route::put('/change-password', [StaffController::class, 'updatePassword']);

});

Route::prefix('staff')->middleware(['auth:sanctum'])->group(function() {
    Route::post('/check-password', [StaffController::class, 'verifyPassword'])->name('check-password');
    Route::put('/change-password', [StaffController::class, 'updatePassword'])->name('change-password');
});


Route::prefix('classroom')->middleware(['auth:staff,auth:sanctum'])->group(function() {

    Route::post('add', [ClassroomController::class, 'registerClass'])->name('classroom.add');
    Route::get('totalClassroom', [ClassroomController::class, 'totalClassroom'])->name('totalClassroom');
    Route::get('all-data', [classroomController::class, 'getAllClassroom'])->name('classroom.all-data');
    Route::post('get-classroom/{id}',[ClassroomController::class,'GetClassroom'])->name('getClassroom');
    Route::get('list-classroom', [classroomController::class, 'getListClassroom'])->name('list-classroom');
    Route::put('delete/{id}',[ClassroomController::class,'DeleteClassroom'])->name('classroom.delete');

});

Route::prefix('SchoolSession')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [SchoolSessionController::class, 'registerSchoolSession'])->name('SchoolSession.add');
    Route::get('all-data', [SchoolSessionController::class, 'getAllSchoolSession'])->name('SchoolSession.all-data');
    Route::put('delete/{id}',[SchoolSessionController::class,'DeleteSchoolSession'])->name('SchoolSession.delete');
    Route::put('update/{id}',[SchoolSessionController::class,'updateSchoolSession'])->name('SchoolSession.update');
    Route::post('{id}',[SchoolSessionController::class,'SchoolSessionData'])->name('findSchoolSession');

});

Route::prefix('rfid')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [RfidController::class, 'registerRFID'])->name('rfid.add');
    Route::get('all-data', [RfidController::class, 'get0RFID'])->name('rfid.all-data');
    Route::get('all-data-tag', [RfidController::class, 'get0TagRFID'])->name('all-data-tag');
    Route::get('getAll', [RfidController::class, 'getRFID'])->name('getAll');
    Route::put('delete/{id}',[RfidController::class,'DeleteRFID'])->name('rfid.delete');
    Route::put('update/{id}',[RfidController::class,'updateRFID'])->name('rfid.update');
    Route::post('{id}',[RfidController::class,'RFIDData'])->name('findRFID');
});

Route::prefix('rfids')->middleware(['auth:staff'])->group(function() {

    Route::post('retrieve-rfid-id',[RfidController::class,'getRFIDid'])->name('retrieve-rfid-id');

});

Route::prefix('parent')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [ParentGuardianController::class, 'registerParent'])->name('parent.add');
    Route::POST('checkExistence', [ParentGuardianController::class, 'CheckParent'])->name('checkExistence');
    Route::put('update/{id}',[ParentGuardianController::class,'updateProfile'])->name('parent.update');

});

Route::prefix('OccurrenceType')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [OccurrenceTypeController::class, 'addOccurrenceType'])->name('OccurrenceType.add');
    Route::get('all-data', [OccurrenceTypeController::class, 'getAllOccurrences'])->name('OccurrenceType.all-data');
    Route::put('delete/{id}',[OccurrenceTypeController::class,'DeleteOccurrence'])->name('OccurrenceType.delete');
    Route::put('update/{id}',[OccurrenceTypeController::class,'updateOccurrence'])->name('OccurrenceType.update');
    Route::post('{id}',[OccurrenceTypeController::class,'OccurrenceData'])->name('findOccurrenceType');

});

Route::prefix('Checkpoint')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [CheckpointController::class, 'addCheckpoint'])->name('Checkpoint.add');

});

Route::prefix('AttendanceTimetable')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [AttendanceTimetableController::class, 'addAttendanceTimetable'])->name('AttendanceTimetable.add');
    Route::get('all-data', [OccurrenceTypeController::class, 'getAllOccurrences'])->name('AttendanceTimetable.all-data');
    Route::get('all-timetable-data', [AttendanceTimetableController::class, 'getAllAttendanceTimetable'])-> name('all-timetable-data');
    Route::put('delete/{id}',[AttendanceTimetableController::class,'DeleteAttendanceTimetable'])->name('AttendanceTimetable.delete');
    Route::get('checkAttendance-by-time', [AttendanceTimetableController::class, 'checkAttendanceTimeTable'])->name('checkAttendance-by-time');
    

});

Route::prefix('ADS')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [AbsentSupportingDocumentController::class, 'addAbsentSupportingDocument'])->name('ADS.add');

});

Route::prefix('Student')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [StudentController::class, 'registerStudent'])->name('Student.add');
    Route::get('total-students', [StudentController::class, 'totalStudents'])->name('total-students');
    Route::post('add-image/{id}',[StudentImageController::class,'addImage'])->name('Student.add-image');
    Route::post('get-by-birthYear',[StudentController::class,'getStudentByBirthYear'])->name('get-by-birthYear');
    Route::get('all-data', [StudentController::class, 'getAllStudents'])->name('Student.all-data');
    Route::post('{id}',[StudentController::class,'studentById']);
    Route::put('update/{id}',[StudentController::class,'updateStudent'])->name('Student.update');
    Route::put('delete/{id}',[StudentController::class,'DeleteStudent'])->name('Student.delete');
    Route::get('total-alumni', [StudentController::class, 'totalAlumni'])->name('total-alumni');

});

Route::prefix('student-data')->middleware(['auth:staff'])->group(function() {

    Route::post('searchByRfid',[StudentController::class,'studentDataByRfid'])->name('searchByRfid');
    Route::post('get-student-with-ssc-class',[StudentController::class,'getStudentBySSC_ClassId'])->name('get-student-with-ssc-class');
    Route::get('all-data', [StudentController::class, 'getAllStudentsManagement'])->name('student-data.all-data');
    Route::post('total-students-in-classroom', [StudentController::class, 'getTotalStudentInClassroom'])->name('total-students-in-classroom');
    Route::post('list-students-in-classroom', [StudentController::class, 'getListStudentInClassroom'])->name('list-students-in-classroom');
    

});

Route::prefix('StudentImage')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [StudentImageController::class, 'addStudentMainImage'])->name('StudentImage.add');

});

Route::prefix('SchoolSessionClass')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [SchoolSessionClassController::class, 'registerSchoolSessionClass'])->name('SchoolSessionClass.add');
    Route::get('totalClassroomTeacher', [SchoolSessionClassController::class, 'totalClassroomTeacher'])->name('totalClassroomTeacher');
    Route::get('session-class', [SchoolSessionClassController::class, 'registerSchoolSessionClass'])->name('session-class');

});

Route::prefix('StudentStudySession')->middleware(['auth:staff'])->group(function() {

    Route::post('add', [StudentStudySessionController::class, 'registerStudentStudySession'])->name('StudentStudySession.add');
    Route::post('get-id-by-studentId',[StudentStudySessionController::class,'getIdByStudentId'])->name('get-id-by-studentId');
    Route::put('delete-student',[StudentStudySessionController::class,'deleteStudentFromClass'])->name('delete-student');
    Route::put('delete',[StudentStudySessionController::class,'deleteStudent'])->name('StudentStudySession.delete');
    Route::post('findClass',[StudentStudySessionController::class,'findClass'])->name('StudentStudySession.findClass');
});

Route::prefix('Attendance')->middleware(['auth:staff'])->group(function() {

    Route::post('recordAttendance', [AttendanceController::class, 'recordAttendanceByDataEntry'])->name('recordAttendance');
    Route::post('list-attend', [AttendanceController::class, 'getListAttend'])->name('list-attend');

});