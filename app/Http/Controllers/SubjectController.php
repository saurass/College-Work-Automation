<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Facultylogin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Assignrole;

class SubjectController extends Controller
{
    public function index()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        if($category == "ADMIN")
        {
            $AllSub=Subject::paginate(10);
            return view('Subject.ShowAll',compact('AllSub'));
        }
        else
        {
            $department=Facultylogin::where('userid',$username)->first()->branch;
            $AllSub=Subject::where('branch',$department)->get();
            return view('Subject.ShowAll',compact('AllSub'));
        }
    }

    public function create()
    {
        $username=session('username');
        
          
        $category=Facultylogin::where('userid',$username)->first()->category;
        $department=Facultylogin::where('userid',$username)->first()->branch;
        
        if($category=="ADMIN")
            $sems=Assignrole::select('semester')->distinct()->get();
        else if($category=='HOD')
            { $branch=session('branch');

             $sems=Assignrole::select('semester')->distinct()->where('branch',$branch)->get();
            } 

        return view('Subject.AddSubject',compact('category','department','sems'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'sub_id'=>Rule::unique('subjects','sub_id')->where('sub_id',$request->sub_id)->where('branch',$request->branch),
                //'sub_id'=>'filled|string|max:7',
                'sub_name'=>'filled|string',
                'category'=>'filled|string|max:1|min:1',
                'branch'=>'filled|string|max:4',
                'semester'=>'filled|integer|max:8|min:1',
            ],
            [
                'sub_id.unique'=>'Subject Id Already Exists',
                'sub_name.unique'=>'Subject Name Already Exists',
            ]
        );
       if( Subject::create($request->all()));
        {
        echo "<script> alert('Information Updated'); </script>";
        
        return redirect('/subject/create?errors=Sucess');
    }
    }

    public function show($id)
    {
        //
    }

    public function edit($id,$branch)
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        $SubData=Subject::where('sub_id',$id)->where('branch',$branch)->first();
        $department=Facultylogin::where('userid',$username)->first()->branch;
        return view('Subject.EditSubject',compact('SubData','category','department'));
    }

    public function update(Request $request, $id)
    {
        Subject::where('id',$id)->update(['sub_id'=>$request->sub_id]);
        Subject::where('id',$id)->update(['sub_name'=>$request->sub_name]);
        Subject::where('id',$id)->update(['branch'=>$request->branch]);
        Subject::where('id',$id)->update(['semester'=>$request->semester]);
        Subject::where('id',$id)->update(['category'=>$request->category]);

        echo "<script> alert('Information Updated'); </script>";
        return redirect('/subject?status=successupdate');
    }

    public function destroy(Request $request,$id)
    {
        Subject::where('id',$id)->delete();
        return redirect($request->redirect);
    }

    public function searchsubdata()
    {

        $str=$_REQUEST['str'];
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;

        if($category=="HOD")
        {
            $department=Facultylogin::where('userid',$username)
                ->first()
                ->branch;
            $SubData=Subject::where('sub_id',$str)
                ->where('branch',$department)
                ->first();
            $category=Facultylogin::where('userid',$username)
                ->first()
                ->category;
            if (!isset($SubData->sub_id) or $SubData->sub_id == Null)
                return view('Faculty.NotFound');
            elseif ($SubData->branch == $department)
                return view('Subject.EditSubject',compact('category','department'))->with('SubData',$SubData);
            else
                return view('Faculty.HodCantAccessFaculty');
        }
        elseif($category=="ADMIN")
        {
            $department=Facultylogin::where('userid',$username)
                ->first()
                ->branch;
            $SubData=Subject::where('sub_id',$str)
                ->first();
            $category=Facultylogin::where('userid',$username)
                ->first()
                ->category;
            if (!isset($SubData->sub_id) or $SubData->sub_id == Null)
                return view('Faculty.NotFound');
            else
                return view('Subject.EditSubject',compact('SubData','category','department'));
        }
        else
        {
            return "UnAuthorised Access !!";
        }
    }

    public function searchdelsubdata()
    {
        $str=$_REQUEST['str'];
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        if($category=="HOD")
        {
            $department=Facultylogin::where('userid',$username)->first()->branch;
            $AllSub=Subject::where('branch',$department)->where('sub_id','LIKE',"%$str%")->get();
            return view('Subject.ShowAllDel',compact('AllSub'));
        }
        else
        {
            $AllSub=Subject::where('sub_id','LIKE',"%$str%")->get();
            return view('Subject.ShowAllDel',compact('AllSub'));
        }
    }

    public function deletesub()
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        if($category == "ADMIN")
        {
            $AllSub=Subject::all();
            return view('Subject.ShowAllDel',compact('AllSub'));
        }
        else
        {
            $department=Facultylogin::where('userid',$username)->first()->branch;
            $AllSub=Subject::where('branch',$department)->get();
            
            return view('Subject.ShowAllDel',compact('AllSub'));
        }
    }
}
