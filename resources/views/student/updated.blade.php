
@extends('layouts.attendance')

@section('content')
        <div class="col m8 offset-m2">
            <form action="/updatestud1" method="post">
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
<input type="hidden" name="st_id" value='{{$Student->st_id}}'>>
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
	Section:
	<select name='section' id='section' class="browser-default" required >
<option value=''>{{ $Student->section}}</option>
						@foreach($branch1 as $bran)
                               <option value="{{$bran->section}}">{{$bran->section}}</option>
						@endforeach
				</select><br><br>
				<input type="submit" name="submit" class="btn green right-align form-control" value="Update">

</form>
</div>
@endsection