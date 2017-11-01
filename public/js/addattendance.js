


function disable()
{
//alert("cdsvcd");
	//document.getElementById("multiple").disabled=true;
	document.getElementById("todate").value = document.getElementById('fromdate').value = "";
		document.getElementById("to").style.visibility="hidden";
			document.getElementById("todate").style.visibility="hidden";
    
}
function enable()
{
//alert("cdsvcd");
	document.getElementById("to").style.visibility="visible";
		document.getElementById("todate").style.visibility="visible";
		 document.getElementById("todate").value = document.getElementById('fromdate').value = "";
    
}


function validate()
	{
			//alert("nnn");

			var xmlhttp;
			if(window.XMLHttpRequest)
			{
			//code for IE7,firefox,chrome,opera,safari	
			
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
			
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		var subid=document.getElementById("subjectid").value;
		var sem=document.getElementById("semester").value;
		var sec=document.getElementById("section").value;
		if(document.getElementById("single").checked)
		{
			var fdate=document.getElementById("fromdate").value;
			xmlhttp.open("GET","validate/"+subid+" /"+sec+" /"+sem+" /"+fdate+"/02/single",true);			
		}
		else
		{
		var fdate=document.getElementById("fromdate").value;
		var tdate=document.getElementById("todate").value;
		xmlhttp.open("GET","validate/"+subid+"/"+sec+"/"+sem+"/"+fdate+"/"+tdate+"/multiple",true);			
		}


			xmlhttp.send();
			
			xmlhttp.onreadystatechange=function()
			{ //alert("nnnn");
				if(xmlhttp.readyState==4&&xmlhttp.status==200)
				{
		
					document.getElementById("validornot").value=xmlhttp.responseText;
				
				}
			}


	}
	



	function showsubject()
	{
			
		//alert("dsfds");
		var xmlhttp;
			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}


		xmlhttp.open("GET","/searchsubject",true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
				//alert("nnn");
				document.getElementById("subjectid").innerHTML=xmlhttp.responseText;
			}
		}
		//alert("dsfds");
	}
function showname(str)
	{
	
		// if(str.length==0)
		// {
		// 	document.getElementById("txtHint").innerHTML="";
		// 	return;
		// }
		var xmlhttp;
			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","searchsubjectname/"+str,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
				
			
				document.getElementById("subjectname").value=xmlhttp.responseText;
			}
		}
	}


	function showsem(str)
	{
	
		// if(str.length==0)
		// {
		// 	document.getElementById("txtHint").innerHTML="";
		// 	return;
		// }
		var xmlhttp;
			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","searchsubjectsem/"+str,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("semester").value=xmlhttp.responseText;
			}
		}
	}


function showsection(str)
	{
		
		// if(str.length==0)
		// {
		// 	document.getElementById("txtHint").innerHTML="";
		// 	return;
		// }
		var xmlhttp;
			
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","searchsubjectsec/"+str,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("section").innerHTML=xmlhttp.responseText;
			}
		}
	}
function disappear()
	{
	document.getElementById("noc").value="";
	}

function VinChecknum(e) 
	{		//alert("calling");
        var keynum = e.keyCode;
		if(e.which)
  		keynum=e.which;
        var keychar = String.fromCharCode(keynum);
        var charcheck = /[0-9]/;
        var res = charcheck.test(keychar);
        return res;
	}


