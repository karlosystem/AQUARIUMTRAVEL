<?php require_once("header.php"); ?>
<script language="javascript">
var MyForm = 'frm_listpasajes';
var urlProcess = 'proc_pasajes.php';
var IsRowSlow = 'rowpasaje_';
</script>

<?php
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
$limit = 50;

$total_itemspasajes = count_entries('pasajes', '','','');

$total_pages = ceil($total_itemspasajes / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemspasajes - $set_limit == 1)
$page--;

$SQL = "SELECT * FROM [|PREFIX|]pasajes ORDER BY txt_datepasaje DESC LIMIT $set_limit,$limit";

$pasajes = new cls_tbl_pasajes();
$resultado = $pasajes->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>

<div class="container_12">
	<div style="clear: both"></div>
    	<div class="bottom-spacing">
        		<!-- Button -->
                <div class="float-right">
                    <a href="frm_pasajes.php?do=create" class="button">
                        <span>Nuevo Ticket Aereo<img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Ticket" /></span>
                    </a>
                </div>
         </div> <!--fin bottom-spacing-->
         
       <!-- Example table -->
		<div class="module">
        <h2><span>Gesti&oacute;n de Pasajes Aereos | Total de registros: <?php print $total_itemspasajes?></span></h2>
         <?php 
		  #Paginacion
		  $filename = basename($_SERVER['PHP_SELF']);
		  $pagination = '';
		  if($total_itemspasajes - $set_limit == 1)
		  $page++;
		  $pagination = generate_smart_pagination($page, $total_itemspasajes, $limit, 1, $filename, $params_pag);
		 ?> 
          <div class="module-table-body">
         	<form action="" method="POST" name="frm_listpasajes" id="frm_listpasajes">
				<table id="myTable" class="tablesorter">
					<thead>
                        <tr>
                          <th width="50" height="25" align="center">
                          <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/></th>
                          <th width="60" align="center" >Orden</th>
                          <th width="190" align="center" >Destino</th>
                          <th width="114" align="center" >Precio</th>
                          <th width="273" align="center" >Imagen</th>
                          <th width="88" align="center">Fecha de Ingreso</th>
                          <th width="86" align="center">Estado</th>
                          <th width="68" align="center">Opciones              </th>
                    </tr>
                    </thead>
          <tbody>
			<?php 
			if($numFilas==0)	
			{  
			?>
			 <tr>
              <td colspan="8" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Vuelos Aereos</td>
            </tr>
           <?php } 
			else
			{
			$cint=1 ;
			$language = language::tep_get_languages();
			
			foreach ($resultado  as $array)	{
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$icono = "ico_estado".$array['int_estado'].".gif";
				
				$language_id = $language[0]['id'];
				$details_pasajes = cls_tbl_pasajes::get_pasajes_detalles($array['pk_pasaje'],$language_id);
				$destino = secure_sql($details_pasajes[0]['destino']);
				$precio =  secure_sql($details_pasajes[0]['precio']);
				
				$resize_img = base64_encode(ADMIN_IMG_PASAJE.$array['txt_imagen']);
			?>	
				<tr id="rowpasaje_<?php print $array['pk_pasaje']?>" class="GridRow" onmouseover="this.className='GridRowOver'" onmouseout="this.className='GridRow'">
				<td align="center">
				<input name="chkpasajes[]" id="pasajes[]" type="checkbox" value="<?php print $array['pk_pasaje']?>" />
				</td>
				 <td align="center"><?php print $cint;?></td>
				 <td align="left"><?php echo  $destino;?></td>
				 <td align="left"><?php echo  $precio;?></td>
				 <td align="left">
				 <img src="resize.php?image=<?php print $resize_img?>&h=160&w=170" /> 
				 </td>
				 <td align="center" >
				 <?php echo Date::convert($array['txt_datepasaje'],'Y-m-d','d-m-Y')?>
				 </td>
				 <td align="center" valign="middle" id="idEstado<?php print $array['pk_pasaje']?>" style="vertical-align:middle">
				  <a href="javascript:UpdateStatus(<?php echo  $array['pk_pasaje']?>)">
					  <img src="images/icons/<?php echo  $icono?>" border="0">
				  </a>
				 </td>				 
			     <td align="center">
				  <a target="_self" href="frm_pasajes.php?id=<?php print $array['pk_pasaje']?>" title="Haga click para actualizar la información del pasaje">
				  <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />              </a>
				  
				  <a href="javascript:eliminar(<?php print $array['pk_pasaje']?>,'<?php print $destino?>');" title="Haga click para eliminar el boleto aereo">
				  <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />              </a>              
			     </td>
				 
				</tr>
			<?php	
	  			$cint++;
				} 
	 		}
			?>
			
			</tbody>
		</table>	
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