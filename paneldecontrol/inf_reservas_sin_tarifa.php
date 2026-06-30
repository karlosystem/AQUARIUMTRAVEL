<?php
require_once("header.php");
?>
<script language="javascript" src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery.pop.js" type="text/javascript"></script>
<link href="css/pop.css" media="all" rel="stylesheet" type="text/css"/>

<script type='text/javascript'>
  $(document).ready(function(){
	$.pop();
  });
</script>
	
<script language="javascript">
var MyForm = 'frm_listreservas';
var urlProcess = 'inf_reservas.php';
var IsRowSlow = 'rowreservas_';
</script>


	
<script language="javascript">
	function hide(){
		var earrings = document.getElementById('getfk_estado');
		earrings.style.visibility = 'hidden';
		var dato = document.getElementById('dato');
		dato.style.visibility = 'visible';
		dato.style.position = 'absolute';
	}

	function show(){
		var earrings = document.getElementById('getfk_estado');
		earrings.style.visibility = 'visible';
		earrings.style.position = 'relative';
		var dato = document.getElementById('dato');
		dato.value = '';
		dato.style.visibility = 'hidden';
		dato.style.position = 'absolute';
	}


	function genderSelectHandler(select){
	if(select.value == 'txt_estado'){
		show();
	}else if(select.value == 'txt_name'){
		hide();
	}else if(select.value == 'txt_ape'){
		hide();
	}else if(select.value == 'txt_email'){
		hide();
	}else if(select.value == 'txt_telefono'){
		hide();
	}}
	
</script>

<?php

