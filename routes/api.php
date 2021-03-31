<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->get('user', 'SomeController@user');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
/*
|--------------------------------------------------------------------------
| API LOGIN / REGISTRATION
|--------------------------------------------------------------------------
 */
Route::group(['namespace' => 'Api'], function () {

    Route::get('categoryList', 'RegisterController@yachtCategoryList');

    Route::post('registration'            , 'RegisterController@registration');
    Route::post('login'                   , 'LoginController@login');
    Route::post('checkUser'               , 'LoginController@checkUser');
    Route::post('verifyOtp'               , 'LoginController@verifyOtp');
    Route::post('resetPassword'           , 'LoginController@resetPassword');
    Route::post('appSetting'               , 'SettingController@update');
    Route::post('getAllCategory'          , 'CategoryController@getAllCategory');
    //FOR CONTENTS
    Route::post('aboutUs', 'ContentController@aboutUs');
    Route::post('privacyPolicy', 'ContentController@privacyPolicy');
    Route::post('termsCondition', 'ContentController@termsCondition');
    //For deeplinking
    Route::get('deep-linking', 'DeepController@redirectDeepLink');  

    // Route::post('registrationNew', 'RegisterController@registrationNew');
    // Route::post('registrationNewv3', 'RegisterController@registrationNewv3');
    // Route::post('registrationYacht', 'RegisterController@registrationYacht');
    // Route::post('registrationYachtv3', 'RegisterController@registrationYachtv3');
     
    // Route::post('loginNew', 'LoginController@loginNew');
    // Route::post('loginv2', 'LoginController@loginv2');
    // Route::post('loginv3', 'LoginController@loginv3');
    // Route::post('contact_us', 'SupportController@sendMessage');
    // Route::get('userStatusDropdown', 'RegisterController@userStatusDropdown');
    // Route::get('userStatusDropdownNew', 'RegisterController@userStatusDropdownNew');
    // Route::get('yachtPhotosBaseurl', 'RegisterController@yachtPhotosBaseurl');
    // Route::get('CountriesList', 'RegisterController@countriesList');
    // Route::get('countryList', 'RegisterController@countryList');
    // Route::post('verificationCode', 'RegisterController@verificationCode');
    // Route::post('resendCode', 'RegisterController@resendCode');
    // Route::get('yachtCategoryList', 'RegisterController@yachtCategoryList');

    // Route::post('addPhotos', 'ChatController@addPhotos');


    // Route::get('yachtListByCountry', 'YachtController@yachtListByCountry');
    // Route::post('yachtList', 'YachtController@yachtList');
    // Route::post('yatchDetails ', 'YachtController@yatchDetails');
    // Route::post('getYachtAvailableTime', 'YachtController@getYachtAvailableTime');
   
       Route::group(['middleware' => ['auth:api', 'checkmultiuser']], function () {
           //FOR LOGOUT      
           Route::get('logout', 'LoginController@doLogout');
           //FOR HOME PAGE
           Route::post('MasterCategory', 'HomepageController@getMasterCategory');
           //FOR CATEGORY
           Route::post('getCategoryByParentId', 'CategoryController@getCategoryByParentId');
           Route::post('likeUnlikeCategory', 'CategoryController@likeUnliked');
           Route::post('getfavCategory', 'CategoryController@getfavCategory');

           //FOR USER MANAGEMENT
           Route::get('getUserProfile', 'ProfileController@getDetail');
           Route::post('updateProfile', 'ProfileController@updateProfile');
           Route::post('changePassword', 'ProfileController@changePassword');
           Route::post('updateProfileImage', 'ProfileController@updateProfileImage');
           //FOR LANGUAGE
           Route::get('selectLanguage', 'ProfileController@selectLanguage');
           //FOR ADVERTISEMENT
           Route::post('addAds', 'AdvertisementController@addAds');
           Route::post('uploadADsImages', 'AdvertisementController@uploadADsImages');
           
           Route::get('getAdvertisements', 'AdvertisementController@getAdvertisements');
           Route::post('advertisementDetail', 'AdvertisementController@getDetail');
           Route::post('deleteAds', 'AdvertisementController@deleteAds');
           Route::post('editAds', 'AdvertisementController@update');
           //FOR CONTCAT US
           Route::post('contactUs', 'ContactusController@contactUs');
           //FOR NOTIFICATIONS
           Route::get('getNotifications', 'NotificationController@getNotifications');
           Route::delete('deleteNotification', 'NotificationController@deleteAll');
           // FOR GET PRODUCTS
           Route::post('getProducts', 'ProductController@getProducts');
           Route::post('likeUnliked', 'ProductController@likeUnliked');
           Route::post('getFavourite', 'ProductController@getFavourite');
           
           //For Message 
           Route::post('sendMessage', 'MessasingController@sendMessage'); 
           Route::post('chatUserList',    'MessasingController@UserChatlists');         
           Route::post('getMessageListByUser', 'MessasingController@messageList');         
           


           // Route::post('testNotification', 'YachtController@testsendNotification');



//         Route::post('messageList', 'ChatController@messageList');
//         Route::post('newMessage', 'ChatController@newMessage');
//         Route::post('newMessageCount', 'ChatController@newMessageCount');

//         Route::post('testNotification', 'MessageController@testsendNotification');
//         Route::post('save_chat_message', 'ChatController@save_chat_message');

           
//         /* for user */     
//         Route::post('updateProfileImage', 'UsersController@updateProfileImage');
//         Route::post('updateOwnerProfile', 'UsersController@updateOwnerProfile');
//         Route::post('saveUserPlan', 'PaymentPlanController@saveUserPlan');
//         Route::post('updateUserPlan', 'PaymentPlanController@updateUserPlan');

//         Route::get('planlist', 'PaymentPlanController@getplanlist');
//         Route::get('planlist_ar', 'PaymentPlanController@getplanlistAr');
//         //Add Listing
//         Route::post('addYacht', 'YachtController@addYacht');
//         Route::post('addYachtPhotos', 'YachtController@addYachtPhotos');
//         Route::post('getYachtList', 'YachtController@getYachtList');
//         // Route::post('getYachtList', 'YachtController@getYachtList');
//         Route::post('addYachtAvailableTime', 'YachtController@AddYachtAvailableTime');
//         Route::post('removeYachtAvailableTime', 'YachtController@removeYachtAvailableTime');
        
//         Route::post('ownerYachtList', 'YachtController@ownerYachtList');
//         Route::post('deleteYacht', 'YachtController@deleteYacht');
//         Route::post('updateYacht', 'YachtController@updateYacht');
//         Route::post('addTofavoriteYacht ', 'YachtController@addTofavoriteYacht');
//         Route::post('removeFavoriteYacht ', 'YachtController@removeFavoriteYacht');
//         Route::post('getFavoriteYachtList ', 'YachtController@getFavoriteYachtList');

//         //for message 
//         Route::post('testNotification', 'YachtController@testsendNotification');
//         Route::post('sendMessage', 'ChatController@sendMessage');
//         Route::post('UserChatlist', 'ChatController@UserChatlists');
//         Route::post('messageList', 'ChatController@messageList');
//         Route::post('newMessage', 'ChatController@newMessage');
//         Route::post('newMessageCount', 'ChatController@newMessageCount');
//         //   Route::post('testNotification', 'MessageController@testsendNotification');
//         Route::post('save_chat_message', 'ChatController@save_chat_message');
       
//         Route::post('sendNotification', 'ChatController@sendNotification');
    });
});
