<?php
	require_once("aplication_top.php");	
	$title_header_page = _TITLE_OFERTAS;
	$description_header_page = _TITLE_DESCRIPTION_OFERTAS;
	$keyword_header_page = _TITLE_KEYWORD_OFERTAS;
	include("header.php");
?>
<link rel="stylesheet" href="<?php echo _URL?>css/galeria.css" type="text/css" />
<div id="content">
    <div class="wrapper2">  
        <div class="container" style="width:950px;">
         	<div class="discographyWrap">
				<div class="row_block first">
		<?php
            $link=mysql_connect("localhost","aquarium_reg97","aoe1997aoeTT@");
            mysql_select_db("aquarium_corporativo",$link);
            $rows=mysql_query("SELECT * FROM tbl_paquete ORDER BY paquete_dateadd DESC");
            $totalregistros=mysql_num_rows($rows);
            $strgal_album = "";
			while($row=mysql_fetch_array($rows)){			
				 $Title = $row['paquete_subject'];
				   if(_SEOMOD==1){
						$link_promociones = _URL."promocion/viaje-".safename($Title)."-pid-".$row['paquete_id']."."._FEXT;
					}else{
						$link_promociones = _URL.'promocion_detalle.php?pid='.$row['paquete_id'];
				   }
				   $folder_complete = "corporativo/cliente/uploads/";
				   $Img = $row['paquete_attachment'];
				   $img_thumb = base64_encode($folder_complete.$Img);
				   
				    $strgal_album .= "<div class=\"single_block\">";
				    $strgal_album .= "	<span>".fecha_spanish($row['paquete_dateadd'])."</span>";
				    $strgal_album .= "	   <div class=\"top_image\">";
					$strgal_album .= "<center>";	
					
					if(_SEOMOD==1){
							$link_paquete = _URL."ofertas-".clean_url($Title)."-pid-".$row['paquete_id']."."._FEXT;
						}else{
							$link_paquete = _URL.'viewpromocion.php?pid='.$row['paquete_id'];
					}
								
					$strgal_album .= "<a href=\"$link_paquete\">";			
					$strgal_album .= tep_image(_URL.'resize.php?image='.$img_thumb.'&w=279&h=380&IsCrop=0',$Title,'','','class="bordercolor"');
					$strgal_album .= "    	</a>";
					$strgal_album .= "</center>";
					$strgal_album .= "	   </div>";
					$strgal_album .= "	    <div class=\"bottom\">";
					$strgal_album .= "        <a href=\"$link_paquete\" class=\"title\" target=\"_blank\">".$Title."</a>";
					#$strgal_album .= "        <a href=\""._URL."viewpromocion.php?cid={$row['paquete_id']}\" title=\"$title\" style=\"float:right; margin-top: 5px;\" class=\"pin-it-button\" count-layout=\"horizontal\"><img border=\"0\" src=\"images/boton-ampliar-informacion.png\" title=\"Pin It\"></a>";
					$strgal_album .= "    </div>";
					#$strgal_album .= "	<div class=\"itunes_btn\"><a href=\"#\" target=\"_blank\"><img src=\"images/boton-ampliar-informacion.png\"></a></div>";
					$strgal_album .= "</div>";
			} #cierro while
			print $strgal_album;
		?>
        	</div>
          </div>
          
            
		<div class="clear"></div>
				<div class="discographyWrap">
					<div class="row_block first">
						
                    
                    </div>
                </div>    
            <div class="clear"></div>
        </div> <!--cierro container-->
     <div class="clear"></div>
	</div> <!--cierro wrapper2-->
</div> <!--cierro content-->



<div class="clear"></div>
<?php
	include("footer.php");
?>