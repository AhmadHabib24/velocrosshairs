<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CrosshairController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CrossChairController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BackgroundImagesController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\BlogCategoryController as AdminBlogCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\BlogController;




Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        return 'Storage link created successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->name('storage.link');
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [HomeController::class, 'about'])->name(name: 'about-us');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/privacy-policy', [HomeController::class, 'PrivacyPolicy'])->name('Privacy-Policy');

// Blogs routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// Crosshairs routes
Route::prefix('crosshairs')->group(function () {


    Route::get('/', [CrosshairController::class, 'index'])->name('crosshairs.index');
    Route::get('/categories', [CrosshairController::class, 'categories'])->name('crosshairs.categories');
    Route::get('/create', [CrosshairController::class, 'create'])->name('crosshairs.create');
    Route::post('/{id}/copy', [CrosshairController::class, 'copy'])->name('crosshairs.copy');
    Route::get('/{slug}', [CrosshairController::class, 'show'])->name('crosshairs.show');
});





// Community routes
Route::prefix('community')->group(function () {
    Route::get('/', [CommunityController::class, 'index'])->name('community.index');
    Route::get('/leaderboard', [CommunityController::class, 'leaderboard'])->name('community.leaderboard');
});

// Profile routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/downloads', [ProfileController::class, 'downloads'])->name('profile.downloads');

    // User Dashboard Route
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/crosshair/submit', [UserDashboardController::class, 'store'])->name('user.crosshair.store');
});

// Redirect old download route to crosshairs
Route::redirect('/download', '/crosshairs', 301);

Auth::routes();

Route::redirect('/home', '/', 301);


Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/contacts-us', [DashboardController::class, 'contactindex'])->name('contacts.index');
    Route::get('/contacts/{id}', [DashboardController::class, 'getContactDetails'])->name('contacts.show');
    Route::post('/contacts/{id}/mark-read', [DashboardController::class, 'markAsRead'])->name('contacts.markAsRead');
    Route::post('/contacts/{id}/mark-replied', [DashboardController::class, 'markAsReplied'])->name('contacts.markAsReplied');
    Route::post('/contacts/{id}/archive', [DashboardController::class, 'archiveContact'])->name('contacts.archive');
    Route::delete('/contacts/{id}', [DashboardController::class, 'deleteContact'])->name('contacts.delete');
    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [NotificationController::class, 'getUnread'])->name('notifications.unread');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');

    Route::get('/emails/unread', [App\Http\Controllers\Admin\EmailLogController::class, 'unread'])->name('emails.unread');
    Route::get('/emails/{id}', [App\Http\Controllers\Admin\EmailLogController::class, 'show'])->name('emails.show');
    Route::post('/emails/read-all', [App\Http\Controllers\Admin\EmailLogController::class, 'readAll'])->name('emails.readAll');

    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    Route::prefix('CrossChairbg')->name('CrossChairbg.')->group(function () {
        Route::get('/', [BackgroundImagesController::class, 'index'])->name('index');
        Route::get('/categories', [BackgroundImagesController::class, 'categories'])->name('categories');
        Route::get('/create', [BackgroundImagesController::class, 'create'])->name('create');
        Route::post('/', [BackgroundImagesController::class, 'store'])->name('store');
        Route::get('/{id}', [BackgroundImagesController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BackgroundImagesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BackgroundImagesController::class, 'update'])->name('update');
        Route::delete('/{id}', [BackgroundImagesController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/copy', [BackgroundImagesController::class, 'copy'])->name('copy');
    });
});
// Categories Routes - All Individual
Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::post('admin/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('admin.categories.toggle-status');

// CrossChair Routes 
// CrossChair Routes (inside admin middleware group)
Route::get('admin/CrossChair', [CrossChairController::class, 'index'])->name('admin.CrossChair.index');
Route::post('admin/CrossChair', [CrossChairController::class, 'store'])->name('admin.CrossChair.store');
Route::get('admin/CrossChair/{id}/edit', [CrossChairController::class, 'edit'])->name('admin.CrossChair.edit');
Route::put('admin/CrossChair/{id}', [CrossChairController::class, 'update'])->name('admin.CrossChair.update');
Route::delete('admin/CrossChair/{id}', [CrossChairController::class, 'destroy'])->name('admin.CrossChair.destroy');
Route::post('admin/CrossChair/{id}/toggle-status', [CrossChairController::class, 'toggleStatus'])->name('admin.CrossChair.toggle-status');

// Blog Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::resource('blog-categories', AdminBlogCategoryController::class);
    Route::resource('tags', AdminTagController::class);
    Route::resource('blogs', AdminBlogController::class);
});