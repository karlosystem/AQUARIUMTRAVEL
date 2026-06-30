<?php
require_once("header.php");

$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
$limit = 20;


$total_itemseccion = count_entries('seccion', '','','');


$total_pages = ceil($total_itemseccion / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemseccion - $set_limit == 1)
$page--;

$SQL = "SELECT * FROM [|PREFIX|]seccion ORDER BY txt_orden ASC LIMIT $limit";

$album = new cls_tbl_seccion();
$resultado = $album->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);


?>

<script language="javascript">
var MyForm = 'frm_listaseccion';
var urlProcess = 'proc_seccion.php';
var IsRowSlow = 'rowseccion_';
</script>


<!--  Content  -->
<div class="container_12">
	<div style="clear: both"></div>
		<div class="module">
		<h2><span>Gesti&oacute;n de Secciones | Total de registros: <?php print $total_itemseccion?></span></h2>
		 <?php 
      #Paginacion
	  
	  $filename = basename($_SERVER['PHP_SELF']);
      $pagination = '';
	  $pagination = generate_smart_pagination($page, $total_itemseccion, $limit, 1, $filename, $params_pag);
	  if(tep_not_null($pagination)){
	  echo "<div id=\"div-group-pagination\">";
	  echo $pagination ;
	  echo "</div>";
	  }
	  ?>      
	  <div class="module-table-body">


<form action="" method="POST" name="frm_listaseccion" id="frm_listaseccion">
<table id="myTable" class="tablesorter">
<thead>
            <tr>
              <th width="3%" height="25" align="center" >
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/> </th>
              <th width="9%" align="center">Orden</th>
              <th width="32%" align="left">SECCIÓN</th>
              <th width="31%" align="left">ENLACE</th>              
              <th align="center">Estado de la Publicaci&oacute;n</th>
              <th width="11%" align="center">Opciones</th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="8" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de album</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$icono = "ico_estado".$array['int_estado'].".gif";
				$title_album = secure_sql($array['txt_nombre']);
				$resize_img = base64_encode(ADMIN_BANNERS.$array['txt_imagen']);
				
				//print $countimg ;
				
                  
  ?>
            <tr class="GridRow" onmouseover="this.className='GridRowOver'" onmouseout="this.className='GridRow'"  id="rowseccion_<?php print $array['pk_seccion']?>">
              <td align="center" valign="middle" ><input name="chkseccion[]" type="checkbox" value="<?php print $array['pk_seccion']?>" id="chkseccion[]" /></td>
              <td align="center" valign="middle" class="td_list"><?php print $cint;?></td>
              <td align="left" valign="middle" class="td_list">
			  <?php echo  $array['txt_nombre']?>              </td>
              <td align="left" valign="middle" class="td_list" ><?php echo  $array['txt_url']?></td>
              <td align="center" class="td_list" id="idEstado<?php print $array['pk_seccion']?>">
              <a href="javascript:UpdateStatus(<?php echo  $array['pk_seccion']?>)">
                  <img src="images/icons/<?php echo  $icono?>" border="0"> </a>
              </td>
              <td align="center" class="td_list">
           
              <a href="frm_seccion.php?id=<?php print $array['pk_seccion']?>" title="Haga click para actualizar la información del album">
              <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />
              </a>         
              <a href="javascript:eliminar(<?php print $array['pk_seccion']?>,'<?php print $title_album?>');" title="Haga click para remover el banner">
              <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" /></a>
              </td>
            </tr>
            <?php	
	  		$cint++;
			} 
			
			if($total_itemseccion - $set_limit == 1)
	        $page++;

	 } //else?>
          <tr>
            <td colspan="9">
              <div class="div_buttonslist">
 
               <a class="button" href="#" onclick="javascript:eliminar_todos();"><span>Eliminar</span></a>
               <a class="button" href="#" onclick="javascript:activar_todos();"><span>Activar</span></a>
               <a class="button" href="#" onclick="javascript:desactivar_todos();"><span>Desactivar</span></a>
               <a class="button" href="frm_seccion.php?do=create"><span>Agregar / Crear</span></a> 
              </div> 
             </td>
          </tr>
          </tbody>
      </table>
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