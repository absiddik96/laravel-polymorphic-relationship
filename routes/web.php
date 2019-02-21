<?php
use App\User;
use App\Image;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| One To One Polymorphic relationship
|--------------------------------------------------------------------------
*/

// Add user image
Route::get('user/{id}/image/add', function($id) {
    $user = User::findOrFail($id);
    return $user->image()->create(['url'=>str_slug($user->name.' '.time().'.jpg')]);
});

// All user images
Route::get('all-user-images', function() {
    $users = User::with('image')->get();
    foreach ($users as $user) {
        echo $user->name.'---'.$user->image->url.'<br>';
    }
});

// User image
Route::get('user/{id}/image', function($id) {
    $user = User::with('image')->findOrFail($id);
    return $user->name.'---'.$user->image->url.'<br>';
});

// Image ownership
Route::get('image/{id}/ownership', function($id) {
    $image = Image::findOrFail($id);
    return $image->imageable;
});

// All image
Route::get('images/ownership', function() {
    $images = Image::all();
    foreach ($images as $image) {
        echo $image->url.'---'.$image->imageable->name.'<br>';
    }
});
