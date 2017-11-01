@extends('layouts.attendance')
@section('content')
    <script src="/js/viewAssignRole.js"></script>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Please Fill All Fields
            </div>
            <div class="panel-body">
                @if($category=="HOD")
                    <input type="hidden" id="branch" value="{{ $branch }}">
                @else
                    Branch :
                    <select id="branch" class="btn btn-primary" onchange="setViewBy();showSem2();">
                        <option value="">SELECT</option>
                        @foreach($branch as $v)
                            <option value="{{ $v->branch }}">{{ $v->branch }}</option>
                        @endforeach
                    </select>
                @endif
                <br>View By :
                <select id="view_by" class="btn btn-primary" onchange="setViewBy()" required>
                    <option value="by_sem">SEMESTER</option>
                    <option value="by_sec">SECTION</option>
                </select>
                    <br>
                    SEMESTER :

                    @if($category=="HOD")
                        <select id="sem" class="btn" required>
                            <option value="">SELECT</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->semester }}">{{ $semester->semester }}</option>
                            @endforeach
                        </select>
                    @else
                        <select id="sem" class="btn" required>
                            <option value="">SELECT</option>
                        </select>
                    @endif
                <br><p id="option"></p>
                <br><button onclick="getData()">GET</button>
            </div>
        </div>
    </div>
    <span id="table"></span>
@endsection