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
	$xx.colorbox({width:"628px", height:"680px",inline:true, href:"#subscribe"});
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
		<!--<h3><span><span>PROMOCIONES DEL MES</span></span></h3>-->
		
<div class="boxIndent">
		<div class="wrapper">
			<div class="vmgroup_new">
            
            	<div class="wrap03">
                    <ul class="tabs_">  
                        <li class="active"><a href="<?php echo _URL?>">Ver Paquetes Nacionales</a></li>
                        <li><a href="<?php echo _URL?>">Ver Paquetes Internacionales</a></li>
                    </ul>  
                    
                    <div class="clear"></div>
                        <div class="tabs_content">
                                    <div>
                                    	<ul id="vmproduct" class="vmproduct_new">
										  <?php
											$cls_paquete = new cls_tbl_paquete();
											$tipo=1;
											print $cls_paquete->DestacadosPaquetePortada(0,121,$tipo);
                                          ?>     
                                        </ul>
                                    </div>
                                    
                        			<div>
                                    	<ul id="vmproduct" class="vmproduct_new">
                                    	 <?php
											$cls_paquete = new cls_tbl_paquete();
											$tipo=2;
											print $cls_paquete->DestacadosPaquetePortada(0,121,$tipo);
                                          ?>   
                                          </ul>  
                      				</div>
                        </div>        
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
                <!--<h4 class="box-title">Oferta de Paquetes Turisticos Internacionales y Nacionales</h2>-->

<!--                <h5 class="box-tagline">Visita nuestro Facebook y dale click en "ME GUSTA" y enterate diariamente de nuestras promociones, ofertas de tours y paquetes turisticos al mas bajo precio.</h5>-->

                <!-- BEGIN #subs-container -->
                <!--<div id="subs-container" class="clearfix">-->
				<!--<div class="fb-like-box" data-href="https://www.facebook.com/www.aquariumtravel.com.pe" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-height="220" data-width="610" data-show-border="true"></div>-->
               
               <?php
				switch(date('w'))
				 {
				  case '7':
				   //Monday
				   #$ruta = "http://www.aquariumtravel.com.pe/tours-en-iquitos-pid-66.html";
				   #$imagen = "images/vacaciones_confirmadas.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   break;
				  case '2':
				   //Tuesday:
				   #$ruta = "http://www.aquariumtravel.com.pe/paquetes-hotel-royal-decameron-punta-sal-todo-incluido-desde-79-pid-320.html";
				   #$imagen = "images/banner_puntasal.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   break;
				   
				   case '3':
				   //Miercoles:
				   #$ruta = "http://www.aquariumtravel.com.pe/paquetes-turisticos-san-andres-desde-lima-pid-12.html";
				   #$imagen = "images/san-andres-con-tiquetegr.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   break;

				   case '4':
				   //Jueves:
				   #$ruta = "http://www.aquariumtravel.com.pe/paquetes-turisticos-varadero-desde-lima-pid-13.html";
				   #$imagen = "images/Banner_varadero.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   
				   break;
				   
				   case '5':
				   //Viernes:
				   #$ruta = "http://www.aquariumtravel.com.pe/paquetes-turisticos-punta-cana-desde-lima-pid-19.html";
				   #$imagen = "images/banner_puntacana.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   
				   break;
				   
				   case '6':
				   //Sabado:
				   #$ruta = "http://www.aquariumtravel.com.pe/paquetes-turisticos-cancun-desde-lima-pid-93.html";
				   #$imagen = "images/banner_cancun.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   
				   break;
				   
				   case '1':
				   //Sabado:
				   #$ruta = "http://www.aquariumtravel.com.pe/paquetes-turisticos-riviera-maya-desde-lima-pid-94.html";
				   #$imagen = "images/banner_riviera_maya.jpg";
				   $ruta = "http://www.aquariumtravel.com.pe/contenido.php?cid=6";
				   $imagen = "images/fotito_oltursa.jpg";
				   
				   break;
				}
				?>
                <a href="<?php print $ruta; ?>" target="_self">
                <?php
                	echo "<img src=\"$imagen\" />";
				?>
				</a>
                <!-- BEGIN #subs-container -->
                <!--</div>-->
      </div>
 </div>



<?php
	include("footer.php");
?>