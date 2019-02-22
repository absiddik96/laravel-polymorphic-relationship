<?php
use App\User;
use App\Post;
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
    return $users = User::with('image')->get();
    // foreach ($users as $user) {
    //     echo $user->name.'---'.$user->image->url.'<br>';
    // }
});

// User image
Route::get('user/{id}/image', function($id) {
    $user = User::with('image')->findOrFail($id);
    return $user->name.'---'.$user->image->url.'<br>';
});

/*
|--------------------------------------------------------------------------
| One To Many Polymorphic relationship
|--------------------------------------------------------------------------
*/
// All user post
Route::get('all-user-posts', function() {
    return User::with('posts')->get();
});

// Post image add
Route::get('post/{id}/image/add', function($id) {
    return Post::findOrFail($id)->images()->create([
        'url' => str_slug('post '.time().'.jpg'),
    ]);
});

// all post images
Route::get('all-post-images', function() {
    return Post::with('images')->get();
});

// post images
Route::get('post/{id}/images', function($id) {
    return Post::with('images')->findOrFail($id)->images;
});

// post images by post
Route::get('images/post/{id}', function($id) {
    return Image::where([
            'imageable_id'=>$id,
            'imageable_type'=>'App\Post',
        ])->get();
});
/*
|--------------------------------------------------------------------------
| Polymorphic relationship
|--------------------------------------------------------------------------
*/

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
