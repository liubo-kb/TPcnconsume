function showDialog( type , account, muid)
{       
	switch( type )
	{
		case 'failReason':
			failReason(account,muid);break;
		case 'auditor':
			auditor(account,muid);break;
		case 'auditor_access':
			access(account,muid);break;
		case 'auditor_fail':
			fail(account,muid);break;
		case 'fail_result':
			fail_result(account,muid);break;
		case 'inner':
			inner(account,muid);break;
		case 'insure':
			insure(account,muid);break;
		default:
			break;
	}
}


function insure(account,muid)
{
        var dialog = new Dialog();
        dialog.Width = 500;
        dialog.Height = 1;
        dialog.Title = "预付保险认证通过，点击确定，即可上线";

        dialog.OKEvent = function()
        {
                dialog.close();
                $.post("insure", { 'account': account,'muid':muid},
                function(data)
                {
                        window.location.href = "settle";
                });
        }

        dialog.CancelEvent = function()
        {
                        dialog.close();
        }

        dialog.show();

}





function inner(account,muid)
{
	var dialog = new Dialog();
	dialog.Width = 500;
	dialog.Height = 1;
	dialog.Title = "快速认证通过，点击确定，即可上线";
   
	dialog.OKEvent = function()
	{
		dialog.close();
		$.post("inner", { 'account': account,'muid':muid},
		function(data)
		{
			window.location.href = "settle";
		});
	}

	dialog.CancelEvent = function()
	{
			dialog.close();
	}

	dialog.show();

}



function fail_result(account,muid)
{
	var dialog = new Dialog();
        dialog.Width = 500;
        dialog.Height = 300;
        dialog.Title = "查看审核未通过的原因";
        dialog.URL = "../tpl/failResult?account="+account+"&muid="+muid;

        dialog.OKEvent = function()
        {
                dialog.close();
        }

        dialog.CancelEvent = function()
        {
                dialog.close();
        }

        dialog.show();

}

function access(account,muid)
{
	var dialog = new Dialog();
        dialog.Width = 500;
        dialog.Height = 1;
        dialog.Title = "外审审核通过，点击确定，操作该商户上线";
	dialog.OKEvent = function()
	{
		dialog.close();
		$.post("auditAccess", { 'account': account,'muid':muid},
                function(data)
                {
                        window.location.href = "audited";
                });

	}

	dialog.CancelEvent = function()
	{
		dialog.close();
	}

	dialog.show();

}

function fail(account,muid)
{
	var dialog = new Dialog();
        dialog.Width = 500;
        dialog.Height = 300;
        dialog.Title = "查看外审不通过原因，点击确定，确认该商户审核不通过";
	dialog.URL = "../tpl/auditorFail?account="+account+"&muid="+muid;


	
        dialog.OKEvent = function()
        {
                dialog.close();
                $.post("auditFail", { 'account': account,'muid':muid},
                function(data)
                {
                        window.location.href = "audited";
                });

        }

        dialog.CancelEvent = function()
        {
                dialog.close();
        }

        dialog.show();

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
		var reason = "quick";
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
			window.location.href = "audited";
   		});  

	};

	dialog.CancelEvent = function()
	{
		var r=dialog.innerFrame.contentWindow.document.getElementsByName('checkbox');
		dialog.close();
		var reason = "insure";
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
			window.location.href = "audited";
   		});  
	};
	
	dialog.show();
	
	dialog.ShowButtonRow = true;
	dialog.okButton.value = "快速认证";
	dialog.cancelButton.value = "预付认证";

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
		var r=dialog.innerFrame.contentWindow.document.getElementsByName('radio');
		dialog.close();
		var selected = "";
		for(var i=0;i<r.length;i++)
                {
                        if(r[i].checked)
                        {
                                selected = r[i].value;
				break;
                        }
                }

		$.post("setAuditor", { 'account': account,'selected': selected,'muid':muid},
                function(data)
                {
                        window.location.href = "auditing";
                });


        };

        dialog.CancelEvent = function()
        {
                dialog.close();
        };


        dialog.show();
}
