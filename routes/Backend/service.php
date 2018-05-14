<?php
/**
 * Created by PhpStorm.
 * User: jiaojian
 * Date: 2018/2/27
 * Time: 下午10:21
 */
//连锁店信息
Route::post('uptoken', 'ServiceController@upToken')->name('upToken');

Route::get('/store/index', 'ServiceController@storeIndex')->name('store.index');
Route::get('/store/data', 'ServiceController@storeData')->name('store.data');
Route::get('/store/add', 'ServiceController@storeAdd')->name('store.add');
Route::post('/store/create', 'ServiceController@storeCreate')->name('store.create');
Route::get('/store/update/{id}', 'ServiceController@storeUpdate')->name('store.update');
Route::post('/store/edit', 'ServiceController@storeEdit')->name('store.edit');
Route::post('/store/delete', 'ServiceController@storeDelete')->name('store.delete');
Route::get('/store/info/{id}', 'ServiceController@storeInfo')->name('store.info');
Route::post('/traffic/edit', 'ServiceController@trafficEdit')->name('traffic.edit');
Route::post('/traffic/create', 'ServiceController@trafficCreate')->name('traffic.create');
Route::post('/traffic/delete', 'ServiceController@trafficDelete')->name('traffic.delete');
//医师信息
Route::get('/physician/index', 'ServiceController@physicianIndex')->name('physician.index');
Route::get('/physician/data', 'ServiceController@physicianData')->name('physician.data');
Route::get('/physician/add', 'ServiceController@physicianAdd')->name('physician.add');
Route::post('/physician/create', 'ServiceController@physicianCreate')->name('physician.create');
Route::get('/physician/update/{id}', 'ServiceController@physicianUpdate')->name('physician.update');
Route::post('/physician/edit', 'ServiceController@physicianEdit')->name('physician.edit');
Route::post('/physician/delete', 'ServiceController@physicianDelete')->name('physician.delete');
Route::get('/physician/info/{id}', 'ServiceController@physicianInfo')->name('physician.info');
Route::post('/physician/hot', 'ServiceController@physicianHot')->name('physician.hot');
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
//服务项目
Route::get('/project/index', 'ServiceController@projectIndex')->name('project.index');
Route::get('/project/data', 'ServiceController@projectData')->name('project.data');
Route::get('/project/add', 'ServiceController@projectAdd')->name('project.add');
Route::post('/project/create', 'ServiceController@projectCreate')->name('project.create');
Route::get('/project/update/{id}', 'ServiceController@projectUpdate')->name('project.update');
Route::post('/project/edit', 'ServiceController@projectEdit')->name('project.edit');
Route::post('/project/delete', 'ServiceController@projectDelete')->name('project.delete');
Route::get('/project/info/{id}', 'ServiceController@projectInfo')->name('project.info');
//新闻资讯类型
Route::get('/newstype/index', 'ServiceController@newsTypeIndex')->name('news_type.index');
Route::get('/newstype/data', 'ServiceController@newsTypeData')->name('news_type.data');
Route::get('/newstype/add', 'ServiceController@newsTypeAdd')->name('news_type.add');
Route::post('/newstype/create', 'ServiceController@newsTypeCreate')->name('news_type.create');
Route::post('/newstype/edit', 'ServiceController@newsTypeEdit')->name('news_type.edit');
Route::get('/newstype/update/{id}', 'ServiceController@newsTypeUpdate')->name('news_type.update');
Route::post('/newstype/delete', 'ServiceController@newsTypeDelete')->name('news_type.delete');
//医师职称
//服务项目
Route::get('/phytype/index', 'ServiceController@phyTypeIndex')->name('phy_type.index');
Route::get('/phytype/data', 'ServiceController@phyTypeData')->name('phy_type.data');
Route::get('/phytype/add', 'ServiceController@phyTypeAdd')->name('phy_type.add');
Route::post('/phytype/create', 'ServiceController@phyTypeCreate')->name('phy_type.create');
Route::get('/phytype/update/{id}', 'ServiceController@phyTypeUpdate')->name('phy_type.update');
Route::post('/phytype/edit', 'ServiceController@phyTypeEdit')->name('phy_type.edit');
Route::post('/phytype/delete', 'ServiceController@phyTypeDelete')->name('phy_type.delete');

//服务项目
Route::get('/storetype/index', 'ServiceController@storeTypeIndex')->name('store_type.index');
Route::get('/storetype/data', 'ServiceController@storeTypeData')->name('store_type.data');
Route::get('/storetype/add', 'ServiceController@storeTypeAdd')->name('store_type.add');
Route::post('/storetype/create', 'ServiceController@storeTypeCreate')->name('store_type.create');
Route::get('/storetype/update/{id}', 'ServiceController@storeTypeUpdate')->name('store_type.update');
Route::post('/storetype/edit', 'ServiceController@storeTypeEdit')->name('store_type.edit');
Route::post('/storetype/delete', 'ServiceController@storeTypeDelete')->name('store_type.delete');
