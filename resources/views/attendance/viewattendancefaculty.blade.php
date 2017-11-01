
@extends('layouts.attendancef')

@section('content')
<script src="/js/AttendanceView.js"></script>
<div class="col m8 offset-m2">
            <div class="card z-depth-5">
            <div class="card-content">
                <span class="card-title center">VIEW ATTENDANCE</span>
           
                Subject ID :
                <select name="sub_id" id="sub_id" onchange="showSem1()" class="browser-default" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->sub_id }}">{{ $subject->sub_id }}</option>
                    @endforeach
                </select><br><br>
                Semester :
                <input type="text" name="semester" id="sem" value="Please Select a Subject First" onfocus="showClass1()" required readonly><br><br>
                Section :
                <select name="batch" id="batch" class="browser-default" required>
                    <option value="">SELECT</option>
                </select><br><br>
                From Data :<input type="date" name="fdate" id="fdate" required>
                To Date : <input type="date" name="todate" id="todate" required><br><br>
                Filters : <select id="filter" name="filter"  class="browser-default" onchange="showFilter()">
                    <option value="">SELECT</option>
                    <option value="less_than">less than</option>
                    <option value="greater_than">greater than</option>
                    <option value="between">between</option>
                </select><div id="option"></div><br>
                <input type="submit" value="Show" onclick="showFacultyAttendance()">
            </div>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3" id="attendance"></div>
@endsection