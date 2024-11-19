<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;




Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/account', [AccountController::class, 'showAccountForm'])->name('account')->middleware('auth');
Route::post('/account', [AccountController::class, 'account'])->middleware('auth');
Route::get('/page', [PageController::class, 'showPage'])->name('page')->middleware('auth');
Route::post('/my_page', [PageController::class, 'showMyPage'])->name('my_page')->middleware('auth');
Route::get('/members', [MemberController::class, 'showMembers'])->name('members')->middleware('auth');
Route::get('/members/{id}/profile', [MemberController::class, 'showMemberPage'])->name('profile')->middleware('auth');
Route::get('/members/{id}/friends_member', [MemberController::class, 'showFriendsMember'])->name('friends_member')->middleware('auth');
Route::post('/members', [MemberController::class, 'addMembers'])->middleware('auth');
Route::get('/subscribers', [SubscriberController::class, 'showSubscribers'])->name('subscribers')->middleware('auth');
Route::post('/subscribers', [SubscriberController::class, 'accept'])->middleware('auth');
Route::post('/subscribers/send', [MessageController::class, 'send'])->name('send')->middleware('auth');
Route::post('/posts', [PostsController::class, 'createPosts'])->name('posts')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/unread/count', [MessageController::class, 'getUnreadCount'])->name('messages.unread.count');
});


Route::get('/', function () {
    return view('login');
})->middleware('auth');
