@extends('layouts.attendance')

@section('content')
        <div class="col m8 offset-m2">
            <form action="/subject/{{ $SubData->id }}" method="post">
            <div class="card z-depth-5">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
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
                <span class="card-title center">Edit Subject</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>
                    <div class="input-field">
                        <input type="text" name="sub_id" value="{{ $SubData->sub_id }}" required id="sub_id"><br>
                        <label for="sub_id">Subject Code</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="sub_name" value="{{ $SubData->sub_name }}" required id="sub_name"><br><br>
                        <label for="sub_name">Subject Code</label>
                    </div>
                    <b>PLEASE SELECT FIELDS</b><br><br>
                    SEMESTER :
                    <select name="semester" required class="browser-default">
                        <option value="{{ $SubData->semester }}">{{ $SubData->semester }}</option>
                        @for($i=1;$i<=8;$i++)
                            @if($SubData->semester != $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                        @endfor
                    </select><br>
                    CATEGORY :
                    <select name="category" class="btn btn-block" required>
                                @if($SubData->category == "T")
                                    <option value="{{ $SubData->category }}">Theory</option>
                                    <option value="P">Practical</option>
                                    <option value="O">Open Elective</option>
                                @endif

                                @if($SubData->category == "P")
                                        <option value="{{ $SubData->category }}">Practical</option>
                                        <option value="T">Theory</option>
                                        <option value="O">Open Elective</option>
                                @endif

                                @if($SubData->category == "O")
                                        <option value="{{ $SubData->category }}">Open Elective</option>
                                        <option value="T">Theory</option>
                                        <option value="P">Practical</option>
                                @endif
                    </select><br>
                    @if($category=='ADMIN')
                        BRANCH : <select name="branch" class="browser-default" required>
                            <option value="">SELECT</option>
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                            <option value="ECE">ECE</option>
                            <option value="ME">ME</option>
                            <option value="CE">CE</option>
                            <option value="EI">EI</option>
                            <option value="EN">EN</option>
                            <option value="MBA">MBA</option>
                            <option value="MBA">MBA</option>
                        </select><br>
                    @endif
                    @if($category=='HOD')
                        <input type="hidden" value="{{ $department }}" name="branch">
                    @endif
                    <br><input type="submit" class="btn green right-align form-control" name="addsubject" value="UPDATE">
                </div>
            </div>    
            </form>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('select').material_select();
            });
        </script>
@endsection