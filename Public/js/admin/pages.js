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
			case 'settle':
				settle(data);break;
			case 'auditing':
				auditing(data);break;
			case 'audited':
				audited(data);break;
			case 'auditor':
                                auditor(data);break;
			default:
				break;
		}
	});
}

function auditor(data)
{
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	var table_show = "<table class='table margt20'>";

	/*    加载表头    */
	table_show += "<tr class='tb-tit'>";

	table_show += "<td style='width:10%'>序号";
        table_show += "</td>";

	for( var i = 0; i < table_head.length; i++ )
	{
		
		table_show += "<td>";
		table_show += table_head[i];
		table_show += "</td>";
	}
	table_show += "</tr>";


	/*    加载数据    */
	for( var i = 0; i < table_data.length; i++ )
	{
		
		table_show += "<tr>";
		table_show += "<td>";
		var index = i+1;
                table_show += index+".";
                table_show += "</td>";
		for( var j = 0; j < data_index.length; j++)
		{	
			if( data_index[j] != "muid" )
			{
				table_show += "<td>";
				table_show += table_data[i][data_index[j]];
				table_show += "</td>";
			}
		}

		table_show += "<td>";
                table_show += "<a class='abtn abtn-fc' href='removeAuditor?muid="+table_data[i][data_index[0]]+"'>删除</a>";
                table_show += "</td>";
		
		
		table_show += "</tr>";
	}
	table_show += "</table>";

	/*    加载分页    */
	var page_index = "<div class='pagebar'><div class='pagewrap'>"+data[3]+"</div></div>";
	$('#content').html(table_show+page_index);
}

function settle(data)
{
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	var table_show = "<table class='table margt20'>";

	/*    加载表头    */
	table_show += "<tr class='tb-tit'>";

	table_show += "<td style='width:10%'>序号";
        table_show += "</td>";

	for( var i = 0; i < table_head.length; i++ )
	{
		
		table_show += "<td>";
		table_show += table_head[i];
		table_show += "</td>";
	}
	table_show += "</tr>";


	/*    加载数据    */
	for( var i = 0; i < table_data.length; i++ )
	{
		
		table_show += "<tr>";
		table_show += "<td>";
		var index = i+1;
                table_show += index+".";
                table_show += "</td>";
		for( var j = 0; j < data_index.length; j++)
		{	
			if( data_index[j] != "muid" )
			{
				table_show += "<td>";
				table_show += table_data[i][data_index[j]];
				table_show += "</td>";
			}
		}

		table_show += "<td>";
                table_show += "<a class='abtn abtn-fc' href='handleAudit?muid="+table_data[i][data_index[0]]+"'>开始审核</a>";
                table_show += "</td>";
		
		
		table_show += "</tr>";
	}
	table_show += "</table>";

	/*    加载分页    */
	var page_index = "<div class='pagebar'><div class='pagewrap'>"+data[3]+"</div></div>";
	$('#content').html(table_show+page_index);
}

function auditing(data)
{
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	var table_show = "<table class='table margt20'>";

	/*    加载表头    */
	table_show += "<tr class='tb-tit'>";

	table_show += "<td style='width:10%'>序号";
        table_show += "</td>";

	for( var i = 0; i < table_head.length; i++ )
	{
		
		table_show += "<td>";
		table_show += table_head[i];
		table_show += "</td>";
	}
	table_show += "</tr>";


	/*    加载数据    */
	for( var i = 0; i < table_data.length; i++ )
	{
		
		table_show += "<tr>";
		table_show += "<td>";
		var index = i+1;
                table_show += index+".";
                table_show += "</td>";
		for( var j = 0; j < data_index.length; j++)
		{
			table_show += "<td>";
			table_show += table_data[i][data_index[j]];
			table_show += "</td>";
		}

		table_show += "<td>";
                table_show += "<a class='abtn abtn-fc' >外审中</a>";
                table_show += "</td>";
		
		
		table_show += "</tr>";
	}
	table_show += "</table>";

	/*    加载分页    */
	var page_index = "<div class='pagebar'><div class='pagewrap'>"+data[3]+"</div></div>";
	$('#content').html(table_show+page_index);
}

function audited(data)
{
	data = eval(data);
	var table_head = data[0];
	console.log('数据：',data[0]);  
	var table_data = data[1];
	var data_index = data[2];
	var table_show = "<table class='table margt20'>";

	/*    加载表头    */
	table_show += "<tr class='tb-tit'>";

	table_show += "<td style='width:10%'>序号";
        table_show += "</td>";

	for( var i = 0; i < table_head.length; i++ )
	{
		
		table_show += "<td>";
		table_show += table_head[i];
		table_show += "</td>";
	}
	table_show += "</tr>";


	/*    加载数据    */
	for( var i = 0; i < table_data.length; i++ )
	{
		
		table_show += "<tr>";
		table_show += "<td>";
		var index = i+1;
		table_show += index+".";
		table_show += "</td>";
		for( var j = 0; j < data_index.length; j++)
		{
			if(data_index[j] != 'muid' && data_index[j] != 'astate' )
			{
				table_show += "<td>";
				table_show += table_data[i][data_index[j]];
				table_show += "</td>";
			}
		}

		table_show += "<td>";
		switch(table_data[i]['astate'])
		{
			case "true":
			{
				table_show += "<a class='abtn abtn-green' >预付认证通过</a>";
				break;
			}
			case "complete_not_auth":
			{
				table_show += "<a class='abtn abtn-orange' >快速认证通过</a>";
				break;
			}
			case "false":
			{
				table_show += "<a class='abtn abtn-red' >审核未通过</a>";
				break;
			}
			default:
			{
				table_show += "<a class='abtn abtn-red' >error</a>";
				break;
			}
		}
		table_show += "</td>";
		
		table_show += "<td>";
		table_show += "<a class='abtn abtn-green' >上传店铺资料</a>";
		table_show += "</td>";
		
		
		table_show += "</tr>";
	}
	table_show += "</table>";

	/*    加载分页    */
	var page_index = "<div class='pagebar'><div class='pagewrap'>"+data[3]+"</div></div>";
	$('#content').html(table_show+page_index);
}
