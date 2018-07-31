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

<<<<<<< HEAD
=======
/**
 * 解疑服务
 */
Route::get('/problem/index', 'ServiceController@problem')->name('problem.index');
Route::get('/problem/problemdata', 'ServiceController@problemdata')->name('problem.problemdata');
/**
 * 人气医师
 */
/*Route::get('/physhot/index', 'ServiceController@physhot')->name('physhot.index');
Route::get('/physhot/physhotdata', 'ServiceController@physhotdata')->name('physhot.physhotdata');*/
/**
 * 快速入口 - 视光检查
 */
Route::any('/optometry/index', 'OptometryController@index')->name('optometry.index');
Route::any('/optometry/getdata', 'OptometryController@getdata')->name('optometry.getdata');
Route::any('/optometry/create', 'OptometryController@create')->name('optometry.create');
Route::any('/optometry/info/{id}', 'OptometryController@info')->name('optometry.info');
Route::any('/optometry/update/{id}', 'OptometryController@update')->name('optometry.update');
Route::any('/optometry/edit', 'OptometryController@edit')->name('optometry.edit');
Route::any('/optometry/delopty', 'OptometryController@delopty')->name('optometry.delopty');
>>>>>>> bde2147ec0d58b153e8ebf721fb0035dd5582f9a

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
<<<<<<< HEAD
=======
 * 服务项目管理 -菜单管理
 */
Route::any('/service_menu/index', 'ServiceMenuController@index')->name('service_menu.index');
Route::any('/service_menu/getdata', 'ServiceMenuController@getdata')->name('service_menu.getdata');
Route::any('/service_menu/create', 'ServiceMenuController@create')->name('service_menu.create');
Route::any('/service_menu/info/{id}', 'ServiceMenuController@info')->name('service_menu.info');
Route::any('/service_menu/update/{id}', 'ServiceMenuController@update')->name('service_menu.update');
Route::any('/service_menu/edit', 'ServiceMenuController@edit')->name('service_menu.edit');
Route::any('/service_menu/delopty', 'ServiceMenuController@delopty')->name('service_menu.delopty');
/**
 * 服务项目-项目管理
 */
Route::any('/service_project/index', 'ServiceProjectController@index')->name('service_project.index');
Route::any('/service_project/getdata', 'ServiceProjectController@getdata')->name('service_project.getdata');
Route::any('/service_project/create', 'ServiceProjectController@create')->name('service_project.create');
Route::any('/service_project/info/{id}', 'ServiceProjectController@info')->name('service_project.info');
Route::any('/service_project/update/{id}', 'ServiceProjectController@update')->name('service_project.update');
Route::any('/service_project/edit', 'ServiceProjectController@edit')->name('service_project.edit');
Route::any('/service_project/delopty', 'ServiceProjectController@delopty')->name('service_project.delopty');
/**
* 特色技术-菜单管理
*/
Route::any('/characteristic_menu/index', 'CharacteristicMenuController@index')->name('characteristic_menu.index');
Route::any('/characteristic_menu/getdata', 'CharacteristicMenuController@getdata')->name('characteristic_menu.getdata');
Route::any('/characteristic_menu/create', 'CharacteristicMenuController@create')->name('characteristic_menu.create');
Route::any('/characteristic_menu/info/{id}', 'CharacteristicMenuController@info')->name('characteristic_menu.info');
Route::any('/characteristic_menu/update/{id}', 'CharacteristicMenuController@update')->name('characteristic_menu.update');
Route::any('/characteristic_menu/edit', 'CharacteristicMenuController@edit')->name('characteristic_menu.edit');
Route::any('/characteristic_menu/delopty', 'CharacteristicMenuController@delopty')->name('characteristic_menu.delopty');
/**
 * 特色技术-项目管理
 */
Route::any('/characteristic_project/index', 'CharacteristicProjectController@index')->name('characteristic_project.index');
Route::any('/characteristic_project/getdata', 'CharacteristicProjectController@getdata')->name('characteristic_project.getdata');
Route::any('/characteristic_project/create', 'CharacteristicProjectController@create')->name('characteristic_project.create');
Route::any('/characteristic_project/info/{id}', 'CharacteristicProjectController@info')->name('characteristic_project.info');
Route::any('/characteristic_project/update/{id}', 'CharacteristicProjectController@update')->name('characteristic_project.update');
Route::any('/characteristic_project/edit', 'CharacteristicProjectController@edit')->name('characteristic_project.edit');
Route::any('/characteristic_project/delopty', 'CharacteristicProjectController@delopty')->name('characteristic_project.delopty');
/**
 * 产品咨迅-营销活动
 */
Route::any('/product/index', 'ProductController@index')->name('product.index');
Route::any('/product/getdata', 'ProductController@getdata')->name('product.getdata');
Route::any('/product/create', 'ProductController@create')->name('product.create');
Route::any('/product/info/{id}', 'ProductController@info')->name('product.info');
Route::any('/product/update/{id}', 'ProductController@update')->name('product.update');
Route::any('/product/edit', 'ProductController@edit')->name('product.edit');
Route::any('/product/delopty', 'ProductController@delopty')->name('product.delopty');
/**
 * 产品咨迅-视光相关
 */
Route::any('/eyesvideo/index', 'EyesVideoController@index')->name('eyesvideo.index');
Route::any('/eyesvideo/getdata', 'EyesVideoController@getdata')->name('eyesvideo.getdata');
Route::any('/eyesvideo/create', 'EyesVideoController@create')->name('eyesvideo.create');
Route::any('/eyesvideo/info/{id}', 'EyesVideoController@info')->name('eyesvideo.info');
Route::any('/eyesvideo/update/{id}', 'EyesVideoController@update')->name('eyesvideo.update');
Route::any('/eyesvideo/edit', 'EyesVideoController@edit')->name('eyesvideo.edit');
Route::any('/eyesvideo/delopty', 'EyesVideoController@delopty')->name('eyesvideo.delopty');
/**
>>>>>>> bde2147ec0d58b153e8ebf721fb0035dd5582f9a
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

