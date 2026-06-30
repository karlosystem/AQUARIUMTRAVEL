<?php
require_once("header.php");
?>

<?php
$CId = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_llamadas = new cls_tbl_llamadas($CId);

$IsActionG = "";
if ($do == 'create') {

  if ($IsLLamada > 0 && !$cls_llamadas->IsExistLLamada())
    $IsLLamada = 0;

  $IsActionG = 1;
} else {
  if ($cls_llamadas->IsExistLLamada())
    $IsActionG = 0;
  else
    $IsActionG = 1;
}

if ($IsActionG == 0)
  $MessageForm = "Actualizar Registro de LLamada";
else
  $MessageForm = "Crear Registro de LLamada";

?>

<script language="javascript" type="text/javascript">
  var MyForm = 'frm_llamadas';
  var IsAction = '<?php print $IsActionG ?>';
  var urlProcess = 'proc_llamadas.php';
</script>

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL ?>paneldecontrol/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL ?>paneldecontrol/calendar_picker/calendar.js" charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL ?>paneldecontrol/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL ?>paneldecontrol/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL ?>paneldecontrol/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<?php



$IdLLamada = $cls_llamadas->getid_llamada();
$cls_llamada = new cls_tbl_llamadas($IdLLamada);

?>
<div class="container_12">
  <div style="clear:both;"></div>

  <form method="post" name="frm_llamadas" id="frm_llamadas">
    <div class="grid_6">
      <div class="module">
        <h2><span><?php print $MessageForm; ?></span></h2>
        <div class="module-body">

          <h1>CONTROL DE LLAMADAS</h1>
          <p>
            <label>Nombre o razón social:</label>
            <input type="text" id="get_txtnombre" name="get_txtnombre" title="Obligatorio" value=" <?php print $cls_llamadas->gettxt_nombre(); ?>" class="input-medium" />
            <span id="msg_nombre" class="notification-input ni-correct"></span>
          </p>

          <p>
            <label>Destino:</label>
            <input type="text" id="get_txtdestino" name="get_txtdestino" title="Obligatorio" value="<?php print $cls_llamadas->gettxt_destino(); ?>" class="input-medium" />
            <span id="msg_destino" class="notification-input ni-correct"></span>
          </p>


          <p>
            <label>Fecha de Llamada:</label>
            <input name="getdate_viaje_salida" title="Obligatorio" type="text" class="input-short" id="getdate_viaje_salida" value="<?php
                                                                                                                                    if (tep_not_null($cls_llamadas->gettxt_fecha()) && $cls_llamadas->gettxt_fecha() != '0000-00-00')
                                                                                                                                      echo Date::convert($cls_llamadas->gettxt_fecha(), 'Y-m-d H:i:s', 'Y-m-d H:i:s'); ?>" />
            <img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" /> (año-mes-dia | Hora)

            <span id="msg_fecha" class="notification-input ni-correct"></span>

          </p>

          <p>
            <label>Teléfono 01:</label>
            <input type="text" id="get_txtTelefono01" name="get_txtTelefono01" title="Obligatorio" value="<?php print $cls_llamadas->gettxt_telefono1(); ?>" class="input-short" />
            <span id="msg_telefono01" class="notification-input ni-correct"></span>
          </p>

          <p>
            <label>Teléfono 02:</label>
            <input type="text" id="get_txtTelefono02" name="get_txtTelefono02" title="Por favor ingrese el Telefono 01" value="<?php print $cls_llamadas->gettxt_telefono2(); ?>" class="input-short" />
          </p>

          <p>
            <label>Email:</label>
            <input type="text" id="get_txtemail" name="get_txtemail" title="Por favor ingrese el correo electronico" value=" <?php print $cls_llamadas->gettxt_email(); ?>" class="input-medium" />
          </p>




        </div>
      </div>
      <div style="clear:both;"></div>
    </div> <!-- End .grid_6 -->

    <div class="grid_6">
      <div class="module">
        <h2><span><?php print $MessageForm; ?></span></h2>
        <div class="module-body">


          <p>
            <label>TIPO DE INGRESO:</label>
            <select name="get_tipo" class="input-short" id="get_tipo" title="Seleccione el tipo">
              <option value=""> Seleccione</option>
              <option value="WhatsApp" <?php echo $select = ($cls_llamadas->gettxt_tipo() == "WhatsApp") ? "selected" : ""; ?>>WhatsApp</option>
              <option value="Llamada Telefonica" <?php echo $select = ($cls_llamadas->gettxt_tipo() == "Llamada Telefonica") ? "selected" : ""; ?>>Llamada Telefonica</option>
              <option value="Facebook" <?php echo $select = ($cls_llamadas->gettxt_tipo() == "Facebook") ? "selected" : ""; ?>>Facebook</option>
              <option value="Correo" <?php echo $select = ($cls_llamadas->gettxt_tipo() == "Correo") ? "selected" : ""; ?>>Correo : Informes</option>
              <option value="Contactenos" <?php echo $select = ($cls_llamadas->gettxt_tipo() == "Contactenos") ? "selected" : ""; ?>>Formulario Contactenos</option>
            </select>
            <span id="msg_tipo" class="notification-input ni-correct"></span>
          </p>

          <p>
            <label>Personal de Agencia de Viajes:</label>
            <select name="get_personal" class="input-short" id="get_personal" title="Seleccione al personal">
              <option value=""> Seleccione</option>
              <option value="Elizabeth" <?php echo $select = ($cls_llamadas->gettxt_personal() == "Elizabeth") ? "selected" : ""; ?>>Elizabel</option>
              <option value="Counter 01" <?php echo $select = ($cls_llamadas->gettxt_personal() == "Counter 01") ? "selected" : ""; ?>>Counter 01</option>
              <option value="Counter 02" <?php echo $select = ($cls_llamadas->gettxt_personal() == "Counter 02") ? "selected" : ""; ?>>Counter 02</option>
            </select>
            <span id="msg_personal" class="notification-input ni-correct"></span>
          </p>

          <p>
            <label>Observacion:</label>
            <textarea class="input-medium" name="txt_nota" id="txt_nota" cols="60" rows="10" title="Ingrese la nota"><?php echo $cls_llamadas->gettxt_observacion() ?></textarea>
          </p>

          <p>
            <label>Estado:</label>
            <select name="getfk_estado" class="input-short" id="getfk_estado" title="Seleccione el estado">
              <option value="">Seleccione</option>
              <?php print cls_tbl_estado::ListaEstado($cls_llamada->getint_status()); ?>
            </select>
            <span id="msg_estado" class="notification-input ni-correct"></span>
            <input type="hidden" name="id" id="id" value="<?php print $CId ?>" />
          </p>

          <fieldset>

            <?php if ($IsActionG == 0) { ?>
              <input type="Button" value="Actualizar Guardar LLamada" class='submit-green' id="btn_save" />
            <?php   } else { ?>
              <input type="Button" value="Guardar LLamada" class='submit-green' id="btn_save" />
            <?php } ?>
            &nbsp;&nbsp;
            <input type="Button" value="Regresar" onclick="javascript:window.location='inf_llamadas.php'" class='submit-gray' />


          </fieldset>

        </div>
      </div>
      <div style="clear:both;"></div>
    </div>

    <div style="clear:both;"></div>
  </form>

</div>
<script language="javascript" type="text/javascript" src="js/jform_llamadas.js"></script>

<script language="javascript" type="text/javascript">
  /*  CALENDAR  */
  Zapatec.Calendar.setup({
    inputField: "getdate_viaje_salida",
    ifFormat: "%m/%d/%Y %H:%M:%S",
    button: "icon_calendar",
    showsTime: true
  });
</script>


<!--  Footer  -->
<?php
require_once("footer.php");
?>