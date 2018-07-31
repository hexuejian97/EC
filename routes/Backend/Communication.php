<?php
//在线预约
Route::get('/order/index', 'CommunicationController@orderIndex')->name('order.index');
Route::get('/order/data', 'CommunicationController@orderData')->name('order.data');
Route::get('/order/add', 'CommunicationController@orderAdd')->name('order.add');
Route::post('/order/create', 'CommunicationController@orderCreate')->name('order.create');
Route::get('/order/update/{id}', 'CommunicationController@orderUpdate')->name('order.update');
Route::post('/order/edit', 'CommunicationController@orderEdit')->name('order.edit');
Route::post('/order/delete', 'CommunicationController@orderDelete')->name('order.delete');

//question
Route::get('/question/index', 'CommunicationController@questionIndex')->name('question.index');
Route::get('/question/data', 'CommunicationController@questionData')->name('question.data');
Route::get('/question/add', 'CommunicationController@questionAdd')->name('question.add');
Route::post('/question/create', 'CommunicationController@questionCreate')->name('question.create');
Route::get('/question/update/{id}', 'CommunicationController@questionUpdate')->name('question.update');
Route::post('/question/edit', 'CommunicationController@questionEdit')->name('question.edit');
Route::post('/question/delete', 'CommunicationController@questionDelete')->name('question.delete');

//ask
//question
Route::get('/ask/index', 'CommunicationController@askIndex')->name('ask.index');
Route::get('/ask/data', 'CommunicationController@askData')->name('ask.data');
Route::get('/ask/add', 'CommunicationController@askAdd')->name('ask.add');
Route::post('/ask/create', 'CommunicationController@askCreate')->name('ask.create');
Route::get('/ask/update/{id}', 'CommunicationController@askUpdate')->name('ask.update');
Route::post('/ask/edit', 'CommunicationController@askEdit')->name('ask.edit');
Route::post('/ask/delete', 'CommunicationController@askDelete')->name('ask.delete');
Route::post('/ask/hot', 'CommunicationController@askHot')->name('ask.hot');
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
