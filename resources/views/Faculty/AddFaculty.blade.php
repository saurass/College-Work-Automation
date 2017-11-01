
@extends('layouts.attendance')
@section('content')

<script src="/js/AddFaculty.js"></script>

<div class="col m8 offset-m2">

@if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='AlreadyExist')
        <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h4>Error Occured !!<br> Faculty Id Already Exist</h2></div>

        </div>
        </div>
        </div>
    @endif

    @if(isset($_REQUEST['errors']) && $_REQUEST['errors']=='Sucess')
        <div class="center">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
           
               <div class=""><h4>Faculty Added Sucessfullty..!!</h2></div>

        </div>
        </div>
        </div>
    @endif
            <div class="card z-depth-5">
    <form action="/managefaculty" method="post">
        {{ csrf_field() }}
    <div class="card-content">
                <span class="card-title center">Add Faculty</span>
                   <p class="center">PLEASE ENTER ALL DETAILS</p>
           
                @if($cat=="HOD")
                    <input type="hidden" name="branch" value="{{ $branch }}" required>
                @else
                    Select Branch :
                    <select name="branch" id="branch" onchange="getNewId()" class="browser-default" required>
                        @foreach($cats as $cat)
                            <option value="{{ $cat->branch }}">{{ $cat->branch }}</option>
                        @endforeach
                    </select><br><br>
                @endif

                    @if($cat == "HOD")
                        New ID :<input type="text" name="userid" value="{{ $newId }}" readonly>
                    @else
                        New ID :<input type="text" name="userid" id="userid" readonly>
                    @endif
                <br><br>Facuylty Name :<input type="text" name="name" required><br><br>
                 <input type="hidden" name="category" value="FACULTY" required>

                <input type="submit" value="Add Faculty">
            </div>
        </div>
    </div>
    </form>
@endsection