<?php

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
    return view('home');
});

// Route::get('/about-us', function () {
//     return view('about-us');
// });

// Route::get('/sign-up', function () {
// 	return view('sign-up');
// });

// Route::get('/sign-up', function () {
// 	return view('sign-up');
// });

Route::match(['get', 'post'], 'sign-up', 'RegController@Signup')->name('sign-up')->middleware('web');
Route::match(['get'], 'verify', 'RegController@verify')->name('regverify');
Route::match(['get'], 'reset-password', 'RegController@reset_password')->name('reset.pwd.verify');
Route::match(['post'], 'reset-password', 'RegController@reset_org_password')->name('reset.pwd.verify');

Route::match(['get', 'post'], 'reverify-reg', 'RegController@ResendVerify')->name('reg.reverify')->middleware('web');
Route::match(['get', 'post'], 'reverify-pwd', 'RegController@ResendPwdResetLink')->name('pwd.reset.link')->middleware('web');
// Route::match(['get', 'post'], 'reverify-pwd', 'RegController@ResendP')->name('reg.reverfiy.pwd')->middleware('web');



// Route::get('/my-companyd', function () {
// 	return view('my-company');
// });

Route::get('testEmail', function () {
    // return view('emails.regverify');
    $data = [
        'key'     => 'value'
    ];
    $from = 'koushik@mobotics.in';
    $data = [
        'txt' => 'nasnasas nasnasans'
    ];
    $data = [
        'name' => 'a@email.com',
        'email' => 'email@email.com',
        'mobile' => '68668689',
        'message' => 'hahas
        asaasas asaaas',
    ];
    // \Email::send('mobotics.aniruddha@gmail.com', 'noreply@eeaa.com', 'Email Enquiry', 'emails.contact', $data);
    // \Email::send('mobotics.aniruddha@gmail.com', 'noreply@eeaa.com', 'Test Email', 'emails.regverify', $data);
    // Mail::send('emails.regverify', $data, function ($message) use ($from) {
    //     $message->from($from, 'My name');
    //     $message->subject('subject');
    //     $message->to('mobotics.aniruddha@gmail.com');
    // });

    // Mail::send('emails.regverify', $data, function($email) {
    //     $email->to('mobotics.aniruddha@gmail.com');
    //     $email->from('noreply@email.com');
    //     $email->subject('Test Subject');
    // });

    // Mail::raw('Test', function($email) {
    //     $email->to('mobotics.aniruddha@gmail.com');
    //     $email->from('noreply@email.com');
    //     $email->subject('Test Subject');
    // });



    // dd(Mail::failures());
});



Route::get('/thank-you', function () {
    return view('thank-you');
});

Route::get('/hash-pwd', function () {
    dd(Hash::make('password'));
});


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Route::get('/sign-in', function () {
    return redirect('sign-in');
});

Route::match(['get', 'post'], 'login', 'LoginController')->name('login')->middleware('web');
Route::match(['get'], 'sign-in', 'LoginController')->name('sign-in')->middleware('web');


Route::post('setlang', 'LangController@setlang')->name('lang.setlang');

Route::get('createcaptcha', 'CaptchaController@create');
// Route::post('captcha', 'CaptchaController@captchaValidate');
Route::get('refreshcaptcha', 'CaptchaController@refreshCaptcha');
Route::get('gencaptcha', 'CaptchaController@genCaptcha');

/**
 * Admin Login Section
 */
Route::match(['get'], 'admin/login', 'AdminController')->name('admin.login')->middleware('web');
Route::match(['get', 'post'], 'admin', 'AdminController')->name('admin.login')->middleware('web');

/**
 * Employee Login Section
 */
Route::match(['get'], 'employee/login', 'EmployeeLoginController')->name('employee.login')->middleware('web');
Route::match(['get'], 'users/login', 'EmployeeLoginController')->name('employee.login')->middleware('web');
Route::match(['get', 'post'], 'employee', 'EmployeeLoginController')->name('employee.login')->middleware('web');

/**
 * Page Controller
 */
Route::get('/contact-us', 'PageController@contact_us')->name('page.contact_us');
Route::post('/contact-us', 'PageController@contact_us')->name('page.contact_us');

