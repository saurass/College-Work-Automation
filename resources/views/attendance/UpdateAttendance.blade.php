
@extends('layouts.attendance')
@section('content')
<script src="/js/AddAssignRole.js"></script>
<script src="/js/editattendance.js"></script>
<div class="col m8 offset-m2">
    <div class="card z-depth-5">
        <div class="card-content">
    @if(isset($_REQUEST['status']) and $_REQUEST['status']=='success')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-heading">
                UPDATED SUCCESSFULLY !!
            </div>
        </div>
    @endif
    @if(isset($_REQUEST['status']) and $_REQUEST['status']=='Delete')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-heading">
                DELETED SUCCESSFULLY !!
            </div>
        </div>
    @endif
    <form action="" method="post">
    <div class="col-md-6 col-md-offset-3">
        <span class="card-title center">Update Attendance</span>
                   <p class="center">PLEASE ENTER ALL DETAILS</p>


                @if($priveledge=="HOD")
                    <input type="hidden" name="branch" id="Department" value="{{ $department }}">
                    <script type="text/javascript">
                        
                    showSem();                        
                    </script>
                @else
                    <b>Department :  </b>
                    <select name="branch" required onchange="showSem()" id="Department" class="browser-default">
                        @foreach($department as $v)
                            <option value="{{ $v }}">{{ $v }}</option>
                        @endforeach
                    </select>
                @endif
                <br><br>
                <b>SEMESTER : </b>
                <select name="semester" id="sem" required onchange="showSec()" class="browser-default">
                        <option value="">SELECT</option>
                </select>
                <br><br>
                <b>SECTION : </b>
                <select name="section" id="batch" required onchange="showSub1()" class="browser-default">
                    <option value="">SELECT</option>
                </select>
                <br><br>
                <b>Subject Id : </b>
                <select name="sub_id" id="sub_id" class="browser-default" required>
                    <option value="">SELECT</option>
                </select><br><br>
                <input type="submit" class="btn btn-primay form-control" value="Show" onclick="showDate_Data();return false;">
            </div>
        </div>
    </div>
    </form>
    <div id="date_data"></div>

<script src="/js/AddAssignRole.js"></script>
<script src="/js/editattendance.js"></script>
@endsection