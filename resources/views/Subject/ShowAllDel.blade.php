@extends('layouts.attendance')
@section('content')
    <div class="row">
        <div class="row"></div>
        <form action="/searchdelsubdata">
            <div class="row center">
                <div class="input-field col s12">
                    <div class="col s12 m9">
                        <input type="text" name="str" placeholder="Enter Part Of Subject Code" maxlength="7">
                    </div>
                    <div class="col s12 m3 left-align">
                        <button type="submit" class="btn green"> Search <i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if(isset($_REQUEST['str']))
    <div class="row"></div>
   
        @foreach($AllSub as $sub)
            <div class="col m6 offset-m2">
                <div class="card z-depth-5">
                    <div class="card-content">
                            <span class="card-title">
                                <span class="left col s12 m6">{{ $sub->sub_id }}</span>
                                <span class="right right-align col s12 m6 text-capitalize">{{ strtolower($sub->sub_name) }}</span>
                            </span>
                        <div class="row"></div>
                        Branch &nbsp;&nbsp;&nbsp;&nbsp;: {{ $sub->branch }}<br>
                        Category :
                        @if($sub->category=="T")
                            Theory Subject
                        @endif
                        @if($sub->category=="P")
                            Practical Subject
                        @endif
                        @if($sub->category=="O")
                            Open Elective Subject
                        @endif
                        <br>Semester : {{ $sub->semester }}
                        <div class="card-action">
                            <form action="/subject/{{ $sub->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="redirect" value="/subject/deletesub?status=success">
                                <button type="submit" name="DeleteSub" class="btn red right">Delete <i class="fa fa-trash"></i></button>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <br>
@endsection