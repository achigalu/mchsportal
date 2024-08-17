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




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(RegisteredUserController::class)->group(function(){
    Route::get('/verify/{token}', 'verify')->name('verify');
});

Route::controller(UsersController::class)->group(function(){
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
})->middleware(['auth', 'verified'])->name('myhome');;

Route::controller(studentController::class)->group(function(){
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
    Route::get('/student/edit/password', 'editPassword')->name('admin.student.resetStudentPassword');
    Route::post('/update/student/password', 'updatePassword')->name('update.student.password');
    Route::get('/all/students/list', 'allStudentsList')->name('all.students.list');
    Route::get('/student/change/password/{id}', 'studentChangePassword')->name('student.change.password');
    Route::post('admin/update/student/password/{id}', 'adminUpdateStudentPassword')->name('admin.update.student.password');
    
    
    route::get('/list', 'list');
});

    Route::controller(emailAndUsernameLoginController::class)->group(function(){
    Route::get('login/with/email/registration/number', 'emailAndRegistration')->name('email.and.registration');
    Route::post('email/or/registration', 'emailOrRegistration')->name('email.reg');
});

Route::controller(cohortsController::class)->group(function(){
    Route::get('/add/cohort', 'addCohort')->name('add.cohort');
    Route::post('/create/academic/year', 'createCohorts')->name('create.academicyear'); 
    Route::post('/update/academic/year/{id}', 'updateCohorts')->name('update.academicyear'); 
    Route::get('/view/cohorts', 'viewCohorts')->name('view.cohorts'); 
    Route::get('/edit/cohort/{id}', 'editCohort')->name('edit.cohort');  
    
});

Route::controller(cohortCategoryController::class)->group(function(){
    Route::get('/all/intake/categories', 'allIntakeCategories')->name('all.intake.categories');
    Route::get('/add/intake/category', 'addIntakeCategory')->name('add.intake.category'); 
});

Route::controller(cohortsemesters::class)->group(function(){
    Route::get('/all/cohort/semesters/{id}', 'allCohortSemesters')->name('all.cohort.semesters');
    Route::get('/add/cohort/semester/{id}', 'addCohortSemester')->name('add.cohort.semester'); 
    Route::get('/update/cohort/semester/registration/{id}', 'updateCohortSemesterRegistration')->name('update.cohort.semester.registration'); 
    Route::get('/edit/cohort/semester/{id}', 'editCohortSemester')->name('edit.cohort.semester'); 
    Route::post('/create/cohort/semester/{id}', 'createCohortSemester')->name('create.cohort.semester');
    Route::post('/update/cohort/semester/{id}', 'updateSemester')->name('update.semester');
    Route::post('/update/cohort/semester/registration/{id}', 'updateSemesterRegistration')->name('update.semester.registration');
});

Route::controller(facultyController::class)->group(function(){
    Route::get('/add/faculty', 'addFaculty')->name('add.faculty');
    Route::post('/create/faculty', 'createFaculty')->name('create.faculty');
    Route::get('/view/faculty', 'viewFaculty')->name('view.faculty');
    Route::get('/edit/faculty/{id}', 'editFaculty')->name('edit.faculty');
});

Route::controller(programsController::class)->group(function(){
    Route::get('/add/program', 'addProgram')->name('add.program');
    Route::get('/view/program', 'viewProgram')->name('view.program'); 
    Route::get('/edit/program/{id}', 'editProgram')->name('edit.program'); 
    Route::post('/update/program/{id}', 'updateProgram')->name('update.program'); 
    Route::post('/create/program', 'createProgram')->name('create.program');
     
});

Route::controller(programClassController::class)->group(function(){
    Route::get('/view/program/classes/{programid}/{campusid}', 'viewProgramClasses')->name('view.program.class'); 
    Route::get('/edit/program/class/{pclassid}', 'editProgramClass')->name('edit.program.class'); 
    Route::get('/add/program/class/{pclass}/{pcampus}', 'addProgramClass')->name('add.program.class');
    Route::post('/create/program/class/{id}', 'createProgramClass')->name('create.programclass'); 
    Route::post('/update/program/class/{id}', 'updateProgramClass')->name('store.edited.program.class');
    
});

Route::controller(tuitionFeeCategoryController::class)->group(function(){
    Route::get('/add/tuition/fee/category', 'addFeesCategory')->name('add.fee.categories');
    Route::post('/add/tuition/fee/category', 'addFeeCategories')->name('add.feecategory');
    Route::get('/view/tuition/fee/categories', 'viewFeesCategory')->name('view.fee.categories'); 
    Route::get('/edit/tuition/fee/categories/{id}', 'editFeesCategory')->name('edit.fee.categories'); 
    Route::post('/update/tuition/fee/categories/{id}', 'updateFeesCategory')->name('update.category'); 
});

