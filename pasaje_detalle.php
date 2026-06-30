<?php
require_once("aplication_top.php");
$Cid = (int)$_GET['pid'];
$cls_pasajes = new cls_tbl_pasajes($Cid);
$PasajesDetails = $cls_pasajes->get_pasajes_detalles($Cid);
$title_secure = $PasajesDetails[0]['destino'];
$Description  = $PasajesDetails[0]['detalle'];
$Precio  = $PasajesDetails[0]['precio'];
$Img = $cls_pasajes->gettxt_imagen();

#SEO
$title_header_page = $cls_pasajes->gettxt_metatitle();
$keyword_header_page = $meta_keyword;
$description_header_page = $cls_pasajes->gettxt_metadescription();

#VISTAS
$GLOBALS['CONNECT_DB']->Query("update [|PREFIX|]pasajes set int_visto = int_visto + 1 WHERE pk_pasaje = '" . $Cid  . "'");

include("header.php");
?>

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
        <!--cierro left-->

        <div class="container">
            <div class="error err-space">
                <div id="system-message-container">
                </div>
            </div>

            <div class="content-indent">
                <div class="item-page">
                    <h2 style="background-color: #F90197;"><?php print $title_secure; ?></h2>

                    <div class="about">
                        <center>
                            <?php
                            $folder_complete = _URL . PUBLIC_IMG_PASAJE;
                            $img_thumb = $folder_complete . $Img;
                            ?>
                            <img src="<?php print $img_thumb; ?>">
                        </center>

                        <br>

                        <?php print $Description; ?>
                        <br /><br />
                        <span style="text-align:left; color:#C00; font-size:16px; font-weight:800; font-family:Verdana, Geneva, sans-serif;"><?php print "Precio IDA/VUELTA US$ " . $Precio; ?></span>

                        <center>
                            <br><br>
                            <a href="https://wa.me/51936545254?text=¡Hola!%20requiero%20información%20de%20la%20oferta%20que%20visualizo%20en%20su%20página%20web%20Aquarium%20Travel%20:%0D%0A<?php print $title_secure; ?>" target="_new">
                                <img src="<?php echo _URL ?>images/whatsapp-chat-min.jpg">
                            </a>
                        </center>

                    </div>
                    <!--end about-->



                </div>
                <!--end item-page-->
            </div>
            <!--end content-indent-->


            <div class="clear"></div>
        </div>
        <!--cierro container-->


        <div class="clear"></div>
    </div>
    <!--cierro wrapper2-->
</div>
<!--cierro content-->



<div class="clear"></div>
<?php
include("footer.php");
?>