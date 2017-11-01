<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script type="text/javascript">
    $(document).ready( function(){
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
</head>
<body>
<div class="preloading-screen">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-green-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
            <div class="circle"></div>
        </div><div class="circle-clipper right">
            <div class="circle"></div>
        </div>
        </div>
    </div>
    <h4 class="ml-5 green-text text-darken-2"> GreenBoard! <i class="fa fa-pencil"></i></h4>
    <br><br>
    <h6 class="powered-by">Powered by Team OSS</h6>
</div>
<header class="navbar-fixed">
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="#">{{ Auth::user()->name }}</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout <i class="fa fa-power-off right"></i></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
    </ul>
    <nav class="green darken-2">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo center">GreenBoard <i class="fa fa-pencil right"></i></a>
            <ul class="right hide-on-med-and-down">
                <!-- Dropdown Trigger -->
                <li><a href="#">Go to Moodle!</a></li>
                <li><a class="dropdown-button" href="#" data-activates="dropdown1">
                   <img class="icon mx-5" src="/images/profile-image-1.png" align="center"> <i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
            <ul class="left hide-on-med-and-down">
                <li><a class="text-uppercase bold-text" href="#">Attendance Portal</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="row">
<section class="col s12 m10 offset-m2">
    <main>
        <!--your code here-->
        @yield('content')

    </main>
</section>
</div>

<div class="row">
<footer class="col offset-m2 s12 m10">
    <hr>
    <div class="right-align py-5">
        &copy; 2017, OSS R&D Web Development Team.
    </div>
</footer>
</div>

<aside class="right-aside">
    <div class="open-seasame green darken-2 white-text">Open Portals <i class="fa fa-arrow-up"></i></div>
    <ul class="collection with-header center">
        <li class="collection-header"><h5>Portals</h5></li>
        <a href="marks.html" class="collection-item">Marks Portal</a>
        <a href="attendance.html" class="collection-item active">Attendance Portal</a>
        <a href="student.html" class="collection-item">Student Portal</a>
    </ul>
</aside>

<aside class="side-navigation green hide-on-med-and-down">
    <ul>
        <a class="waves-effect waves-ripple" href="{{url('./attendance')}}"> <i class="fa fa-plus"></i> ADD ATTENDANCE<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
        <!-- <li><a href="#">hod</a></li>
        <li><a href="#">faculty</a></li> -->
        <!-- <li><a href="{{url('./addstud')}}">student</a></li>
        <li><a href="{{url('./subject/create')}}">subject</a></li>
        <li><a href="{{url('./attendance')}}">attendance</a></li>
        <li><a href="{{url('./assignrole')}}">assign role</a></li> -->
        <!-- <li><a href="#">upload students</a></li>
        <li><a href="#">upload subjects</a></li> -->
        <!-- <li><a href="#">upload faculty</a></li>
        <li><a href="#">upload assign role</a></li> -->
       <!--  <li><a href='#' class='green darken-2 backwards'><i class='fa fa-arrow-left'></i>Go Back</a></li> -->
    </ul>
    <ul>
        <a class="waves-effect waves-ripple" href="{{url('./viewattendance')}}"> <i class="fa fa-pencil-square-o"></i> VIEW ATTENDANCE<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
<!-- <li><li><a href="{{url('./updatestud')}}">Student</a></li>
         <li><a href="{{url('./subject')}}">subject</a></li>
         <li><a href="{{url('./assignrole')}}">assignrole</a></li>
         <li><a href='#' class='green darken-2 backwards'><i class='fa fa-arrow-left'></i>Go Back</a></li> -->
    </ul>

    <ul>
        <a class="waves-effect waves-ripple" href="{{url('./addmarks')}}"> <i class="fa fa-plus"></i> ADD MARKS<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
        <!-- <li><a href="#">hod</a></li>
        <li><a href="#">faculty</a></li> -->
    <!-- <li><a href="{{url('./addstud')}}">student</a></li>
        <li><a href="{{url('./subject/create')}}">subject</a></li>
        <li><a href="{{url('./attendance')}}">attendance</a></li>
        <li><a href="{{url('./assignrole')}}">assign role</a></li> -->
        <!-- <li><a href="#">upload students</a></li>
        <li><a href="#">upload subjects</a></li> -->
        <!-- <li><a href="#">upload faculty</a></li>
        <li><a href="#">upload assign role</a></li> -->
        <!--  <li><a href='#' class='green darken-2 backwards'><i class='fa fa-arrow-left'></i>Go Back</a></li> -->
    </ul>

    <ul>
        <a class="waves-effect waves-ripple" href="{{url('./marks/update')}}"> <i class="fa fa-plus"></i> UPDATE MARKS<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
        <!-- <li><a href="#">hod</a></li>
        <li><a href="#">faculty</a></li> -->
    <!-- <li><a href="{{url('./addstud')}}">student</a></li>
        <li><a href="{{url('./subject/create')}}">subject</a></li>
        <li><a href="{{url('./attendance')}}">attendance</a></li>
        <li><a href="{{url('./assignrole')}}">assign role</a></li> -->
        <!-- <li><a href="#">upload students</a></li>
        <li><a href="#">upload subjects</a></li> -->
        <!-- <li><a href="#">upload faculty</a></li>
        <li><a href="#">upload assign role</a></li> -->
        <!--  <li><a href='#' class='green darken-2 backwards'><i class='fa fa-arrow-left'></i>Go Back</a></li> -->
    </ul>

   <!--  <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-trash-o"></i> delete<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
        <li><a href="{{url('/deletestud')}}">Student</a></li>
        <li><a href='#' class='green darken-2 backwards'><i class='fa fa-arrow-left'></i>Go Back</a></li>
    </ul>
    <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-eye"></i> view<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
        <li><a href="{{url('./viewattendance')}}">Attendance</a></li>
        <li><a href='#' class='green darken-2 backwards'><i class='fa fa-arrow-left'></i>Go Back</a></li>
    </ul> -->

    <!-- <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-file"></i> generate letter<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
    </ul>
    <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-book"></i> course coverage<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
    </ul>
    <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-bar-chart-o"></i> report<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
    </ul>
    <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-cogs"></i> settings<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
    </ul>
    <ul>
        <a class="waves-effect waves-ripple" href="#"> <i class="fa fa-bookmark-o"></i> activity log<i class="fa fa-arrow-left right oh-here-is-a-back-button"></i></a>
    </ul>
</aside> -->



<script type="text/javascript" src="/plugins/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/plugins/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
<script type="text/javascript">
    $(document).ready( function(){
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
</body>
</html> 