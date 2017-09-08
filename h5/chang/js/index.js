window.onload = function(){
	var mySwiper =  new Swiper(".swiper-container");
	function refresh(obj , images ,texts ,foots){
		var myScroll = new IScroll(obj,{
			 mouseWheel:true,
			 probeType:3,  //每滚动1px就触发一次   ； 2：一定的时间间隔内触发  ；1：滚动不频繁时触发
			 });
			
			myScroll.scrollBy(0,-50);
			
			myScroll.on('scroll',function(){
//				console.log(this.maxScrollY);
				var maxY =  this.y - this.maxScrollY ;
				console.log(maxY)
				if(this.y>=0){
					$('.head img').addClass('up')
					$('.head span').html('释放刷新...')
				}
				if(maxY<=0){
					images.addClass('down')
				}
			})
			
			myScroll.on('scrollEnd',function(){
				
				if(this.y>-50&&this.y<0){
					myScroll.scrollTo(0,-50)
				}else if(this.y>=0){
					$('.head img').attr('src','img/ajax-loader.gif')
					$('.head span').html('正在玩儿命加载...')
					//to ajax
					setTimeout(function(){
						myScroll.scrollTo(0,-50)
						$('.head img').attr('src' , 'img/arrow.png')
						$('.head img').removeClass('up')
					},1000)
				}
				
				var self = this
				var maxY =  self.y - self.maxScrollY;
				console.log(maxY)
				if(maxY>0&&maxY<50){
					myScroll.scrollTo(0,self.maxScrollY+50)
				}else if(maxY<=0){
					images.attr('src','img/ajax-loader.gif')
					texts.html('正在玩儿命加载...')
					//todo ajax
					setTimeout(function(){
						foots.before('<div class="ietm">add1</div> <div class="ietm">add2</div> <div class="ietm">add3</div> <div class="ietm">add4</div> <div class="ietm">add5</div>')
						images.attr('src' , 'img/arrow.png')
						images.removeClass('down')
						myScroll.scrollTo(0,self.maxScrollY - 100)
						myScroll.refresh();
					},2000)
				}
				
			})
		}
	
	refresh('#wrapper1' , $('.foot img') , $('.foot span') ,$('.foot'))
	refresh('#wrapper2', $('.foot1 img') , $('.foot1 span') ,$('.foot1'))
}
