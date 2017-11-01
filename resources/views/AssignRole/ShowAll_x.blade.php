@extends('layouts.app')
@section('content')
    <form action="/assignrole/create" method="post">
        {{ csrf_field() }}
        <div class="col-md-6 col-md-offset-3">
            <input type="hidden" name="sub_dep" value="{{ $sub_dep }}">
            <input type="hidden" name="sub_sem" value="{{ $sub_sem }}">
            <input type="hidden" name="sub_id" value="{{ $subid }}">
            <input type="hidden" name="cats" value="{{ $cats }}">
            <input type="submit" value="Assign New Role To This Post" style="background-color: #6fff93" class="form-control">
        </div>
    </form>
    <br><br><br>
    @foreach($data as $datas)
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel panel-heading">
                    <b>{{ $datas->sub_id }}</b>
                    @foreach($subdata as $v)
                        @if($v->sub_id == $datas->sub_id)
                            <b class="pull-right">{{ $v->sub_name }}</b>
                            @break
                        @endif
                    @endforeach
                </div>
                <div class="panel-body">
                    @foreach($fac as $facs)
                        @if($facs->userid == $datas->fac_id)
                            <b><u>Faculty Name </u>: </b>{{ $facs->name }}
                            @break;
                        @endif
                    @endforeach
                    | <small><b>( <u>{{ $datas->fac_id }}</u> )</b></small>
                        @foreach($fac as $facs)
                            @if($facs->userid == $datas->fac_id_2)
                                <br><b><u>Faculty Name 2 </u>: </b>{{ $facs->name }}
                                @break;
                            @endif
                        @endforeach
                        @if($datas->fac_id_2 != "")
                            | <small><b>( <u>{{ $datas->fac_id_2 }}</u> )</b></small>
                        @endif
                        @foreach($fac as $facs)
                            @if($facs->userid == $datas->lab_assistant_id)
                                <br><b><u>Lab Assistant </u>: </b>{{ $facs->name }}
                                @break;
                            @endif
                        @endforeach
                        @if($datas->lab_assistant_id != "NULL")
                            | <small><b>( <u>{{ $datas->lab_assistant_id }}</u> )</b></small>
                        @endif
                    <br><b><u>Semester</u> : </b>{{ $datas->semester }}
                    <br><b><u>Section</u> : </b>{{ $datas->section }}
                </div>
                <div class="panel-footer clearfix">
                    <form action="/assignrole/{{ $datas->id }}/edit">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary pull-left" value="Update">
                    </form>
                    <form action="/assignrole/{{ $datas->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-danger pull-right" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection