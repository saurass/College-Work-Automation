function remover()
{
    document.getElementById('st_info').innerHTML='';
    var mock=document.getElementById('st_info');
}
function getinfo()
{
    var debarred=document.getElementById('debarred').value;
    var st_id=document.getElementById('st_id').value;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('st_info').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/getinfo?debarred='+debarred+'&st_id='+st_id,true);
    xhttp.send();
    return false;
}

function getExam()
{
    var subject=document.getElementById('subject').value;
    var section=document.getElementById('section').innerText;

    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('exam').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/AddDebarGetExam?sub='+subject+'&sec='+section,true);
    xhttp.send();
    return false;
}