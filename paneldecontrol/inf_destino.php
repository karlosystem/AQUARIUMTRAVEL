<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listdestino';
var urlProcess = 'proc_destino.php';
var IsRowSlow = 'rowdestino_';
</script>
<?php

$op = (int) (tep_not_null($_GET['op'])?$_GET['op']:$_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if($op>0) {
	switch($op)
	{
	  case 5:  #Remover locales-videos sólo los seleccioandos
	
		if(!empty($_POST["chkdestinos"]))
		{	
			foreach($_POST["chkdestinos"] as $valor)
			{		if($valor)
					{	
					  (int)$valor;
					  $SQL = "DELETE FROM [|PREFIX|]destino WHERE pk_destino='".$valor."' ";
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

$limit = 10;

$total_pages = ceil($total_itemsdestino / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemsdestino - $set_limit == 1)
$page--;



$total_itemsdestino = count_entries('destino', '','','');

$SQL = "SELECT * FROM [|PREFIX|]destino LIMIT $set_limit,$limit";

$destinos = new cls_tbl_destino();
$resultado = $destinos->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>
<div class="container_12">
	<div style="clear:both;"></div>
	<div class="bottom-spacing">
		<div class="float-right">
					<a href="frm_destino.php?do=create" class="button">
						<span>Nueva Destino <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Destino" /></span>
					</a>
		</div>
				
	</div>
	


<div class="module">
<h2><span>Gesti&oacute;n de Destinos | Total de registros: <?php print $total_itemsdestino?></span></h2>
	 <?php 
		  #Paginacion
		  $filename = basename($_SERVER['PHP_SELF']);
		  $pagination = '';	  
		  if($total_itemsdestino - $set_limit == 1)
		  $page++;
		  $pagination = generate_smart_pagination($page, $total_itemsdestino, $limit, 1, $filename, $params_pag);		  
	?>    

<div class="module-table-body">
<form action="" method="POST" name="frm_listdestino" id="frm_listdestino" >

<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
<thead>
            <tr>
              <th width="3%">
              <input name="chkalldestino" type="checkbox" onclick="checkAll(this)"/>              </td>
              <th width="2%">#</th>
              <th width="23%">DESTINO</th>
			  <th width="25%">UBICACION</th>
			  <th width="21%">FOTO</th>
			  <th width="11%">ESTADO</th>
              <th width="15%">OPCION</th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="7" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Ubicaciones</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_nombre']);
				$resize_img = base64_encode(ADMIN_PHOTOBIG_DESTINOS.$array['txt_imagen']);
				$icono = "ico_estado".$array['int_estado'].".gif";	
  ?>
            <tr style="background-color:<?php print $color?>" id="rowdestino_<?php print $array['pk_destino']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list"><input name="chkdestinos[]" type="checkbox" value="<?php print $array['pk_destino']?>" id="chkdestinos[]" />
			  </td>
              
			  <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  
			   </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_nombre']?>			  </td>
			  
			  <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['ubicacion']?>			  </td>
			  
			  <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <img src="resize.php?image=<?php print $resize_img?>&h=60&w=70" />			  </td>
			  
			   <td align="center" valign="middle" id="idEstado<?php print $array['pk_destino']?>" style="vertical-align:middle">
			  <a href="javascript:UpdateStatus(<?php echo  $array['pk_destino']?>)">

				  <img src="images/icons/<?php echo  $icono?>" border="0">
			  </a>
			  </td>
              
			    
              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <a href="frm_destino.php?id=<?php print $array['pk_destino']?>" title="Haga click para actualizar la información de la ubicacion">
			  <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />              </a>
			  
			  <a href="javascript:eliminar(<?php print $array['pk_destino']?>,'<?php print $name_add?>');" title="Haga click para eliminar la ubicacion">
			  <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />              </a>   	  
			  </td>
              
             
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
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>


<!--  Footer  -->
<?php
require_once("footer.php");
?>