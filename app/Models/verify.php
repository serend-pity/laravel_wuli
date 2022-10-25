<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class verify extends Model
{
    protected $table = 'verify';

    protected $guarded = [];
    public $timestamps = true;

    public static function Verify($teacher_id,$verify,$teacher_name){
        try{
            $res = self::create([
                'teacher_id' => $teacher_id,
                'verify' => $verify,
                'teacher_name' => $teacher_name,
            ]);
            return $res;
        }catch (\Exception $exception){
            logError('插入失败！',[$exception->getMessage()]);
            echo $exception->getMessage();
            return false;
        }
    }
}
