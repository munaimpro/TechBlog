<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'techblog'], function(){
    Route::get('/', 'ViewController@index');
    Route::get('/category/{categoryid}', 'ViewController@site_category');
    Route::get('/contact', 'ViewController@contact');
    Route::get('/postdetails/{postid}', 'ViewController@postdetails');
    Route::post('/addcomment/{postid}', 'CommentController@addcomment');
    Route::get('/removecomment/{delid}', 'CommentController@removecomment');
    Route::get('/editcomment/{editid}', 'CommentController@editcomment');
    Route::post('/updatecomment/{updid}', 'CommentController@updatecomment');
    Route::post('/sendmessage', 'InboxController@sendMessage');
});


Route::group(['prefix'=>'admin'], function(){
    Route::get('/dashboard', 'ViewController@dashboard');
    Route::get('/category', 'ViewController@category');
    Route::get('/addcategory','CategoryController@addcategory');
    Route::get('/removecategory/{delId}','CategoryController@removeCategory');
    Route::get('/editcategory/{editId}', 'CategoryController@editCategory');
    Route::get('/posts', 'ViewController@post');
    Route::get('/addpost','PostController@addpost');
    Route::get('/editpost/{editId}', 'PostController@editPost');
    Route::get('/removepost/{delId}', 'PostController@removePost');
    Route::get('/users', 'ViewController@user');
    Route::get('/edituser/{userid}', 'UserController@editUser');
    Route::get('/login', 'ViewController@login');
    Route::get('/register', 'ViewController@register');
    Route::get('/password', 'ViewController@password');
    Route::get('/logout', 'UserController@logout');
    Route::get('/removeuser/{userid}', 'UserController@removeUser');
    Route::get('/profile', 'ViewController@loadProfile');
    Route::get('/inbox', 'InboxController@inbox');
    Route::get('/removemessage/{msgid}', 'InboxController@removeInbox');
    Route::get('/viewmessage/{msgid}', 'InboxController@viewInbox');
    Route::get('/replymessage/{msgid}', 'InboxController@replyInbox');


    Route::post('/insertcategory', 'CategoryController@insertCategory');
    Route::post('/updatecategory/{updateId}', 'CategoryController@updateCategory');
    Route::post('/insertpost', 'PostController@insertPost');
    Route::post('/updatepost/{updateId}', 'PostController@updatePost');
    Route::post('/userregistration','UserController@register');
    Route::post('/loginuser', 'UserController@login');
    Route::post('/updateuser/{userid}', 'UserController@updateUser');
    Route::post('/updateprofile/{userid}', 'UserController@updateProfile');
    Route::post('/sendreply', 'InboxController@sendReply');

});
