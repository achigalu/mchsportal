<?php

use App\Http\Controllers\academicDepartments;
use App\Http\Controllers\assessmentsController;
use App\Http\Controllers\campusController;
use App\Http\Controllers\cohortCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\cohortsController;
use App\Http\Controllers\cohortsemesters;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\emailAndUsernameLoginController;
use App\Http\Controllers\facultyController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\programClassController;
use App\Http\Controllers\programsController;
use App\Http\Controllers\studentRegistrationController;
use App\Http\Controllers\tuitionFeeCategoryController;
use App\Http\Controllers\tuitionFeeStructureController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\examnumbersController;
use App\Http\Controllers\permissionController;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\roleController;
use App\Http\Controllers\gradeController;
use  App\Http\Controllers\pdfController;
use App\Http\Controllers\excelController;
use App\Http\Controllers\aggregateController;
use App\Http\Controllers\collegeSetup;
use App\Http\Controllers\reportsController;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\ApplicantController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//  Route::get('/', function () {
//      return view('welcome');
//  });

// Route::get('/myhome', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('myhome');

// route::get('home', function() {
// return view('admin.layout.index');
// });


// // Admin login / Students login
// Route::get('/myhome', function () {
//     return view('admin.layout.index');
// })->middleware(['auth', 'verified'])->name('myhome');

// // Students login
// CLEAR CACHE
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-c', function () {
    Artisan::call('cache:clear');
    return "Cache cleared successfully!";
});

Route::controller(dashboard::class)->group(function(){
    Route::get('/dashboard_a', 'index')->name('dashboard.a');
    Route::get('/dashboard_b', 'show')->name('dashboard.b');
    Route::get('add/forgotten/class-idandcampus-id', 'addForgottenClassColumns')->name('add.classid-campus-id');
    Route::get('/reset/students/passwords', 'resetStudentsPasswords')->name('reset.students.passwords');
    Route::get('/move/class/students', 'moveClassStudents')->name('move.class.students');
});


Route::get('/migrate-db', function () {
    try {
        // Run the migrations
        Artisan::call('migrate');
        
        return "Migrations ran successfully!";
    } catch (\Exception $e) {
        return "An error occurred: " . $e->getMessage();
    }
})->middleware('auth');  // Optional: You can add a middleware like 'auth' or 'admin' for extra protection



// Route::get('/regenerate-c', function () {
//     Artisan::call('config:cache'); // Regenerate configuration cache
//     Artisan::call('route:cache');   // Regenerate route cache
//     Artisan::call('view:cache');     // Regenerate view cache
//     return "Cache regenerated successfully!";
// });

