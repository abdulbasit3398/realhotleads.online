<?php



Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

//Static pages
Route::get('/calendar', function () {
    return view('user.calendar');
})->name('calendar');

Route::get('/file-manager',function () {
    return view('user.file_manager');
})->name('file-manager');

Route::get('/create-project',function () {
    return view('user.create_project');
})->name('create-project');

Route::get('/task-list',function () {
    return view('user.task_list');
})->name('task-list');

Route::get('/create-task',function () {
    return view('user.create_task');
})->name('create-task');

Route::get('/tables',function () {
    return view('user.tables');
})->name('tables');

Route::get('/chat',function () {
    return view('user.chat');
})->name('chat');

Auth::routes();
// Route::get('/register/{website}/{product}', 'Auth\RegisterController@register_product')->name('register_product');
Route::get('/register/{website}', 'Auth\RegisterController@register_product')->name('register_product');
Route::post('/register/create_free', 'Auth\RegisterController@create_free')->name('create_free');
Route::post('/register/create_product', 'Auth\RegisterController@create_product')->name('create_product');
Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::get('/contact-generator', 'UserController@contact_generator')->name('contact-generator');
Route::post('/search-contact', 'UserController@search_contact')->name('search-contact');
Route::get('/pricing', 'UserController@pricing')->name('pricing');
Route::post('/subscribe-package', 'UserController@subscribe_package')->name('subscribe-package');
Route::post('/contact-price-pay', 'UserController@contact_price_pay')->name('contact-price-pay');
Route::get('/under-construction', 'UserController@under_construction')->name('under-construction');
Route::get('/user-profile', 'UserController@user_profile')->name('user-profile');
Route::post('/edit-user-profile', 'UserController@edit_user_profile')->name('edit-user-profile');
Route::post('/save-additional-notes', 'UserController@save_additional_notes')->name('save-additional-notes');
Route::get('/user-contacts', 'UserController@user_contacts')->name('user-contacts');
Route::post('/save-user-contacts', 'UserController@save_user_contacts')->name('save-user-contacts');
Route::get('/edit-user-contact/{id}', 'UserController@edit_user_contact')->name('edit-user-contact');
Route::get('/show-user-contact/{id}', 'UserController@show_user_contact')->name('show-user-contact');
Route::post('/update-user-contact', 'UserController@update_user_contact')->name('update-user-contact');
Route::get('/delete-user-contacts/{id}', 'UserController@delete_user_contacts')->name('delete-user-contacts');
Route::get('/sales-funnels', 'UserController@sales_funnels')->name('sales-funnels');

Route::post('/save-time-track','UserController@save_time_track')->name('save-time-track');

Route::get('/test_sms', 'UserController@test_sms')->name('test_sms');

Route::get('/communication-sms', 'CommunicationController@communication_sms')->name('communication-sms');
Route::post('/send-communication-sms', 'CommunicationController@send_communication_sms')->name('send-communication-sms');
Route::post('/get-conversation-history', 'CommunicationController@get_conversation_history')->name('get-conversation-history');

Route::get('/communication-email', 'CommunicationController@communication_email')->name('communication-email');
Route::post('/send-communication-email', 'CommunicationController@send_communication_email')->name('send-communication-email');

Route::get('/communication-phone', 'CommunicationController@communication_phone')->name('communication-phone');
Route::post('/send-communication-phone', 'CommunicationController@send_communication_phone')->name('send-communication-phone');

Route::get('/test-api', 'UserController@test_api')->name('test-api');

Route::get('/my-wallet', 'UserWalletController@my_wallet')->name('my-wallet');
Route::post('/deposit-into-wallet', 'UserWalletController@deposit_into_wallet')->name('deposit-into-wallet');
Route::get('/send-payment', 'UserWalletController@send_payment')->name('send-payment');
Route::post('/proceed-payment', 'UserWalletController@proceed_payment')->name('proceed-payment');
Route::get('/request-payment', 'UserWalletController@request_payment')->name('request-payment');
Route::post('/proceed-request-payment', 'UserWalletController@proceed_request_payment')->name('proceed-request-payment');
Route::post('/withdraw-funds', 'UserWalletController@withdraw_funds')->name('withdraw-funds');

Route::group(['middleware' => 'admin.staff.access'],function(){
    Route::get('/staff/dashboard', 'StaffController@index')->name('staff.dashboard');
    Route::post('/save-contact-file', 'StaffController@save_contact_file')->name('staff.save-contact-file');
});

Route::group(['middleware' => 'admin.access'],function(){
    Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
});

