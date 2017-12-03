@extends('layouts.attendance')

@section('content')
    <script src="/js/settings.js"></script>
    <h5>Change Student Sem In Bulk</h5>
    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content">
                <form action="/BulkChangeStud/update" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    Branch :
                    <select name="branch" id="branch" class="btn-block" onchange="getsection()" required>
                        <option value="">SELECT</option>
                        @foreach($branchs as $branch)
                            <option value="{{ $branch->branch }}">{{ $branch->branch }}</option>
                        @endforeach
                    </select><br>

                    Section :
                    <select name="section" id="section" class="btn-block" onchange="getsemester()" required>
                        <option value="">SELECT</option>
                    </select><br>

                    Semester :
                    <select name="semester" id="semester" class="btn-block" required>
                        <option value="">SELECT</option>
                    </select><br>

                    <input type="submit" class="btn btn-success" onclick="return showDetail()"><br>

                    <div id="details"></div>

                </form>
            </div>
        </div>
    </div>
@endsection