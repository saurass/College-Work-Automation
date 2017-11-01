@extends('layouts.attendance')
@section('content')
        <div class="col m8 offset-m2">
            
             @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='NotExist')
        <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h5>Error Occured !!<br> Roll Number Doesn't Exist</h5></div>

        </div>
        </div>
        </div>
    @endif
         @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='Sucess')
        <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h5> Student updated sucessfully..!!</h5></div>

        </div>
        </div>
        </div>
    @endif


            <form action="/updatestud" method="post">
            <div class="card z-depth-5">
                {{ csrf_field() }}
                {{ method_field('POST')}}
                @if($errors->any())
                    <div class="form-control panel-body">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-content">
                <span class="card-title center">Update Student</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>
                    <div class="input-field">
                                 <input type="text" name="st_id" id="st_id" maxlength="10"><br><br><label for="st_id">University Roll no</label>
                    </div><br><br>

<input type="submit" name="submit" class="btn green right-align form-control" value="View">
</form>
</div>
@endsection
 