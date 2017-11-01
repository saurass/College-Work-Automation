@extends('layouts.attendance')
@section('content')
    @foreach($faculties as $faculty)

    <br><br><br><br><br><br>
        <div class="col m8 offset-m2">
            <div class="card z-depth-5">


                <div class="card-content">
                    <span class="card-title">
                            <span class="left col s12 m6">{{ $faculty->name }}</span>
                            <span class="right right-align col s12 m6 text-capitalize">{{ strtolower($faculty->userid ) }}</span>
                        </span>

                     <div class="row"></div>
                    
                        Faculty Branch &nbsp;&nbsp;&nbsp;&nbsp; :{{ $faculty->branch }}
                    
                    
               
              <div class="card-action">
                    <form action="/managefaculty/{{ $faculty->userid }}/edit">
                        {{ csrf_field() }}
                        <input type="hidden" name="userid"  value="{{ $faculty->userid }}">
                        <button type="submit" value="Update" class="btn green left">EDIT<i class="fa fa-pencil"></i></button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection