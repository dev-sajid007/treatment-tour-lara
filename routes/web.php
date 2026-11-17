<?php

use Illuminate\Support\Facades\Route;

Use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

use App\Http\Controllers\AdminController\{
    DashboardController,
    SettingsController,
    ExpenseController,
    UserController,
    NoteController,
    CategoryController,
    LocationController,
    FeaturedOnController,
    ClinicController,
    PortfolioController,
    DoctorController,
    QuoteController,
    AdminReportController,
    MenuController
};

use App\Http\Controllers\Admin\{
    HospitalController
};

use App\Http\Controllers\ClinicController\{
    ClinicDashboardController,
    ClinicQuoteController,
    ClinicPortfolioController,
    ClinicDoctorController,
    ReportController,
    ClinicReviewController,
    ClinicAppointmentController
};

use App\Http\Controllers\PatientController\{
    PatientDashboardController,
};

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckClinic;
use App\Http\Middleware\CheckPatient;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;


use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\Admin\MedCategoryController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Patient\PatientHistoryController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Doctor\DoctorSlotController;
use App\Http\Controllers\Hospital\HospitalManageController;
use App\Http\Controllers\Hospital\HospitalUserController;
use App\Http\Controllers\Patient\PatientAppointmentController;
use App\Http\Controllers\Doctor\DoctorAppointmentController;

use App\Http\Controllers\Clinic\ClinicManageController;
use App\Http\Controllers\Clinic\ClinicUserController;

use App\Http\Controllers\DoctorProfileController;

use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\Doctor\CommonController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\Package\TreatmentCategoryController;
use App\Http\Controllers\Package\TreatmentPackageController;
use App\Http\Controllers\Package\PackageManagerController;
use App\Http\Controllers\APIs\ZoomController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogManagerController;
use App\Http\Controllers\FreeQuoteController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReportGalleryController;
use App\Http\Controllers\PageGenerationController;
use App\Http\Controllers\PaymentController;




Auth::routes(['verify' => true]);

Route::get('/', [WebController::class, 'index'])->name('web.home');
Route::get('/doctors/{country}/{category}', [WebController::class, 'doctor'])->name('web.doctor');
Route::get('/hospitals/{country}', [WebController::class, 'hospital'])->name('web.hospital');
Route::get('/online-appointment/{doctor}', [WebController::class, 'appointment'])->name('web.appointment');
Route::post('/online-appointment/{doctor}', [WebController::class, 'onlineAppointment'])->name('online.appointment');

Route::get('/medical-treatment/{id}', [WebController::class, 'medicalTreatment'])->name('medical.treatment');
Route::get('/cosmetic-treatment/{id}', [WebController::class, 'cosmeticTreatment'])->name('cosmetic.treatment');
Route::get('/cosmetic-treatment/speciality/{id}', [WebController::class, 'specialCosTreatment'])->name('cosmetic.treatment.speciality');
Route::get('/doctor-about/{doctor}', [WebController::class, 'doctorAbout'])->name('doctor.about');
//Route::get('/medical-treatment', [WebController::class, 'medicalTreatment'])->name('medical.treatment');
Route::get('/partner/', [WebController::class, 'partner'])->name('partner');
Route::post('/partner/', [PartnerController::class, 'store'])->name('partner.store');

Route::post('ckeditor/upload', [WebController::class, 'upload'])->name('ckeditor.upload');

Route::get('/treatment-package-list', [PackageManagerController::class, 'packages'])->name('treatment.package');
Route::get('/package-view/{id}', [PackageManagerController::class, 'packageView'])->name('treatment.package.view');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


// Route::get('/', function () {
//     $settings = DB::table('settings')->first();
//     return view('auth.login', compact('settings'));
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/generate-storage-link', function () {
    Artisan::call('storage:link');
    return redirect()->back()->with('success', 'Storage link generated successfully.');
})->name('generate.storage.link');

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    return back()->with('success', 'All caches cleared successfully!');
})->name('clear-all-cache');



