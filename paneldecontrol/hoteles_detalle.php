<?php
require_once("aplication_top.php");
$IdHotel = (int)$_GET['pid'];
$HotelExists = true;
$cls_hoteles = new cls_tbl_hoteles($IdHotel);
$Foto = $cls_hoteles->gettxt_imagen();
$calidad = $cls_hoteles->gettxt_estrellas();

$precio_nino = $cls_hoteles->gettxt_precio_nino();
$precio_doble = $cls_hoteles->gettxt_precio_doble();
$precio_triple = $cls_hoteles->gettxt_precio_triple();
$precio_simple = $cls_hoteles->gettxt_precio_simple();

$HotelesDetails = $cls_hoteles->get_hoteles_detail($IdHotel);
$nombre_hotel = $HotelesDetails[0]['hoteles_txt_title'];
$descri_hotel = $HotelesDetails[0]['hoteles_txt_content'];
$servic_hotel = $HotelesDetails[0]['hoteles_txt_servicios'];
$habita_hotel = $HotelesDetails[0]['hoteles_txt_habitacion'];


$Ubica = $cls_hoteles->getfk_departamento();
$cls_departamento = new cls_tbl_departamento($Ubica);
$ubicacion = $cls_departamento->gettxt_descripcion();


#SEO
$title_header_page = $nombre_hotel ." - "._TITLE_PUBLIC;
$description_header_page = TITLE_DESCRIPTION;
$keyword_header_page = TITLE_KEYWORD;

include("header.php");
?>

</header>
<div class="columns clearfix">
<div id="center_column" class="center_column">
<div class="breadcrumb bgcolor">
<div class="breadcrumb_inner">
<a href="<?php echo _URL?>index.php" title="regresar al inicio">Inicio</a>
<span class="navigation-pipe">&gt;</span>
<span class="navigation_page"><?php print $nombre_hotel;?></span>
</div>
</div>
 
<div id="primary_block" class="clearfix">
 
<div id="pb-right-column">
 
<div id="image-block" class="bordercolor">

<?php 
					  if(tep_not_null($Foto) && file_exists(PUBLIC_PHOTOBIG_HOTELES.$Foto)){
					   $img_thumb = PUBLIC_PHOTOBIG_HOTELES.$Foto;
					   print tep_image(_URL.'resize.php?image='.$img_thumb.'&w=304&h=304&IsCrop=0',$title_secure,'','','');
					  }
					 ?>


</div>
 
<div id="views_block">
<span class="view_scroll_spacer">
<a id="view_scroll_left" class="hidden" title="Other views" href="javascript:{}">Previous</a></span> <div id="thumbs_list">
<ul id="thumbs_list_frame">

<li id="thumbnail_1" class="">
<a href="#" rel="other-views" class="thickbox bordercolor shown" title="">
<img id="thumb_1" src="<?php echo _URL?>images/1-medium_default.jpg" alt="" height="80" width="80"/>
</a>
</li>

<li id="thumbnail_2" class="">
<a href="<?php echo _URL?>images/2-thickbox_default.jpg" rel="other-views" class="thickbox bordercolor " title="">
<img id="thumb_2" src="http://livedemo00.template-help.com/prestashop_43054/img/p/2/2-medium_default.jpg" alt="" height="80" width="80"/>
</a>
</li>

<li id="thumbnail_3" class="">
<a href="<?php echo _URL?>images/2-thickbox_default.jpg" rel="other-views" class="thickbox bordercolor " title="">
<img id="thumb_3" src="http://livedemo00.template-help.com/prestashop_43054/img/p/2/2-medium_default.jpg" alt="" height="80" width="80"/>
</a>
</li>


</ul>
</div>
<a id="view_scroll_right" title="Other views" href="javascript:{}">Next</a> </div>
<p class="resetimg" style="display:none;"><span id="wrapResetImages" style="display: none;"><img src="http://livedemo00.template-help.com/prestashop_43054/themes/theme553/img/icon/cancel_11x13.gif" alt="Cancel" width="11" height="13"/> <a id="resetImages" href="http://livedemo00.template-help.com/prestashop_43054/index.php?id_product=1&controller=product&id_lang=1" onClick="$('span#wrapResetImages').hide('slow');return (false);">Display all pictures</a></span></p>  
<ul id="usefull_link_block" class="bordercolor">
<li id="left_share_fb">
<a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Flivedemo00.template-help.com%2Fprestashop_43054%2Findex.php%3Fid_product%3D1%26controller%3Dproduct%26id_lang%3D1&amp;t=Cancun+JUNGLE+TOUR" class="js-new-window">Compartir con Facebook</a>
</li>
<li class="sendtofriend">
<a id="send_friend_button" href="#send_friend_form">Enviar a un Amigo</a>
</li>
<div style="display: none;">
<div id="send_friend_form">
<h2 class="title">Send to a friend</h2>
<div class="send_friend_form_content">
<div id="send_friend_form_error"></div>
</div>
</div>
<li class="print"><a href="javascript:print();">Imprimir</a></li>
</ul>
</div>
 
<div id="pb-left-column">
<h1><?php print $title_secure;?></h1>
 
<form id="buy_block" class="bordercolor" action="#" method="post">
 
<div class="price bordercolor">
<span class="our_price_display">
<span id="our_price_display" class="pricecolor">Ubicaci&oacute;n: <?php print $ubicacion;?></span>
 
</span>
<p id="add_to_cart">
<a class="exclusive" href="<?php echo _URL?>contactenos.php" target="_self">Solicitar Informaci&oacute;n</a>

