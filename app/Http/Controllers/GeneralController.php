<?php


namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use App\Assignrole;
use App\Subject;
use App\Attendance;
use App\Student;
use App\Facultylogin;


use Illuminate\Support\Facades\Auth;


class GeneralController extends Controller
{
    
    function check()
    {
		$all_stu_same_section_same_semester_all_year=Student::where('section','CS-1')->where('semester','4')->get(['st_id']);
        $stu_ids=Attendance::select('st_id')->distinct()->where('sub_id','NCS-401')->whereIn('st_id',$all_stu_same_section_same_semester_all_year)->get();

        dd($stu_ids);
    }


    function searchfac()
    {
       echo  $sem=$_REQUEST['sem'];
       echo  $sub=$_REQUEST['sub'];

        $facid=Assignrole::where([['semester','=',$sem],['sub_id','=',$sub]])->get()->pluck('fac_id');


        $facname=Facultylogin::whereIn('userid',$facid)->get();

        echo "<option value=''>--SELECT--</option>";

        foreach ($facname as $facs) {
            echo "<option value='$facs->userid'>($facs->userid) $facs->name</option>";
            
                    }
        
    

    }





    function searchsub()
    {
        $username=session('username');
    	$usertype=session('usertype');

    	if($usertype!="ADMIN" && $usertype!="STUDENT")
    		$userbranch=session('branch');

        if($usertype=="ADMIN")
    	{
			$subjects=Assignrole::select('sub_id')->distinct()->get();
        }

   		else if ($usertype=="HOD")
   		{
   				$subjects=Assignrole::select('sub_id')->distinct()->where('branch',$userbranch)->get();
        }

        else if ($usertype=="FACULTY")
        {

            $subjects=Assignrole::select('sub_id')->distinct()->where([['branch','=',$userbranch],['fac_id','=',$username]])->get();
        }

        else redirect('/home');

        echo "<option value=''>--SELECT--</option>";
   		foreach($subjects as $subject){
 		echo "<option value='".$subject->sub_id."'>".$subject->sub_id."</option>";
 		}
    }


    function searchsubname($id)
    {
    	$subjectname=Subject::select('sub_name')->where('sub_id',$id)->limit(1)->get();
        foreach ($subjectname as $sub)
        {
		 	echo $sub->sub_name;
        }
    }

    function searchsubsem($id)
    {
        $subsems=Assignrole::select('semester')->where('sub_id',$id)->distinct()->get();
        foreach ($subsems as $subsem)
    		{echo $subsem->semester ;}
    }

    function searchsubsec($id)
        {    $username=session('username');
            $usertype=session('usertype');
            if($usertype=='ADMIN'){
        $subsecs=Assignrole::select('section')->where('sub_id',$id)->distinct()->get();
                }
            else {
                $userbranch=session('branch');
                if($usertype=='HOD')
                {
                    $subsecs=Assignrole::select('section')->where([['sub_id','=',$id],['branch','=',$userbranch]])->distinct()->get();
                }
                else
                    $subsecs=Assignrole::select('section')->where([['sub_id','=',$id],['branch','=',$userbranch],['fac_id','=',$username]])->distinct()->get();

            }
    	foreach ($subsecs as $subsec)
    	{
    		echo "<option value='".$subsec->section."'>".$subsec->section."</option>";
    		# code...
    	}
    }


    function getstudentcount($sec,$sem){

        $count=Student::where([['section','=',$sec],['semester','=',$sem]])->count();
        echo $count;  

    }

    function showattend($sec,$sem,$noc,$mb,$subid,$syear,$tyear)
    {
    	$year= date("Y");
    	$cmd=Student::where([['semester','=',$sem],['section','=',$sec]])->get();
    	return view('attendance.Form1', compact('sec','sem','noc','mb','subid','syear','tyear','cmd','year'));
    }

