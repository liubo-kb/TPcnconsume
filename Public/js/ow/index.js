$(function(){
	
	var mySwiper2 = new Swiper('.swiper-container2', {
				autoplay: 5000,//可选选项，自动滑动
	})
	
	
	
	
	slidesPerView = 4
	slidesPerGroup = 4
	if(document.body.clientWidth > 1400) {
		slidesPerView = 5
		slidesPerGroup = 5
	}

	var mySwiper = new Swiper('.swiper-container', {
		loop: true,
		speed: 1000,
		onlyExternal: true,
		slidesPerView: slidesPerView,
		slidesPerGroup: slidesPerGroup,
		loopedSlides: 20,
		loopAdditionalSlides: 20,
		onSlideChangeEnd: function(swiper) {
			//alert(swiper.activeIndex);
			if(swiper.activeIndex == 40) {
				swiper.swipeTo(0, 0)
			}
		},

	});
	
	$('.arrow-left').on('click', function(e) {
		e.preventDefault()
		mySwiper.swipePrev()
	})
	$('.arrow-right').on('click', function(e) {
		e.preventDefault()
		mySwiper.swipeNext()
	})

	window.onresize = function() {
		//	alert(document.body.clientWidth );

		if(document.body.clientWidth < 1400) {
			mySwiper.params.slidesPerView = mySwiper.params.slidesPerGroup = 4;
			mySwiper.reInit();
			mySwiper.swipeTo(0, 0)
		} else if(document.body.clientWidth < 1660) {
			mySwiper.params.slidesPerView = mySwiper.params.slidesPerGroup = 5;
			mySwiper.reInit();
			mySwiper.swipeTo(0, 0)
		} else {
			mySwiper.params.slidesPerView = mySwiper.params.slidesPerGroup = 5;
			mySwiper.reInit();
			mySwiper.swipeTo(0, 0)
		}

	}
})