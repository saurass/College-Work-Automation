@extends('layouts.attendance')
@section('content')
    
<div class="col m8 offset-m2">
    <div class="card z-depth-5">
       <div class="card-content">


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
            
            <td>{{$mark->status}}</td>
  
          <td>
           <form action="/deletes/{{$mark->id}}" method="GET">
              {{ csrf_field()}}
              {{ method_field('DELETE')}}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <button class="btn btn-danger btn-delete">Delete</button>

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
