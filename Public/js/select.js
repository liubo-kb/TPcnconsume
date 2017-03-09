function dateChange(url)
{
	var date = $('#date_select').val();
	window.location.href = url+'?date_type='+date;
}