Route::get('/regenerate-c', function () {
    Artisan::call('optimize'); // Runs optimization commands for the application
    return "Cache optimized successfully!";
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(RegisteredUserController::class)->group(function(){
    Route::get('/verify/{token}', 'verify')->name('verify');
});

Route::controller(UsersController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', 'index')->name('userLogin');
    Route::get('/myhome', 'loggedInUsers')->name('myhome');
    Route::get('/studentMyHome', 'loggedInStudent')->name('student.dashboard');
    Route::get('/adminMyHome', 'loggedInAdmin')->name('admin.dashboard');
    Route::get('/applicantMyHome', 'applicantAdmin')->name('applicant.dashboard');
    Route::get('/list/users/', 'listUsers')->name('list.users');
    Route::get('/create/user/', 'createUsers')->name('create.users');
    Route::post('/new/user/', 'storeUsers')->name('store.users');
    Route::get('/user/logout', 'Logout')->name('user.logout');
    Route::get('/disable/user/{id}', 'disableUser')->name('disable.user');
    Route::get('/enable/user/{id}', 'enableUser')->name('enable.user');
    Route::get('/edit/user/{id}', 'editUser')->name('edit.user');
    Route::post('/update/user/{id}', 'updateUser')->name('update.user');
    Route::get('/user/update/password', 'editUserPassword')->name('user.reset.password');
    Route::post('/user/update/password', 'updateUserPassword')->name('user.update.password');
    Route::get('/reset/user/password/{id}', 'resetUserPassword')->name('reset.user.password');
    Route::post('/admin/update/user/password/{id}', 'adminUpdateUserPassword')->name('admin.update.user.password');
    Route::get('/admin/student/profile', 'adminUserProfile')->name('admin.user.profile');
    Route::post('/admin/update/user/profile', 'adminUpdateUserProfile')->name('admin.update.user.profile');
})->middleware(['auth', 'verified'])->name('myhome');;

Route::controller(studentController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/students', 'addStudent')->name('add.student');
    Route::get('/upload/students', 'uploadStudent')->name('upload.students');
    Route::post('/upload/students', 'uploadedStudents')->name('uploaded.students');
    // Route::get('/upload/old/students', 'uploadOldStudents')->name('upload.old.students');
    // Route::post('/upload/old/students', 'uploadingOldStudents')->name('uploaded.old.students');
    Route::get('/admission/students', 'admission')->name('admission.student');
    Route::get('/admission/single/student/add', 'singleStudentAdmission')->name('single.admission.student');
    Route::get('/confirm/students/list/{id}', 'confirmStudentsList')->name('confirm.students.list');
    Route::get('/confirm/students/lists/{id}', 'confirmStudentsLists')->name('confirm.students.lists');
    Route::get('/discard/upload/lists/{id}', 'discardUploadLists')->name('discard.upload.lists');
    Route::post('/save/confirmed/students/{id}', 'saveConfirmedStudents')->name('save.confirmed.students');
    Route::get('/saved/confirmed/students/{id}', 'savedConfirmedStudents')->name('saved.confirmed.students');
    Route::get('/change/upload/status/{id}', 'changeUploadStatus')->name('change.upload.status');
    Route::get('/delete/upload/list/{id}', 'deleteUploadList')->name('delete.upload.list');
    Route::get('/final/admission', 'finalAdmission')->name('final.admission');
    Route::get('/students/admission/details/{id}', 'studentsAdmissionDetails')->name('students.admission.details');
    Route::get('/save/admission/student', 'saveAdmissionStudent')->name('save.admission.student');
    Route::get('/student/profile', 'studentProfile')->name('student.profile');
    Route::post('/student/profile', 'storeStudentProfile')->name('store.student.profile');
    Route::get('/edit/student/profile/{id}', 'editStudentProfile')->name('edit.student.profile');
    Route::post('/update/student/profile', 'updateStudentProfile')->name('update.student.profile');
    Route::get('/student/edit/password', 'editPassword')->name('admin.student.resetStudentPassword');
    Route::post('/update/student/password', 'updatePassword')->name('update.student.password');
    Route::get('/all/students/list', 'allStudentsList')->name('all.students.list');
    Route::get('/student/change/password/{id}', 'studentChangePassword')->name('student.change.password');
    Route::post('admin/update/student/password/{id}', 'adminUpdateStudentPassword')->name('admin.update.student.password');
    Route::get('/edit/student/{studentID}', 'editStudent')->name('edit.student');
    Route::post('/update/student/details/{studentID}', 'updateStudentDetails')->name('update.student.details');
    Route::get('/student/info/{id}', 'studentInfo')->name('student.info');
    Route::get('/delete/single/student/{id}', 'deleteSingleStudent')->name('delete.single.student');
    Route::post('/single/student/change/class', 'singleStudentChangeClass')->name('single.student.change.class');
    Route::get('/add/class/modules/to/single/student/{student_id}', 'addClassModulesToSingleStudent')->name('add.class.modules.to.single.student');
    Route::get('/allocate/subjects/to/students/{class}/{semester}/{campus}/{student}', 'allocateSubjectsToOneStudent')->name('allocate.subjects.to.one.student');
    
    
    route::get('/list', 'list');
});

    Route::controller(emailAndUsernameLoginController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('login/with/email/registration/number', 'emailAndRegistration')->name('email.and.registration');
    Route::post('email/or/registration', 'emailOrRegistration')->name('email.reg');
});

Route::controller(cohortsController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/cohort', 'addCohort')->name('add.cohort');
    Route::post('/create/academic/year', 'createCohorts')->name('create.academicyear'); 
    Route::post('/update/academic/year/{id}', 'updateCohorts')->name('update.academicyear'); 
    Route::get('/view/cohorts', 'viewCohorts')->name('view.cohorts'); 
    Route::get('/edit/cohort/{id}', 'editCohort')->name('edit.cohort');  
    
});

Route::controller(cohortCategoryController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/all/intake/categories', 'allIntakeCategories')->name('all.intake.categories');
    Route::get('/add/intake/category', 'addIntakeCategory')->name('add.intake.category'); 
});