Route::get('/roles', [RoleController::class, 'getAllRoles'])->name('roles.index');
Route::post('/roles/create', [RoleController::class, 'createRole'])->name('roles.create');
Route::delete('/roles/delete/{roleName}', [RoleController::class, 'deleteRole'])->name('roles.delete');
Route::post('/roles/assign-permission/{roleName}', [RoleController::class, 'assignPermissionToRole'])->name('roles.assignPermission');

Route::get('/permissions', [RoleController::class, 'getAllPermissions'])->name('permissions.index');
Route::post('/permissions/create', [RoleController::class, 'createPermission'])->name('permissions.create');
Route::delete('/permissions/delete/{permissionName}', [RoleController::class, 'deletePermission'])->name('permissions.delete');

// User management routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{userId}/assign-role', [RoleController::class, 'assignRoleToUser'])->name('users.assignRole');
Route::post('/users/{userId}/assign-permission', [RoleController::class, 'assignPermissionToUser'])->name('users.assignPermission');
Route::delete('/users/{userId}/remove-role', [RoleController::class, 'removeRoleFromUser'])->name('users.removeRole');
Route::delete('/users/{userId}/remove-permission', [RoleController::class, 'removePermissionFromUser'])->name('users.removePermission');


// GET route to show the permissions form
Route::get('/roles/{role}/edit-permissions', [RoleController::class, 'editPermissions'])->name('roles.editPermissions');

