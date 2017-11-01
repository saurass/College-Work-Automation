<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
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
        <li><a href="#">Miss Jane Doe</a></li>
        <li class="divider"></li>
        <li><a href="#">Logout <i class="fa fa-power-off right"></i></a></li>
    </ul>
    <nav class="green darken-2">
        <div class="nav-wrapper">
            <a href="index.html" class="brand-logo center">GreenBoard <i class="fa fa-pencil right"></i></a>
            <ul class="right hide-on-med-and-down">
                <!-- Dropdown Trigger -->
                <li><a href="#">Go to Moodle!</a></li>
                <li><a class="dropdown-button" href="#" data-activates="dropdown1">
                    <img class="icon mx-5" src="assets/images/profile-image-1.png" align="center"> <i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
            <ul class="left hide-on-med-and-down">
                <li><a class="text-uppercase bold-text" href="#">Name of the Portal</a></li>
            </ul>
        </div>
    </nav>
</header>

<main class="container">

</main>

<footer class="container">
    <hr>
    <div class="right-align py-5">
        &copy; 2017, OSS R&D Web Development Team.
    </div>
</footer>

<aside class="right-aside">
    <div class="open-seasame green darken-2 white-text">Open Portals <i class="fa fa-arrow-up"></i></div>
    <ul class="collection with-header center green-text">
        <li class="collection-header"><h5>Portals</h5></li>
        <a href="marks.html" class="collection-item">Marks Portal</a>
        <a href="attendance.html" class="collection-item active">Attendance Portal</a>
        <a href="student.html" class="collection-item">Student Portal</a>
    </ul>
</aside>

<aside class="side-navigation green"></aside>

<script type="text/javascript" src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/plugins/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>