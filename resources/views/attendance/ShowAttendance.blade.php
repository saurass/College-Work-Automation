@php
    $i=1;
@endphp
<form action="/attendance/saveupdates" method="post" onsubmit="return submitForm();">
    {{ csrf_field() }}
    <center>
        <table class="table-responsive">
            <tr class="table table-responsive">
                <th>STUDENT ID &nbsp;&nbsp;</th>
                <th>STUDENT NAME</th>
                <th>TOTAL CLASSES</th>
                <th>ATTENDED CLASSES</th>
            </tr>
            @foreach($stu_names as $name)
                <tr class="tab-content">
                    <td>{{ $name->st_id }}</td>
                    <td>{{ $name->name }}</td>
                    @foreach($stu_att_data as $datum)
                        @if($datum->st_id==$name->st_id)
                            <td style="width: 30px"><input name="{{ 'totalclasses'.$i }}" id="{{ 'totalclasses'.$i }}" type="text" style="width: 30px;" value="{{ $datum->totalclasses }}"></input></td>
                            <td style="width: 30px"><input name="{{ 'attended'.$i }}" id="{{ 'attended'.$i }}" type="text" style="width: 30px;" value="{{ $datum->attended }}"></input></td>
                            <input type="hidden" name="{{ $i }}" value="{{ $datum->st_id }}">
                            <input type="hidden" name="{{ 'fromdate'.$i }}" value="{{ $datum->fromdate }}">
                            <input type="hidden" name="{{ 'todate'.$i }}" value="{{ $datum->todate }}">
                            <input type="hidden" name="{{ 'sub_id'.$i }}" value="{{ $datum->sub_id }}">
                        @endif
                    @endforeach
                </tr>
                <p style="display: none">{{ $i++ }}</p>
            @endforeach
        </table>
        <input type="hidden" id="count" name="count" value="{{ $i-1 }}">
        <input type="submit" value="UPDATE" class="btn btn-success">
    </center>
</form>