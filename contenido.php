<?php
require_once("aplication_top.php");
$Cid = (int)$_GET['cid'];
$cls_noticias = new cls_tbl_contenido($Cid);
$Img = $cls_noticias->gettxt_imagen();
$LangDetails = $cls_noticias->get_page_detail($Cid);
$title_secure = $LangDetails[0]['page_txt_title'];
$content = utf8_decode($LangDetails[0]['page_txt_content']);
$meta_title = utf8_decode($LangDetails[0]['page_txt_metatitle']);
$meta_description = utf8_decode($LangDetails[0]['page_txt_metadescription']);



$datenotice = $cls_noticias->gettxt_dateadd();

$cls_date = new dateconvert_language;
$cls_date->language = $languages_code;

$title_header_page = $meta_title;
$description_header_page = $meta_description;


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
                        <?php print $content; ?>
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