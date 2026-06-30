<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listasorteo';
var urlProcess = 'proc_sorteo.php';
var IsRowSlow = 'rowsorteo_';
</script>
<?php

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
$page = $_GET['page'];


if (empty($page) || !is_numeric($page) || $page < 0 )
$page = 1 ;

$limit = 40;

$total_pages = ceil($total_itemssorteo / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemssorteo - $set_limit == 1)
$page--;



$total_itemssorteo = count_entries('sorteo', '','','');
$SQL = "SELECT * FROM [|PREFIX|]sorteo ORDER BY pk_sorteo DESC LIMIT $set_limit,$limit";

$sorteo = new cls_tbl_sorteo();
$resultado = $sorteo->lista($SQL);	  
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
	  
	  if($total_itemssorteo - $set_limit == 1)
	  $page++;
	  $pagination = generate_smart_pagination($page, $total_itemssorteo, $limit, 1, $filename, $params_pag);
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
			<li><a href="inf_sorteo.php" title="Lista de Ganadores del sorteo"><span>Lista de Ganadores del Sorteo</span></a></li>
		  </ul>
		</div>
  </td>
 </tr>
 

   <tr>
    <td width="82%"  height="30" align="center" class='maintitle'>Gesti&oacute;n de Lista de Ganadores del Sorteo </td>
	<td width="18%" align="center" class='maintitle'>Total de Ganadores: <?php print $total_itemssorteo?></td>
   </tr>
</table>
<form action="" method="POST" name="frm_listasorteo" id="frm_listasorteo" >
<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
<thead>
            <tr>
              <td width="5%" height="25" align="center"  style="background-color:#C1C1C1;" >
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </td>
              <th width="4%" align="center" class="bg_campo">#</th>
              <th width="25%" align="left" class="bg_campo">SORTEO</th>
              <th width="23%" align="left" class="bg_campo">GANADOR</th>
              <th width="16%" align="left" class="bg_campo">EMPRESA</th>
			  <th width="16%" align="left" class="bg_campo">LOGO</th>
              <td width="17%" class="bg_campo" align="center">Fecha de SORTEO</td>
              <td width="10%" class="bg_campo" align="center">Opciones              </td>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="9" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Sorteo</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_titulo']);
				$image_logo = base64_encode(ADMIN_IMG_SORTEO.$array['txt_imgthumb']);

  ?>
            <tr style="background-color:<?php print $color?>" id="rowsorteo_<?php print $array['pk_sorteo']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list">
              <input name="chkcontact[]" type="checkbox" value="<?php print $array['pk_sorteo']?>" id="chkcontact[]" /></td>
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_titulo']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_ganador']?>			  </td>
              
			  <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <?php echo  $array['txt_empresa']?>			  </td>

			  <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <img src="th-resize.php?image=<?php echo $image_logo?>&w=80&h=40" /> </td>

              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows"><span class="tdrows" style="background-color:<?php print $color?>;"><?php print formatDate($array['txt_fecha'])?></span></td>
              
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
              
              
              <a href="frm_sorteo.php?id=<?php print $array['pk_sorteo']?>" title="Haga click para ver el detalle del sorteo">
              <img src="images/icons/ico_preview.gif"  width="17" height="16"  border="0" />			  </a>			 
              
              <a href="javascript:eliminar(<?php print $array['pk_sorteo']?>,'<?php print $array['txt_titulo']?>');" title="Haga click para eliminar el sorteo">
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
               <a class="button" href="frm_sorteo.php?do=create"><span>Añadir / Crear</span></a>          
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