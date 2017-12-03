@php
    $i=1;
@endphp
<table class="table table-responsive table-bordered">

        <h5>
            PLEASE SELECT THE STUDENTS AND THEIR SEMESTER
        </h5>

    <tr>
        <th>Student No</th>
        <th>Student Name</th>
        <th>Current SEMESTER</th>
        <th>
            NEXT SEMESTER
            <input type="text" onchange="setAllSem()" name="sem_all" id="sem_all" maxlength="1" minlength="1"
                   width="50px">
        </th>
    </tr>

    @foreach($students as $student)
        <tr>
            <td>{{ $student->st_id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->semester }}</td>
            <td>
                <input type="text" id="{{ 'stu'.$i }}" max="8" min="1" name="{{ $student->st_id }}"
                       value="{{ $student->semester }}" maxlength="1" minlength="1" required>
            </td>

            @php
                $i++;
            @endphp
        </tr>
    @endforeach
</table>
<input type="submit" value="Update" class="btn green">