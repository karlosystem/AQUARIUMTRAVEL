function comprobarSiBisisesto(anio){
if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
	return true;
	}
else {
	return false;
	}
}

function esFechaValida(fecha){

       if (fecha != undefined && fecha.value != "" ){
		if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)){
			//alert("formato de fecha no válido (dd/mm/aaaa)");
			return false;
		}
		var dia  =  parseInt(fecha.value.substring(0,2),10);
		var mes  =  parseInt(fecha.value.substring(3,5),10);
		var anio =  parseInt(fecha.value.substring(6),10);
	switch(mes){
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			numDias=31;
			break;
		case 4: case 6: case 9: case 11:
			numDias=30;
			break;
		case 2:
			if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
			break;
		default:
			//alert("Fecha introducida errónea");
			return false;
	}
		if (dia>numDias || dia==0){
			//alert("Fecha introducida errónea");
			return false;
		}
		return true;
	}
}

(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;
	  
	  // Fecha del evento
	  if (jQuery.trim($('#txt_albumdate').val())=='' || !esFechaValida(document.getElementById('txt_albumdate'))  ) {
		$("#msg_albumdate").html($('#txt_albumdate').attr('title')).addClass('msg-error'); $('#txt_albumdate').focus(); status=false;
      }else{ 
	    $("#msg_albumdate").html("").removeClass('msg-error');
	  }
	  
      
	  if(!status) return false;
	  //alert(IsAction);
	  if(status) {
			$(submitButton).attr("value", "Por favor espere...");
        	$(submitButton).attr("disabled", "true");
			
			if(IsAction==0){
			editar();
			}else{
			registrar();
			}
	  }
	  
	  
	  
	  
	 
	  
   });

})(jQuery);