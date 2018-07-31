<?php
//question
Route::get('/carousel/index', 'CommunicationController@carouselIndex')->name('carousel.index');
Route::get('/carousel/data', 'CommunicationController@carouselData')->name('carousel.data');
Route::get('/carousel/add', 'CommunicationController@carouselAdd')->name('carousel.add');
Route::post('/carousel/create', 'CommunicationController@carouselCreate')->name('carousel.create');
Route::get('/carousel/update/{id}', 'CommunicationController@carouselUpdate')->name('carousel.update');
Route::post('/carousel/edit', 'CommunicationController@carouselEdit')->name('carousel.edit');
Route::post('/carousel/delete', 'CommunicationController@carouselDelete')->name('carousel.delete');
//hotspot
Route::get('/hotspot/index', 'CommunicationController@hotspotIndex')->name('hotspot.index');
Route::get('/hotspot/data', 'CommunicationController@hotspotData')->name('hotspot.data');
Route::get('/hotspot/add', 'CommunicationController@hotspotAdd')->name('hotspot.add');
Route::post('/hotspot/create', 'CommunicationController@hotspotCreate')->name('hotspot.create');
Route::get('/hotspot/update/{id}', 'CommunicationController@hotspotUpdate')->name('hotspot.update');
Route::post('/hotspot/edit', 'CommunicationController@hotspotEdit')->name('hotspot.edit');
Route::post('/hotspot/delete', 'CommunicationController@hotspotDelete')->name('hotspot.delete');
//latestnews
Route::get('/latestnews/index', 'CommunicationController@latestnewsIndex')->name('latestnews.index');
Route::get('/latestnews/data', 'CommunicationController@latestnewsData')->name('latestnews.data');
Route::get('/latestnews/add', 'CommunicationController@latestnewsAdd')->name('latestnews.add');
Route::post('/latestnews/create', 'CommunicationController@latestnewsCreate')->name('latestnews.create');
Route::get('/latestnews/update/{id}', 'CommunicationController@latestnewsUpdate')->name('latestnews.update');
Route::post('/latestnews/edit', 'CommunicationController@latestnewsEdit')->name('latestnews.edit');
Route::post('/latestnews/delete', 'CommunicationController@latestnewsDelete')->name('latestnews.delete');
