@extends('layouts.app')

@section('content')
    @php
        if (isset($_REQUEST['status']) and $_REQUEST['status']=='success')
            echo 'Success';
    @endphp
    <script src="/js/AddMarks.js"></script>
    <form action="/marksdel" method="post">
        {{ csrf_field() }}
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update Marks
                </div>
                @if(isset($_REQUEST['status']) and $_REQUEST['status']=='delsuccess')
                    Deleted Successfully !!
                @endif
                <div class="panel-body">

                    Branch :
                    <select id="branch" name="branch" required onchange="getSem()">
                        <option value="">SELECT</option>
                        @foreach($branchs as $branch)
                            <option value="{{ $branch->branch }}">{{ $branch->branch }}</option>
                        @endforeach
                    </select><br><br>

                    Semester :
                    <select id="sem" onchange="showSub()" name="semester" required>
                        <option value="">SELECT</option>
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
                    <select id="exams" name="exam" required>
                        <option value="">SELECT</option>
                    </select><br><br>
                    <input type="submit" value="Delete">
                </div>
            </div>
        </div>
    </form>
    <div id="addMarksField"></div>
@endsection