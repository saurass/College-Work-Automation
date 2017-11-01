function showsem()
{
    var branch=document.getElementById('branch').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById('semester').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/ViewMarksAdminGetSem?branch='+branch,true);
    xhttp.send();
}

function showsec()
{
    var branch=document.getElementById('branch').value;
    var semester=document.getElementById('semester').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById('section').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/ViewMarksAdminGetSec?branch='+branch+'&semester='+semester,true);
    xhttp.send();
}

function showexam()
{
    var branch=document.getElementById('branch').value;
    var semester=document.getElementById('semester').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById('exam').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/ViewMarksAdminGetExam?branch='+branch+'&semester='+semester,true);
    xhttp.send();
}

function getMarkView()
{
    var section=document.getElementById('section').value;
    var semester=document.getElementById('semester').value;
    var exam=document.getElementById('exam').value;
    var order=document.getElementById('order').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById('viewmarks').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/ViewMarksAdminGetViewMark?section='+section+'&semester='+semester+'&exam='+exam+'&order='+order,true);
    xhttp.send();
}