function showDialog( type , account, muid)
{       
	switch( type )
	{
		case 'failReason':
			failReason(account,muid);break;
		case 'auditor':
			auditor(account,muid);break;
		default:
			break;
	}
}

function failReason(account,muid)
{
	var dialog = new Dialog();
        dialog.Width = 650;
        dialog.Height = 300;
        dialog.Title = "勾选未通过的原因";
        dialog.URL = "../tpl/failReason?account="+account+"&muid="+muid;
	
	dialog.OKEvent = function()
	{	
		var r=dialog.innerFrame.contentWindow.document.getElementsByName('checkbox');
		dialog.close();
		var reason = "reason";
    		for(var i=0;i<r.length;i++)
		{
         		if(r[i].checked)
			{
         			reason = reason +',' + r[i].value;
       			}
    		}

		
		$.post("failReason", { 'account': account,'reason': reason,'muid':muid},
		function(data)
		{
			Dialog.alert(data);
   		});  

	};

	dialog.CancelEvent = function()
	{
		dialog.close();
	};

        dialog.show();
}

function auditor(account,muid)
{
        var dialog = new Dialog();
        dialog.Width = 650;
        dialog.Height = 400;
        dialog.Title = "选择外派人员";
        dialog.URL = "../tpl/auditor?account="+account+"&muid="+muid;

	dialog.OKEvent = function()
     	{
		dialog.close();
        };

        dialog.CancelEvent = function()
        {
                dialog.close();
        };


        dialog.show();
}
