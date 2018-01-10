<?php


Route::middleware('deletePhoto')->group(function()
{
    Route::get('/', 'Home@index')->name('home')->middleware('auth');
    // Route::get('/home', 'Home@index')->name('home')->middleware('auth');
    Route::get('/home', 'Home@index');

    Route::get('/photo/{photoid}', 'Home@showphoto')->middleware('auth');
    Route::post('/photo/download', 'Home@downloadphoto')->middleware('auth')->name('download');
    Route::get('/photo/delete/{id}', 'Home@deletephoto')->middleware('auth');

    Route::get('categories/{categories}', 'Home@showcategories')->middleware('auth');

    Route::get('search', 'Home@search')->middleware('auth');

    Route::get('/profile', 'Profile@index')->middleware('auth')->name('profile');
    Route::get('/profile/edit', 'Profile@edit')->middleware('auth')->name('profile.edit');
    Route::post('/profile/edit/photo', 'Profile@editPhoto')->middleware('auth')->name('profile.edit.photo');
    Route::post('/profile/edit/information', 'Profile@editInformation')->middleware('auth')->name('profile.edit.information');
    Route::post('/profile/edit/pass', 'Profile@editPass')->middleware('auth')->name('profile.edit.pass');

    Route::get('/upload', 'Upload@index')->name('upload')->middleware('auth');
    // Route::post('upload', 'Upload@uploadPost')->name('upload.post')->middleware('auth');

    Route::get('/trash', 'Trash@index')->name('trash')->middleware('auth');
    Route::post('/trash/restore', 'Trash@restore')->name('trash.restore')->middleware('auth');
    Route::post('/trash/delete', 'Trash@delete')->name('trash.delete')->middleware('auth');
});

Route::get('/signin', function () {
    return view('welcome');
})->middleware('guest')->name("signin");
Route::post('/signin', 'Bankphotosauth@Auth_Signin')->middleware('guest')->name("signin");

Route::get('/signup', function () {
    return view('signup');
})->middleware('guest')->name("signup");
Route::post('/signup', 'Bankphotosauth@Auth_Signup')->middleware('guest')->name("signup");


Route::get('/signout', function () {
    Auth::logout();
    return redirect()->route('signin');
})->name('signout')->middleware('auth');

Route::get('storage/photo/{filename}', function ($filename)
{
    $path = storage_path('app/photo/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file   = File::get($path);
    $type   = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('storage/users/{filename}', function ($filename)
{
    $path = storage_path('app/users/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file   = File::get($path);
    $type   = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::get('adddesc', 'Home@adddesc');
Route::post('adddesc', 'Home@savephoto');
Route::post('upload', 'Upload@uploadPost');
Route::post('testupload', 'Upload@testupload');