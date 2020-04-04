<?php


Route::get('/', 'PagesController@home');
Route::get('blog/{post}', 'PostsController@show')->name('posts.show');

Route::get('posts', function () {
    return App\Post::all();
});



Route::group([
'prefix' => 'admin',
'namespace' => 'Admin',
'middleware' => 'auth'],
function(){
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('posts','PostsController@index')->name('admin.posts.index');
    Route::get('posts/create','PostsController@create')->name('admin.posts.create');
    Route::post('posts','PostsController@store')->name('admin.posts.store');
    Route::get('posts/{post}','PostsController@edit')->name('admin.posts.edit');
    Route::put('posts/{post}','PostsController@update')->name('admin.posts.update');
    
    Route::post('posts/{post}/photos','PhotosController@store')->name('admin.posts.photos.store');
    Route::delete('post/{photo}','PhotosController@destroy')->name('admin.photos.destroy');

    //rutas de administracion

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/*        // Registration Routes...
        if ($options['register'] ?? true) {
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'Auth\RegisterController@register');
        }*/

        // Password Reset Routes...
        if ($options['reset'] ?? true) {
            Route::resetPassword();
        }

        // Email Verification Routes...
        if ($options['verify'] ?? false) {
            Route::emailVerification();
        }

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
