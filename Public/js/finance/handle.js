function goback()
{
	window.location.href = 'trans_m';
}


function handle_m(date)
{
	 if( confirm("该账单是否转账完成?点击确定，完成此次操作！") )
	 {
		$.post(
			"handle_md",
			{date:date},
			function(data,status)
			{
				if(status == 'success' && data == '1')
				{
					window.location.href = 'trans_m';
				}
				else
				{
					alert(data);
				}
			}
		);
	 }
}