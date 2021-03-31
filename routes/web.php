<?php

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

Route::view('/', 'website/newhome');
 Route::get('/home', 'WebsiteController@index');
Route::get('/privacy', 'WebsiteController@privacy');

Route::get('/about-us', 'WebsiteController@about_us');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('email_verify', 'Api\RegisterController@verify_email');
Route::get('setlocale/{locale}', function ($locale) {
    //  print_r(\Config::get('app.locales'));
    //  die();
    if (in_array($locale, \Config::get('app.locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login', 'LoginController@index')->name('admin.login');
    Route::post('login', 'LoginController@login');
    //   Route::group(['middleware' => ['web','auth:admin']], function ()
    // {
    Route::group(['middleware' => ['web','auth:admin']], function () {
    Route::group(['middleware' => 'web'], function () {
        
        Route::get('admin_dashboard', 'HomeController@index')->name('admin.admin_dashboard');
        Route::post('logout', 'LoginController@logout')->name('admin_logout');
        //for ServiceProvider
        Route::get('service-provider/list', 'ServiceProviderController@service_provider_list')->name('service_provider.list');
        Route::get('service-provider/delete/{id}', 'ServiceProviderController@user_delete');
        Route::get('service-provider/view/{id}', 'ServiceProviderController@view_edit');
        Route::get('service-provider-profile/{id}', 'ServiceProviderController@service_provider_view');
        Route::get('service-provider/status/{id}', 'ServiceProviderController@user_change_status');
        Route::get('yacht-details/{id}', 'ServiceProviderController@yacht_details');
        Route::post('EnglishLanguage', 'HomeController@Englishlanguage')->name('EnglishLanguage');
        Route::post('ArabicLanguage', 'HomeController@ArabicLanguage')->name('ArabicLanguage');
        Route::get('user/status/{id}', 'UserController@user_change_status');
        Route::get('trems', 'SettingController@trems');
        Route::post('trems', 'SettingController@updateTrems');
        Route::get('privacy-policy', 'SettingController@PrivacyPolicy');
        Route::post('PrivacyPolicy', 'SettingController@updatePrivacyPolicy');
        
        //FOR Country
        Route::get('country-list', 'CountryController@index');
        Route::get('add-country', 'CountryController@createView');
        Route::post('add-country', 'CountryController@create');
        Route::get('edit-country/{id}', 'CountryController@editView');
        Route::post('edit-country', 'CountryController@_edit');
        Route::get('delete_country/{id}', 'CountryController@_delete');
        // Route::get('country-detail/{id}', 'CountryController@_detail');
        //FOR YachtCategory
        Route::get('yacht-category-list', 'YachtCategoryController@index');
        Route::get('add-yacht-category', 'YachtCategoryController@createView');
        Route::post('add-yacht-category', 'YachtCategoryController@create');
        Route::get('edit-yacht-category/{id}', 'YachtCategoryController@editView');
        Route::post('edit-yacht-category', 'YachtCategoryController@_edit');
        Route::get('delete-yacht-category/{id}', 'YachtCategoryController@_delete');
        Route::get('notification', 'NotificationController@index');
        Route::post('notification', 'NotificationController@sendNotification');
        //FOR MASTER CATEGORY
        Route::get('category-list'  ,'MasterCategoryController@index');
        Route::get('edit-category/{id}', 'MasterCategoryController@editView');
        Route::post('edit-category', 'MasterCategoryController@_edit');
        Route::get('category-list/{id}'  ,'MasterCategoryController@getSubcategory');
        
        //FOR ABOUT US
        Route::get('about-us'                       ,'SettingController@aboutUs');
        Route::post('AboutUS'                       ,'SettingController@updateAboutUs');
        //FOR USER MANAGEMENT
        Route::get('user/list'                      ,'UserController@user_list')->name('user.list');
        Route::get('user/delete/{id}'               ,'UserController@user_delete');
        Route::get('user/view/{id}'                 ,'UserController@view_edit');
        Route::get('user-profile/{id}'              ,'UserController@user_view');
        Route::get('user/status/{id}'               ,'UserController@user_change_status');
        //FOR CONTACT US
        Route::get('contact-us'                     , 'SettingController@Contactus');
        Route::get('view-contact-us/{id}'           , 'SettingController@viewContactUs');
        Route::get('contact/delete/{id}'            , 'SettingController@delete_contactus');



    });
});
});