Route::controller(cohortsemesters::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/all/cohort/semesters/{id}', 'allCohortSemesters')->name('all.cohort.semesters');
    Route::get('/add/cohort/semester/{id}', 'addCohortSemester')->name('add.cohort.semester'); 
    Route::get('/update/cohort/semester/registration/{id}', 'updateCohortSemesterRegistration')->name('update.cohort.semester.registration'); 
    Route::get('/edit/cohort/semester/{id}', 'editCohortSemester')->name('edit.cohort.semester'); 
    Route::post('/create/cohort/semester/{id}', 'createCohortSemester')->name('create.cohort.semester');
    Route::post('/update/cohort/semester/{id}', 'updateSemester')->name('update.semester');
    Route::post('/update/cohort/semester/registration/{id}', 'updateSemesterRegistration')->name('update.semester.registration');
});

Route::controller(facultyController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/faculty', 'addFaculty')->name('add.faculty');
    Route::post('/create/faculty', 'createFaculty')->name('create.faculty');
    Route::get('/view/faculty', 'viewFaculty')->name('view.faculty');
    Route::get('/edit/faculty/{id}', 'editFaculty')->name('edit.faculty');
    Route::post('/update/faculty', 'updateFaculty')->name('update.faculty');
});

Route::controller(programsController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/program', 'addProgram')->name('add.program');
    Route::get('/view/program', 'viewProgram')->name('view.program'); 
    Route::get('/edit/program/{id}', 'editProgram')->name('edit.program'); 
    Route::post('/update/program/{id}', 'updateProgram')->name('update.program'); 
    Route::post('/create/program', 'createProgram')->name('create.program');
     
});

Route::controller(programClassController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/view/program/classes/{programid}/{campusid}', 'viewProgramClasses')->name('view.program.class'); 
    Route::get('/edit/program/class/{pclassid}', 'editProgramClass')->name('edit.program.class'); 
    Route::get('/add/program/class/{pclass}/{pcampus}', 'addProgramClass')->name('add.program.class');
    Route::post('/create/program/class/{id}', 'createProgramClass')->name('create.programclass'); 
    Route::post('/update/program/class/{id}', 'updateProgramClass')->name('store.edited.program.class');
    
});

Route::controller(tuitionFeeCategoryController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/tuition/fee/category', 'addFeesCategory')->name('add.fee.categories');
    Route::post('/add/tuition/fee/category', 'addFeeCategories')->name('add.feecategory');
    Route::get('/view/tuition/fee/categories', 'viewFeesCategory')->name('view.fee.categories'); 
    Route::get('/edit/tuition/fee/categories/{id}', 'editFeesCategory')->name('edit.fee.categories'); 
    Route::post('/update/tuition/fee/categories/{id}', 'updateFeesCategory')->name('update.category'); 
});

Route::controller(tuitionFeeStructureController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/tuition/fee/structure', 'addFeeStructures')->name('add.fee.structures');
    Route::get('/view/tuition/fee/structures', 'viewFeeStructures')->name('view.fee.structures'); 
});

Route::controller(academicDepartments::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/department/{id}', 'addDepartment')->name('add.department');
    Route::get('/view/faculty/departments/{id}', 'viewDepartments')->name('view.departments'); 
    Route::post('/department/store', 'departmentStore')->name('department.store'); 
    Route::get('/edit/department/{id}', 'editDepartment')->name('edit.department');
    Route::post('/update/department', 'updateDepartment')->name('department.update');
    Route::get('/view/all/departments', 'viewAllDepartments')->name('view.all.departments');
});

