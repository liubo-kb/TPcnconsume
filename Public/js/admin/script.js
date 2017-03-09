function showtime(tagid){
	var time = new Date();
	var Y = time.getFullYear();
	var m = time.getMonth()+1;
	if(m < 10) m = '0'+m;
	var d = time.getDate();
	if(d < 10) d = '0'+d;
	var H = time.getHours();
	if(H < 10) H = '0'+H;
	var i = time.getMinutes();
	if(i < 10) i = '0'+i;
	var s = time.getSeconds();
	if(s < 10) s = '0'+s;
	$(tagid).text(Y+'-'+m+'-'+d+' '+H+':'+i+':'+s);
}