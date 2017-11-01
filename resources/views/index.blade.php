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
    <link rel="stylesheet" href="assets/css/animate.css"/>
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

<div class="welcome-to-greenboard green darken-2 white-text">
    <h3>Welcome to GreenBoard <i class="fa fa-pencil"></i> </h3>
    <h5 class="center-align">GreenBoard is the new Student Information Platform developed by Open Source Software Research and Development Center</h5>
    <p>Now tell us who you are </p>
    <a class="btn white green-text mx-5" onclick="faculty()" >I am a Faculty</a>
    <a class="btn white green-text mx-5" onclick="student()" >I am a Student</a>
    <div class="not-anyone">
        <a class="btn-flat text-capitalize white-text" href="mistaken.html">I am neither</a>
    </div>
</div>

<div class="headnote-akgec">
    <img src="assets/images/akgec.png" class="icon mx-5" align="center"><a href="http://akgec.in" class="green-text text-lighten-2" target="_blank">akgec.in</a>
</div>

<div class="headnote-ossrndc">
    <a href="http://ossrndc.in" class="green-text text-lighten-2" target="_blank">ossrndc.in</a> <img src="assets/images/logo.png" class="icon" align="center">
</div>

<div class="footnote text-capitalize green-text text-lighten-2">
    <a class="btn-flat text-capitalize green-text text-lighten-3 underline-text" id="skip">Skip</a>
    <br>
    &copy; GreenBoard | 2017
</div>
<div class="container">
<div class="row">
        <div class="col s12">
            <div id="faculty" style="display: none;" class="card z-depth-5 animated zoomIn">
                <div class="card-content row">
                <div  class="col m1 offset-m11"><button onclick="band_krr_de()">Close</button></div>
                    <div class="col s12 m6 center-align hide-on-med-and-down">
                        <div class="col m10 logo-holder">
                            <a href="http://ossrndc.in" target="_blank"><img src="assets/images/logo.png"></a>
                        </div>
                    </div>
                    <div class="col s12 m6 center-align hide-on-large-only">
                        <div class="col s12 logo-holder-sm">
                            <img src="assets/images/logo.png">
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card-title center-align"><h4>Sign In Faculty</h4></div>
                        <p class="center blue-text">Sign in to access your something something</p>
                        <div class="row">
                            <form class="col s12">

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix msr">perm_identity</i>
                                        <input id="email" type="email">
                                        <label for="email">Username</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix msr">lock_open</i>
                                        <input id="password" type="password" >
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p>
                                            <input type="checkbox" id="test6"  />
                                            <label for="test6">Remember Me</label>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <button class="btn blue">Sign in </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-action right-align">
                    New User? Register Here!
                    <a class="blue-text text-darken-1" href="#">  <i class="material-icons msr">wc</i> Faculty</a>
                    <a class="blue-text text-lighten-1" href="student register.html"> <i class="material-icons msr">people</i> Student</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div id="student" style="display: none;" class="card z-depth-5 animated zoomIn">
                <div class="card-content row">
                <div  class="col m1 offset-m11"><button onclick="band_krr_de()">Close</button></div>
                    <div class="col s12 m6 center-align hide-on-med-and-down">
                        <div class="col m10 logo-holder">
                            <a href="http://ossrndc.in" target="_blank"><img src="assets/images/logo.png"></a>
                        </div>
                    </div>
                    <div class="col s12 m6 center-align hide-on-large-only">
                        <div class="col s12 logo-holder-sm">
                            <img src="assets/images/logo.png">
                        </div>
                    </div>

                    <div class="col s12 m6">
                        <div class="card-title center-align"><h4>Sign In Student</h4></div>
                        <p class="center blue-text">Sign in to access your something something</p>
                        <div class="row">
                            <form class="col s12">

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix msr">perm_identity</i>
                                        <input id="email" type="email">
                                        <label for="email">Username</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix msr">lock_open</i>
                                        <input id="password" type="password" >
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p>
                                            <input type="checkbox" id="test6"  />
                                            <label for="test6">Remember Me</label>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <button class="btn blue">Sign in </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-action right-align">
                    New User? Register Here!
                    <a class="blue-text text-darken-1" href="#">  <i class="material-icons msr">wc</i> Faculty</a>
                    <a class="blue-text text-lighten-1" href="student register.html"> <i class="material-icons msr">people</i> Student</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function faculty(){
        x = document.getElementById("faculty");
        x.style.display = "block";
        x1 = document.getElementById("student");
        x1.style.display = "none";
        x2 = document.getElementById("fac_button");
        x3 = document.getElementById("student_button");
        x2.style.display = "none";
        x3.style.display = "none";
        
    }
    function student(){
        x = document.getElementById("student");
        x.style.display = "block";
        x1 = document.getElementById("faculty");
        x1.style.display = "none";
        x2 = document.getElementById("fac_button");
        x3 = document.getElementById("student_button");
        x2.style.display = "none";
        x3.style.display = "none";
        
    }

    function band_krr_de(){
        x = document.getElementById("student");
        x.style.display = "none";
        x1 = document.getElementById("faculty");
        x1.style.display = "none";
        x2 = document.getElementById("fac_button");
        x3 = document.getElementById("student_button");
        x2.style.display = "block";
        x3.style.display = "block";
    }
</script>


<script type="text/javascript" src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/plugins/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>