    function check_oe($s4)
    {
        //Subject Code for userid
        $S5="NOE-071";
        $S6="NOE-072";
        $S7="NOE-073";
        $S16="NOE-074";
        $S20="NOE-038";
        $S12="NOE-031";
        $S13="NOE-033";
        $S14="NOE-034";
        $S15="NOE-036";

        //Subject Code for userid1
        $S8="NME-0141";
        $S9="NME-0211";
        $S17="EME-0511";
        $S18="EME-0641";
        $S23="NMCA-E15";
        $S24="NMCA-E12";

        //Subject Code for userid2
        $S10="EME-041";
        $S11="EME-043";
        $S21="ECE-043";
        $S22="ECE-044";

        $s4=trim((string)$s4);

        if($s4==$S5 || $s4==$S6 || $s4==$S7 || $s4==$S12 || $s4==$S13 || $s4==$S14 || $s4==$S15 || $s4==$S16 || $s4==$S20)
            return 1;
        else if($s4==$S8 || $s4==$S9 || $s4==$S17 || $s4==$S18 || $s4==$S23 || $s4==$S24)
            return 2;
        else if($s4==$S10 || $s4==$S11 || $s4==$S21 || $s4==$S22)
            return 3;
        else
            return 0;
}

    function validatedate($subid,$sec,$sem,$sdate,$sdate2,$status){
        if($status=='single')
            $sdate2 = '';

        $subid = trim($subid);
        $sec = trim($sec);
        $sem = trim($sem);
        $sdate = trim($sdate);
        $sdate2 = trim($sdate2);

         $username=session('username');
        $usertype=session('usertype');




        if(empty($subid) || empty($sec) || empty($sem) || empty($sdate)  || !isset($subid) || !isset($sec) || !isset($sdate2)){


             return ;
             }



		

		 if(!empty($sdate2)){

           

		 $test=Attendance::select('fromdate','todate')->distinct()->where('sub_id',$subid)->whereIn('st_id',function($query) use($sem,$sec){
																									$query->select('st_id')->from('students')
																									->where([['semester', '=' ,$sem],['section','=',$sec]]);
		           																				})->get();




             foreach ($test as $test2){
			 $fromdate = $test2['fromdate']."\t";
		 	 $todate = $test2['todate']."<br>";
				if(($sdate>=$fromdate && $sdate<=$todate)||($sdate2>=$fromdate && $sdate2<=$todate)){
					echo "false";
					return ;
				}
			}
           


		echo "true";
		return;
		}
		else{

		$test=Attendance::select('fromdate','todate')->distinct()->where('sub_id',$subid)->whereIn('st_id',function($query) use($sem,$sec){
																									$query->select('st_id')->from('students')
																									->where([['semester', '=' ,$sem],['section','=',$sec]]);
		           																				})->get();
		
			foreach ($test as $test2) {
		 $fromdate = $test2['fromdate']."\t";
	 		 $todate = $test2['todate']."<br>";
			if($sdate>=$fromdate && $sdate<=$todate){
		 			echo "false";
		 			return ;
				}
			}
		echo "true";
		}
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
        return redirect('./attendance?status=sucess');
    


    }

