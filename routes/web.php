<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\About\AboutController;
use App\Models\About;
use App\Models\MultiImage;

Route::get('/', function () {
    return view('frontend/index');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::post('/admin/profile-update', 'adminProfileUpdate')->name('admin.update_admin_profile');
    Route::post('/admin/update-password', 'adminPasswordUpdate')->name('admin.update-password');
});

// home page 
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide', 'homeSlide')->name('home.slider');
    Route::post('/home/slider-update', 'updateSlider')->name('update.slider');
});
// about route 
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/about_page', 'aboutPage')->name('about.about_page');
    Route::post('/about/about_update', 'aboutUpdate')->name('about.about_update');
    Route::get('/about', 'aboutView')->name('about');
    Route::get('/about/multiimage', 'aboutMultiimage')->name('about.multiimage');
    Route::post('/about/store_multiImage', 'store_multiImage')->name('store.multiImg');
    Route::get('/about/view-multiple-image', 'allMultiImage')->name('about.all.multiimage');
});


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
