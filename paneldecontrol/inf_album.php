<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listalbum';
var urlProcess = 'proc_album.php';
var IsRowSlow = 'rowalbum_';
</script>
<?php
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
$limit = 20;


$total_itemsalbum = count_entries('album', '','','');
$total_pages = ceil($total_itemsalbum / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemsalbum - $set_limit == 1)
$page--;




$SQL = "SELECT * FROM [|PREFIX|]album   ORDER BY album_fecha DESC LIMIT $set_limit,$limit";

$album = new cls_tbl_album();
$resultado = $album->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>


<!--  Content  -->
<div class="container_12">
 <div style="clear: both"></div>
	<div class="bottom-spacing">
		
				<!-- Button -->
		<div class="float-right">
			<a href="frm_album.php?do=create" class="button">
				<span>Nuevo Album <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Album" /></span>
			</a>
		</div>
		
		<div class="module">
			<h2><span>Gesti&oacute;n de Album de Fotos | Total de registros: <?php print $total_itemsalbum?></span></h2>
			<?php 
				  #Paginacion
				  $filename = basename($_SERVER['PHP_SELF']);
				  $pagination = '';
				  if($total_itemsevento - $set_limit == 1)
				  $page++;
				  $pagination = generate_smart_pagination($page, $total_itemsalbum, $limit, 1, $filename, $params_pag);
				  
			 ?> 
			
			
<div class="module-table-body">		
<form action="" method="POST" name="frm_listalbum" id="frm_listalbum">
<table id="myTable" class="tablesorter">
<thead>
            <tr>
              <th width="3%" height="25" align="center">
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th>
              <th width="7%" align="center" class="">Orden</th>
              <th width="27%" align="center" class="">Titulo del ALBUM</th>
              <th width="9%" align="center" class="">IMAGENES </th>
              <th width="14%" align="center" class="">FECHA DEL ALBUM</th>
              <th width="15%" class="" align="center">Fecha de registro</th>
              <th width="12%" class="" align="center">Publicaci&oacute;n</th>
              <th width="13%" class="" align="center">Opciones              </th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="10" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de album</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			$language = language::tep_get_languages();
			
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$icono = "ico_estado".$array['album_status'].".gif";
				
				
				$language_id = $language[0]['id'];
				$details_album = $album->get_album_detail($array['pk_album'],$language_id);
				
				$title_album = secure_sql($details_album[0]['album_txt_title']);
				
				
				$resize_img = base64_encode(ADMIN_BANNERS.$array['txt_imagen']);
				
				
                $albumcls_create = new cls_tbl_album($array['pk_album']);
				$countimg = (int)$albumcls_create->countgalleryalbum_list();
				//print $countimg ;
				
                  
  ?>
            <tr class="GridRow" onmouseover="this.className='GridRowOver'" onmouseout="this.className='GridRow'" id="rowalbum_<?php print $array['pk_album']?>">
              <td align="center" valign="middle" style="vertical-align:middle;" ><input name="chkalbum[]" type="checkbox" value="<?php print $array['pk_album']?>" id="chkalbum[]" /></td>
              <td height="20" align="center" valign="middle"   ><?php print $cint;?></td>
              <td height="20" align="left" valign="middle"  >
			  <?php print $title_album;?>              </td>
              <td height="20" align="center" valign="middle"  >
			  <?php echo  $countimg;?></td>
              <td height="20" align="center" valign="middle"  ><?php echo  $array['album_fecha']?></td>
              <td height="20" align="center" valign="middle"  ><?php print $array['album_dateadd']?></td>
              
              <td align="center" valign="middle"   id="idEstado<?php print $array['pk_album']?>">
              <a href="javascript:UpdateStatus(<?php echo  $array['pk_album']?>)">
                  <img src="images/icons/<?php echo  $icono?>" border="0">              </a>              </td>
              
              <td height="20" align="center" valign="middle"   >
              
              <a href="inf_albumg.php?id=<?php print $array['pk_album']?>" title="Haga click añadir imagenes al album">
              <img src="images/icons/ico_add.gif"  width="16" height="16"  border="0" />              </a>
              
              <a href="frm_album.php?id=<?php print $array['pk_album']?>" title="Haga click para actualizar la información del album">
              <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />              </a>
              
              <a href="javascript:eliminar(<?php print $array['pk_album']?>,'<?php print $title_album?>');" title="Haga click para remover el banner">
              <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />              </a>              </td>
            </tr>
            <?php	
	  		$cint++;
			} 
			
			if($total_itemsalbum - $set_limit == 1)
	        $page++;

	 } //else?>
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