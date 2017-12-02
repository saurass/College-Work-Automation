@extends('layouts.attendance')
@section('content')
    <div class="row">
        <div class="row"></div>
        <form action="/assignrole/create" method="post">
            {{ csrf_field() }}
            <div class="row center">
                <div class="input-field col s12">
                    <div class="col s12 m9">
                        <input type="hidden" name="sub_dep" value="{{ $sub_dep }}">
                        <input type="hidden" name="sub_sem" value="{{ $sub_sem }}">
                        <input type="hidden" name="sub_id" value="{{ $subid }}">
                        <input type="hidden" name="cats" value="{{ $cats }}">
                        <input type="submit" value="Assign New Role To This Post" style="background-color: #6fff93"
                               class="btn btn-large btn-red">
                    </div>
                </div>
            </div>
        </form>
        <br><br><br>
        <div class="row"></div>
        <div class="col s10 m10 offset-m4   "><h5 class="left">List Of All Faculty</h5></div>
        <br>
        <div class="col s10 m10 offset-m1">
            <table>

                <tr>
                    <th>Sr no.</th>
                    <th>Subject Id</th>
                    <th>Subject Name</th>
                    <th>Faculty</th>
                    <th>Semester</th>
                    <th>Section</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    @if($sub_cat=='O')
                        <th>Update students</th>
                    @endif
                </tr>

                @php
                    $i=1;
                @endphp
                @foreach($data as $datas)

                    <tr>
                        <td>{{$i++}}</td>
                        <td> {{ $datas->sub_id }}</td>
                        @foreach($subdata as $v)
                            @if($v->sub_id == $datas->sub_id)
                                <td> {{ $v->sub_name }}</td>
                                @break
                            @endif
                        @endforeach


                        @foreach($fac as $facs)

                            @if($facs->userid == $datas->fac_id)
                                <td>{{ $facs->name }}
                                    @break;
                                    @endif
                                    @endforeach
                                    | ( {{ $datas->fac_id }} )
                                    @foreach($fac as $facs)
                                        @if($facs->userid == $datas->fac_id_2)
                                            <br><b><u>Faculty Name 2 </u>: </b>{{ $facs->name }}
                                            @break;
                                        @endif
                                    @endforeach
                                    @if($datas->fac_id_2 != "")
                                        |
                                        <small><b>( <u>{{ $datas->fac_id_2 }}</u> )</b></small>
                                    @endif
                                    @foreach($fac as $facs)
                                        @if($facs->userid == $datas->lab_assistant_id)
                                            <br><b><u>Lab Assistant </u>: </b>{{ $facs->name }}
                                            @break;
                                        @endif
                                    @endforeach
                                    @if($datas->lab_assistant_id != "NULL")
                                        |
                                        <small><b>( <u>{{ $datas->lab_assistant_id }}</u> )</b></small>
                                    @endif
                                </td>
                                <td>{{ $datas->semester }}</td>
                                <td>{{ $datas->section }}</td>
                                <td>
                                    <form action="/assignrole/{{ $datas->id }}/edit">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-primary pull-left" value="Update">
                                    </form>
                                </td>
                                <td>
                                    <form action="/assignrole/{{ $datas->id }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-danger pull-right" value="Delete">
                                    </form>
                                </td>
                                @if($sub_cat=='O')
                                    <td>
                                        <form action="/assignrole/{{ $datas->id }}/updateStud" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="submit" class="btn btn-danger pull-right" value="UpdateStudent">
                                        </form>
                                    </td>
                    @endif
                @endforeach
            </table>
        </div>
    </div>

@endsection