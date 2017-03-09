window.onload = function(){
             var lt_num1 = document.getElementById("item_01");
			 var lt_num2 = document.getElementById("item_02");
			 var lt_num3 = document.getElementById("item_03");
			 var lt_num4 = document.getElementById("item_04");
			 var lt_num5 = document.getElementById("item_05");
			 var lt_num5 = document.getElementById("item_05");
			 var ct_num1 = document.getElementById("index_01");
			 var ct_num2 = document.getElementById("index_02");
			 var ct_num3 = document.getElementById("index_05");
			  lt_num1.onclick = function(){
				 lt_num2.style.backgroundColor="#9E9E9E"
				 lt_num5.style.backgroundColor="#9E9E9E"
				 lt_num1.style.backgroundColor="#e26666"
				 ct_num1.style.display = 'block';
				 ct_num2.style.display = 'none';
				 ct_num3.style.display = 'none';
				 }
		     lt_num2.onclick = function(){
				 lt_num2.style.backgroundColor="#e26666"
				 lt_num5.style.backgroundColor="#9E9E9E"
				 lt_num1.style.backgroundColor="#9E9E9E"
				 ct_num2.style.display = 'block';
				 ct_num3.style.display = 'none';
				 ct_num1.style.display = 'none';
				 }
		     lt_num5.onclick = function(){
				 lt_num5.style.backgroundColor="#e26666"
				 lt_num1.style.backgroundColor="#9E9E9E"
				 lt_num2.style.backgroundColor="#9E9E9E"
				 ct_num3.style.display = 'block';
				 ct_num1.style.display = 'none';
				 ct_num2.style.display = 'none';
				 }
             
         }