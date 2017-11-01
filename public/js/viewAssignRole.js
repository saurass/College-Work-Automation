function setViewBy() {
    var viewBy=document.getElementById('view_by').value;
    if (viewBy=="by_sec")
    {
        document.getElementById('option').innerHTML='SECTION : <select id="section" class="btn"><option value="">SELECT</option></select>';
        var branch=document.getElementById('branch').value;
        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function ()
        {
            if (this.readyState==4 && this.status==200)
            {
                var data=this.responseText;
                document.getElementById('section').innerHTML=this.responseText;
            }
        };
        xhttp.open('GET','/viewAssignSection?branch='+branch,true);
        xhttp.send();
    }
    else
    {
        document.getElementById('option').innerHTML='';
    }
}

function showSem2()
{
    var branch=document.getElementById('branch').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('sem').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/viewAssignSem2?branch='+branch,true);
    xhttp.send();
}

function getData()
{
    var viewby=document.getElementById('view_by').value;
    if(viewby=='by_sec')
    {
        var branch=document.getElementById('branch').value;
        var sem=document.getElementById('sem').value;
        var sec=document.getElementById('section').value;

        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function ()
        {
            if (this.readyState==4 && this.status==200)
            {
                var data=this.responseText;
                document.getElementById('table').innerHTML=this.responseText;
            }
        };
        xhttp.open('GET','/viewAssignGetData?branch='+branch+'&section='+sec+'&semester='+sem,true);
        xhttp.send();
    }
    else
    {
        var branch=document.getElementById('branch').value;
        var sem=document.getElementById('sem').value;

        var xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange=function ()
        {
            if (this.readyState==4 && this.status==200)
            {
                var data=this.responseText;
                document.getElementById('table').innerHTML=this.responseText;
            }
        };
        xhttp.open('GET','/viewAssignGetData2?branch='+branch+'&semester='+sem,true);
        xhttp.send();
    }
}