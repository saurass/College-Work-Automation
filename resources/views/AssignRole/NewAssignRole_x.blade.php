<script src="/js/AddAssignRole.js"></script>
@extends('layouts.app')
@section('content')
    @if(isset($_REQUEST['errors']) and $_REQUEST['errors']=='reassigned')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-warning">
                A Role Is Already Assigned To The Batch Please Update Or Delete OldOne
            </div>
        </div>
    @endif
    <form action="/assignrole" method="post">
        {{ csrf_field() }}
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-warning">
                <div class="panel-heading clearfix">
                    <b><u>ASSIGN NEW FACULTY ROLE</u></b><hr>

                        <b>FACULTY DEPARTMENT :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="branch" id="Department" class="btn btn-primary" onchange="showFac()" required>
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

                    <b>FACULTY NAME :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="fac_id" id="fac_" class="btn btn-primary" onchange="showBatch()" required>
                        <option value="">SELECT</option>
                    </select><br><br>

                    <b>SELECT BATCH :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="section" id="batch" class="btn btn-primary" required>
                        <option value="">SELECT</option>
                    </select><br><br>

                    <input type="hidden" name="semester" value="{{ $sem }}" name="branch">
                    <input type="hidden" id="dep" name="department" value="{{ $dep }}">
                    <input type="hidden" id="dep" name="sub_id" value="{{ $sub_id }}">

                    <input type="submit" id="submit" class="btn btn-success pull-right">
                </div>
            </div>
        </div>
    </form>
@endsection
