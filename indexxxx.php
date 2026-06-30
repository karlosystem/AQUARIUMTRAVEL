<?php
	require_once("aplication_top.php");	
	$title_header_page = TITLE_PAGE;
	$description_header_page = TITLE_DESCRIPTION;
	$keyword_header_page = TITLE_KEYWORD;
	include("header.php");
?>

<script language="javascript" src="<?php echo _URL?>js/colorbox.js"></script>
<link media="screen" rel="stylesheet" target="_blank" href="<?php echo _URL?>css/colorbox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _URL?>css/popup.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _URL?>css/tabs.css" />

<script type="text/javascript">
var $xx = jQuery.noConflict();
$xx(document).ready(function() {	
	$xx.colorbox({width:"738px", height:"440px",inline:true, href:"#subscribe"});
});
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
<script src="js/jTabs.js"></script>
<script>
	var $ta = jQuery.noConflict();
	$ta(document).ready(function(){
	$ta("ul.tabs_").jTabs({content: ".tabs_content"});});     
</script>

<div id="content">
    <div class="wrapper2">        
        <div id="left">
            <div class="wrapper2">
                <div class="extra-indent">
                    <?php
                        include("body-left.php");
                    ?>
                </div>
            </div>
        </div>


	<div class="container">
		<div class="moduletable_slider">
		
		  <script type="text/javascript"> <!--
               jQuery(function(){
                jQuery('#camera_wrap_130').camera({
                        height: '403',
                        minHeight: '',
                        pauseOnClick: false,
                        hover: 1,
                        fx: 'random',
                        loader: 'pie',
                        pagination: 0,
                        thumbnails: 0,
                        time: 7000,
                        transPeriod: 1500,
                        alignment: 'center',
                        autoAdvance: 1,
                        mobileAutoAdvance: 1,
                        portrait: 0,
                        barDirection: 'leftToRight',
                        navigationHover: true,
                        navigation: true,
                        playPause: true,
                        barPosition: 'bottom'
                });
        }); //--> </script><!-- debut Slideshow CK -->


<div class="slideshowck_slider camera_wrap camera_amber_skin" id="camera_wrap_130">
        
        <?php 
			$cls_banner_home = new cls_tbl_banner();
			$cls_banner_home->width_container = 710;
			$cls_banner_home->height_container = 403;
			$cls_banner_home->position_int = 1;
			print $cls_banner_home->nivoSlider();  
		?>
        
</div>

<div style="clear:both;"></div>

<!-- fin Slideshow CK -->
</div>

<img src="<?php echo _URL?>images/promociones.png">

	<div class="error err-space">
		<div id="system-message-container"></div>
	</div>

	<div class="module_new">
		
<div class="boxIndent">
		<div class="wrapper">
			<div class="vmgroup_new">
				<ul id="vmproduct" class="vmproduct_new">
						<?php
									$cls_paquete = new cls_tbl_paquete();
									print $cls_paquete->DestacadosPaquetePortada(0,121);
						?>     
				</ul>
			</div>
		</div>
	  </div>
	</div>
</div>

<div class="clear"></div>
</div>
</div>
<div class="clear"></div>

 <div style='display:none'>
     <div id='subscribe' style='padding:0px; background:#fff;'>
        <?php 
			$cls_banner_home2 = new cls_tbl_banner();
			$cls_banner_home2->width_container = 650;
			$cls_banner_home2->height_container = 332;
			$cls_banner_home2->position_int = 2;
			print $cls_banner_home2->nivoSlider2();  
		?>
      </div>
 </div>



<?php
	include("footer.php");
?>