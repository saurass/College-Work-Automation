<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facultylogin;
use App\Attendance;
use App\Student;
use App\Assignrole;
use Session;

class AttendanceController extends Controller
{
    
    public function index()
    {
        //
        return view('attendance.addattendance');
    }

    
    
    public function store(Request $request)
    {
        //

        $st_id=$request->rollno;
        $totalAttended=$request->totalAttended;
        $Attended=$request->Attended;
        $username=session('username');
        for($i=0;$i<count($st_id);$i++)
        {
            Attendance::insert(['st_id'=>$st_id[$i],'sub_id'=>$request->subjectid,'fromdate'=>$request->syear,'todate'=>$request->tyear,'totalclasses'=>$totalAttended[$i],'attended'=>$Attended[$i],'massbunk'=>$request->mb,'fac_id'=>$username]);
        }

        echo "<script> alert('Attendance Updated'); </script>";
        return view('attendance.addattendance');
    }

   public function edit()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        if($category=="HOD")
        {
            $department=Facultylogin::where('userid',$username)->first()->branch;

            $semesters=Assignrole::where('branch',$department)->get();
            $data=[];
            foreach ($semesters as $semester)
            {
                $data[]=$semester->semester;
            }
            $data=array_unique($data);
            $str=[];
            foreach ($data as $datas)
            {
                $str[]=$datas;
            }
            sort($str);
            return view('attendance.UpdateAttendance')
                ->with('semesters',$str)
                ->with('priveledge',$category)
                ->with('department',$department);
        }
        else
        {
            $department=Facultylogin::where('branch','!=','')->get();

            $emp=[];
            foreach ($department as $departments)
            {
                $emp[]=$departments->branch;
            }
            $department=array_unique($emp);

            $semesters=Assignrole::all('semester');
            $data=[];
            foreach ($semesters as $semester)
            {
                $data[]=$semester->semester;
            }
            $data=array_unique($data);
            $str=[];
            foreach ($data as $datas)
            {
                $str[]=$datas;
            }
            sort($str);
            return view('attendance.UpdateAttendance')
                ->with('semesters',$str)
                ->with('priveledge','ADMIN')
                ->with('department',$department);
        }
    }

    public function update()
    {
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['semester'];
        $section=$_REQUEST['section'];
        $subject=$_REQUEST['sub_id'];

        $stu=Student::where('semester',$semester)
            ->where('section',$section)
            ->where('branch',$branch)
            ->get(['st_id']);

        $date_data=Attendance::where('sub_id',$subject)
            ->distinct()
            ->whereIn('st_id',$stu)
            ->orderBy('fromdate')
            ->get(['fromdate','todate']);

        return view('attendance.ShowAll',compact('date_data'))
                ->with('sub_id',$subject)
                ->with('section',$section);
    }

    public function updatesave()
    {
        $fromdate=$_REQUEST['fromdate'];
        $todate=$_REQUEST['todate'];
        $semester=$_REQUEST['semester'];
        $subject=$_REQUEST['sub_id'];
        $section=$_REQUEST['section'];

        $all_stu_same_section_same_semester_all_year=Student::where('section',$section)->where('semester',$semester)->get(['st_id']);
        $stu_ids=Attendance::where('fromdate',$fromdate)->where('todate',$todate)->where('sub_id',$subject)->whereIn('st_id',$all_stu_same_section_same_semester_all_year)->get(['st_id']);
        $stu_names=Student::whereIn('st_id',$stu_ids)->get(['st_id','name']);
        $stu_att_data=Attendance::whereIn('st_id',$stu_ids)->where('sub_id',$subject)->where('fromdate',$fromdate)->where('todate',$todate)->get();
        return view('attendance.ShowAttendance',compact('stu_ids','stu_names'))
                ->with('stu_att_data',$stu_att_data);
    }
    public function saveupdate(Request $request)
    {
        $i=1;
        for($i=1;$i<=100;$i++)
        {
            if(!isset($request->$i))
                break;
            else
            {
                $sub='sub_id'.$i;
                $fromdate='fromdate'.$i;
                $todate='todate'.$i;
                $st_id=$i;
                $attended='attended'.$i;
                $totalclasses='totalclasses'.$i;

                $subject=$request->$sub;
                $fromdate=$request->$fromdate;
                $todate=$request->$todate;
                $st_id=$request->$st_id;
                $attended=$request->$attended;
                $totalclasses=$request->$totalclasses;

                Attendance::where('st_id',$st_id)
                    ->where('sub_id',$subject)
                    ->where('fromdate',$fromdate)
                    ->where('todate',$todate)
                    ->first()
                    ->update([
                        'totalclasses'=>$totalclasses,
                        'attended'=>$attended
                    ]);
            }
        }
        return redirect('/attendance/show?status=success');
    }

    public function delete()
    {
        $subject=$_REQUEST['sub_id'];
        $fromdate=$_REQUEST['fromdate'];
        $todate=$_REQUEST['todate'];

        $section=$_REQUEST['section'];

        $student=Student::where('section',$section)->get(['st_id']);

        Attendance::whereIn('st_id',$student)
            ->where('sub_id',$subject)
            ->where('fromdate',$fromdate)
            ->where('todate',$todate)->delete();

        return redirect('/attendance/show?status=Delete');
    }




    public function viewattendancepage(){ 


        $username=session('username');
        $usertype=session('usertype');

        if($usertype!="ADMIN" && $usertype!="STUDENT")
            $userbranch=session('branch');

        if($usertype=="ADMIN")
        { 
           $semesters =Assignrole::select('semester')->distinct()->get();
            return view('Attendance.viewattendance',compact('semesters'));
            echo "moajd";

        }

        else if ($usertype=="HOD")
        {   echo "shoahoahsa";
                $semesters=Assignrole::select('semester')->distinct()->where('branch',$userbranch)->get();
                return view('Attendance.viewattendance',compact('semesters'));

        }

        else if ($usertype=="FACULTY")
        {

            $subjects=Assignrole::select('sub_id')->distinct()->where([['branch','=',$userbranch],['fac_id','=',$username]])->get();

            return view('Attendance.viewattendancefaculty',compact('subjects'));

        }

        else redirect('/home');

       
	}


	public function showhodattendthirdmul()
	{	$branch=session('branch');
	$sem=$_REQUEST['sem'];
	$sec=$_REQUEST['sec'];
	$fdate=$_REQUEST['fdate'];
	$tdate=$_REQUEST['tdate'];
	$start=$_REQUEST['start'];
	$end=$_REQUEST['end'];
	$sid=$_REQUEST['sid'];

	$cmd=Attendance::select('st_id')->where('sub_id',$sid)->whereIn('st_id',function($query) use($sem,$sec){
																									$query->select('st_id')->from('students')
																									->where([['semester', '=' ,$sem],['section','=',$sec]]);
		           																				})->whereBetween('fromdate', [$fdate, $tdate])->whereBetween('todate', [$fdate, $tdate])->groupBy('st_id')->sum('attended','totalclasses');
	Attendance::enableQueryLog();


dd(Attendance::getQueryLog());
		//return $cmd;

	}


	public function qry()
	{
		$cmd=Attendance::select('st_id',raw('sum(attended)'),raw('SUM(totalclasses) '))->where('sub_id',$sid)->whereIn('st_id',function($query) use($sem,$sec){
																									$query->select('st_id')->from('students')
																									->where([['semester', '=' ,$sem],['section','=',$sec]]);
		           																				})->whereBetween('fromdate', [$fadte, $tadte])->whereBetween('toate', [$fadte, $tadte])->groupBy('st_id')->orderBy(raw('SUM(attended)'), 'desc')->get();
	


		return $cmd;
	}





function searchsub()
    {
    	$sem=$_REQUEST['sem'];
        $username=session('username');
    	$usertype=session('usertype');

    	if($usertype!="ADMIN" && $usertype!="STUDENT")
    		$userbranch=session('branch');

        if($usertype=="ADMIN")
    	{
			$subjects=Assignrole::select('sub_id')->distinct()->where('semester',$sem)->get();
        }

   		else if ($usertype=="HOD")
   		{
   				$subjects=Assignrole::select('sub_id')->distinct()->where('branch',$userbranch)->where('semester',$sem)->get();
        }

        else if ($usertype=="FACULTY")
        {

            $subjects=Assignrole::select('sub_id')->distinct()->where([['branch','=',$userbranch],['fac_id','=',$username]])->where('semester',$sem)->get();
        }

        else redirect('/home');

        echo "<option value=''>--SELECT--</option>";
   		foreach($subjects as $subject){
 		echo "<option value='".$subject->sub_id."'>".$subject->sub_id."</option>";
 		}
    }





}
