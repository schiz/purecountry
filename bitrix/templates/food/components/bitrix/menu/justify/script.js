$(function(){
	var containerWidth = $("nav.justifymenu").width();
	var menuLinksTotalWidth = 0;
	var menuItems = $("nav.justifymenu > a");
	menuItems.each(function(){
		menuLinksTotalWidth += $(this).width();
	});
	var marginsCount = menuItems.size();
	var margin = Math.floor((containerWidth - menuLinksTotalWidth) / marginsCount);
	$("nav.justifymenu > a+a").css({
		marginLeft: "+=" + margin + "px"
	});
});