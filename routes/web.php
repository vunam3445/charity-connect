<?php

use App\Http\Controllers\Account;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QrCodeController;
use App\Http\Requests\Volunteer;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckInController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;



Route::get('/', [HomeController::class, 'index'])->name('home');

// About and Contact pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    // Organization
    Route::get('/', [HomeController::class, 'indexAdmin'])->name('admin.home');
    Route::get('/organizations/approved', [OrganizationController::class, 'getApproved']);
    Route::get('/organizations/pending',  [OrganizationController::class, 'getPending']);
    Route::get('/organizations/rejected', [OrganizationController::class, 'getRejected']);
    Route::get('/organizations/search',   [OrganizationController::class, 'search'])->name('admin.organizations.search');
    Route::post('/organizations/approve/{id}', [OrganizationController::class, 'approve'])->name('admin.organizations.approve');
    Route::post('/organizations/reject/{id}',  [OrganizationController::class, 'reject'])->name('admin.organizations.reject');
    Route::get('/organizations/{id}',          [OrganizationController::class, 'profile']);

    // Event
    Route::get('/events/pending',  [EventController::class, 'getPendingEvents']);
    Route::get('/events/approved', [EventController::class, 'indexAdmin'])->name('admin.events.approved');
    Route::get('/events/rejected', [EventController::class, 'getRejected']);
    Route::get('/events/search',   [EventController::class, 'search'])->name('admin.events.search');
    Route::get('/events/{id}',     [EventController::class, 'adminProfile']);
    Route::post('/events/approve/{id}', [EventController::class, 'approve'])->name('admin.events.approve');
    Route::post('/events/reject/{id}',  [EventController::class, 'reject'])->name('admin.events.reject');

    // Notifications
    Route::get('/notifications/send', [NotificationController::class, 'sendAdminView'])->name('notification.admin.send.view');
    Route::post('/notifications/send', [NotificationController::class, 'sendAsAdmin'])->name('notification.admin.send');
    Route::get('/notifications/view', [NotificationController::class, 'viewSentNotifications'])->name('notification.admin.view');
});

Route::middleware('auth:organization')->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('events.update'); // Thêm route này
    Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('event.destroy');
});
// Volunteer routes
Route::get('/volunteer/{id}', [VolunteerController::class, 'profile'])->name('volunteer.profile');
//Router Vinh danh
Route::get('/top', [VolunteerController::class, 'getTopVolunteersLastMonth']);

// Organization routes
Route::get('/organization/{id}', [OrganizationController::class, 'profile'])->name('organization.profile');
Route::get('/organizations/{id}', [OrganizationController::class, 'index']);
Route::get('/organizations/approved', [OrganizationController::class, 'getApproved']);
Route::get('/organizations/pending', [OrganizationController::class, 'getPending']);


// Admin organization routes
Route::get('admin/organizations/approved', [OrganizationController::class, 'getApproved']);
Route::get('admin/organizations/pending', [OrganizationController::class, 'getPending']);
Route::get('admin/organizations/rejected', [OrganizationController::class, 'getRejected']);
Route::post('/admin/organizations/approve/{id}', [OrganizationController::class, 'approve'])->name('admin.organizations.approve');
Route::post('/admin/organizations/reject/{id}', [OrganizationController::class, 'reject'])->name('admin.organizations.reject');

Route::get('admin/organizations/{id}', [OrganizationController::class, 'profile']);
// Event routes
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/load-more', [EventController::class, 'loadMore'])->name('event.loadMore');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/event/suggestion/{id}', [EventController::class, 'suggestion'])->name('event.suggestion');
Route::get('/events/approved', [EventController::class, 'index']);


// Admin event routes
Route::get('admin/events/pending', [EventController::class, 'getPendingEvents']);
Route::get('admin/events/approved', [EventController::class, 'indexAdmin'])->name('admin.events.approved');
Route::get('admin/events/rejected', [EventController::class, 'getRejected']);
Route::get('/admin/events/{id}', [EventController::class, 'adminProfile']);
Route::post('admin/events/approve/{id}', [EventController::class, 'approve'])->name('admin.events.approve');
Route::post('admin/events/reject/{id}', [EventController::class, 'reject'])->name('admin.events.reject');
// Result routes
Route::get('/events/edit', [EventController::class, 'update'])->name('events.create');
// Route result
Route::get('/result', [ResultController::class, 'index'])->name('result.index');
Route::get('/result/load-more', [ResultController::class, 'loadMore'])->name('result.loadMore');
Route::get('/result/create/{event_id}', [ResultController::class, 'create'])->name('result.create');
Route::post('/result/store', [ResultController::class, 'store'])->name('result.store');
Route::get('/result/edit/{result_id}', [ResultController::class, 'edit'])->name('result.edit');
Route::put('/result/update/{result_id}', [ResultController::class, 'update'])->name('result.update');
Route::delete('/result/delete/{result_id}', [ResultController::class, 'destroy'])->name('result.destroy');
Route::get('/result/{id}', [ResultController::class, 'show'])->name('result.show');
Route::get('/result/by-event/{event_id}', [ResultController::class, 'showByEvent'])->name('result.byEvent');