// PUT route to update the permissions
Route::post('/roles/{role}/update-permissions', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');


//update route

Route::get('/users/edit-permissions', [UserRoleController::class, 'editPermissions'])->name('users.editPermissions');
Route::put('/users/{user}/update-permissions', [UserRoleController::class, 'updatePermissions'])->name('users.updatePermissions');







Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/menus/{slug}', [MenuController::class, 'show'])->name('menus');
    Route::get('/menus/{slug}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('/menu_items/store', [MenuController::class, 'store'])->name('menu_items.store');
    Route::post('/menus/{slug}', [MenuController::class, 'update'])->name('menus.update');

    // Expense
    Route::get('/add_expense', [ExpenseController::class, 'addpage'])->name('expense.add');
    Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/all_expenses', [ExpenseController::class, 'index'])->name('expenses.all');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

     // Users Managment
     Route::resource('users', UserController::class);
     Route::post('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');
     Route::post('/users/{id}/salepointaccess', [UserController::class, 'salePointAccess'])->name('users.salePointAccess');


    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::put('/settings/menu-access', [SettingsController::class, 'updateMenuAccess'])->name('settings.menu_access.update');

    Route::resource('notes', NoteController::class);


    Route::resource('categories', CategoryController::class);

    Route::resource('treatment-categories', TreatmentCategoryController::class);

    Route::resource('treatment-packages', TreatmentPackageController::class);

   // SubCategories routes
    Route::get('/subcategories', [CategoryController::class, 'indexsubcategory'])->name('indexsubcategory');
    Route::post('/subcategories', [CategoryController::class, 'storesubcategory'])->name('storesubcategory');
    Route::put('/subcategories/{id}', [CategoryController::class, 'updatesubcategory'])->name('updatesubcategory');
    Route::delete('/subcategories/{id}', [CategoryController::class, 'deletesubcategory'])->name('deletesubcategory');


    Route::get('/subcategories/{id}/edit', [CategoryController::class, 'subEdit'])->name('sub.edit');


    // Country routes
    Route::get('/admin/location', [LocationController::class, 'index'])->name('admin.location.index');
    Route::post('/admin/location', [LocationController::class, 'store'])->name('admin.location.store');
    Route::put('/admin/location/{id}', [LocationController::class, 'update'])->name('admin.location.update');
    Route::delete('/admin/location/{id}', [LocationController::class, 'destroy'])->name('admin.location.destroy');

    // State routes
    Route::get('/admin/location/state', [LocationController::class, 'indexstate'])->name('admin.location.indexstate');
    Route::post('/admin/location/state', [LocationController::class, 'storestate'])->name('admin.location.storestate');
    Route::put('/admin/location/state/{id}', [LocationController::class, 'updatestate'])->name('admin.location.updatestate');
    Route::delete('/admin/location/state/{id}', [LocationController::class, 'deletestate'])->name('admin.location.deletestate');

    // FeaturedOn routes
    Route::get('/admin/featured_on', [FeaturedOnController::class, 'index'])->name('admin.featured_on.index');
    Route::post('/admin/featured_on', [FeaturedOnController::class, 'store'])->name('admin.featured_on.store');
    Route::put('/admin/featured_on/{id}', [FeaturedOnController::class, 'update'])->name('admin.featured_on.update');
    Route::delete('/admin/featured_on/{id}', [FeaturedOnController::class, 'destroy'])->name('admin.featured_on.destroy');

    // Hospitals routes
    Route::get('/admin/hospitals', [HospitalController::class, 'index'])->name('admin.hospitals.index'); // List hospitals
    Route::get('/admin/hospitals/create', [HospitalController::class, 'create'])->name('admin.hospitals.create'); // Create hospital form
    Route::post('/admin/hospitals', [HospitalController::class, 'store'])->name('admin.hospitals.store'); // Store hospital
    Route::get('/admin/hospitals/{id}', [HospitalController::class, 'show'])->name('admin.hospitals.show'); // Show hospital details
    Route::get('/admin/hospitals/{id}/edit', [HospitalController::class, 'edit'])->name('admin.hospitals.edit'); // Edit hospital form
    Route::delete('/admin/hospitals/{id}', [HospitalController::class, 'destroy'])->name('admin.hospitals.destroy'); // Delete hospital

    Route::put('/admin/hospitals/{id}', [HospitalController::class, 'update'])->name('admin.hospitals.update');

    Route::get('/hospital-request', [HospitalController::class, 'hospitalRequest'])->name('admin.hospitals.request');


    Route::post('hospital-status/{id}/approve', [HospitalController::class, 'approve'])->name('admin.hospitals.approve');
    Route::post('hospital-status/{id}/cancel', [HospitalController::class, 'cancel'])->name('admin.hospitals.cancel');
    
    // Clinic routes
    Route::get('/admin/clinics', [ClinicController::class, 'index'])->name('admin.clinics.index'); // List clinics
    Route::get('/admin/clinics/create', [ClinicController::class, 'create'])->name('admin.clinics.create'); // Create clinic form
    Route::post('/admin/clinics', [ClinicController::class, 'store'])->name('admin.clinics.store'); // Store clinic
    Route::get('/admin/clinics/{id}', [ClinicController::class, 'show'])->name('admin.clinics.show'); // Show clinic details
    Route::get('/admin/clinics/{id}/edit', [ClinicController::class, 'edit'])->name('admin.clinics.edit'); // Edit clinic form
    Route::put('/admin/clinics/{id}', [ClinicController::class, 'update'])->name('admin.clinics.update'); // Update clinic
    Route::delete('/admin/clinics/{id}', [ClinicController::class, 'destroy'])->name('admin.clinics.destroy'); // Delete clinic
    Route::get('/admin/states-by-country/{country_id}', [ClinicController::class, 'getStatesByCountry'])->name('admin.getStatesByCountry');
    Route::delete('/admin/clinics/{id}/gallery-image', [ClinicController::class, 'deleteGalleryImage'])->name('admin.clinics.deleteGalleryImage');

    Route::get('/admin/clinics/{clinic_id}/portfolios', [PortfolioController::class, 'index'])->name('admin.portfolios.index');
    Route::post('/admin/clinics/{clinic_id}/portfolios', [PortfolioController::class, 'store'])->name('admin.portfolios.store');
    Route::delete('/admin/portfolios/{id}', [PortfolioController::class, 'destroy'])->name('admin.portfolios.destroy');


    Route::get('/admin/clinics/{clinic_id}/doctors', [DoctorController::class, 'index'])->name('admin.doctors.index');
    Route::post('/admin/clinics/{clinic_id}/doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::put('/admin/doctors/{doctor_id}', [DoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('/admin/doctors/{doctor_id}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

    Route::get('/admin/clinics/{clinic_id}/quotes', [QuoteController::class, 'index'])->name('admin.quote.index');
    Route::post('/admin/clinics/{clinic_id}/quotes', [QuoteController::class, 'store'])->name('admin.quote.store');
    Route::put('/admin/quotes/{quote_id}', [QuoteController::class, 'update'])->name('admin.quote.update');
    Route::delete('/admin/quotes/{quote_id}', [QuoteController::class, 'destroy'])->name('admin.quote.destroy');

    Route::prefix('admin')->group(function () {
        Route::get('reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
        Route::delete('reports/{report}', [AdminReportController::class, 'destroy'])->name('admin.reports.destroy');

        Route::get('contacts', [AdminReportController::class, 'contacts'])->name('admin.contacts.index');
        Route::delete('/admin/contacts/{id}', [AdminReportController::class, 'contactsdestroy'])->name('admin.contacts.destroy');

    });

    Route::get('admin/appointments', [AppointmentController::class, 'appointmentsList'])->name('admin.appointments.list');
    Route::delete('admin/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
    Route::post('admin/appointments/sendEmail', [AppointmentController::class, 'sendEmail'])->name('admin.appointments.sendEmail');


  });



  Route::middleware(['auth'])->group(function () {
     Route::get('/clinic/dashboard', [ClinicDashboardController::class, 'index'])->name('clinic.dashboard');

     Route::get('/clinic/clinics/edit', [ClinicDashboardController::class, 'edit'])->name('clinics.clinics.edit'); // Edit clinic form
     Route::put('/clinic/clinics', [ClinicDashboardController::class, 'update'])->name('clinics.clinics.update'); // Update clinic
     Route::delete('/clinics/clinics/{id}/gallery-image', [ClinicDashboardController::class, 'deleteGalleryImage'])->name('clinics.clinics.deleteGalleryImage');

     Route::get('/clinics/clinics/quotes', [ClinicQuoteController::class, 'index'])->name('clinics.quote.index');
     Route::post('/clinics/clinics/quotes', [ClinicQuoteController::class, 'store'])->name('clinics.quote.store');
     Route::put('/clinics/quotes/{quote_id}', [ClinicQuoteController::class, 'update'])->name('clinics.quote.update');
     Route::delete('/clinics/quotes/{quote_id}', [ClinicQuoteController::class, 'destroy'])->name('clinics.quote.destroy');


     Route::get('/clinics/clinics/portfolios', [ClinicPortfolioController::class, 'index'])->name('clinics.portfolios.index');
     Route::post('/clinics/clinics/portfolios', [ClinicPortfolioController::class, 'store'])->name('clinics.portfolios.store');
     Route::delete('/clinics/portfolios/{id}', [ClinicPortfolioController::class, 'destroy'])->name('clinics.portfolios.destroy');
 
 
     Route::get('/clinics/clinics/doctors', [ClinicDoctorController::class, 'index'])->name('clinics.doctors.index');
     Route::post('/clinics/clinics/doctors', [ClinicDoctorController::class, 'store'])->name('clinics.doctors.store');
     Route::put('/clinics/doctors/{doctor_id}', [ClinicDoctorController::class, 'update'])->name('clinics.doctors.update');
     Route::delete('/clinics/doctors/{doctor_id}', [ClinicDoctorController::class, 'destroy'])->name('clinics.doctors.destroy');


     Route::prefix('clinics')->group(function () {
        Route::get('reports', [ReportController::class, 'index'])->name('clinics.reports.index');
        Route::get('reports/create', [ReportController::class, 'create'])->name('clinics.reports.create');
        Route::post('reports', [ReportController::class, 'store'])->name('clinics.reports.store');
        Route::delete('reports/{report}', [ReportController::class, 'destroy'])->name('clinics.reports.destroy');
    });


    Route::get('/clinics/clinics/reviews', [ClinicReviewController::class, 'index'])->name('clinics.reviews.index');
    Route::post('/clinics/clinics/reviews', [ClinicReviewController::class, 'store'])->name('clinics.reviews.store');
    Route::delete('/clinics/reviews/{id}', [ClinicReviewController::class, 'destroy'])->name('clinics.reviews.destroy');


    Route::get('clinics/appointments', [ClinicAppointmentController::class, 'appointmentsList'])->name('clinics.appointments.list');
    Route::delete('clinics/appointments/{appointment}', [ClinicAppointmentController::class, 'destroy'])->name('clinics.appointments.destroy');
  });


 Route::middleware(['auth'])->group(function () {
    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
 });


  Route::middleware(['auth'])->group(function () {
    // Customer Deposit
    //Route::post('/deposit', [CustomerController::class, 'deposit'])->name('customer_deposit');

    // Profile Edit
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/profile-update', [ProfileController::class, 'updateProfileImage'])->name('profileUpdate');

    Route::resources([
        'specialities' => SpecialityController::class,
    ]);

    // Area by Get Customer
    //Route::get('/by-area/{categoryId}', [SaleController::class, 'getCustomer'])->name('getCustomer');
  });



Route::middleware(['auth'])->group(function () {
    Route::resources([
        'med-categories' => MedCategoryController::class,
        'medicines' => MedicineController::class
    ]);


});

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'slots' => DoctorSlotController::class 
    ]);


});