$op = (int) (tep_not_null($_GET['op'])?$_GET['op']:$_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if($op>0) {
	switch($op)
	{
	  case 5:  #Remover locales-videos sólo los seleccioandos
	
		if(!empty($_POST["chkreservas"]))
		{	
			foreach($_POST["chkreservas"] as $valor)
			{		if($valor)
					{	
					  (int)$valor;
					  $SQL = "DELETE FROM [|PREFIX|]reservas WHERE pk_reserva='".$valor."' ";
					  $GLOBALS['CONNECT_DB']->Query($SQL);			
					}
			}		// foreach
		}
	  break;
	}
	header("Location:$IsReferrer");
}

$limit = 200;
$page = $_GET['page'];

if (empty($page) || !is_numeric($page) || $page < 0 )
$page = 1 ;
$total_itemsreservas = count_entries('reservas', '','','');
$total_pages = ceil($total_itemsreservas / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemsreservas - $set_limit == 1)
$page--;

	$SQL = "SELECT pk_reserva, LOWER(txt_name) as txt_name, LOWER(txt_ape) as txt_ape, LOWER(txt_email) as txt_email, txt_direccion, pais, fk_destino, txt_telefono, txt_cantidad, txt_fecha_viaje, txt_ingreso, txt_comentario, date_fecha, tbl_paquete_details.txt_title as paquete, txt_cantidad, txt_fecha_viaje, pais, tbl_estado.pk_estado as estado, txt_vendedor, txt_tipo FROM tbl_reservas 
	LEFT JOIN tbl_paquete_details ON tbl_reservas.fk_destino = tbl_paquete_details.fk_paquete 
	LEFT JOIN tbl_estado ON tbl_reservas.fk_estado = tbl_estado.pk_estado WHERE tbl_estado.pk_estado = '7' ORDER BY pk_reserva DESC LIMIT $set_limit,$limit";
	
$reservas = new cls_tbl_reservas();
$resultado = $reservas->lista($SQL);	  

$contador = $set_limit;	
$numFilas =  count($resultado);
?>

	
<!--  Content  -->
<div class="container_12">
		<div class="bottom-spacing">

<div class="module">
	<h2><span>Gesti&oacute;n de Cotizaciones | Total de registros: <?php print $total_itemsreservas?></span></h2>
	<div class="module-table-body">
<form action="" method="POST" name="frm_listreservas" id="frm_listreservas" >

<table id="myTable" class="tablesorter">
<thead>
            <tr>
              <th width="3%" height="25" align="center" >
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th>
              <th width="2%" align="center">#</th>
              <th width="20%" align="left">INTERESADO(A) </th>
              <th width="24%" align="left">PAQUETE INTERESADO </th>
              <th width="10%" align="left">E-MAIL</th>
			  <th width="8%" align="left">TELEFONO</th>
              <th width="11%" align="center">REGISTRO</th>
			  <th width="5%"  align="center">EST</th>
			  <th width="4%"  align="center">ATE</th>
              <th width="5%"  align="center">VER</th>
			
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr>
              <td colspan="10" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Cotizaciones</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			$sw=0;
			foreach ($resultado  as $array)	{
				if($sw==0)	{ 	$sw=1; 	}
				else		{	$sw=0;  }
				$id=$resultado[$contador-1]['pk_reserva'];
				$color = inc_color($sw);
				$name_add = secure_sql($array['txt_name']);
  ?>
			<tr onMouseOver="this.className='On'" onMouseOut="this.className=''" height="20"> 
              <td  style="background-color:<?php echo  $color?>" align="center"><input name="chkreservas[]" type="checkbox" value="<?php print $array['pk_reserva']?>" id="chkreservas[]" /></td>
              <td style="background-color:<?php echo  $color?>"  align="center">
			   <?php
			   print $cint;
			   ?>			
			   </td>
             
			 
			 <td align="left" style="background-color:<?php echo  $color?>" >
			 

		  <?php echo  $array['txt_name']. " " . $array['txt_ape'] ?>
		   <div class='pop'>
			<?php echo  $array['txt_comentario']?>
          </div>
				  
			  
			  <?php
              switch ($array['txt_tipo']){
				 case "Llamada Telefonica":print "<img src=\"images/phone.png\" align=\"middle\" title=\"Llamada Telefonica\" />";break;
				 case "Formulario Web":print "<img src=\"images/email.png\" align=\"middle\" title=\"Formulario Web\"/>";break;
				 case "Facebook":print "<img src=\"images/facebook.png\" align=\"middle\" title=\"Facebook\"/>";break;		
				 case "Correo":print "<img src=\"images/american.png\" align=\"middle\" title=\"Correo American\"/>";break;		
				 case "Contactenos":print "<img src=\"images/contactenos.png\" align=\"middle\" title=\"Contactenos\"/>";break;
				 default:print "&nbsp;";break;
			  }
			  ?>			  
			 
			  
			  </td>
              <td style="background-color:<?php echo  $color?>"  align="left">
			  <?php echo  $array['paquete']?>			  </td>
              <td style="background-color:<?php echo  $color?>"  align="left">
			  <?php echo  $array['txt_email']?>			  </td>
			     <td style="background-color:<?php echo  $color?>"  align="left" >
			  <?php echo  $array['txt_telefono']?>			  </td>
              <td style="background-color:<?php echo  $color?>"  align="center">		
				<?php echo Date::convert($array['date_fecha'],'Y-m-d H:i:s','d-m-Y H:i:s')?>  
			  </td>
			  
			   <td style="background-color:<?php echo  $color?>"  align="center">
			  	
			<?php
              switch ((int)$array['estado']){
				 case 1:print "<img src=\"images/icons/ico_apedido.jpg\" title=\"Pendiente de atencion\" />";break;
				 case 2:print "<img src=\"images/icons/ico_agotado.jpg\" title=\"En Proceso\"/>";break;
				 case 3:print "<img src=\"images/icons/ico_pronto.jpg\" title=\"Emitido\"/>";break;
				 case 4:print "<img src=\"images/icons/ico_stock.jpg\" title=\"No Compro\"/>";break;
				 case 5:print "<img src=\"images/icons/ico_stock.gif\" title=\"Venta Futura\"/>";break;
				 case 7:print "<img src=\"images/icons/icono-ayuda.png\" title=\"Venta Futura\"/>";break;
				 case 8:print "<img src=\"images/icons/asterisk.gif\" title=\"Urgente\"/>";break;
				 default:print "&nbsp;";break;
			  }
			  ?>			  
			  
			  
			  </td>
			  <td style="background-color:<?php echo  $color?>"  align="left">
			  	<?php echo  substr($array['txt_vendedor'],0,3)?>
			  </td>
              
              <td style="background-color:<?php echo  $color?>"  align="center">
              <a href="frm_reservas.php?id=<?php print $array['pk_reserva']?>" title="Haga click para ver el detalle del contacto">
              <img src="images/icons/ico_preview.gif"  width="17" height="16"  border="0" />			  </a>			  </td>
            </tr>
            <?php	
	  		$cint++;
			} 
	 } //else?>
          
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