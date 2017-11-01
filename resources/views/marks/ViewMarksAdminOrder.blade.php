@php
    $i=1;
    $j=0;
    $flag=0;
@endphp
<table class="table table-responsive">
    <tr>
        <th colspan="3">Student Details</th>
        @foreach($subjects as $subject)
            <th>{{ $subject->sub_id }}</th>
        @endforeach
        <th colspan="3"></th>
    </tr>
    <tr>
        <th>S.No.</th>
        <th>Student Number</th>
        <th>Student Name</th>
        @foreach($subjects as $subject)
            <th>{{ $exam." (".$mm.")" }}</th>
        @endforeach
        <th>Total</th>
        <th>% Marks</th>
        <th>Remarks</th>
    </tr>
    @foreach($students as $student)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $student['st_id'] }}</td>
            <td>{{ $student['name'] }}</td>
            @foreach($subjects as $subject)
                @foreach($markdata as $m)
                    @if($m->st_id==$student['st_id'] and $m->sub_id==$subject->sub_id)
                        <td>{{ $m->marks_obtained }}</td>
                        @php
                            $flag=1;
                        @endphp
                        @break
                    @else
                        @php
                            $flag=0;
                        @endphp
                    @endif
                @endforeach
                @if($flag==0)
                    <td></td>
                @endif
            @endforeach
            <td>{{ $individual_total[$j++]['total'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Total Marks</td>
        @foreach($subtotal as $st)
            <td>{{ $st }}</td>
        @endforeach
        <td>{{$alltotal}}</td>
    </tr>
    <tr>
        <td colspan="3">Max Marks</td>
        @foreach($subjects as $subject)
            <td>{{ $mm }}</td>
        @endforeach
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td colspan="3">Class Average</td>
        @foreach($subaverage as $value)
            @if($value=='')
                <td>No Data</td>
            @else
                <td>{{ $value }}</td>
            @endif
        @endforeach
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <td colspan="3">Faculty Name</td>
        @foreach($allfac as $fac)
            @foreach($facname as $f)
                @php
                    $flag=1;
                @endphp
                @if($f->userid==$fac)
                    <td>{{ $f->name }}</td>
                    @php
                        $flag=1;
                    @endphp
                    @break
                @else
                    @php
                        $flag=0;
                    @endphp
                @endif
            @endforeach
            @if($flag==0)
                <td></td>
            @endif
        @endforeach
        <td></td>
        <td>Avg Marks</td>
        <td></td>
    </tr>
</table>