<?php

namespace App\Http\Controllers;

use App\Facultylogin;
use Illuminate\Http\Request;
use DB;
use App\Assignrole;
use App\Student;
use session;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Exception;

class StudentController extends Controller
{

    public function index()
    {
        $usertype = session('usertype');
        if ($usertype == "ADMIN") {
            $sem = Assignrole::select('semester')->distinct()->get();
        } else if ($usertype == "HOD") {
            $branch = session('branch');
            $sem = Assignrole::select('semester')->where('branch', $branch)->distinct()->get();
        }
        return view('student.add_stud', compact('sem', 'usertype'));
    }

    public function branch($sem)
    {
        $sem;
        $username = session('username');
        $usertype = session('usertype');
        if ($usertype != "ADMIN" && $usertype != "STUDENT")
            $userbranch = session('branch');


        if ($usertype == "ADMIN") {
            $branch = Assignrole::where('semester', $sem)->distinct()->get(['branch']);
            $branchs = [];
            foreach ($branch as $v) {
                $branchs[] = $v->branch;
            }
            $branchs = array_unique($branchs);
            $branchstr = '<option value="">SELECT</option>';
            foreach ($branchs as $b) {
                $branchstr = $branchstr . '<option value="' . $b . '">' . $b . '</option>';
            }

            return $branchstr;
        } else {

            echo "<option value=''>SELECT</option>
        <option value='$userbranch'>" . $userbranch . "</option>";
        }
    }

    public function section($sem, $branch)
    {
        $branch1 = Assignrole::select('section')->where([['semester', '=', $sem], ['branch', '=', $branch]])->distinct()->orderby('section')->get();
        foreach ($branch1 as $bran) {
            echo "<option>" . $bran->section . "</option>";
        }
    }


    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'st_id' => Rule::unique('students', 'st_id')->where('st_id', $request->st_id),
                //'sub_id'=>'filled|string|max:7',

            ],
            [
                'st_id.unique' => 'Roll number Already Exists',
            ]);

        $check = Student::where('st_id', $request->st_id)->get();


        if (isset($check->st_id) && $check->st_id != NULL) {

            return redirect('./addstud');

        } else {
            $ch = Student::create($request->all());
            if (isset($ch)) {

                return redirect('./addstud?status=sucess');
            } else
                echo '<script>alert("Please try again")</script>';
        }
    }

    public function updatepage()
    {
        return view('student.update');
    }


    public function edit()
    {
        $st_id = $_REQUEST['st_id'];
        $Student = Student::where('st_id', $st_id)->first();
        if ($Student != NULL) {
            $branch = $Student->branch;
            $section = $Student->section;
            $branch1 = Student::where('branch', $Student->branch)->distinct()->where('semester', '=', $Student->semester)->distinct()->get(['section']);
            return view('student.updated', compact('Student'))
                ->with('branch1', $branch1);

        } else
            return redirect('/updatestud?errors=NotExist');


    }

    public function update(Request $request)
    {
        //return $request->all();
        //return $request->semester;
        // $data=Student::where('branch',$_REQUEST['branch'])->where('semester',$_REQUEST['semester'])->where('name','=','name')->first();
        // return $data;
// echo $request->st_id;
// echo $request->section;
        $ch = DB::table('Students')
            ->where('st_id', $request->st_id)
            ->update(['section' => $request->section]);

        if ($ch)
            return redirect('/updatestud?errors=Sucess');


        if ($ch) {
            echo '<script>alert("Successfully Updated")</script>';
            return redirect('updatestud');
        } else {
            echo '<script>alert("Try again")</script>';
            return redirect('updatestud');
        }
    }

    public function deleteit()
    {
        return view('student.red');
    }

    public function showdetails()
    {
        $st_id = $_REQUEST['st_id'];
        $Student = Student::where('st_id', $st_id)->first();
        $branch = $Student->branch;
        $section = $Student->section;
        $branch1 = Student::where('branch', $Student->branch)->distinct()->where('semester', '=', $Student->semester)->distinct()->get(['section']);
        return view('student.deleted', compact('Student'))
            ->with('branch1', $branch1);
    }

    public function delete(Request $request)
    {
        $ch = DB::table('Students')->where('st_id', $request->st_id)->delete();
        if ($ch) ;
        {
            echo '<script>alert("Student Successfully Deleted")</script>';
            return view('student.red');
        }
    }

    public function BulkAddStud()
    {
        $user = session('username');
        $cat = Facultylogin::where('userid', $user)->first()->category;
        if ($cat == 'ADMIN') {
            return view('student.addBulk');
        } else {
            return redirect('errors.Unauthorized');
        }
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function addBulkStud(Exception $e)
    {
        $dir = getcwd();
        $target_dir = $dir . "\\";
        $target_file = $target_dir . 'stu.csv';
        $han = fopen($target_file, 'a');
        fclose($han);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        move_uploaded_file($_FILES["csv"]["tmp_name"], $target_file);


        $fileD = fopen($target_file, "r");
        $column = fgetcsv($fileD);
        $rowData = [];
        while (!feof($fileD)) {
            $rowData[] = fgetcsv($fileD);
        }

        foreach ($rowData as $key => $value) {

            Student::create([
                'st_id' => $value[0],
                'name' => $value[1],
                'semester' => $value[2],
                'section' => $value[3],
                'branch' => $value[4],
            ]);
        }
    }
}