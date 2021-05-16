<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest:student', 'guest:teacher','guest:admin'])->group(function () {
    Route::get("/login",[App\Http\Controllers\Auth\LoginController::class,'showForm'])->name("login.form");
    Route::post("/login-attempt",[App\Http\Controllers\Auth\LoginController::class,'login'])->name("login.attempt");
});

Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'] )->name("logout");

Route::group(["prefix" => "siswa" , "middleware" => ["auth:student"]],function(){
    Route::get("/dashboard" , [App\Http\Controllers\DashboardController::class,'index'])->name("dashboard.siswa");
    Route::get("/siswa-course",[App\Http\Controllers\Siswa\SiswaCourseController::class,'index'])->name("siswa.course");
    Route::get("/my-assignment",[App\Http\Controllers\Siswa\SiswaAssignmentController::class,'index'])->name("my-assignment");
    Route::get("/grades",[App\Http\Controllers\Siswa\SiswaGradesController::class,'index'])->name("grades");
    
    Route::get("/course/detail/{id}",[App\Http\Controllers\Siswa\SiswaCourseController::class,'detail'])->name("siswa.course.detail");
    Route::get("/lesson/detail/{id}",[App\Http\Controllers\Siswa\SiswaCourseController::class,'lesson'])->name("siswa.lesson.detail");
    
    Route::get("/task/detail/{id}",[App\Http\Controllers\Siswa\SiswaCourseController::class,'task_detail'])->name("siswa.task.detail");
    
    Route::post("/presence/attempt/{id}",[App\Http\Controllers\Siswa\SiswaCourseController::class,'presence_attempt'])->name("presence.attempt");
    
    Route::post("/task/submission-add/{id}",[App\Http\Controllers\Siswa\SubmissionController::class,'store'])->name("task.add.submission");
    
    Route::get('/profile-siswa',[App\Http\Controllers\ProfileController::class,'profile'] )->name("profile.siswa");

    Route::put('/edit-siswa/{id}',[App\Http\Controllers\ProfileController::class,'edit_siswa'] )->name("edit.siswa");
});

Route::group(["prefix" => "guru" , "middleware" => ["auth:teacher"]],function(){
    Route::get("/dashboard" , [App\Http\Controllers\DashboardController::class,'index_guru'])->name("dashboard.guru");
    Route::get("/my-course" , [App\Http\Controllers\Guru\GuruCourseController::class,'index'])->name("my.course");
    Route::get("/assigned-task" , [App\Http\Controllers\Guru\AssignedTaskController::class,'index'])->name("assigned.task");
    Route::get("/my-class" , [App\Http\Controllers\Guru\MyClassController::class,'index'])->name("my.class");
    Route::get('/profile-guru',[App\Http\Controllers\ProfileController::class,'profile'] )->name("profile.guru");

    Route::put('/edit-guru/{id}',[App\Http\Controllers\ProfileController::class,'edit_guru'] )->name("edit.guru");

    Route::get("create/lesson",[App\Http\Controllers\Guru\LessonController::class,'create'])->name("create.lesson");
    Route::post("store/lesson",[App\Http\Controllers\Guru\LessonController::class,'store'])->name("store.lesson");
    Route::get("lesson/detail/{id}",[App\Http\Controllers\Guru\LessonController::class,'detail'])->name("detail.lesson");
    Route::get("lesson/edit/{id}",[App\Http\Controllers\Guru\LessonController::class,'edit'])->name("edit.lesson");
    Route::get("bahanajar/delete/{id}",[App\Http\Controllers\Guru\LessonController::class,'bahanajar_delete'])->name("delete.bahanajar");
    Route::put("lesson/update/{id}",[App\Http\Controllers\Guru\LessonController::class,'update'])->name("update.lesson");
    Route::delete("lesson/delete/{id}",[App\Http\Controllers\Guru\LessonController::class,'destroy'])->name("delete.lesson");

    Route::get("create/task",[App\Http\Controllers\Guru\TaskAdministrationController::class,"create"])->name("task.create");
    Route::post("store/task",[App\Http\Controllers\Guru\TaskAdministrationController::class,"store"])->name("task.store");
    Route::get("detail/task/{id}",[App\Http\Controllers\Guru\TaskAdministrationController::class,"detail"])->name("task.detail");
    Route::get("edit/task{id}",[App\Http\Controllers\Guru\TaskAdministrationController::class,"edit"])->name("task.edit");
    Route::put("update/task{id}",[App\Http\Controllers\Guru\TaskAdministrationController::class,"update"])->name("task.update");
    Route::delete("delete/task{id}",[App\Http\Controllers\Guru\TaskAdministrationController::class,"destroy"])->name("task.delete");
    
    Route::post("presence/store",[App\Http\Controllers\Guru\PresenceAdministrationController::class,"store"])->name("presence.create");
    Route::delete("presence/delete/{id}",[App\Http\Controllers\Guru\PresenceAdministrationController::class,"destroy"])->name("presence.delete");
    
    Route::put("grade/create/{id}",[App\Http\Controllers\Guru\GradeController::class,"update"])->name("grade.create");

    Route::get("/my-class/task-detail/{id}",[App\Http\Controllers\Guru\MyClassController::class,"task_detail"])->name("class.task.detail");
    
    Route::get("/submission/eksport/{id}",[App\Http\Controllers\Guru\EksportController::class,"submission_eksport"])->name("submission.eksport");
});


