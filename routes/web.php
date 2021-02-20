<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontController@getSection');
Route::post('/get-image','FrontController@getGallery')->name('front.getGallery');

Route::prefix('admin')->middleware('auth')->group(function ()
{
    Route::get('/', function ()
    {
        return view('admin.index');
    });
    Route::prefix('slider')->group(function ()
    {
        Route::get('/', 'Admin\SliderController@sliderShow')->name('admin.slider');
        Route::post('/', 'Admin\SliderController@sliderAdd');
        Route::post('/delete', 'Admin\SliderController@sliderDelete')->name('admin.sliderDelete');
        Route::post('/change-status', 'Admin\SliderController@sliderChangeStatus')->name('admin.sliderChangeStatus');
        Route::post('/get', 'Admin\SliderController@sliderGetById')->name('admin.sliderGetById');
        Route::post('/update', 'Admin\SliderController@sliderUpdate')->name('admin.sliderUpdate');
        Route::post('/edit-order', 'Admin\SliderController@sliderEditOrder')->name('admin.sliderEditOrder');
    });

    Route::prefix('sub-slider')->group(function ()
    {
        Route::get('/', 'Admin\SubSliderController@subSliderShow')->name('admin.subSlider');
        Route::post('/', 'Admin\SubSliderController@subSliderAdd');
        Route::post('/delete', 'Admin\SubSliderController@subSliderDelete')->name('admin.subSliderDelete');
        Route::post('/change-status', 'Admin\SubSliderController@subSliderChangeStatus')->name('admin.subSliderChangeStatus');
        Route::post('/get', 'Admin\SubSliderController@subSliderGetById')->name('admin.subSliderGetById');
        Route::post('/update', 'Admin\SubSliderController@subSliderUpdate')->name('admin.subSliderUpdate');
        Route::post('/edit-order', 'Admin\SubSliderController@subSliderEditOrder')->name('admin.subSliderEditOrder');
    });

    Route::prefix('gallery')->group(function ()
    {
        Route::get('/', 'Admin\GalleryController@galleryShow')->name('admin.gallery');
        Route::post('/add', 'Admin\GalleryController@galleryAdd')->name('admin.galleryAdd');
        Route::post('/change-status', 'Admin\GalleryController@galleryChangeStatus')->name('admin.galleryChangeStatus');
        Route::post('/delete', 'Admin\GalleryController@galleryDelete')->name('admin.galleryDelete');
        Route::post('/get', 'Admin\GalleryController@galleryGetById')->name('admin.galleryGetById');
        Route::post('/update', 'Admin\GalleryController@galleryUpdate')->name('admin.galleryUpdate');
        Route::post('/edit-order', 'Admin\GalleryController@galleryEditOrder')->name('admin.galleryEditOrder');

        Route::prefix('sub')->group(function ()
        {
            Route::get('/{id}', 'Admin\GalleryController@subGalleryShow')->name('admin.subGallery');
            Route::post('/add', 'Admin\GalleryController@subGalleryAdd')->name('admin.subGalleryAdd');
            Route::post('/update', 'Admin\GalleryController@subGalleryUpdate')->name('admin.subGalleryUpdate');
            Route::post('/edit-order', 'Admin\GalleryController@subGalleryEditOrder')->name('admin.subGalleryEditOrder');
        });

    });

    Route::prefix('news')->group(function ()
    {
        Route::get('/', 'Admin\NewsController@newsShow')->name('admin.news');
        Route::get('/add-show','Admin\NewsController@newsAddShow')->name('admin.newsAddShow');
        Route::post('/add', 'Admin\NewsController@newsAdd')->name('admin.newsAdd');
        Route::get('/get/{id}', 'Admin\NewsController@newsGetById')->name('admin.newsGetById');
        Route::post('/update', 'Admin\NewsController@newsUpdate')->name('admin.newsUpdate');
        Route::post('/change-status', 'Admin\NewsController@newsChangeStatus')->name('admin.newsChangeStatus');
        Route::post('/delete', 'Admin\NewsController@newsDelete')->name('admin.newsDelete');
    });

});
