function ShowAlertws() { 
	 var alertWindow =  document.getElementById("alertParent_ws");//显示
	 alertWindow.style.visibility = "visible"; 
	 var surews =  document.getElementById("Surews");
	 var nows =  document.getElementById("nows");
	 surews.onclick = function () 
	  { 
	 alertWindow.style.visibility = "hidden"; 
		} 
	 nows.onclick = function () 
	  { 
	 alertWindow.style.visibility = "hidden"; 
	    } 
	} 