Route::post('/news_subscribed', 'PageController@news_subscribed')->name('page.news_subscribed');




Route::middleware(['auth:web,org,admin,employee'])->group(function () {
    /**
     * Review Form Controller
     */

    Route::get('/review/{formno}', 'ReviewFormController@review')->name('form.review')->middleware('web');

    Route::get('/my-company', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    // Route::get('/employees', function () {
    // 	return view('employees');
    // });

    Route::post('logout', function () {
        Auth::logout();
        return redirect(route('sign-in'));
    })->name('logout');

    // Route::post('employees/change_status','EmployeeController@change_status')->name('employees.change_status');
    Route::post('users/change_status', 'UserController@change_status')->name('users.change_status');
    Route::post('users/reset_pwd', 'UserController@reset_pwd')->name('users.reset_pwd');

    Route::post('organizations/change_status', 'OrganizationController@change_status')->name('organizations.change_status');

    Route::get('organizations/status_logs/{id}', 'OrganizationController@status_logs')->name('organizations.status_logs');

    Route::post('groups/change_status', 'Admin\GroupController@change_status')->name('groups.change_status');
    Route::get('groups/edit_prev/{group_id}', 'Admin\GroupController@edit_prev')->name('groups.edit_prev');
    Route::post('groups/update_prev', 'Admin\GroupController@update_prev')->name('groups.update_prev');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::put('/', 'ProfileController@updatePersonal');
        Route::patch('/', 'ProfileController@updatePassword');
    });

    Route::get('application/no/{application_no}', 'ApplicationController@appByNo')->name('application.appByNo');
    Route::post('application/add_application', 'ApplicationController@add_application')->name('application.add');
    Route::post('application/tab1_t1', 'ApplicationController@tab1_t1')->name('application.tab1_t1');
    Route::post('application/tab1_t2', 'ApplicationController@tab1_t2')->name('application.tab1_t2');
    Route::post('application/tab1_t3', 'ApplicationController@tab1_t3')->name('application.tab1_t3');
    Route::post('application/tab1_t4', 'ApplicationController@tab1_t4')->name('application.tab1_t4');
    Route::post('application/tab1_t5', 'ApplicationController@tab1_t5')->name('application.tab1_t5');
    Route::post('application/tab1_t6', 'ApplicationController@tab1_t6')->name('application.tab1_t6');
    Route::post('application/tab1_t7', 'ApplicationController@tab1_t7')->name('application.tab1_t7');
    Route::post('application/tab1_t8', 'ApplicationController@tab1_t8')->name('application.tab1_t8');
    Route::post('application/tab1_t9', 'ApplicationController@tab1_t9')->name('application.tab1_t9');
    Route::post('application/tab1_t10', 'ApplicationController@tab1_t10')->name('application.tab1_t10');
    Route::post('application/tab1_t11', 'ApplicationController@tab1_t11')->name('application.tab1_t11');

    Route::match(['get', 'post'], 'form1RegFees/{application_no}', 'ApplicationController@form1RegFees')->name('application.form1RegFees');


    Route::POST('appliction/t1_json_data', 'ApplicationController@t1_json_data')->name('application.t1_json_data');
    Route::post('application/confirm_tab1', 'ApplicationController@confirm_tab1')->name('application.confirm_tab1');

    Route::post('application/confirm_tab', 'ApplicationController@confirm_tab')->name('application.confirm_tab');


    // Registration Type 2
    Route::post('application/tab2_t1', 'ApplicationController@tab2_t1')->name('application.tab2_t1');
    Route::post('application/tab2_t2', 'ApplicationController@tab2_t2')->name('application.tab2_t2');
    Route::post('application/tab2_t3', 'ApplicationController@tab2_t3')->name('application.tab2_t3');
    Route::post('application/tab2_t4', 'ApplicationController@tab2_t4')->name('application.tab2_t4');
    Route::post('application/tab2_t5', 'ApplicationController@tab2_t5')->name('application.tab2_t5');
    Route::post('application/confirm_tab2', 'ApplicationController@confirm_tab2')->name('application.confirm_tab2');
    Route::match(['get', 'post'], 'formRegFees/{application_no}', 'ApplicationController@formRegFees')->name('application.formRegFees');

    // Registration Type 3
    Route::post('application/tab3_t1', 'ApplicationController@tab3_t1')->name('application.tab3_t1');
    Route::post('application/tab3_t2', 'ApplicationController@tab3_t2')->name('application.tab3_t2');
    Route::post('application/tab3_t3', 'ApplicationController@tab3_t3')->name('application.tab3_t3');
    Route::post('application/tab3_t4', 'ApplicationController@tab3_t4')->name('application.tab3_t4');
    Route::post('application/tab3_t5', 'ApplicationController@tab3_t5')->name('application.tab3_t5');
    Route::post('application/confirm_tab3', 'ApplicationController@confirm_tab3')->name('application.confirm_tab3');

    // Registration Type 4
    Route::post('application/tab4_t1', 'ApplicationController@tab4_t1')->name('application.tab4_t1');
    Route::post('application/tab4_t2', 'ApplicationController@tab4_t2')->name('application.tab4_t2');
    Route::post('application/tab4_t3', 'ApplicationController@tab4_t3')->name('application.tab4_t3');
    Route::post('application/tab4_t4', 'ApplicationController@tab4_t4')->name('application.tab4_t4');
    Route::post('application/tab4_t5', 'ApplicationController@tab4_t5')->name('application.tab4_t5');
    Route::post('application/confirm_tab4', 'ApplicationController@confirm_tab4')->name('application.confirm_tab4');

    // Registration Type 5
    Route::post('application/tab5_t1', 'ApplicationController@tab5_t1')->name('application.tab5_t1');
    Route::post('application/tab5_t2', 'ApplicationController@tab5_t2')->name('application.tab5_t2');
    Route::post('application/tab5_t3', 'ApplicationController@tab5_t3')->name('application.tab5_t3');
    Route::post('application/tab5_t4', 'ApplicationController@tab5_t4')->name('application.tab5_t4');
    Route::post('application/tab5_t5', 'ApplicationController@tab5_t5')->name('application.tab5_t5');
    Route::post('application/confirm_tab5', 'ApplicationController@confirm_tab5')->name('application.confirm_tab5');

    // Registration Type 6
    Route::post('application/tab6_t1', 'ApplicationController@tab6_t1')->name('application.tab6_t1');
    Route::post('application/tab6_t2', 'ApplicationController@tab6_t2')->name('application.tab6_t2');
    Route::post('application/tab6_t3', 'ApplicationController@tab6_t3')->name('application.tab6_t3');
    Route::post('application/tab6_t4', 'ApplicationController@tab6_t4')->name('application.tab6_t4');
    Route::post('application/tab6_t5', 'ApplicationController@tab6_t5')->name('application.tab6_t5');
    Route::post('application/confirm_tab6', 'ApplicationController@confirm_tab6')->name('application.confirm_tab6');

    Route::resources([
    	 'Vehicles'				=> 'VehiclesController',
    	 'Ticket'				=>	'TicketPriceController',
        'employees'             => 'EmployeeController',
        'modules'               => 'ModuleController',
        'application'           => 'ApplicationController',
        'activities'            => 'ActivityController',
        'sites'                 => 'SiteController',
        'protected-areas'       => 'ProtectedAreaController',
        'pages'                 => 'SeoController',
        'entities'              => 'EntityController',
        'vessels'               => 'VesselController',
        'newsevents'            => 'NewsEventsController',
        'organizations'         => 'OrganizationController',
        'e-tickets'             => 'EticketController',
        'users'                 => 'UserController',
    ]);

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::resources([
            'groups'    => 'GroupController',
        ]);
    });

    Route::get('registration-requests/{application_no}', 'Employee\ApplicationListController@appByNo')->name('registration.requests.appbyno');
    Route::get('registration-requests', 'Employee\ApplicationListController@index')->name('registration.requests');

    Route::post('activities/change_status', 'ActivityController@change_status')->name('activities.change_status');
    Route::post('newsevents/change_status', 'NewsEventsController@change_status')->name('newsevents.change_status');
    Route::post('vessels/change_status', 'VesselController@change_status')->name('vessels.change_status');

    Route::post('sites/change_status', 'SiteController@change_status')->name('sites.change_status');
    Route::post('sites/manage_photos', 'SiteController@manage_photos')->name('sites.manage_photos');
    Route::post('sites/delete_photo', 'SiteController@delete_photo')->name('sites.delete_photo');
    Route::post('sites/upload_photos', 'SiteController@upload_photos')->name('sites.upload_photos');

    Route::post('protected-areas/change_status', 'ProtectedAreaController@change_status')->name('protected-areas.change_status');
    Route::post('protected-areas/manage_photos', 'ProtectedAreaController@manage_photos')->name('protected-areas.manage_photos');
    Route::post('protected-areas/delete_photo', 'ProtectedAreaController@delete_photo')->name('protected-areas.delete_photo');
    Route::post('protected-areas/upload_photos', 'ProtectedAreaController@upload_photos')->name('protected-areas.upload_photos');
    Route::post('protected-areas/manage_docs', 'ProtectedAreaController@manage_docs')->name('protected-areas.manage_docs');
    Route::post('protected-areas/delete_doc', 'ProtectedAreaController@delete_doc')->name('protected-areas.delete_doc');
    Route::post('protected-areas/upload_docs', 'ProtectedAreaController@upload_docs')->name('protected-areas.upload_docs');


    Route::get('employee/applicationlist/{application_no}', 'Employee\ApplicationListController@appByNo')->name('applicationlist.appByNo');
    Route::post('employee/change_status', 'Employee\ApplicationListController@change_status')->name('applicationlist.change_status');


    Route::group(['namespace' => 'Employee', 'prefix' => 'employee'], function () {
        Route::resources([
            'applicationlist'     => 'ApplicationListController',
        ]);
    });
    Route::post('application/remove_doc', 'ApplicationController@remove_doc')->name('application.remove_doc');

    Route::post('sites/upload_slots', 'SiteController@upload_slots')->name('sites.upload_slots');
    Route::post('sites/manage_slots', 'SiteController@manage_slots')->name('sites.manage_slots');
    Route::post('sites/edit_slot', 'SiteController@edit_slot')->name('sites.edit_slot');
    Route::post('sites/del_slot', 'SiteController@del_slot')->name('sites.del_slot');
    Route::post('sites/edit_slot_save', 'SiteController@edit_slot_save')->name('sites.edit_slot_save');

    Route::get('booking', 'BookingController@index')->name('booking.index');
    Route::get('booking-seatlist/{id}/{type}', 'BookingController@seatlist')->name('booking.seatlist');
    Route::get('slot-book/{siteid}/{slotid}/{date}/{visit_type}', 'BookingController@slot_book')->name('slot.book');
    Route::post('booking/json-seatlist', 'BookingController@json_seatlist')->name('booking.json_seatlist');
    Route::post('booking/book-ticket', 'BookingController@book_ticket')->name('booking.book_ticket');
    Route::get('booking/view-ticket/{id}', 'BookingController@view_ticket')->name('booking.view_ticket');
    Route::get('booking/view-ticket-summary/{id}', 'BookingController@view_ticket_summary')->name('booking.view_ticket_summary');
    Route::get('booking/all-ticket/', 'BookingController@all_tickets')->name('booking.tickets');
    Route::post('booking/ticket/{id}', 'BookingController@ticket_by_id')->name('booking.ticket_by_id');

    /**
     * Messages
     */

    Route::get('messages/', 'MessageController@index')->name('messages');
    Route::put('messages/change_status/{message}', 'MessageController@change_status')->name('messages.change_status');

    /**
     * News Letter
     */
    Route::get('newsletter/', 'NewsLetterController@index')->name('newsletter');


});

Route::get('news-events/{id}', 'PageController@singleNews')->name('single.news-event');
Route::get('{slug?}', 'PageController@page');



// Route::get('/about-us', function () {
//     return view('about-us');
// });

// Route::middleware(['auth:employee'])->group(function () {
// 	Route::get('/my-company', 'HomeController@index')->name('home');
// 	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
// });
