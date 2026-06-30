<?php
require_once("header.php");
?>
<script language="javascript" src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery.pop.js" type="text/javascript"></script>
<link href="css/pop.css" media="all" rel="stylesheet" type="text/css" />

<script type='text/javascript'>
  $(document).ready(function() {
    $.pop();
  });
</script>

<script language="javascript">
  var MyForm = 'frm_llamadas';
  var urlProcess = 'inf_llamadas.php';
  var IsRowSlow = 'rowllamadas_';
</script>

<?php

$op = (int) (tep_not_null($_GET['op']) ? $_GET['op'] : $_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if ($op > 0) {
  switch ($op) {
    case 5:
      if (!empty($_POST["chkllamadas"])) {
        foreach ($_POST["chkllamadas"] as $valor) {
          if ($valor) {
            (int)$valor;
            $SQL = "DELETE FROM [|PREFIX|]llamadas WHERE id='" . $valor . "' ";
            $GLOBALS['CONNECT_DB']->Query($SQL);
          }
        }
      }
      break;
  }
  header("Location:$IsReferrer");
}

$filename = basename($_SERVER['PHP_SELF']);
$limit = 30;
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0)
  $page = 1;

$total_itemsreservas = count_entries('llamadas', '', '', '');

if ($_GET['Buscar']) {
  $sqlBuscar = "";
  if (tep_not_null($_GET['dato'])) {
    $sqlBuscar = " AND " . $_GET['campo'] . " like '%" . $_GET['dato'] . "%'";
  }
  $limit = 30;
}

if ($_GET['Ver']) {
  $sqlBuscar = "";
  if ($_GET['getfk_estado']) {
    $sqlBuscar .= " AND tbl_estado.pk_estado='" . $_GET['getfk_estado'] . "'";
  }
  $total_itemsreservas = count_entries('llamadas', 'fk_estado', (int)$_GET['getfk_estado'], '');
  $limit = 30;
  $filename = "";
  $filename = "inf_llamadas.php?getfk_estado=" . (int)$_GET['getfk_estado'] . "&Ver=Buscar";
}

$total_pages = ceil($total_itemsreservas / $limit);
$set_limit = $page * $limit - ($limit);
if ($total_itemsreservas - $set_limit == 1)
  $page--;

$SQL = "SELECT id, fecha, hora, nombre, destino, telefono01, telefono02, email, observacion, personal, fecha_alta, fk_estado, tipo FROM [|PREFIX|]llamadas ORDER BY id DESC LIMIT $set_limit,$limit";

$llamadas = new cls_tbl_llamadas();
$resultado = $llamadas->lista($SQL);
$contador = $set_limit;
$numFilas =  count($resultado);

?>

