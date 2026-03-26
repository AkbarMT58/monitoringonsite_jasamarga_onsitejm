<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PaySalaryController;
use App\Http\Controllers\Dashboard\AttendenceController;
use App\Http\Controllers\Dashboard\AdvanceSalaryController;
use App\Http\Controllers\Dashboard\DatabaseBackupController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PosController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PerformaTestingController;
use App\Http\Controllers\Dashboard\ZAPController;
use App\Http\Controllers\Dashboard\TKController;

use App\Http\Controllers\Dashboard\PengajuanCutiController;
use App\Http\Controllers\Dashboard\SignaturesController;
use App\Http\Controllers\Dashboard\TimesheetController;

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

Route::get('/', function () {
    return view('auth/login');
});


// DEFAULT DASHBOARD & PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::get('/performatesting', [PerformaTestingController::class,'index'])->middleware(['auth'])->name('performatesting');
    Route::get('/performatesting/index', [PerformaTestingController::class, 'create'])->name('performa_index');
    Route::get('/performatesting/create', [PerformaTestingController::class, 'create_performa'])->name('create_performa');
    Route::get('/performatesting/edit/{id}', [PerformaTestingController::class, 'edit'])->name('performa.edit');

    Route::post('performatesting/create/save', [PerformaTestingController::class, 'performa_testing_simpan'])->name('create_performa.save');
    Route::post('performatesting/create/update', [PerformaTestingController::class, 'performa_testing_update'])->name('create_performa.update');
    Route::post('performatesting/laporan_performa', [PerformaTestingController::class, 'performa_testing_report']);
    Route::get('performatesting/delete/{id}', [PerformaTestingController::class, 'hapus_removeperforma'])->name('create_performa.hapus');

    

    //daerah zap

    Route::get('/zap', [ZAPController::class,'index'])->middleware(['auth'])->name('zap');
    Route::get('/zap/index', [ZAPController::class, 'create'])->name('zap_index');
    Route::get('/zap/create_zap', [ZAPController::class, 'create_zap'])->name('create_zap');
    Route::get('/zap/edit/{id}', [ZAPController::class, 'edit'])->name('zap.edit');

    Route::post('zap/create_zap/save', [ZAPController::class, 'zap_simpan'])->name('create_zap.save');
    Route::post('zap/create_zap/update', [ZAPController::class, 'zap_update'])->name('zap.update');
    Route::post('zap/laporan_zap', [ZAPController::class, 'zap_report']);
    Route::get('zap/delete/{id}', [ZAPController::class, 'hapus_removezap'])->name('create_zap.hapus');


    Route::get('/tk', [TKController::class,'index'])->middleware(['auth'])->name('tk');
    Route::get('/tk/index', [TKController::class, 'create'])->name('tk_index');
    Route::get('/tk/create_tk', [TKController::class, 'create_tk'])->name('create_tk');
    Route::get('/tk/edit/{id}', [TKController::class, 'edit'])->name('tk.edit');

    Route::post('tk/create_tk/save', [TKController::class, 'tk_simpan'])->name('create_tk.save');
    Route::post('tk/create_tk/update', [TKController::class, 'tk_update'])->name('tk.update');
    Route::post('tk/laporan_tk', [TKController::class, 'tk_report']);
    Route::get('tk/delete/{id}', [TKController::class, 'hapus_removetk'])->name('create_tk.hapus');


    Route::get('/cuti', [PengajuanCutiController::class,'index'])->middleware(['auth'])->name('cuti');
    Route::get('/cuti/index', [PengajuanCutiController::class, 'create'])->name('cuti_index');
    Route::get('/cuti/create_cuti', [PengajuanCutiController::class, 'create_cuti'])->name('create_cuti');
    
    
    
    Route::get('/cuti/edit/{id}', [PengajuanCutiController::class, 'edit'])->name('cuti.edit');

    Route::post('cuti/create_cuti/save', [PengajuanCutiController::class, 'store'])->name('create_cuti.save');
    Route::post('cuti/edit/create_cuti/update', [PengajuanCutiController::class, 'cuti_update'])->name('create_cuti.update');
    Route::post('cuti/laporan_cuti', [PengajuanCutiController::class, 'cuti_report']);
    Route::get('cuti/delete/{id}', [PengajuanCutiController::class, 'hapus_cuti'])->name('create_cuti.hapus');

    Route::get('cuti/send_email_atachment_kuantum/{id}/{id_cuti}/{kode_pt}', [PengajuanCutiController::class, 'sendEmailPDF']);
    Route::get('cuti/send_email_atachment_jm/{id}/{id_cuti}/{kode_pt}', [PengajuanCutiController::class, 'sendEmailPDF']);

   

  

    //signatures
    
    Route::get('/signatures', [SignaturesController::class,'index'])->middleware(['auth'])->name('signatures');
    Route::get('/signatures/index', [SignaturesController::class, 'create'])->name('signatures_index');
    Route::get('/signatures/create_signatures', [SignaturesController::class, 'create_signatures'])->name('create_signatures');
    Route::get('/signatures/{id}/edit', [SignaturesController::class, 'edit'])->name('signatures.edit');

    Route::post('signatures/create_signatures/save', [SignaturesController::class, 'store'])->name('create_signatures.save');
    Route::post('signatures/create_signatures/update', [SignaturesController::class, 'signatures_update'])->name('signatures.update');
    Route::post('signatures/laporan_signatures', [SignaturesController::class, 'signatures_report']);
    Route::get('signatures/delete/{id}', [SignaturesController::class, 'hapus_signatures'])->name('signatures.destroy');





    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/changepassword', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    
});

