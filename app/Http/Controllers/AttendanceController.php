<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facultylogin;
use App\Attendance;
use App\Student;
use App\Assignrole;
use Session;
use App\Subject;

class AttendanceController extends Controller
{

    public function index()
    {
        $usertype = session('usertype');

        if ($usertype == "FACULTY")

            return view('attendance.addattendancefac');

        else
            return view('attendance.addattendance');
    }


    public function store(Request $request)
    {
        $st_id = $request->rollno;
        $totalAttended = $request->totalAttended;
        $Attended = $request->Attended;
        $username = session('username');
        for ($i = 0; $i < count($st_id); $i++) {
            Attendance::insert(['st_id' => $st_id[$i], 'sub_id' => $request->subjectid, 'fromdate' => $request->syear, 'todate' => $request->tyear, 'totalclasses' => $totalAttended[$i], 'attended' => $Attended[$i], 'massbunk' => $request->mb, 'fac_id' => $username]);
        }

        echo "<script> alert('Attendance Updated'); </script>";
        return view('errors.success');
    }

    public function edit()
    {
        $username = session('username');
        $category = Facultylogin::where('userid', $username)->first()->category;
        if ($category == "HOD") {
            $department = Facultylogin::where('userid', $username)->first()->branch;

            $semesters = Assignrole::where('branch', $department)->get();
            $data = [];
            foreach ($semesters as $semester) {
                $data[] = $semester->semester;
            }
            $data = array_unique($data);
            $str = [];
            foreach ($data as $datas) {
                $str[] = $datas;
            }
            sort($str);
            return view('attendance.UpdateAttendance')
                ->with('semesters', $str)
                ->with('priveledge', $category)
                ->with('department', $department);
        } else {
            $department = Facultylogin::where('branch', '!=', '')->get();

            $emp = [];
            foreach ($department as $departments) {
                $emp[] = $departments->branch;
            }
            $department = array_unique($emp);

            $semesters = Assignrole::all('semester');
            $data = [];
            foreach ($semesters as $semester) {
                $data[] = $semester->semester;
            }
            $data = array_unique($data);
            $str = [];
            foreach ($data as $datas) {
                $str[] = $datas;
            }
            sort($str);
            return view('attendance.UpdateAttendance')
                ->with('semesters', $str)
                ->with('priveledge', 'ADMIN')
                ->with('department', $department);
        }
    }

    public function update()
    {
        $branch = $_REQUEST['branch'];
        $semester = $_REQUEST['semester'];
        $section = $_REQUEST['section'];
        $subject = $_REQUEST['sub_id'];

        $stu = Student::where('semester', $semester)
            ->where('section', $section)
            ->where('branch', $branch)
            ->get(['st_id']);

        $date_data = Attendance::where('sub_id', $subject)
            ->distinct()
            ->whereIn('st_id', $stu)
            ->orderBy('fromdate')
            ->get(['fromdate', 'todate']);

        return view('attendance.ShowAll', compact('date_data'))
            ->with('sub_id', $subject)
            ->with('section', $section);
    }

    public function updatesave()
    {
        $fromdate = $_REQUEST['fromdate'];
        $todate = $_REQUEST['todate'];
        $semester = $_REQUEST['semester'];
        $subject = $_REQUEST['sub_id'];
        $section = $_REQUEST['section'];

        $all_stu_same_section_same_semester_all_year = Student::where('section', $section)->where('semester', $semester)->get(['st_id']);
        $stu_ids = Attendance::where('fromdate', $fromdate)->where('todate', $todate)->where('sub_id', $subject)->whereIn('st_id', $all_stu_same_section_same_semester_all_year)->get(['st_id']);
        $stu_names = Student::whereIn('st_id', $stu_ids)->get(['st_id', 'name']);
        $stu_att_data = Attendance::whereIn('st_id', $stu_ids)->where('sub_id', $subject)->where('fromdate', $fromdate)->where('todate', $todate)->get();
        return view('attendance.ShowAttendance', compact('stu_ids', 'stu_names'))
            ->with('stu_att_data', $stu_att_data);
    }