	//------------Function to get all distinct sem for given department---**by - SAURASS  **-------------
	public function showSem()
    {
        $department=$_REQUEST['dep'];
        $sem=Assignrole::where('branch',$department)->get();
        $data=[];
        foreach ($sem as $sems)
        {
            $data[]=$sems->semester;
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

    public function showCategory()
    {
        $dep=$_REQUEST['dep'];
        $sem=$_REQUEST['sem'];
        $data=Subject::where('branch',$dep)->where('semester',$sem)->get();
        $datas=[];
        foreach ($data as $v)
        {
            $datas[]=$v->category;
        }
        $datas=array_unique($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $b)
        {
            if($b=='T')
                $datastr=$datastr.'<option value="'.$b.'">'.'Theory'.'</option>';
            if($b=='P')
                $datastr=$datastr.'<option value="'.$b.'">'.'Practical'.'</option>';
            if($b=='O')
                $datastr=$datastr.'<option value="'.$b.'">'.'Open Elective'.'</option>';
        }
        return $datastr;
    }

    public function showSub()
    {
        $dep=$_REQUEST['dep'];
        $sem=$_REQUEST['sem'];
        $category=$_REQUEST['category'];
        $data=Subject::where('branch',$dep)->where('semester',$sem)->where('category',$category)->get();
        $datas=[];
        foreach ($data as $v)
        {
            $datas[]=$v;
        }
        $datas=array_unique($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $b)
        {
            $datastr=$datastr.'<option value="'.$b->sub_id.'">'.$b->sub_name.'</option>';
        }
        return $datastr;
    }

    public function showFac()
    {
        $dep=$_REQUEST['dep'];
        $data=Facultylogin::where('branch',$dep)->get();
        $datas=[];
        foreach ($data as $v)
        {
            $datas[]=$v;
        }
        $datas=array_unique($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $b)
        {
            $datastr=$datastr.'<option value="'.$b->userid.'">'.$b->name.'('.$b->userid.')'.'</option>';
        }
        return $datastr;
    }

    public function showBatch()
    {
        $dep=$_REQUEST['dep'];
        $data=Assignrole::where('branch',$dep)->get();
        $datas=[];
        foreach ($data as $v)
        {
            $datas[]=$v->section;
        }
        $datas=array_unique($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $b)
        {
            $datastr=$datastr.'<option value="'.$b.'">'.$b.'</option>';
        }
        return $datastr;
    }

    public function showSec()
    {
        $dep=$_REQUEST['dep'];
        $sem=$_REQUEST['sem'];
        $data=Assignrole::where('semester',$sem)->where('branch',$dep)->get();
        $datas=[];
        foreach ($data as $v)
        {
            $datas[]=$v->section;
        }
        $datas=array_unique($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $b)
        {
            $datastr=$datastr.'<option value="'.$b.'">'.$b.'</option>';
        }
        return $datastr;
    }

    public function showSub1()
    {
        $dep=$_REQUEST['dep'];
        $sem=$_REQUEST['sem'];
        $section=$_REQUEST['section'];
        $data=Assignrole::where('branch',$dep)->where('semester',$sem)->where('section',$section)->orderBy('sub_id')->get();
        $sub=Subject::where('branch',$dep)->where('semester',$sem)->orderBy('sub_id')->get();
        $datas=[];
        foreach ($data as $v)
        {
            $datas[]=$v;
        }
        $datas=array_unique($datas);
        $datastr='<option value="">SELECT</option>';
        foreach ($datas as $b)
        {
            foreach ($sub as $subs)
            {
                if($b->sub_id == $subs->sub_id)
                {
                    $datastr=$datastr.'<option value="'.$b->sub_id.'">('.$b->sub_id.')'.$subs->sub_name.'</option>';
                }
            }
        }
        return $datastr;
    }


    public function showsection()
   {
        $username=session('username');
        $usertype=session('usertype');

       //if($usertype!="ADMIN" && $usertype!="STUDENT")
            $branch=Facultylogin::where('userid',$username)->first()->branch;
        //else
            //$branch=$_REQUEST['branch'];

        $sem=$_REQUEST['sem'];
        $sections=Assignrole::select('section')
            ->distinct()
            ->where('branch',$branch)
            ->where('semester',$sem)
            ->get(['section']);
        
        $str = '<option value="">SELECT</option>';
        foreach ($sections as $section)
        {
            $str=$str.'<option value="'.$section->section.'">'.$section->section.'</option>';
        }
        return $str;
        
     }



protected function redirectTo()
        {   

            $user=Auth::user();
            $username=$user->username;
            $type=Facultylogin::select('category','branch')->where('userid',$username)->first();

            session(['username' => $username]);
               
                if($type==NULL){
                    session(['usertype' => "STUDENT"]);
                    return view ('/studentpage');
                }
                else{
                     session(['usertype' => $type->category]);
                     
                    if($type->category=="ADMIN"){
                        return view ('/adminpage');
                    }
                    else{
                        session(['branch' => $type->branch]);


                        if($type->category=="HOD")

                            return view ('/hodpage');
                        else 
                            return view ('/facultypage');
                        }

                        
                       
                    }

            
        }








}
//---------------VIew attendance-----------//
//  public function showsection()
//     {   
//         echo $username=session('username');
//         $usertype=session('usertype');



//         // if($usertype!="ADMIN" && $usertype!="STUDENT")
//         //     $branch=session('branch');
//         // else
//         //     $branch=$_REQUEST['branch'];

//         // $sem=$_REQUEST['sem'];
//         // $sections=Assignrole::where([['branch','=',$branch],['semester','=',$sem]])->get();
        
//         // echo"<option value="">SELECT</option>";
//         // foreach ($sections as $section)
//         // {
//         // echo "<option value=".$section->section.'">'.$section->section.'</option>';
//         // }
        
//     }
// }



