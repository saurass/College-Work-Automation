function getNewId()
{
    var branch=document.getElementById('branch').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('userid').value=this.responseText;
        }
    };
    xhttp.open('GET','/getNewId?branch='+branch,true);
    xhttp.send();
}