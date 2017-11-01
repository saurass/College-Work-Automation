@extends('layouts.app')
@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="panel">
            <div class="panel panel-heading">
                <center><b><u>Update AssignRole</u> <br>
                            {{ $roledata->sub_id }}  |  {{ $roledata->section }}
                        </b>
                    <b> | {{ $roledata->semester }} Semester</b>
                </center>
            </div>
            <div class="panel-body">
                <center>
                    Select The Faculty
                </center><br>
                <form action="/assignrole/{{ $roledata->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <center>
                        <select class="btn btn-primary form-control" name="faculty" required>
                            <option value="">Select</option>
                            @foreach($allfac as $v)
                                <option value="{{ $v->userid }}">{{ $v->name }}</option>
                            @endforeach
                        </select><br><br>
                        <input type="submit" class="btn btn-success" value="Update">
                    </center>
                </form>
            </div>
        </div>
    </div>
@endsection