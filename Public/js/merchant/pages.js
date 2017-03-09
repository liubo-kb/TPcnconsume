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
			case 'glysz':
				glysz(data);break;
			case 'hyzgl':
				hyzgl(data);break;
			case 'vip':
                		vip(data);break;
			case 'commodity':
                		commodity(data);break;
			case 'data_bk':
                		data_show(data,'bk');break;
			case 'data_xk':
                		data_show(data,'xk');break;
			case 'data_sj':
                		data_show(data,'sj');break;
			case 'data_xf':
                		data_show(data,'xf');break;
			case 'data_xj':
                		data_xj(data);break;
			case 'dpgl':
                		dpgl(data);break;
			case 'txmx':
                		txmx(data);break;
			default:
				break;
		}
	});
}

function txmx(data)
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
				
			table_show += "<td>";
			table_show += table_data[i][data_index[j]];
			table_show += "</td>";	
		}
		table_show += "</tr>";
	}
	table_show += "</table>";


	/*      分页索引        */
	var page_index = pageIndexGet(data);
	$('#content').html(table_show+page_index);
}

function dpgl(data)
{
	var table_data = data[0];
	
	var table_show = "";
	for( var i = 0; i < table_data.length; i++ )
	{
		table_show += "<table class='tb-blend'>";
		table_show += "<tr>";
		table_show += "<td rowspan='2' class='td-pic'>";
		table_show += "<img src='/cnconsum/Public/Uploads/addImage/"+ table_data[i]['image_url'] +"' width='60' height='60' /><br>"+table_data[i]['name'];
		table_show += "</td>";
		table_show += "<td colspan='3' align='left' valign='bottom'>";
		table_show += "<span class='ftdt'>店铺名称："+ table_data[i]['store']  +"</span>";
		table_show += "</td>";
		table_show += "</tr>";
		table_show += "<tr>";
		table_show += "<td align='left'>密码："+ table_data[i]['passwd'] +"<br>电话："+ table_data[i]['phone'] +"</td>";
		table_show += "<td align='left'>营业总额："+ table_data[i]['sum'] +"<br>店铺余额："+ table_data[i]['remain'] +"</td>";
		table_show += "<td align='left'>会员数量："+ table_data[i]['vip_num'] +"<br>地址："+ table_data[i]['address'] +"</td>";
		table_show += "</tr>";
		table_show += "</table>";
	}
	
	var page_index = "<div class='page text-align-r margtop47'>"+data[1]+"</div>";
	$('#content').html(table_show+page_index);
}

function data_xj(data)
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
				
			table_show += "<td>";
			table_show += table_data[i][data_index[j]];
			table_show += "</td>";	
		}
		table_show += "</tr>";
	}
	table_show += "</table>";


	/*      分页索引        */
	var page_index = pageIndexGet(data);
	$('#content').html(table_show+page_index);
}

function data_show(data,table)
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
				if( data_index[j] == 'headimage')
				{
					table_show += "<td>";
					table_show+= "<img width='55' height='55' src='/cnconsum/Public/Uploads/headImage/"+table_data[i][data_index[j]]+"'/>";
					table_show += "</td>";
				}
				
				else if(data_index[j] != 'user')
				{
					table_show += "<td>";
					table_show += table_data[i][data_index[j]];
					table_show += "</td>";
				}
				
		}

		table_show += "<td>";
		var user = table_data[i]['user'];
		var merchant = table_data[i]['merchant'];
		var datetime = table_data[i]['datetime'];
		
		table_show += "<a class='abtn' href='data_detail?table="+table+"&user="+user+"&merchant="+merchant+"&datetime="+datetime+"'>详细信息</a>";
		table_show += "</td>";

		table_show += "</tr>";
	}
	table_show += "</table>";


	/*      分页索引        */
	var page_index = pageIndexGet(data);
	$('#content').html(table_show+page_index);
}

