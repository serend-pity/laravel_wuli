<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class danbai extends Model
{
    protected $table = 'danbai';
    protected $guarded = [];
    public $timestamps = true;

    public static function check_one($class)
    {
        try {
            $res = self::select('danbai.class as 班级', 'danbai.account as 学号', 'danbai.grade_xtp as 选判题得分', 'danbai.grade_py as 非选判题得分', 'danbai.Grade as 总分')->where('class', $class)->get();
            return $res;
        } catch (\Exception $exception) {
            logError('获取失败！', [$exception->getMessage()]);
            echo $exception->getMessage();
            return false;
        }
    }
    public static function Py($account){
        try{
            $res = self::select('py')->where('account',$account)->get();
            return $res;
        }catch (\Exception $exception) {
            logError('获取失败！', [$exception->getMessage()]);
            echo $exception->getMessage();
            return false;
        }
    }

}

