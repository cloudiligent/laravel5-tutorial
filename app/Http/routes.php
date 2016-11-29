<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::auth();

Route::get('/', 'HomeController@index');

//增加路由
//我们要使用路由组来将后台页面置于“需要登录才能访问”的中间件下，以保证安全：
//访问这个页面必须先登录，若已经登录，则将 http://localhost/admin 指向 App\Http\Controllers\Admin\HomeController 的 index 方法。其中需要登录由 middleware 定义， /admin 由 prefix 定义，Admin 由 namespace 定义，HomeController 是实际的类名。
Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
//下面我们要添加针对 http://localhost/admin/article 的路由：
  Route::resource('article', 'ArticleController');
});

