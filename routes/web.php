<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/reg', function () {
//     return view('welcome');
// });
Route::get('cache', function () {
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
});
Route::get('all-notifications', [App\Http\Controllers\DashboardController::class, 'notification'])->name('notification');
Route::get('redirect-notification/{id}', [App\Http\Controllers\DashboardController::class, 'notificationRedirect'])->name('read-notification');

Route::middleware('guest')->group(function () {
    Route::post('/login-check', [App\Http\Controllers\Auth\LoginController::class, 'custom_login'])->name('custom-login');

    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'loginIndex'])->name('login');
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginIndex']);

    Route::get('/forget-password', [App\Http\Controllers\Auth\LoginController::class, 'forgot'])->name('forgot.password');
    Route::post('/forget-check', [App\Http\Controllers\Auth\LoginController::class, 'forgotPassword'])->name('forgot-password');
});
//expance
Route::middleware(['logout', 'role:Admin'])->group(function () {
    Route::get('add-payable', [App\Http\Controllers\ExpanceController::class, 'AddPableExpance'])->name('add.payble');
    Route::post('post-payable', [App\Http\Controllers\ExpanceController::class, 'PostPableExpance'])->name('post.payable');
    Route::get('all-payable', [App\Http\Controllers\ExpanceController::class, 'AllPableExpance'])->name('all.payable');
    Route::get('payable/edit/{id}', [App\Http\Controllers\ExpanceController::class, 'EditPableExpance'])->name('edit.payable');
    Route::post('payable/update', [App\Http\Controllers\ExpanceController::class, 'UpdatePableExpance'])->name('update.payable');
    Route::get('payable/delete/{id}', [App\Http\Controllers\ExpanceController::class, 'deletePayableExpance'])->name('delete.payable');

    Route::get('add-recivable', [App\Http\Controllers\ExpanceController::class, 'AddrecivableExpance'])->name('add.recivable');
    Route::post('post-reciveable', [App\Http\Controllers\ExpanceController::class, 'PostReciveableExpance'])->name('post.reciveable');
    Route::get('all-recivable', [App\Http\Controllers\ExpanceController::class, 'AllreciveableExpance'])->name('all.reciveable');
    Route::get('recivable/edit/{id}', [App\Http\Controllers\ExpanceController::class, 'EditrecivableExpance'])->name('edit.recivable');
    Route::post('recivable/update', [App\Http\Controllers\ExpanceController::class, 'UpdaterecivableExpance'])->name('update.recivable');
    Route::get('recivable/delete/{id}', [App\Http\Controllers\ExpanceController::class, 'deleterecivableExpance'])->name('delete.recivable');



});
Route::middleware(['logout', 'role:Admin,HR,Manager,Employee'])->group(function () {
    Route::get('domains', [App\Http\Controllers\DomainController::class, 'index'])->name('domain.index');
    Route::get('create-domain', [App\Http\Controllers\DomainController::class, 'create'])->name('domain.create');
    Route::post('create-domain', [App\Http\Controllers\DomainController::class, 'store'])->name('domain.store');
    Route::get('edit-domain/{id}', [App\Http\Controllers\DomainController::class, 'edit'])->name('domain.edit');
    Route::post('update-domain', [App\Http\Controllers\DomainController::class, 'update'])->name('domain.update');
    Route::get('delete-domain/{id}', [App\Http\Controllers\DomainController::class, 'delete'])->name('domain.delete');
});
//end expence

Route::get('time-tracker', [App\Http\Controllers\TimeTrackerController::class, 'index']);
Route::get('emp-fill-data/{id}', [App\Http\Controllers\EmployeeController::class, 'fillData'])->name('emp.fill-data');
Route::post('emp-fill-data/', [App\Http\Controllers\EmployeeController::class, 'compAcc'])->name('emp.comp-acc');

Route::get('success/{id}', [App\Http\Controllers\EmployeeController::class, 'success'])->name('success.page');

