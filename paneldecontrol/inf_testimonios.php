<?php require_once("header.php"); ?>
<script language="javascript">
var MyForm = 'frm_listtestimonios';
var urlProcess = 'proc_testimonios.php';
var IsRowSlow = 'rowtestimonios_';
</script>

<?php
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
$limit = 20;

$total_itemstestimonios = count_entries('testimonios', '','','');

$total_pages = ceil($total_itemstestimonios / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemstestimonios - $set_limit == 1)
$page--;

$SQL = "SELECT * FROM [|PREFIX|]testimonios ORDER BY txt_datetestimonio DESC LIMIT $set_limit,$limit";

$testimonios = new cls_tbl_testimonios();
$resultado = $testimonios->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>
<div class="container_12">
 <div style="clear: both"></div>
<div class="bottom-spacing">
				<!-- Button -->
				<div class="float-right">
					<a href="frm_testimonios.php?do=create" class="button">
						<span>Nuevo Testimonio <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Testimonio" /></span>
					</a>
				</div>
				
				

			 </div>
			 
		<!-- Example table -->
		<div class="module">
			<h2><span>Gesti&oacute;n de Testimonios | Total de registros: <?php print $total_itemstestimonios?></span></h2>
			 <?php 
			  #Paginacion
			  $filename = basename($_SERVER['PHP_SELF']);
			  $pagination = '';
			  if($total_itemstestimonios - $set_limit == 1)
			  $page++;
			  $pagination = generate_smart_pagination($page, $total_itemsevento, $limit, 1, $filename, $params_pag);			  
		 	 ?>      
			 <div class="module-table-body">
				<form action="" method="POST" name="frm_listtestimonios" id="frm_listtestimonios">
					<table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
								  <th width="50" align="center"><input name="chkallregister" type="checkbox" onclick="checkAll(this)"/></th>
								  <th width="46" align="center" >Orden</th>
								  <th width="184" align="center" >Cliente</th>
								  <th width="342" align="center" >Mensaje</th>
								  <th width="88" align="center" >Imagen</th>
								  <th width="78" align="center"> Ingreso</th>
								  <th width="69" align="center">Estado</th>
								  <th width="18%">Opciones              </th>
                                </tr>
                            </thead>
                            <tbody>							
							<?php 
							if($numFilas==0)	
							{  
							?>
							 <tr bgcolor="#FFFFFF" height="30">
							  <td colspan="8" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">
							  No hay resultado de Testimonios</td>
							</tr>
						   <?php } 
							else
							{
							$cint=1 ;
							$language = language::tep_get_languages();
							foreach ($resultado  as $array)	{
								$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
								$icono = "ico_estado".$array['int_estado'].".gif";				
								$resize_img = base64_encode(ADMIN_IMG_TESTIMONIO.$array['txt_imgthumb']);								
								$language_id = $language[0]['id'];
								$details_testimonio = cls_tbl_testimonios::get_testimonios_detail($array['pk_testimonios'],$language_id);
								$cliente_testimonio = secure_sql($details_testimonio[0]['testimonio_txt_title']);
								$cliente_mensaje = secure_sql($details_testimonio[0]['testimonio_txt_content']);							
							?>	
							<tr id="rowtestimonios_<?php print $array['pk_testimonios']?>">
							
							<td align="center"><input name="chktestimonio[]" id="chktestimonio[]" type="checkbox" value="<?php print $array['pk_testimonios']?>" /></td>
							<td align="center"><?php print $cint;?></td>
							<td><?php print $cliente_testimonio;?></td>
							<td><?php print $cliente_mensaje;?></td>
							<td align="center">
							 <img src="resize.php?image=<?php print $resize_img?>&h=60&w=70" />  
							</td>
							<td align="center">
							 <?php echo Date::convert($array['txt_datetestimonio'],'Y-m-d','d-m-Y')?>
							</td>
							<td align="center" id="idEstado<?php print $array['pk_testimonios']?>">
							  <a href="javascript:UpdateStatus(<?php echo  $array['pk_testimonios']?>)">
								  <img src="images/icons/<?php echo  $icono?>" border="0">
							  </a>
				 			</td>			
							 <td>
									<a title="Eliminar Registro" href="javascript:eliminar(<?php print $array['pk_testimonios']?>,'<?php print $cliente_testimonio?>');"><img src="images/minus-circle.gif"  width="16" height="16" alt="Eliminar Registro" /></a>
									<a title="Editar Registro" href="frm_testimonios.php?id=<?php print $array['pk_testimonios']?>"><img src="images/pencil.gif"  width="16" height="16" alt="edit" /></a>
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
