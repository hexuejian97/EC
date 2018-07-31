<?php
/**
 * Created by PhpStorm.
 * User: jiaojian
 * Date: 2018/2/27
 * Time: 下午10:21
 */
Route::post('uptoken', 'ServiceController@upToken')->name('upToken');
//新闻资讯
Route::get('/news/index', 'ServiceController@newsIndex')->name('news.index');
Route::get('/news/data', 'ServiceController@newsData')->name('news.data');
Route::get('/news/add', 'ServiceController@newsAdd')->name('news.add');
Route::post('/news/create', 'ServiceController@newsCreate')->name('news.create');
Route::get('/news/update/{id}', 'ServiceController@newsUpdate')->name('news.update');
Route::post('/news/edit', 'ServiceController@newsEdit')->name('news.edit');
Route::post('/news/delete', 'ServiceController@newsDelete')->name('news.delete');
Route::get('/news/info/{id}', 'ServiceController@newsInfo')->name('news.info');
Route::post('/news/top', 'ServiceController@newsTop')->name('news.top');
//新闻资讯类型
Route::get('/newstype/index', 'ServiceController@newsTypeIndex')->name('news_type.index');
Route::get('/newstype/data', 'ServiceController@newsTypeData')->name('news_type.data');
Route::get('/newstype/add', 'ServiceController@newsTypeAdd')->name('news_type.add');
Route::post('/newstype/create', 'ServiceController@newsTypeCreate')->name('news_type.create');
Route::post('/newstype/edit', 'ServiceController@newsTypeEdit')->name('news_type.edit');
Route::get('/newstype/update/{id}', 'ServiceController@newsTypeUpdate')->name('news_type.update');
Route::post('/newstype/delete', 'ServiceController@newsTypeDelete')->name('news_type.delete');


/**
 *媒体报道
 */
Route::get('/newtop/index', 'ServiceController@newtop')->name('newtop.index');
Route::get('/newtop/newtopdata', 'ServiceController@newtopdata')->name('newtop.newtopdata');


/**
 * 视频空间
 */
Route::any('/video/index', 'VideoController@index')->name('video.index');
Route::any('/video/getdata', 'VideoController@getdata')->name('video.getdata');
Route::any('/video/create', 'VideoController@create')->name('video.create');
Route::any('/video/info/{id}', 'VideoController@info')->name('video.info');
Route::any('/video/update/{id}', 'VideoController@update')->name('video.update');
Route::any('/video/edit', 'VideoController@edit')->name('video.edit');
Route::any('/video/delopty', 'VideoController@delopty')->name('video.delopty');

/**
 *活动模块
 */
Route::any('/activity/index', 'activityController@activityIndex')->name('activity.index');
Route::any('/activity/getdata', 'activityController@activitygetdata')->name('activity.getdata');
Route::any('/activity/create', 'activityController@activityAdd')->name('activity.create');
Route::any('/activity/info/{id}', 'activityController@activityinfo')->name('activity.info');
Route::any('/activity/delete', 'activityController@activityDelete')->name('activity.delete');
Route::any('/activity/edit', 'activityController@activityedit')->name('activity.edit');

Route::any('/activity/update/{id}', 'activityController@activityupdate')->name('activity.update');
/**
 *用户管理
 */
Route::any('/users/index', 'UsersController@index')->name('users.index');
Route::any('/users/getdata', 'UsersController@getdata')->name('users.getdata');
Route::any('/users/info/{id}', 'UsersController@info')->name('users.info');


/*
最新新闻
*/
Route::get('/latestnews/index', 'ServiceController@latestnewsIndex')->name('latestnews.index');
Route::get('/latestnews/data', 'ServiceController@latestnewsData')->name('latestnews.data');
Route::get('/latestnews/add', 'ServiceController@latestnewsAdd')->name('latestnews.add');
Route::post('/latestnews/create', 'ServiceController@latestnewsCreate')->name('latestnews.create');
Route::get('/latestnews/update/{id}', 'ServiceController@latestnewsUpdate')->name('latestnews.update');
Route::post('/latestnews/edit', 'ServiceController@latestnewsEdit')->name('latestnews.edit');
Route::post('/latestnews/delete', 'ServiceController@latestnewsDelete')->name('latestnews.delete');
/*
*赛事管理
*/

