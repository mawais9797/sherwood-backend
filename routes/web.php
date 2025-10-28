<?php

use App\Http\Controllers\admin\Case_study;
use App\Http\Controllers\admin\Case_study_categories;
use App\Http\Controllers\admin\Contact;
use App\Http\Controllers\admin\ContentPages;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\Faqs;
use App\Http\Controllers\admin\Impact;
use App\Http\Controllers\admin\Index;
use App\Http\Controllers\admin\Locations;
use App\Http\Controllers\admin\Members;
use App\Http\Controllers\admin\Pages;
use App\Http\Controllers\admin\Projects;
use App\Http\Controllers\admin\Project_categories;
use App\Http\Controllers\admin\Services;
use App\Http\Controllers\admin\SherwoodController;
use App\Http\Controllers\admin\SherwoodGalleryController; //ajdkf
use App\Http\Controllers\admin\SherwoodTestimonials;      //ajdkf

use App\Http\Controllers\admin\Sitecontent;
use App\Http\Controllers\admin\Subscribers;
use App\Http\Controllers\admin\Team;
use App\Http\Controllers\admin\Testimonials;
use App\Http\Controllers\admin\Trusted_by;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Route;

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

/*==============================API POST  Routes =====================================*/
/*==============================Ajax Routes =====================================*/
// Route::post('newsletter', [Ajax::class,'newsletter']);
Route::get('get_states/{country_id}', [Ajax::class, 'get_states']);
Route::get('json_object', [Ajax::class, 'json_object']);
// Route::get('get_data', [Ajax::class,'get_data']);
Route::match(['GET', 'POST'], 'get_data', [Ajax::class, 'get_data']);
Route::post('post_data', [Ajax::class, 'post_data']);
Route::get('home_page', [ContentPages::class, 'home_page']);
// Route::match(['GET','POST'], '/get_data', [Ajax::class,'get_data']);
/*==============================Admin Routes =====================================*/
Route::controller(Index::class)->group(function () {
    Route::get('/admin/register', 'register');
    Route::post('/admin/register', 'store');
});
Route::get('/admin/login', [Index::class, 'admin_login'])->middleware('admin_logged_in');
Route::get('/admin/login', [Index::class, 'admin_login'])->middleware('admin_logged_in');
Route::post('/admin/login', [Index::class, 'login'])->middleware('admin_logged_in');
Route::get('/admin/logout', [Index::class, 'logout']);

Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/dashboard', [Dashboard::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/change-password', [Dashboard::class, 'change_password']);
    Route::get('/admin/site_settings', [Dashboard::class, 'settings']);
    Route::post('/admin/settings', [Dashboard::class, 'settings_update']);
    Route::get('/admin/sitecontent', [Sitecontent::class, 'index']);

    /*==============================Locations Module =====================================*/
    Route::get('/admin/locations', [Locations::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/locations/add', [Locations::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/locations/edit/{id}', [Locations::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/locations/delete/{id}', [Locations::class, 'delete']);

    /*==============================Projects =====================================*/
    Route::get('/admin/projects', [Projects::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/projects/add', [Projects::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/projects/edit/{id}', [Projects::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/projects/delete/{id}', [Projects::class, 'delete']);

    /*==============================Products Categories Module =====================================*/
    Route::get('/admin/project_categories', [Project_categories::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/project_categories/add', [Project_categories::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/project_categories/edit/{id}', [Project_categories::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/project_categories/delete/{id}', [Project_categories::class, 'delete']);

    /*==============================Services Module =====================================*/
    Route::get('/admin/services', [Services::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/services/add', [Services::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/services/edit/{id}', [Services::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/services/delete/{id}', [Services::class, 'delete']);

    /*==============================Sherwood Module ===================================*/
    // Route::get('/admin/sherwoodcontroller', [SherwoodController::class, 'index']);

    // Route::get('/admin/pages/sherwoodhome', [Pages::class, 'sherwood_home']);
    Route::match(['GET', 'POST'], '/admin/pages/sherwoodhome', [Pages::class, 'sherwood_home']);
    Route::get('/admin/sherwoodcontroller/events', [SherwoodController::class, 'eventsCRUD']);
    Route::match(['GET', 'POST'], '/admin/events/add', [SherwoodController::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/events/edit/{id}', [SherwoodController::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/events/delete/{id}', [SherwoodController::class, 'delete']);

    Route::get('/admin/sherwoodtestimonials', [SherwoodTestimonials::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/sherwoodtestimonials/add', [SherwoodTestimonials::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/sherwoodtestimonials/edit/{id}', [SherwoodTestimonials::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/sherwoodtestimonials/delete/{id}', [SherwoodTestimonials::class, 'delete']);

    Route::get('/admin/gallery', [SherwoodGalleryController::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/gallery/add', [SherwoodGalleryController::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/gallery/edit/{id}', [SherwoodGalleryController::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/gallery/delete/{id}', [SherwoodGalleryController::class, 'delete']);

    /*==============================Impact Module =====================================*/
    Route::get('/admin/impact', [Impact::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/impact/add', [Impact::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/impact/edit/{id}', [Impact::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/impact/delete/{id}', [Impact::class, 'delete']);

    /*==============================Case Study Categories Module =====================================*/
    Route::get('/admin/case_study_categories', [Case_study_categories::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/case_study_categories/add', [Case_study_categories::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/case_study_categories/edit/{id}', [Case_study_categories::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/case_study_categories/delete/{id}', [Case_study_categories::class, 'delete']);

    /*==============================Case Studies =====================================*/
    Route::get('/admin/case_study', [Case_study::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/case_study/add', [Case_study::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/case_study/edit/{id}', [Case_study::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/case_study/delete/{id}', [Case_study::class, 'delete']);

    /*==============================Trusted By Module =====================================*/
    Route::get('/admin/trusted_by', [Trusted_by::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/trusted_by/add', [Trusted_by::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/trusted_by/edit/{id}', [Trusted_by::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/trusted_by/delete/{id}', [Trusted_by::class, 'delete']);

    /*==============================Team Module =====================================*/
    Route::get('/admin/team', [Team::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/team/add', [Team::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/team/edit/{id}', [Team::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/team/delete/{id}', [Team::class, 'delete']);
    /*==============================Testimonials Module =====================================*/
    Route::get('/admin/testimonials', [Testimonials::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/testimonials/add', [Testimonials::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/testimonials/edit/{id}', [Testimonials::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/testimonials/delete/{id}', [Testimonials::class, 'delete']);

    /*==============================FAQs =====================================*/
    Route::get('/admin/faqs', [Faqs::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/faqs/add', [Faqs::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/faqs/edit/{id}', [Faqs::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/faqs/delete/{id}', [Faqs::class, 'delete']);

    /*==============================Website Textual Pages =====================================*/
    Route::match(['GET', 'POST'], '/admin/pages/home', [Pages::class, 'home']);

    // Route::match(['GET', 'POST'], '/admin/pages/sherwoodHome', [Pages::class, 'sherwoodHome']); //sherwoood

    Route::match(['GET', 'POST'], '/admin/pages/services', [Pages::class, 'services']);
    Route::match(['GET', 'POST'], '/admin/pages/services_detail', [Pages::class, 'serviceDetail']);
    Route::match(['GET', 'POST'], '/admin/pages/impact', [Pages::class, 'impact']);
    Route::match(['GET', 'POST'], '/admin/pages/caseStudy', [Pages::class, 'caseStudy']);
    Route::match(['GET', 'POST'], '/admin/pages/caseStudyDetail', [Pages::class, 'caseStudyDetail']);
    Route::match(['GET', 'POST'], '/admin/pages/projects', [Pages::class, 'projects']);
    Route::match(['GET', 'POST'], '/admin/pages/project_detail', [Pages::class, 'projectDetail']);
    Route::match(['GET', 'POST'], '/admin/pages/our_providers', [Pages::class, 'our_providers']);
    Route::match(['GET', 'POST'], '/admin/pages/contact', [Pages::class, 'contact']);
    Route::match(['GET', 'POST'], '/admin/pages/privacy_policy', [Pages::class, 'privacy_policy']);
    Route::match(['GET', 'POST'], '/admin/pages/terms', [Pages::class, 'terms']);
    Route::match(['GET', 'POST'], '/admin/pages/healthguide', [Pages::class, 'healthguide']);
    Route::match(['GET', 'POST'], '/admin/pages/request', [Pages::class, 'request']);

    Route::match(['GET', 'POST'], '/admin/pages/help', [Pages::class, 'help']);
    Route::match(['GET', 'POST'], '/admin/pages/blog', [Pages::class, 'blog']);
    Route::match(['GET', 'POST'], '/admin/pages/about', [Pages::class, 'about']);
    Route::match(['GET', 'POST'], '/admin/pages/real_time', [Pages::class, 'real_time']);
    Route::match(['GET', 'POST'], '/admin/pages/price_report', [Pages::class, 'price_report']);

    Route::match(['GET', 'POST'], '/admin/pages/signup', [Pages::class, 'signup']);
    Route::match(['GET', 'POST'], '/admin/pages/login', [Pages::class, 'login']);
    Route::match(['GET', 'POST'], '/admin/pages/forgot', [Pages::class, 'forgot']);
    Route::match(['GET', 'POST'], '/admin/pages/reset', [Pages::class, 'reset']);
    /*==============================Members =====================================*/
    Route::get('/admin/members', [Members::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/members/add', [Members::class, 'add']);
    Route::match(['GET', 'POST'], '/admin/members/edit/{id}', [Members::class, 'edit']);
    Route::match(['GET', 'POST'], '/admin/members/delete/{id}', [Members::class, 'delete']);

    /*==============================Contact =====================================*/
    Route::get('/admin/contact', [Contact::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/contact/view/{id}', [Contact::class, 'view']);
    Route::match(['GET', 'POST'], '/admin/contact/delete/{id}', [Contact::class, 'delete']);

    /*==============================Subscribers =====================================*/
    Route::get('/admin/subscribers', [Subscribers::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/subscribers/view/{id}', [Subscribers::class, 'view']);
    Route::match(['GET', 'POST'], '/admin/subscribers/delete/{id}', [Subscribers::class, 'delete']);

    /*=====================Property Branches Module =====================================*/
    Route::get('/admin/branches', [Branches::class, 'index']);
    Route::match(['GET', 'POST'], '/admin/branches/view/{id}', [Branches::class, 'view']);
    Route::match(['GET', 'POST'], '/admin/branches/delete/{id}', [Branches::class, 'delete']);
});