Route::controller(coursesController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/add/course', 'addCourse')->name('add.course');
    Route::post('/store/courses', 'storeCourses')->name('store.course'); 
    Route::post('/update/courses/{id}', 'updateCourses')->name('update.course'); 
    Route::get('/view/courses', 'viewCourses')->name('view.courses'); 
    Route::get('/edit/course/{id}', 'editCourse')->name('edit.course'); 
    Route::get('/configured/courses', 'configuredCourse')->name('configured.courses');
    Route::get('/add/subject/class', 'addSubjectToClass')->name('add.subject.to.class');
    Route::post('/class/subjects','classSubjects')->name('class.subjects');
    Route::get('/class/subjects/{class_id}/{semester}','classSubjectsWithId')->name('class.subjects.withID');
    Route::post('/config/class/subjects','configClassSubjects')->name('config.class.subjects');
    Route::post('/configured/subject', 'configuredSubject')->name('configured.subject');
    Route::get('/add/subject/to/students', 'addSubjectToStudent')->name('add.subject.to.students');
    Route::post('/add/class/subjects', 'addClassSubjects')->name('add.class.subjects');
    Route::get('/add/subjects/to/lecturers', 'addSubjectsToLecturers')->name('subjects.to.lecturers');
    Route::get('/view/lecturer/courses/{id}', 'lecturerCourses')->name('lecturer.courses');
    Route::get('/add/subject/to/old/class', 'addSubjectToOldClass')->name('add.subject.to.old.class');
    Route::get('/add/subject/to/old/students', 'addSubjectToOldStudents')->name('add.subject.to.old.students');
    Route::post('/add/subject/to/old/classes', 'storeSubjectToOldClass')->name('add.subjects.to.old.classes');
    Route::post('/add/subject/to/old/studentss', 'storeSubjectToOldStudents')->name('add.subject.to.old.studentss');
    Route::post('/store/old/class/subjects', 'soreOldClassSubjects')->name('store.old.class.subjects');
    Route::get('/allocate/subjects/to/oldstudents/{class}/{semester}/{campus}/{ay}', 'allocateSubjectToOldStudents')->name('allocate.subjects.to.old.students');
    Route::get('/edit/class/assigned/subject/{subj_id}/{class_id}/{semester}','editClassAssignedSubjects')->name('edit.assigned.subject');
    Route::post('/update/class/assigned/subject','editConfiguredSubject')->name('edit.configured.subject');
    Route::get('/delete/class/assigned/subject/{subj_id}/{class_id}/{semester}/{ay}', 'deleteClassAssignedSubjects')->name('delete.assigned.subject');
    Route::get('/delete/assigned/subjects/to/students/{ay}/{subj_id}/{class_id}/{semester}', 'deleteClassAndStudentsAssignedSubjects')->name('delete.assigned.subject.to.student');
    Route::post('/delete/assigned/subjects/to/single/student', 'deleteAssignedSubjectToSingleStudent')->name('delete.assigned.subject.to.single.student');
    Route::get('/hod/review/assessments/{id}', 'hodReviewAssessments')->name('hod.review.assessments');


});

Route::controller(campusController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/all/campuses', 'allCampuses')->name('all.campuses');
    Route::get('/add/campuses', 'addCampuses')->name('add.campuses'); 
    Route::post('/store/campuses', 'campusStore')->name('campus.store'); 
});

Route::controller(studentRegistrationController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/class/list', 'classList')->name('class.list');
    Route::post('/search/students/', 'searchStudents')->name('search.student');
    Route::post('/exam/search/students/', 'ExamSearchStudents')->name('exam.search.student');
    Route::get('/examination/search/students/{pcode}/{pcampus}/{semester}/{count}/{saved}', 'ExamSearchStudents2')->name('examination.search.student');
    Route::get('/module/register', 'moduleRegister')->name('module.register');
    Route::get('/students/confirmation', 'studentsConfirmation')->name('students.confirmation');
    Route::post('/modules/to/students', 'modulesToStudents')->name('modules.to.students');
    Route::get('/modules/to/students', 'modulesToStudents2')->name('modules.to.students2');
    Route::get('/allocate/subjects/to/students/{class}/{semester}/{campus}', 'allocateSubjectToStudentsS')->name('allocate.subjects.to.students');
    Route::post('/modules/to/lecturers', 'ModulesToLecturers')->name('modules.to.lecturers');
    Route::post('/allocate/modules/to/lecturers', 'AllocateModulesToLecturers')->name('allocate.modules.to.lecturers');
    Route::post('/detach/module/from/lecturer/{userid}', 'deleteModuleLecturer')->name('delete.moduleLecturer'); 
    Route::get('/student/exam/number', 'examClassList')->name('student.exam.numbers'); 
    Route::get('/reset/student/password/{stuID}', 'resetStudentPassword')->name('reset.student.password');
    Route::get('/get/classlist/{classID}/{semester}', 'getClassListPDF')->name('classList.pdf');
    Route::get('/students/signoff', 'studentsSignOff')->name('students.signoff');
    Route::get('/students/semester/increments', 'studentsSemesterIncrements')->name('students.semester.increments');
    Route::post('/signing/off/students', 'signingOffStudents')->name('signing.off.students');
    Route::post('/signing/off/semester/increments/', 'signOffSemesterIncrements')->name('signing.off.semester.increments');
    Route::post('/update/signing/off/students', 'updateSigningOffStudents')->name('update.signing.off.students');
    Route::post('/update/cumulative/semester', 'updateCumulativeSemester')->name('update.cumulative.semester');
});

