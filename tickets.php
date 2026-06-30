<?php
require_once("aplication_top.php");
$title_header_page = _TITLE_PASAJES;
$description_header_page = _TITLE_DESCRIPTION_PASAJES;
$keyword_header_page = _TITLE_KEYWORD_PASAJES;
include("header.php");
?>
<link rel="stylesheet" href="<?php echo _URL ?>css/tabla.css" type="text/css" />
<div id="content">
    <div class="wrapper2">
        <div id="left" style="width:290px; background-color:#FFFFFF;">
            <div class="wrapper2">
                <div class="extra-indent" style="background-color:#FFFFFF;">
                    <div class="module_address" style="background-color:#FFFFFF;">
                        <div class="boxIndent" style="background-color:#FFFFFF; text-align:justify; font-size:12px;">
                            <img src="images/vuelos-con-aquarium-travel.jpg"><br /><bR />
                            <img src="images/azafatas_y_pilotos.jpg" />
                            <br /><br />
                            <div align="center"><strong><span style="color:#CC3300; text-align:center;">Reserve Su Vuelo Con Las Mejores Tarifas A Nivel Mundial!!!</span></strong></div>
                            <strong>RPM: #920044236 (Whastapp) / #920044265<br />
                                RPC: 936545254 (Whastapp)</strong>

                            <br /><br />
                            <center>
                                <a href="https://bit.ly/Aquariumtravel" target="_new">
                                    <img src="images/whatsapp-chat-min.jpg">
                                </a>
                            </center>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container" style="border:1px solid #EBEBE9; height:620px; background-color:#f4f4f4; width:640px; float:right;">

            <table class="bordered">
                <thead>
                    <tr>
                        <th style="background-color: #F90197;" colspan="2">Vuelos Internacionales</th>
                    </tr>
                </thead>
                <?php
                $class_pasajes = new cls_tbl_pasajes();
                print $class_pasajes->portada_pasajes("Internacional");
                ?>
            </table>

            <table class="bordered">
                <thead>
                    <tr>
                        <th style="background-color: #F90197;" colspan="2">Vuelos Nacionales</th>
                    </tr>
                </thead>
                <?php
                $class_pasajes = new cls_tbl_pasajes();
                print $class_pasajes->portada_pasajes("Nacional");
                ?>

            </table>
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