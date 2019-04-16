<?php

use App\Tag;
use App\Post;
use App\User;
use App\Image;
use App\Video;
use App\Dealer;
use App\Supplier;
use App\Transaction;

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
// All users images
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
// All users post
Route::get('all-user-posts', function() {
    return User::with('posts')->get();
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

// All images
Route::get('images/ownership', function() {
    $images = Image::all();
    foreach ($images as $image) {
        echo $image->url.'---'.($image->imageable_type === 'App\User'?$image->imageable->name.'<br>':$image->imageable->title.'<br>');
    }
});

/*
|--------------------------------------------------------------------------
| Many To Many Polymorphic relationship
|--------------------------------------------------------------------------
*/
// All posts tags
Route::get('posts/tags', function() {
    return Post::with('tags')->get();
});

// post tags
Route::get('post/{id}/tags', function($id) {
    return Post::with('tags')->findOrFail($id);
});

// All videos tags
Route::get('videos/tags', function() {
    return Video::with('tags')->get();
});

// video tags
Route::get('video/{id}/tags', function($id) {
    return Video::with('tags')->findOrFail($id);
});

// All tags owner
Route::get('tags/owner', function() {
    return Tag::with(['posts','videos'])->get();
});

/*
|--------------------------------------------------------------------------
| Transaction Polymorphic relationship [ One to Many]
|--------------------------------------------------------------------------
*/
// Transaction create
Route::get('/transactions/create', function () {

    return User::findOrfail(1)->transactions()->create([
        'ac_no' => time(),
        'transaction_type' => 1,
        'amount' => rand(100,900),
    ]);
});

// Supplier create
Route::get('/suppliers/create', function () {
    return Supplier::insert([
        ['name' => "ab siddik"],
        ['name' => "Arif"],
    ])?'done':'failed';
});

// Dealer create
Route::get('/dealers/create', function () {
    return Dealer::insert([
        ['name' => "Kawsar"],
        ['name' => "Mir"],
    ])?'done':'failed';
});

// TRANSACTIONS

// Supplier Transaction create
Route::get('/supplier/{id}/transactions/create', function ($id) {
    return Supplier::findOrfail($id)->transactions()->create([
        'ac_no' => time(),
        'transaction_type' => 0,
        'amount' => rand(100,900),
    ]);
});

// Dealer Transaction create
Route::get('/dealer/{id}/transactions/create', function ($id) {
    return Dealer::findOrfail($id)->transactions()->create([
        'ac_no' => time(),
        'transaction_type' => 1,
        'amount' => rand(100,900),
    ]);
});

// Supplier Transaction History
Route::get('/supplier/{id}/transactions', function ($id) {

    return Supplier::findOrfail($id)->transactions;
    
});

// Dealer Transaction History
Route::get('/dealer/{id}/transactions', function ($id) {

    return Dealer::findOrfail($id)->transactions;

});

// Transaction By
Route::get('/transaction/{id}', function ($id) {

    return Transaction::findOrfail($id)->transactionable;

});

// Transaction By Supplier
Route::get('/transaction-supplier', function () {

    return Supplier::with('transactions')->get()->pluck('transactions')->unique()->values()->collapse();

});

// Transaction By Dealer
Route::get('/transaction-dealer', function () {

    return Dealer::with('transactions')->get()->pluck('transactions')->unique()->values()->collapse();

});

// Transaction By User
Route::get('/transaction-user', function () {

    return User::with('transactions')->get()->pluck('transactions')->unique()->values()->collapse();

});
