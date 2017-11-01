@extends('layouts.attendancef')

@section('content')
    @php
        if (isset($_REQUEST['status']) and $_REQUEST['status']=='success')
            echo 'Success';
    @endphp
    <script src="/js/AddMarks.js"></script>
    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content">
                Add Marks
            </div>
            <div class="card-content">
                Subject :
                <select id="subject" class="btn-block" name="section" required onchange="getSub()">
                    <option value="">SELECT</option>
                    @foreach($section as $s)
                        <option value="{{ $s->sub_id }}">{{ $s->sub_id }}</option>
                    @endforeach
                </select><br><br>
                Section :
                <select id="section" class="btn-block" onchange="showExam()" name="section" required>
                    <option value="">SELECT</option>
                </select><br><br>
                Exam :
                <select id="exams" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                <button onclick="getAddExamMarkList()" class="btn">Submit</button>
            </div>
        </div>
    </div>
    <div id="addMarksField"></div>
@endsection