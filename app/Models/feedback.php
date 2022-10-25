<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class feedback extends Model
{

    protected $table = 'feedback';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    public $timestamps = true;

    public static function teacher_feedback($teacher_id,$feedback){
        try{
            $res = self::create([
                'teacher_id' => $teacher_id,
                'feedback' => $feedback,
            ]);
            return $res;
        }catch (\Exception $exception){
            logError('插入失败！',[$exception->getMessage()]);
            echo $exception->getMessage();
            return false;
        }
    }

}
