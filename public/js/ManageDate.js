var allField=document.getElementsByTagName('input');
var date =array() ;var d=0;
for(var i=0;i<allField.length;i++)
{
    if(allField.type=='date')
    {
        date[d]=allField[i];
        d++;
    }
}
alert(allField[0].id+allField[1]);