    public function saveupdate(Request $request)
    {
        $i = 1;
        for ($i = 1; $i <= 100; $i++) {
            if (!isset($request->$i))
                break;
            else {
                $sub = 'sub_id' . $i;
                $fromdate = 'fromdate' . $i;
                $todate = 'todate' . $i;
                $st_id = $i;
                $attended = 'attended' . $i;
                $totalclasses = 'totalclasses' . $i;

                $subject = $request->$sub;
                $fromdate = $request->$fromdate;
                $todate = $request->$todate;
                $st_id = $request->$st_id;
                $attended = $request->$attended;
                $totalclasses = $request->$totalclasses;

                Attendance::where('st_id', $st_id)
                    ->where('sub_id', $subject)
                    ->where('fromdate', $fromdate)
                    ->where('todate', $todate)
                    ->first()
                    ->update([
                        'totalclasses' => $totalclasses,
                        'attended' => $attended
                    ]);
            }
        }
        return redirect('/attendance/edit?status=success');
    }

    public function delete()
    {
        $subject = $_REQUEST['sub_id'];
        $fromdate = $_REQUEST['fromdate'];
        $todate = $_REQUEST['todate'];

        $section = $_REQUEST['section'];

        $student = Student::where('section', $section)->get(['st_id']);

        Attendance::whereIn('st_id', $student)
            ->where('sub_id', $subject)
            ->where('fromdate', $fromdate)
            ->where('todate', $todate)->delete();

        return redirect('/attendance/edit?status=Delete');
    }


    public function viewattendancepage()
    {


        $username = session('username');
        $usertype = session('usertype');

        if ($usertype != "ADMIN" && $usertype != "STUDENT")
            $userbranch = session('branch');

        if ($usertype == "ADMIN") {
            $semesters = Assignrole::select('semester')->distinct()->get();
            return view('Attendance.viewattendance', compact('semesters'));
            echo "moajd";

        } else if ($usertype == "HOD") {
            $semesters = Assignrole::select('semester')->distinct()->where('branch', $userbranch)->get();
            return view('Attendance.viewattendance', compact('semesters'));

        } else if ($usertype == "FACULTY") {

            $subjects = Assignrole::select('sub_id')->distinct()->where([['branch', '=', $userbranch], ['fac_id', '=', $username]])->get();

            return view('Attendance.viewattendancefaculty', compact('subjects'));

        } else redirect('/home');


    }


