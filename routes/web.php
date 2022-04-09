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

//use Illuminate\Support\Facades\Storage;

//use Google\Service\Storage;

use Illuminate\Support\Facades\Storage;

Route::group(['namespace' => 'Google'], function() {

    Route::post('/upload-to-root', 'GoogleDriveController@store')->name('upload-to-root');
    Route::get('/file-url', 'GoogleDriveController@fileURL')->name('file-url');
    Route::post('/create-directoy', 'GoogleDriveController@createDirectory')->name('create-directory');
    Route::delete('/remove-directoy', 'GoogleDriveController@removeDirectory')->name('remove-directory');
    Route::delete('/remove-file', 'GoogleDriveController@removeFile')->name('remove-file');
    Route::post('/put-in-directory', 'GoogleDriveController@putInDirectory')->name('put-in-dir');

});

//Chat Messages + Group Messages
Route::post('/create-group', 'CrmChatController@createGroup')->name('create-group');
Route::get('/get-group-messages', 'CrmChatController@getGroupMessages')->name('get-group-messages');
Route::post('/send-group-chat', 'CrmChatController@sendGroupChat')->name('send-group-chat');
Route::post('/update-group', 'CrmChatController@updateGroup')->name('update-group');
Route::delete('/remove-group', 'CrmChatController@removeGroup')->name('remove-group');
Route::get('/chat', 'CrmChatController@index')->name('chat');
Route::get('/get-messages', 'CrmChatController@getMessages')->name('get-messages');
Route::post('/send-chat', 'CrmChatController@send_chat')->name('send_chat');

Route::get('/search-message', 'CrmChatController@searchMessage')->name('search-message');
Route::get('/search-group_message', 'CrmChatController@searchGroupMessage')->name('search-group-message');

//GIGI
Route::group(['namespace' => 'Gigi'], function() {
    Route::get('/gigy', 'GigiController@index')->name('gigi-index');
    Route::get('/image/{name}', 'GigiController@image')->name('image-index');
    Route::get('/create-gigy', 'GigiController@create')->name('create-gigy');
    Route::post('/save-gigy', 'GigiController@save')->name('save-gigy');
});


Route::get('/test', 'HomeController@test')->name('test');
Route::post('/test-post', 'HomeController@test_post')->name('test-post');


// Route::get('/', function () {
//     return redirect()->route('sales-funnels');
// });

Route::get('/', 'SalesFunnelController@sales_funnels')->name('sales-funnels');
Route::get('/my-pages', 'SalesFunnelController@my_pages')->name('my-pages');

