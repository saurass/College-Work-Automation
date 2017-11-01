

<table>
<tr>

<th>SNo</th>
<th>Roll no.</th>
<th>NAme</th>
@if($sc==1)
@foreach($subjects as $sub)
<th>{{$sub->sub_id}}</th>
@endforeach
@endif


<th>Total</th>
<th>Percentage</th>
</tr>
@php 
$i=0;
$j=$stcount;
$k=1;
$s=0;
@endphp



@foreach($stname as $student)

@php
$totatt=0;
$totheld=0;
@endphp
@for($i=0;$i<$cmdcount;$i++)
@php 
$totatt+=$atten1[($i*$stcount)+$s];
$totheld+=$tot1[($i*$stcount)+$s ];
@endphp
@endfor



@if($start<=(($totatt/$totheld)*100) && $end>=(($totatt/$totheld)*100))
<tr>


		<td>{{$k++}}</td>
<td>{{$student->st_id}}</td>
<td>{{$student->name}}</td>
		@for($i=0;$i<$cmdcount;$i++)
		@if($sc==1)
		<td>{{$atten1[($i*$stcount)+$s]}}/{{$tot1[($i*$stcount)+$s]}}</td>
		@endif
		@endfor


	@if(($totatt/$totheld)*100<75 )	
		<td class="red">{{$totatt}}/{{$totheld}}</td>
	<td class="red">{{number_format((($totatt/$totheld)*100), 2, '.', ',')}}%</td>	

	@else 
	<td>{{$totatt}}/{{$totheld}}</td>
	<td>{{number_format((($totatt/$totheld)*100), 2, '.', ',')}}%</td>
	@endif

	@php
	$s++;
	@endphp


</tr>
@endif

@endforeach






</table>