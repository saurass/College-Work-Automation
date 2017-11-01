@extends('layouts.attendance')
@section('content')
    
<div class="col m8 offset-m2">
    <div class="card z-depth-5">
       <div class="card-content">

@if(isset($_REQUEST['status']) and $_REQUEST['status']=='success')
    <th class="header">SUCCESS</th>
@endif
    @if(isset($_REQUEST['status']) and $_REQUEST['status']=='examsuccess')
        <th class="header">EXAM SUCCESSFULLY ADDED</th>
    @endif
<table class="table table-responsive table-hover table-bordered col-lg-12">
  		  
    <thead>
        <th>Sr. No.</th>
        <th>Branch</th>
        <th>Semester</th>
        <th>Exam Name</th>
        <th>Status</th>
    </thead>

    <tbody>

    @foreach($marks as $mark)
        <tr>
               <td>{{$mark->id}}</td>
               <td>{{$mark->branch}}</td>
               <td>{{$mark->semester}}</td>
               <td>{{$mark->exam_name}}</td>

               <td>
                   <form action="/updateExamStatus/{{$mark->id}}" method="GET">
                       {{ csrf_field()}}
                       @if($mark->status == 1)
                           Active/<button class="btn btn-danger">NotAllow</button>

                       @elseif($mark->status == 0)
                                 Inactive/<button class="btn btn-success">Allow</button>

                       @endif
                   </form>
               </td>
        </tr>
    @endforeach

    </tbody>
</table>        	

        </div>
    </div>
</div>
   

<script src="/js/Marks.js"></script>
@endsection
