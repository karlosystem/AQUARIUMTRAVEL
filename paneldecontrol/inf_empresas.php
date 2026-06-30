<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listaempresas';
var urlProcess = 'proc_empresas.php';
var IsRowSlow = 'rowempresas_';
</script>

<?php

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
$page = $_GET['page'];


if (empty($page) || !is_numeric($page) || $page < 0 )
$page = 1 ;

$limit = 40;
$total_itemsempresas = count_entries('empresas', '','','');
$total_pages = ceil($total_itemsempresas / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemsempresas - $set_limit == 1)
$page--;




$SQL = "SELECT * FROM tbl_empresa ORDER BY pk_empresa DESC LIMIT $set_limit,$limit";
$empresas = new cls_tbl_empresas();
$resultado = $empresas->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>


<!--  Content  -->
<div id="content">
<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" >
 <tr>
    <td  height="30" align="center" colspan="2" >
	  <?php 
      #Paginacion
	  
	  $filename = basename($_SERVER['PHP_SELF']);
      $pagination = '';
	  
	  if($total_itemsempresas - $set_limit == 1)
	  $page++;
	  $pagination = generate_smart_pagination($page, $total_itemsempresas, $limit, 1, $filename, $params_pag);
	  if(tep_not_null($pagination)){
	  echo "<div id=\"div-group-pagination\">";
	  echo $pagination ;
	  echo "</div>";
	  }
	  ?>      
    </td>
   </tr>
   
 <tr>
  <td colspan="2">
    <div id="tabsJ">
		  <ul>
		    <li><a href="home.php" title="Panel principal"><span>PANEL PRINCIPAL</span></a></li>
			<li><a href="inf_empresas.php" title="Lista de Ganadores del sorteo"><span>Lista de Empresas Registradas</span></a></li>
		  </ul>
		</div>
  </td>
 </tr>
 

   <tr>
    <td width="82%"  height="30" align="center" class='maintitle'>Gesti&oacute;n de Lista de Empresas Registradas</td>
	<td width="18%" align="center" class='maintitle'>Total de Empresas: <?php print $total_itemsempreasas?></td>
   </tr>
</table>
<form action="" method="POST" name="frm_listasempresas" id="frm_listasempresas" >
<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
<thead>
            <tr>
              <td width="5%" height="25" align="center"  style="background-color:#C1C1C1;" >
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </td>
              <th width="4%" align="center" class="bg_campo">#</th>
              <th width="25%" align="left" class="bg_campo">RAZON SOCIAL</th>
              <th width="23%" align="left" class="bg_campo">DOMICILIO</th>
              <th width="16%" align="left" class="bg_campo">RUC</th>
              <td width="17%" class="bg_campo" align="center">EMAIL</td>
			   <td width="17%" class="bg_campo" align="center">FECHA</td>
              <td width="10%" class="bg_campo" align="center">Opciones              </td>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="9" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Empresas</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_razon']);
  ?>
            <tr style="background-color:<?php print $color?>" id="rowempresas_<?php print $array['pk_empresa']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list">
              <input name="chkempresas[]" type="checkbox" value="<?php print $array['pk_empresa']?>" id="chkempresas[]" /></td>
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_razon']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_domicilio']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <?php echo  $array['txt_ruc']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <?php echo  $array['txt_email']?>			  </td>

              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows"><span class="tdrows" style="background-color:<?php print $color?>;"><?php print formatDate($array['txt_fecha'])?></span></td>
              
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
              
              
              <a href="frm_empresas.php?id=<?php print $array['pk_empresa']?>" title="Haga click para ver el detalle de la empresa registrada">
              <img src="images/icons/ico_preview.gif"  width="17" height="16"  border="0" />			  </a>			 
              
              <a href="javascript:eliminar(<?php print $array['pk_empresa']?>,'<?php print $array['txt_razon']?>');" title="Haga click para eliminar la empresa ingresada">
              <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />              </a>
              
               </td>
            </tr>
            <?php	
	  		$cint++;
			} 
			


	 } //else?>
          <tr>
            <td colspan="10">
                <div class="div_buttonslist">
               <a class="button" href="#" onclick="javascript:eliminar_todos();"><span>Eliminar</span></a>              
                </div>                       
            </td>
          </tr>
          </tbody>
      </table>
</form>
</div>
<!--  Content  -->



<!--  Footer  -->
<?php
require_once("footer.php");
?>