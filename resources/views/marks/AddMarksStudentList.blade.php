@php
    $i=1;
    $flag=0;
@endphp
<form action="/addmarks/add" method="post">
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
            @php
                $flag=0;
            @endphp
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

                @foreach($dbr as $dbrs)
                    @if($dbrs->st_id == $student->st_id)
                        <td>
                            <input type="text" size="3" maxlength="3" style="width: 50px" id="{{ 'mark'.$i }}"
                                   value="DB" name="{{ 'mark'.$i }}" readonly required>
                        </td>
                        @php
                            $flag=1;
                        @endphp
                        @break
                    @endif
                @endforeach

                @foreach($sdbr as $sdbrs)
                    @if($sdbrs->st_id == $student->st_id)
                        <td>
                            <input type="text" size="3" maxlength="3" style="width: 50px" id="{{ 'mark'.$i }}"
                                   value="SDB" name="{{ 'mark'.$i }}" readonly required>
                        </td>
                        @php
                            $flag=1;
                        @endphp
                        @break
                    @endif
                @endforeach

                @if($flag==0)
                    <td>
                        <input type="text" size="3" maxlength="3" style="width: 50px" id="{{ 'mark'.$i }}"
                               name="{{ 'mark'.$i }}" required>
                    </td>
                @endif
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </table>
    <input type="submit" class="btn" onclick="return checkForm();">
</form>