Route::controller(assessmentsController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/list/assessments/{courseid}/{ay}', 'listAssessments')->name('list.assessments');
    Route::get('/students/grading/{id}/{assessment}/{ay}', 'studentsGradingAssessment1')->name('students.grading');// id in lecturer_subjects table [display grading form]
    Route::get('/review/students/grading/{id}/{assessment}/{ay}', 'reviewStudentsGrading')->name('review.students.grading');
    Route::post('/students/graded/{id}/{assessment}','studentsGraded1')->name('students.graded1'); //graded and saved only [saving process]
    Route::get('/students/graded/{id}/{assessment}','studentsGradedSubmitedToHOD')->name('submited.HOD');//graded saved and submitted to HOD
    Route::get('/submit/hod/{id}/{assessment}/{ay}/{hod}', 'submitHodAssessment1')->name('submit.hod'); //saving to HOD, logic if HOD basic or NOT, then redirect to submited.HOD
    Route::get('/publish/grades/to/students/{id}/{assessment}/{ay}', 'submitGradesToStudents')->name('submit.grades.to.students'); 
    Route::get('/publish/reviewed/grades/to/students/{id}/{assessment}/{ay}', 'submitGradesToStudentsFromLecturer')->name('submit.grades'); // for lecturers not HOD
    Route::get('/unpublish/grades/to/students/{id}/{assessment}/{ay}', 'unpublishGradesToStudentsFromLecturer')->name('unpublish.grades'); // for lecturers not HOD
    Route::get('/unpublish/grades/to/students/{id}/{assessment}/{ay}', 'unpublishGradesToStudents')->name('unpublish.grades.to.students');
    Route::get('/submit/back/to/lecturer/{id}/{assessment}/{ay}/{lecturerid}', 'submitBackToLecturer')->name('submit.back.to.lecturer');
});

Route::controller(roleController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/list/roles', 'listRoles')->name('list.roles');
    Route::get('/add/role', 'addRole')->name('add.role');
    Route::post('/store/role', 'storeRole')->name('store.role');
    Route::get('/edit/role/{id}', 'editRole')->name('edit.role');
    Route::get('/delete/role/{id}', 'deleteRole')->name('delete.role');
    Route::post('/update/role/{id}', 'updateRole')->name('update.role');
   
});

Route::controller(permissionController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/list/permissions', 'listPermissions')->name('list.permissions');
    Route::get('/add/permission', 'addPermission')->name('add.permission');
    Route::get('/assign/permissions/{id}', 'assignPermissions')->name('assign.permissions');
    Route::post('/store/permission', 'storePermission')->name('store.permission');
    Route::get('/edit/permission/{id}', 'editPermission')->name('edit.permission');
    Route::post('/update/permission/{id}', 'updatePermission')->name('update.permission');
    Route::post('/permissions/to/role/{id}', 'permissionsToaRole')->name('permissions.to.arole');
    Route::get('/user/permissions/{id}', 'userPermissions')->name('user.permissions');
    Route::post('/direct/user/permissions/{id}', 'directUserPermissions')->name('direct.user.permissions');
});

Route::controller(gradeController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/list/old/students', 'listOldStudents')->name('grade.old.students');
    Route::get('/list/current/students', 'listCurrentStudents')->name('grade.current.students');
    Route::post('/search/old/students', 'searchOldStudents')->name('search.old.students');
    Route::post('/search/current/students', 'searchCurrentStudents')->name('search.current.students');
    Route::get('/myold/class/subjects', 'configOldClassSubjects')->name('config.myold.class.subjects');
});

Route::controller(examnumbersController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/get/exam/numbers/{pclass}/{pcampus}/{semester}/{count}', 'getExamNumbers')->name('get.exam.numbers');
    Route::post('/generate/exam/numbers/{pcode}/{pcampus}/{semester}/{count}', 'generateExamNumbers')->name('generate.exam.numbers');
    Route::get('/view/class/examnumbers/{pcode}/{pcampus}/{semester}/{count}/{saved}', 'viewClassExamNumbers')->name('view.class.examnumbers');
    Route::get('/save/class/generated/exam/numbers/{pcode}/{pcampus}/{semester}/{count}', 'saveClassGeneratedExamNumbers')->name('save.class.regenerated.exam.numbers');
    Route::get('/delete/exam/numbers/list/{pclass}/{pcampus}/{semester}/{count}', 'deleteExamNumbersList')->name('delete.exam.numbers.list');
    Route::post('/student/fees/checkbox', 'studentFeesCheckbox1')->name('student.fee.checkbox');
    Route::get('examination/related/modules', 'examinationRelatedModules')->name('examination.related.modules');
    
    Route::get('/regenerate/exam/numbers/{pcode}/{pcampus}/{semester}/{count}', 'regenerateExamNumbers')->name('regenerate.exam.numbers');

});

