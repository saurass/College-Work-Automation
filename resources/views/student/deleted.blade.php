@extends('layouts.attendance')
@section('content')
        <div class="col m8 offset-m2">
            <form action="/delete" method="post">
            <div class="card z-depth-5">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                @if($errors->any())
                    <div class="form-control panel-body">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
{{ csrf_field() }}
<input type="hidden" name="st_id" value='{{$Student->st_id}}'>
<div class="card-content">
                <span class="card-title center">Student Details</span>
                    <div class="input-field">
	<input type="text" name="name" value="{{ $Student->name }}" readonly><br><br>
	<label for="name">Name of the student:</label>
                    </div>
                    <div class="input-field">
	<input type="text" name="semester" value="{{ $Student->semester}}" readonly><br><br>
	<label for="semester">Semester:</label>
	<div class="input-field">
	<input type="text" name="branch" value="{{ $Student->branch}}" readonly><br><br>
	<label for="name">Branch:</label>
                    </div>
                    <div class="input-field">
	<input type="text" name="section" value="{{$Student->section}}" readonly><br><br>
	<label for="Section">Section:</label>
                    </div>
	<input type="submit"  name="submit" class="btn green right-align form-control" value="Delete">

</form>
</div>
@endsection