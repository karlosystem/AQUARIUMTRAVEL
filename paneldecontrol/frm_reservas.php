<?php
require_once("header.php");
?>

<?php
$CId = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_reservas = new cls_tbl_reservas($CId);

$IsActionG = "";
if($do=='create') {

if($IsReserva>0 && !$cls_reservas->IsExistReserva())
$IsReserva = 0 ;

$IsActionG = 1;

}else{
if($cls_reservas->IsExistReserva())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Solicitud de Cotizacion";
else
$MessageForm = "Crear Solicitud de Cotizacion";

?>

<script language="javascript" type="text/javascript" >
var MyForm = 'frm_reservas';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_reservas.php';
</script>

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>paneldecontrol/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>paneldecontrol/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>paneldecontrol/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>paneldecontrol/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>paneldecontrol/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<?php



$IdPaquete = $cls_reservas->getfk_destino();
$cls_paquete = new cls_tbl_paquete($IdPaquete);
$ArrayNamePaq = $cls_paquete->get_infolang_pack(2);

?>
<div class="container_16">
	<div style="clear:both;"></div>
	
		<div class="grid_12">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
<form method="post"  name="frm_reservas" id="frm_reservas" >
      <div>
				<span class="notification n-success">Registros Obligatorios</span>
	 </div>
	 

				<h1>INTERESADO</h1>
	 
	  	 <p>
			<label>Nombre :</label>
			<input type="text" id="get_txtname" name="get_txtname" title="Por favor ingrese el nombre de quien reserva el paquete" value=" <?php print $cls_reservas->gettxt_reservaname();?>"  class="input-medium" />
			<span class="notification-input ni-correct"></span>
		</p>
		
		 <p>
			<label>Apellidos:</label>
			<input type="text" id="get_txtape" name="get_txtape" title="Por favor ingrese el apellido de quien reserva el paquete" value="<?php print $cls_reservas->gettxt_reservaape();?>" class="input-medium"  />
			<span class="notification-input ni-correct"></span>
		</p>
		
		 <p>
			<label>Pais:</label>
			<input type="text" id="get_txtpais" name="get_txtpais" title="Por favor ingrese el pais" value="<?php print $cls_reservas->getpais();?>" class="input-short" />
			<span class="notification-input ni-correct"></span>
		</p>
		
		 <p>
			<label>Paquete Interesado:</label>
			 <select name="getfk_destino"  class="input-long" id="getfk_destino" title="Seleccione el destino">
			  <option value="">Seleccione</option>
			  <?php print cls_tbl_paquete::ListaPaquetes($cls_reservas->getfk_destino());?>
			</select>
			<span class="notification-input ni-correct"></span>
		</p>
		
		  <p>
			<label>Cantidad de personas Adultas:</label>
			<input type="text" id="get_txtcantidad_adultas" name="get_txtcantidad_adultas" title="Por favor ingrese la cantidad de personas a viajar" value="<?php print $cls_reservas->gettxt_cantidad_adultos();?>" class="input-short" />
			<span class="notification-input ni-correct"></span>
		 </p>
	 	
           <p>
			<label>Cantidad de personas Niños:</label>
			<input type="text" id="get_txtcantidad_ninos" name="get_txtcantidad_ninos" title="Por favor ingrese la cantidad de personas a viajar" value="<?php print $cls_reservas->gettxt_cantidad_ninos();?>" class="input-short" />
			<span class="notification-input ni-correct"></span>
		  </p>
        
	   <p>
			<label>Fecha de Salida:</label>
			<input name="getdate_viaje_salida" title="por favor ingrese la fecha de viaje" type="text" class="input-short" id="getdate_viaje_salida" value="<?php
        if(tep_not_null($cls_reservas->gettxt_fecha_salida()) && $cls_reservas->gettxt_fecha_salida()!='0000-00-00')
		echo Date::convert($cls_reservas->gettxt_fecha_salida(),'Y-m-d','Y-m-d');?>"  />
		 <img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />(año-mes-dia) click en el icono para seleccionar la fecha
			<span class="notification-input ni-correct"></span>
		</p>
        
         <p>
			<label>Fecha de Retorno:</label>
			<input name="getdate_viaje_retorno" title="por favor ingrese la fecha de viaje" type="text" class="input-short" id="getdate_viaje_retorno" value="<?php
        if(tep_not_null($cls_reservas->gettxt_fecha_retorno()) && $cls_reservas->gettxt_fecha_retorno()!='0000-00-00')
		echo Date::convert($cls_reservas->gettxt_fecha_retorno(),'Y-m-d','Y-m-d');?>"  />
		 <img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar02" width="16" height="16" id="icon_calendar02" />(año-mes-dia) click en el icono para seleccionar la fecha
			<span class="notification-input ni-correct"></span>
		</p>
		
		  <p>
				<label>Email:</label>
				<input type="text" id="get_txtemail" name="get_txtemail" title="Por favor ingrese el correo electronico" value="<?php print $cls_reservas->gettxt_email();?>" class="input-short" />
				<span class="notification-input ni-correct"></span>
			</p>
			
		<p>
			<label>Teléfono Fijo:</label>
			<input type="text" id="get_txtfono" name="get_txtfono" title="Por favor ingrese el numero de telefono" value="<?php print $cls_reservas->gettxt_telefono();?>" class="input-short" />
			<span class="notification-input ni-correct"></span>
		</p>
        
        <p>
			<label>Celular:</label>
			<input type="text" id="get_txtcelular" name="get_txtcelular" title="Por favor ingrese el numero de celular" value="<?php print $cls_reservas->gettxt_celular();?>" class="input-short" />
			<span class="notification-input ni-correct"></span>
		</p>
        
        <p>
			<label>Hoteles:</label>
			<input type="text" id="get_txthoteles" name="get_txthoteles" title="Por favor ingrese los hoteles" value="<?php print $cls_reservas->gettxt_hoteles();?>" class="input-long" />
			<span class="notification-input ni-correct"></span>
		</p>
		
		 <p>
			<label>Comentario:</label>
			<textarea name="txt_comentario" class="input-medium" id="txt_comentario" cols="60" rows="10" title="Ingrese algun comentario"><?php echo $cls_reservas->gettxt_comentario()?></textarea>
		</p>
		
		 <p>
			<label>Fecha de registro:</label>
			<?php print $cls_reservas->getdate_fecha();?>
			<input name="txt_date" type="hidden" title="ingrese" class="Field120" id="txt_date" value="<?php print $cls_reservas->getdate_fecha();?>" />
		</p>
		
		<h1>AGENCIA</h1>	
		 <p>
			<label>TIPO DE INGRESO:</label>
		 <select name="get_tipo" class="input-short" id="get_tipo" title="Seleccione el tipo">
         <option value=""> Seleccione</option>
         <option value="Formulario Web"       <?php echo $select=($cls_reservas->gettxt_tipo()=="Formulario Web")?"selected":"";?>>Formulario Web</option>
		 <option value="Llamada Telefonica"   <?php echo $select=($cls_reservas->gettxt_tipo()=="Llamada Telefonica")?"selected":"";?>>Llamada Telefonica</option>
		 <option value="Facebook"             <?php echo $select=($cls_reservas->gettxt_tipo()=="Facebook")?"selected":"";?>>Facebook</option>
		 <option value="Correo"               <?php echo $select=($cls_reservas->gettxt_tipo()=="Correo")?"selected":"";?>>Correo : Informes</option>
		 <option value="Contactenos"          <?php echo $select=($cls_reservas->gettxt_tipo()=="Contactenos")?"selected":"";?>>Formulario Contactenos</option>
        </select>
		</p>
		
		 <p>
		<label>Counter:</label>
		 <select name="get_vendedor"  class="input-short" id="get_vendedor" title="Seleccione al vendedor">
         <option value=""> Seleccione</option>
         <option value="Elizabeth"   <?php echo $select=($cls_reservas->gettxt_vendedor()=="Elizabeth")?"selected":"";?>>Elizabeth</option>
          <option value="Counter 01"   <?php echo $select=($cls_reservas->gettxt_vendedor()=="Counter 01")?"selected":"";?>>Counter 01</option>				
        </select>
		</p>
		
		 <p>
			<label>Contactarse para el:</label>
			<input name="getdate_llamar" title="por favor ingrese la fecha de volver a contactarse" type="text" class="input-short" id="getdate_llamar" value="<?php
        if(tep_not_null($cls_reservas->gettxt_fecha_llamar()) && $cls_reservas->gettxt_fecha_llamar()!='0000-00-00')
		echo Date::convert($cls_reservas->gettxt_fecha_llamar(),'Y-m-d','Y-m-d');?>" size="20" maxlength="10" />
        <img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar2" width="16" height="16" id="icon_calendar2" />(año-mes-dia)
		</p>
		
		 <p>
			<label>Observacion:</label>
			<textarea class="input-medium" name="txt_nota" id="txt_nota" cols="60" rows="10" title="Ingrese la nota"><?php echo $cls_reservas->gettxt_nota()?></textarea>
		</p>
		
		 <p>
			<label>Estado:</label>
		<select name="getfk_estado" class="input-short" id="getfk_estado" title="Seleccione el estado">
          <option value="">Seleccione</option>
          <?php print cls_tbl_estado::ListaEstado($cls_reservas->getfk_estado());?>
        </select>
		<input type="hidden" name="id" id="id"  value="<?php print $CId?>"/>
		</p>
		
		 <p>
			<label>Numero de Reserva:</label>
			 <input type="text" id="get_txtreserva" name="get_txtreserva" title="Por favor ingrese el numero de reserva" value="<?php echo $cls_reservas->gettxt_reserva()?>" class="input-short" />
		</p>
		
		 <fieldset>
			
		<?php if($IsActionG==0) { ?>
          <input type="Button" value="Actualizar Solicitud"  class='submit-green' id="btn_save"/>
        <?php 	}
		else{?>
        <input type="Button" value="Guardar Solicitud" class='submit-green' id="btn_save"/>
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_reservas.php'" class='submit-gray'  />
		
		
		</fieldset>
				
</form>
	</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<script  language="javascript" type="text/javascript" src="js/jform_reservas.js"></script>
<script language="javascript" type="text/javascript">

/*  CALENDAR  */
Zapatec.Calendar.setup({
		
inputField     :    "getdate_llamar",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar2",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>

<script language="javascript" type="text/javascript">

/*  CALENDAR  */
Zapatec.Calendar.setup({
		
inputField     :    "getdate_viaje_salida",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>

<script language="javascript" type="text/javascript">

/*  CALENDAR  */
Zapatec.Calendar.setup({
		
inputField     :    "getdate_viaje_retorno",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar02",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>

<!--  Footer  -->
<?php
require_once("footer.php");
?>