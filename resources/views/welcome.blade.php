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
      <!--    <li><a href="#">Miss Jane Doe</a></li>
        <li class="divider"></li>
        <li><a href="#">Logout <i class="fa fa-power-off right"></i></a></li> -->
    </ul>
    <nav class="green darken-2">
        <div class="nav-wrapper">
            <a href="index.html" class="brand-logo center">GreenBoard <i class="fa fa-pencil right"></i></a>
            <ul class="right hide-on-med-and-down">
                <!-- Dropdown Trigger -->
    @if (Auth::guest())
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
 @else
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="#">{{ Auth::user()->firstname }}</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout <i class="fa fa-power-off right"></i></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    
     </ul>

@endif
                
                <li><a class="dropdown-button" href="#" data-activates="dropdown1">
                   <img class="icon mx-5" src="/images/profile-image-1.png" align="center"> <i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="container">
    <section class="d-flex center-align welcome">
        <h4>Welcome, <span class="green-text text-darken-2"></span> to the Green Board!</h4>
    </section>

    <section class="row center">
        <article class="col s4">
            <div class="row">
                <div class="col s12">
                    <a href="/attendanceportal"><img src="/images/attendance.jpg" class="responsive-img ams"></a>
                </div>
                <h5 class="col s12 py-20">
                    Attendance Portal
                </h5>
                <p>Some Lorem Ipsum Text. Just for some Lorem Ipsum Bullshit.</p>
            </div>
        </article>
        <article class="col s4">
            <div class="row">
                <div class="col s12">
                    <a href="marks.html"><img src="/images/marks.jpg" class="responsive-img ams"></a>
                </div>
                <h5 class="col s12 py-20">
                    Marks Portal
                </h5>
                <p>Some Lorem Ipsum Text. Just for some Lorem Ipsum Bullshit.</p>
            </div>
        </article>
        <article class="col s4">
            <div class="row">
                <div class="col s12">
                    <a href="student.html"><img src="/images/student.jpg" class="responsive-img ams"></a>
                </div>
                <h5 class="col s12 py-20">
                    Student Portal
                </h5>
                <p>Some Lorem Ipsum Text. Just for some Lorem Ipsum Bullshit.</p>
            </div>
        </article>
    </section>
</main>

<footer class="container">
    <hr>
    <div class="right-align py-5">
        &copy; 2017, OSS R&D Web Development Team.
    </div>
</footer>
<script type="text/javascript" src="/plugins/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/plugins/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
</body>
</html>