function commodity(data)
{
	/*      表头    */
	var table_show = tableHeadGet(data);


	/*    加载数据    */
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	for( var i = 0; i < table_data.length; i++ )
	{
		table_show += "<tr>";
		for( var j = 0; j < data_index.length; j++)
		{
				table_show += "<td>";
				table_show += table_data[i][data_index[j]];
				table_show += "</td>";
		}

		table_show += "<td>";
		table_show += "<a class='abt' href='modView?code="+ table_data[i]['number'] +"'>编辑</a>";
		table_show += "</td>";

		table_show += "<td>";
		table_show += "<a class='abt' href= javascript:delCommodity('确定要删除这条信息吗？'," + table_data[i]['number'] + ")>删除</a>";
		table_show += "</td>";

		table_show += "</tr>";
	}
	table_show += "</table>";


	/*      分页索引        */
	var page_index = pageIndexGet(data);
	$('#content').html(table_show+page_index);

}
function vip(data)
{
	/*	表头	*/
	var table_head = data[0];
        var table_data = data[1];
        var data_index = data[2];
        var table_show = "<table class='cable'>";

        /*    加载表头    */
        table_show += "<tr>";
        for( var i = 0; i < table_head.length; i++ )
        {
                table_show += "<th>";
                table_show += table_head[i];
                table_show += "</th>";
        }
        table_show += "</tr>";
	
  	/*    加载数据    */
	

        for( var i = 0; i < table_data.length; i++ )
        {
                table_show += "<tr>";
                for( var j = 0; j < data_index.length; j++)
                {
                        table_show += "<td>";
                        if( data_index[j] == 'headimage')
                        {
                                table_show+= "<img width='55' height='55' style='margin:8px' src='/cnconsum/Public/Uploads/headImage/"+table_data[i][data_index[j]]+"'/>";
                        }
                        else
                        {
                                table_show += table_data[i][data_index[j]];
                        }
                        table_show += "</td>";
                }

                table_show += "<td>";
                table_show += "<a class='abt'>联系用户</a>";
                table_show += "</td>";

                table_show += "</tr>";
        }
        table_show += "</table>";
 	
	/*	分页索引	*/
	var page_index = pageIndexGet(data);
	
	$('#content').html(table_show+page_index);
}

function glysz(data)
{
	var table_head = data[0];
	var table_data = data[1];
	var data_index = data[2];
	var table_show = "<table class='ctable' width = '90%'>";

	/*    加载表头    */
	table_show += "<tr>";
	for( var i = 0; i < table_head.length; i++ )
	{
		table_show += "<th>";
		table_show += table_head[i];
		table_show += "</th>";
	}
	table_show += "</tr>";

	/*    加载数据    */
	for( var i = 0; i < table_data.length; i++ )
	{
		table_show += "<tr>";
		for( var j = 0; j < data_index.length; j++)
		{
			table_show += "<td>";
			table_show += table_data[i][data_index[j]];
			table_show += "</td>";
		}

		table_show += "<td>";
                table_show += "<a class='abtn' href='adminMod?account="+ table_data[i]['account'] +"'>修改</a>";
                table_show += "</td>";
		
		table_show += "<td>";
                table_show += "<a class='abtn' href= javascript:del('确定要删除这条信息吗？'," + table_data[i]['account'] + ") >删除</a>";
                table_show += "</td>";

		
		table_show += "</tr>";
	}
	table_show += "</table>";

	/*    加载分页    */
	var page_index = "<div class='page text-align-r margtop47'>"+data[3]+"</div>";
	$('#content').html(table_show+page_index);
}

function hyzgl(data)
{
        var table_head = data[0];
        var table_data = data[1];
        var data_index = data[2];
        var table_show = "<table class='ctable'>";

        /*    加载表头    */
        table_show += "<tr>";
        for( var i = 0; i < table_head.length; i++ )
        {
                table_show += "<th>";
                table_show += table_head[i];
                table_show += "</th>";
        }
        table_show += "</tr>";

        /*    加载数据    */
        for( var i = 0; i < table_data.length; i++ )
        {
                table_show += "<tr>";
                for( var j = 0; j < data_index.length; j++)
                {
                        table_show += "<td>";
                        table_show += table_data[i][data_index[j]];
                        table_show += "</td>";
                }

                table_show += "<td>";
                table_show += "<a class='abtn' href='turnURL?url=../card/showView'>查看</a>";
                table_show += "</td>";
                table_show += "</tr>";
        }
        table_show += "</table>";

        /*    加载分页    */
        var page_index = "<div class='page text-align-r margtop47'>"+data[3]+"</div>";
        $('#content').html(table_show+page_index);
}

function tableHeadGet(data)
{
	var table_head = data[0];
        var table_data = data[1];
        var data_index = data[2];
        var table_show = "<table class='ctable'>";

        /*    加载表头    */
        table_show += "<tr>";
        for( var i = 0; i < table_head.length; i++ )
        {
                table_show += "<th>";
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
