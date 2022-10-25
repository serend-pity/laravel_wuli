<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Teacher extends  Authenticatable implements JWTSubject
{
    protected $table = 'teacher';
    protected $guarded = [];
    public $timestamps = true;

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }


    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }
    public static function creteTeache($reques)
    {
        $re=self::create([
            'teacher_id'=> $reques['teacher_id'],
            'password'=>$reques['password'],

        ]);
        return $re;
    }

    /**
     * @param $password3
     * @param $teacher_id
     * @return false|int
     * 教师修改密码
     */

    public static function update_teacher($teacher_id,$password3){
        try{
            $res =DB::table('teacher')->where('teacher_id',  $teacher_id)->update([
                'password' => $password3,
            ]);
            return $res;
        } catch (\Exception $e){
            logError('修改密码失败！',[$e->getMessage()]);
            echo $e->getMessage();
            return false;
        }
    }


}

