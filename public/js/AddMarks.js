function getSub()
{
    var sub=document.getElementById('subject').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("section").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/AddMarksShowSection?sub="+sub,true);
    xhttp.send();
}

function showExam()
{
    var sub=document.getElementById('subject').value;
    var sec=document.getElementById('section').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("exams").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/AddMarksShowExams?sub="+sub+"&sec="+sec,true);
    xhttp.send();
}

function getAddExamMarkList()
{
        var sec=document.getElementById('section').value;
        var sub=document.getElementById('subject').value;
        var exam=document.getElementById('exams').value;

        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function()
        {
            if(this.readyState==4 && this.status==200)
            {
                var datas=this.responseText;
                document.getElementById("addMarksField").innerHTML=this.responseText;
            }
        };
        xhttp.open("GET","/AddMarksShowStudentList?sub="+sub+"&sec="+sec+"&exam="+exam,true);
        xhttp.send();
}

function getUpdateExamMarkList()
{
    var sec=document.getElementById('section').value;
    var sub=document.getElementById('subject').value;
    var exam=document.getElementById('exams').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("addMarksField").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/UpdateMarksShowStudentList?sub="+sub+"&sec="+sec+"&exam="+exam,true);
    xhttp.send();
}

function getSem()
{
    var branch=document.getElementById('branch').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("sem").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/UpdateMarksShowSem?branch="+branch,true);
    xhttp.send();
}

function showSec()
{
    var branch=document.getElementById('branch').value;
    var sem=document.getElementById('sem').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("section").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/UpdateMarksShowSec?branch="+branch+"&sem="+sem,true);
    xhttp.send();
}

function showSub()
{
    var branch=document.getElementById('branch').value;
    var sem=document.getElementById('sem').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("subject").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/UpdateMarksShowSub?branch="+branch+"&sem="+sem,true);
    xhttp.send();
}

function getExam()
{
    var branch=document.getElementById('branch').value;
    var sem=document.getElementById('sem').value;
    var sec=document.getElementById('section').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("exams").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/UpdateMarksShowExam?branch="+branch+"&sem="+sem,true);
    xhttp.send();
}

function checkForm()
{
    var i=1;
    var mm=document.getElementById('mm').value;
    var str='mark'+i;

    while(document.getElementById(str))
    {
        if (parseInt(document.getElementById(str).value) > parseInt(mm))
        {
            document.getElementById(str).focus();
            alert('Obtained Marks Must Always Be Lesser Than Maximum Marks');
            return false;
            break;
        }
        i++;
        str='mark'+i;
    }
    return true;
}