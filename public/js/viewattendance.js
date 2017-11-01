


function getsection(sem) {
        var xmlhttp;

        if (window.XMLHttpRequest) {
            //code for IE7,firefox,chrome,opera,safari  

            xmlhttp = new XMLHttpRequest();
        }
        else {

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET", "/showsection?sem=" + sem , true)
        xmlhttp.send();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                document.getElementById("section").innerHTML = xmlhttp.responseText;
            }
        }
    }

function f1(str) {

        var sem = document.getElementById("semester").value;


        if (str == "R1") {

            document.getElementById("sc").style.visibility = "hidden";
            document.getElementById("tp").style.visibility = "hidden";
            document.getElementById("incdec").style.visibility = "hidden";
            document.getElementById("32").style.visibility = "hidden";
            document.getElementById("31").style.visibility = "hidden";
            document.getElementById("331").style.visibility = "hidden";
            document.getElementById("331e").style.visibility = "hidden";
            document.getElementById("341e").style.visibility = "hidden";
            document.getElementById("341").style.visibility = "hidden";

            var xmlhttp;

            if (window.XMLHttpRequest) {
                //code for IE7,firefox,chrome,opera,safari  

                xmlhttp = new XMLHttpRequest();
            }
            else {

                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }


            xmlhttp.open("GET", "searchsubject2?sem=" + sem, true)

            xmlhttp.send();

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("12").innerHTML = xmlhttp.responseText;
                }
            }

        }
        else if (str == "R2") {
            document.getElementById("sc").style.visibility = "hidden";
            document.getElementById("tp").style.visibility = "hidden";
            document.getElementById("incdec").style.visibility = "hidden";
            document.getElementById("32").style.visibility = "hidden";
            document.getElementById("31").style.visibility = "hidden";
            document.getElementById("331").style.visibility = "hidden";
                        document.getElementById("331e").style.visibility = "hidden";

            document.getElementById("341").style.visibility = "hidden";
            document.getElementById("341e").style.visibility = "hidden";


        }
        else if (str == "R3") {
            document.getElementById("sc").style.visibility = "hidden";
            document.getElementById("tp").style.visibility = "hidden";
            document.getElementById("incdec").style.visibility = "hidden";
            document.getElementById("32").style.visibility = "visible";
            document.getElementById("31").style.visibility = "visible";
            document.getElementById("331").style.visibility = "hidden";
                        document.getElementById("331e").style.visibility = "hidden";

            document.getElementById("341e").style.visibility = "hidden";

            document.getElementById("341").style.visibility = "hidden";

            var xmlhttp;

            if (window.XMLHttpRequest) {
                //code for IE7,firefox,chrome,opera,safari  

                xmlhttp = new XMLHttpRequest();
            }
            else {

                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }


            xmlhttp.open("GET", "searchsubject2?sem=" + sem, true)

            xmlhttp.send();

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(0);
                    document.getElementById("31").innerHTML = xmlhttp.responseText;
                }
            }




        }
        else if (str == "R5") {
            document.getElementById("sc").style.visibility = "hidden";
            document.getElementById("tp").style.visibility = "hidden";
            document.getElementById("incdec").style.visibility = "hidden";
            document.getElementById("32").style.visibility = "hidden";
            document.getElementById("31").style.visibility = "hidden";
            document.getElementById("341").style.visibility = "visible";
            document.getElementById("331").style.visibility = "visible";
                        document.getElementById("331e").style.visibility = "visible";

            document.getElementById("341e").style.visibility = "visible";

            var xmlhttp;

            getsub();

            /*
            var sem = document.getElementById("semester").value;

            if (window.XMLHttpRequest) {
                //code for IE7,firefox,chrome,opera,safari  

                xmlhttp = new XMLHttpRequest();
            }
            else {

                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }


            xmlhttp.open("GET", "searchfaculty2.php?sem=" + sem, true);

            xmlhttp.send();

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(0);
                    document.getElementById("331").innerHTML = xmlhttp.responseText;
                }
            }
            */



        }
        else if (str == "R4") {
            document.getElementById("sc").style.visibility = "visible";
            document.getElementById("tp").style.visibility = "visible";
            document.getElementById("incdec").style.visibility = "visible";
            document.getElementById("32").style.visibility = "hidden";
            document.getElementById("31").style.visibility = "hidden";
            document.getElementById("331").style.visibility = "hidden";
                        document.getElementById("331e").style.visibility = "hidden";

            document.getElementById("341e").style.visibility = "hidden";

            document.getElementById("341").style.visibility = "hidden";




        }
        else {
        }
    }


 function show() {

        
        var sem = document.getElementById("semester").value;
        var sec = document.getElementById("section").value;
        var cat = "2";
        var sc = document.getElementById("sc").value;
        var tp = document.getElementById("tp").value;
        var incdec = document.getElementById("incdec").value;
        var fdate = document.getElementById("fdate").value;
        var tdate = document.getElementById("tdate").value;
        var fselect = document.getElementById("filter").value;

        if (sem == '') {
            alert("SEMESTER field is missing");
        }
        else if (sec == '' && !(document.getElementById("R5").checked)) {
            alert("SECTION field is missing");
        }
        else if (fdate == '') {
            alert("FROM DATE field is missing");
        }
        else if (tdate == '') {
            alert("TO DATE field is missing");
        }
        else if (document.getElementById("R3").checked && document.getElementById("31").value == '') {
            alert("SUJECT ID field is missing");
        }
        else if (document.getElementById("R4").checked && (sc == '' || tp == '' || incdec == '')) {
            alert("Some of VIEW BY item is missing");
        }
        else if (document.getElementById("R5").checked && document.getElementById("331").value == '') {
            alert("Faculty Name field is missing");
        }

        var start;
        var end;
        if (fselect == "") {
            start = 0;
            end = 100;
        }
        else if (fselect == 1) {
            start = 0;
            end = document.getElementById("start").value;
        }
        else if (fselect == 2) {
            end = 100;
            start = document.getElementById("start").value;
        }
        else {
            start = document.getElementById("start").value;
            end = document.getElementById("end").value;
        }





        var xmlhttp;

        if (window.XMLHttpRequest) {
            //code for IE7,firefox,chrome,opera,safari  

            xmlhttp = new XMLHttpRequest();
        }
        else {

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }


        if (document.getElementById("R3").checked) {
           // alert("jaoaajoa");
            var sid = document.getElementById("31").value;
            xmlhttp.open("GET", "/showhodattendthirdmul?sem=" + sem + " & sec=" + sec + " & fdate=" + fdate + " & tdate=" + tdate + " & sid=" + sid + " & start=" + start + " & end=" + end, true)
        }
        else if (document.getElementById("R5").checked) {
            var sub = document.getElementById("331").value;
            var sid = document.getElementById("331e").value;
            xmlhttp.open("GET", "showhodattendthirdmul?sem=" + sem + " & sec=" + sec + " & fdate=" + fdate + " & sub=" + sub + " & tdate=" + tdate + " & sid=" + sid + " & start=" + start + " & end=" + end, true)
        }
        else if (document.getElementById("R4").checked && cat == "2") {
            //alert(sem+" "+sec+" "+fdate+" "+tdate+" "+year+" "+start+" "+end+" "+sc+" "+tp+" "+incdec);
            xmlhttp.open("GET", "showhodattendfourthmul?sem=" + sem + " & sec=" + sec + " & fdate=" + fdate + " & tdate=" + tdate + " & start=" + start + " & end=" + end + " & sc=" + sc + " & tp=" + tp + " & incdec=" + incdec, true)
           
         //showfacultynames();
        }

        xmlhttp.send();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txt").innerHTML = xmlhttp.responseText;
                document.getElementById("tdata").value = xmlhttp.responseText;
            }
        }

    }


