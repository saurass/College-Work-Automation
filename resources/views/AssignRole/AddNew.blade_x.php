<script src="/js/AddAssignRole.js"></script>
@extends('layouts.app')
@section('content')
    @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='AlreadyAssigned')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-danger">
                A Faculty Was Already Assigned To The Respective Role
            </div>
        </div>
    @endif
    @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='Success')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-danger">
                Role Successfully Assigned
            </div>
        </div>
    @endif
    <form action="/assignrole/showall" method="post">
        {{ csrf_field() }}
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-warning">
                <div class="panel-heading clearfix">
                    <b><u>VIEW FACULTY ASSIGNED ROLE</u></b><hr>
                    @if($category=="ADMIN")
                        <b>DEPARTMENT :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="branch" id="Department" class="btn btn-primary" onchange="showSem()" required>
                            <option value="">SELECT</option>
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                            <option value="ECE">ECE</option>
                            <option value="ME">ME</option>
                            <option value="CE">CE</option>
                            <option value="EI">EI</option>
                            <option value="EN">EN</option>
                            <option value="MBA">MBA</option>
                            <option value="MCA">MCA</option>
                        </select><br><br>
                    @else
                        <input type="hidden" id="Department" name="branch" value="{{ $department }}">
                        <script>
                            if (document.getElementById('Department').value != '')
                            {
                                showSem();
                            }
                        </script>
                    @endif
                    <b>SEMESTER  :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="semester" class="btn btn-primary" id="sem" onchange="showCategory()" required>
                        <option value="">SELECT</option>
                    </select><br><br>
                    <b>CATEGORY  :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="category" class="btn btn-primary" id="category" onchange="showSub()" required>
                        <option value="">SELECT</option>
                    </select><br>
                    <br><b>SUBJECT  :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;<select name="sub_id" id="sub" class="btn btn-primary" required>
                        <option value="">SELECT</option>
                    </select><br><br>
                    <input type="submit" id="submit" class="btn btn-success pull-right">
                </div>
            </div>
        </div>
    </form>
@endsection
