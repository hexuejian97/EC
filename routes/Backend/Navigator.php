<?php
/**
 * Created by PhpStorm.
 * User: jiaojian
 * Date: 2018/3/16
 * Time: 下午3:56
 */
Route::get('/first/index','NavigatorController@firstIndex')->name('first.index');
Route::get('/first/data','NavigatorController@firstData')->name('first.data');
Route::get('/first/add','NavigatorController@firstAdd')->name('first.add');
Route::post('/first/create','NavigatorController@firstCreate')->name('first.create');
Route::get('/first/update/{id}','NavigatorController@firstUpdate')->name('first.update');
Route::post('/first/edit','NavigatorController@firstEdit')->name('first.edit');
Route::post('/first/delete','NavigatorController@firstDelete')->name('first.delete');

Route::get('/second/add/{id}','NavigatorController@secondAdd')->name('second.add');

Route::post('/second/create','NavigatorController@secondCreate')->name('second.create');
Route::get('/second/update/{id}','NavigatorController@secondUpdate')->name('second.update');
Route::post('/second/edit','NavigatorController@secondEdit')->name('second.edit');
Route::post('/second/delete','NavigatorController@secondDelete')->name('second.delete');
