@extends('layouts.attendance')
@section('content')
    <!-- <center> -->
        <div class="col m8 offset-m2"> 
          
        @if($errors->any())
                   <div class="center">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                       
                           <div class=""><h5>Error Occured..!!</h5><h5>
                           <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </h5>
                    </div>
                    </div>
                    </div>
                    </div>


                 
                @endif


                @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='Sucess')
        <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h5>Subject Added Sucessfully..!!</h5></div>

        </div>
        </div>
        </div>
    @endif


            <form action="/subject" method="post">
                {{ csrf_field() }}
                

               
            <div class="card z-depth-5">
                <div class="card-content">
                <span class="card-title center">Add Subject</span>
                   <p class="center">PLEASE ENTER ALL DETAILS</p>

                 <div class="input-field">
                    <input type="text" name="sub_id" required id="sub_id" minlength="7" maxlength="7">
                    <label for="sub_id">Subject Code</label>
                </div> 
                   
                <div class="input-field">

                    <input type="text" name="sub_name" required id="sub_id">
                    <label for="sub_id">Subject Name</label>
                    

                 </div>   
                    <b>PLEASE SELECT FIELDS</b><br><br>
                    SEMESTER :
                    <select name="semester" required class="browser-default">
                        <option value="">SELECT</option>
                        
                        @foreach($sems as $sem)
                        <option value="{{$sem->semester}}">{{$sem->semester}}</option>
                       @endforeach
                    </select><br>
                    CATEGORY :
                    <br>
                    <select name="category" required class="browser-default">
                        <option value="">SELECT</option>
                        <option value="T">Theory</option>
                        <option value="P">Practical</option>
                        <option value="O">Open Elective</option>
                    </select><br>
                    @if($category=='ADMIN')
                        BRANCH : <select name="branch" required class="browser-default">
                            <option value="">SELECT</option>
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                            <option value="ECE">ECE</option>
                            <option value="ME">ME</option>
                            <option value="CE">CE</option>
                            <option value="EI">EI</option>
                            <option value="EN">EN</option>
                            <option value="MBA">MBA</option>
                            <option value="MBA">MBA</option>
                        </select><br>
                    @endif
                    @if($category=='HOD')
                        <input type="hidden" value="{{ $department }}" name="branch">
                    @endif
                    <br><input type="submit" class="btn btn-primary form-control" name="addsubject" value="ADD">
                </div>
            </form>
            </div>
            </div>

            
        </div>
    <!-- </center> -->
@endsection