<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Ajax;
use App\Http\Controllers\Account;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentPages;
use App\Http\Controllers\Listing;
use App\Http\Controllers\Chat;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
/*==============================API POST Routes =====================================*/



Route::post('/get_data', [App\Http\Controllers\Ajax::class, 'get_data']);
Route::post('/save-newsletter', [App\Http\Controllers\Ajax::class, 'newsletter']);
Route::post('/save-contact-message', [App\Http\Controllers\Ajax::class, 'contact_us']);
Route::post('/save-image', [App\Http\Controllers\Ajax::class, 'save_image']);
Route::post('/upload-image', [App\Http\Controllers\Ajax::class, 'upload_image']);
Route::post('/upload-file', [App\Http\Controllers\Ajax::class, 'upload_file']);
Route::get('/get-states/{country_id}', [App\Http\Controllers\Ajax::class, 'get_states']);


/*============================== Sherwood Routes =====================================*/
Route::get('/test-data', [TestController::class, 'index']);

// Route::get('/home',[Pages::class, 'sherwood_home_page']);
Route::post('/home',[ContentPages::class, 'sherwood_home_page']);

/*==============================API GET Routes =====================================*/
Route::match(['GET', 'POST'], '/site-settings', [ContentPages::class, 'website_settings']);
Route::match(['GET', 'POST'], '/header-services', [ContentPages::class, 'header_services']);

Route::match(['GET', 'POST'], '/member-settings', [ContentPages::class, 'member_settings']);
Route::match(['GET', 'POST'], '/home-page', [ContentPages::class, 'home_page']);
Route::match(['GET', 'POST'], '/service-page', [ContentPages::class, 'service_page']);
Route::match(['GET', 'POST'], '/serviceDetail-page/{slug}', [ContentPages::class, 'serviceDetail_page']);
Route::match(['GET', 'POST'], '/project-page', [ContentPages::class, 'project_page']);
Route::match(['GET', 'POST'], '/projectDetail-page/{slug}', [ContentPages::class, 'projectDetail_page']);
Route::match(['GET', 'POST'], '/impact-page', [ContentPages::class, 'impact_page']);
Route::match(['GET', 'POST'], '/caseStudy-page', [ContentPages::class, 'caseStudy_page']);
Route::match(['GET', 'POST'], '/caseStudyDetail-page/{slug}', [ContentPages::class, 'caseStudyDetail_page']);

Route::match(['GET', 'POST'], '/about-page', [ContentPages::class, 'about_page']);

Route::match(['GET', 'POST'], '/contact-page', [ContentPages::class, 'contact_page']);
Route::match(['GET', 'POST'], '/privacy-policy-page', [ContentPages::class, 'privacy_policy_page']);
Route::match(['GET', 'POST'], '/terms-conditions-page', [ContentPages::class, 'terms_conditions_page']);
Route::match(['GET', 'POST'], '/signup-page', [ContentPages::class, 'signup_page']);
Route::match(['GET', 'POST'], '/login-page', [ContentPages::class, 'login_page']);
Route::match(['GET', 'POST'], '/forget-password-page', [ContentPages::class, 'forgot_page']);
Route::match(['GET', 'POST'], '/reset-password-page', [ContentPages::class, 'reset_page']);


/*==============================Member Routes =====================================*/
Route::post('/create-account', [App\Http\Controllers\Ajax::class, 'signup']);
Route::post('/save-login', [App\Http\Controllers\Ajax::class, 'login']);
Route::post('/forgot-password', [App\Http\Controllers\Ajax::class, 'forget_password']);
Route::post('/reset-password/{token}', [App\Http\Controllers\Ajax::class, 'reset_password']);
Route::post('/verify-otp', [App\Http\Controllers\Ajax::class, 'verify_otp']);
Route::post('/resend-email', [App\Http\Controllers\Account::class, 'resend_email']);
Route::get('signup-page', [ContentPages::class, 'signup_page']);
Route::get('signin-page', [ContentPages::class, 'signin_page']);
Route::get('forgot-page', [ContentPages::class, 'forgot_page']);
Route::get('reset-page/{token}', [ContentPages::class, 'reset_page']);
Route::post('/update-profile', [App\Http\Controllers\Account::class, 'update_profile']);
Route::post('/update-password', [App\Http\Controllers\Account::class, 'update_password']);
Route::post('/deactivate-account', [App\Http\Controllers\Account::class, 'deactivate_account']);


Route::match(['GET', 'POST'], '/notifications', [Account::class, 'notifications']);
Route::post('/delete-notification/{id}', [App\Http\Controllers\Account::class, 'delete_notification']);
/*==============================Listing Routes =====================================*/
Route::post('/edit-listing/{id}', [App\Http\Controllers\Listing::class, 'edit_listing']);
Route::post('/single-listing/{id}', [App\Http\Controllers\Listing::class, 'single_listing']);
Route::post('/delete-listing/{id}', [App\Http\Controllers\Listing::class, 'delete_listing']);
Route::post('/add-listing', [App\Http\Controllers\Listing::class, 'add_listing']);
Route::post('/listings', [App\Http\Controllers\Listing::class, 'listings']);
Route::post('/check-rental-item-availability', [App\Http\Controllers\Listing::class, 'checkRentalItemAvailability']);

/*==============================Explore Search Routes =====================================*/
Route::match(['GET', 'POST'], '/explore-search', [Listing::class, 'explore_search']);
Route::post('/explore-single-listing-details/{slug}', [App\Http\Controllers\Listing::class, 'explore_listing_details_page']);
Route::post('/send-msg-owner', [App\Http\Controllers\Listing::class, 'send_msg_owner']);

/*==============================Chat Routes =====================================*/
Route::match(['GET', 'POST'], '/inbox-conversations', [Chat::class, 'get_conversations']);
Route::match(['GET', 'POST'], '/confirm-buyer-request', [Chat::class, 'confirm_buyer_request']);
Route::post('/inbox-conversations/{conversation_id}', [App\Http\Controllers\Chat::class, 'get_conversations']);
Route::post('/get-rental-request/{id}', [App\Http\Controllers\Chat::class, 'get_rental_request']);

/*==============================Payment Routes =====================================*/
Route::match(['GET', 'POST'], '/create-payment-intent', [Chat::class, 'create_payment_intent']);
Route::match(['GET', 'POST'], '/create-extension-payment-intent', [Chat::class, 'create_extension_payment_intent']);
