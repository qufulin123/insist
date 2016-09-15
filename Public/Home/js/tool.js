if (typeof $ != "undefined"){
;$(function(){


// nav
(function(){
	var $slideNav = $("#slideNav"),
		$currentNav = $slideNav.find(".current_nav a"),
		$slideNavLine = $("#slideNavLine"),
		$el, leftPos, newWidth;
	if($slideNavLine.length > 0){
		$slideNavLine.css({
			"width" : $currentNav.innerWidth(),
			"left" : $currentNav.position().left
		}).data("origLeft", $slideNavLine.position().left).data("origWidth", $slideNavLine.width());
		$slideNav.find("a").hover(function(){
			$el = $(this);
			leftPos = $el.position().left;
			newWidth = $el.innerWidth();
			$slideNavLine.stop().animate({
				left: leftPos,
				width: newWidth
			});
		},function(){
	        $slideNavLine.stop().animate({
	            left: $slideNavLine.data("origLeft"),
	            width: $slideNavLine.data("origWidth")
	        });
	    });
	};
})();
// end nav



// 
if ($().slide) {
$(".pro_flash").slide({mainCell:".bd",titCell:".hd",effect:"leftLoop",autoPage: true, autoPlay: true, pnLoop:true, delayTime: 500, interTime: 5000});

};
// end


//标签导航
$(".tab_nav dd a:first").addClass("tab_light");
$(".tab_box > div").hide(); 
$(".tab_box > div:first").show(); 
$('.tab_nav dd a').click(function(){ 
$(this).addClass('tab_light').siblings().removeClass('tab_light'); 
$(".tab_box > div").hide().eq($('.tab_nav dd a').index(this)).fadeIn();
}); 
//


//主导航
$(".nav_btn").click(function(){
$(".nav_btn").toggleClass("on");
$('.tnav').slideToggle();
});	
//




});
};
// end jq