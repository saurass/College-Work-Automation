@extends('layouts.attendance')
<script src="/js/addstudent.js"></script>

@section('content')
    @if($errors->any())

        <div class="center">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class=""><h5>Error Occured..!!</h5>
                        <h5>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="col m8 offset-m2">
        @if(isset($_REQUEST['status']) && $_REQUEST['status']=='sucess')
            <div class="center">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">

                        <div class=""><h5>Student Added Successfully..!!</div>

                    </div>
                </div>
            </div>
        @endif

        <div class="card z-depth-5">


            <form action="/addstud" method="post">

                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="card-content">
                    <span class="card-title center">Add Student</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>
                    <div class="input-field">
                        <input type='text' name='st_id' maxlength="10" required>
                        <label for="st_id">University Roll No</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="name" required><br><br>
                        <label for="name">Name</label>
                    </div>
                    <b> Semester:<b>
                            <select name='semester' id='sem' onchange="showBranch();" class="browser-default" required>
                                <option value=''>Select</option>

                                @foreach($sem as $s)
                                    <option value='{{$s->semester}}'><span
                                                class="text-capitalize">{{ strtolower($s->semester)}} </span></option>
                                @endforeach
                            </select> <br>


                            @if(session('usertype')=="ADMIN")
                                <b>BRANCH</b>
                                <select name='branch' id='branch' onchange="showsection()" class="browser-default"
                                        required></select>
                            @else
                                <input type="hidden" id="branch" name="branch" onload="showsection()"
                                       value="{{ session('branch') }}">
                            @endif

                            <span class="text-capitalize">section</span>
                            <select name='section' id='section' onfocus="showsection()" class="browser-default"
                                    required>

                            </select>
                            <br>
                            <input type='submit' value='ADD STUDENT' name='add'
                                   class="btn green right-align form-control" style="width:200px">
            </form>
        </div>
@endsection