Route::controller(pdfController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/view/examnumbers/in-pdf/{pclass}/{pcampus}/{semester}/{count}/{acdyear}', 'viewExamNumbersPDF')->name('view.exam.numbers.inpdf');

});
Route::controller(excelController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/view/examnumbers/in-excel/{pclass}/{pcampus}/{semester}/{count}/{acdyear}', 'viewExamNumbersEXCEL')->name('view.exam.numbers.inexcel');
    Route::get('/download/online/applicants/{program_id}', 'downloadOnlineApplicants')->name('download.online.applicants');

});

Route::controller(aggregateController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/aggregate/subject/{id}/{ay}', 'aggregateSubject')->name('aggregate.course');
    Route::get('/aggregated/subject/pdf/{id}/{ay}', 'aggregatedSubjectPDF')->name('aggregated.subject.pdf');
    Route::get('/class/aggregated/grades', 'aggregateClassGrades')->name('class.aggregated.grades');
    Route::post('/aggregate/class/marks', 'aggregateClassMarks')->name('aggregate.class.marks');
    Route::get('/aggregate/class/marks/{ay}/{class}/{semester}/{publish}', 'aggregateClassMarks')->name('aggregate.class.marks2');
    Route::get('/class/aggregated/class/grades/pdf/{ay}/{class}/{semester}', 'aggregateClassMarks')->name('class.aggregated.grades.pdf');
    Route::post('/unpublish/class/modules/{ay}/{class}/{semester}/{campus}', 'unpublishClassModules')->name('unpublish.class.modules');
    Route::post('/publish/class/modules/{ay}/{class}/{semester}/{campus}', 'publishClassModules')->name('publish.class.modules');
    Route::post('/signing/off/class/{ay}/{class}/{semester}/{campus}', 'signingOffClass')->name('signing.off.class');
    
});

    Route::controller(reportsController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/download/student/semester/report', 'downloadStudentSemesterReport')->name('download.student.semester.report');
});

    Route::controller(collegeSetup::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/college/setup', 'collegeSetup')->name('college.setup');
    });

Route::controller(registrationController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/student/registration', 'studentRegistration')->name('student.registration');
    Route::get('/students/confirm/registration/{id}', 'studentsConfirmRegistration')->name('students.confirm.registration');
    Route::get('/confirm/checkbox/{class}/{semester}/{campus}', 'confirmCheckbox')->name('confirm.checkbox');
    Route::post('/confirmed/students', 'confirmedStudents')->name('class.students.confirm.registration');
    });

// update in live server march
Route::controller(ApplicantController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::post('/applicant/post/form1', 'applicantPostForm1')->name('applicant.post.form1'); // posting index blade form

    Route::get('/applicant/get/form2', 'applicantGetForm2')->name('applicant.get.form2');       // get view for form 2
    Route::post('/applicant/post/form2', 'applicantPostForm2')->name('applicant.post.form2');   // post for form 2

    Route::get('/applicant/get/form3', 'applicantGetForm3')->name('applicant.get.form3');       // get for form 3
    Route::post('/applicant/post/form3', 'applicantPostForm3')->name('applicant.post.form3');   // post form 3
    
    Route::get('/applicant/get/submitted', 'applicantSubmitted')->name('applicant.submitted');  // success message blade page

    Route::get('/online/application/summary', 'onlineApplicationSummary')->name('online.application.summary');
    Route::get('/online/applications/program/list/{program_id}', 'onlineApplicationsProgramList')->name('online.applications.program.list');
    Route::get('/zipped/applicant/files/{applicant_id}', 'zippedApplicantFiles')->name('zipped.applicant.files');
    Route::get('/reviewed/form/data', 'reviewedFormData')->name('reviewed.form.data');
    Route::post('/applicant/delete-file','deleteFile')->name('applicant.delete-file');
});
   















require __DIR__.'/auth.php';
