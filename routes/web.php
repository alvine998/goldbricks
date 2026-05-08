<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

// ─── SEO ────────────────────────────────────────────────────────────────────
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// ─── Public Website ────────────────────────────────────────────────────────
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/project', [FrontController::class, 'project'])->name('project');
Route::get('/project/{slug}', [FrontController::class, 'projectShow'])->name('project.show');
Route::get('/property/{slug}', [FrontController::class, 'propertyShow'])->name('property.show');
Route::get('/gallery', [FrontController::class, 'gallery'])->name('gallery');
Route::get('/articles', [FrontController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [FrontController::class, 'articleShow'])->name('articles.show');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');

// ─── Admin Auth ────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Settings (menu labels + site info)
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Pages content
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{slug}', [PageController::class, 'update'])->name('pages.update');

        // Projects CRUD
        Route::resource('projects', ProjectController::class)->names('projects');

        // Properties CRUD (nested under projects)
        Route::get('/projects/{projectSlug}/properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('/projects/{projectSlug}/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/projects/{projectSlug}/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/projects/{projectSlug}/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/projects/{projectSlug}/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/projects/{projectSlug}/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

        // Gallery CRUD
        Route::resource('galleries', GalleryController::class)->names('galleries');

        // Organization CRUD
        Route::resource('organizations', OrganizationController::class)->names('organizations');

        // Agents CRUD
        Route::resource('agents', AgentController::class)->names('agents');

        // Banks CRUD
        Route::resource('banks', BankController::class)->names('banks');

        // Testimonials CRUD
        Route::resource('testimonials', TestimonialController::class)->names('testimonials');

        // Articles CRUD
        Route::resource('articles', ArticleController::class)->names('articles');
    });
});