// ====== USERS ======
Route::middleware(['permission:user.menu'])->group(function () {
    Route::resource('/users', UserController::class)->except(['show']);
});

// ====== CUSTOMERS ======
Route::middleware(['permission:customer.menu'])->group(function () {
    Route::resource('/customers', CustomerController::class);
});

// ====== SUPPLIERS ======
Route::middleware(['permission:supplier.menu'])->group(function () {
    Route::resource('/suppliers', SupplierController::class);
});

// ====== EMPLOYEES ======
Route::middleware(['permission:employee.menu'])->group(function () {
    Route::resource('/employees', EmployeeController::class);
});

// ====== EMPLOYEE ATTENDENCE ======

// Route::controller(AttendenceController::class)->group(function () {

//     Route::post('attendence/{tgl}/{id}/update_attendance', 'update_attendence')->middleware('auth');
   

// });


Route::middleware(['permission:attendence.menu'])->group(function () {
    Route::resource('/employee/attendence', AttendenceController::class)->except(['show', 'update', 'destroy']);

    Route::post('employee/attendence/{tgl}/{id}/create_attendance_masuk', [AttendenceController::class, 'store']);
    Route::post('employee/attendence/{tgl}/{id}/update_attendance_masuk', [AttendenceController::class, 'update_attendance_masuk']);
    Route::post('employee/attendence/{tgl}/{id}/update_attendance', [AttendenceController::class, 'update_attendance']);
    Route::post('employee/attendence/{tgl}/{id}/update_terlambat', [AttendenceController::class, 'update_keterlambatan']);

    Route::post('employee/attendence/{tgl}/{id}/update_reason_absen ', [AttendenceController::class, 'update_absent']);
    Route::post('employee/attendence/{tgl}/create_reason_absen ', [AttendenceController::class, 'create_absent']);

   //time sheet work
    Route::get('/timesheet', [TimesheetController::class,'index'])->middleware(['auth'])->name('timesheet');
    Route::get('/timesheet/index', [TimesheetController::class, 'create'])->name('timesheet_index');
    Route::post('/timesheet/create_auto_timesheet', [TimesheetController::class, 'timesheet_simpan'])->name('create_auto_timesheet');
    Route::post('/timesheet/create_auto_timesheet_direct', [TimesheetController::class, 'timesheet_simpan_direct'])->name('create_auto_timesheet_direct');
    Route::get('/timesheet/edit/{id}', [TimesheetController::class, 'edit'])->name('timesheet.edit');
  
    Route::post('timesheet/update_timesheet/update', [TimesheetController::class, 'timesheet_update'])->name('update_timesheet.update');
    Route::post('timesheet/update_timesheet/approval_staff', [TimesheetController::class, 'Approval_Employee'])->name('update_timesheet.update.staff');
    Route::post('timesheet/update_timesheet/approval_leader', [TimesheetController::class, 'Approval_Leader'])->name('update_timesheet.update.leader');
    Route::post('timesheet/update_timesheet/approval_spv_onsite', [TimesheetController::class, 'Approval_SPV_Onsite'])->name('update_timesheet.update.spv_onsite');
    Route::post('timesheet/update_timesheet/approval_mnj_onsite', [TimesheetController::class, 'Approval_MNJ_Onsite'])->name('update_timesheet.update.mnj_onsite');



    Route::post('timesheet/laporan_timesheet', [TimesheetController::class, 'timesheet_report']);
    Route::get('timesheet/delete/{id}', [TimesheetController::class, 'hapus_timesheet'])->name('create_timesheet.hapus');


    

    
});

Route::middleware(['permission:timesheet.menu'])->group(function () {


     //time sheet work
   
});

// Route::middleware(['permission:performance.menu'])->group(function () {
//     Route::resource('/performatesting', PerformaTestingController::class,'index')->middleware(['auth'])->name('performatesting');
   

   

    
// });



// ====== SALARY EMPLOYEE ======
Route::middleware(['permission:salary.menu'])->group(function () {
    // PaySalary
    Route::resource('/pay-salary', PaySalaryController::class)->except(['show', 'create', 'edit', 'update']);
    Route::get('/pay-salary/history', [PaySalaryController::class, 'payHistory'])->name('pay-salary.payHistory');
    Route::get('/pay-salary/history/{id}', [PaySalaryController::class, 'payHistoryDetail'])->name('pay-salary.payHistoryDetail');
    Route::get('/pay-salary/{id}', [PaySalaryController::class, 'paySalary'])->name('pay-salary.paySalary');

    // Advance Salary
    Route::resource('/advance-salary', AdvanceSalaryController::class)->except(['show']);
});

