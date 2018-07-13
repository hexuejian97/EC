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
//门店预约
Route::post('/store/order','ServiceController@storeOrder')->name('store.order');
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
//医师预约
Route::post('/physician/order','ServiceController@physicianOrder')->name('physician.order');

/**
 * 排班信息
 */
Route::any('/paib/paibdata', 'ServiceController@paibdata')->name('paib.paibdata');
Route::any('/paib/create/{id}', 'ServiceController@createpaib')->name('paib.create');
Route::any('/paib/addpaibdata', 'ServiceController@addpaibdata')->name('paib.addpaibdata');

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
/**
 *特色案例入口
 */
Route::get('/teser/index', 'ServiceController@teser')->name('teser.index');
Route::get('/teser/teserdata', 'ServiceController@teserdata')->name('teser.teserdata');
/**
 *媒体报道
 */
Route::get('/media/index', 'ServiceController@media')->name('media.index');
Route::get('/media/mediadata', 'ServiceController@mediadata')->name('media.mediadata');

/**
 * 解疑服务
 */
Route::get('/problem/index', 'ServiceController@problem')->name('problem.index');
Route::get('/problem/problemdata', 'ServiceController@problemdata')->name('problem.problemdata');
/**
 * 人气医师
 */
Route::get('/physhot/index', 'ServiceController@physhot')->name('physhot.index');
Route::get('/physhot/physhotdata', 'ServiceController@physhotdata')->name('physhot.physhotdata');
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

/**
 * 快速入口 - 特色服务
 */
Route::any('/special/index', 'SpecialController@index')->name('special.index');
Route::any('/special/getdata', 'SpecialController@getdata')->name('special.getdata');
Route::any('/special/create', 'SpecialController@create')->name('special.create');
Route::any('/special/info/{id}', 'SpecialController@info')->name('special.info');
Route::any('/special/update/{id}', 'SpecialController@update')->name('special.update');
Route::any('/special/edit', 'SpecialController@edit')->name('special.edit');
Route::any('/special/delopty', 'SpecialController@delopty')->name('special.delopty');
/**
 * 快速入口 - 视频空间
 */
Route::any('/video/index', 'VideoController@index')->name('video.index');
Route::any('/video/getdata', 'VideoController@getdata')->name('video.getdata');
Route::any('/video/create', 'VideoController@create')->name('video.create');
Route::any('/video/info/{id}', 'VideoController@info')->name('video.info');
Route::any('/video/update/{id}', 'VideoController@update')->name('video.update');
Route::any('/video/edit', 'VideoController@edit')->name('video.edit');
Route::any('/video/delopty', 'VideoController@delopty')->name('video.delopty');
/**
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
 *在线留言
 */
Route::any('/message/index', 'MessageController@index')->name('message.index');
Route::any('/message/getdata', 'MessageController@getdata')->name('message.getdata');
Route::any('/message/create', 'MessageController@create')->name('message.create');
Route::any('/message/info/{id}', 'MessageController@info')->name('message.info');
Route::any('/message/delopty', 'MessageController@delopty')->name('message.delopty');

/**
 *会员管理
 */
Route::any('/users/index', 'UsersController@index')->name('users.index');
Route::any('/users/getdata', 'UsersController@getdata')->name('users.getdata');
Route::any('/users/info/{id}', 'UsersController@info')->name('users.info');

