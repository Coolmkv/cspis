<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\WebSiteController;


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
    return view('home_page');
});
Route::get("about-us",[WebSiteController::class,"aboutUs"])->name("aboutUs");
Route::get("contact-us",[WebSiteController::class,"contactUs"])->name("contactUs");
Route::get("register-student",[WebSiteController::class,"registerStudent"])->name("registerStudent");
Route::get("scholarship",[WebSiteController::class,"scholarship"])->name("scholarship");
Route::get("complete_purchase",[WebSiteController::class,"completePurchase"])->name("completePurchase");
Route::post("check_payments",[WebSiteController::class,"checkPayment"])->name("checkPayment");
Route::get('payment_complete', [WebSiteController::class, 'paymentSuccess'])->name('paymentSuccess');
Route::post('contactUsSubmit', [ContactUs::class, 'contactUsSubmit'])->name('contactUsSubmit');
Route::get('terms-and-conditions', function(){
    return view('WebSitePages.termsAndConditions');
})->name('TnC');
Route::get('privacy-policy', function(){
    return view('WebSitePages.privacyPolicy');
})->name('PrivacyPolicy');

Route::get('cancellation-refund-policy', function(){
    return view('WebSitePages.cancellationAndRefund');
})->name('cancelNRefund');

Route::post('registerStudent', [WebSiteController::class, 'registerStudentInfo'])->name('registerStudentInfo');
Route::get('razorpay', [WebSiteController::class, 'razorpay'])->name('razorpay');
Route::get('refresh-captcha',[WebSiteController::class,"refreshCapthca"])->name("refreshCaptcha");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

 

Route::middleware(['auth'])->group(function () {
    Route::get("/new-dashboard",[AdminController::class,"dashboard"])->name("new-dashboard");
    Route::get("site-navigation",[AdminController::class,"siteNav"])->name("siteNav");
    Route::post("addEditNavigation",[AdminController::class,"addEditNavigation"])->name("addNaviagtion");
    Route::post("deleteNavigation",[AdminController::class,"deleteNavigation"])->name("deleteNavigation");
    Route::post("navDataTable",[AdminController::class,"navDataTable"])->name("navDataTable");

    Route::get("manage-gallery",[AdminController::class,"manageGallery"])->name("manageGallery");
    Route::post("addGalleryItems",[AdminController::class,"addGalleryItems"])->name("addGalleryItems");
    Route::post("addGalleryDataTable",[AdminController::class,"addGalleryDataTable"])->name("addGalleryDataTable");

    Route::get("web-site-elements",[AdminController::class,"webSiteElements"])->name("webSiteElements");
    Route::get("registered-students",[AdminController::class,"registeredStudents"])->name("registeredStudents");
    Route::post("registered-students-datatable",[AdminController::class,"registeredStudentsData"])->name("registeredStudentsDataTable");
});

require __DIR__.'/auth.php';
Route::get("login",[AdminController::class,"Login"])->name("login");
Route::post("AdminUserLogin",[AdminController::class,"AdminLoginUser"])->name("AdminLogin");
Route::get("getmenu-items",[HomePageController::class,"getMenu"]);

