<?php

namespace App\Http\Controllers;

use App\Assignrole;
use App\Facultylogin;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class AssignRoleController extends Controller
{
    public function index()
    {
        //
        $username = session('username');
        $category = Facultylogin::where('userid', $username)->first()->category;
        if ($category == 'HOD') {
            $department = Facultylogin::where('userid', $username)->first()->branch;
            $sub = Subject::where('branch', $department)->get();
            return view('AssignRole.AddNew', compact('sub', 'category', 'department'));
        } else {
            $sub = Subject::all();
            return view('AssignRole.AddNew', compact('sub', 'category'));
            return "not possible";
        }
    }

    public function create(Request $request)
    {
        //
        $dep = $request->sub_dep;
        $sem = $request->sub_sem;
        $sub_id = $request->sub_id;
        $category = $request->cats;
        return view('AssignRole.NewAssignRole', compact('dep', 'sem'))
            ->with('sub_id', $sub_id)
            ->with('category', $category);
    }

    public function store(Request $request)
    {
        $check = Assignrole::where('sub_id', $request->sub_id)
            ->where('semester', $request->semester)
            ->where('section', $request->section)->get();
        $sub_cat = Subject::where('sub_id', $request->sub_id)
            ->first()
            ->category;
        if (isset($check[0]->fac_id) and $sub_cat != 'O') {
            return redirect('/assignrole?errors=AlreadyAssigned');
        } else {
            Assignrole::create($request->all());
            return redirect('/assignrole?errors=Success');
        }
    }

    public function edit($id)
    {
        //
        $allBranch = Assignrole::select('branch')->distinct()->get();
        $roledata = Assignrole::where('id', $id)->first();
        $allfac = Facultylogin::all();
        return view('AssignRole.UpdateRole', compact('roledata', 'allfac'))
            ->with('allBranch', $allBranch);
    }

    public function update(Request $request, $id)
    {
        //
        $got = Assignrole::find($id);
        $got->timestamps = false;
        $got->fac_id = $request->faculty;
        $got->save();
        return redirect('/assignrole?status=success');
    }

    public function destroy($id)
    {
        //
        Assignrole::where('id', $id)->delete();
        return redirect('/assignrole');
    }

    public function showall()
    {
        $dep = $_REQUEST['branch'];
        $sem = $_REQUEST['semester'];
        $sub = $_REQUEST['sub_id'];
        $sub_cat = Subject::where('sub_id', $sub)->first()->category;
        $category = Subject::where('sub_id', $sub)->first()->category;
        $data = Assignrole::where('branch', $dep)->where('semester', $sem)->where('sub_id', $sub)->get();
        $subdata = Subject::all();
        return view('AssignRole.ShowAll', compact('data', 'subdata'))
            ->with('fac', Facultylogin::all())
            ->with('sub_dep', $dep)
            ->with('sub_sem', $sem)
            ->with('subid', $sub)
            ->with('cats', $category)
            ->with('sub_cat', $sub_cat);
    }

    public function show()
    {
        $username = session('username');
        $category = Facultylogin::where('userid', $username)->first()->category;
        $semesters = Assignrole::select('semester')->orderBy('semester', 'asc')->distinct()->get(['semester']);
        if ($category == 'HOD') {
            $branch = Facultylogin::where('userid', $username)->first()->branch;
            return view('AssignRole.viewAssignRole')
                ->with('category', $category)
                ->with('branch', $branch)
                ->with('semesters', $semesters);
        } elseif ($category == 'ADMIN') {
            $branch = Facultylogin::select('branch')->distinct()->get(['branch']);
            return view('AssignRole.viewAssignRole')
                ->with('category', $category)
                ->with('branch', $branch)
                ->with('semesters', $semesters);
        } else
            return "UnAuthorized Access !";
    }

    public function viewAssignSection()
    {
        $branch = $_REQUEST['branch'];
        $data = Student::select('section')
            ->where('branch', $branch)
            ->orderBy('section', 'asc')
            ->distinct()
            ->get(['section']);
        $datas = [];
        foreach ($data as $v) {
            $datas[] = $v->section;
        }
        $datas = array_unique($datas);
        $datastr = '<option value="">SELECT</option>';
        foreach ($datas as $b) {
            $datastr = $datastr . '<option value="' . $b . '">' . $b . '</option>';
        }
        return $datastr;
    }

    public function viewAssignGetData()
    {
        $branch = $_REQUEST['branch'];
        $section = $_REQUEST['section'];
        $semester = $_REQUEST['semester'];
        $data = Assignrole::where('branch', $branch)
            ->where('section', $section)
            ->where('semester', $semester)
            ->get();

        $fac_data = Facultylogin::all(['userid', 'name']);
        $sub_data = Subject::where('branch', $branch)->where('semester', $semester)->get(['sub_id', 'sub_name']);
        return view('AssignRole.viewAssignRoleData')
            ->with('data', $data)
            ->with('fac_data', $fac_data)
            ->with('sub_data', $sub_data);
    }

    public function viewAssignSem2()
    {
        $branch = $_REQUEST['branch'];
        $data = Subject::where('branch', $branch)
            ->orderBy('semester', 'asc')
            ->distinct()
            ->get(['semester']);
        $datas = [];
        foreach ($data as $v) {
            $datas[] = $v->semester;
        }
        $datas = array_unique($datas);
        $datastr = '<option value="">SELECT</option>';
        foreach ($datas as $b) {
            $datastr = $datastr . '<option value="' . $b . '">' . $b . '</option>';
        }
        return $datastr;
    }

    public function viewAssignGetData2()
    {
        $branch = $_REQUEST['branch'];
        $semester = $_REQUEST['semester'];

        $data = Assignrole::where('branch', $branch)
            ->where('semester', $semester)
            ->orderBy('semester', 'asc')
            ->orderBy('section', 'asc')
            ->get();

        $fac_data = Facultylogin::all(['userid', 'name']);
        $sub_data = Subject::where('branch', $branch)
            ->where('semester', $semester)
            ->get(['sub_id', 'sub_name']);
        return view('AssignRole.viewAssignRoleData2')
            ->with('data', $data)
            ->with('fac_data', $fac_data)
            ->with('sub_data', $sub_data);
    }

    public function UpdateOEStud($id, Request $request)
    {
        $AssData = Assignrole::where('id', $id)->first();
        $fac = $AssData->fac_id;
        $sub_id = $AssData->sub_id;
        $allFacs = Assignrole::where('semester', $AssData->semester)
            ->where('section', $AssData->section)
            ->where('sub_id', $sub_id)->get(['fac_id']);
        $FacData = Facultylogin::whereIn('userid', $allFacs)->get(['userid']);

        $students = Student::where('semester', $AssData->semester)
            ->where('section', $AssData->section)
            ->orderBy('st_id', 'asc')->get();

        $FacData = Facultylogin::whereIn('userid', $allFacs)->get();
        return view('AssignRole.UpdateOEStud')
            ->with('AssData', $AssData)
            ->with('students', $students)
            ->with('FacDatas', $FacData)
            ->with('fac', $fac)
            ->with('sec', $AssData->section)
            ->with('sem', $AssData->semester)
            ->with('subs',$sub_id);
    }

    public function updateOEStuds(Request $request, $sec, $sem, $fac,$sub)
    {
        $AssData=Assignrole::where('fac_id',$fac)
                            ->where('section',$sec)
                            ->where('sub_id',$sub)
                            ->where('semester',$sem)->first();
        $sub=$AssData->sub_id;
        $allFacs=Assignrole::select('fac_id')->where('sub_id',$sub)
            ->where('semester',$sem)
            ->distinct()
            ->get(['fac_id']);

        $facs=[];
        foreach ($allFacs as $allFac)
        {
            $facs[]=$allFac->fac_id;
        }

        $students = Student::where('section', $sec)
            ->where('semester', $sem)
            ->get();
        $st_ids = [];
        foreach ($students as $student) {
            $st_ids[] = $student->st_id;
        }
        foreach ($st_ids as $st_id) {
            $s = $request->$st_id;
            if ($s=='on')
            {
                $stud=Student::where('st_id',$st_id)->first();
                if(in_array($stud->OE1,$facs) and isset($stud->OE1))
                {
                    Student::where('st_id',$st_id)
                        ->update(['OE1'=>$fac]);
                }
                elseif(in_array($stud->OE2,$facs) and isset($stud->OE2))
                {
                    Student::where('st_id',$st_id)
                        ->update(['OE2'=>$fac]);
                }
                elseif(in_array($stud->OE3,$facs) and isset($stud->OE3))
                {
                    Student::where('st_id',$st_id)
                        ->update(['OE3'=>$fac]);
                }
                elseif(!in_array($stud->OE1,$facs) and !in_array($stud->OE2,$facs) and !in_array($stud->OE2,$facs))
                {
                    if($stud->OE1=='')
                    {
                        Student::where('st_id',$st_id)
                            ->update(['OE1'=>$fac]);
                    }
                    elseif($stud->OE2=='')
                    {
                        Student::where('st_id',$st_id)
                            ->update(['OE2'=>$fac]);
                    }
                    elseif($stud->OE3=='')
                    {
                        Student::where('st_id',$st_id)
                            ->update(['OE3'=>$fac]);
                    }
                }
            }
        }
        return redirect('/assignrolesuccessOE');
    }

}