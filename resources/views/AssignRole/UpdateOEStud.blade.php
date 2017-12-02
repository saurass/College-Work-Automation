@php
    $f=0;
    $g=0;
@endphp

@extends('layouts.attendance')

@section('content')
    <script src="/js/AddAssignRole.js"></script>
    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content">
                <form action="/updateOEStud/{{ $sec }}/{{ $sem }}/{{ $fac }}/{{ $subs }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <b>Select The Student Under The AssignRole</b><br>
                    <table>
                        <tr>
                            <th>Student Name</th>
                            <th>Student Number</th>
                            <th>Current faculty</th>
                            <th>Check</th>
                        </tr>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->st_id }}</td>
                                @foreach($FacDatas as $facData)
                                    @php
                                        $g='';
                                    @endphp
                                    @if($facData->userid == $student->OE1 or $facData->userid == $student->OE2 or $facData->userid == $student->OE3)
                                        @php
                                            $f=1;
                                            $g=$facData->userid;
                                        @endphp
                                        <td>{{ $facData->name }}<b>({{ $facData->userid }})</b></td>
                                        @break
                                    @endif
                                @endforeach
                                @if($f==0)
                                    <td></td>
                                @else
                                    @php
                                        $f=0;
                                    @endphp
                                @endif
                                <td>
                                    <p>
                                        @if($fac == $g)
                                            <input type="checkbox" class="filled-in" id="{{ 'myCheckbox'.$student->st_id }}"
                                                   name="{{ $student->st_id }}" checked>
                                            <label for="{{ 'myCheckbox'.$student->st_id }}"></label>
                                        @else
                                            <input type="checkbox" class="filled-in" id="{{ 'myCheckbox'.$student->st_id }}"
                                                   name="{{ $student->st_id }}">
                                            <label for="{{ 'myCheckbox'.$student->st_id }}"></label>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <input type="submit" class="btn" value="Update">
                </form>
            </div>
        </div>
    </div>
@endsection