<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
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
// Route::resource('user', 'UserController');  
Route::post('user', 'UserController@index'); 
Route::post('store', 'UserController@store'); 
Route::post('update', 'UserController@update'); 
Route::post('destroy', 'UserController@destroy'); 

###################
# GUEST
###################

// Route::group(['middleware' => 'guest'], function () {
//     Route::post('email/verify/{token}', 'Auth\EmailVerificationController@verify')
//         ->middleware('throttle:3,1')
//         ->name('api.email.verify');

//     Route::post('devices/authorize/{token}', 'Auth\AuthorizeDeviceController@authorizeDevice')
//         ->middleware('throttle:3,1')
//         ->name('api.device.authorize');

//     Route::post('login', 'Auth\LoginController@login')
//         ->name('api.auth.login');

//     Route::post('register', 'Auth\RegisterController@register')
//         ->name('api.auth.register');
//   Route::post('create', 'Auth\RegisterController@create')
//         ->name('create');
//     Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
//         ->middleware('throttle:5,1')
//         ->name('api.reset.email-link');

//     Route::post('password/reset', 'Auth\ResetPasswordController@reset')
//         ->middleware('throttle:5,1')
//         ->name('api.reset.password');
// });
// Route::post('userCreate', 'UserController@userCreateApi')
//         ->name('userCreateApi');
// ###################
// # JUST AUTH
// ###################

// Route::group(['middleware' => 'auth:api'], function () {
//     Route::post('logout', 'Auth\LoginController@logout')
//         ->name('api.auth.logout');

//     Route::post('generate2faSecret', 'Auth\TwoFactorAuthenticationController@generate2faSecret')
//         ->name('api.generate2faSecret');

//     Route::post('enable2fa', 'Auth\TwoFactorAuthenticationController@enable2fa')
//         ->name('api.enable2fa');
// });

// ###################
// # 2FA
// ###################

// Route::group([
//     'middleware' => [
//         'auth:api',
//         '2fa',
//     ],
// ], function () {
//     Route::post('disable2fa', 'Auth\TwoFactorAuthenticationController@disable2fa')
//         ->name('api.disable2fa');

//     Route::post('verify2fa', 'Auth\TwoFactorAuthenticationController@verify2fa')
//         ->name('api.verify2fa');

//     Route::get('me/profile', 'ProfileController@showMe')
//         ->name('api.profile');

//     Route::patch('me/profile', 'ProfileController@updateMe')
//         ->name('api.profiles.me.update');

//     Route::apiResource('profiles', 'ProfileController')
//         ->only([
//             'index',
//             'show',
//             'update',
//         ])
//         ->names([
//             'index'  => 'api.profiles.index',
//             'show'   => 'api.profiles.show',
//             'update' => 'api.profiles.update',
//         ]);

//     Route::get('me', 'UserController@profile')
//         ->name('api.me');

//     Route::patch('me', 'UserController@updateMe')
//         ->name('api.me.update');

//     Route::apiResource('users', 'UserController')
//         ->only([
//             'index',
//             'show',
//             'store',
//             'update',
//         ])
//         ->names([
//             'index'  => 'api.users.index',
//             'show'   => 'api.users.show',
//             'store'  => 'api.users.store',
//             'update' => 'api.users.update',
//         ]);

//     Route::apiResource('companies', 'CompanyController')
//         ->only([
//             'index',
//             'show',
//             'store',
//             'update',
//         ])
//         ->names([
//             'index'  => 'api.companies.index',
//             'show'   => 'api.companies.show',
//             'store'  => 'api.companies.store',
//             'update' => 'api.companies.update',
//         ]);

//     Route::patch('password/update', 'UserController@updatePassword')
//         ->name('api.password.update');

//     Route::patch('notifications/visualize-all', 'NotificationController@visualizeAllNotifications')
//         ->name('api.notifications.visualize-all');

//     Route::patch('notifications/{id}/visualize', 'NotificationController@visualizeNotification')
//         ->name('api.notifications.visualize');

//     Route::delete('devices/{id}', 'Auth\AuthorizeDeviceController@destroy')
//         ->middleware('throttle:3,1')
//         ->name('api.device.destroy');
// });

// Route::get('ping', 'UtilController@serverTime')
//     ->name('api.server.ping');

// Route::post('ws/auth', 'Auth\LoginController@wsAuth')->name('api.ws.auth');

// Route::post('/account/disable/{token}', 'Auth\DisableAccountController@disable')
//     ->middleware('throttle:1,1')
//     ->name('api.account.disable');