// ====== PRODUCTS ======
Route::middleware(['permission:product.menu'])->group(function () {
    Route::get('/products/import', [ProductController::class, 'importView'])->name('products.importView');
    Route::post('/products/import', [ProductController::class, 'importStore'])->name('products.importStore');
    Route::get('/products/export', [ProductController::class, 'exportData'])->name('products.exportData');
    Route::resource('/products', ProductController::class);
});

// ====== CATEGORY PRODUCTS ======
Route::middleware(['permission:category.menu'])->group(function () {
    Route::resource('/categories', CategoryController::class);
});

// ====== POS ======
Route::middleware(['permission:pos.menu'])->group(function () {
    Route::get('/pos', [PosController::class,'index'])->name('pos.index');
    Route::post('/pos/add', [PosController::class, 'addCart'])->name('pos.addCart');
    Route::post('/pos/update/{rowId}', [PosController::class, 'updateCart'])->name('pos.updateCart');
    Route::get('/pos/delete/{rowId}', [PosController::class, 'deleteCart'])->name('pos.deleteCart');
    Route::post('/pos/invoice/create', [PosController::class, 'createInvoice'])->name('pos.createInvoice');
    Route::post('/pos/invoice/print', [PosController::class, 'printInvoice'])->name('pos.printInvoice');

    // Create Order
    Route::post('/pos/order', [OrderController::class, 'storeOrder'])->name('pos.storeOrder');
});

// ====== ORDERS ======
Route::middleware(['permission:orders.menu'])->group(function () {
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('order.pendingOrders');
    Route::get('/orders/complete', [OrderController::class, 'completeOrders'])->name('order.completeOrders');
    Route::get('/orders/details/{order_id}', [OrderController::class, 'orderDetails'])->name('order.orderDetails');
    Route::put('/orders/update/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/orders/invoice/download/{order_id}', [OrderController::class, 'invoiceDownload'])->name('order.invoiceDownload');

    // Pending Due
    Route::get('/pending/due', [OrderController::class, 'pendingDue'])->name('order.pendingDue');
    Route::get('/order/due/{id}', [OrderController::class, 'orderDueAjax'])->name('order.orderDueAjax');
    Route::post('/update/due', [OrderController::class, 'updateDue'])->name('order.updateDue');

    // Stock Management
    Route::get('/stock', [OrderController::class, 'stockManage'])->name('order.stockManage');
});

// ====== DATABASE BACKUP ======
Route::middleware(['permission:database.menu'])->group(function () {
    Route::get('/database/backup', [DatabaseBackupController::class, 'index'])->name('backup.index');
    Route::get('/database/backup/now', [DatabaseBackupController::class, 'create'])->name('backup.create');
    Route::get('/database/backup/download/{getFileName}', [DatabaseBackupController::class, 'download'])->name('backup.download');
    Route::get('/database/backup/delete/{getFileName}', [DatabaseBackupController::class, 'delete'])->name('backup.delete');
});

// ====== ROLE CONTROLLER ======
Route::middleware(['permission:roles.menu'])->group(function () {
    // Permissions
    Route::get('/permission', [RoleController::class, 'permissionIndex'])->name('permission.index');
    Route::get('/permission/create', [RoleController::class, 'permissionCreate'])->name('permission.create');
    Route::post('/permission', [RoleController::class, 'permissionStore'])->name('permission.store');
    Route::get('/permission/edit/{id}', [RoleController::class, 'permissionEdit'])->name('permission.edit');
    Route::put('/permission/{id}', [RoleController::class, 'permissionUpdate'])->name('permission.update');
    Route::delete('/permission/{id}', [RoleController::class, 'permissionDestroy'])->name('permission.destroy');

    // Roles
    Route::get('/role', [RoleController::class, 'roleIndex'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'roleCreate'])->name('role.create');
    Route::post('/role', [RoleController::class, 'roleStore'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'roleEdit'])->name('role.edit');
    Route::put('/role/{id}', [RoleController::class, 'roleUpdate'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'roleDestroy'])->name('role.destroy');

    // Role Permissions
    Route::get('/role/permission', [RoleController::class, 'rolePermissionIndex'])->name('rolePermission.index');
    Route::get('/role/permission/create', [RoleController::class, 'rolePermissionCreate'])->name('rolePermission.create');
    Route::post('/role/permission', [RoleController::class, 'rolePermissionStore'])->name('rolePermission.store');
    Route::get('/role/permission/{id}', [RoleController::class, 'rolePermissionEdit'])->name('rolePermission.edit');
    Route::put('/role/permission/{id}', [RoleController::class, 'rolePermissionUpdate'])->name('rolePermission.update');
    Route::delete('/role/permission/{id}', [RoleController::class, 'rolePermissionDestroy'])->name('rolePermission.destroy');
});

require __DIR__.'/auth.php';