Route::controller(tuitionFeeStructureController::class)->group(function(){
    Route::get('/add/tuition/fee/structure', 'addFeeStructures')->name('add.fee.structures');
    Route::get('/view/tuition/fee/structures', 'viewFeeStructures')->name('view.fee.structures'); 
});

Route::controller(academicDepartments::class)->group(function(){
    Route::get('/add/department/{id}', 'addDepartment')->name('add.department');
    Route::get('/view/faculty/departments/{id}', 'viewDepartments')->name('view.departments'); 
    Route::post('/department/store', 'departmentStore')->name('department.store'); 
    Route::get('/edit/department/{id}', 'editDepartment')->name('edit.department');
    Route::post('/update/department', 'updateDepartment')->name('department.update');
});

Route::controller(coursesController::class)->group(function(){
    Route::get('/add/course', 'addCourse')->name('add.course');
    Route::post('/store/courses', 'storeCourses')->name('store.course'); 
    Route::post('/update/courses/{id}', 'updateCourses')->name('update.course'); 
    Route::get('/view/courses', 'viewCourses')->name('view.courses'); 
    Route::get('/edit/course/{id}', 'editCourse')->name('edit.course'); 
    Route::get('/configured/courses', 'configuredCourse')->name('configured.courses');
    Route::get('/add/subject/class', 'addSubjectToClass')->name('add.subject.to.class');
    Route::post('/class/subjects','classSubjects')->name('class.subjects');
    Route::get('/class/subjects/{class_id}/{ay}','classSubjectsWithId')->name('class.subjects.withID');
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

});

Route::controller(campusController::class)->group(function(){
    Route::get('/all/campuses', 'allCampuses')->name('all.campuses');
    Route::get('/add/campuses', 'addCampuses')->name('add.campuses'); 
    Route::post('/store/campuses', 'campusStore')->name('campus.store'); 
});

Route::controller(studentRegistrationController::class)->group(function(){
    Route::get('/class/list', 'classList')->name('class.list');
    Route::get('/search/students/', 'searchStudents')->name('search.student');
    Route::get('/module/register', 'moduleRegister')->name('module.register');
    Route::get('/students/confirmation', 'studentsConfirmation')->name('students.confirmation');
    Route::post('/modules/to/students', 'modulesToStudents')->name('modules.to.students');
    Route::get('/allocate/subjects/to/students/{class}/{semester}/{campus}/{ay}', 'allocateSubjectToStudents')->name('allocate.subjects.to.students');
    Route::post('/modules/to/lecturers', 'ModulesToLecturers')->name('modules.to.lecturers');
    Route::post('/allocate/modules/to/lecturers', 'AllocateModulesToLecturers')->name('allocate.modules.to.lecturers');
    Route::post('/detach/module/from/lecturer/{userid}', 'deleteModuleLecturer')->name('delete.moduleLecturer'); 
    Route::get('/student/exam/number', 'classList')->name('student.exam.numbers'); 
});

Route::controller(assessmentsController::class)->group(function(){
    Route::get('/list/assessments/{id}', 'listAssessments')->name('list.assessments');
    Route::get('/students/grading/{id}/{assessment}', 'studentsGrading')->name('students.grading');
    Route::post('/students/graded/{id}/{assessment}','studentsGraded1')->name('students.graded1');
    Route::get('/students/graded/{id}/{assessment}','studentsGraded2')->name('students.graded2');
    Route::get('/submit/hod/{id}', 'submitHod')->name('submit.hod');

});

Route::controller(roleController::class)->group(function(){
    Route::get('/list/roles', 'listRoles')->name('list.roles');
    Route::get('/add/role', 'addRole')->name('add.role');
    Route::post('/store/role', 'storeRole')->name('store.role');
    Route::get('/edit/role/{id}', 'editRole')->name('edit.role');
    Route::get('/delete/role/{id}', 'deleteRole')->name('delete.role');
    Route::post('/update/role/{id}', 'updateRole')->name('update.role');
   
});

Route::controller(permissionController::class)->group(function(){
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

Route::controller(gradeController::class)->group(function(){
    Route::get('/list/old/students', 'listOldStudents')->name('grade.old.students');
    Route::get('/list/current/students', 'listCurrentStudents')->name('grade.current.students');
    Route::post('/search/old/students', 'searchOldStudents')->name('search.old.students');
    Route::post('/search/current/students', 'searchCurrentStudents')->name('search.current.students');
    Route::get('/myold/class/subjects', 'configOldClassSubjects')->name('config.myold.class.subjects');
});

Route::controller(examnumbersController::class)->group(function(){
    Route::get('/get/exam/numbers/{pclass}/{pcampus}/{psemester}', 'getExamNumbers')->name('get.exam.numbers');
    
    
});














Route::controller(dashboard::class)->group(function(){
    Route::get('/dashboard_a', 'index')->name('dashboard.a');
    Route::get('/dashboard_b', 'show')->name('dashboard.b');
});









require __DIR__.'/auth.php';
