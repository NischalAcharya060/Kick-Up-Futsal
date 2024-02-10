<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\CalendarController;
use App\Http\Controllers\User\FacilitySubmissionController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\User\ContactUsController;
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
    return view('welcome');
});

//login Register Routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerPost']);

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('login');
});

//google login route
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//forget Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


//Logout Route
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//admin and Futsal Manager Route
Route::middleware(['auth', 'user_type:admin,futsal_manager'])->group(function () {
    Route::get('/admin_dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

//Notification
Route::middleware(['auth', 'user_type:admin'])->group(function () {
    Route::get('/admin/notifications', [AdminDashboardController::class, 'notifications'])->name('admin.notifications.index');
    Route::post('/admin/notifications/mark-as-read/{notification}', [AdminDashboardController::class, 'markAsRead'])->name('admin.notifications.markAsRead');
    Route::get('/admin/notifications/view-submission/{notification}', [AdminDashboardController::class, 'viewSubmission'])->name('admin.notifications.viewSubmission');
});

//Admin User Management Page Route
Route::middleware(['auth', 'user_type:admin'])->group(function () {
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::post('admin/users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::post('admin/users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');
});

//admin profile Route
Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
Route::post('/admin/profile/update-details', [ProfileController::class, 'updateDetails'])->name('admin.profile.update.details');
Route::post('/admin/profile/update-password', [ProfileController::class, 'updatePassword'])->name('admin.profile.update.password');


// Facilities Routes
Route::middleware(['auth', 'user_type:admin,futsal_manager'])->prefix('admin')->group(function () {
    Route::get('facilities', [FacilitiesController::class, 'index'])->name('admin.facilities.index');
    Route::get('facilities/create', [FacilitiesController::class, 'create'])->name('admin.facilities.create');
    Route::post('facilities', [FacilitiesController::class, 'store'])->name('admin.facilities.store');
    Route::get('facilities/{facility}', [FacilitiesController::class, 'show'])->name('admin.facilities.show');
    Route::get('facilities/{facility}/edit', [FacilitiesController::class, 'edit'])->name('admin.facilities.edit');
    Route::put('facilities/{facility}', [FacilitiesController::class, 'update'])->name('admin.facilities.update');
    Route::delete('facilities/{facility}', [FacilitiesController::class, 'destroy'])->name('admin.facilities.destroy');
});

//user Route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// User Profile Page
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/update-details', [UserProfileController::class, 'updateDetails'])->name('profile.update.details');
    Route::post('/profile/additional-details', [UserProfileController::class, 'additionalDetails'])->name('profile.update.additionaldetails');
    Route::post('/profile/update-password', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
});

//Calendar Route
Route::middleware(['auth'])->group(function () {
Route::get('/calendar', [CalendarController::class, 'index'])->name('user.calendar');
});

// Facility Submission
Route::middleware(['auth'])->group(function () {
Route::get('facility_submissions/create', [FacilitySubmissionController::class, 'create'])->name('user.facility_submissions.create');
Route::post('facility_submissions/store', [FacilitySubmissionController::class, 'store'])->name('user.facility_submissions.store');
Route::get('/admin/facility_submissions/{id}', [FacilitySubmissionController::class, 'viewSubmission'])->name('user.facility_submissions.view');
Route::patch('facility_submissions/{id}/update-status', [FacilitySubmissionController::class, 'updateStatus'])->name('user.facility_submissions.updateStatus');
});

//Booking Route
Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('user.booking.index');
    Route::get('/booking/show/{facilityId}', [BookingController::class, 'show'])->name('user.booking.show');
    Route::post('/booking/confirm/{facilityId}', [BookingController::class, 'confirm'])->name('user.booking.confirm');
    Route::get('/generate-receipt', [BookingController::class, 'generateReceipt'])->name('generate.receipt');
});

//Bookmark
Route::middleware(['auth'])->group(function () {
    Route::post('/facility/bookmark/{facility}', [BookingController::class, 'bookmark'])->name('user.facility.bookmark');
    Route::get('/bookmarks', [BookingController::class, 'bookmarks'])->name('user.bookmarks');
    Route::delete('/user/unbookmark/{facilityId}', [BookingController::class, 'unbookmark'])->name('user.unbookmark');
});

//Admin Booking History Route
Route::middleware(['auth', 'user_type:admin,futsal_manager'])->prefix('admin')->group(function () {
    Route::get('bookings', [BookingsController::class, 'index'])->name('admin.bookings.index');
    Route::get('bookings/{booking}', [BookingsController::class, 'show'])->name('admin.bookings.show');
});

// Contact us Route
Route::middleware(['auth'])->group(function () {
Route::get('/contactUs', [ContactUsController::class, 'showForm'])->name('contact.show');
Route::post('/contactUs', [ContactUsController::class, 'submitForm'])->name('contact.submit');
});