<!--  Content  -->
<div class="container_12">
  <div class="bottom-spacing">
    <div class="float-right" style="margin-bottom: 15px;">
      <a href="frm_llamadas.php?do=create" class="button">
        <span>Crear Nuevo Registro <img src="images/plus-small.gif" width="12" height="9" alt="Nuevo registro" /></span>
      </a>
      <a class="button" href="#" onclick="javascript:eliminar_todos();">
        <span>Eliminar</span>
      </a>
    </div>

    <table align="center" width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td width="30%" valign="top">
          <form id="frm_buscar" name="frm_buscar" action="inf_reservas.php" method="get">
            <table width="100%">
              <tr>
                <td width="31%" height="40" align="left">Buscar Por:
                  <select name="campo" id="campo" class="input-medium">
                    <option value="txt_name">Nombre</option>
                    <option value="txt_ape">Apellidos</option>
                    <option value="txt_email">Email</option>
                    <option value="txt_telefono">Tel&eacute;fono</option>
                  </select>
                </td>
                <td width="33%" align="left">
                  <input type="text" title="Ingrese las primeras letras" style="padding:3px; border: 1px solid #cccccc; background: url(images/input-bg.gif) top left repeat-x #f6f6f6;" id="dato" name="dato" value="<?php echo $_GET['dato'] ?>" />
                </td>
                <td width="36%" align="left">
                  <input type="submit" value="Buscar" class="submit-green" title="Buscar Ahora" name="Buscar" id="Buscar" />
                  <input type="button" value="Todo" class="submit-gray" onclick="window.location.href='inf_reservas.php'" title="Todos" name="Todo" id="Todo" />
                </td>
              </tr>
            </table>
          </form>
        </td>

        <td valign="top" width="40%">
          <table width="60%">
            <tr>
              <td align="right">Pendiente&nbsp;</td>
              <td align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_apedido.jpg\" title=\"Pendiente de atencion\" />"; ?></td>
              <td align="right">En Proceso&nbsp;</td>
              <td align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_agotado.jpg\" title=\"En Proceso\" />"; ?></td>
              <td align="right">Enitido&nbsp;</td>
              <td align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_pronto.jpg\" title=\"Emitido\" />"; ?></td>
              <td align="right">No Compro&nbsp;</td>
              <td align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_stock.jpg\" title=\"No Compro\" />"; ?></td>
              <td align="right">Venta Futura&nbsp;</td>
              <td align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_stock.gif\" title=\"Venta Futura\" />"; ?></td>
            </tr>
          </table>
        </td>
        <td width="30%" valign="top"></td>
      </tr>
      <tr>
        <td valign="top" align="center" width="50%" colspan="1" style="margin:0px;">
          <form id="frm_ver" name="frm_ver" action="inf_reservas.php" method="get" style="margin-top:0px; padding-top:0px; position: relative;">
            <table width="100%" style="margin-top:0px;">
              <tr>
                <td width="43%" height="40" align="left">Estado:
                  <select name="getfk_estado" style="margin-top:0px;" id="getfk_estado" title="Seleccione el estado">
                    <?php print cls_tbl_estado::ListaEstado(); ?>
                  </select>
                </td>
                <td width="57%" align="left">
                  <input type="submit" value="Buscar" class="submit-green" title="Buscar Ahora" name="Ver" id="Ver" />
                </td>
              </tr>
            </table>
          </form>
        </td>
        <td align="center" width="50%" valign="top" colspan="1">
          <table width="100%" style="border:1px solid #000000;">
            <?php
            #Paginacion
            $pagination = '';

            if ($total_itemsreservas - $set_limit == 1)
              $page++;
            $pagination = generate_smart_pagination($page, $total_itemsreservas, $limit, 1, $filename, $params_pag);
            if (tep_not_null($pagination)) {
              echo "<div id=\"div-group-pagination\">";
              echo $pagination;
              echo "</div>";
            }
            ?>
          </table>
        </td>

      </tr>
    </table>

    <div class="module">
      <h2><span>Gesti&oacute;n de Cotizaciones | Total de registros: <?php print $total_itemsreservas ?></span></h2>
      <div class="module-table-body">
        <form action="" method="POST" name="frm_listreservas" id="frm_listreservas">

          <table id="myTable" class="tablesorter">
            <thead>
              <tr>
                <th width="4%" height="25" align="center">
                  <input name="chkallregister" type="checkbox" onclick="checkAll(this)" />
                </th>
                <th width="4%" align="center">#</th>
                <th width="15%" align="left">NOMBRE </th>
                <th width="24%" align="left">FECHA </th>
                <th width="10%" align="left">DESTINO </th>
                <th width="15%" align="left">E-MAIL</th>
                <th width="9%" align="left">TELEFONO</th>
                <th width="12%" align="center">TIPO</th>
                <th width="6%" align="center">EST</th>
                <th width="5%" align="center">ATE</th>
                <th width="6%" align="center">VER</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($numFilas == 0) {
              ?>
                <tr>
                  <td colspan="12" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Registros</td>
                </tr>
                <?php } // if
              else {

                $cint = 1;
                $sw = 0;
                foreach ($resultado  as $array) {
                  if ($sw == 0) {
                    $sw = 1;
                  } else {
                    $sw = 0;
                  }
                  $id = $resultado[$contador - 1]['id'];
                  $color = inc_color($sw);
                  $name_add = secure_sql($array['nombre']);
                ?>
                  <tr onMouseOver="this.className='On'" onMouseOut="this.className=''" height="20">
                    <td style="background-color:<?php echo  $color ?>" align="center"><input name="chkreservas[]" type="checkbox" value="<?php print $array['id'] ?>" id="chkreservas[]" /></td>
                    <td style="background-color:<?php echo  $color ?>" align="center">
                      <?php
                      print $cint;
                      ?>
                    </td>


                    <td align="left" style="background-color:<?php echo  $color ?>">
                      <?php echo  $array['nombre']; ?>
                      <?php
                      switch ($array['tipo']) {
                        case "Llamada Telefonica":
                          print "<img src=\"images/phone.png\" align=\"middle\" title=\"Llamada Telefonica\" />";
                          break;
                        case "Formulario Web":
                          print "<img src=\"images/email.png\" align=\"middle\" title=\"Formulario Web\"/>";
                          break;
                        case "Facebook":
                          print "<img src=\"images/facebook.png\" align=\"middle\" title=\"Facebook\"/>";
                          break;
                        case "Correo":
                          print "<img src=\"images/american.png\" align=\"middle\" title=\"Correo American\"/>";
                          break;
                        case "Contactenos":
                          print "<img src=\"images/contactenos.png\" align=\"middle\" title=\"Contactenos\"/>";
                          break;
                        default:
                          print "&nbsp;";
                          break;
                      }
                      ?>


                    </td>

                    <td style="background-color:<?php echo  $color ?>" align="left">
                      <?php
                      $fecha_salida = Date::convert($array['fecha'], 'Y-m-d H:i:s', 'd-m-Y H:i:s');
                      if ($fecha_salida == "30-11-1999") {
                        echo "-";
                      } else {
                        echo $fecha_salida;
                      }
                      ?>
                    </td>

                    <td style="background-color:<?php echo  $color ?>" align="left">
                      <?php echo  $array['destino'] ?> </td>
                    <td style="background-color:<?php echo  $color ?>" align="left">
                      <?php echo  $array['email'] ?> </td>
                    <td style="background-color:<?php echo  $color ?>" align="left">
                      <?php echo  $array['telefono01'] ?> </td>
                    <td style="background-color:<?php echo  $color ?>" align="left">
                      <?php echo  $array['tipo'] ?>
                    </td>

                    <td style="background-color:<?php echo  $color ?>" align="center">

                      <?php
                      switch ((int)$array['fk_estado']) {
                        case 1:
                          print "<img src=\"images/icons/ico_apedido.jpg\" title=\"Pendiente de atencion\" />";
                          break;
                        case 2:
                          print "<img src=\"images/icons/ico_agotado.jpg\" title=\"En Proceso\"/>";
                          break;
                        case 3:
                          print "<img src=\"images/icons/ico_pronto.jpg\" title=\"Emitido\"/>";
                          break;
                        case 4:
                          print "<img src=\"images/icons/ico_stock.jpg\" title=\"No Compro\"/>";
                          break;
                        case 5:
                          print "<img src=\"images/icons/ico_stock.gif\" title=\"Venta Futura\"/>";
                          break;
                        case 7:
                          print "<img src=\"images/icons/icono-ayuda.png\" title=\"Venta Futura\"/>";
                          break;
                        case 8:
                          print "<img src=\"images/icons/asterisk.gif\" title=\"Urgente\"/>";
                          break;
                        case 9:
                          print "<img src=\"images/icons/fecha.png\" title=\"Fuera de Fecha\"/>";
                          break;
                        default:
                          print "&nbsp;";
                          break;
                      }
                      ?>


                    </td>
                    <td style="background-color:<?php echo  $color ?>" align="left">
                      <?php echo  substr($array['personal'], 0, 3) ?>
                    </td>

                    <td style="background-color:<?php echo  $color ?>" align="center">
                      <a href="frm_llamadas.php?id=<?php print $array['id'] ?>" title="Haga click para ver el detalle del contacto">
                        <img src="images/icons/ico_preview.gif" width="17" height="16" border="0" /> </a>
                    </td>
                  </tr>
              <?php
                  $cint++;
                }
              } //else
              ?>

            </tbody>
          </table>
        </form>
      </div>

    </div>
    <div style="clear:both;"></div>

  </div>

  <div style="clear:both;"></div>
</div>

<!--  Footer  -->
<?php
require_once("footer.php");
?>