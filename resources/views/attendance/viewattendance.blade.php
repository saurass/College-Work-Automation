@extends('layouts.attendance')
@section('content')


<body>

<script src="/js/viewattendance.js"></script>

<div class="col m8 offset-m2">
<div class="card z-depth-5">
 
	<div class="card-content">
                <span class="card-title center">View Attendance</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>

<form name="form1" method="post" target="_blank">

		
	<input type=hidden id=tdata name=tabledata>
	<input type=hidden id=tdata1 name=tabledata1>
	<table>
		
		<tr>
			<td colspan="1" style="font-weight:bold">Semester</td>
			<td colspan="3"><select size="1" name="semester" id="semester" onchange=getsection(this.value) class="browser-default" required>
			<option value="">select</option>
			@foreach($semesters as $semester)
			<option value="{{$semester->semester}}">{{$semester->semester}}</option>
			@endforeach
			</select></td>
		</tr>
		<tr>
			<td colspan="1" style="font-weight:bold">Section</td>
			<td colspan="3"><select size="1" name="section" id=section class="browser-default" required></select></td>
		</tr>
		<tr>
			<td style="font-weight:bold">Date</td>
			<td colspan="3"><input type="date" name="fdate" id="fdate" size="4">&nbsp;TO&nbsp;<input type="date" name="tdate" id="tdate" size="4"></td>
		</tr>	
		<tr>
			<td colspan="4" style="text-align:center;font-weight:bold;font-size:20px">View by</td>
		</tr>
		<tr>
			<td colspan="1" style="font-weight:bold">
			<div class="input-field">
			<input type="radio" value="R3" name="R1" onclick="f1(this.value);" id="R3"><label for="R3">SUBJECT WISE</label></td>

			</div>


			<td colspan="3"><div id=32>Subject ID :</div><select size="1" name="31" id=31 name=31 class="browser-default">
			</select></td>
		</tr>
		<tr>
			<td style="font-weight:bold">
				<div class="input-field">

				<input type="radio" value="R4" name="R1" id="R4" checked="checked" onclick=f1(this.value)><label for="R4">SECTION WISE </label>

				</div>
			</td>
			<td>
			<select size="1" name="sc" id="sc" class="browser-default" >
			<option value="">select</option>
			<option value=1>Simple</option>
			<option value=2>Cumulative</option>
			</select>
			</td>

			<td>
			<select size="1" name="tp" id="tp"  class="browser-default">
			<option value="">select</option>
			<option value='T'>Theory</option>
			<option value='P'>Practical</option>
			<option value=3>Both</option>
			</select>
			</td>
			
			<td>
			<input type="hidden" name="incdec" id="incdec" value="1">
			<!-- <select size="1" name="incdec" id="incdec" class="browser-default">
			<option value=0>select</option>
			<option value=1>By ID</option>
			<option value=2>Ascending</option>
			<option value=3>Descending</option>
			</select> -->
			</td>
		</tr>
        <tr>


			<td colspan="1" style="font-weight:bold">

			<div class="input-field">
			<input type="radio" value="R5" name="R1" onclick=f1(this.value) id="R5"><label for="R5"></label>Faculty Wise</td>

			</div>




            <td><div id=341e>Subject :</div><select size="1" name="331e" id=331e class="browser-default" onchange=getfac();>
			</select></td>
			<td colspan="2"><div id=341>Faculty Name :</div><select size="1" name="331" id=331 class="browser-default">
			</select></td>
		</tr>

		<!-- <tr>
			<td colspan="4" style="text-align:center;font-weight:bold;font-size:20px">Optional Filter</td>
		</tr> -->
		<tr>
			<!-- <td style="font-weight:bold">Filter</td> -->
			<input type="hidden" name="filter" id="filter" value="">
			<!-- <td>

				<select size="1" name="filter" id="filter" onchange="filu()" class="browser-default" visibility:"hidden">
				<option value="">-select-</option>
				<option value=1>Less Than</option>
				<option value=2>Greater Than</option>
				<option value=3>Between</option>
				</select>
			</td> -->
			<td><input type="hidden" name="start" id="start" size="4" placeholder="LOWER LIMIT"></td> 
			<td><input type="hidden" name="end" id="end" size="4" placeholder="UPPER LIMIT"></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:center"><input type="button" onclick=show();visi() value="SUBMIT" style="visibility:visible" id='OK' name="B1" class="myButton"></td>
		</tr>
	</table>

	
	
	
			
</form>
</div>
</div>
</div>
<div class="col m10 offset-m1">
<input type="hidden" name="save" class="push" value='SAVE' style="visibility:hidden" id='save' onclick="return OnButton1();">
	<input type="hidden" name="print" class="push" value='PRINT' style="visibility:hidden" id='print' onclick="return OnButton2();"></input>

<div id="txt" align=center ></div>
<br><br>
<div id="roles" align=center ></div>
</div>

</body>

@endsection