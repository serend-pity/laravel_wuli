<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('re','teacherController@res');//测试注册
Route::post('teacher/login','teacherController@teacher_login');//测试denglu
Route::post('teacher/update_password','teacherController@teaupdate'); //教师修改密码
Route::post('teacher/feedback','teacherController@feedba');//教师反馈意见
Route::post('teacher/update_verify','teacherController@verify');//教师提交验证码
Route::get('teacher/myclass','teacherController@showClass'); //教师管理班级
Route::get('teacher/excel','GradeController@export');//导出excel
Route::post('teacher/review','teacherController@Review');//教师提交验证码

