function showBranch()
{  
    var sem=document.getElementById('sem').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById('branch').innerHTML=this.responseText;
            document.getElementById('section').focus;
        }
    };
    xhttp.open("GET","/addstud/"+sem,true);
    xhttp.send();
}

function showsection()
{   
    var sem=document.getElementById('sem').value;
      var branch=document.getElementById('branch').value;

      
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200)
        {
            var datas=this.responseText;
            document.getElementById('section').innerHTML=this.responseText;
        }
    };
    xhttp.open("GET","/addstud/"+sem+"/"+branch,true);
    xhttp.send();
            

             }
