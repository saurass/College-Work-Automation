 function showSem()
{
    var str=document.getElementById('Department').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById("sem").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/showSem?dep="+str,true);
    xhttp.send();
}

function showCategory() {
    var dep=document.getElementById('Department').value;
    var sem=document.getElementById('sem').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if(this.readyState==4 && this.status==200)
        {
            document.getElementById('category').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showCategory?dep='+dep+'&sem='+sem,true);
    xhttp.send();
}

function showSub() {
    var dep=document.getElementById('Department').value;
    var sem=document.getElementById('sem').value;
    var category=document.getElementById('category').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('sub').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showSub?dep='+dep+'&sem='+sem+'&category='+category,true);
    xhttp.send();
}

function showFac() {
    var dep=document.getElementById('Department').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('fac_').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showFac?dep='+dep,true);
    xhttp.send();
}

function showFac2() {
    var dep=document.getElementById('Department2').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('fac_2').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showFac?dep='+dep,true);
    xhttp.send();
}

function showBatch() {
    var dep=document.getElementById('dep').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('batch').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showBatch?dep='+dep,true);
    xhttp.send();
}

 function showDepFac() {
     var dep=document.getElementById('dep').value;
     var xhttp=new XMLHttpRequest();
     xhttp.onreadystatechange=function ()
     {
         if (this.readyState==4 && this.status==200)
         {
             var data=this.responseText;
             document.getElementById('faculty').innerHTML=this.responseText;
         }
     };
     xhttp.open('GET','/showFac?dep='+dep,true);
     xhttp.send();
 }