Route::middleware(['logout', 'role:Admin,HR'])->group(function () {
    Route::resource('employee', App\Http\Controllers\EmployeeController::class);

    Route::post('user-create', [App\Http\Controllers\EmployeeController::class, 'userCreate'])->name('emp.user-create');

    Route::get('link-generate', [App\Http\Controllers\EmployeeController::class, 'linkGenerate'])->name('emp.link-generate');
    Route::post('link-generate/post', [App\Http\Controllers\EmployeeController::class, 'empLinkGenerate'])->name('emp.link-generate.post');

    Route::resource('role', App\Http\Controllers\RoleController::class);

    Route::resource('leave-list', App\Http\Controllers\LeaveController::class);

    Route::get('time-tracker/{id}/edit', [App\Http\Controllers\TimeTrackerController::class, 'edit']);
    Route::put('time-tracker/{id}', [App\Http\Controllers\TimeTrackerController::class, 'update']);
    // Route::delete('time-tracker/{id}', [App\Http\Controllers\TimeTrackerController::class, 'destory']);
    Route::get('time-tracker/{id}', [App\Http\Controllers\TimeTrackerController::class, 'destory'])->name('destroy.tracker');
    Route::get('time-breaker/{id}', [App\Http\Controllers\TimeTrackerController::class, 'editBreakTime']);
    Route::put('time-breaker/{id}', [App\Http\Controllers\TimeTrackerController::class, 'updateBreakTime']);

    Route::get('employee-doc/{id}/view', [App\Http\Controllers\EmployeeController::class, 'viewDocs']);
    Route::get('/emp-doc-download/{id}', [App\Http\Controllers\EmployeeController::class, 'docDownload']);

    Route::post('/emp-status-update', [App\Http\Controllers\EmployeeController::class, 'updateType'])->name('emp_status_update');

    Route::delete('/emp-doc-delete/{id}', [App\Http\Controllers\EmployeeController::class, 'deleteDocs']);

    Route::resource('payslip', App\Http\Controllers\PayslipController::class);
    //fetch salary
    Route::post('payslip/salary', [App\Http\Controllers\PayslipController::class, 'employeeSalary']);

    Route::get('generate-pdf/{id}', [App\Http\Controllers\PayslipController::class, 'generatePDF']);

    Route::resource('department', App\Http\Controllers\DepartmentController::class);

    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('/changeStatus', [App\Http\Controllers\UserController::class, 'changeStatus']);
    Route::get('/updateRole', [App\Http\Controllers\UserController::class, 'updateRole']);
});

Route::middleware(['logout', 'role:Admin,Manager,Hr'])->group(function () {
    Route::resource('client', App\Http\Controllers\ClientController::class);
    Route::resource('client-invoice', App\Http\Controllers\ClientInvoiceController::class);
    Route::get('client-invoice/create/{id}', [App\Http\Controllers\ClientInvoiceController::class, 'createInvoice']);
    Route::get('client-invoice-download/{id}', [App\Http\Controllers\ClientInvoiceController::class, 'DownloadInvoice']);

    Route::resource('project', App\Http\Controllers\ProjectController::class);
    Route::get('/project/{id}/task', [ProjectController::class, 'projectTasks'])->name('project.task');

    Route::post('/project/update', [ProjectController::class, 'dataUpdate'])->name('project.update');
    Route::get('/project/{id}/delete', [ProjectController::class, 'delete'])->name('project.delete');

    Route::resource('task-tracker', App\Http\Controllers\TaskController::class);
    Route::get('task-report', [App\Http\Controllers\TaskController::class, 'taskReport']);
    Route::get('view-task-progress/{id}', [App\Http\Controllers\TaskController::class, 'viewTaskProgress']);
    Route::get('check-view-progress/{id}', [App\Http\Controllers\TaskController::class, 'checkViewProgress']);
    Route::get('/edit-task-progress/{id}', [App\Http\Controllers\TaskController::class, 'taskProgressEdit']);
    Route::put('/update-task-progress/{id}', [App\Http\Controllers\TaskController::class, 'taskProgressUpdate']);
    Route::get('/edit-task/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('edit.task');
    Route::get('/admin-task-download/{id}', [App\Http\Controllers\TaskController::class, 'getDownload']);
    Route::delete('/task-doc-delete/{id}', [App\Http\Controllers\TaskController::class, 'deleteDownload']);

    Route::get('/task-taker/{id}/view', [App\Http\Controllers\TaskController::class, 'view'])->name('task_view'); //---
    Route::put('/task-takerup-progress/{id}', [App\Http\Controllers\TaskController::class, 'progressUpdate']);
    Route::put('/task-taker/{id}', [App\Http\Controllers\TaskController::class, 'updateStatus']);
    Route::post('/task-taker-progress/{id}', [App\Http\Controllers\TaskController::class, 'taskProgressStore']);

    // Route::get('/task-download/{id}', [App\Http\Controllers\Employee\TaskController::class, 'getDownload']);

    Route::get('task-export', [App\Http\Controllers\TaskController::class, 'taskExport']);

    Route::get('task-module', [App\Http\Controllers\TaskController::class, 'taskModuleForm']);
    Route::post('task-module', [App\Http\Controllers\TaskController::class, 'taskModuleStore']);
    Route::get('task-module/{id}', [App\Http\Controllers\TaskController::class, 'taskModuleEdit']);
    Route::put('task-module/{id}', [App\Http\Controllers\TaskController::class, 'taskModuleUpdate']);
    Route::delete('task-module/{id}', [App\Http\Controllers\TaskController::class, 'taskModuleDestory']);

    Route::post('task-comments', [App\Http\Controllers\TaskController::class, 'addComment'])->name('task_comment');
    Route::get('task-comment-delete/{id}', [App\Http\Controllers\TaskController::class, 'commentDelete'])->name('task_comment_delete');

});

Route::middleware(['logout', 'role:Admin'])->group(function () {
    Route::get('admin/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard']);
});

