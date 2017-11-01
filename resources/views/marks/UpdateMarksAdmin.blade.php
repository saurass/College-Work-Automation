@extends('layouts.attendance')

@section('content')
    @php
        if (isset($_REQUEST['status']) and $_REQUEST['status']=='success')
            echo 'Success';
    @endphp
    <script src="/js/AddMarks.js"></script>
    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content" style="font-size: 20px">
                <b>Update Marks</b>
            </div>
            <div class="card-content">

                Branch :
                <select id="branch" name="branch" class="btn-block" required onchange="getSem()">
                    <option value="">SELECT</option>
                    @foreach($branchs as $branch)
                        <option value="{{ $branch->branch }}">{{ $branch->branch }}</option>
                    @endforeach
                </select><br><br>

                Semester :
                <select id="sem" onchange="showSub()" name="semester" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                Subject :
                <select id="subject" onchange="showSec()" name="subject" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                Section :
                <select id="section" onchange="getExam()" name="section" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                Exam :
                <select id="exams" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                <button onclick="getUpdateExamMarkList()" class="btn">Submit</button>
            </div>
        </div>
    </div>
    <div id="addMarksField"></div>
@endsection