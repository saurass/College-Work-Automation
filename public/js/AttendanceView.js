function showSem1()
{
    var sub=document.getElementById('sub_id').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('sem').value=this.responseText;
            document.getElementById('sem').focus();
        }
    };
    xhttp.open('GET','/viewatt?sub='+sub,true);
    xhttp.send();
}

function showClass1()
{
    var sub=document.getElementById('sub_id').value;
    var sem=document.getElementById('sem').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById('batch').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/viewattsec?sub='+sub+'&sem='+sem,true);
    xhttp.send();
}

function showFacultyAttendance()
{
    var filter=document.getElementById('filter').value;
    var sub=document.getElementById('sub_id').value;
    var sem=document.getElementById('sem').value;
    var sec=document.getElementById('batch').value;
    var fdate=document.getElementById('fdate').value;
    var todate=document.getElementById('todate').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            document.getElementById('attendance').innerHTML=this.responseText;
        }
    };
    if(filter == "")
        xhttp.open('GET','/viewfacatt?sub='+sub+'&sem='+sem+'&sec='+sec+'&fdate='+fdate+'&todate='+todate,true);
    if(filter == "less_than")
        xhttp.open('GET','/viewfacatt?sub='+sub+'&sem='+sem+'&sec='+sec+'&fdate='+fdate+'&todate='+todate+'&less='+document.getElementById('less').value,true);
    if(filter == "greater_than")
        xhttp.open('GET','/viewfacatt?sub='+sub+'&sem='+sem+'&sec='+sec+'&fdate='+fdate+'&todate='+todate+'&great='+document.getElementById('great').value,true);
    if(filter == "between")
        xhttp.open('GET','/viewfacatt?sub='+sub+'&sem='+sem+'&sec='+sec+'&fdate='+fdate+'&todate='+todate+'&min='+document.getElementById('min').value+'&max='+document.getElementById('max').value,true);

    xhttp.send();
}

function showFilter() {
    var filter=document.getElementById('filter').value;
    if(filter == "less_than")
    {
        document.getElementById('option').innerHTML='Lesser Than :<input id="less" type="text" name="less">';
    }
    if(filter=="greater_than")
    {
        document.getElementById('option').innerHTML='Greater Than :<input id="great" type="text" name="great">';
    }
    if(filter=='between')
    {
        document.getElementById('option').innerHTML='Between :<input id="min" type="text" name="min">To<input id="max" type="text" name="max">';
    }
}