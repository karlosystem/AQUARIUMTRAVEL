<?php
require_once("header.php");
?>
<script language="javascript">
var MyForm = 'frm_listcontact';
var urlProcess = 'inf_newsletter.php';
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
					  $SQL = "DELETE FROM [|PREFIX|]newsletter WHERE pk_newsletter='".$valor."' ";
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

$total_pages = ceil($total_itemscontact / $limit);
$set_limit = $page * $limit - ($limit);
if($total_itemscontact - $set_limit == 1)
$page--;



$total_itemscontact = count_entries('newsletter', '','','');
$SQL = "SELECT * FROM [|PREFIX|]newsletter ORDER BY pk_newsletter DESC LIMIT $set_limit,$limit";

$newsletter = new cls_tbl_newsletter();
$resultado = $newsletter->lista($SQL);	  
$contador = $set_limit;	
$sw=0;
	
$numFilas =  count($resultado);
?>


<!--  Content  -->
<div class="container_12">
	 <div style="clear: both"></div>
	 	<div class="bottom-spacing">
		
		<div class="module">
			<h2><span>Gesti&oacute;n de Emailing | Total de registros: <?php print $total_itemscontact?></span></h2>
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

<table class="tablesorter" id="myTable">
<thead>
            <tr>
              <th width="6%" height="25" align="center">
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th>
              <th width="10%" align="center" >#</th>
              <th width="29%" align="left" class="bg_campo">NOMBRES</th>
              <th width="20%" align="left" class="bg_campo">E-MAIL</th>
              <th width="21%" class="bg_campo" align="center">REGISTRO</th>
        </tr>
        </thead>
          <tbody>
            <?php 
	if($numFilas==0)	
	{  
?>
            <tr bgcolor="#FFFFFF" height="30">
              <td colspan="5" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de newsletter</td>
            </tr>
            <?php } // if
	else
	{

			$cint=1 ;
			foreach ($resultado  as $array)	{
				//$color = inc_color($sw); 
				$color = ($cint%2==0)?'#FEFEFE':'#F7F7F7';
				$name_add = secure_sql($array['txt_nombres']);
  ?>
            <tr style="background-color:<?php print $color?>" id="rowcontact_<?php print $array['pk_newsletter']?>">
              <td align="center" valign="middle" style="background-color:<?php print $color?>; vertical-align:middle;" class="td_list"><input name="chkcontact[]" type="checkbox" value="<?php print $array['pk_newsletter']?>" id="chkcontact[]" /></td>
              <td height="20" align="center" valign="middle"  style="background-color:<?php print $color?>;" class="tdrows">
			   <?php
			   print $cint;
			   ?>			  </td>
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo  $array['txt_nombres']?>			  </td>
              
              <td height="20" align="left" valign="middle" style="background-color:<?php print $color?>" class="tdrows">
			  <?php echo  $array['txt_email']?>			  </td>
			    
              <td height="20" align="center" valign="middle" style="background-color:<?php print $color?>;" class="tdrows">
			  <?php echo Date::convert($array['date_fecha'],'Y-m-d','d-m-Y')?> 			  
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
                       
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<!--  Footer  -->
<?php
require_once("footer.php");
?>