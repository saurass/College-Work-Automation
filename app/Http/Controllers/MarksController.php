<?php

namespace App\Http\Controllers;

use App\Addexam;
use App\Assignrole;
use App\Debarred;
use App\Facultylogin;
use App\Mark;
use App\Pro_debarred;
use App\Student;
use App\Sub_debarred;
use App\Subject;
use Illuminate\Http\Request;

class MarksController extends Controller
{

    //==================================SAURASS Code==============================================
    public function index1()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
                    ->first()
                    ->category;
        if($category=='FACULTY')
        {
            $section=Assignrole::where('fac_id',$username)
                            ->distinct()
                            ->get(['sub_id']);
            return view('marks.AddMarksFaculty')
                    ->with('section',$section);
        }
        else
        {
            return 'NOT ALLOWED -- Only Faculty Can Add Marks';
        }
    }

    public function showSection()
    {
        $subject=$_REQUEST['sub'];
        $username=session('username');

        $section=Assignrole::where('fac_id',$username)
                    ->where('sub_id',$subject)
                    ->distinct()
                    ->get();

        $data=[];
        foreach ($section as $s)
        {
            $data[]=$s->section;
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

    public function showExams()
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
            $exams=$exams->where('status',1);

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
            $exams=$exams->where('status',1);

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

    public function showStudentList()
    {
        $subject=$_REQUEST['sub'];
        $section=$_REQUEST['sec'];
        $exam=$_REQUEST['exam'];
//****************************************************************************************
        $d='';
        $semester=Subject::where('sub_id',$subject)
            ->first()
            ->semester;
        $student=Student::where('section',$section)
            ->where('semester',$semester)
            ->first()->st_id;

        $data=Mark::where('st_id',$student)
            ->where('sub_id',$subject)
            ->where('examname',$exam)
            ->first();

        if(isset($data->id))
        {
            $d='false';
        }
        else
        {
            $d='true';
        }
        //****************************************************************

        if ($d=='true')
        {
            $semester=Subject::where('sub_id',$subject)->first()->semester;
            $branch=Student::where('section',$section)->first()->branch;

            $students=Student::where('branch',$branch)
                ->where('semester',$semester)
                ->where('section',$section)
                ->get();

            $dbr=Debarred::whereIn('st_id',$students)
                ->get();
            $sdbr=Sub_debarred::whereIn('st_id',$students)
                    ->where('exam',$exam)
                ->get();
            $pcdbr=Pro_debarred::whereIn('st_id',$students)
                ->get();

            $exam=Addexam::where('branch',$branch)
                ->where('semester',$semester)
                ->where('exam_name',$exam)
                ->first();

            return view('marks.AddMarksStudentList')
                ->with('students',$students)
                ->with('exam',$exam)
                ->with('subject',$subject)
                ->with('branch',$branch)
                ->with('section',$section)
                ->with('dbr',$dbr)
                ->with('sdbr',$sdbr)
                ->with('pcdbr',$pcdbr);
        }
        if($d=='false')
            return 'EXAM MARKS ALREADY ADDED !';
    }

    public function saveMarks(Request $request)
    {
        $exam_name=$_REQUEST['exam_name'];
        $sub_id=$_REQUEST['sub_id'];
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['sem'];
        $section=$_REQUEST['section'];
        $mm=$_REQUEST['mm'];

        $i=1;

        $students=Student::where('branch',$branch)
            ->where('semester',$semester)
            ->where('section',$section)
            ->get();

        foreach($students as $student)
        {
            $var='mark'.$i;
            $omark=$request->$var;

            Mark::create([
                'st_id'=>$student->st_id,
                'sub_id'=>$sub_id,
                'marks_obtained'=>$omark,
                'examname'=>$exam_name,
                'max_mark'=>$mm,
            ]);
            $i++;
        }
        return redirect('/addmarks?status=success');
    }

    public function marksUpdater()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
            ->first()
            ->category;
        if($category=='FACULTY')
        {
            $section=Assignrole::where('fac_id',$username)
                ->distinct()
                ->get(['sub_id']);
            return view('marks.UpdateMarksFaculty')
                ->with('section',$section);
        }
        elseif($category=='ADMIN')
        {
            $branchs=Assignrole::select('branch')
                    ->distinct()
                    ->orderBy('branch','asc')
                    ->get(['branch']);
            return view('marks.UpdateMarksAdmin')
                    ->with('branchs',$branchs);
        }
        elseif($category=='HOD')
        {
            $branch=Facultylogin::where('userid',$username)
                        ->first()
                        ->branch;
            $semesters=Assignrole::where('branch',$branch)
                        ->distinct()
                        ->orderBy('semester','asc')
                        ->get(['semester']);
            return view('marks.UpdateMarksHod')
                ->with('branch',$branch)
                ->with('semesters',$semesters);
        }
        else
        {
            return "UNAUTHORISED ACCESS";
        }

    }

    public function showUpdateStudentList()
    {
        $subject=$_REQUEST['sub'];
        $section=$_REQUEST['sec'];
        $exam=$_REQUEST['exam'];

        $semester=Subject::where('sub_id',$subject)->first()->semester;
        $branch=Assignrole::where('section',$section)->first()->branch;

        $students=Student::where('branch',$branch)
            ->where('semester',$semester)
            ->where('section',$section)
            ->get();

        $exam=Addexam::where('branch',$branch)
            ->where('semester',$semester)
            ->where('exam_name',$exam)
            ->first();

        $dbr=Debarred::whereIn('st_id',$students)
            ->get();
        $sdbr=Sub_debarred::whereIn('st_id',$students)
            ->where('exam',$exam)
            ->get();
        $pcdbr=Pro_debarred::whereIn('st_id',$students)
            ->get();

        $arr=[];
        foreach ($students as $student)
        {
            $arr[]=$student->st_id;
        }

        $marks=Mark::whereIn('st_id',$arr)->where('sub_id',$subject)->get();

        if(isset($exam->semester))
        {
            return view('marks.UpdateMarksStudentList')
                ->with('students', $students)
                ->with('exam', $exam)
                ->with('subject', $subject)
                ->with('branch', $branch)
                ->with('section', $section)
                ->with('marks', $marks)
                ->with('dbr',$dbr)
                ->with('sdbr',$sdbr)
                ->with('pcdbr',$pcdbr);
        }
        else
        {
            return 'Sorry! No Data Found';
        }
    }

    public function updateMarks(Request $request)
    {
        $exam_name=$_REQUEST['exam_name'];
        $sub_id=$_REQUEST['sub_id'];
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['sem'];
        $section=$_REQUEST['section'];
        $mm=$_REQUEST['mm'];

        $i=1;

        $students=Student::where('branch',$branch)
            ->where('semester',$semester)
            ->where('section',$section)
            ->get();

        foreach($students as $student)
        {
            $var='mark'.$i;
            $omark=$request->$var;

            Mark::where('st_id',$student->st_id)
                ->where('sub_id',$sub_id)
                ->update([
                'st_id'=>$student->st_id,
                'sub_id'=>$sub_id,
                'marks_obtained'=>$omark,
                'examname'=>$exam_name,
                'max_mark'=>$mm,
            ]);
            $i++;
        }
        return redirect('/marks/update?status=success');
    }

    public function UpdateMarksShowSem()
    {
        $branch=$_REQUEST['branch'];
        $semesters=Assignrole::where('branch',$branch)
                ->distinct()
                ->orderBy('semester','asc')
                ->get(['semester']);
        echo '<option value="">SELECT</option>';
        foreach ($semesters as $semester)
        {
            echo '<option value="'.$semester->semester.'">'.$semester->semester.'</option>';
        }
    }

    public function UpdateMarksShowSec()
    {
        $branch=$_REQUEST['branch'];
        $sem=$_REQUEST['sem'];

        $sections=Assignrole::where('branch',$branch)
                ->where('semester',$sem)
                ->distinct()
                ->orderBy('section','asc')
                ->get(['section']);
        echo '<option value="">SELECT</option>';
        foreach ($sections as $section)
        {
            echo '<option value="'.$section->section.'">'.$section->section.'</option>';
        }
    }

    public function UpdateMarksShowSub()
    {
        $branch=$_REQUEST['branch'];
        $sem=$_REQUEST['sem'];

        $subjects=Subject::where('branch',$branch)
                ->where('semester',$sem)
                ->distinct()
                ->orderBy('sub_id','asc')
                ->get(['sub_id']);

        echo '<option value="">SELECT</option>';
        foreach ($subjects as $subject)
        {
            echo '<option value="'.$subject->sub_id.'">'.$subject->sub_id.'</option>';
        }
    }

    public function UpdateMarksShowExam()
    {
        $branch=$_REQUEST['branch'];
        $sem=$_REQUEST['sem'];

        $exams=Addexam::where('branch',$branch)
                    ->where('semester',$sem)
                    ->distinct()
                    ->get(['exam_name']);

        echo '<option value="">SELECT</option>';
        foreach ($exams as $exam)
        {
            echo '<option value="'.$exam->exam_name.'">'.$exam->exam_name.'</option>';
        }
    }

    public function markViewer()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
                ->first()
                ->category;
        if($category=='ADMIN')
        {
            $branchs=Assignrole::select('branch')
                    ->distinct()
                    ->orderBy('branch','asc')
                    ->get(['branch']);
            return view('marks.MarksViewerAdmin')
                    ->with('branchs',$branchs);
        }
        if($category=='HOD')
        {
            $branchs=Facultylogin::where('userid',$username)->first()->branch;
            $semesters=Assignrole::select('semester')->where('branch',$branchs)->orderBy('semester','asc')->distinct()->get(['semester']);
            return view('marks.MarksViewerHod')
                ->with('branchs',$branchs)
                ->with('semesters',$semesters);
        }
    }

    public function ViewMarksAdminGetSem()
    {
        $branch=$_REQUEST['branch'];
        $semesters=Assignrole::where('branch',$branch)
                    ->distinct()
                    ->get(['semester']);
        echo '<option value="">SELECT</option>';
        foreach ($semesters as $semester)
        {
            echo '<option value="'.$semester->semester.'">'.$semester->semester.'</option>';
        }
    }

    public function ViewMarksAdminGetSec()
    {
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['semester'];

        $sections=Assignrole::where('branch',$branch)
                    ->where('semester',$semester)
                    ->distinct()
                    ->orderBy('section','asc')
                    ->get(['section']);
        echo '<option value="">SELECT</option>';
        foreach ($sections as $section)
        {
            echo '<option value="'.$section->section.'">'.$section->section.'</option>';
        }
    }

    public function ViewMarksAdminGetExam()
    {
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['semester'];

        $exams=Addexam::where('branch',$branch)
                        ->where('semester',$semester)
                        ->distinct()
                        ->get(['exam_name']);
        echo '<option value="">SELECT</option>';
        foreach ($exams as $exam)
        {
            echo '<option value="'.$exam->exam_name.'">'.$exam->exam_name.'</option>';
        }
    }

    public function ViewMarksAdminGetViewMark()
    {
        $section=$_REQUEST['section'];
        $semester=$_REQUEST['semester'];
        $order=$_REQUEST['order'];
        //*********
        $exam=$_REQUEST['exam'];

        if ($order=='nm')
        {
            $branch=Student::where('section',$section)
                ->where('semester',$semester)
                ->first()->branch;
            //*********
            $subjects=Subject::where('branch',$branch)
                ->where('semester',$semester)
                ->whereIn('category',['T','O'])
                ->distinct()
                ->get(['sub_id']);
            //**********
            $students=Student::where('semester',$semester)
                ->where('section',$section)
                ->get();

            //*********
            $mm=Addexam::where('branch',$branch)
                ->where('semester',$semester)
                ->where('exam_name',$exam)
                ->first()
                ->max_mark;

            //**************
            $individual_total=[];
            $data=[];
            foreach ($students as $student)
            {
                $data[]=$student->st_id;
                $individual_total[]=Mark::whereIn('sub_id',$subjects)
                    ->where('st_id',$student->st_id)
                    ->where('examname',$exam)
                    ->sum('marks_obtained');
            }
            //return $individual_total;
            //**********
            $subtotal=[];
            //**********
            $subaverage=[];
            foreach ($subjects as $subject)
            {
                $subtotal[]=Mark::where('examname',$exam)
                    ->where('sub_id',$subject->sub_id)
                    ->sum('marks_obtained');
            }
            foreach ($subjects as $subject)
            {
                $subaverage[]=Mark::where('examname',$exam)
                    ->where('sub_id',$subject->sub_id)
                    ->avg('marks_obtained');
            }
            //return $subaverage;
            //return $subtotal;

            //**********
            $markdata=Mark::whereIn('st_id',$data)
                ->whereIn('sub_id',$subjects)
                ->where('examname',$exam)
                ->get();

            //************
            $alltotal=0;
            foreach ($subtotal as $value)
            {
                $alltotal=$alltotal+$value;
            }

            //********
            $allfac=[];
            foreach ($subjects as $subject)
            {
                $allfac[]=Assignrole::where('section',$section)
                    ->where('sub_id',$subject->sub_id)
                    ->first()
                    ->fac_id;
            }
            $facname=Facultylogin::whereIn('userid',$allfac)->get();

            return view('marks.ViewMarksAdmin')
                ->with('exam',$exam)
                ->with('subjects',$subjects)
                ->with('students',$students)
                ->with('mm',$mm)
                ->with('individual_total',$individual_total)
                ->with('subtotal',$subtotal)
                ->with('subaverage',$subaverage)
                ->with('markdata',$markdata)
                ->with('alltotal',$alltotal)
                ->with('facname',$facname)
                ->with('allfac',$allfac);
        }
        if($order=='asc')
        {
            $branch=Student::where('section',$section)
                ->where('semester',$semester)
                ->first()->branch;
            //*********
            $subjects=Subject::where('branch',$branch)
                ->where('semester',$semester)
                ->whereIn('category',['T','O'])
                ->distinct()
                ->get(['sub_id']);
            //**********
            $students=Student::where('semester',$semester)
                ->where('section',$section)
                ->get();

            //*********
            $mm=Addexam::where('branch',$branch)
                ->where('semester',$semester)
                ->where('exam_name',$exam)
                ->first()
                ->max_mark;

            //**************
            //*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
            $individual_total=[];
            $data=[];
            foreach ($students as $student)
            {
                $data[]=$student->st_id;
                $total=Mark::whereIn('sub_id',$subjects)
                    ->where('st_id',$student->st_id)
                    ->where('examname',$exam)
                    ->sum('marks_obtained');
                $id=$student->st_id;
                $individual_total[]=["total"=>$total,"st_id"=>$id];
            }
            sort($individual_total);
            //return $individual_total;
            $stu=[];
            foreach ($individual_total as $total_stu)
            {
                foreach($students as $student)
                {
                    if($student->st_id==$total_stu['st_id'])
                    {
                        $stu[]=["st_id"=>$student->st_id,"name"=>$student->name];
                    }
                }
            }
            //return $stu;
            //**********
            $subtotal=[];
            //**********
            $subaverage=[];
            foreach ($subjects as $subject)
            {
                $subtotal[]=Mark::where('examname',$exam)
                    ->where('sub_id',$subject->sub_id)
                    ->sum('marks_obtained');
            }
            foreach ($subjects as $subject)
            {
                $subaverage[]=Mark::where('examname',$exam)
                    ->where('sub_id',$subject->sub_id)
                    ->avg('marks_obtained');
            }
            //return $subaverage;
            //return $subtotal;

            //**********
            //*-*-*-*-*-*-*-*-**-*-*-*-*--*-*-*-*-*-
            $markdata=Mark::whereIn('st_id',$data)
                ->whereIn('sub_id',$subjects)
                ->where('examname',$exam)
                ->get();

            //************
            $alltotal=0;
            foreach ($subtotal as $value)
            {
                $alltotal=$alltotal+$value;
            }

            //********
            $allfac=[];
            foreach ($subjects as $subject)
            {
                $allfac[]=Assignrole::where('section',$section)
                    ->where('sub_id',$subject->sub_id)
                    ->first()
                    ->fac_id;
            }
            $facname=Facultylogin::whereIn('userid',$allfac)->get();


            return view('marks.ViewMarksAdminOrder')
                ->with('exam',$exam)
                ->with('subjects',$subjects)
                ->with('students',$stu)
                ->with('mm',$mm)
                ->with('individual_total',$individual_total)
                ->with('subtotal',$subtotal)
                ->with('subaverage',$subaverage)
                ->with('markdata',$markdata)
                ->with('alltotal',$alltotal)
                ->with('facname',$facname)
                ->with('allfac',$allfac);
        }
        if($order=='dsc')
        {
            $branch=Student::where('section',$section)
                ->where('semester',$semester)
                ->first()->branch;
            //*********
            $subjects=Subject::where('branch',$branch)
                ->where('semester',$semester)
                ->whereIn('category',['T','O'])
                ->distinct()
                ->get(['sub_id']);
            //**********
            $students=Student::where('semester',$semester)
                ->where('section',$section)
                ->get();

            //*********
            $mm=Addexam::where('branch',$branch)
                ->where('semester',$semester)
                ->where('exam_name',$exam)
                ->first()
                ->max_mark;

            //**************
            //*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
            $individual_total=[];
            $data=[];
            foreach ($students as $student)
            {
                $data[]=$student->st_id;
                $total=Mark::whereIn('sub_id',$subjects)
                    ->where('st_id',$student->st_id)
                    ->where('examname',$exam)
                    ->sum('marks_obtained');
                $id=$student->st_id;
                $individual_total[]=["total"=>$total,"st_id"=>$id];
            }
            rsort($individual_total);
            //return $individual_total;
            $stu=[];
            foreach ($individual_total as $total_stu)
            {
                foreach($students as $student)
                {
                    if($student->st_id==$total_stu['st_id'])
                    {
                        $stu[]=["st_id"=>$student->st_id,"name"=>$student->name];
                    }
                }
            }
            //return $stu;
            //**********
            $subtotal=[];
            //**********
            $subaverage=[];
            foreach ($subjects as $subject)
            {
                $subtotal[]=Mark::where('examname',$exam)
                    ->where('sub_id',$subject->sub_id)
                    ->sum('marks_obtained');
            }
            foreach ($subjects as $subject)
            {
                $subaverage[]=Mark::where('examname',$exam)
                    ->where('sub_id',$subject->sub_id)
                    ->avg('marks_obtained');
            }
            //return $subaverage;
            //return $subtotal;

            //**********
            //*-*-*-*-*-*-*-*-**-*-*-*-*--*-*-*-*-*-
            $markdata=Mark::whereIn('st_id',$data)
                ->whereIn('sub_id',$subjects)
                ->where('examname',$exam)
                ->get();

            //************
            $alltotal=0;
            foreach ($subtotal as $value)
            {
                $alltotal=$alltotal+$value;
            }

            //********
            $allfac=[];
            foreach ($subjects as $subject)
            {
                $allfac[]=Assignrole::where('section',$section)
                    ->where('sub_id',$subject->sub_id)
                    ->first()
                    ->fac_id;
            }
            $facname=Facultylogin::whereIn('userid',$allfac)->get();


            return view('marks.ViewMarksAdminOrder')
                ->with('exam',$exam)
                ->with('subjects',$subjects)
                ->with('students',$stu)
                ->with('mm',$mm)
                ->with('individual_total',$individual_total)
                ->with('subtotal',$subtotal)
                ->with('subaverage',$subaverage)
                ->with('markdata',$markdata)
                ->with('alltotal',$alltotal)
                ->with('facname',$facname)
                ->with('allfac',$allfac);
        }

    }

    public function deleteMarks()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
            ->first()
            ->category;
        if ($category=='ADMIN')
        {
            $branchs=Assignrole::select('branch')
                ->distinct()
                ->orderBy('branch','asc')
                ->get(['branch']);
            return view('marks.DeleteMarks')
                ->with('branchs',$branchs);
        }
        else
        {
            return 'UnAUthorised Access!!';
        }
    }

    public function marksdel()
    {
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['semester'];
        $section=$_REQUEST['section'];
        $subject=$_REQUEST['subject'];
        $exam=$_REQUEST['exam'];

        $students=Student::where('branch',$branch)
                    ->where('semester',$semester)
                    ->where('section',$section)
                    ->get(['st_id']);

        Mark::whereIn('st_id',$students)
                ->where('sub_id',$subject)
                ->where('examname',$exam)
                ->delete();

        return redirect('/marks/delete?status=delsuccess');
    }

    //==================================SHIVI Code================================================

    public function showBranch()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
            ->first()
            ->category;
        if($category=='ADMIN')
        {
            $branch = Assignrole::select('branch')
                ->distinct()
                ->get();
            return view('marks.add_exam', compact('branch'));
        }
        else
        {
            return 'Not Allowed';
        }
    }

    public function showMarksSem()
    {
        $branch=$_REQUEST['branch'];

        $sem=Assignrole::where('branch',$branch)
            ->distinct()
            ->get(['semester']);

        echo "<option value=''>--SELECT--</option>";

        foreach ($sem as $sems)
        {
            echo '<option value="'.$sems->semester.'">'.$sems->semester.'</option>';
        }
    }

    public function store(Request $request)
    {
        $exam=Addexam::where('branch',$request->branch)
                ->where('exam_name',$request->exam_name)
                ->first();
        if(isset($exam->id))
        {
            return redirect('/addExam/new?status=alreadyexists');
        }
        else
        {
            Addexam::create([
                'exam_name'=>$request->examname,
                'branch'=>$request->branch,
                'max_mark'=>$request->max_mark,
                'semester'=>$request->semester,
                'status'=>$request->status
            ]);
            return redirect('/addExam?status=examsuccess');
        }
    }

    public function index()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
            ->first()
            ->category;
        if($category=='ADMIN')
        {
            $marks=Addexam::all();
            return view('marks.show_all_exam' , ['marks'=>$marks]);
        }
        else
        {
            return 'Not Allowed !!';
        }
    }

    public function update_exam_status(Request $request, $id)
    {
        $marks = Addexam::find($id);
        if($marks->status == 1)
        {
            $v = 0;
            Addexam::where('id',$id)->update(['status'=>0]);
        }
        elseif($marks->status == 0)
        {
            $v=1;
            Addexam::where('id',$id)->update(['status'=>1]);
        }
        return  redirect('/addExam?status=success');
    }

    public function index2()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
            ->first()
            ->category;
        if($category=='ADMIN')
        {
            $marks=Addexam::simplePaginate(10);
            return view('marks.deletes' , ['marks'=>$marks]);
        }
        else
        {
            return 'Service Is Not Authorised To You !';
        }
    }

    public function destroy(Request $request , $id)
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)
            ->first()
            ->category;
        if($category=='ADMIN')
        {
            Addexam::destroy($id);
            return  redirect('/del');
        }
        else
        {
            return 'Service Not Authorised To You !';
        }
    }

    public function showTypeExam()
    {
        $examtype=$_REQUEST['examtype'];
        if($examtype=='T')
        {
            echo '<option value="">SELECT</option>';
            echo '<option value="ST">Sessional Test</option>';
            echo '<option value="PUT">Pre-University Test</option>';
            echo '<option value="AS">Assignments</option>';
        }
        if($examtype=='P')
        {
            echo '<option value="">SELECT</option>';
            echo '<option value="VV">Viva</option>';
            echo '<option value="REC">Records</option>';
        }
    }

    public function getExamName()
    {
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['semester'];
        $exam=$_REQUEST['exam'];

        $name=Addexam::where('branch',$branch)
                        ->where('semester',$semester)
                        ->where('exam_name','LIKE','%'.$exam.'%')
                        ->orderBy('exam_name','DESC')
                        ->first();
        if(isset($name->exam_name))
        {
            $ename=$name->exam_name;
            $n=trim($ename,$exam)+1;
            echo $exam.$n;
        }
        else
        {
            if($exam=='PUT')
                return 'PUT';
            else
                return $exam.'1';
        }
    }
}