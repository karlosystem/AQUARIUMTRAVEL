<?php
require_once("aplication_top.php");
$Cid = (int)$_GET['pid'];
$cls_paquete = new cls_tbl_paquete($Cid);
$cls_date = new dateconvert_language;
$cls_date->language = $languages_code;

$PaqueteDetails = $cls_paquete->get_paquete_detail($Cid);
$categoria = $cls_paquete->getfk_categoria();

if ($categoria == 80 || $categoria == 66 || $categoria == 33 || $categoria == 28 || $categoria == 32 || $categoria == 29 || $categoria == 34 || $categoria == 28 || $categoria == 26 || $categoria == 27 || $categoria == 24 || $categoria == 25 || $categoria == 78 || $categoria == 67 || $categoria == 31 || $categoria == 68 || $categoria == 44 || $categoria == 53 || $categoria == 54 || $categoria == 55 || $categoria == 56 || $categoria == 57 || $categoria == 58 || $categoria == 59 || $categoria == 45 || $categoria == 46 || $categoria == 47 || $categoria == 48 || $categoria == 49 || $categoria == 50 || $categoria == 51 || $categoria == 52) {
    $title_secure = "TOURS " . strtoupper($PaqueteDetails[0]['title']);
} else {
    $title_secure = "PAQUETES TURISTICOS " . strtoupper($PaqueteDetails[0]['title']);
}

$Incluye = $PaqueteDetails[0]['incluye'];
$Boleto = $PaqueteDetails[0]['boleto'];

$meta_title = $PaqueteDetails[0]['meta_title'] . " | Aquarium Travel";
$meta_description = $PaqueteDetails[0]['meta_description'];
$meta_keyword = $PaqueteDetails[0]['meta_keyword'];

$Description = $PaqueteDetails[0]['description'];
$Presentacion = $PaqueteDetails[0]['presentacion'];
$Contenido = $PaqueteDetails[0]['contenido'];

$datepublic = $cls_paquete->gettxt_datepaquete();
$folder_complete = DIR_WS_LANGUAGES . $language_dir . '/' . _PAQUETES;
$folder_complete_pdf = DIR_WS_LANGUAGES . $language_dir . '/' . _PDF;
$ArchivoPdf = $PaqueteDetails[0]['pdf'];
$descargar_pdf = $folder_complete_pdf . $ArchivoPdf;
$Img = $PaqueteDetails[0]['image'];
$TReg = $cls_paquete->gettxt_dateadd();
$TFrom = $cls_paquete->gettxt_datefrom();
$TTo = $cls_paquete->gettxt_dateto();
$Dias = $cls_paquete->getint_countdias();
$Disponible = $cls_paquete->gettxt_isagotado();
$Ultimos = $cls_paquete->gettxt_isultimos();
$Noches = $cls_paquete->getint_countnoches();

$aeropuerto = $cls_paquete->getfk_aeropuerto();
$cls_aeropuerto = new cls_tbl_aeropuerto($aeropuerto);
$title_aeropuerto        = $cls_aeropuerto->gettxt_nombre();

$DateTF[] = array("tpl_datefrom", $TFrom);
$DateTF[] = array("tpl_dateto", $TTo);
define("TFROMTO", "Viaje desde <span>%%tpl_datefrom%%</span> hasta el <span>%%tpl_dateto%%</span> ");
$StringDate = TFROMTO;

$ToBoleto = $PaqueteDetails[0]['boleto'];
$Traslado = $PaqueteDetails[0]['traslate'];

$LinkYouTube = $cls_paquete->gettxt_youtube();
$Precio = $cls_paquete->gettxt_precio();
$Precio_soles = $cls_paquete->gettxt_precio_soles();
$title_video = $PaqueteDetails[0]['title_youtube'];
$description_video = $PaqueteDetails[0]['desc_youtube'];
$hoteles = $cls_paquete->gettxt_bhoteles();

#SEO
$title_header_page = $meta_title;
$keyword_header_page = $meta_keyword;
$description_header_page = $meta_description;

$cls_categoria = new cls_tbl_categoria($categoria);
$title_categoria        = $cls_categoria->gettxt_nombre();

