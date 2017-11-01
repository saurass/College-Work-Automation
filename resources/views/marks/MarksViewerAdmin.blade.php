@extends('layouts.attendance')
@section('content')
    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content">
                View Marks
            </div>
            <div class="card-content">
                BRANCH :
                <select id="branch" onchange="showsem()" class="btn-block" required>
                    @foreach($branchs as $branch)
                        <option value="{{ $branch->branch }}">{{ $branch->branch }}</option>
                    @endforeach
                </select><br><br>

                SEMESTER :
                <select id="semester" onchange="showsec()" class="btn-block" required>
                    <option value="">SELECT</option>
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