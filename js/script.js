var $j=jQuery.noConflict();
$j(document).ready(function(){
	$j('#products').slides({preload:true,preloadImage:false,effect:'fade',crossfade:true,slideSpeed:350,fadeSpeed:500,generateNextPrev:false,generatePagination:false});

/*$j('.jqzoom').jqzoom({zoomType:'reverse',lens:true,zoomWidth:300,zoomHeight:230,preloadImages:false,title:false,alwaysOn:false});
*/
$j("#carousel").jcarousel({scroll:1});});


	
	$j(window).load(function(){
		$j('.tab_container , .Fly-tabs , .share1 , .share , .checkout-button-top , #products_example , .box-prod , .FAQS ').css('visibility','visible');
		$j('.checkout-button-top').css({visibility:'visible',display:'block'});
});