$GLOBALS['CONNECT_DB']->Query("update [|PREFIX|]paquete set int_visto = int_visto + 1 WHERE pk_paquete = '" . $Cid . "'");

include("header.php");
?>
<link rel="stylesheet" href="<?php echo _URL ?>css/alertas.css" type="text/css" />
<link rel="stylesheet" href="<?php echo _URL ?>css/notificaciones.css" type="text/css" />
<link rel="stylesheet" href="<?php echo _URL ?>css/pricing-tables.css">
<link rel="stylesheet" href="<?php echo _URL ?>css/paquetes_similares.css">

<style>
    .button2 {
        font-family: Verdana, Geneva, sans-serif;
        font-size: 16px;
        color: #000;
        padding: 5px 10px 5px 10px;
        border: 1px solid #999;
        text-shadow: 0px 1px 1px #FFF;
        text-decoration: none;

        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;

        background: #ffcc66;
        background: -moz-linear-gradient(top, #ffcc66 0%, #ffe6b6 50%, #ffbc47 51%, #ffc75d 100%);
        background: -webkit-gradient(linear, left top, left bottom, from(#ffcc66), to(#ffe6b6), color-stop(0.4, #ffe6b6), color-stop(0.5, #fff), color-stop(.5, #ffbc47), color-stop(0.9, #ffc75d));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffcc66', endColorstr='#ffe6b6', GradientType=0);

        cursor: pointer;

    }

    .button2:hover {
        background: -moz-linear-gradient(top, #ffcc66 0%, #ffe6b6 50%, #ffe6b6 51%, #ffc75d 100%);
        background: -webkit-gradient(linear, left top, left bottom, from(#ffcc66), to(#ffe6b6), color-stop(0.4, #ffe6b6), color-stop(0.5, #fff), color-stop(.5, #fff), color-stop(0.9, #ffc75d));
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffe6b6', endColorstr='#ffe6b6', GradientType=0);
    }

    #hor-minimalist-b {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;
        background: #fff;
        margin: 45px;
        width: 480px;
        border-collapse: collapse;
        text-align: left;
    }

    #pane th {
        font-size: 14px;
        font-weight: normal;
        color: #039;
        padding: 10px 8px;
    }

    #pane td {
        border: 1px solid #ccc;
        color: #669;
        padding: 6px 8px;
    }

    #hor-minimalist-b tbody tr:hover td {
        color: #009;
    }
</style>

<style type="text/css">
    #box-table-b {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;
        margin: 5px;
        width: 96%;
        text-align: center;
        border-collapse: collapse;
        border-top: 7px solid #9baff1;
        border-bottom: 7px solid #9baff1;
    }

    #box-table-b th {
        font-size: 13px;
        font-weight: normal;
        padding: 8px;
        background: #e8edff;
        border-right: 1px solid #9baff1;
        border-left: 1px solid #9baff1;
        color: #039;
    }

    #box-table-b td {
        padding: 8px;
        background: #e8edff;
        border-right: 1px solid #aabcfe;
        border-left: 1px solid #aabcfe;
        color: #669;
    }
</style>

<style type='text/css'>
    #popup_box {
        display: none;
        /* Hide the DIV */
        position: fixed;
        _position: absolute;
        /* hack for internet explorer 6 */
        height: 330px;
        width: 550px;
        background-color: #FFF;
        left: 500px;
        top: 220px;
        z-index: 100;
        /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 25px;
        /* additional features, can be omitted */
        border: 1px solid #000;
        padding: 15px;
        font-size: 15px;
        -moz-box-shadow: 0 0 5px;
        -webkit-box-shadow: 0 0 5px;
        box-shadow: 0 0 5px;
    }

    #container2 {
        background-color: #CCC;
        /*Sample*/
        width: 100%;
        height: 100%;
    }

    a {
        cursor: pointer;
        text-decoration: none;
    }

    /* This is for the positioning of the Close Link */
    #popupBoxClose {
        font-size: 12px;
        line-height: 15px;
        right: 5px;
        top: 5px;
        position: absolute;
        color: #6fa5e2;
        font-weight: 500;
    }

    .newrotate {
        position: absolute;
        left: 0px;
        top: 0px;
    }
