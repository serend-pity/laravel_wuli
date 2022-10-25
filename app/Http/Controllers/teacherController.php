<?php

namespace App\Http\Controllers;


use App\Models\danbai;
use App\Models\feedback;
use App\Models\oumu;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use App\Models\ShowClass;
use App\Models\Teacher;
use App\Models\verify;

use Illuminate\Http\Request;



class teacherController extends Controller
{

    private static function userhandle($request)//加密账号
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        return $registeredInfo;
    }

    /**
     * 测试的注册账号
     */
    public function res(Request $request)
    {
        $date = Teacher::creteTeache(self::userhandle($request));
        return $date ?
            json_success("增加成功",$date,200):
            json_fail("增加失败",null,100);



    }

    /**登录账号
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function teacher_login(Request $request)
    {
        $credentials =self::credentials($request);
        $token = auth('api')->attempt($credentials);//获取token

        return $token ?
            json_success('登录成功!', $token, 200) :
            json_fail('登录失败!账号或密码错误', null, 100);

    }
    protected static function credentials($request)//从前端获取账号密码
    {
        return ['teacher_id'=>$request['teacher_id'],'password'=>$request['password']];
    }


    /**
     * 教师端修改密码
     */
    public static function teaupdate(Request $Request)
    {
        $teacher_id = auth('api')->user()->teacher_id;
        $newpassword = $Request['password'];
        $password3 = self::userHandleUpdate($newpassword);
        $res = Teacher::update_teacher($teacher_id,$password3);
        return $res ?
            json_success('修改成功!', $res, 200) :
            json_fail('修改失败!', null, 100);
    }


    //对密码进行哈希256加密
    protected static function userHandleUpdate($newpassword)
    {
        $red = bcrypt($newpassword);
        return $red;
    }


    /**
     * 教师提交反馈意见
     */

    public static function feedba(Request $request){
        $teacher_id = auth('api')->user()->teacher_id;
        $feedback = $request['feedback'];
        $res = feedback::teacher_feedback($teacher_id,$feedback);
        return $res ?
            json_success('插入成功!', $res, 200) :
            json_fail('插入失败!', null, 100);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 教师添加注册验证码
     */
    public static function verify(Request $request){
        $verify = $request['verify'];
        $teacher_name = $request['teacher_name'];
        $teacher_id = auth('api')->user()->teacher_id;
        $res = verify::Verify($teacher_id,$verify,$teacher_name);
        return $res ?
            json_success('插入成功!', $res, 200) :
            json_fail('插入失败!', null, 100);
    }


    /**
     * 显示教师管理的班级
     */
    public static function showClass(Request $request){
        $teacher_id = auth('api')->user()->teacher_id;
        $res = ShowClass::SClass($teacher_id);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);

    }

    public static function Review(Request $request){
        $experiment_name = $request['experiment_name'];
        $account = $request['account'];

        if($experiment_name == 'danbai' ){
            $res = danbai::Py($account) ;
        }elseif ($experiment_name == 'oumu'){
            $res = oumu::Py($account);
        }elseif ($experiment_name == 'shiboqi'){
            $res = '无须教师批阅的题目';
        }elseif ($experiment_name == 'zizu'){
            $res = '无须教师批阅的题目';
        }
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);

    }

}
