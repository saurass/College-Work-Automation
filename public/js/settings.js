function getsection() {
    var xhttp = new XMLHttpRequest();
    var branch = document.getElementById('branch').value;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('section').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET','/SetGetSec?branch='+branch,true);
    xhttp.send();
}

function getsemester() {
    var xhttp = new XMLHttpRequest();
    var branch = document.getElementById('branch').value;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('semester').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET','/SetGetSem?branch='+branch,true);
    xhttp.send();
}

function showDetail() {
    var xhttp = new XMLHttpRequest();
    var branch = document.getElementById('branch').value;
    var section = document.getElementById('section').value;
    var semester = document.getElementById('semester').value;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('details').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET','/SetGetDetail?branch='+branch+'&section='+section+'&semester='+semester,true);
    xhttp.send();
    return false;
}

function setAllSem() {
    var sem_all = document.getElementById('sem_all').value;
    var i=1;

    while (document.getElementById('stu'+i))
    {
        var st=document.getElementById('stu'+i);
        st.value=sem_all;
        i++;
    }
}