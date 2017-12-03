<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function BulkChangeStud()
    {
        $branchs = Student::select('branch')
            ->distinct()
            ->orderBy('branch', 'asc')
            ->get(['branch']);
        return view('Settings.BulkChangeStud')
            ->with('branchs', $branchs);
    }

    public function SetGetSec()
    {
        $branch=$_REQUEST['branch'];
        $secs=Student::where('branch',$branch)
            ->distinct()
            ->orderBy('section','asc')
            ->get(['section']);

        echo '<option value="">SELECT</option>';
        foreach ($secs as $sec)
        {
            echo '<option value="'.$sec->section.'">'.$sec->section.'</option>';
        }
    }

    public function SetGetSem()
    {
        $branch=$_REQUEST['branch'];
        $sems=Student::where('branch',$branch)
            ->distinct()
            ->orderBy('semester','asc')
            ->get(['semester']);

        echo '<option value="">SELECT</option>';
        foreach ($sems as $sem)
        {
            echo '<option value="'.$sem->semester.'">'.$sem->semester.'</option>';
        }
    }

    public function SetGetDetail()
    {
        $branch=$_REQUEST['branch'];
        $section=$_REQUEST['section'];
        $semester=$_REQUEST['semester'];
        $students=Student::where('branch',$branch)
                ->where('section',$section)
                ->where('semester',$semester)
                ->orderBy('st_id','asc')
                ->get();
        return view('Settings.ChangeStudSemBulk')
            ->with('students',$students);
    }

    public function BulkChangeStudUpdate(Request $request)
    {
        $branch=$_REQUEST['branch'];
        $semester=$_REQUEST['semester'];
        $section=$_REQUEST['section'];

        $students = Student::where('branch',$branch)
            ->where('section', $section)
            ->where('semester', $semester)
            ->get();

        $st_ids = [];
        foreach ($students as $student) {
            $st_ids[] = $student->st_id;
        }

        foreach ($st_ids as $st_id)
        {
            Student::where('st_id')
                ->update(['semester'=>$request->$st_id]);
        }

        return view('errors.success');
    }
}