Route::middleware(['logout', 'role:Employee'])->group(function () {
    Route::get('/emp/notification');
    Route::get('/emp/dashboard', [App\Http\Controllers\UserDashboardController::class, 'dashboard']);
});

Route::middleware(['logout', 'role:HR'])->group(function () {
    Route::get('/hr/dashboard', [App\Http\Controllers\UserDashboardController::class, 'dashboard']);
});

Route::middleware(['logout', 'role:Manager,HR'])->group(function () {
    Route::get('/manager/dashboard', [App\Http\Controllers\Manager\ManagerDashboardController::class, 'dashboard']);
});

Route::middleware(['logout', 'role:Manager,Employee,HR'])->group(function () {
    Route::resource('leave', App\Http\Controllers\Employee\LeaveController::class);

    Route::get('/task', [App\Http\Controllers\Employee\TaskController::class, 'index']);
    Route::get('/task/{id}/edit', [App\Http\Controllers\Employee\TaskController::class, 'edit']);
    Route::put('/task/{id}', [App\Http\Controllers\Employee\TaskController::class, 'update']);
    Route::get('/task-progress/{id}', [App\Http\Controllers\Employee\TaskController::class, 'taskProgressEdit']);
    Route::put('/task-progress/{id}', [App\Http\Controllers\Employee\TaskController::class, 'progressUpdate']);
    Route::get('/task-download/{id}', [App\Http\Controllers\Employee\TaskController::class, 'getDownload']);
    Route::post('/task-progress/{id}', [App\Http\Controllers\Employee\TaskController::class, 'taskProgressStore']);

    Route::post('emp/task-comments', [App\Http\Controllers\Employee\TaskController::class, 'addComment'])->name('emp_task_comment');
    Route::get('emp/task-comment-delete/{id}', [App\Http\Controllers\Employee\TaskController::class, 'commentDelete'])->name('emp_task_comment_delete');


    Route::post('/checkin', [App\Http\Controllers\UserDashboardController::class, 'checkInTimeStore']);
    Route::put('/checkout', [App\Http\Controllers\UserDashboardController::class, 'checkOutTimeUpdate']);
    Route::post('/report', [App\Http\Controllers\UserDashboardController::class, 'StoreReport']);
    Route::post('/breakin', [App\Http\Controllers\UserDashboardController::class, 'breakInTimeStore']);
    Route::put('/breakout', [App\Http\Controllers\UserDashboardController::class, 'breakOutTimeUpdate']);

    Route::get('/timebreaker/{id}', [App\Http\Controllers\UserDashboardController::class, 'viewTime']);
    Route::put('/timetracker/{id}', [App\Http\Controllers\UserDashboardController::class, 'updateTime']);
});

Route::get('/monthly_report/{id}', [App\Http\Controllers\UserDashboardController::class, 'MonthlyReport']);

Route::middleware(['logout', 'role:Employee'])->group(function () { });

//----------------------- Client Routes-----------------------------------------------
// Route::get('/ClientLogin', [App\Http\Controllers\Auth\LoginController::class, 'showClientLoginForm']);
// Route::post('/ClientLogin', [App\Http\Controllers\Auth\LoginController::class, 'clientLogin']);
// Route::post('/ClientLogout', [App\Http\Controllers\Auth\LoginController::class, 'clientLogout']);

// Route::middleware(['client', 'logout'])->group(function() {

//     Route::get('/ClientDashboard', [App\Http\Controllers\Client\DashboardController::class, 'dashboard']);

//     Route::get('/client-project',  [App\Http\Controllers\Client\ProjectController::class, 'index']);
// });

// Route::view('/home', 'home')->middleware('auth');
// Route::view('/clientLogin', 'client_login');
// Route::view('/writer', 'writer');

// Route::get('/loginmail', function () {
//     return view('layouts/login_mail');
// });

// Route::get('/', function () {
//     return redirect(route('login'));
// });

Auth::routes();

//-------------------------- Artisan commands
Route::get('/migrate', function () {
    Artisan::call('migrate', [
        '--force' => true,
    ]);

    return 'Migrate Database Successfully!';
});

Route::get('/config-cache', function () {

    $exitCode = Artisan::call('config:cache');

    return "Config Cache Successfully";
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');

    return 'Storage Link Successfully';
});

// Route::get('/dbseed', function () {
//     Artisan::call('db:seed', [
//        '--force' => true
//     ]);

//     return 'DB Seed completed!';
// });

// Route::get('/composer-update', function () {
//     Artisan::call('composer update', [
//        '--force' => true
//     ]);

//     return 'Composer Updated!';
// });
