<?php require_once("header.php"); ?>
<script language="javascript">
var MyForm = 'frm_listads';
var urlProcess = 'proc_ads.php';
var IsRowSlow = 'rowbanner_';
</script>

<?php
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
$limit = 10;

$total_itemscontact = count_entries('banner', '','','');

$total_pages = ceil($total_itemscontact / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemscontact - $set_limit == 1)
$page--;


$SQL = "SELECT * FROM [|PREFIX|]banner ORDER BY int_position ASC LIMIT $set_limit,$limit";

$banner = new cls_tbl_banner();
$resultado = $banner->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>
	<div class="container_12">
		<div style="clear:both;"></div>
		<div class="grid_12">
			<span class="notification n-information">El formato de los banners deberan ser jpg, las medidas son el pixeles.  </span>
		</div>
		
		<div style="clear: both"></div>
		<div class="bottom-spacing">
		<!-- Button -->
		<div class="float-right">
			<a href="frm_banner.php?do=create" class="button">
				<span>Nuevo Banner <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Banner" /></span>
			</a>
		</div>
		
		<!-- Table records filtering -->
		<!--Buscar: 
		<select class="input-short">
			<option value="1" selected="selected">Tipo de Banner</option>
			<option value="2">Created last week</option>
			<option value="3">Created last month</option>
			<option value="4">Edited last week</option>
			<option value="5">Edited last month</option>
		</select>
		-->
		</div>
		
		<!-- Example table -->
		<div class="module">
			<h2><span>Gesti&oacute;n de Bannners | Total de registros: <?php print $total_itemscontact?></span></h2>
			 <?php 
				  #Paginacion
				  $filename = basename($_SERVER['PHP_SELF']);
				  $pagination = '';
				  if($total_itemscontact - $set_limit == 1)
				  $page++;
				  $pagination = generate_smart_pagination($page, $total_itemscontact, $limit, 1, $filename, $params_pag);				  
			 ?>  
			 
			 <div class="module-table-body">
			 	<form action="" method="POST" name="frm_listads" id="frm_listads" enctype="multipart/form-data">
			 		<table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
								  <th width="2%" align="center">
								  <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th>
								  <th width="5%" align="center">Orden</th>
								  <th width="22%" align="center">Titulo del Banner</th>
								  <th width="12%" align="center">Enlace</th>
								  <th width="5%" align="center">Tipo</th>
								  <th width="16%" align="center">Vista Previa</th>
								  <th width="13%" align="center">Ingreso</th>
								  <th width="13%" align="center">Actualiza</th>
								  <th width="13%" align="center">Estado</th>
								  <th width="18%">Opciones              </th>
                                </tr>
                            </thead>
                            <tbody>
							 <?php 
								if($numFilas==0)	
								{  
							?>
										<tr>
										  <td colspan="9" align="center">No hay resultado de banner</td>
										</tr>
										<?php } // if
								else
								{							
										$cint=1 ;
										$language = language::tep_get_languages();
										foreach ($resultado  as $array)	{
											$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
											$icono = "ico_estado".$array['int_estado'].".gif";
											$language_id = $language[0]['id'];
											$details_banner = cls_tbl_banner::get_banner_detail($array['pk_banner'],$language_id);
											$name_add = secure_sql($details_banner[0]['banner_txt_title']);
											
											$resize_img = base64_encode(DIR_WS_ADMIN_LANGUAGES.$language[0]['directory'].'/'._BANNERS.$details_banner[0]['banner_txt_imagen']);
							  ?>
							  <tr id="rowbanner_<?php print $array['pk_banner']?>">
							  <td align="center"><input name="chkbanner[]" type="checkbox" value="<?php print $array['pk_banner']?>" /></td>
							  <td align="center"><?php print $array['int_orden'];?></td>
							  <td><?php echo  $details_banner[0]['banner_txt_title']?></td>
							  <td><?php echo  $array['txt_url']?></td>
							  <td><?php echo  $array['int_position']?></td>
							  <td align="center">
			  					<img src="resize.php?image=<?php print $resize_img?>&h=160&w=190" />              
							  </td>
							  <td align="center">			  		  
			  					<?php echo Date::convert($array['date_add'],'Y-m-d','d-m-Y')?>			  
			  				  </td>
							   <td align="center">			  		  
			  					<?php echo Date::convert($array['reg_update'],'Y-m-d','d-m-Y')?>			  
			  				  </td>
							  <td align="center" id="idEstado<?php print $array['pk_banner']?>">
							  <a href="javascript:UpdateStatus(<?php echo  $array['pk_banner']?>)">				
								  <img src="images/icons/<?php echo  $icono?>" border="0">
							  </a>
							  </td>
							  <td>
							<a title="Eliminar Registro" href="javascript:eliminar(<?php print $array['pk_banner']?>,'<?php print $name_add?>');"><img src="images/minus-circle.gif"  width="16" height="16" alt="Eliminar Registro" /></a>
							<a title="Editar Registro" href="frm_banner.php?id=<?php print $array['pk_banner']?>"><img src="images/pencil.gif"  width="16" height="16" alt="edit" /></a>
							<a href=""><img src="images/balloon.gif"  width="16" height="16" alt="comments" /></a>
							<a href=""><img src="images/bin.gif"  width="16" height="16" alt="delete" /></a>
                              </td>
							  
							  
							 
							  
							  </tr>
				 					<?php	
									$cint++;
									} 
							 }?>
							</tbody>
					</table>		
				</form>
				
				
						<div class="pager" id="pager">
                            <form action="">
                                <div>
                                <?php if(tep_not_null($pagination)){?>							  
								  <?php
								  print "<div id=\"div-group-pagination\">";
								  print $pagination ;
								  print "</div>";
								  ?>
							   <?php } ?>
                                </div>
                            </form>
                        </div>
						
						
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<!--  Footer  -->
<?php
require_once("footer.php");
?>