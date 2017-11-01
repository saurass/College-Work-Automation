@extends('layouts.attendance')
@section('content')
        <div class="col m8 offset-m2">
            <form action="/facultyupdate" method="GET">
            

                @if($errors->any())
                    <div class="center">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                       
                           <div class=""><h5>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach


                        </ul>
                        </h5>
                        </div>
                        </div>
                        </div>
                @endif
                    @if(isset($_REQUEST['status']) and $_REQUEST['status']=='success')
                    <div class="center">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                       
                           <div class=""><h5>
                        Successfully Updated !!
                        </h5>
                        </div>
                        </div>
                        </div></div>
                    @endif
                <div class="card z-depth-5">
                <div class="card-content">
                <span class="card-title center">Edit Faculty</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>
                    <div class="input-field">
                                 <input type="text" name="fac_id" id="st_id"><br><br><label for="st_id">FACULTY ID</label>
                    </div><br><br>

<input type="submit" name="submit" class="btn green right-align form-control" value="View">
</form>
</div>
@endsection