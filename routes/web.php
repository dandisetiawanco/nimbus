<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\SettingController;
use App\Models\Page;
use App\Models\Post;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

// Admin Panel Routes
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD routes relying on policies or generic permission middleware
    Route::resource('pages', PageController::class);
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('media', MediaController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('components', ComponentController::class);
    
    // Settings & Audit Logs (Admin only)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/audit-logs', [\App\Http\Controllers\AuditLogController::class, 'index'])->name('audit-logs.index');

    // Users & Roles (Admin only - simplified inline controller for this demo requirement)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
});

Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Frontend Routes

// Blog listing
Route::get('/blog', function() {
    $posts = Post::where('status', 'published')
                 ->where('published_at', '<=', now())
                 ->orderByDesc('published_at')
                 ->paginate(10);
    return view('public.blog', compact('posts'));
})->name('public.blog');

// Single Blog Post
Route::get('/blog/{slug}', function($slug) {
    $post = Post::where('slug', $slug)
                ->where('status', 'published')
                ->where('published_at', '<=', now())
                ->firstOrFail();
    return view('public.post', compact('post'));
})->name('public.post');

// Premium Welcome / Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Pages Fallback & Home
Route::fallback(function() {
    $slug = request()->path(); // e.g. "about" or "/"... wait, Laravel fallback gets path without leading slash
    if ($slug === '') { $slug = '/'; }
    $page = Page::where('slug', $slug)
                ->where('status', 'published')
                ->where('published_at', '<=', now())
                ->first();
    
    if (!$page) {
        if ($slug !== '/') abort(404);
        // default fallback if no / home page set
        return view('welcome');
    }
    return view('public.page', compact('page'));
});
