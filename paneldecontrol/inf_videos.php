<?php require_once("header.php"); ?>
<script language="javascript">
var MyForm = 'frm_listasvideos';
var urlProcess = 'proc_video.php';
var IsRowSlow = 'rowvideo_';
</script>

<?php

	$page = $_GET['page'];
	if (empty($page) || !is_numeric($page) || $page < 0 ) { $page = 1 ; }
    $limit = 20;
    $total_itemsvideos = count_entries('video', '','');
	
	$total_pages = ceil($total_itemsvideos / $limit);
	
	$set_limit = $page * $limit - ($limit);
	
	if($total_itemsvideos - $set_limit == 1)
    $page--;


  	$videoscls = new cls_tbl_video();
	$jutjub = new YouTube();
	
	$SQL = "SELECT case `video_destacado` when '1' then 'SI' when '0' then 'NO' END as condicion, id, video_title, date_video, yt_id, yt_thumb, added, status FROM tbl_video ORDER BY added DESC LIMIT $set_limit,$limit";

	$resultado = $videoscls->video_portada($SQL);	  

    $contador = $set_limit;	

    $sw=0;
?>

<!--  Content  -->
<div class="container_12">
	<div style="clear: both"></div>
		<div class="bottom-spacing">		
			<!-- Button -->
			<div class="float-right">
				<a href="frm_noticia.php?do=create" class="button">
					<span>Nueva Noticia<img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Video" /></span>
				</a>
			</div>			
			<div class="module">
			<h2><span>Gesti&oacute;n de Videos | Total de registros: <?php print $total_itemsvideos?></span></h2>
			 <?php 
				  #Paginacion
				  $filename = basename($_SERVER['PHP_SELF']);
				  $pagination = '';
				  if($total_itemsevento - $set_limit == 1)
				  $page++;
				  $pagination = generate_smart_pagination($page, $total_itemsvideos, $limit, 1, $filename, $params_pag);				  
			 ?> 
			<div class="module-table-body">

<form action="" method="POST" name="frm_listasvideos" id="frm_listasvideos" >
<table class="tablesorter" id="myTable">
<thead>
            <tr>
             <th width="20" align="center"><input name="allreg" type="checkbox" onclick="checktodo(this)"/></th>	
	          <th width="35" align="center" >Inicio</th> 
              <th width="424" class="bg_campo">Título</th> 
              <th width="126" class="bg_campo">Fecha creación</th>
              <th width="122" class="bg_campo">Vista Previa</th>
              <th width="61" class="bg_campo" align="center">Estado</th> 
              <th width="57" class="bg_campo" align="center">Opciones</th> 
        </tr>
        </thead>
          <tbody>
		  
<?php 
    $numFilas =  count($resultado);
	if($numFilas==0)	
	{  
?>
            <tr>
              <td colspan="9" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Videos</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['video_title']);
				$icono = "ico_estado".$array['status'].".gif";
  ?>
           <tr style="background-color:<?php print $color?>" id="rowvideo_<?php echo $array['id']?>">
		        <td height="25" align="center" bgcolor="#E8E8E8" >
				<input name="chkvideoyt[]" type="checkbox" value="<?php echo $array['id']?>"/>				</td>
			      <td align="center"><?php echo $array['condicion']?></td> 
                  <td align="left" style="padding-left:5px;"><?php echo  utf8_encode($array['video_title'])?></td> 
                  <td style="padding-left:5px;" align="left"><?php echo  time_since($array['added'])?></td>
                  <td style="padding-left:5px;" align="center">
                  <?php  
				  echo $jutjub->ShowImg($array['yt_id'],1,100,63,secure_sql($array['video_title']))?>
                  </td>
                  <td align="center" id="idEstado<?php echo  $array['id']?>">
                  <a href="javascript:ajax_estado(<?php echo  $array['id']?>)">
               <img src="images/icons/<?php echo  $icono?>" border="0"> </a></td> 
                           
				  
			     <td align="center">
                 <a href="frm_video.php?id=<?php echo $array['id']?>">
                 <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />                </a>
						     
				 <a href="javascript:eliminar('<?php echo $array['id']?>','<?php echo secure_sql($array['video_title'])?>')">
                <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />                 </a>			    </td>
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
                       
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<!--  Footer  -->
<?php
require_once("footer.php");
?>