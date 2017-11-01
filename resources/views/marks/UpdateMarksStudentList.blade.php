@php
    $i=1;
@endphp
<form action="/marks/update" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="exam_name" value="{{ $exam->exam_name }}">
    <input type="hidden" name="sub_id" value="{{ $subject }}">
    <input type="hidden" name="sem" value="{{ $exam->semester }}">
    <input type="hidden" name="branch" value="{{ $branch }}">
    <input type="hidden" name="section" value="{{ $section }}">
    <input type="hidden" id="mm" name="mm" value="{{ $exam->max_mark }}">

    <table class="table table-responsive">
        <tr>
            <th>
                Student Number
            </th>
            <th>
                Student Name
            </th>
            <th>
                Maximum Marks
            </th>
            <th>
                Obtained Marks
            </th>
        </tr>
        @foreach($students as $student)
            <tr>
                <td>
                    {{ $student->st_id }}
                </td>
                <td>
                    {{ $student->name }}
                </td>
                <td>
                    {{ $exam->max_mark }}
                </td>
                <td>
                    @foreach($marks as $mark)
                        @if($mark->st_id == $student->st_id)
                            <input type="text" size="3" value="{{ $mark->marks_obtained }}" id="{{ 'mark'.$i }}" name="{{ 'mark'.$i }}" required>
                        @endif
                    @endforeach
                </td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </table>
    <input type="submit" onclick="return checkForm();">
</form>