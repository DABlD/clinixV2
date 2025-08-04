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

//JUST ADD '->defaults("group", "Settings")' IF YOU WANT TO GROUP A NAV IN A DROPDOWN

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
   return redirect()->route('login');
});

Route::get('/terms-and-conditions', function(){
   return view('terms-and-conditions');
})->name('terms-and-conditions');

Route::get('forgotPassword', 'UserController@forgotPassword')->name('forgotPassword');
Route::get('resetPassword', 'UserController@resetPassword')->name('resetPassword');

Route::post("clinic/store", "ClinicController@store")->name('clinic.store');

// API
Route::group([
        'prefix' => "api/"
    ], function (){
        // AUTH
        Route::post('/tokens/create', 'ApiController@getToken');
        Route::middleware('auth:sanctum')->post('/tokens/revoke', 'ApiController@revokeToken');
        Route::middleware('auth:sanctum')->post('patient/store', 'ApiController@patientStore');
    }
);

Route::group([
        'middleware' => 'auth',
    ], function() {
        Route::get('/', "DashboardController@index")->name('dashboard');

        Route::get('/', 'DashboardController@index')
            ->defaults('sidebar', 1)
            ->defaults('icon', 'fas fa-list')
            ->defaults('name', 'Dashboard')
            ->defaults('roles', array('Admin'))
            ->name('dashboard')
            ->defaults('href', '/');

        Route::get('/profile', 'UserController@profile')
            ->defaults('sidebar', 1)
            ->defaults('icon', 'fas fa-user-doctor')
            ->defaults('name', 'Profile')
            ->defaults('roles', array('Admin', 'Doctor'))
            ->name('profile')
            ->defaults('href', '/profile');

        // USER ROUTES
        $cname = "user";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-users")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Super Admin", 'Admin'))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("restore/", ucfirst($cname) . "Controller@restore")->name('restore');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
                Route::post("updatePassword/", ucfirst($cname) . "Controller@updatePassword")->name('updatePassword');
            }
        );

        // CLINIC ROUTES
        $cname = "clinic";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-hospital")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Super Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // PATIENT ROUTES
        $cname = "appointment";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-calendar-days")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // PATIENT ROUTES
        $cname = "patient";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-users-medical")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // TEMPLATE ROUTES
        $cname = "question";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-list-check")
                    ->defaults("name", "Template Manager")
                    ->defaults("roles", array("Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');

                Route::post("reorderRows/", ucfirst($cname) . "Controller@reorderRows")->name('reorderRows');
            }
        );

        // DOCTOR ROUTES
        $cname = "doctor";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');

                Route::get("getSpecializations/", ucfirst($cname) . "Controller@getSpecializations")->name('getSpecializations');
            }
        );

        // NURSE ROUTES
        $cname = "nurse";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // THEME ROUTES
        $cname = "theme";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // TEMPLATE MANAGER
        $cname="template";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("getDiagnosis", ucfirst($cname) . "ManagerController@getDiagnosis")->name('getDiagnosis');
                Route::get("storeDiagnosis", ucfirst($cname) . "ManagerController@storeDiagnosis")->name('storeDiagnosis');
                Route::get("updateDiagnosis", ucfirst($cname) . "ManagerController@updateDiagnosis")->name('updateDiagnosis');
                Route::get("getRVU", ucfirst($cname) . "ManagerController@getRVU")->name('getRVU');
                Route::get("storeRVU", ucfirst($cname) . "ManagerController@storeRVU")->name('storeRVU');
                Route::get("updateRVU", ucfirst($cname) . "ManagerController@updateRVU")->name('updateRVU');
                Route::get("getICD", ucfirst($cname) . "ManagerController@getICD")->name('getICD');
                Route::get("storeICD", ucfirst($cname) . "ManagerController@storeICD")->name('storeICD');
                Route::get("updateICD", ucfirst($cname) . "ManagerController@updateICD")->name('updateICD');
                Route::get("getDrawing", ucfirst($cname) . "ManagerController@getDrawing")->name('getDrawing');
                Route::post("storeDrawing", ucfirst($cname) . "ManagerController@storeDrawing")->name('storeDrawing');
                Route::get("updateDrawing", ucfirst($cname) . "ManagerController@updateDrawing")->name('updateDrawing');

                Route::get("delete", ucfirst($cname) . "ManagerController@delete")->name('delete');
                Route::get("deleteRVU", ucfirst($cname) . "ManagerController@deleteRVU")->name('deleteRVU');
                Route::get("deleteICD", ucfirst($cname) . "ManagerController@deleteICD")->name('deleteICD');
                Route::get("deleteDiagnosis", ucfirst($cname) . "ManagerController@deleteDiagnosis")->name('deleteDiagnosis');
                Route::get("deleteDrawing", ucfirst($cname) . "ManagerController@deleteDrawing")->name('deleteDrawing');
            }
        );

        // DATATABLES
        $cname = "datatable";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("user", ucfirst($cname) . "Controller@user")->name('user');
                Route::get("clinic", ucfirst($cname) . "Controller@clinic")->name('clinic');
                Route::get("patient", ucfirst($cname) . "Controller@patient")->name('patient');
            }
        );

        // LOGS
        $cname = "log";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("create", ucfirst($cname) . "Controller@create")->name('create');
            }
        );
    }
);

require __DIR__.'/auth.php';