</p>

</div>
<div class="other_options bordercolor clearfix">
<div id="other_prices">

 
<p id="pQuantityAvailable">
<span id="quantityAvailable">Calidad de Hotel:
<?php 
	$str_hoteles = "";
	switch ((int)$calidad){
		 case 1:$str_hoteles .= "<img src=\""._URL."/images/1star.png\" title=\"1 estrellas\" />";break;
		 case 2:$str_hoteles .= "<img src=\""._URL."/images/2star.png\" title=\"2 estrellas\"/>";break;
		 case 3:$str_hoteles .= "<img src=\""._URL."/images/3star.png\" title=\"3 estrellas\"/>";break;
		 case 4:$str_hoteles .= "<img src=\""._URL."/images/4star.png\" title=\"4 estrellas\"/>";break;
		 case 5:$str_hoteles .= "<img src=\""._URL."/images/5star.png\" title=\"5 estrellas\"/>";break;
		 default:$str_hoteles .= "&nbsp;";break;
	  }	
	echo $str_hoteles;  
?>
</span>
</p>
</div>
<div id="attributes">
<span class="on_sale">DISPONIBLE!</span>
<div class="clearblock"></div>
</div>
</div>
<div class="clear"></div>
<div id="short_description_block" class="bordercolor">
<div id="short_description_content" class="rte align_justify">
<p><?php print $nombre_hotel;?></p>
</div>

 
<p id="oosHook" style="display: none;">

<div id="product_comments_block_extra" class="bordercolor">
<ul>
<li><a class="open-comment-form" href="#">
<?php
	if(tep_not_null($precio_nino )){print "PRECIO HABITACION / NI&Ntilde;O: "." <span>".$precio_nino;print "</span>";}
?>
</a>
</li>

<li><a class="open-comment-form" href="#">
<?php
	if(tep_not_null($precio_simple )){print "PRECIO HABITACION / SIMPLE: "." <span>".$precio_simple;print "</span>";}
?>
</a>
</li>

<li><a class="open-comment-form" href="#">
<?php
	if(tep_not_null($precio_doble )){print "PRECIO HABITACION / DOBLE: "." <span>".$precio_doble;print "</span>";}
?>
</a>
</li>

<li><a class="open-comment-form" href="#">
<?php
	if(tep_not_null($precio_triple )){print "PRECIO HABITACION / TRIPLE: "." <span>".$precio_triple;print "</span>";}
?>
</a>
</li>

</ul>
</div>
 
</p>
<!--[if !IE]> -->
<div class="share bordercolor">
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>

</div>
<!-- <![endif]-->
<div class="clearblock"></div>
</div>
 
</form>
</div>
</div>

	<ul class="idTabs">
	<li><a class="selected">Descripcion del Hotel </a></li>
	</ul>
<div class="customization_block bgcolor bordercolor">
<form method="post" action="#" id="customizationForm" class="clearfix">
	<div class="customizableProductsText">
	<?php print $descri_hotel;?>
	</div>

</form>
<p class="clear required"><sup>*</sup> required fields</p>
</div>

 

<br />

	<ul class="idTabs">
	<li><a class="selected">Servicios que ofrece el Hotel </a></li>
	</ul>
<div class="customization_block bgcolor bordercolor">
<form method="post" action="#" id="customizationForm" class="clearfix">
	<p class="infoCustomizable">
	<!--After saving your customized product, remember to add it to your cart.-->
	</p>
	<div class="customizableProductsText">
	<?php print $servic_hotel;?>
	</div>

</form>
<p class="clear required"><sup>*</sup> required fields</p>
</div>


<br />

	<ul class="idTabs">
	<li><a class="selected">Descripcion de la Habitacion </a></li>
	</ul>
<div class="customization_block bgcolor bordercolor">
<form method="post" action="#" id="customizationForm" class="clearfix">
	<p class="infoCustomizable">
	<!--After saving your customized product, remember to add it to your cart.-->
	</p>
	<div class="customizableProductsText">
	<?php print $habita_hotel;?>
	</div>

</form>
<p class="clear required"><sup>*</sup> required fields</p>
</div>
 
<div id="more_info_block">
<ul id="more_info_tabs" class="idTabs idTabsShort ">
<li><a id="more_info_tab_more_info" href="#idTab1">MAS HOTELES</a></li>
</ul>
<div id="more_info_sheets" class="bordercolor bgcolor">
 
<div id="idTab1"><div>
<p>M&aacute;s Hoteles de su interes</p>
</div>
</div>
 
 
<ul id="idTab4">
 <?php
	$cls_paquete = new cls_tbl_paquete();
	echo $cls_paquete->paquetes_relacionados_animado($categoria,0,20);
?>
</ul>
<div id="idTab5">
<div id="product_comments_block_tab">
<p class="align_center">
<a id="new_comment_tab_btn" class="open-comment-form" href="<?php echo _URL?>contactenos.php">Para m&aacute;s informaci&oacute;n click aqu&iacute;</a>
</p>
</div>
</div>
 </div>

</div>
</div>
<aside>
	<div id="right_column" class="column"> 
		<?php include("body-left.php");?>
			<div id="tmpics">
				<ul>
					 <?php
						 $cls_banner_right = new cls_tbl_banner();
						 $cls_banner_right->position_int = 3;
						 echo $cls_banner_right->AdsLRLink();
					?>
				</ul>
			</div>
			
	</div>
</aside>
</div>
<?php include("footer.php");?>

