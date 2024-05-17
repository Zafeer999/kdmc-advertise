<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('frontend.home');
});


// Guest Users
Route::middleware(['guest','PreventBackHistory'])->group(function()
{
    // Admin Routes
    Route::get('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.home');
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'] )->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('signup', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'] )->name('register');
    Route::post('signup', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');


});



// Authenticated users
Route::middleware(['auth','PreventBackHistory'])->group(function()
{

    // Auth Routes
    Route::get('edit-profile', [App\Http\Controllers\Admin\DashboardController::class, 'editProfile'] )->name('edit-profile');
    // Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'] )->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'] )->name('change-password');


    // Dashboard routes
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Masters Route
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class );
    Route::resource('locations', App\Http\Controllers\Admin\Masters\LocationController::class );
    Route::resource('banners', App\Http\Controllers\Admin\Masters\BannerController::class );
    Route::resource('police_stations', App\Http\Controllers\Admin\Masters\PoliceStationController::class );
    Route::resource('documents', App\Http\Controllers\Admin\Masters\DocumentController::class );



    // User Route
    Route::get('advertise-permission', [App\Http\Controllers\Frontend\UserController::class, 'index'] )->name('advertise-permission');



    // Admin Registration
    Route::resource('users', App\Http\Controllers\Admin\AdminController::class );
    Route::get('reports', [App\Http\Controllers\Admin\ReportController::class, 'index'] )->name('reports.index');



    // Police Routes
    Route::get('permission-requests/{id?}', [App\Http\Controllers\Admin\PoliceController::class, 'index'] )->name('permission-requests');
    Route::get('permission-requests-ward/{id}/{ward_id}', [App\Http\Controllers\Admin\PoliceController::class, 'wardWiseList'] )->name('permission-requests-ward');
    Route::get('view-application/{id}', [App\Http\Controllers\Admin\PoliceController::class, 'viewApplication'] )->name('view-application');
    Route::get('approve-application/{id}', [App\Http\Controllers\Admin\PoliceController::class, 'ApproveApplication'] )->name('approve-application');
    Route::put('reject-application/{id}', [App\Http\Controllers\Admin\PoliceController::class, 'RejectApplication'] )->name('reject-application');
    // Route::get('approve-ward-application/{id}', [App\Http\Controllers\Admin\WardController::class, 'ApproveApplication'] )->name('approve-ward-application');
    // Route::put('reject-ward-application/{id}', [App\Http\Controllers\Admin\WardController::class, 'RejectApplication'] )->name('reject-ward-application');




    // Frontend Auth Routes
    Route::get('terms-conditions', [App\Http\Controllers\Frontend\UserController::class, 'termsCondition'] )->name('terms-conditions');
    Route::get('application_form', [App\Http\Controllers\Frontend\UserController::class, 'applicationForm'] )->name('application-form');
    Route::get('application-form', [App\Http\Controllers\Frontend\UserController::class, 'applicationForm'] )->name('frontend.application-form');
    Route::get('wards/{ward}/locations', [App\Http\Controllers\Admin\Masters\WardController::class, 'wardWiseLocations'] )->name('wards.locations');
    Route::get('locations/{location}/from_date', [App\Http\Controllers\Admin\Masters\LocationController::class, 'locationWiseFromdate'] )->name('locations.dates');
    Route::get('application/to_date/{date}', [App\Http\Controllers\Frontend\UserController::class, 'getApplicationToDate'] )->name('application.to-date');
    Route::post('application-form', [App\Http\Controllers\Frontend\UserController::class, 'submitApplication'] )->name('frontend.submit-application');

    Route::get('cancel-application-list', [App\Http\Controllers\Frontend\UserController::class, 'cancelApplicationList'] )->name('cancel-application-list');
    Route::put('cancel-application/{application}', [App\Http\Controllers\Frontend\UserController::class, 'cancelApplication'] )->name('cancel-application');
    Route::get('qr-code-list', [App\Http\Controllers\Frontend\UserController::class, 'qrCodeList'] )->name('qr-code-list');
    Route::get('download-qr-code/{application}', [App\Http\Controllers\Frontend\UserController::class, 'downloadQrCode'] )->name('download-qr-code');
    Route::get('certificate-list', [App\Http\Controllers\Frontend\UserController::class, 'certificateList'] )->name('certificate-list');
    Route::get('download-certificate/{application}', [App\Http\Controllers\Frontend\UserController::class, 'downloadCertificate'] )->name('download-certificate');

    Route::get('payment-list/{id}', [App\Http\Controllers\Frontend\PaymentController::class, 'paymentList'] )->name('payment-list');
    Route::get('initiate-payment/{application}', [App\Http\Controllers\Frontend\PaymentController::class, 'initiatePayment'] )->name('initiate-payment');
    Route::post('payment-success', [App\Http\Controllers\Frontend\PaymentController::class, 'paymentSuccess'] )->name('payment-success');
    // Route::get('payment-success-page', [App\Http\Controllers\Frontend\PaymentController::class, 'paymentSuccessPage'] )->name('payment-success-page');
    Route::post('payment-failed', [App\Http\Controllers\Frontend\PaymentController::class, 'paymentFailed'] )->name('payment-failed');
    // Route::get('payment-failed-page', [App\Http\Controllers\Frontend\PaymentController::class, 'paymentFailedPage'] )->name('payment-failed-page');
});




// Frontend Guest Routes
Route::get('/home', [App\Http\Controllers\Frontend\AuthController::class, 'home'])->name('frontend.home');
Route::get('/scan-certificate/{application}', [App\Http\Controllers\Frontend\UserController::class, 'showCertificate'])->name('frontend.show-certificate');



