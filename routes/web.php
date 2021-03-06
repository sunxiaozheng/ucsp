<?php

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

/**
 * 前端
 */
Route::group(['namespace' => 'Home'], function() {
    // 首页
    Route::get('/', 'IndexController@index');

    // 限制学科本周的上课节数
    Route::get('lmtcoursebysubj', 'IndexController@limitCourseBySubject');

    // 限制教师当天的上课节数
    Route::get('lmttechdailycoursenum', 'IndexController@limitTeacherDailyCourseNumber');

    // 科目互斥
    Route::get('chksubjmutex', 'IndexController@chkSubjectMutex');

    // 禁止科目相邻
    Route::get('coursenotnextto', 'IndexController@courseNotNextTo');

    // 教师当天的课分散排列
    Route::get('coursediv', 'IndexController@courseDevide');

    // 上午末节下午首节不能为同一个老师
    Route::get('amnotnexttopm', 'IndexController@amNotNextToPm');
});
