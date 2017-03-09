function startTime(){ 
var today=new Date(); 
var strDate=(" "+today.getFullYear()+"-"+(today.getMonth()+1)+"-"+today.getDate()+""); 
//增加时分秒 
// add a zero in front of numbers<10 
var h=today.getHours(); 
var m=today.getMinutes(); 
var s=today.getSeconds() 
m=checkTime(m); 
s=checkTime(s); 
strDate=strDate+" "+h+":"+m+":"+s; 
document.getElementById('txt').innerHTML=strDate; 
t=setTimeout('startTime()',500) 
} 

function checkTime(i){ 
if (i<10) {i="0" + i} 
return i 
}