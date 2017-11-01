@php
    $i=1;
@endphp

<div class="col s10 m10 offset-m1">
    <table>

        <tr>
            <th>Sr no.</th>
            <th>From date</th>
            <th>To Date</th>
            <th>Update</th>
            <th>Delete</th>
            
        </tr>
@foreach($date_data as $datum)
            <tr>
            <td>{{$i}}</td>
                <form action="">
                  <td>{{ $datum->fromdate }}</td>  <td>{{ $datum->todate }}</td>
                    <input type="hidden" name="fromdate" id="fromdate{{ $i }}" value="{{ $datum->fromdate }}">
                    <input type="hidden" name="todate" id="todate{{ $i }}" value="{{ $datum->todate }}">
                    <input type="hidden" name="id" value="{{ $datum->id }}">
                   <td> <input type="submit" value="Update" name="{{ $i }}" class="btn btn-primary pull-left" onclick="showBatchList(this.name);return false;">
                   </td>
                </form>
               <td>
                <form action="/attendance/deleteattendance">
                    {{ csrf_field() }}
                    <input type="hidden" name="fromdate" value="{{ $datum->fromdate }}">
                    <input type="hidden" name="todate" value="{{ $datum->todate }}">
                    <input type="hidden" name="sub_id" value="{{ $sub_id }}"></input>
                    <input type="hidden" name="section" value="{{ $section }}"></input>
                    <input type="submit" value="Delete" name="delete" class="btn btn-danger pull-right">
                </form></td>
            </div>
        </div>
    </div>
    <p style="display: none">{{ $i++ }}</p>
    </tr>
@endforeach