@extends('layouts.app')

@section('content')
    @php
        if (isset($_REQUEST['status']) and $_REQUEST['status']=='success')
            echo 'Success';
    @endphp
    <script src="/js/AddMarks.js"></script>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Marks
            </div>
            <div class="panel-body">

                <input type="hidden" id="branch" value="{{ $branch }}">

                Semester :
                <select id="sem" onchange="showSub()" name="semester" required>
                    <option value="">SELECT</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->semester }}">{{ $semester->semester }}</option>
                    @endforeach
                </select><br><br>

                Subject :
                <select id="subject" onchange="showSec()" name="subject" required>
                    <option value="">SELECT</option>
                </select><br><br>

                Section :
                <select id="section" onchange="getExam()" name="section" required>
                    <option value="">SELECT</option>
                </select><br><br>

                Exam :
                <select id="exams" required>
                    <option value="">SELECT</option>
                </select><br><br>
                <button onclick="getUpdateExamMarkList()">Submit</button>
            </div>
        </div>
    </div>
    <div id="addMarksField"></div>
@endsection