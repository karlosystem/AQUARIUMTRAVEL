<?php
	require_once("aplication_top.php");	
	$cls_paquetes = new cls_tbl_paquete();
	#SEO
	$ThisCategory =  66;
	$cls_categoria_pl = new cls_tbl_categoria($ThisCategory);
	
	$title_categoria 	  	   = $cls_categoria_pl->gettxt_metatitle();
	$descripcion_categoria 	   = $cls_categoria_pl->gettxt_descripcion() ;
	$meta_categoria 	       = $cls_categoria_pl->gettxt_meta() ;
	$link_externo 			   = $cls_categoria_pl->gettxt_linkexterno();
	$Imagen 				   = $cls_categoria_pl->gettxt_imagen();
	
	if($page == 1 && is_numeric($page))
		$title_header_page = $cls_categoria_pl->gettxt_meta()." Pag. ".$page;
	else
		$title_header_page = "Tours en Iquitos y Hoteles de Selva en Iquitos";
		$keyword_header_page = "iquitos,selva,amazaonas,rio,programas turisticos,peru,fin de año nuevo 2015 en selva y ciudad";
		$description_header_page = "Programas y Tours en Iquitos, Iquitos Amazonas Jungla Tours.Iquitos Turismo Todo Incluido,Oferta de Paquetes Turísticos y Tours al Perú";
	
	include("header.php");
?>
<?php
		$cls_paquetes->setfk_categoria($ThisCategory);
		
		$page = $_GET['page'];
		if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
		$limit = 50;
		
		$array_where_count = array("int_status"=>1,
								   "fk_categoria"=>$ThisCategory);
		$total_itemspaquetes = count_entries('paquete', '', '',$array_where_count);
		$total_pages = ceil($total_itemspaquetes / $limit);
	
		$set_limit = $page * $limit - ($limit);
	
		if($total_itemspaquetes - $set_limit == 1)
		$page--;
		$str_paquete = $cls_paquetes->ListPaquetesCategoria($set_limit,$limit,$page);
?>

<div id="content">
	<div class="wrapper2">
		<div id="left">
			<div class="wrapper2">
				<div class="extra-indent">
					 <?php
                        include("body-left.php");
                    ?>							
            
			
			
			<div class="module_none">
			 <div class="boxIndent">
				 				<div class="wrapper">
				<div class="vmgroup_none">

				</div>
				</div>
			</div>
		</div>
	
										
									</div>
								</div>
							</div>
																		<div class="container">
						
<div class="moduletable_Breadcrumbs">
		<div class="breadcrumbs_Breadcrumbs">
			<a href="<?php echo _URL?>index.php" class="pathway">Inicio</a> &gt; 
            <a href="#" class="pathway"><?php print $title_categoria;?></a> &gt; 
            <!--Myrtle Beach<--></div>

		</div>

								<div class="content-indent">
									<h1 class="browse-view"><span><span><?php echo $title_categoria; ?></span></span></h1>
	

<div class="category_description">
	<p><?php echo $descripcion_categoria;?></p></div>


             
             
	<div id="tabs" class="tabs-position">
			<ul class="tabs">
				<li class="first"><a href="#tabs-1">&nbsp;</a></li>
				<li class="second"><a href="#tabs-2">&nbsp;</a></li>
				<li class="three"><a href="#tabs-3">&nbsp;</a></li>
			</ul>
	
	<div id="bottom-pagination" class="pag-bot"></div>	
	
	<div class="tab_container">
		<div id="tabs-1" class="tab_content">
			<div id="product_list">
					<div class="browse-view">
					<?php		
						echo $str_paquete;		
					?>
					</div> <!--end browse-view-->
			</div> <!--end product_list-->
	</div> <!--end tab_content-->
	
	<div id="bottom-pagination"></div>	
</div>
</div>
	
							</div>
											</div>
					<div class="clear"></div>
				</div>

					
				</div>
			<div class="clear"></div>
		<?php
	include("footer.php");
?>			