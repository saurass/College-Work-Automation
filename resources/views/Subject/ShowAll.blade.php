@extends('layouts.attendance')
@section('content')
    @if(isset($_REQUEST['status']) and $_REQUEST['status']=='successupdate')
       
       <div class="center">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                       
                           <div class=""><h5> Successfully Updated !!
                           </h5>
                           </div>
                           </div>
                           </div>
                           </div>
                           
    @endif
   
    <div class="row">
        <div class="row"></div>
        <form action="/searchsubdata">
        <div class="row center">
        <div class="input-field col s12">
            <div class="col s12 m9">

                <input type="text" name="str"  id="str" minlength="7" maxlength="7" required>
                <label for="str">SUBJECT CODE </label>>
            </div>
            <div class="col s12 m3 left-align">
                <button type="submit" class="btn green"> Search <i class="fa fa-search"></i></button>
            </div>
        </div>        
        </div>
        </form>
    </div>
@endsection