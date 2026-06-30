<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listcontact';
var urlProcess = 'inf_contacto.php';
var IsRowSlow = 'rowcontact_';
</script>
<?php

$op = (int) (tep_not_null($_GET['op'])?$_GET['op']:$_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if($op>0) {
	switch($op)
	{
	  case 5:  #Remover locales-videos sólo los seleccioandos
	
		if(!empty($_POST["chkcontact"]))
		{	
			foreach($_POST["chkcontact"] as $valor)
			{		if($valor)
					{	
					  (int)$valor;
					  $SQL = "DELETE FROM [|PREFIX|]contactos WHERE pk_contacto='".$valor."' ";
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

$total_pages = ceil($total_itemscontact / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemscontact - $set_limit == 1)
$page--;


$total_itemscontact = count_entries('contactos', '','','');

$SQL = "SELECT pk_contacto, txt_nota, fk_estado, txt_vendedor, txt_nombres, txt_email, txt_telefono, txt_comentario, date_fecha,  txt_anotacion, [|PREFIX|]contactos.int_estado,tbl_estado.pk_estado as estado, txt_pais FROM [|PREFIX|]contactos LEFT JOIN tbl_estado ON tbl_contactos.fk_estado = tbl_estado.pk_estado ORDER BY pk_contacto DESC LIMIT $set_limit,$limit";

$contacto = new cls_tbl_contacto();
$resultado = $contacto->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>

<div class="container_12">
	<div style="clear: both"></div>
		<!-- Example table -->
		<div class="module">
		<h2><span>Gesti&oacute;n de Contactos | Total de registros: <?php print $total_itemscontact?></span></h2>
		 <?php 
		  #Paginacion
		  $filename = basename($_SERVER['PHP_SELF']);
		  $pagination = '';	  
		  if($total_itemscontact - $set_limit == 1)
		  $page++;
		  $pagination = generate_smart_pagination($page, $total_itemscontact, $limit, 1, $filename, $params_pag);		  
		  ?>    
		   <div class="module-table-body">
		  		<form action="" method="POST" name="frm_listcontact" id="frm_listcontact" >
					<table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
								  <th width="5%">
								  <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/></th>
								  <th width="4%" align="center">#</th>
								  <th width="25%" align="left">NOMBRES</th>
								  <th width="23%" align="left">PAIS</th>
								  <th width="16%" align="left">E-MAIL</th>
								  <th width="16%" align="left">TELEFONO</th>
								  <th width="17%" >REGISTRO</th>
								  <th width="5%">EST</th>
								  <th width="4%">ATE</th>
								  <th width="10%">OPCIONES </th>
                                </tr>								
                            </thead>
                            <tbody>
							 <?php 
								if($numFilas==0)	
								{  
							?>
										<tr>
										  <td colspan="10">No hay resultado de contacto</td>
										</tr>
										<?php } // if
								else
								{							
										$cint=1 ;
										foreach ($resultado  as $array)	{
											$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
											$name_add = secure_sql($array['txt_nombres']);
							  ?>
								<tr id="rowcontact_<?php print $array['pk_contacto']?>">							
									  <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list"><input name="chkcontact[]" type="checkbox" value="<?php print $array['pk_contacto']?>" id="chkcontact[]" /></td>
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_nombres']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_pais']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <?php echo  $array['txt_email']?>			  </td>
			     <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <?php echo  $array['txt_telefono']?>			  </td>
              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  
			  <?php echo Date::convert($array['date_fecha'],'Y-m-d','d-m-Y')?>	  
			  
			  </td>
              
			  <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  	
			<?php
              switch ((int)$array['estado']){
				 case 1:print "<img src=\"images/icons/ico_apedido.jpg\" title=\"Pendiente de atencion\" />";break;
				 case 2:print "<img src=\"images/icons/ico_agotado.jpg\" title=\"En Proceso\"/>";break;
				 case 3:print "<img src=\"images/icons/ico_pronto.jpg\" title=\"Emitido\"/>";break;
				 case 4:print "<img src=\"images/icons/ico_stock.jpg\" title=\"No Compro\"/>";break;
				 case 5:print "<img src=\"images/icons/ico_stock.gif\" title=\"Venta Futura\"/>";break;
				 case 6:print "<img src=\"images/icons/web.png\" title=\"Cotizacion American\"/>";break;
				 default:print "&nbsp;";break;
			  }
			  ?>			  
			  
			  
			  </td>
			  <td height="20" align="left" valign="middle" class="tdrows">
			  	<?php echo  substr($array['txt_vendedor'],0,3)?>
			  </td>
			  
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
              <a href="frm_contact.php?id=<?php print $array['pk_contacto']?>" title="Haga click para ver el detalle del contacto">
              <img src="images/icons/ico_preview.gif"  width="17" height="16"  border="0" />			  </a>			  </td>
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