<?php

namespace App\Http\Controllers;

use App\Exports\Exports;
use App\Models\danbai;
use App\Models\grade;
use App\Models\oumu;
use App\Models\shiboqi;
use App\Models\zizu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;


class GradeController extends Controller
{




    public function export(Request $request)
    {
        $row = [[
            "major" => '专业',
            "grade" => '年级',
            "stu_id" => '学号',
            "stu_name" => '姓名',
            "class" => '班级',
            "sub_grade" => '选判题',
            "obj_grade" => '非选判题 ',
            "total_grade" => '总成绩'
        ]];


        $shiyanName = $request['experiment_name'];
        $class = $request['class'];

        if ($shiyanName == 'danbai') {
            $res = danbai::check_one($class);
            $excel = new Exports($res,$row,'学生实验成绩');
            $d =Excel::download($excel, '学生实验成绩.xlsx');

        } elseif ($shiyanName == 'oumu') {
            $res = oumu::check_one($class);
            $excel = new Exports($res,$row,'学生实验成绩');
            $d =Excel::download($excel, '学生实验成绩.xlsx');

        } elseif ($shiyanName == 'shiboqi') {
            $res = shiboqi::check_one($class);
            $excel = new Exports($res,$row,'学生实验成绩');
            $d =Excel::download($excel, '学生实验成绩.xlsx');
        } elseif ($shiyanName == 'zizu') {
            $res = zizu::check_one($class);
            $excel = new Exports($res,$row,'学生实验成绩');
            $d =Excel::download($excel, '学生实验成绩.xlsx');
        }
        return $d;

    }
}
