$(document).ready(function (){
	
	/* function onloadImage(src)
	{	
	var bufferImage = new Image();
	bufferImage.src = src;
	document.getElementById("img").src = bufferImage.src;
	window.setTimeout(onloadImage(src),100);
	}

	onloadImage('2.png');
	onloadImage('3.png');
	onloadImage('4.png');
	onloadImage('5.png'); */

	var $wrap = $(".wrapper"),
	pages = $(".page").length,
	scrolling = false,
	currentPage = 1,
	$navPanel = $(".nav-panel"),
	$scrollBtn = $(".scroll-btn"),
	$navBtn = $(".nav-btn");

	/*****************************
	***** NAVIGATE FUNCTIONS *****
	*****************************/
	function manageClasses() {
		$wrap.removeClass(function (index, css) {
			return (css.match(/(^|\s)active-page\S+/g) || []).join(' ');
		});
		$wrap.addClass("active-page" + currentPage);
		$navBtn.removeClass("active");
		$(".nav-btn.nav-page" + currentPage).addClass("active");
		$navPanel.addClass("invisible");
		scrolling = true;
		setTimeout(function () {
			$navPanel.removeClass("invisible");
			scrolling = false;
		}, 1000);
	}
	
	
	function navigateUp() {
		if (currentPage > 1) {
			currentPage--;
			if (Modernizr.csstransforms) {
				manageClasses();
			} else {
				$wrap.animate({ "top": "-" + ((currentPage - 1) * 100) + "%" }, 200);
			}
		}
	}

	function navigateDown() {
		if (currentPage < pages) {
			currentPage++;
			if (Modernizr.csstransforms) {
				manageClasses();
			} else {
				$wrap.animate({ "top": "-" + ((currentPage - 1) * 100) + "%" }, 200);
			}
		}
	}

	/*********************
	***** MOUSEWHEEL *****
	*********************/
	$(document).on("mousewheel DOMMouseScroll", function (e) {
		if (!scrolling) {
			if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
				navigateUp();
			} else {
				navigateDown();
			}
		}
	});

	 /*********************
	***** TOUCHEVENT *****
	*********************/


	var startX = 0, startY = 0;

	document.getElementById('scroll_div').addEventListener('touchstart', touchSatrtFunc, false);
	document.getElementById('scroll_div').addEventListener('touchmove', touchMoveFunc, false);
	document.getElementById('scroll_div').addEventListener('touchend', touchEndFunc, false);  
	document.getElementById('btn').addEventListener('click',startNewPage,false);

	function touchSatrtFunc(evt) {
		try
		{
			evt.preventDefault(); //����?1�䣤?t����?������?�¦�???��??��1??����?1??���̨�

			var touch = evt.touches[0]; //??��?�̨���???�䣤��?
			var x = Number(touch.pageX); //��3??�䣤��?X��?����
			var y = Number(touch.pageY); //��3??�䣤��?Y��?����
			startX = x;
			startY = y;

			var text = 'TouchStart��o�ꡧ' + x + ', ' + y + '��?';
		}
		catch (e) {
			alert('touchSatrtFunc��o' + e.message);
		}
	}

	//touchmove��??t��??a??��??t?T����??��?��?����
	function touchMoveFunc(evt) {
		try
		{
			//evt.preventDefault(); //����?1�䣤?t����?������?�¦�???��??��1??����?1??���̨�
			var touch = evt.touches[0]; //??��?�̨���???�䣤��?
			var x = Number(touch.pageX); //��3??�䣤��?X��?����
			var y = Number(touch.pageY); //��3??�䣤��?Y��?����

			var text = 'TouchMove:'+x+','+y;
		
			//?D?????����??��
			if (y - startY < 0) {
				//text += 'U-D';
				$('#topNav').hide();					
				navigateDown();
			}
			
			else {
				//text += 'D-U';
				if ( currentPage == 2){
					$('#topNav').show();
				}       
				else {
					$('#topNav').hide();
				}
				navigateUp();
			}
			document.getElementById('scroll_div').removeEventListener('touchmove', touchMoveFunc, false);
		}
		catch (e) {
			alert('touchMoveFunc��o' + e.message);
		}
	}

	function touchEndFunc(evt) {  
		try {  
			//evt.preventDefault(); //����?1�䣤?t����?������?�¦�???��??��1??����?1??���̨�  

			var text = 'TouchEnd��??t�䣤����';  
			document.getElementById('scroll_div').addEventListener('touchmove', touchMoveFunc, false);
		}  
		catch (e) {  
			alert('touchEndFunc��o' + e.message);  
		}  
	}  




	/**************************
	***** RIGHT NAVIGATION ****
	**************************/

	/* NAV UP/DOWN BTN PAGE NAVIGATION */
	$(document).on("click", ".scroll-btn", function () {
		if ($(this).hasClass("up")) {
			navigateUp();
		} else {
			navigateDown();
		}
	});

	/* NAV CIRCLE DIRECT PAGE BTN */
	$(document).on("click", ".nav-btn", function () {
		if (!scrolling) {
			var target = $(this).attr("data-target");
			if (Modernizr.csstransforms) {
				$wrap.removeClass(function (index, css) {
					return (css.match(/(^|\s)active-page\S+/g) || []).join(' ');
				});
				$wrap.addClass("active-page" + target);
				$navBtn.removeClass("active");
				$(this).addClass("active");
				$navPanel.addClass("invisible");
				currentPage = target;
				scrolling = true;
				setTimeout(function () {
					$navPanel.removeClass("invisible");
					scrolling = false;
				}, 1000);
			} else {
				$wrap.animate({ "top": "-" + ((target - 1) * 100) + "%" }, 1000);
			}
		}
	});

}); //@ sourceURL=pen.js