Route::group(["prefix" => "admin" , "middleware" => ["auth:admin"]], function(){
    Route::get("/dashboard",[App\Http\Controllers\AdminController::class,'dashboard'])->name("admin.dashboard");
    Route::get("/guru",[App\Http\Controllers\Admin\UserGuruController::class,'index'])->name("user.guru");
    Route::get("/jurusan",[App\Http\Controllers\Admin\JurusanController::class,'index'])->name("jurusan.list");
    Route::get("/siswa",[App\Http\Controllers\Admin\UserSiswaController::class,'index'])->name("user.siswa");
    Route::get("/course",[App\Http\Controllers\Admin\AdministrationCourseController::class,'index'])->name("admin.course");
    Route::get("/list-admin",[App\Http\Controllers\Admin\UserAdminController::class,'index'])->name("user.admin");
});

Route::group(["prefix" => "create"],function(){
    Route::post('/guru', [App\Http\Controllers\Admin\UserGuruController::class,'store'])->name("create.guru");
    Route::post('/siswa', [App\Http\Controllers\Admin\UserSiswaController::class,'store'])->name("create.siswa");
    Route::post('/walikelas', [App\Http\Controllers\Admin\JurusanController::class,'walikelas'])->name("create.walikelas");
    Route::post('/course', [App\Http\Controllers\Admin\AdministrationCourseController::class,'store'])->name("create.course");
    Route::post('/admin', [App\Http\Controllers\Admin\UserAdminController::class,'store'])->name("create.admin");

});

Route::group(["prefix" => "edit"],function(){
    Route::get("guru/show/{id}",[App\Http\Controllers\Admin\UserGuruController::class,'edit'])->name("edit.show.guru");
    Route::get("siswa/show/{id}",[App\Http\Controllers\Admin\UserSiswaController::class,'edit'])->name("edit.show.siswa");
    Route::get("admin/show/{id}",[App\Http\Controllers\Admin\UserAdminController::class,'edit'])->name("edit.show.admin");
    Route::get("course/show/{id}",[App\Http\Controllers\Admin\AdministrationCourseController::class,'edit'])->name("edit.show.course");
    Route::put("guru/attempt/{id}",[App\Http\Controllers\Admin\UserGuruController::class,'update'])->name("edit.attempt.guru");
    Route::put("siswa/attempt/{id}",[App\Http\Controllers\Admin\UserSiswaController::class,'update'])->name("edit.attempt.siswa");
    Route::put("siswa/attempt/{id}",[App\Http\Controllers\Admin\UserAdminController::class,'update'])->name("edit.attempt.admin");
    Route::put("course/attempt/{id}",[App\Http\Controllers\Admin\AdministrationCourseController::class,'update'])->name("edit.attempt.course");
});

Route::group(["prefix" => "delete"],function(){
    Route::delete("guru/{id}",[App\Http\Controllers\Admin\UserGuruController::class,'destroy'])->name("delete.guru");
    Route::delete("siswa/{id}",[App\Http\Controllers\Admin\UserSiswaController::class,'destroy'])->name("delete.siswa");
    Route::delete("admin/{id}",[App\Http\Controllers\Admin\UserAdminController::class,'destroy'])->name("delete.admin");
    Route::delete("course/{id}",[App\Http\Controllers\Admin\AdministrationCourseController::class,'destroy'])->name("delete.course");
    Route::get("course/class/{id}/{course_id}" , [App\Http\Controllers\Admin\AdministrationCourseController::class,'delete_class'])->name("delete.course.class");
});