// Event routes



// Admin event routes

// Result routes
// Route result
Route::get('/result', [ResultController::class, 'index'])->name('result.index');
Route::get('/result/load-more', [ResultController::class, 'loadMore'])->name('result.loadMore');
Route::get('/result/create/{event_id}', [ResultController::class, 'create'])->name('result.create');
Route::post('/result/store', [ResultController::class, 'store'])->name('result.store');
Route::get('/result/edit/{result_id}', [ResultController::class, 'edit'])->name('result.edit');
Route::put('/result/update/{result_id}', [ResultController::class, 'update'])->name('result.update');
Route::delete('/result/delete/{result_id}', [ResultController::class, 'destroy'])->name('result.destroy');
Route::get('/result/{id}', [ResultController::class, 'show'])->name('result.show');
// Search routes
Route::get('/search/events-page', [SearchController::class, 'searchEventsPage'])->name('search.events.page');


// event route

Route::get('/events/{id}', [EventController::class, 'profile']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/editvolunteer', [Account::class, 'editvolunteerShow'])->name('editvolunteer.show');
Route::get('/editvolunteer', [Account::class, 'editvolunteerShow'])->name('volunteer.edit');
Route::post('/editvolunteer/{id}', [Account::class, 'editvolunteer'])->name('editvolunteer');


//route thông báo
// Trang gửi thông báo (Admin) — KHÔNG CẦN XÁC THỰC TẠM THỜI

Route::get('/admin/notifications/send', [NotificationController::class, 'sendAdminView'])->name('notification.admin.send.view');

Route::post('/admin/notifications/send', [NotificationController::class, 'sendAsAdmin'])->name('notification.admin.send');


Route::get('/admin/notifications/view', [NotificationController::class, 'viewSentNotifications'])->name('notification.admin.view');


Route::prefix('admin/notifications')->middleware(['auth:admin'])->group(function () {
    // ✅ Thông báo toàn hệ thống (Gửi đến tất cả tình nguyện viên)
    Route::get('/system', [NotificationController::class, 'viewSystem'])->name('admin.notifications.system');

    // ✅ Thông báo gửi đến toàn bộ tổ chức
    Route::get('/organization-all', [NotificationController::class, 'viewOrganizationAll'])->name('admin.notifications.organization_all');

    // ✅ Thông báo gửi đến tổ chức cụ thể
    Route::get('/organization-specific', [NotificationController::class, 'viewOrganizationSpecific'])->name('admin.notifications.organization_specific');

    // ✅ Thông báo gửi đến sự kiện cụ thể
    Route::get('/event-specific', [NotificationController::class, 'viewEventSpecific'])->name('admin.notifications.event_specific');
});


// ADMIN: Trang xem và gửi thông báo
Route::prefix('admin/notifications')->middleware(['auth:admin'])->group(function () {
    Route::get('/view', [NotificationController::class, 'sendAdminView'])->name('notification.admin.view');
    Route::post('/send', [NotificationController::class, 'sendAsAdmin'])->name('notification.admin.send');
    Route::get('/sent', [NotificationController::class, 'adminSentNotifications'])->name('notification.admin.sent');
});

// ORGANIZATION: Trang xem và gửi thông báo
Route::middleware(['auth:organization'])->prefix('organization/notifications')->group(function () {
    Route::get('/send', [NotificationController::class, 'sendEventView'])->name('notification.organization.send.event.view');
    Route::post('/send', [NotificationController::class, 'sendEvent'])->name('notification.organization.send.event');
    Route::get('/view', [NotificationController::class, 'received'])->name('notifications.organization.received');
    Route::get('/view-sent', [NotificationController::class, 'viewSentEvent'])->name('notification.organization.sent.event');
});

// VOLUNTEER: Trang xem thông báo được nhận
Route::middleware(['auth:volunteer'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'received'])->name('notifications.received');
    Route::post('/events/unregister/{event}', [EventController::class, 'unregister'])->name('events.unregister');
    Route::get('/schedule', function () {
        return view('volunteer.schedule');
    })->name('view.schedule');

    // Chỉ định route JSON riêng cho FullCalendar
    Route::get('/api/my-events', [EventController::class, 'myEvents'])->name('api.my-events');
});

Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');





// route QR code
Route::get('/registerOrganization', [AuthController::class, 'showRegisterFormOrganization'])->name('register.organization.form');
Route::post('/registerOrganization', [AuthController::class, 'registerOrganization'])->name('register.organization');

