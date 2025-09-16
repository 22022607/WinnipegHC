<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MfaController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\BusinessController;
use App\Http\Controllers\Front\ContentController;
use App\Http\Controllers\Front\MembershipController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\OrderController;





// -------------------- Website Route ----------------------------------
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::match(['get','post'],'front/login', [MembershipController::class, 'login'])->name('front.login');
Route::get('front/member-dashboard', [MembershipController::class, 'memberDashboard'])->name('front.memberdashboard');
Route::get('front/forgot-password', [MembershipController::class, 'forgot'])->name('front.forgot');

Route::get('front/event', [FrontController::class, 'event'])->name('front.event.index');
Route::get('front/event/event-details/{id}', [FrontController::class, 'eventDetails'])->name('front.event.event-details');
Route::get('front/event/get-ticket/{id}', [FrontController::class, 'getTicket'])->name('front.event.getticket');
Route::match(['get','post'],'front/payment/checkout/{id}', [PaymentController::class, 'checkout'])->name('front.payment.checkout');
Route::post('front/payment/{id}/process', [PaymentController::class, 'processPayment'])->name('front.payment.process');
Route::get('front/tickets/{order}', [FrontController::class, 'purchasedTicket'])->name('front.tickets.purchasedticket');
Route::get('front/ticket/{id}/download', [FrontController::class, 'download'])->name('front.ticket.download');

//----------------------- Member Dashbaord Route Start----------------------------------------------
Route::get('front/event/create', [FrontController::class, 'create'])->name('front.event.create');
Route::post('front/event/store', [FrontController::class, 'store'])->name('front.event.store');
Route::get('front/event/manage', [FrontController::class, 'manage'])->name('front.event.manage');
Route::get('front/event/edit/{id}', [FrontController::class, 'edit'])->name('front.event.edit');
Route::post('front/event/update/{id}', [FrontController::class, 'update'])->name('front.event.update');
Route::delete('front/event/delete/{id}', [FrontController::class, 'delete'])->name('front.event.delete');
Route::get('front/event/view/{id}', [FrontController::class, 'view'])->name('front.event.view');
//------------------------- Member Dashboard Route End---------------------------------------------------



Route::get('/front/join-community', [MembershipController::class, 'create'])->name('front.join-community.create');
Route::post('/front/join-community/store', [MembershipController::class, 'store'])->name('front.join-community.store');

Route::get('front/business', [BusinessController::class, 'index'])->name('front.business.index');
Route::get('front/about',[ContentController::class,'about'])->name('front.content.about');
Route::get('front/contact',[ContentController::class,'contact'])->name('front.content.contact');





Route::resource('front/web', FrontController::class);


// -----------------------Admin Route-------------------------------------
Route::get('/admin', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/mfa/setup', [MfaController::class, 'showSetup'])->name('mfa.setup');
    Route::post('/mfa/verify', [MfaController::class, 'verify'])->name('mfa.verify');
});
Route::resource('membership-plans', MembershipPlanController::class);

 Route::get('/tickets/index/{eventId}', [TicketController::class, 'index'])->name('ticket.index');
 Route::get('/tickets/purchase/{eventId}', [TicketController::class, 'purchase'])->name('ticket.purchase');
Route::post('/tickets/create/{eventId}', [TicketController::class, 'create'])->name('tickets.create');
Route::get('/tickets/{eventId}', [TicketController::class, 'show'])->name('ticket.show');

Route::resource('merchandises', MerchandiseController::class);

 Route::get('/events/index', [EventController::class, 'index'])->name('events.index');
 Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
 Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
 Route::delete('/events/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');
  Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
 Route::post('/events/update/{id}', [EventController::class, 'update'])->name('events.update');


Route::resource('users', UserController::class);
  Route::get('order/index', [OrderController::class, 'index'])->name('order.index');


 
require __DIR__.'/auth.php';