</style>

<?php /*?><script type='text/javascript'>//<![CDATA[ 
var $ww = jQuery.noConflict();
$ww(window).load(function(){
    $ww(document).ready( function() {

        // When site loaded, load the Popupbox First
        loadPopupBox();

        $ww('#popupBoxClose').click( function() {            
            unloadPopupBox();
        });

        $ww('#container2').click( function() {
            unloadPopupBox();
        });

        function unloadPopupBox() {    // TO Unload the Popupbox
            $ww('#popup_box').fadeOut("slow");
            $ww("#container2").css({ // this is just for style        
                "opacity": "1"  
            }); 
        }    

        function loadPopupBox() {    // To Load the Popupbox
            
            var counter = 5;
            var id;
            $ww('#popup_box').fadeIn("slow");
            $ww("#container2").css({ // this is just for style
                "opacity": "0.3"  
            });
            
            id = setInterval(function() {
                counter--;
                if(counter < 0) {
                    clearInterval(id);
                    
                    unloadPopupBox();
                } else {
                    $ww("#countDown").text("esto se cierra despues de " + counter.toString() + " segundos.");
                }
            }, 1000);
            
        }        
    });
});//]]>  

</script>
<?php */ ?>
<div id="content">
    <div class="wrapper2">
        <div id="right">
            <div class="wrapper2">
                <table class="pricing-table">
                    <thead>
                        <tr class="plan">
                            <td class="orange">
                                <h4>Aprovecha la oferta</h4>
                                <em>Precio por persona desde:</em>
                            </td>
                        </tr>
                        <tr class="price_paquete">
                            <td>
                                <p style="color:#d10c51; font-weight: bold;"><span>US$</span><?php print round(str_replace(',', '', $Precio)); ?></p>
                                <span style="color:#d10c51; font-weight: bold;">&oacute; <?php print "S/. " . round(str_replace(',', '', $Precio_soles)); ?> Nuevos Soles</span>

                            </td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="clock-icon">
                            <td><?php print $Dias; ?> Dias / <?php print $Noches; ?> Noches</td>
                        </tr>
                        <tr class="basket-icon">
                            <td>Salidas desde Aeropuerto de Lima</td>
                        </tr>
                        <!-- <tr class="star-icon">
			<td>Ingreso: <strong><?php echo Date::convert($TReg, 'Y-m-d', 'd-m-Y') ?></strong></td>
		</tr> -->
                        <tr class="heart-icon">
                            <td style="font-size:14px;"><strong><?php echo Date::convert($TFrom, 'Y-m-d', 'd-m-Y') ?> al <?php echo Date::convert($TTo, 'Y-m-d', 'd-m-Y') ?></strong></td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td>
                                <!-- <a class="button_example" href="<?php echo _URL ?>cotizaciones.php?idpaq=<?php echo $Cid; ?>">PEDIR COTIZACION</a> -->

                                <a alt="Chat por Whatsapp" title="Chat por Whatsapp" href="https://wa.me/51936545254?text=¡Hola!%20requiero%20información%20de%20la%20oferta%20que%20visualizo%20en%20su%20página%20web%20Aquarium%20Travel%20:%0D%0A<?php print $PaqueteDetails[0]['title']; ?>" target="_new">
                                    <img src="<?php echo _URL ?>images/whatsapp-chat-min.jpg">
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo _URL ?>contactenos.php">&iquest;Tienes dudas &oacute; quieres personalizar este paquete?</a></td>
                        </tr>
                    </tfoot>
                </table>

                <div id="templatemo_sidebar">
                    <div class="sidebar_box"><a href="#about">
                            <span class="about" style="width:30px; height:50px;"></span>
                            <span class="menu_title">Confianza</span>
                            <span class="menu_desc">Somos humanos asesor&aacute;ndote, podr&aacute;s contactarnos en todo momento.</span>
                        </a>
                    </div>

                    <div class="sidebar_box"><a href="#services">
                            <span class="services"></span>
                            <span class="menu_title">Personalizable</span>
                            <span class="menu_desc">Se trata de que viajes como tu quieras, ajustamos este paquete a tus gustos y necesidades.</span>
                        </a>
                    </div>

                    <div class="sidebar_box"><a href="#testimonial">
                            <span class="testimonial"></span>
                            <span class="menu_title">Ofertas Unicas</span>
                            <span class="menu_desc">Encontrar&aacute;s las mejores tarifas de paquete &oacute; te igualamos cualquier oferta.</span>
                        </a>
                    </div>
                    <a href="http://www.aquariumtravel.com.pe/contenido.php?cid=6">
                        <img src="<?php echo _URL ?>images/oltursa-logo.jpg" style="margin-top:5px;" /></a>
                    <br />
                    <a href="contactenos.php"><img src="<?php echo _URL ?>images/oferta_traslados.jpg" style="margin-top:5px;" /></a>
                    <br />
                    <a href="http://www.aquariumtravel.com.pe/paquetes-turisticos-punta-cana-desde-lima-pid-19.html">
                        <img src="<?php echo _URL ?>images/banner-puntacana.jpg">
                    </a>
                    <br><br>
                </div>
                <!--end templatemo_sidebar-->

            </div>
        </div>

        <div class="container">
            <?php /*?>        	<div class="moduletable_Breadcrumbs">
					<div class="breadcrumbs_Breadcrumbs">
						<a href="<?php echo _URL?>index.php" class="pathway">Inicio</a> &gt; 
                        <a href="#" class="pathway"><?php print $title_categoria;?></a>
                     </div>
			</div><?php */ ?>


            <div class="content-indent">
                <div class="productdetails-view">
                    <div class="wrapper2">
                        <div class="alert-message error">
                            <div class="box-icon"></div>
                            <p>CONSULTAR LA POL&Iacute;TICA DE EQUIPAJE DE MANO Y EQUIPAJES EN BODEGA<a href="" class="close">&times;</a>
                        </div>

                        <h4><?php print $title_secure; ?></h4>
                        <form method="post" action="<?php echo _URL ?>cotizaciones.php?idpaq=<?php echo $Cid; ?>">
                            <div class="fright">
                                <div class="s_desc">

                                    <div align="center">
                                        <img src="<?php echo _URL ?>images/ico1.png">
                                        <img src="<?php echo _URL ?>images/ico2.png">
                                        <img src="<?php echo _URL ?>images/ico3.png">
                                        <img src="<?php echo _URL ?>images/ico4.png">
                                    </div>

                                    <p>
                                        <?php print $Presentacion; ?>
                                    </p>

                                </div>
                                <!--end s_desc-->
                                <div class="product-box2">
                                    <div class="spacer-buy-area">
                                        <div class="addtocart-area">

                                            <div class="addtocart-bar">
                                                <div class="wrapper">
                                                    <div class="price">
                                                        <div class="product-price" id="productPrice15">
                                                            <strong>Price: </strong>
                                                            <div class="PricevariantModification">
                                                                <span style="font-weight:bold; color:#ff0000;">Incluye:</span>
                                                                <span class="PricevariantModification" style="color:#000; font-weight:normal;"><?php print $Incluye; ?>
                                                                </span>
                                                            </div>
                                                            <!--end PricevariantModification-->
                                                            <div class="PricebasePriceWithTax" style="display : block;">
                                                                <span style="font-weight:bold; color:#ff0000;">Aerolinea:</span>
                                                                <span class="PricebasePriceWithTax" style="color:#000000;"><?php print $Boleto; ?></span>
                                                            </div>
                                                            <!--end PricebasePriceWithTax-->


                                                        </div>
                                                        <!--end product-price-->
                                                    </div>
                                                    <!--end price-->
                                                </div>
                                                <!--end wrapper-->

                                            </div>
                                            <!--end addtocart-bar-->



                                        </div>
                                        <!--end addtocart-area-->

                                    </div>
                                    <!--end spacer-buy-area-->

                                </div>
                                <!--end product-box2-->

                            </div>
                            <!--end fright-->
                            <div class="fleft">
                                <div id="products_example">
                                    <div id="products" class="">
                                        <div class="slides_container">
                                            <div class="slide">

                                                <?php
                                                if ($Disponible == 1) {
                                                    print "<div class=\"newrotate\"><img src=\"" . _URL . "images/labelAgotado.png\"></div>";
                                                }
                                                ?>


                                                <a title="product15" class="jqzoom modal" href="<?php echo _URL ?>cotizaciones.php?idpaq=<?php echo $Cid; ?>">


                                                    <?php
                                                    if (tep_not_null($Img) && file_exists($folder_complete . $Img)) {
                                                        $img_thumb = base64_encode($folder_complete . $Img);
                                                        $url_thumb = _URL . "thumb_notice_list/" . $img_thumb . "/580x320." . _FEXT;
                                                        print tep_image(_URL . 'resize.php?image=' . $img_thumb . '&w=220&h=220&IsCrop=0', $title_secure, '', '', 'class="productimage"');
                                                    }
                                                    ?>
                                                </a>
                                                <link rel="image_src" type="image/jpeg" href="<?php print _URL . $folder_complete . $Img; ?>" />

                                            </div>
                                            <!--end slide-->
                                        </div>
                                        <!--end slides_container-->
                                    </div>
                                    <!--end products-->
                                </div>
                                <!--end products_example-->

                            </div>
                            <!--end fleft-->
                        </form>
                    </div>
                    <!--end wrapper2-->
                    <dl class="tabs" id="pane" style="font-size:12px; margin-top:20px;">
                        <?php print $Description; ?>
                    </dl>

                </div>
                <!--end productdetails-view-->
            </div>


            <!--end content-indent-->

            <?php /*?>            <div id="popup_box">    <!-- OUR PopupBox DIV-->
            	<h4 align="center" id="countDown">esto se cierra en 5 segundos</h4>
                <a href="<?php echo _URL?>contactenos.php">
            		<img src="<?php echo _URL?>images/fotito_traslados.jpg">
                </a>                
                <!--<a id="popupBoxClose">Cerrar</a>    -->
            </div>
            <div id="container2"> <!-- Main Page -->            	
                <h1></h1>
            </div>   <?php */ ?>


            <div class="clear">



            </div><br />

            <center>
                <a href="<?php echo _URL ?>cotizaciones.php?idpaq=<?php echo $Cid; ?>" target="_self">
                    <img src="<?php echo _URL ?>images/Boton-Contactenos.png">
                </a>

                <br><br>
                <a href="https://wa.me/51936545254?text=¡Hola!%20requiero%20información%20de%20la%20oferta%20que%20visualizo%20en%20su%20página%20web%20Aquarium%20Travel%20:%0D%0A<?php print $PaqueteDetails[0]['title']; ?>" target="_new">
                    <img src="<?php echo _URL ?>images/whatsapp-chat-min.jpg">
                </a>
                <br /><br />

                <?php
                if (tep_not_null($LinkYouTube)) {
                    print "<div class=\"video\">";
                    $cls_youtube = new YouTube();
                    print $cls_youtube->EmbedVideo($LinkYouTube, 420, 315);
                    print "</div>";
                }
                ?>


            </center>
			
			<h4><?php print strtoupper($title_categoria); ?></h4>
            <div class="content-indent" style="margin-top: 5px;">
                <div class="productdetails-view">
                    <div class="wrapper2">
                        <dl class="tabs" id="contenido" style="font-size:12px; margin-top:20px;">
                            
                            <?php print $Contenido; ?>
                        </dl>

                    </div>
                </div>
            </div>
            <br><br>
        </div>
        <!--cierro container-->



        <div class="clear"></div>
    </div>
    <!--cierro wrapper2-->
    <h1 style="background-color: #671E77;">Paquetes Turisticos Similares en <?php print $title_categoria; ?></h1>

    <div class="vmgroup_new">
        <ul id="vmproduct" class="vmproduct_new">
            <?php
            $cls_paquete = new cls_tbl_paquete();
            echo $cls_paquete->paquetes_relacionados_animado($categoria, 0, 4);
            ?>
        </ul>
        <div class="clear"></div>
    </div>
    <br><br>

</div>
<!--cierro content-->

<div class="clear"></div>

<?php
include("footer.php");
?>