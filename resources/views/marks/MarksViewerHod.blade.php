@extends('layouts.app')
@section('content')
    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content">
                View Marks
            </div>
            <div class="card-content">
                        <input type="hidden" id="branch" value="{{ $branchs }}">

                SEMESTER :
                <select id="semester" onchange="showsec()" class="btn-block" required>
                    <option value="">SELECT</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->semester }}">{{ $semester->semester }}</option>
                    @endforeach
                </select><br><br>

                SECTION :
                <select id="section" onchange="showexam()" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                EXAM :
                <select id="exam" class="btn-block" required>
                    <option value="">SELECT</option>
                </select><br><br>

                ORDER :
                <select id="order" class="btn-block" required>
                    <option value="">SELECT</option>
                    <option value="nm">Normal</option>
                    <option value="asc">Ascending</option>
                    <option value="dsc">Descending</option>
                </select><br><br>

                <input type="submit" class="btn" onclick="getMarkView()">

            </div>
        </div>
    </div>
    <div id="viewmarks"></div>
    <script src="/js/ViewMarksAdmin.js"></script>
@endsection