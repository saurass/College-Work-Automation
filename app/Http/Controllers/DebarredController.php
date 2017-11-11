<?php

namespace App\Http\Controllers;

use App\Addexam;
use App\Assignrole;
use App\Facultylogin;
use App\Http\Controllers\StudentController;
use App\Mark;
use Illuminate\Http\Request;
use App\Debarred;
use App\Sub_debarred;
use App\Pro_debarred;
use App\UFM;
use App\Student;
use App\Subject;

class DebarredController extends Controller
{
    public function index()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        if($category=='ADMIN' or $category=='HOD')
            return view('debarred.debar');
        else
            return 'Unauthorized Access Only Admin or Hod has this Priveledge';
    }

    public function store(Request $request)
    {
        $debarred = $request->debarred;

        if ($debarred == "DB")
        {
            Sub_debarred::where('st_id',$request->st_id)->delete();

            Pro_debarred::where('st_id',$request->st_id)->delete();

            Mark::where('st_id',$request->st_id)
                ->where('examname',$request->exam)
                ->update(['marks_obtained'=>$debarred]);

            Debarred::updateOrCreate([
                'exam' => $request->exam,
                'st_id' => $request->st_id,
            ]);
        }

        elseif ($debarred == "SDB")
        {
            Debarred::where('st_id',$request->st_id)->delete();

            Pro_debarred::where('st_id',$request->st_id)->delete();

            Mark::where('st_id',$request->st_id)
                ->where('examname',$request->exam)
                ->where('sub_id',$request->sub)
                ->update(['marks_obtained'=>$debarred]);

            Sub_debarred::updateOrCreate([
                'exam' => $request->exam,
                'st_id' => $request->st_id,
                'sub' => $request->sub,
            ]);
        }

        elseif ($debarred == "PC")
        {
            Debarred::where('st_id',$request->st_id)->delete();

            Sub_debarred::where('st_id',$request->st_id)->delete();

            Mark::where('st_id',$request->st_id)
                ->where('examname',$request->exam)
                ->where('sub_id',$request->sub)
                ->update(['marks_obtained'=>$debarred]);

            Pro_debarred::updateOrCreate([
                'exam' => $request->exam,
                'st_id' => $request->st_id,
                'sub' => $request->sub,
            ]);
        }

        else
        {
            ufm::updateOrCreate([
                'exam' => $request->exam,
                'st_id' => $request->st_id,
                'sub' => $request->sub,
            ]);
        }

        return redirect('/debar?status=Success');
    }

    public function getinfo()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        $user_branch=Facultylogin::where('userid',$username)->first()->branch;

        $debarred = $_REQUEST['debarred'];
        $st_id = $_REQUEST['st_id'];

        $student=Student::where('st_id',$st_id)
                    ->first();

        $semester=$student->semester;
        $branch=$student->branch;


        $exams=Addexam::where('branch',$branch)
                        ->where('semester',$semester)
                        ->distinct()
                        ->get(['exam_name']);

        $student = Student::where('st_id', $st_id)
                    ->first();

        $oes=Subject::where('semester',$semester)
                        ->where('branch',$branch)
                        ->where('category','O')
                        ->distinct()
                        ->get(['sub_id']);

        $sub = Assignrole::where('section', $student->section)
                        ->where('semester', $student->semester)
                        ->whereNotIn('sub_id',$oes)
                        ->distinct()
                        ->orderBy('sub_id','asc')
                        ->get(['sub_id']);
        $stu_oe_sub=Student::where('st_id',$st_id)->first();

        if($category=='HOD' and $user_branch!=$branch)
        {
            return "You Can Access Students Of Your Branch Only";
        }
        else
        {
            return view('debarred.stinfo')
                ->with('debarred' , $debarred)
                ->with('student' , $student)
                ->with('sub' , $sub)
                ->with('exams',$exams)
                ->with('stu_oe_subs',$stu_oe_sub);
        }
    }

    public function AddDebarGetExam()
    {
        $subject=$_REQUEST['sub'];
        $section=$_REQUEST['sec'];

        $branch=Student::where('section',$section)->first()->branch;
        $semester=Subject::where('sub_id',$subject)->first()->semester;
        $subcat=Subject::where('sub_id',$subject)->first()->category;

        if($subcat=='T' or $subcat=='O')
        {
            $exams=Addexam::where('exam_name','LIKE','%AS%')
                ->orWhere('exam_name','LIKE','%ST%')
                ->orWhere('exam_name','LIKE','%PUT%')
                ->where('branch',$branch)
                ->where('semester',$semester)
                ->get();

            $examd=[];
            foreach ($exams as $exam)
            {
                if($exam->branch == $branch and $exam->semester==$semester)
                    $examd[]=$exam->exam_name;
            }
        }
        if($subcat=='P')
        {
            $exams=Addexam::where('exam_name','LIKE','%REC%')
                ->orWhere('exam_name','LIKE','%VV%')
                ->where('branch',$branch)
                ->where('semester',$semester)
                ->get();

            $examd=[];
            foreach ($exams as $exam)
            {
                if($exam->branch == $branch and $exam->semester==$semester)
                    $examd[]=$exam->exam_name;
            }
        }

        $data=[];
        foreach ($examd as $e)
        {
            $data[]=$e;
        }
        $datas=array_unique($data);
        sort($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $v)
        {
            $datastr=$datastr.'<option value="'.$v.'">'.$v.'</option>';
        }
        return $datastr;
    }
}