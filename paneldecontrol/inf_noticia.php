<?php require_once("header.php"); ?>
<script language="javascript">
var MyForm = 'frm_listnoticia';
var urlProcess = 'proc_noticia.php';
var IsRowSlow = 'rownoticia_';
</script>

<?php
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
$limit = 20;


$total_itemsevento = count_entries('noticia', '','','');

$total_pages = ceil($total_itemsevento / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemsevento - $set_limit == 1)
$page--;



//$total_itemsevento = count_entries('banner', '','','');
$SQL = "SELECT * FROM [|PREFIX|]noticia ORDER BY txt_datenoticia DESC LIMIT $set_limit,$limit";

$noticia = new cls_tbl_noticia();
$resultado = $noticia->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>
<div class="container_12">
	 <div style="clear: both"></div>
	 	<div class="bottom-spacing">
			<!-- Button -->
			<div class="float-right">
				<a href="frm_noticia.php?do=create" class="button">
					<span>Nueva Noticia<img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Hotel" /></span>
				</a>
			</div>
		
			<div class="module">
			<h2><span>Gesti&oacute;n de Noticias | Total de registros: <?php print $total_itemsevento?></span></h2>
			 <?php 
				  #Paginacion
				  $filename = basename($_SERVER['PHP_SELF']);
				  $pagination = '';
				  if($total_itemsevento - $set_limit == 1)
				  $page++;
				  $pagination = generate_smart_pagination($page, $total_itemsevento, $limit, 1, $filename, $params_pag);
				  
			 ?> 
			<div class="module-table-body">
<form action="" method="POST" name="frm_listnoticia" id="frm_listnoticia">
<table id="myTable" class="tablesorter">
<thead>
            <tr>
              <th width="55" height="25" align="center">
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th>
              <th width="64" align="center" >Orden</th>
              <th width="272" align="center" >Destino</th>
              <th width="139" align="center" >Imagen</th>
              <th width="139" align="center">Fecha</th>
              <th width="139" align="center">Estado</th>
              <th width="120" align="center">Opciones              </th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr>
              <td colspan="9" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de noticias</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			$language = language::tep_get_languages();
			
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$icono = "ico_estado".$array['int_status'].".gif";
				
				$language_id = $language[0]['id'];
				$details_notice = cls_tbl_noticia::get_notice_detail($array['pk_noticia'],$language_id);
				$name_notice = secure_sql($details_notice[0]['notice_txt_title']);
				
				//$name_add = secure_sql($array['txt_titulo']);
				$resize_img = base64_encode(ADMIN_PHOTOBIG_NOTICIA.$array['txt_image']);
  ?>
            <tr id="rownoticia_<?php print $array['pk_noticia']?>" class="GridRow" onmouseover="this.className='GridRowOver'" onmouseout="this.className='GridRow'">
              <td align="center" valign="middle" style="vertical-align:middle"><input name="chknoticia[]" id="chknoticia[]" type="checkbox" value="<?php print $array['pk_noticia']?>" /></td>
              <td align="center" valign="middle" style="vertical-align:middle"><?php print $cint;?></td>
              <td align="left" valign="middle" style="vertical-align:middle"><?php echo  $name_notice?></td>
              <td align="center" valign="middle" style="vertical-align:middle">
			  <img src="resize.php?image=<?php print $resize_img?>&h=60&w=70" />              </td>
              <td align="center" valign="middle" style="vertical-align:middle"><?php print $array['txt_datenoticia']?></td>
              
              <td align="center" valign="middle" id="idEstado<?php print $array['pk_noticia']?>" style="vertical-align:middle">
              <a href="javascript:UpdateStatus(<?php echo  $array['pk_noticia']?>)">

                  <img src="images/icons/<?php echo  $icono?>" border="0">
              </a>
              </td>
              
              <td align="center" valign="middle"  style="vertical-align:middle">
              <a href="frm_noticia.php?id=<?php print $array['pk_noticia']?>" title="Haga click para actualizar la información de la noticia">
              <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />              </a>
              
              <a href="javascript:eliminar(<?php print $array['pk_noticia']?>,'<?php print $name_notice?>');" title="Haga click para eliminar la noticia">
              <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />              </a>              </td>
            </tr>
            <?php	
	  		$cint++;
			} 
			
			

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