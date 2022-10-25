<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zizu extends Model
{
    protected $table = 'zizu';
    protected $guarded = [];
    public $timestamps = true;


    public static function check_one($class)
    {
        try {
            $res = self::select('class as 班级', 'account as 学号', 'grade_xtp as 选判题得分', 'grade_py as 非选判题得分', 'Grade as 总分')->where('class', $class)->get();
            return $res;
        } catch (\Exception $exception) {
            logError('获取失败！', [$exception->getMessage()]);
            echo $exception->getMessage();
            return false;
        }
    }
}
