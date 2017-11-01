
@extends('layouts.attendance')
@section('content')

<script src="/js/AddFaculty.js"></script>

<div class="col m8 offset-m2">
            <div class="card z-depth-5">
    <form action="/managefaculty/{{ $data->userid }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="card-content">


                <span class="card-title center">EDIT FACULTY</span>
                   <p class="center">PLEASE CHECK FOLLOWING DETAILS</p>
                    @if($cat=="HOD")
                        <input type="hidden" name="branch" value="{{ $data->branch }}" required>
                    @else
                        Select Branch :
                        <select name="branch" id="branch" onchange="getNewId()" required class="browser-default">
                            <option value="">SELECT</option>
                            <option value="{{ $data->branch }}">{{ $data->branch }}</option>
                            @foreach($cats as $cat)
                                <option value="{{ $cat->branch }}">{{ $cat->branch }}</option>
                            @endforeach
                        </select><br><br>
                    @endif

                    @if($cat == "HOD")
                        New ID :<input type="text" name="userid" value="{{ $data->userid }}" readonly>
                    @else
                        New ID :<input type="text" name="userid" id="userid" value="{{ $data->userid }}" readonly>
                    @endif
                    <br><br>Facuylty Name :<input type="text" name="name" value="{{ $data->name }}" required><br><br>
                    <input type="submit" value="Update"  class="btn btn-primary form-control">
                </div>
            </div>
        </div>
    </form>
@endsection