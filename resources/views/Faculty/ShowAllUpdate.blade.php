@extends('layouts.attendance')
@section('content')

        <br><br><br><br><br><br>
        <div class="col m8 offset-m2">
            <div class="card z-depth-5">


                <div class="card-content">
                    <span class="card-title">
                            <span class="left col s12 m6">{{ $faculties->name }}</span>
                            <span class="right right-align col s12 m6 text-capitalize">{{ strtolower($faculties->userid ) }}</span>
                        </span>

                    <div class="row"></div>

                    Faculty Branch &nbsp;&nbsp;&nbsp;&nbsp; :{{ $faculties->branch }}



                    <div class="card-action">
                        <form action="/managefaculty/{{ $faculties->userid }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="userid" value="{{ $faculties->userid }}">
                            <button type="submit" value="Delete" class="btn red right">DELETE<i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection