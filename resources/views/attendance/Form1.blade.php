
<div align="center">
<form action="{{route('saveat')}}" onsubmit="return submitForm()" method="POST">
{{csrf_field()}}

<input type='hidden' name='mb' value='{{$mb}}'/>
<table class=table_style border=1 id='tab'>
<tr><td><b>S.No</b><td><b>Roll no</b></td><td><b> Student name</b></td><td><b>Held Classes</b></td><td><b>Attended classes</b></td></tr>
@php
$itemid=1;
$i=1;
@endphp
<!-- {{$s_no=1}}
 -->	@foreach ($cmd as $row)
	
		<tr>
            <td>{{$s_no}}</td>
		 	<td  id='rollno[]'>{{$row->st_id}}<input type=hidden name='rollno[]' value="{{$row->st_id}}" /></td>
			
			<td  id='name[]' width=200px>{{$row->name}}</td>
			 
			<td align=center width=100px ><input size=3 type=text value="{{$noc}}" id='totalclasses{{$i}}'. name='totalAttended[]' onkeypress="return VinChecknum(event)"></td>
		
			<td align=center width=100px><input size=3 type=text value="{{$noc}}" id='attended{{$i}}' name ='Attended[]'onkeypress=''returnd[]'(event)'></td>
			@php
			$itemid=$itemid+1;  
			$i++          ;
			@endphp
			     <!-- {{ $s_no=$s_no+1}}	 -->	 
		</tr>
	@endforeach


@php $itemid=$itemid-1 @endphp


<input type=hidden id=count name=count value="{{$itemid}}" />
<input type=hidden name=section value="{{$sec}}" />
<input type=hidden name=semester value="{{$sem}}" />
 
<input type=hidden name=year value="{{$year}}"/>
<input type=hidden name=syear value="{{$syear}}" />

<input type=hidden name=tyear value="{{$tyear}}" />


<input type=hidden name=subjectid value="{{$subid}}" >



</table>
<table align='center'><tr><td style='text-align:center'> <input type='submit' value='Save Attendance'></td></tr>
 </table>
</form>
</div>