Route::get('/home', function () {
    return redirect()->route('sales-funnels');
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

Route::get('/checkout', 'UserController@checkout')->name('checkout');


Auth::routes();
Route::get('/contacts', 'UserController@contacts')->name('contacts');
Route::post('/import-contacts', 'UserController@import_contacts')->name('import-contacts');

// Route::get('/register/{website}/{product}', 'Auth\RegisterController@register_product')->name('register_product');
Route::get('/register/{website}', 'Auth\RegisterController@register_product')->name('register_product');
Route::post('/guest_register', 'Auth\RegisterController@guest_register')->name('guest_register');
Route::post('/register/create_free', 'Auth\RegisterController@create_free')->name('create_free');
Route::post('/register/create_product', 'Auth\RegisterController@create_product')->name('create_product');
Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::post('/d-calender', 'UserController@calender')->name('d-calender');
Route::post('/save-table', 'UserController@saveData')->name('saveData');

Route::get('/auto-responder', 'UserController@auto_responder')->name('auto-responder');
Route::get('/ivr-rvm', 'UserController@ivr_rvm')->name('ivr-rvm');
Route::get('/sales-outsourcing', 'UserController@sales_outsourcing')->name('sales-outsourcing');
Route::get('/email-marketing', 'UserController@email_marketing')->name('email-marketing');

Route::post('/save-job-management', 'UserController@save_job_management')->name('save-job-management');

Route::get('/contact-generator', 'UserController@contact_generator')->name('contact-generator');
Route::get('/list-cleaner', 'UserController@list_cleaner')->name('list-cleaner');
Route::post('/check-list-cleaner', 'UserController@check_list_cleaner')->name('check-list-cleaner');
Route::post('/bulk-import-list-clean', 'UserController@bulk_import_list_clean')->name('bulk-import-list-clean');
Route::post('/search-contact', 'UserController@search_contact')->name('search-contact');
Route::get('/pricing', 'SalesFunnelController@pricing')->name('pricing');
// Route::get('/pricing', 'UserController@pricing')->name('pricing');
Route::resource('/cart', 'CartController');
Route::resource('packages', 'Package\PackageController');
Route::post('/qty-update', 'CartController@qtyUpdate');
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

Route::get('/custom-sales-funnels', 'SalesFunnelController@custom_sales_funnels')->name('custom-sales-funnels');
Route::post('/custom-sales-funnels', 'SalesFunnelController@custom_sales_funnels_store')->name('custom-sales-funnels.store');
Route::post('/funnel-files', 'SalesFunnelController@files')->name('funnel-files.upload');
Route::post('/create-referal-user', 'UserController@create_referal_user')->name('create-referal-user');

Route::post('/save-time-track','UserController@save_time_track')->name('save-time-track');

Route::get('/test_sms', 'CommunicationController@test_sms')->name('test_sms');

Route::get('/signal', 'CommunicationController@test_sms_signal')->name('test-sms-signal-');
Route::get('/signal2', 'CommunicationController@message458')->name('test-12');
Route::get('/communication-sms', 'CommunicationController@communication_sms')->name('communication-sms');
Route::get('/new-send-communication-sms', 'CommunicationController@new_send_communication_sms')->name('new-send-communication-sms');
Route::post('/send-communication-sms', 'CommunicationController@send_communication_sms')->name('send-communication-sms');
Route::post('/get-conversation-history', 'CommunicationController@get_conversation_history')->name('get-conversation-history');
Route::post('/get-communication-reply', 'CommunicationController@get_communication_reply')->name('get-communication-reply');

Route::post('/bulk-sms-email-request', 'CommunicationController@bulk_sms_email_request')->name('bulk-sms-email-request');

Route::get('/communication-email', 'CommunicationController@communication_email')->name('communication-email');
Route::post('/send-communication-email', 'CommunicationController@send_communication_email')->name('send-communication-email');

Route::get('/communication-phone', 'CommunicationController@communication_phone')->name('communication-phone');
Route::post('/send-communication-phone', 'CommunicationController@send_communication_phone')->name('send-communication-phone');
Route::post('/hangup-communication-phone', 'CommunicationController@hangup_communication_phone')->name('hangup-communication-phone');
// Route::post('/get-phone-status-callback', 'CommunicationController@get_phone_status_callback')->name('get-phone-status-callback');

Route::get('/test-api', 'UserController@test_api')->name('test-api');

Route::get('/my-wallet', 'UserWalletController@my_wallet')->name('my-wallet');
Route::post('/deposit-into-wallet', 'UserWalletController@deposit_into_wallet')->name('deposit-into-wallet');
Route::post('/add_credit_paypal', 'UserWalletController@add_credit_paypal')->name('add_credit_paypal');

Route::get('/send-payment', 'UserWalletController@send_payment')->name('send-payment');
Route::post('/proceed-payment', 'UserWalletController@proceed_payment')->name('proceed-payment');
Route::get('/request-payment', 'UserWalletController@request_payment')->name('request-payment');
Route::post('/proceed-request-payment', 'UserWalletController@proceed_request_payment')->name('proceed-request-payment');
Route::post('/withdraw-funds', 'UserWalletController@withdraw_funds')->name('withdraw-funds');

Route::group(['middleware' => 'admin.staff.access'],function(){
    Route::get('/staff/dashboard', 'StaffController@index')->name('staff.dashboard');
    Route::get('/staff/custom-funnels', 'StaffController@funnels')->name('staff.custom-funnels');
    Route::post('/save-contact-file', 'StaffController@save_contact_file')->name('staff.save-contact-file');
    Route::get('/sms-email-request', 'StaffController@sms_email_request')->name('staff.sms-email-request');
    Route::get('/send-bulk-sms-form', 'StaffController@send_bulk_sms_form')->name('staff.send-bulk-sms-form');
    Route::post('/send-bulk-sms', 'StaffController@send_bulk_sms')->name('staff.send-bulk-sms');
});

Route::group(['middleware' => 'admin.access'],function(){
    Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/admin/user-withdrawal-request', 'Admin\DashboardController@user_withdrawal_request')->name('admin.user-withdrawal-request');
    Route::get('/admin/show-withdrawal-request/{id}', 'Admin\DashboardController@show_withdrawal_request')->name('admin.show-withdrawal-request');
    Route::get('/admin/complete-withdrawal-request/{id}', 'Admin\DashboardController@complete_withdrawal_request')->name('admin.complete-withdrawal-request');
    Route::post('/admin/send-withdrawal-notification', 'Admin\DashboardController@send_withdrawal_notification')->name('admin.send-withdrawal-notification');
});



Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PayPalController@payWithpaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'PayPalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'PayPalController@getPaymentStatus',));


// Route::get('/message2', 'SignalWireController@message458');
Route::get('/messageSend12', 'SignalWireController@sendMessage');


// Route::get('/{order?}', [
//     'name' => 'PayPal Express Checkout',
//     'as' => 'app.home',
//     'uses' => 'PayPalController@form',
// ]);

// Route::post('/checkout/payment/{order}/paypal', [
//     'name' => 'PayPal Express Checkout',
//     'as' => 'checkout.payment.paypal',
//     'uses' => 'PayPalController@checkout',
// ]);

// Route::get('/paypal/checkout/{order}/completed', [
//     'name' => 'PayPal Express Checkout',
//     'as' => 'paypal.checkout.completed',
//     'uses' => 'PayPalController@completed',
// ]);

// Route::get('/paypal/checkout/{order}/cancelled', [
//     'name' => 'PayPal Express Checkout',
//     'as' => 'paypal.checkout.cancelled',
//     'uses' => 'PayPalController@cancelled',
// ]);

// Route::post('/webhook/paypal/{order?}/{env?}', [
//     'name' => 'PayPal Express IPN',
//     'as' => 'webhook.paypal.ipn',
//     'uses' => 'PayPalController@webhook',
// ]);