Route::middleware(['auth'])->prefix('patient')->as('patient.')->group(function () {
    Route::resources([
        'infos' => PatientHistoryController::class,
    ]);

    Route::get('/my-history', [PatientController::class, 'myHistory'])->name('my.history');
});




Route::post('/hospital/{hospital}/settings', [HospitalManageController::class, 'hospitalSettingStore'])->name('hospital.settings.store');
Route::put('/hospital/settings/{setting}', [HospitalManageController::class, 'hospitalSettingUpdate'])->name('hospital.settings.update');

Route::post('/hospital/{hospital}/users', [HospitalUserController::class, 'user'])->name('hospital.users.store');

Route::get('/hospital-users', [HospitalUserController::class, 'hospitalUser'])->name('hospital.users.list');

Route::get('/patient-appointments', [PatientAppointmentController::class, 'index'])->name('patient.appointments.index');

Route::put('/patient-appointments/{id}', [PatientAppointmentController::class, 'update'])->name('patient.appointments.update');


Route::get('/prescriptions/create/{doctor}/{patient}/{appointment}', [PrescriptionController::class, 'create'])->name('prescriptions.create'); 

Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store'); 
Route::get('/prescriptions/edit/{prescription}/{doctor}/{patient}/{appointment}', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');


Route::put('/prescriptions/{id}', [PrescriptionController::class, 'update'])->name('prescriptions.update');

Route::get('/prescriptions/{id}/download', [PrescriptionController::class, 'download'])->name('prescriptions.download');




Route::get('/doctor-appointments', [DoctorAppointmentController::class, 'index'])->name('doctor.appointments.index');

Route::put('/doctor-appointments/{id}', [DoctorAppointmentController::class, 'update'])->name('doctor.appointments.update');

//Route::resource('doctor-profiles', DoctorProfileController::class);


Route::get('doctor-profiles', [DoctorProfileController::class, 'index'])->name('doctor-profiles.index');
Route::get('doctor-profiles/create', [DoctorProfileController::class, 'create'])->name('doctor-profiles.create');
Route::post('doctor-profiles', [DoctorProfileController::class, 'store'])->name('doctor-profiles.store');
Route::get('doctor-profiles/{doctor_profile}', [DoctorProfileController::class, 'show'])->name('doctor-profiles.show');
Route::get('doctor-profiles/{doctor_profile}/edit', [DoctorProfileController::class, 'edit'])->name('doctor-profiles.edit');
Route::put('doctor-profiles/{doctor_profile}', [DoctorProfileController::class, 'update'])->name('doctor-profiles.update');
Route::delete('doctor-profiles/{doctor_profile}', [DoctorProfileController::class, 'destroy'])->name('doctor-profiles.destroy');


//clinic

Route::post('/clinic/{clinic}/settings', [ClinicManageController::class, 'clinicSettingStore'])->name('clinic.settings.store');
Route::put('/clinic/settings/{setting}', [ClinicManageController::class, 'clinicSettingUpdate'])->name('clinic.settings.update');

Route::post('/clinic/{clinic}/users', [ClinicUserController::class, 'user'])->name('clinic.users.store');

Route::get('/clinic-user/', [ClinicUserController::class, 'clinicUser'])->name('clinic.users.list');

Route::get('/medications/search', [CommonController::class, 'search'])->name('medications.search');




//zoom 

Route::get('/zoom', [ZoomController::class, 'index'])->name('zoom.index');
Route::post('/zoom/create', [ZoomController::class, 'createMeeting'])->name('zoom.create');
Route::delete('/zoom/delete/{id}', [ZoomController::class, 'deleteMeeting'])->name('zoom.delete');
Route::get('/zoom/start/{id}', [ZoomController::class, 'startMeeting'])->name('zoom.start');



Route::get('/home-settings', [HomeSettingController::class, 'edit'])->name('home-settings.edit');
Route::post('/home-settings', [HomeSettingController::class, 'storeOrUpdate'])->name('home-settings.save');



//blog
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{slug}/', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::resource('faqs', FaqController::class);

Route::resource('podcasts', PodcastController::class);

Route::get('/blog-list', [BlogManagerController::class, 'blogList'])->name('blog.list');
Route::get('/blog-view/{slug}', [BlogManagerController::class, 'blogView'])->name('blog.view');


Route::get('/free-quotes', [FreeQuoteController::class, 'index'])->name('free-quotes.index');
Route::get('/free-quotes/create', [FreeQuoteController::class, 'create'])->name('free-quotes.create');
Route::post('/free-quotes', [FreeQuoteController::class, 'store'])->name('free-quotes.store');
Route::get('/free-quotes/{free_quote}', [FreeQuoteController::class, 'show'])->name('free-quotes.show');
Route::get('/free-quotes/{free_quote}/edit', [FreeQuoteController::class, 'edit'])->name('free-quotes.edit');
Route::put('/free-quotes/{free_quote}', [FreeQuoteController::class, 'update'])->name('free-quotes.update');
Route::patch('/free-quotes/{free_quote}', [FreeQuoteController::class, 'update']); // optional
Route::delete('/free-quotes/{free_quote}', [FreeQuoteController::class, 'destroy'])->name('free-quotes.destroy');


Route::resource('careers', CareerController::class);

Route::get('/job-list', [CareerController::class, 'jobPost'])->name('job.list');
Route::get('/job-view/{id}', [CareerController::class, 'jobView'])->name('job.view');


Route::resource('contacts', ContactController::class);

Route::resource('report_galleries', ReportGalleryController::class);


Route::resource('page_generations', PageGenerationController::class);


Route::get('/additional/{slug}', [PageGenerationController::class, 'view'])->name('page.view');



// PayPal Routes
Route::get('pay-with-paypal/{doctorId}', [PaymentController::class, 'payWithPayPal'])->name('pay.with.paypal');
Route::get('payment/success', [PaymentController::class, 'successPayPal'])->name('payment.success');
Route::get('payment/cancel', [PaymentController::class, 'cancelPayPal'])->name('payment.cancel');

// SSLCommerz Routes
Route::get('pay-with-sslcommerz/{doctorId}', [PaymentController::class, 'payWithSSLCommerz'])->name('pay.with.sslcommerz');
Route::post('payment/success-sslcommerz', [PaymentController::class, 'successSSLCommerz'])->name('payment.success.sslcommerz');
Route::post('payment/fail-sslcommerz', [PaymentController::class, 'failSSLCommerz'])->name('payment.fail.sslcommerz');
Route::get('payment/cancel-sslcommerz', [PaymentController::class, 'cancelSSLCommerz'])->name('payment.cancel.sslcommerz');

Route::get('payment/fail', [PaymentController::class, 'failPayment'])->name('payment.fail');






