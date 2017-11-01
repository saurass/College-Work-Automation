@extends('layouts.attendance')
@section('content')
    
<div class="col m8 offset-m2">
    <div class="card z-depth-5">
     <div class="card-content">

    @if(isset($_REQUEST['errors']) and $_REQUEST['errors']=='reassigned')
       <div class="center">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-warning">
                A Role Is Already Assigned To The Batch Please Update Or Delete OldOne
            </div>
        </div>
        </div>
    @endif



    <form action="/assignrole" method="post">
        {{ csrf_field() }}
         
                <span class="card-title center">Add Subject</span>
                   <p class="center">PLEASE ENTER ALL DETAILS</p>


                        <b>FACULTY DEPARTMENT :</b>
                        <select name="branch" id="Department" class="browser-default" onchange="showFac()" required>
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

                    <b>FACULTY NAME :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="fac_id" id="fac_" class="browser-default" onchange="showBatch()" required>
                        <option value="">SELECT</option>
                    </select><br><br>

                    <b>SELECT BATCH :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="section" id="batch" class="browser-default" required>
                        <option value="">SELECT</option>
                    </select><br><br>

                    <input type="hidden" name="semester" value="{{ $sem }}" name="branch">
                    <input type="hidden" id="dep" name="department" value="{{ $dep }}">
                    <input type="hidden" id="dep" name="sub_id" value="{{ $sub_id }}">

                    <input type="submit" id="submit" class="btn btn-primary form-control">
                </div>
            </div>
        </div>
    </form>

<script src="/js/AddAssignRole.js"></script>
@endsection
