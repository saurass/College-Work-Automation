function showSem()
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
    xhttp.open("GET","/showMarksSem?branch="+branch,true);
    xhttp.send();
}

function getexam()
{
    var ext=document.getElementById('examtype').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("exam").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/showTypeExam?examtype="+ext,true);
    xhttp.send();
}

function getExamName()
{
    var exam=document.getElementById('exam').value;
    var branch=document.getElementById('branch').value;
    var semester=document.getElementById('sem').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("examname").value=this.responseText;
        }
    };
    xhttp.open("GET","/getExamName?exam="+exam+'&branch='+branch+'&semester='+semester,true);
    xhttp.send();
}