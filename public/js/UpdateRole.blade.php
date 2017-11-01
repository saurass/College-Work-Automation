@extends('layouts.attendance')
@section('content')
    <script src="/js/AddAssignRole.js"></script>
   <div class="col m8 offset-m2">
            <div class="card z-depth-5">
                <div class="card-content">
                <span class="card-title center">UPDATE ASSIGNROLE</span>
                  <div class="row"></div>
                  <div class="center">        SUB ID:  {{ $roledata->sub_id }} <br>  SECTION :{{ $roledata->section }}<br>
                        
                        SEMESTER: {{ $roledata->semester }} <br>
               </div><br><br>
        
            <span class="card-title">
                    Select The Faculty
             </span>
                    Faculty Department :
                    <select class="browser-default" name="branch" id="dep" onchange="showDepFac()">
                        <option value="">SELECT</option>
                        @foreach($allBranch as $v)
                            <option value="{{ $v->branch }}">{{ $v->branch }}</option>
                        @endforeach
                    </select>
                <form action="/assignrole/{{ $roledata->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <center>
                        <br>Faculty Name :
                        <select class="browser-default" id="faculty" name="faculty" required>
                            <option value="">Select</option>
                            @foreach($allfac as $v)
                                <option value="{{ $v->userid }}">{{ $v->name }}</option>
                            @endforeach
                        </select><br><br>
                        <input type="submit" class="btn btn-primary form-control" value="Update">
                    </center>
                </form>
            </div>
            </div>

        </div>
    </div>
@endsection