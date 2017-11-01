<div class="col-md-6 col-md-offset-3">
    <table class="table table-responsive">
        <tr>
            <th>Faculty Id</th>
            <th>Faculty Name</th>
            <th>Subject Id</th>
            <th>Subject Name</th>
            <th>Semester</th>
            <th>Section</th>
        </tr>

        @foreach($data as $datum)
            <tr>
                <td>
                    {{ $datum->fac_id }}
                </td>
                <td>
                    @foreach($fac_data as $fac_datum)
                        @if($fac_datum->userid==$datum->fac_id)
                            {{ $fac_datum->name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <td>
                    {{ $datum->sub_id }}
                </td>
                <td>
                    @foreach($sub_data as $sub_datum)
                        @if($sub_datum->sub_id==$datum->sub_id)
                            {{ $sub_datum->sub_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <td>
                    {{ $datum->semester }}
                </td>
                <td>
                    {{ $datum->section }}
                </td>
            </tr>
        @endforeach
    </table>
</div>