<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowClass extends Model
{
    protected $table = 'teacher_class';
    protected $guarded = [];
    public $timestamps = true;

    public static function SClass($teacher_id){
        try{
            $res = self::where('teacher_id',$teacher_id)->select('class')->get()->values('class');
            return $res;
        }catch (\Exception $exception){
            logError('查找失败！',[$exception->getMessage()]);
            echo $exception->getMessage();
            return false;}
    }
}
