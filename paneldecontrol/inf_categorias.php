<?php
require_once("header.php");
$IsParent = (int)$_GET['CParent'];
$page = (int)$_GET['page'];
?>
<script language="javascript">
var MyForm = 'frm_listacategoria';
var urlProcess = 'proc_categoria.php';
var IsRowSlow = 'rowcategoria_';
</script>
<?php

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
$page = $_GET['page'];


if (empty($page) || !is_numeric($page) || $page < 0 )
$page = 1 ;

$limit = 40;

$total_pages = ceil($total_itemscategoria / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemscategoria - $set_limit == 1)
$page--;

$total_itemscategoria =  count_entries('categoria', 'fk_categoria',$IsParent);


$SQL = "SELECT * FROM [|PREFIX|]categoria WHERE fk_categoria='".$IsParent."' ORDER BY int_orden ASC LIMIT $set_limit,$limit";

$categoria = new cls_tbl_categoria();
$resultado = $categoria->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>

<div class="container_12">
	<div style="clear: both"></div>
		<div class="bottom-spacing">
		
			<!-- Button -->
			<div class="float-right">
				<a href="frm_categoria.php?do=create" class="button">
					<span>Nueva Categoria <img src="images/plus-small.gif" width="12" height="9" alt="Nueva Categoria" /></span>
				</a>
			</div>
			
<div class="module">
<h2><span>Gesti&oacute;n de Categorias | Total de registros: <?php print $total_itemscategoria?></span></h2>
 <?php 
      #Paginacion
	  $filename = basename($_SERVER['PHP_SELF']);
      $pagination = '';
	  if($total_itemshoteles - $set_limit == 1)
	  $page++;
	  $pagination = generate_smart_pagination($page, $total_itemscategoria, $limit, 1, $filename, $params_pag);
	  
 ?> 
 <div class="module-table-body">
<form action="" method="POST" name="frm_listacategoria" id="frm_listacategoria" >
<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
<thead>
            <tr>
              <th width="2%" align="center">
				<input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              
			  </th>
              <th width="2%" align="center">#</th>
              <th width="22%" align="left">NOMBRE</th>
              <th width="7%" align="left">ORDEN</th>
			  <th width="16%" align="left">IMAGEN</th>
              <th width="4%" align="left">VER</th>
              <th width="39%" align="center">PRESENTACION</th>
              <th width="8%" align="center">OPCIONES</th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr>
              <td colspan="9" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Categorias</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_nombre']);
				$icono = "ico_estado".$array['int_estado'].".gif";
				$resize_img = base64_encode(ADMIN_IMG_CAT.$array['txt_imagen']);

  ?>
            <tr style="background-color:<?php print $color?>" id="rowcategoria_<?php print $array['pk_categoria']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list">
              <input name="chkcontact[]" type="checkbox" value="<?php print $array['pk_categoria']?>" id="chkcontact[]" /></td>
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_nombre']?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['int_orden']?>			  </td>
			  
			   <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <img src="resize.php?image=<?php print $resize_img?>&h=160&w=170" />			  </td>
			  
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  
			  
			 <a href="javascript:UpdateStatus(<?php echo  $array['pk_categoria']?>)">
                 <img src="images/icons/<?php echo  $icono?>" border="0">             
		     </a>		
			  
			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <span class="tdrows" style="background-color:<?php print $color?>;"><?php print $array['txt_descripcion']?></span></td>
              
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
              

			  <a href="frm_categoria.php?CParent=<?php print $array['pk_categoria']?>" title="Haga click para actualizar la información de la categoria">
              <img src="images/icons/ico_edit.gif"  width="16" height="16"  border="0" />
              </a> 


              
              <a href="javascript:eliminar(<?php print $array['pk_categoria']?>,'<?php print $array['txt_nombre']?>');" title="Haga click para eliminar la categoria">
              <img src="images/icons/ico_remove.gif"  width="16" height="16"  border="0" />              </a>
              
			   <?php if($IsParent<=0){?>
              <a href="inf_categorias.php?CParent=<?php echo $array['pk_categoria']?>"><img src="images/icons/arbol.gif" title="Añadir sub-categoría" width="19" height="15"  border="0">
              </a>
              <?php } ?>

               </td>
            </tr>
            <?php	
	  		$cint++;
			} 
			


	 }?>        
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