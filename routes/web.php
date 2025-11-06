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
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BusinessCategory;
use App\Http\Controllers\FestivalController;





// -------------------- Website Route ----------------------------------



Route::get('/', [FrontController::class, 'index']);
Route::match(['get','post'],'login', [MembershipController::class, 'login'])->name('user.login');

Route::get('forget-password', [MembershipController::class, 'forgot'])->name('user.forgot');
Route::post('forget-password', [MembershipController::class, 'forgotPost'])->name('user.forgot.post');
Route::get('reset-passwords/{token}', [MembershipController::class, 'resetPassword'])->name('user.reset.password');
Route::post('reset-passwords', [MembershipController::class, 'resetPasswordPost'])->name('user.reset.password.post');

Route::get('event', [FrontController::class, 'event'])->name('event');
Route::get('event/{id}', [FrontController::class, 'eventDetails'])->name('event.detail');
Route::get('event/get-ticket/{id}', [FrontController::class, 'getTicket'])->name('event.getticket');
Route::match(['get','post'],'payment/checkout/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('payment/{id}/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('tickets/{order}', [FrontController::class, 'purchasedTicket'])->name('tickets.purchasedticket');
Route::get('ticket/{id}/download', [FrontController::class, 'download'])->name('ticket.download');
Route::post('subscribe/email', [FrontController::class, 'subscribeEmail'])->name('subscribe.email');
Route::get('ticket/success', [PaymentController::class, 'ticketSuccess'])->name('event.ticket.success');
Route::get('ticket/cancel', [PaymentController::class, 'ticketCancel'])->name('event.ticket.cancel');

Route::get('festival', [FrontController::class, 'festival'])->name('festival');
Route::get('festival/overview', [FrontController::class, 'festivalOverview'])->name('festival.overview');
Route::get('festival/tickets', [FrontController::class, 'festivalTickets'])->name('festival.tickets');
Route::get('festival/presenters', [FrontController::class, 'festivalPresenters'])->name('festival.presenters');
Route::get('festival/exhibitors', [FrontController::class, 'festivalExhibitors'])->name('festival.exhibitors');
Route::get('festival/exhibitor-tables', [FrontController::class, 'festivalExhibitorTables'])->name('festival.exhibitor-tables');
Route::get('festival/buytickets', [FrontController::class, 'festivalBuyTicket'])->name('festival.buy.tickets');
Route::post('festival/ticket-checkout', [FrontController::class, 'festivalTicketCheckout'])->name('festival.ticket.checkout');
Route::get('festival/ticket-success', [FrontController::class, 'festivalTicketSuccess'])->name('festival.ticket.success');
Route::get('festival/ticket-cancel', [FrontController::class, 'festivalTicketCancel'])->name('festival.ticket.cancel');
Route::get('/festival/ticket-pdf/{order_id}', [FrontController::class, 'downloadTicketPdf'])
    ->name('festival.ticket.pdf');

Route::get('festival/register-non-member', [FrontController::class, 'festivalRegisterNonMember'])->name('festival.register.non.member');
Route::post('festival/register-non-member', [FrontController::class, 'storeNonMember'])->name('festival.register.non.member.store');
Route::get('festival/non-member-exhibitor-table-success', [FrontController::class, 'NonMemberExhibitorTableSuccess'])->name('festival.non.member.exhibitor.table.success');


Route::get('festival/exhibitor-table-success', [FrontController::class, 'festivalExhibitorTableSuccess'])->name('festival.exhibitor.table.success');
Route::get('festival/exhibitor-table-cancel', [FrontController::class, 'festivalExhibitorTableCancel'])->name('festival.exhibitor.table.cancel');
//----------------------- Member Dashbaord Route Start----------------------------------------------

Route::group(['middleware' => ['auth:member']], function () {
    Route::get('member-dashboard', [MembershipController::class, 'memberDashboard'])->name('memberdashboard');
    Route::get('member-dashboard/events', [FrontController::class, 'create'])->name('memberdashboard.events');
    Route::post('member-dashboard/events/store', [FrontController::class, 'store'])->name('memberdashboard.events.store');
    Route::get('member-dashboard/events/manage', [FrontController::class, 'manage'])->name('memberdashboard.events.manage');
    Route::get('member-dashboard/events/edit/{id}', [FrontController::class, 'edit'])->name('memberdashboard.events.edit');
    Route::post('member-dashboard/events/update/{id}', [FrontController::class, 'update'])->name('memberdashboard.events.update');
    Route::delete('member-dashboard/events/delete/{id}', [FrontController::class, 'delete'])->name('memberdashboard.events.delete');
    Route::get('member-dashboard/events/view/{id}', [FrontController::class, 'view'])->name('memberdashboard.events.view');
    Route::get('member-dashboard/subscription', [MembershipController::class, 'subscription'])->name('memberdashboard.subscription');
    Route::get('member-dashboard/security', [MembershipController::class, 'security'])->name('memberdashboard.security');
    Route::get('member-dashboard/purchase-spotlight', [MembershipController::class, 'purchaseSpotlight'])->name('memberdashboard.purchase-spotlight');
    Route::post('member-dashboard/checkout-spotlight', [MembershipController::class, 'checkoutSpotlight'])->name('memberdashboard.checkout-spotlight');
    Route::get('membership/membership-levels', [MembershipController::class, 'membershipLevels'])->name('membership.levels');
    Route::get('membership/checkout/{id}', [MembershipController::class, 'checkout'])->name('membership.checkout');
    Route::post('membership/process-payment', [MembershipController::class, 'processPayment'])->name('membership.process');
    Route::get('/membership/success', [MembershipController::class, 'success'])->name('membership.success');
    Route::post('/membership/update-payment-status', [MembershipController::class, 'updatePaymentStatus'])->name('membership.update-payment-status');
    Route::get('member-dashboard/business-profile', [MembershipController::class, 'businessProfile'])->name('memberdashboard.business-profile');
    Route::post('member-dashboard/business-profile/add', [MembershipController::class, 'addBusinessProfile'])->name('memberdashboard.business-profile.add');
    Route::post('member-dashboard/business-profile/add-services', [MembershipController::class, 'addBusinessServices'])->name('services.store');
    Route::post('member-dashboard/business-profile/update-services', [MembershipController::class, 'updateBusinessServices'])->name('services.update');
    Route::delete('member-dashboard/business-profile/delete-services/{id}', [MembershipController::class, 'deleteBusinessServices'])->name('services.destroy');
    Route::post('member-dashboard/update-password', [MembershipController::class, 'updatePassword'])->name('memberdashboard.update-password');
    Route::post('member-dashboard/delete-account', [MembershipController::class, 'deleteAccount'])->name('memberdashboard.delete-account');
    Route::post('member-logout', [MembershipController::class, 'memberLogout'])->name('member.logout');
    Route::post('businessprofile/socialmedia/store',[MembershipController::class, 'socialMedialLinks'])->name('businessprofile.socialmedia.store');    
    Route::post('businessprofile/addgallery',[MembershipController::class, 'addMedia'])->name('businessprofile.media.store'); 
     Route::get('member-dashboard/purchase-spotlight-event', [MembershipController::class, 'purchaseSpotlightEvent'])->name('memberdashboard.purchase-spotlight-event');
    Route::post('member-dashboard/checkout-spotlight-event', [MembershipController::class, 'checkoutSpotlightEvent'])->name('memberdashboard.checkout-spotlight-event');
    Route::post('member-dashboard/spotlight-event/update/{spotlight}', [MembershipController::class, 'updateSpotlightEvent'])
    ->name('memberdashboard.updateSpotlightEvent');
     Route::post('member-dashboard/spotlight-business/update/{spotlight}', [MembershipController::class, 'updateSpotlightBusiness'])
    ->name('memberdashboard.updateSpotlightBusiness');
    Route::get('member-dashboard/appointments', [MembershipController::class, 'appointments'])->name('memberdashboard.business.viewappointments');
        Route::get('member-dashboard/events/tickets/{event}', [MembershipController::class, 'eventTickets'])->name('memberdashboard.events.tickets');
            Route::post('festival/member-table', [FrontController::class, 'BookFestivalTable'])->name('festival.book.table.member');


});

//------------------------- Member Dashboard Route End-------------------------------------



Route::get('join-community', [MembershipController::class, 'create'])->name('join-community');
Route::post('join-community/store', [MembershipController::class, 'store'])->name('join-community.store');
Route::post('join-community/finalize', [MembershipController::class, 'finalizeRegistration'])->name('join-community.finalize');
Route::get('business', [BusinessController::class, 'index'])->name('business');

Route::get('business-category', [BusinessController::class, 'businessCategory'])->name('business-category');

Route::get('business/{id}', [BusinessController::class, 'details'])->name('business.details');

Route::post('business/book-appointment/{id}', [BusinessController::class, 'bookAppointment'])->name('business.bookAppointment');

Route::get('about',[ContentController::class,'about'])->name('about');
Route::get('contact',[ContentController::class,'contact'])->name('contact');
Route::post('contact',[ContentController::class,'queriesStore'])->name('contact.store');

Route::get('privacy', [ContentController::class, 'privacy'])->name('privacy');
Route::get('terms', [ContentController::class, 'terms'])->name('terms');
Route::resource('front/web', FrontController::class);


// -----------------------Admin Route-------------------------------------
Route::get('/admin', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 Route::get('content', [SettingController::class, 'index'])->name('content.index');
Route::post('contact/details', [SettingController::class, 'contactDetails'])->name('content.store');
Route::post('about/store', [SettingController::class, 'aboutStore'])->name('content.about.store');
Route::post('privacy/store', [SettingController::class, 'privacyStore'])->name('content.privacy.store');
Route::post('terms/store', [SettingController::class, 'termsStore'])->name('content.terms.store');
Route::post('faq/store', [SettingController::class, 'faq'])->name('front.faq');
Route::get('leads', [SettingController::class, 'leads'])->name('leads');

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
Route::get('event/tickets/{eventId}', [TicketController::class, 'show'])->name('ticket.show');


Route::resource('merchandises', MerchandiseController::class);

 Route::get('/events/index', [EventController::class, 'index'])->name('events.index');
 Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
 Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
 Route::delete('/events/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');
  Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
 Route::post('/events/update/{id}', [EventController::class, 'update'])->name('events.update');


Route::resource('users', UserController::class);
 Route::post('/admin/user/status/{id}', [UserController::class, 'updateStatus'])->name('admin.user.status');
    Route::get('/admin/user/spotlight', [UserController::class, 'userSpotlight'])->name('user.spotlight');
  Route::get('order/index', [OrderController::class, 'index'])->name('order.index');

  Route::get('businesses', [BusinessCategory::class, 'index'])->name('business.index');
  Route::get('admin/business/create', [BusinessCategory::class, 'create'])->name('admin.business.create');
Route::post('/business/store', [BusinessCategory::class, 'store'])->name('business.store');

Route::delete('/business/delete/{id}', [BusinessCategory::class, 'destroy'])->name('business.destroy');
 Route::get('/business/edit/{id}', [BusinessCategory::class, 'edit'])->name('business.edit');
Route::post('/business/update/{id}', [BusinessCategory::class, 'update'])->name('business.update');



Route::get('category', [BusinessCategory::class, 'category'])->name('category');

Route::get('category/create', [BusinessCategory::class, 'categoryCreate'])->name('category.create');
Route::post('category/store', [BusinessCategory::class, 'categoryStore'])->name('category.store');

// festival management route
Route::get('admin/festival', [FestivalController::class, 'festival'])->name('admin.festival');
Route::get('admin/festival/create', [FestivalController::class, 'create'])->name('admin.festival.create');
Route::post('admin/festival/store', [FestivalController::class, 'store'])->name('admin.festival.store');
Route::get('admin/festival/edit/{id}', [FestivalController::class, 'edit'])->name('admin.festival.edit');
Route::post('admin/festival/update/{id}', [FestivalController::class, 'update'])->name('admin.festival.update');
Route::delete('admin/festival/destroy/{id}', [FestivalController::class, 'destroy'])->name('admin.festival.destroy');

Route::get('admin/presenters', [FestivalController::class, 'presenters'])->name('admin.presenter');
Route::get('admin/presenters/create', [FestivalController::class, 'createPresenter'])->name('admin.presenter.create');
Route::post('admin/presenters/store', [FestivalController::class, 'storePresenter'])->name('admin.presenter.store');
Route::get('admin/presenters/create-from-member/{id}', [FestivalController::class, 'createPresenterFromMember'])
    ->name('admin.presenter.createFromMember');
Route::get('admin/presenters/edit/{id}', [FestivalController::class, 'editPresenter'])->name('admin.presenter.edit');
Route::post('admin/presenters/update/{id}', [FestivalController::class, 'updatePresenter'])->name('admin.presenter.update');
Route::delete('admin/presenters/destroy/{id}', [FestivalController::class, 'destroyPresenter'])->name('admin.presenter.destroy');

Route::get('admin/exhibitors', [FestivalController::class, 'exhibitors'])->name('admin.exhibitor');
Route::get('admin/exhibitors/create', [FestivalController::class, 'createExhibitor'])->name('admin.exhibitor.create');
Route::post('admin/exhibitors/store', [FestivalController::class, 'storeExhibitor'])->name('admin.exhibitor.store');
Route::get('admin/exhibitors/create-from-member/{id}', [FestivalController::class, 'createExhibitorFromMember'])
    ->name('admin.exhibitor.createFromMember');
Route::get('admin/exhibitors/edit/{id}', [FestivalController::class, 'editExhibitor'])->name('admin.exhibitor.edit');
Route::post('admin/exhibitors/update/{id}', [FestivalController::class, 'updateExhibitor'])->name('admin.exhibitor.update');
Route::delete('admin/exhibitors/destroy/{id}', [FestivalController::class, 'destroyExhibitor'])->name('admin.exhibitor.destroy');  
Route::get('admin/festival-booked-tickets', [FestivalController::class, 'festivalBookedTickets'])->name('admin.festival-booked-ticket'); 
Route::get('admin/festival-transactions', [FestivalController::class, 'festivalTransactions'])->name('admin.festival-transactions');


require __DIR__.'/auth.php';