//Các route CẦN đăng nhập
Route::middleware('auth:volunteer')->group(function () {
    Route::get('/editvolunteer', [Account::class, 'editvolunteerShow'])->name('volunteer.edit');
    Route::post('/result/{result}/comment/ajax', [CommentController::class, 'storeAjax'])->name('comment.store.ajax');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

// Organization authenticated routes
Route::middleware('auth:organization')->group(function () {
    Route::get('/editorganization', [Account::class, 'editorganizationShow'])->name('editorganzation.show');
    Route::post('/editorganization/{id}', [Account::class, 'editorganization'])->name('editorganization');
    Route::get('/dashboard', [OrganizationController::class, 'dashboard'])->name('organization.dashboard');

    // CRUD Event
    Route::get('/events/create',       [EventController::class, 'create'])->name('events.create');
    Route::post('/events',             [EventController::class, 'store'])->name('events.store');
    Route::get('/events/edit/{id}',    [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}',         [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}',      [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/organizations/events/{id}', [OrganizationController::class, 'viewEvents'])->name('view.events');
    Route::get('/organizations/results/{id}', [OrganizationController::class, 'viewResults'])->name('view.results');
    // Volunteer management
    Route::get('/events/{id}/volunteers/list', [EventController::class, 'getVolunteers'])->name('event.volunteerList');
    Route::get('/events/{id}/complete', [EventController::class, 'completeEvent'])->name('event.complete');

    // Notifications
    Route::prefix('notifications')->group(function () {
        Route::get('/send',      [NotificationController::class, 'sendEventView'])->name('notification.organization.send.event.view');
        Route::post('/send',     [NotificationController::class, 'sendEvent'])->name('notification.organization.send.event');
        Route::get('/view',      [NotificationController::class, 'received'])->name('notifications.organization.received');
        Route::get('/view-sent', [NotificationController::class, 'viewSentEvent'])->name('notification.organization.sent.event');
    });

    // Profile edit
    Route::get('/edit',         [Account::class, 'editorganizationShow'])->name('organization.edit.show');
    Route::post('/edit/{id}',   [Account::class, 'editorganization'])->name('organization.edit');

    // Avatar & Cover upload
    Route::post('/{id}/upload-cover',  [OrganizationController::class, 'uploadCover'])->name('organization.upload.cover');
    Route::post('/{id}/upload-avatar', [OrganizationController::class, 'uploadAvatar'])->name('organization.upload.avatar');
    Route::delete('/events/{event}/volunteers/{volunteer}', [OrganizationController::class, 'removeVolunteer'])->name('volunteer.remove');
    Route::post('/organizations/events/qrcode', [OrganizationController::class, 'createQrcode']);
});
Route::get('/list',             [OrganizationController::class, 'list'])->name('organization.list');
Route::get('/organization/{id}', [OrganizationController::class, 'detailOrganization'])->name('organization.detail');

Route::get('/registerOrganization', [AuthController::class, 'showRegisterFormOrganization'])->name('register.organization.form');
Route::post('/registerOrganization', [AuthController::class, 'registerOrganization'])->name('register.organization');


// Các route CẦN đăng nhập
Route::middleware('auth:volunteer')->group(function () {
    Route::get('/editvolunteer', [Account::class, 'editvolunteerShow'])->name('editvolunteer.show');
    Route::post('/editvolunteer/{id}', [Account::class, 'editvolunteer'])->name('editvolunteer');
    Route::get('/scan-qr', function () {
        return view('contents.scan_qr');
    })->name('scan.qr');
    Route::post('/api/check-in', [CheckInController::class, 'checkIn'])->name('check.in');

    Route::get('/volunteer/events/registered/{volunteerId}', [EventController::class, 'getRegisteredEvents'])
        ->name('volunteer.events.registered')
        ->middleware('auth:volunteer');
});

// ─── Public Organization & Volunteer Profiles ────────────
Route::get('/volunteer/{id}',    [VolunteerController::class,   'profile'])->name('volunteer.profile');
Route::get('/top',               [VolunteerController::class,   'topVolunteersLastQuarter'])->name('volunteer.top');


// Routes for both volunteers and organizations
Route::middleware('auth:volunteer,organization')->group(function () {
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
});
// Route để hiển thị form tạo sự kiện


//thay doi avatar và cover
Route::post('/organization/{id}/upload-cover', [OrganizationController::class, 'uploadCover']);
Route::post('/organization/{id}/upload-avatar', [OrganizationController::class, 'uploadAvatar']);
Route::post('/volunteer/{id}/upload-cover', [VolunteerController::class, 'uploadCover']);
Route::post('/volunteer/{id}/upload-avatar', [VolunteerController::class, 'uploadAvatar']);


Route::get('/list', [OrganizationController::class, 'list'])->name('organization.list');
Route::get('/organization/detail/{id}', [OrganizationController::class, 'detailOrganization'])->name('organization.detail');
Route::post('/organization/{id}/follow', [OrganizationController::class, 'follow'])->name('follow.organization');
Route::post('/organization/{id}/unfollow', [OrganizationController::class, 'unfollow'])->name('unfollow.organization');
Route::get('/volunteer/{id}/followed', [VolunteerController::class, 'listFollowed'])->name('volunteer.followed');

// Route quản lý tình ngyên viên tham gia sự kiện
Route::get('/events/{id}/volunteers/list', [EventController::class, 'getVolunteers'])->name('event.volunteerList');
Route::delete('/events/{event_id}/volunteers/{volunteer_id}', [OrganizationController::class, 'removeVolunteer'])->name('volunteer.remove');

//Route admin login
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// ─── Admin Organization & Event ───────────────────────────
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    // Organization
    Route::get('/', [HomeController::class, 'indexAdmin'])->name('admin.home');
    Route::get('/organizations/approved', [OrganizationController::class, 'getApproved']);
    Route::get('/organizations/pending',  [OrganizationController::class, 'getPending']);
    Route::get('/organizations/rejected', [OrganizationController::class, 'getRejected']);
    Route::get('/organizations/search',   [OrganizationController::class, 'search'])->name('admin.organizations.search');
    Route::post('/organizations/approve/{id}', [OrganizationController::class, 'approve'])->name('admin.organizations.approve');
    Route::post('/organizations/reject/{id}',  [OrganizationController::class, 'reject'])->name('admin.organizations.reject');
    Route::get('/organizations/{id}',          [OrganizationController::class, 'profile']);

    // Event
    Route::get('/events/pending',  [EventController::class, 'getPendingEvents']);
    Route::get('/events/approved', [EventController::class, 'indexAdmin'])->name('admin.events.approved');
    Route::get('/events/rejected', [EventController::class, 'getRejected']);
    Route::get('/events/search',   [EventController::class, 'search'])->name('admin.events.search');
    Route::get('/events/{id}',     [EventController::class, 'adminProfile']);
    Route::post('/events/approve/{id}', [EventController::class, 'approve'])->name('admin.events.approve');
    Route::post('/events/reject/{id}',  [EventController::class, 'reject'])->name('admin.events.reject');

    // Notifications
    Route::get('/notifications/send', [NotificationController::class, 'sendAdminView'])->name('notification.admin.send.view');
    Route::post('/notifications/send', [NotificationController::class, 'sendAsAdmin'])->name('notification.admin.send');
    Route::get('/notifications/view', [NotificationController::class, 'viewSentNotifications'])->name('notification.admin.view');
});

// ─── Result Routes ────────────────────────────────────────
Route::prefix('result')->group(function () {
    Route::get('/',               [ResultController::class, 'index'])->name('result.index');
    Route::get('/load-more',      [ResultController::class, 'loadMore'])->name('result.loadMore');
    Route::get('/create/{event}', [ResultController::class, 'create'])->name('result.create');
    Route::post('/store', [ResultController::class, 'store'])->name('result.store');
    Route::get('/edit/{id}',      [ResultController::class, 'edit'])->name('result.edit');
    Route::put('/update/{id}',    [ResultController::class, 'update'])->name('result.update');
    Route::delete('/delete/{id}', [ResultController::class, 'destroy'])->name('result.destroy');
    Route::get('/{id}',           [ResultController::class, 'show'])->name('result.show');
    Route::post('/{result}/comment', [CommentController::class, 'store'])->name('comment.store');
});

// ─── Search & QR Code ─────────────────────────────────────
Route::get('/attendance/qr/{event}/{volunteer}', [QrCodeController::class, 'generate'])->name('attendance.qr');
// Route cho chức năng follow
Route::get('/list', [OrganizationController::class, 'list'])->name('organization.list');

Route::get('/organization/{id}', [OrganizationController::class, 'detailOrganization'])->name('organization.detail');
Route::post('/organization/{id}/follow', [OrganizationController::class, 'follow'])->name('follow.organization');
Route::post('/organization/{id}/unfollow', [OrganizationController::class, 'unfollow'])->name('unfollow.organization');

Route::get('/volunteer/{id}/followed', [VolunteerController::class, 'listFollowed'])->name('volunteer.followed');


// Route quản lý tình ngyên viên tham gia sự kiện
Route::get('/events/{id}/volunteers/list', [EventController::class, 'getVolunteers'])->name('event.volunteerList');
Route::delete('/events/{event_id}/volunteers/{volunteer_id}', [OrganizationController::class, 'removeVolunteer'])->name('volunteer.remove');
