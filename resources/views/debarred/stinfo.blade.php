<div>
    <b>Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    {{$student->name}}
</div><br><br>
<div>
    <b>Branch:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <p id="branch">{{$student->branch}}</p>
</div><br><br>
<div>
    <b>Section:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <p id="section">{{$student->section}}</p>
</div><br><br>

<div>
    <b>Semester:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <p id="semester">{{$student->semester}}</p>
</div><br><br>

@if($debarred!="DB" and $debarred!='NM')
    <b>Subject:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="sub" id="subject" onchange="getExam()" class="browser-default" required>
        <option value="">SELECT</option>
        @foreach ($sub as $subs)
            <option value="{{$subs->sub_id}}">{{$subs->sub_id}}</option>
        @endforeach

        @if(isset($stu_oe_subs->OE1) and $stu_oe_subs->OE1!='')
            <option value="{{$stu_oe_subs->OE1}}">{{$stu_oe_subs->OE1}}</option>
        @endif
        @if(isset($stu_oe_subs->OE2) and $stu_oe_subs->OE2!='')
            <option value="{{$stu_oe_subs->OE2}}">{{$stu_oe_subs->OE2}}</option>
        @endif
        @if(isset($stu_oe_subs->OE3) and $stu_oe_subs->OE3!='')
            <option value="{{$stu_oe_subs->OE3}}">{{$stu_oe_subs->OE3}}</option>
        @endif
    </select><br><br>

@endif

<div>
    <b>Exam:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="exam" id="exam" class="browser-default" required>
        <option value="">SELECT</option>
        @foreach($exams as $exam)
            <option value="{{ $exam->exam_name }}">{{ $exam->exam_name }}</option>
        @endforeach
    </select><br><br>
</div>

<input type="submit" id="submit" class="btn btn-primary form-control" value="submit">

 
