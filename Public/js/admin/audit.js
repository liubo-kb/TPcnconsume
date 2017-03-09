function ShowAlert() { 
	 var alertWindow =  document.getElementById("alertParent");//显示
	 alertWindow.style.visibility = "visible"; 
	 var suresh =  document.getElementById("Suresh");
	 var nosh =  document.getElementById("nosh");
	 suresh.onclick = function () 
	  { 
	 alertWindow.style.visibility = "hidden"; 
		} 
	 nosh.onclick = function () 
	  { 
	 alertWindow.style.visibility = "hidden"; 
	    } 
	} 
