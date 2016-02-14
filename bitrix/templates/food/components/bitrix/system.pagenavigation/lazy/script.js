$(function(){
	$(".pager-lazy a").click(function(e){
		e.preventDefault()
		var $this = $(this),
			link = $this.attr("href")
		link += link.indexOf("?")>-1?"&":"?"
		link += "ajax=Y"
		$this.closest(".page-holder").addClass("load").load(link,function(){$(".page-holder").removeClass("load")})
	})
})