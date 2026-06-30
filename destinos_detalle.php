<?php 
require_once("aplication_top.php");
$Cid = (int)$_GET['pid'];
$cls_destino = new cls_tbl_destino($Cid);

$meta_title = $cls_destino->gettxt_metatitle();
$meta_description = $cls_destino->gettxt_metadescription();

#SEO
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
        </div> <!--cierro left-->
        
        <div class="container">
        	<div class="error err-space">
				<div id="system-message-container">
				</div>
			</div>   
            
            <div class="content-indent">
				<div class="item-page">
					<h2><?php echo $meta_title;?></h2>
                    
                    	<div class="about">
                   		</div> <!--end about-->

 

                </div> <!--end item-page-->
            </div> <!--end content-indent-->        
            
            
            <div class="clear"></div>
        </div> <!--cierro container-->
	
    
     <div class="clear"></div>
	</div> <!--cierro wrapper2-->
</div> <!--cierro content-->



<div class="clear"></div>
<?php
	include("footer.php");
?>