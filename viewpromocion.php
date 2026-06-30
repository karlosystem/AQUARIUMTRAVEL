<?php
	require_once("aplication_top.php");	
	$IdPromocion = (int)$_GET['cid'];
	$title_header_page = _TITLE_PASAJES;
	$description_header_page = _TITLE_DESCRIPTION_PASAJES;
	$keyword_header_page = _TITLE_KEYWORD_PASAJES;
	include("header.php");
?>
<link rel="stylesheet" href="<?php echo _URL?>css/galeria.css" type="text/css" />
<div id="content">
    <div class="wrapper2">  
        <div class="container" align="center" style="width:950px;">
         	<div align="center" class="discographyWrap">
				<div align="center" class="row_block first">
                <center>
		<?php
            $link=mysql_connect("localhost","aquarium_reg97","aoe1997aoeTT@");
            mysql_select_db("aquarium_corporativo",$link);
			$SQL = "SELECT paquete_id, cliente_id, paquete_title, paquete_subject, paquete_content, paquete_footer, paquete_attachment, paquete_url, priority_id, paquete_dateadd FROM tbl_paquete WHERE paquete_id='".$IdPromocion."'";
			
			$result = mysql_query($SQL, $link); 

			if ($row = mysql_fetch_array($result)){ 
				$titulo = $row['paquete_subject'];
				$folder_complete = _URL."corporativo/cliente/uploads/";
				$Img = $row['paquete_attachment'];
				#$img_thumb = base64_encode($folder_complete.$Img);
				$img_thumb = $folder_complete.$Img;
				print "<img src=\"$img_thumb\">";
			}
			

		?>
        	</center>
        	</div>
          </div>
          		<a href="<?php echo _URL?>cotizaciones.php" target="_self"><img src="images/Boton-Contactenos.png"></a>
            
				<div class="clear"></div>
        </div> <!--cierro container-->
     <div class="clear"></div>
	</div> <!--cierro wrapper2-->
</div> <!--cierro content-->




<?php
	include("footer.php");
?>