$(function(){
	var $logo = $('#transforming-logo'),
		topOffset = $logo.offset().top,
		t0 = 162,
		t1 = 242,
		t2 = 336,
		t3 = 444,
		t4 = 707
	function LogoView(){
		var scrollTop = $(window).scrollTop() - topOffset
		if(scrollTop<t0){
			$logo.attr('class', '')
		}else if(scrollTop>=t0&&scrollTop<t1){
			$logo.attr('class', 't0')
		}else if(scrollTop>=t1&&scrollTop<t2){
			$logo.attr('class', 't1')
		}else if(scrollTop>=t2&&scrollTop<t3){
			$logo.attr('class', 't2')
		}else if(scrollTop>=t3&&scrollTop<t4){
			$logo.attr('class', 't3')
		}else if(scrollTop>=t4){
			$logo.attr('class', 't4')
		}
	}
	$(window).scroll(LogoView)
	LogoView()
})