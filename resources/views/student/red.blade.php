@extends('layouts.attendance')
@section('content')
        <div class="col m8 offset-m2">
            <form action="/deletestud" method="post">
            <div class="card z-depth-5">
                {{ csrf_field() }}
                {{ method_field('POST')}}
                @if($errors->any())
                    <div class="form-control panel-body">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-content">
                <span class="card-title center">Delete Student</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>
                    <div class="input-field">
                                 <input type="text" name="st_id" id="st_id"><br><br><label for="st_id">University Roll no</label>
                    </div><br><br>

<input type="submit" name="submit" class="btn green right-align form-control" value="View">
</form>
</div>
@endsection
 