
@extends('layouts.attendance')

@section('content')
<script src="/js/AddAssignRole.js"></script>
 <div class="col m8 offset-m2">
        
    @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='AlreadyAssigned')
        <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h5> Error Occured..!!<br>A Faculty Was Already Assigned To The Respective Role</h5><br><h6>Please delete the old role or updtae it</h6></div>

            </div>
        </div>
        </div>
    @endif
    @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='Success')
       <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h5>Role Assigned Sucessfully..!!</h5></div>

        </div>
        </div>
        </div>
    @endif
        @if(isset($_REQUEST['status']) && $_REQUEST['status']=='success')
            <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h5>
                        Role Successfully Updated.. !</h5>
                        </div>

                    </div>
                </div>
            </div>


        @endif
   
   <div class="card z-depth-5">
        <div class="card-content">
    <form action="/assignrole/showall" method="post">
        {{ csrf_field() }}
         
                <span class="card-title center">View Faculty Assigned</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>
                    <div class="input-field">
                    @if($category=="ADMIN")
                        <b>DEPARTMENT :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="branch" id="Department" class="btn btn-primary" onchange="showSem()" required>
                            <option value="">SELECT</option>
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                            <option value="ECE">ECE</option>
                            <option value="ME">ME</option>
                            <option value="CE">CE</option>
                            <option value="EI">EI</option>
                            <option value="EN">EN</option>
                            <option value="MBA">MBA</option>
                            <option value="MCA">MCA</option>
                        </select><br><br>
                    @else
                        <input type="hidden" id="Department" name="branch" value="{{ $department }}">
                        <script>
                            if (document.getElementById('Department').value != '')
                            {
                                showSem();
                            }
                        </script>
                    @endif
                    <b>SEMESTER  :</b>;
                    <select name="semester" class="browser-default" id="sem" onchange="showCategory()" required>
                        <option value="">SELECT</option>
                    </select><br><br>
                    <b>CATEGORY  :</b>
                    <select name="category" class="browser-default" id="category" onchange="showSub()" required>
                        <option value="">SELECT</option>
                    </select><br>
                    <br><b>SUBJECT  :</b>
            <select name="sub_id" id="sub" class="browser-default">
                        <option value="">SELECT</option>
                    </select><br><br>
                    <input type="submit" id="submit" class="btn green right-align form-control">
                </div>
                </div>

            </div>
        </div>
    </form>
@endsection
