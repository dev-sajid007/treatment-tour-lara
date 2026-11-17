<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIDoctorController;
use App\Http\Controllers\Api\APIPortfolioController;
use App\Http\Controllers\Api\APIQuoteController;
use App\Http\Controllers\Api\APIReviewController;
use App\Http\Controllers\Api\APIReportController;
use App\Http\Controllers\Api\APIContactController;
use App\Http\Controllers\Api\APIClinicController;
//use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PatientAppointmentController;

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\ZoomController;

//   API
Route::post('v1/login', [LoginController::class, 'login']);
Route::get('v1/menus/{slug}', [MenuController::class, 'show']);

//  Route::get('register', [RegisteredUserController::class, 'create'])
            //  ->name('register');

// Route::post('register', [RegisteredUserController::class, 'store']);
//Route::post('v1/register-patient', [RegisteredUserController::class, 'storePatient']);
//Route::post('v1/register-doctor', [RegisteredUserController::class, 'storeDoctor']);
//Route::group(['middleware'=>'auth:sanctum'], function(){
    //Route::get('v1/patients/{id}', [RegisteredUserController::class, 'showPatient']);
    //Route::post('v1/patients/{id}', [RegisteredUserController::class, 'updatePatient']);
    //Route::get('v1/doctors/{id}', [RegisteredUserController::class, 'showDoctor']); 
    //Route::post('v1/doctors/{id}', [RegisteredUserController::class, 'updateDoctor']); 
//});
Route::get('v1/doctors', [APIDoctorController::class, 'index']);

Route::apiResource('v1/clinics', \App\Http\Controllers\Api\APIClinicController::class);

Route::apiResource('v1/appointments', \App\Http\Controllers\Api\PatientAppointmentController::class);

Route::get('v1/clinics/search', [APIClinicController::class, 'search']);

// Doctors, Portfolios, and Quotes under Clinics (Nested Routes)
Route::apiResource('v1/clinics.doctors', APIDoctorController::class)->parameters(['doctorss' => 'doctor']);
Route::apiResource('v1/clinicss.portfolios', APIPortfolioController::class)->parameters(['portfolioss' => 'portfolio']);
Route::apiResource('v1/clinicss.quotes', APIQuoteController::class)->parameters(['quotes' => 'quote']);

Route::apiResource('v1/categories', \App\Http\Controllers\Api\CategoryApiController::class);
Route::apiResource('v1/subcategories', \App\Http\Controllers\Api\SubCategoryApiController::class);
Route::apiResource('v1/countries', \App\Http\Controllers\Api\CountryApiController::class);
Route::apiResource('v1/states', \App\Http\Controllers\Api\StateApiController::class);
Route::apiResource('v1/featuredons', \App\Http\Controllers\Api\FeaturedOnApiController::class);


// New routes for fetching clinics by category and subcategory
Route::get('v1/categories/{categoryId}/clinics', [\App\Http\Controllers\Api\APIClinicController::class, 'getClinicsByCategory']);
Route::get('v1/subcategories/{subcategoryId}/clinics', [\App\Http\Controllers\Api\APIClinicController::class, 'getClinicsBySubCategory']);

Route::get('v1/countriess/{countryId}/clinics', [\App\Http\Controllers\Api\CountryApiController::class, 'getClinics']);
Route::get('v1/statess/{stateId}/clinics', [\App\Http\Controllers\Api\StateApiController::class, 'getClinics']);
// Reviews API
Route::apiResource('v1/clinicss.reviewss', APIReviewController::class)->parameters(['reviews' => 'review']);


// reprot
Route::post('v1/reports', [APIReportController::class, 'store']);

// contacts

Route::post('v1/contacts', [APIContactController::class, 'store']);
//Route::post('v1/appointments', [\App\Http\Controllers\Api\APIAppointmentController::class, 'store']);

// new Route ... fetching doctors by state
Route::get('v1/doctors/by/{country}', [APIDoctorController::class ,  'doctorByCountry']);
Route::get('v1/city/by/{countryId}', [APIDoctorController::class ,  'cityByState']);
Route::get('v1/doctors-by/{state}', [APIDoctorController::class ,  'doctorByState']);
Route::get('v1/doctor/{Id}', [APIDoctorController::class ,  'getDoctorById']);

// hospital
Route::get('v1/hospitals', [HospitalController::class , 'index']);
Route::get('v1/hospitals/by/{country}', [HospitalController::class , 'hospitalByCountry']);
Route::get('v1/hospitals-by/{state}', [HospitalController::class , 'hospitalByState']);


Route::get('/dashboard/state', [DashboardController::class , 'dashboardState']);

Route::get('/zoom/oauth-url', [ZoomController::class, 'getOAuthUrl']);
Route::get('/zoom/callback', [ZoomController::class, 'handleCallback']);
Route::post('/zoom/create-meeting', [ZoomController::class, 'createMeeting']);
