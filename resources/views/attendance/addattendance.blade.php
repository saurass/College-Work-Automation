@extends('layouts.attendance')

@section('content')
    <script src="/js/addattendance.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: false // Close upon selecting a date,
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: false // Close upon selecting a date,
            });
        });
    </script>
    <div id='check'></div>

    <div class="col m8 offset-m2">

        @if(isset($_REQUEST['status']) && $_REQUEST['status']=='sucess')
            <div class="center">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">

                        <div class=""><h5>Added Successfully..!!</div>

                    </div>
                </div>
            </div>
        @endif
        <form method="POST" action="">
            <div class="card z-depth-5">

                <div class="card-content">
                    <span class="card-title center">Add Attendance</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>


                    Subject ID :

                    <select size="1" name="subjectid" class="browser-default" id="subjectid"
                            onchange=showname(this.value);showsem(this.value);showsection(this.value)></select></td>


                    <div class="input-field">

                        <input type="text" name="subjectname" size="20" placeholder="Subject Name" id="subjectname"
                               required><br><br>

                    </div>


                    Section:
                    <select size="1" name="section" id="section" class="browser-default"></select>
                    Semester:
                    <input type=text id="semester" name="semester">


                    Date:
                    <div class="input-field">
                        <input type="radio" value="single" name="R1" onclick=disable() id="single">
                        <label for="single">Single</label>
                        <input type="radio" value="multiple" name="R1" id="multi" checked onclick=enable()>
                        <label for="multi">Multiple</label>

                        </td>
                        <td>
                            <br>
                            <br>
                            <input type="date" name="fromdate" style="width: 40%" size="6" id="fromdate" onchange="disappear();validate();">
                                &nbsp;&nbsp;<lable id=to><b>TO</b></lable>&nbsp;&nbsp;
                            <input type="date" name="todate" style="width: 40%;"  id="todate" size="6" onchange="disappear();validate();">
                        </td>
                    </div>

                    <td style="font-weight:bold">
                        Total no. of classes&nbsp; held
                    </td>
                    <td>
                        <input type="text" name="totalclasses" size="20" id=noc onfocus=validate()
                               onkeypress="return VinChecknum(event)"></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold">
                            Total no. of mass&nbsp; bunks
                        </td>
                        <td>
                            <input type="text" name="massbunks" value="0" size="20" id=massbunks onfocus=validate()
                                   onkeypress="return VinChecknum(event)"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center">
                            <input type="button" value="SUBMIT" name="B1" onclick=fvalid();studentcount() id="submit">
                        </td>
                        </td>
                    </tr>
                    </table>
                </div>
        </form>


    </div>
    <div id=txtHint></div>
    <input type="hidden" id="validornot">
    <input type="hidden" id="studentcount">
    <div id=txtHint1></div>
    <div id=txt></div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: false // Close upon selecting a date,
            });
        });
    </script>

@endsection

