function dopage(para)
{
	var paras = para.split('&');
	var num = paras[0];
	var url = paras[1];
	var type = paras[2];

	
	$.post(url,{p:num},function(data,status)
	{
		switch( type )
		{
			case 'trans_m':
				trans_m(data);break;
			default:
				break;
		}
	});
}

function trans_m(data)
{
	
	/*      表头    */
	var table_show = tableHeadGet(data)


	/*    加载数据    */
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	for( var i = 0; i < table_data.length; i++ )
	{
		table_show += "<tr>";
		for( var j = 0; j < data_index.length; j++)
		{
			if(data_index[j] != 'state')
			{
				table_show += "<td>";
				table_show += table_data[i][data_index[j]];
				table_show += "</td>";
			}
		}
		if(table_data[i]['state'] == 'not_handle')
		{
			table_show += "<td><a class='font-red'>未转账</a></td>";
			table_show += "<td><a class='abtn abtn-red' href='handle_m?date="+table_data[i]['date']+"'>点击处理</a></td>";
			table_show += "<td><a class='abtn abtn-red' href='download_m?date="+table_data[i]['date']+"'>点击下载</a></td>";
		}
		else if(table_data[i]['state'] == 'downloaded')
		{
			table_show += "<td><a class='font-orange'>待转账</a></td>";
			table_show += "<td><a class='abtn abtn-orange' href='handle_m?date="+table_data[i]['date']+"'>待处理</a></td>";
			table_show += "<td><a class='font-green'>已下载</a></td>";
		}
		else
		{
			table_show += "<td><a class='font-green'>已转账</a></td>";
			table_show += "<td><a class='font-green'>已处理</a></td>";
			table_show += "<td><a class='font-green'>已下载</a></td>";
		}
		table_show += "</tr>";
	}
	table_show += "</table>";


	/*      分页索引        */
	var page_index = pageIndexGet(data);
	$('#content').html(table_show+page_index);
}

function handle_m(date)
{
	 if( confirm("该账单是否转账完成?点击确定，完成此次操作！") )
	 {
		$.post(
			"handle_m",
			{date:date},
			function(data,status)
			{
				if(status == 'success')
				{
					window.location.href = 'trans_m';
				}
				else
				{
					alert("请求错误，请重试！")
				}
			}
		);
	 }
}

function tableHeadGet(data)
{
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	var table_show = "<table class='gridtable'>";

	/*    加载表头    */
	table_show += "<tr>";
	for( var i = 0; i < table_head.length; i++ )
	{
			table_show += "<th style='width:180px'>";
			table_show += table_head[i];
			table_show += "</th>";
	}
	table_show += "</tr>";
	
	return table_show;
}

function pageIndexGet(data)
{
	var page_index = "<div class='page text-align-r margtop47'>"+data[3]+"</div>";
	return page_index;
}