function visi() {
        document.getElementById("save").style.visibility = "visible";
        document.getElementById("print").style.visibility = "visible";
        //document.getElementById("OK").style.visibility="hidden";

    }


function getsub() {

        var sem = document.getElementById("semester").value;
        var xmlhttp;

        if (window.XMLHttpRequest) {
            //code for IE7,firefox,chrome,opera,safari  

            xmlhttp = new XMLHttpRequest();
        }
        else {

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("GET", "searchsubject2?sem=" + sem, true);
        xmlhttp.send();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //alert("nnn");
                document.getElementById("331e").innerHTML = xmlhttp.responseText;
            }
        }
    }

    function getfac() {

        var sem = document.getElementById("semester").value;
        var sub = document.getElementById("331e").value;

        var xmlhttp;

        if (window.XMLHttpRequest) {
            //code for IE7,firefox,chrome,opera,safari  

            xmlhttp = new XMLHttpRequest();
        }
        else {

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("GET", "searchfaculty?sem=" + sem + "&sub=" + sub, true);
        xmlhttp.send();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //alert("nnn");
                document.getElementById("331").innerHTML = xmlhttp.responseText;
            }
        }
    }

 function filu() {



        var filter = document.getElementById("filter").value;
        if (filter == 1 || filter == 2) {
            document.getElementById("start").style.visibility = "visible";
           // document.getElementById("to1").style.visibility = "hidden";
            document.getElementById("end").style.visibility = "hidden";
        }
        else {
            document.getElementById("start").style.visibility = "visible";
            //document.getElementById("to1").style.visibility = "visible";
            document.getElementById("end").style.visibility = "visible";
        }

    }
    