function fvalid()
{
	//alert(year);
    subjectid=document.getElementById("subjectid").value;
    //alert(sub_id);
    subjectname=document.getElementById("subjectname").value;
    //alert(subjectname);
    semester=document.getElementById("semester").value;
    //alert("hello");
    section=document.getElementById("section").value;
    //alert("hi");
   fromdate=document.getElementById("fromdate").value;
   //alert("nishu");
  todate=document.getElementById("todate").value;
  //alert("nishank");
    noc=document.getElementById("noc").value;
  // alert(noc);
    //alert("dfgh");
    // multi=document.getElementById("multi").value;
  //   alert(multi);
    
	if(subjectid=="")
	{
		alert("Subjectid not given");
				return false;
	}
	else if(subjectname=="")
	{
		alert("Subjectname not given");
		return false;
	}
	else if(semester=="" || semester>8 || semester <1)
	{
		alert("Check Semester value");
		semester.focus();
		return false;
	}

	else if(section=="")
	{
		alert("section not given");
		return false;
	}
	else if(fromdate=="")
	{
		alert("fromdate not given");
		return false;
	}
	else if(multi.checked)
	{
//	alert("multi checked");
		 if(todate=="")
		{
			alert("todate not given");
			return false;
		}
		 if(fromdate>todate)
		{	
		alert("fromdate is greater than to date");
		return false;
		}
	}
	validate();

	 if(document.getElementById("noc").value=="")
	{
		alert("please enter total number of classes....");
	}
	else if(document.getElementById("validornot").value=="false")
	{
		alert("Date not valid.....")
	}	
	else if(document.getElementById("validornot").value=="true")
	{
	showattend();

	}

	
//alert("here");		
}

	function showattend()
	{
			sem=document.getElementById("semester").value;
		sec=document.getElementById("section").value;
		no=document.getElementById("noc").value;
		mb=document.getElementById("massbunks").value;
		var fdate="";
		var tdate="";
		if(document.getElementById("single").checked)
			{
		fdate=document.getElementById("fromdate").value;
		tdate=fdate;
	
			}
			else
			{
			fdate=document.getElementById("fromdate").value;
			tdate=document.getElementById("todate").value;
	
			}
		var subid=document.getElementById("subjectid").value;


		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","showstudentattend/"+sec+"/"+sem+" /"+no+" /"+mb+" /"+subid+" /"+fdate+" /"+tdate,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			}
		}
	}



function studentcount()
	{
	
		sem=document.getElementById("semester").value;
		sec=document.getElementById("section").value;
		no=document.getElementById("noc").value;
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","getstudentcount/"+sec+"/"+sem,true)
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				document.getElementById("studentcount").value=xmlhttp.responseText;
			}
		}
	}
showsubject();


function showSec() {
	var dep=document.getElementById('Department').value;
    var sem=document.getElementById('sem').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('batch').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showSec?sem='+sem+'&dep='+dep,true);
    xhttp.send();
}

function showSub1() {
    var dep=document.getElementById('Department').value;
    var sem=document.getElementById('sem').value;
    var section=document.getElementById('batch').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('sub_id').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/showSub1?dep='+dep+'&sem='+sem+'&section='+section,true);
    xhttp.send();
}

function showDate_Data()
{
    var dep=document.getElementById('Department').value;
    var sem=document.getElementById('sem').value;
    var section=document.getElementById('batch').value;
    var subject=document.getElementById('sub_id').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('date_data').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/attendance/update?branch='+dep+'&semester='+sem+'&section='+section+'&sub_id='+subject,true);
    xhttp.send();
    return false;
}

function showDate_Data()
{
    var dep=document.getElementById('Department').value;
    var sem=document.getElementById('sem').value;
    var section=document.getElementById('batch').value;
    var subject=document.getElementById('sub_id').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('date_data').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/attendance/update?branch='+dep+'&semester='+sem+'&section='+section+'&sub_id='+subject,true);
    xhttp.send();
    return false;
}

function showBatchList(id)
{
    var fromdate=document.getElementById('fromdate'+id).value;
    var todate=document.getElementById('todate'+id).value;
    var sem=document.getElementById('sem').value;
    var section=document.getElementById('batch').value;
    var subject=document.getElementById('sub_id').value;
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function ()
    {
        if (this.readyState==4 && this.status==200)
        {
            var data=this.responseText;
            document.getElementById('date_data').innerHTML=this.responseText;
        }
    };
    xhttp.open('GET','/attendance/updateattendance?fromdate='+fromdate+'&todate='+todate+'&section='+section+'&sub_id='+subject+'&semester='+sem,true);
    xhttp.send();
    return false;
}

function submitForm()
{
    var count =document.getElementById("count").value;
    for(var i=1;i<=count;i++)
    {
        var tc=document.getElementById("totalclasses"+i).value;
        var ac=document.getElementById("attended"+i).value;
        if(tc=='')
        {
            document.getElementById("totalclasses"+i).focus();

            alert("Entry can not be blank");
            return false;
        }
        else if(ac=='')
        {
            document.getElementById("attended"+i).focus();
            alert("Entry can not be blank");
            return false;
        }


        else if(parseInt(tc)<parseInt(ac))
        {
            document.getElementById("totalclasses"+i).focus();

            alert("Total classes can not be less than Attended classes");
            return false;
            break;
        }
    }
    return true;
}