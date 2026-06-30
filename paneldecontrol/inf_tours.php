<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listtours';
var urlProcess = 'proc_tours.php';
var IsRowSlow = 'rowtours_';
</script>
<?php

$op = (int) (tep_not_null($_GET['op'])?$_GET['op']:$_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if($op>0) {
	switch($op)
	{
	  case 5:  #Remover locales-videos sólo los seleccioandos
	
		if(!empty($_POST["chktours"]))
		{	
			foreach($_POST["chktours"] as $valor)
			{		if($valor)
					{	
					  (int)$valor;
					  $SQL = "DELETE FROM [|PREFIX|]tours WHERE pk_tours='".$valor."' ";
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

$limit = 30;

$total_pages = ceil($total_itemstours / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemstours - $set_limit == 1)
$page--;



$total_itemstours = count_entries('tours', '','','');

if($_GET['Buscar'])
{	$sqlBuscar="";
	if($_GET['sle_destinos']) $sqlBuscar.=" AND fk_destino='".$_GET['sle_destinos']."'";		
}

$SQL = "SELECT tbl_tours.pk_tours, tbl_tours.txt_descripcion, tbl_tours.txt_nombre, tbl_tours.int_estado, tbl_tours.txt_imagen, tbl_tours.txt_creacion, tbl_destino.txt_nombre as destino, fk_destino FROM tbl_tours INNER JOIN tbl_destino ON tbl_tours.fk_destino = tbl_destino.pk_destino WHERE [|PREFIX|]tours.pk_tours <> '' ".$sqlBuscar." ORDER BY tbl_tours.fk_destino ASC LIMIT $set_limit,$limit";

$tours = new cls_tbl_tours();
$resultado = $tours->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>


<div class="container_12">
	<div style="clear: both"></div>
	<div class="bottom-spacing">
	
	<!-- Button -->
		<div class="float-right">
			<a href="frm_tours.php?do=create" class="button">
				<span>Nuevo Tours <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Tours" /></span>
			</a>
		</div>
		
		<form id="frm_buscar" name="frm_buscar" action="inf_tours.php" method="get">
		Buscar: 
		<select name="sle_destinos" class="input-short" id="sle_categoria" title="Seleccione un Destino">
		<option value="0"> Seleccione un destino</option>
          <?php
         	$cls_destino = new cls_tbl_destino();
		   	$cls_tours = new cls_tbl_tours();
		    print $cls_destino->ListaDestinos($cls_tours->getfk_destino());
		  ?>
		</select>
		<input type="submit" value="Buscar" class='submit-green' name="Buscar" id="Buscar"/>
		</form>
	</div>


<div class="module">	
	<h2><span>Gesti&oacute;n de Tours | Total de registros: <?php print $total_itemstours?></span></h2> 
		  <?php 
		  #Paginacion
		  $filename = basename($_SERVER['PHP_SELF']);
		  $pagination = '';	  
		  if($total_itemscontact - $set_limit == 1)
		  $page++;
		  $pagination = generate_smart_pagination($page, $total_itemstours, $limit, 1, $filename, $params_pag);		  
		  ?> 
		  <div class="module-table-body">
<form action="" method="POST" name="frm_listtours" id="frm_listtours" >

<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
<thead>
            <tr>
              <th width="3%" height="25" align="center" >
              <input name="chkalltours" type="checkbox" onclick="checkAll(this)"/>              </th>
              <th width="2%">#</th>
              <th width="47%">TOUR</th>
			  <th width="23%">DESTINO</th>
			  <th width="13%">FOTO</th>
			  <th width="5%">ESTADO</th>
              <th width="7%">OPCION</th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr>
              <td colspan="7" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Tours</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_nombre']);
				$resize_img = base64_encode(ADMIN_PHOTOBIG_TOURS.$array['txt_imagen']);
				$icono = "ico_estado".$array['int_estado'].".gif";	
  ?>
            <tr style="background-color:<?php print $color?>" id="rowtours_<?php print $array['pk_tours']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list"><input name="chktours[]" type="checkbox" value="<?php print $array['pk_tours']?>" id="chktours[]" />
			  </td>
              
			  <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  
			   </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_nombre']?>			  </td>
			  
			  <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['destino']?>			  </td>
			  
			  <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <img src="resize.php?image=<?php print $resize_img?>&h=60&w=70" />			  </td>
			  
			   <td align="center" valign="middle" id="idEstado<?php print $array['pk_tours']?>" style="vertical-align:middle">
			  <a href="javascript:UpdateStatus(<?php echo  $array['pk_tours']?>)">

				  <img src="images/icons/<?php echo  $icono?>" border="0">
			  </a>
			  </td>
              
			    
              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <a href="frm_tours.php?id=<?php print $array['pk_tours']?>" title="Haga click para actualizar la información del Tour">
			  <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />              </a>
			  
			  <a href="javascript:eliminar(<?php print $array['pk_tours']?>,'<?php print $name_add?>');" title="Haga click para eliminar el tour">
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