
@extends('layouts.attendance')
@section('content')
    
<div class="col m8 offset-m2">
    <div class="card z-depth-5">
     <div class="card-content">

     
    @if ($errors->any())
<div class="alert alert-danger" role="alert" style="font-size:20px;">
  
            @foreach ($errors->all() as $error)
                 
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
   
            
                {{ $error }}
                <p>
            @endforeach
        
</div>
@endif


        @if(isset($_REQUEST['status']) and $_REQUEST['status']=='alreadyexists')
            <th class="header">EXAM ALREADY ADDED</th>
        @endif
    <form action="/storeExams" method="post">
        {{ csrf_field() }}
         
                <span class="card-title center">Add Marks</span>
                   <p class="center">PLEASE ENTER ALL DETAILS</p>


                <b>BRANCH :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="branch" id="branch" class="browser-default" onchange="showSem()" required>
                            <option value="">SELECT</option>
                            @foreach ($branch as $sec) {
                             <option value="{{$sec->branch}}">{{$sec->branch}}</option>
                            @endforeach
                        </select><br><br>


                <b>SEMESTER:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="semester" id="sem" class="browser-default" required>
                            <option value="">SELECT</option>
                        </select><br><br>


                <b>Exam Type:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="examType" id="examtype" class="browser-default" onclick="getexam()" required>
                    <option value="">SELECT</option>
                    <option value="T">Thoery/Open Elective</option>
                    <option value="P">Practical</option>
                </select><br><br>

                <b>EXAM:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="exam_name" id="exam" class="browser-default" onchange="getExamName()" required>
                            <option value="">SELECT</option>
                        </select><br><br>

        <b>EXAM NAME:</b>
                <input type="text" name="examname" id="examname" class="text-accent-2" required readonly>&nbsp;

                 <b>MAX. MARKS:</b>
                 <input type="text" id="max" name="max_mark" required>
                 <br><br>

                  <b>STATUS:</b>
                        <select name="status" id="status" class="browser-default"required>
                            <option value="">SELECT</option>
                            
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select><br><br>


                  <input type="submit" id="submit" class="btn btn-primary form-control">

                    
                     
                     
                </div>
            </div>
        </div>
    </form>

<script src="/js/Marks.js"></script>
@endsection