    public function showhodattendthirdmul()
    {
        $branch = session('branch');
        $sem = $_REQUEST['sem'];
        $sec = $_REQUEST['sec'];
        $fdate = $_REQUEST['fdate'];
        $tdate = $_REQUEST['tdate'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $sid = $_REQUEST['sid'];

        $students = Student::where([['semester', '=', $sem], ['section', '=', $sec]])->orderBy('st_id')->get(['st_id'])->pluck('st_id');
        $stcount = Student::where([['semester', '=', $sem], ['section', '=', $sec]])->count();

        $studentsname = Student::where([['semester', '=', $sem], ['section', '=', $sec]])->orderBy('st_id')->get(['name'])->pluck('name');


        // $attendance=Attendance::select('st_id','fromdate','todate')->whereIn('st_id',function($query) use($sem,$sec){
        //                                                                                            $query->select('st_id')->from('students')
        //                                                                                            ->where([['semester', '=' ,$sem],['section','=',$sec]]);
        //                                                                                        })->where('sub_id',$sid)->whereIN('fromdate',$fdate,$tdate)->whereIn('todate',$fdate,$tdate)->groupBy('st_id')->get();


        // dd($attendance);

        //  echo   $count=Attendance::select('*')->distinct()->where('sub_id',$sid)->whereBetween('fromdate',[$fdate,$tdate])->whereBetween('todate',[$fdate,$tdate])->where([['semester','=',$sem],['section','=', $sec]])->count();


        $attendance1 = Attendance::select('st_id', 'attended', 'totalclasses')->where('sub_id', $sid)->whereIn('st_id', $students)->whereBetween('fromdate', [$fdate, $tdate])->whereBetween('todate', [$fdate, $tdate])->orderBy('st_id')->get();

        $datecount = Attendance::select('st_id', 'attended', 'totalclasses')->where('sub_id', $sid)->whereIn('st_id', $students)->whereBetween('fromdate', [$fdate, $tdate])->whereBetween('todate', [$fdate, $tdate])->orderBy('st_id')->count();

        echo "<br><br>";
        $ch = $datecount / $stcount;

        return view('attendance.subjectwiseatt', compact('attendance1', 'students', 'studentsname', 'fdate', 'tdate', 'datecount', 'stcount'));


        for ($j = 0; $j < $datecount; $j += $ch) {
            $att = 0;
            $totcls = 0;
            for ($i = 0; $i < $ch; $i++) {
                $att += $attendance1[$j + $i]->attended;
                $totcls += $attendance1[$j + $i]->totalclasses;
            }

            echo $att . "&nbsp" . $totcls . "<br>";


        }

    }

    function showhodattendfourthmul()
    {
        $branch = session('branch');
        $sem = $_REQUEST['sem'];
        $sec = $_REQUEST['sec'];
        $fdate = $_REQUEST['fdate'];
        $tdate = $_REQUEST['tdate'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        //$sid=$_REQUEST['sid'];
        //$cal=$_REQUEST['cal'];


        $sc = $_REQUEST['sc'];
        $tp = $_REQUEST['tp'];
        $incdec = $_REQUEST['incdec'];

        $subids = Assignrole::select('sub_id')->distinct()->where([['semester', '=', $sem], ['section', '=', $sec]])->get();

        if ($sc == 1)

            if ($tp == 3) {
                echo $subjects = Subject::select('sub_id')->whereIn('sub_id', $subids)->where('branch', $branch)->get();
                //dd($subjects);
                $cmdcount = Subject::select('sub_id')->whereIn('sub_id', $subids)->where('branch', $branch)->count();
            } else {
                $subjects = Subject::select('sub_id')->whereIn('sub_id', $subids)->where([['branch', '=', $branch], ['category', '=', $tp]])->orderBy('sub_id')->get();

                $cmdcount = Subject::select('sub_id')->whereIn('sub_id', $subids)->where([['branch', '=', $branch], ['category', '=', $tp]])->count();


            }

        $subjects;

        $students = Student::where([['semester', '=', $sem], ['section', '=', $sec]])->get(['st_id'])->pluck('st_id');
        $stcount = Student::where([['semester', '=', $sem], ['section', '=', $sec]])->count();
        $stname = Student::select('name', 'st_id')->where([['semester', '=', $sem], ['section', '=', $sec]])->orderBy('st_id')->get();


        $atten1 = [];
        $tot1 = [];
        $sub1 = [];

        foreach ($subjects as $sub) {
            $arr3[] = $sub->sub_id;
            # code...

            $datecount = Attendance::select('sub_id', 'st_id', 'attended', 'totalclasses')->where('sub_id', $sub->sub_id)->whereIn('st_id', $students)->whereBetween('fromdate', [$fdate, $tdate])->whereBetween('todate', [$fdate, $tdate])->orderBy('st_id')->count();


            $attendance1 = Attendance::select('sub_id', 'st_id', 'attended', 'totalclasses')->where('sub_id', $sub->sub_id)->whereIn('st_id', $students)->whereBetween('fromdate', [$fdate, $tdate])->whereBetween('todate', [$fdate, $tdate])->orderBy('st_id')->get();


            $ch = $datecount / $stcount;

            for ($j = 0; $j < $datecount; $j += $ch) {
                $att = 0;
                $totcls = 0;
                for ($i = 0; $i < $ch; $i++) {
                    $att += $attendance1[$j + $i]->attended;
                    $totcls += $attendance1[$j + $i]->totalclasses;
                }

                $atten1[] = $att;
                $tot1[] = $totcls;

            }
        }


        return view('attendance.simpleatt', compact('atten1', 'tot1', 'subjects', 'stname', 'stcount', 'cmdcount', 'start', 'end', 'sc'));


    }


    function searchsub()
    {
        $sem = $_REQUEST['sem'];
        $username = session('username');
        $usertype = session('usertype');

        if ($usertype != "ADMIN" && $usertype != "STUDENT")
            $userbranch = session('branch');

        if ($usertype == "ADMIN") {
            $subjects = Assignrole::select('sub_id')->distinct()->where('semester', $sem)->get();
        } else if ($usertype == "HOD") {
            $subjects = Assignrole::select('sub_id')->distinct()->where('branch', $userbranch)->where('semester', $sem)->get();
        } else if ($usertype == "FACULTY") {

            $subjects = Assignrole::select('sub_id')->distinct()->where([['branch', '=', $userbranch], ['fac_id', '=', $username]])->where('semester', $sem)->get();
        } else redirect('/home');

        echo "<option value=''>--SELECT--</option>";
        foreach ($subjects as $subject) {
            echo "<option value='" . $subject->sub_id . "'>" . $subject->sub_id . "</option>";
        }
    }


//------------------------------------------------VIshai--////////////////////
    public function showSem1()
    {
        $fac_id = session('username');
        $sub = $_REQUEST['sub'];
        $sem = Assignrole::where('fac_id', $fac_id)
            ->where('sub_id', $sub)
            ->distinct()
            ->first();
        return $sem->semester;
    }

    public function showClass1()
    {
        $fac_id = session('username');
        $sub = $_REQUEST['sub'];
        $sem = $_REQUEST['sem'];

        $sec = Assignrole::where('fac_id', $fac_id)
            ->where('sub_id', $sub)
            ->where('semester', $sem)
            ->distinct()
            ->get();
        $data = '<option value="">SELECT</option>';
        foreach ($sec as $v) {
            $data = $data . '<option value="' . $v->section . '">' . $v->section . '</option>';
        }
        return $data;
    }

    public function showFacultyAttendance()
    {
        $branch = session('branch');
        $sem = $_REQUEST['sem'];
        $sec = $_REQUEST['sec'];
        $fdate = $_REQUEST['fdate'];
        $tdate = $_REQUEST['todate'];
        $type = '';
        //$start=$_REQUEST['start'];
        //$end=$_REQUEST['end'];
        $sub_id = $_REQUEST['sub'];

        $students = Student::where([['semester', '=', $sem], ['section', '=', $sec]])
            ->get(['st_id']);

        $abc = Attendance::select('st_id')
            ->where('sub_id', $sub_id)
            ->whereIn('st_id', $students)
            ->whereBetween('fromdate', [$fdate, $tdate])
            ->whereBetween('todate', [$fdate, $tdate])
            ->orderBy('st_id')
            ->get(['st_id']);

        $studentsName = Student::where([['semester', '=', $sem], ['section', '=', $sec]])
            ->whereIn('st_id', $abc)
            ->get();

        $stcount = Student::where([['semester', '=', $sem], ['section', '=', $sec]])
            ->count();


        $attendance1 = Attendance::select('st_id', 'fromdate', 'todate', 'attended', 'totalclasses')
            ->where('sub_id', $sub_id)
            ->whereIn('st_id', $students)
            ->whereBetween('fromdate', [$fdate, $tdate])
            ->whereBetween('todate', [$fdate, $tdate])
            ->orderBy('st_id')
            ->get();

        $datecount = Attendance::select('st_id', 'attended', 'totalclasses')
            ->where('sub_id', $sub_id)
            ->whereIn('st_id', $students)
            ->whereBetween('fromdate', [$fdate, $tdate])
            ->whereBetween('todate', [$fdate, $tdate])
            ->orderBy('st_id')
            ->count();

        if (isset($_REQUEST['less'])) {
            return view('attendance.attendance')
                ->with('datecount', $datecount)
                ->with('stcount', $stcount)
                ->with('attendance1', $attendance1)
                ->with('fromdate', $fdate)
                ->with('todate', $tdate)
                ->with('stdata', $studentsName)
                ->with('less', $_REQUEST['less'])
                ->with('type', $type);
        }
        if (isset($_REQUEST['great'])) {
            return view('attendance.attendance')
                ->with('datecount', $datecount)
                ->with('stcount', $stcount)
                ->with('attendance1', $attendance1)
                ->with('fromdate', $fdate)
                ->with('todate', $tdate)
                ->with('stdata', $studentsName)
                ->with('great', $_REQUEST['great'])
                ->with('type', $type);
        }
        if (isset($_REQUEST['max']) and isset($_REQUEST['min'])) {
            return view('attendance.attendance')
                ->with('datecount', $datecount)
                ->with('stcount', $stcount)
                ->with('attendance1', $attendance1)
                ->with('fromdate', $fdate)
                ->with('todate', $tdate)
                ->with('stdata', $studentsName)
                ->with('min', $_REQUEST['min'])
                ->with('max', $_REQUEST['max'])
                ->with('type', $type);
        }

        if (!isset($_REQUEST['less']) and !isset($_REQUEST['great']) and !isset($_REQUEST['min']) and !isset($_REQUEST['max'])) {
            return view('attendance.attendance')
                ->with('datecount', $datecount)
                ->with('stcount', $stcount)
                ->with('attendance1', $attendance1)
                ->with('fromdate', $fdate)
                ->with('todate', $tdate)
                ->with('stdata', $studentsName)
                ->with('type', $type);
        }

        $ch = $datecount / $stcount;

        for ($j = 0; $j < $datecount; $j += $ch) {
            $att = 0;
            $totcls = 0;
            for ($i = 0; $i < $ch; $i++) {
                $att += $attendance1[$j + $i]->attended;
                $totcls += $attendance1[$j + $i]->totalclasses;
            }

            echo $att . "&nbsp" . $totcls . "<br>";
        }

    }

}




