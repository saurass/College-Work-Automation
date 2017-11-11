@extends('layouts.attendance')
@section('content')


    <div class="col m8 offset-m2">
        <div class="card z-depth-5">
            <div class="card-content">


                @if ($errors->any())
                    <div class="alert alert-danger" role="alert" style="font-size:20px;">

                        @foreach ($errors->all() as $error)

                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>


                            {{ $error }}
                            <p>
                        @endforeach

                    </div>
                @endif

                @if(isset($_REQUEST['status']) and $_REQUEST['status']=='Success')
                    SuccessFully Added To List
                @endif


                @if(isset($_REQUEST['status']) and $_REQUEST['status']=='alreadyexists')
                    <th class="header">ALREADY ADDED</th>
                @endif
                <form action="/debarred" method="post">
                    {{ csrf_field() }}

                    <span class="card-title center">Debarred Listing</span>
                    <p class="center">PLEASE ENTER ALL DETAILS</p>

                    <div>
                        <b>Debarred Type:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="debarred" id="debarred" class="browser-default" required>
                            <option value="">SELECT</option>
                            <option value="DB">DB</option>
                            <option value="SDB">SDB</option>
                            <option value="PC">PC</option>
                            <option value="UFM">UFM</option>
                        </select><br><br>
                    </div>

                    <div>
                        <b>Student Roll no. :</b>
                        <input type="text" id="st_id" onchange="remover()" name="st_id" required>
                        <button id="click" name="click" onclick="return getinfo()">Get Details</button>
                        <br><br>
                    </div>

                    <div id="st_info"></div>

                </form>
            </div>
        </div>
    </div>


    <script src="/js/Debar.js"></script>

@endsection