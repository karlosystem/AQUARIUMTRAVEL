<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frmcontent';
var urlProcess = 'proc_content.php';
var IsRowSlow = 'rowcontent_';
</script>
<?php

$page = $_GET['page'];

if (empty($page) || !is_numeric($page) || $page < 0 )
$page = 1 ;

$limit = 40;

$total_itemscontent = count_entries('contenido', '','','');

$total_pages = ceil($total_itemscontent / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemscontent - $set_limit == 1)
$page--;




$SQL = "SELECT * FROM tbl_contenido LIMIT $set_limit,$limit";

$contenido = new cls_tbl_contenido();
$resultado = $contenido->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>

<div class="container_12">
 	<div style="clear: both"></div>
		<div class="bottom-spacing">
		
		<!-- Button -->
		<div class="float-right">
			<a href="frm_content.php?do=create" class="button">
				<span>Nuevo Contenido <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Contenido" /></span>
			</a>
		</div>
		
		
		
		</div> <!--fin bottom-spacing-->
		
		<!-- Example table -->
		<div class="module">
			<h2><span>Gesti&oacute;n de Contenidos | Total de registros: <?php print $total_itemscontent?></span></h2>
				  <?php 
				  #Paginacion
				  
				  $filename = basename($_SERVER['PHP_SELF']);
				  $pagination = '';
				  
				  if($total_itemscontent - $set_limit == 1)
				  $page++;
				  $pagination = generate_smart_pagination($page, $total_itemscontent, $limit, 1, $filename, $params_pag); 
				  ?>
				  
				  <div class="module-table-body">
				  	<form action="" method="POST" name="frmcontent" id="frmcontent" >
						<table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
								  <th width="3%" height="25" align="center">
								  <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th>
								  <th width="2%">#</th>
								  <th width="42%">TÍTULO DE LA PÁGINA </th>
								  <th width="14%">IMAGEN ADICIONAL </th>
								  <th width="13%">FECHA DE CREACIÓN</th>
								  <th width="8%">PUBLICAR</th>
								  <th width="18%">Opciones              </th>
                                </tr>
                            </thead>
                            <tbody>
							
							  <?php 
									if($numFilas==0)	
									{  
								?>
											<tr>
											  <td colspan="7" align="center">No hay resultado de contacto</td>
											</tr>
											<?php } // if
									else
									{
								
											$cint=1 ;
											$language = language::tep_get_languages();
											
											foreach ($resultado  as $array)	{
												//$color = inc_color($sw); 
												$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
												$icono = "ico_estado".$array['int_estado'].".gif";
												
												$language_id = $language[0]['id'];
												$details_page = cls_tbl_contenido::get_page_detail($array['pk_content'],$language_id);
												$name_page = secure_sql($details_page[0]['page_txt_title']);												
												$resize_img = base64_encode(ADMIN_IMG_PAGE.$array['txt_imagen']);
								  ?>
								  
								  <tr id="rowcontent_<?php print $array['pk_content']?>" class="GridRow" onmouseover="this.className='GridRowOver'" onmouseout="this.className='GridRow'">
								    <td align="center"><input name="chkcontent[]" type="checkbox" value="<?php print $array['pk_content']?>" id="chkcontent[]" /></td>
								    <td align="center">
									   <?php
									   print $cint;
									   ?>			  
									</td>
									<td><?php print  $name_page?></td>
								    <td align="center"><?php print tep_image("resize.php?image=$resize_img&w=80&h=50");?></td>
									<td align="center"><?php echo  $array['txt_dateadd']?></td>
									<td align="center" id="idEstado<?php print $array['pk_content']?>">
									   <a href="javascript:UpdateStatus(<?php echo  $array['pk_content']?>)">
										 <img src="images/icons/<?php echo  $icono?>" border="0">              </a>              
				 					</td>
									<td>
                                        <a title="Eliminar Registro" href="javascript:eliminar(<?php print $array['pk_content']?>,'<?php print $name_hoteles?>');"><img src="images/minus-circle.gif"  width="16" height="16" alt="Eliminar Registro" /></a>
                                        <a title="Editar Registro" href="frm_content.php?id=<?php print $array['pk_content']?>"><img src="images/pencil.gif"  width="16" height="16" alt="edit" /></a>
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
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<!--  Footer  -->
<?php
require_once("footer.php");
?>