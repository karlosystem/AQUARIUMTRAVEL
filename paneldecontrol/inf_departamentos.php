<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listdepartamento';
var urlProcess = 'inf_departamentos.php';
var IsRowSlow = 'rowcontact_';
</script>
<?php

$op = (int) (tep_not_null($_GET['op'])?$_GET['op']:$_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if($op>0) {
	switch($op)
	{
	  case 5:  #Remover locales-videos sólo los seleccioandos
	
		if(!empty($_POST["chkdepartamentos"]))
		{	
			foreach($_POST["chkdepartamentos"] as $valor)
			{		if($valor)
					{	
					  (int)$valor;
					  $SQL = "DELETE FROM [|PREFIX|]departamento WHERE pk_departamento='".$valor."' ";
					  $GLOBALS['CONNECT_DB']->Query($SQL);			
					}
			}		// foreach
		}
	  break;
	}
	header("Location:$IsReferrer");
}



$page = $_GET['page'];

if (empty($page) || !is_numeric($page) || $page < 0 )
$page = 1 ;
$limit = 20;

$total_pages = ceil($total_itemsdepartamento / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemsdepartamento - $set_limit == 1)
$page--;


$total_itemsdepartamento = count_entries('departamento', '','','');
$SQL = "SELECT [|PREFIX|]departamento.pk_departamento, [|PREFIX|]departamento.txt_descripcion, [|PREFIX|]departamento.int_estado, [|PREFIX|]departamento.fecha_registro, [|PREFIX|]departamento.txt_imagen, [|PREFIX|]departamento.txt_creacion, [|PREFIX|]countries.name as pais FROM [|PREFIX|]departamento LEFT JOIN  [|PREFIX|]countries ON [|PREFIX|]departamento.fk_pais = [|PREFIX|]countries.id ORDER BY [|PREFIX|]departamento.fk_pais DESC LIMIT $set_limit,$limit";

$departamentos = new cls_tbl_departamento();
$resultado = $departamentos->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>
<div class="container_12">
 	<div style="clear: both"></div>
		<div class="bottom-spacing">
			 
				<!-- Button -->
				<div class="float-right">
					<a href="frm_departamentos.php?do=create" class="button">
						<span>Nueva Ubicaci&oacute;n <img src="images/plus-small.gif" width="12" height="9" alt="Nueva Ubicaci&oacute;n" /></span>
					</a>
				</div>
				
				

			</div>
			
			<!-- Example table -->
		<div class="module">
			<h2><span>Gesti&oacute;n de Ubicaciones | Total de registros: <?php print $total_itemsdepartamento?></span></h2>
			<?php 
			  #Paginacion			  
			  $filename = basename($_SERVER['PHP_SELF']);
			  $pagination = '';			  
			  if($total_itemsdepartamento - $set_limit == 1)
			  $page++;
			  $pagination = generate_smart_pagination($page, $total_itemsdepartamento, $limit, 1, $filename, $params_pag);
			?> 
			<div class="module-table-body">
				<form action="" method="POST" name="frm_listdepartamento" id="frm_listdepartamento" >
					<table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
								  <th width="3%" align="center">
								  <input name="chkalldepartamento" type="checkbox" onclick="checkAll(this)"/>              </th>
								  <th width="3%" align="center">#</td>
								  <th width="29%">UBICACION</th>
								  <th width="29%">PAIS</th>
								  <th width="18%">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
							  <?php 
								if($numFilas==0)	
								{  
							?>
										<tr>
										  <td colspan="5" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Ubicaciones</td>
										</tr>
										<?php } // if
								else
								{							
										$cint=1 ;
										foreach ($resultado  as $array)	{
											$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
											$name_add = secure_sql($array['txt_descripcion']);
							  ?>
							   <tr id="rowdepartamento_<?php print $array['pk_departamento']?>">
									<td align="center"><input name="chkdepartamentos[]" type="checkbox" value="<?php print $array['pk_departamento']?>" id="chkdepartamentos[]" />				</td>
									
									<td><?php print $cint; ?></td>
									<td><?php echo  $array['txt_descripcion']?></td>
									<td><?php echo  $array['pais']?></td>
									 <td>
									<a title="Eliminar Registro" href="javascript:eliminar(<?php print $array['pk_departamento']?>,'<?php print $name_add?>');"><img src="images/minus-circle.gif"  width="16" height="16" alt="Eliminar Registro" /></a>
									<a title="Editar Registro" href="frm_departamentos.php?id=<?php print $array['pk_departamento']?>"><img src="images/pencil.gif"  width="16" height="16" alt="edit" /></a>
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