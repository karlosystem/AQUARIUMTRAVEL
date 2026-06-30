<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listcadena';
var urlProcess = 'proc_cadena.php';
var IsRowSlow = 'rowcontact_';
</script>
<?php

$op = (int) (tep_not_null($_GET['op'])?$_GET['op']:$_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if($op>0) {
	switch($op)
	{
	  case 5:  #Remover locales-videos sólo los seleccioandos
	
		if(!empty($_POST["chkcadena"]))
		{	
			foreach($_POST["chkcadena"] as $valor)
			{		if($valor)
					{	
					  (int)$valor;
					  $SQL = "DELETE FROM [|PREFIX|]cadena WHERE pk_cadena='".$valor."' ";
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

$limit = 40;

$total_pages = ceil($total_itemscadena / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemscadena - $set_limit == 1)
$page--;



$total_itemscadena = count_entries('cadena', '','','');
$SQL = "SELECT * FROM vw_cadenahoteles LIMIT $set_limit,$limit";

$cadenas = new cls_tbl_cadena();
$resultado = $cadenas->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>
	<div class="container_12">
		<div style="clear: both"></div>
		<div class="bottom-spacing">
					<!-- Button -->
		<div class="float-right">
			<a href="frm_cadenas.php?do=create" class="button">
				<span>Nueva Cadena <img src="images/plus-small.gif" width="12" height="9" alt="Nueva Cadena" /></span>
			</a>
		</div>

	<div class="module">	
		<h2><span>Gesti&oacute;n de Cadena de Hoteles | Total de registros: <?php print $total_itemscadena?></span></h2> 
		 <?php 
		  #Paginacion
		  $filename = basename($_SERVER['PHP_SELF']);
		  $pagination = '';	  
		  if($total_itemscontact - $set_limit == 1)
		  $page++;
		  $pagination = generate_smart_pagination($page, $total_itemscadena, $limit, 1, $filename, $params_pag);		  
		  ?> 

<form action="" method="POST" name="frm_listcadena" id="frm_listcadena" >

<table width="100%" align="center">
<thead>
            <tr>
              <th width="4%" height="25" align="center">
              <input name="chkallcadena" type="checkbox" onclick="checkAll(this)"/>              </th>
              <th width="11%" align="center">#</th>
              <th width="55%">CADENA DE HOTEL </th>
              <th width="30%">OPCION</th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="5" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Cadenas de Hotel</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_nombre']);
  ?>
            <tr style="background-color:<?php print $color?>" id="rowcadena_<?php print $array['pk_cadena']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list"><input name="chkcadena[]" type="checkbox" value="<?php print $array['pk_cadena']?>" id="chkcadena[]" />
			  </td>
              
			  <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  
			   </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_nombre']?>			  </td>
              
			    
              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <a href="frm_cadenas.php?id=<?php print $array['pk_cadena']?>" title="Haga click para actualizar la información de la ubicacion">
			  <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />              </a>
			  
			  <a href="javascript:eliminar(<?php print $array['pk_cadena']?>,'<?php print $name_add?>');" title="Haga click para eliminar la ubicacion">
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
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<!--  Footer  -->
<?php
require_once("footer.php");
?>