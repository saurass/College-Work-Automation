<table>
<tr>
<th>SNo</th>
<th>Roll no.</th>
<th>NAme</th>
<th>{{$fdate}} to {{$tdate}}</th>
<th>Percentage</th>
</tr>

@php
$ch=$datecount/$stcount;
$s=0;
@endphp
@for($j=0;$j<$datecount;$j+=$ch) 
 <tr>
 <td>{{$s+1}}</td>
 <td>{{$students[$s]}}</td>
 <td>{{$studentsname[$s++]}}</td>


   	@php
   	$att=0;
    $totcls=0;
    @endphp
    @for($i=0;$i<$ch;$i++)
     @php
     $att+=$attendance1[$j+$i]->attended;
      $totcls+=$attendance1[$j+$i]->totalclasses;
     @endphp
     @endfor

     @if(($att/$totcls)*100<75 )  
    <td class="red">{{$att}}/{{$totcls}}</td>
  <td class="red">{{number_format((($att/$totcls)*100), 2, '.', ',')}}%</td>  

  @else 
  <td>{{$att}}/{{$totcls}}</td>
  <td>{{number_format((($att/$totcls)*100), 2, '.', ',')}}%</td>
  @endif

   
 </tr>

@endfor