(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;
		
		
  if(jQuery.trim($('#get_txttitulo').val())==""){$("#msg_titulo").html($('#get_txttitulo').attr('title')).addClass('msg-error'); $('#get_txttitulo').focus(); status=false;
  }else{ $("#msg_titulo").html("").removeClass('msg-error');}

  if(jQuery.trim($('#get_txtganador').val())==""){$("#msg_ganador").html($('#get_txtganador').attr('title')).addClass('msg-error'); $('#get_txtganador').focus(); status=false;
  }else{ $("#msg_ganador").html("").removeClass('msg-error');}
  
  if(jQuery.trim($('#get_txtempresa').val())==""){$("#msg_empresa").html($('#get_txtempresa').attr('title')).addClass('msg-error'); $('#get_txtempresa').focus(); status=false;
  }else{ $("#msg_empresa").html("").removeClass('msg-error');}
  
  if(jQuery.trim($('#get_txtcargo').val())==""){$("#msg_cargo").html($('#get_txtcargo').attr('title')).addClass('msg-error'); $('#get_txtcargo').focus(); status=false;
  }else{ $("#msg_cargo").html("").removeClass('msg-error');}
  
  
	  if(jQuery.trim($('#getdate_dateadd').val())=="" || $('#getdate_dateadd').val()=='0000-00-00' ){$("#msg_datesorteo").html($('#getdate_dateadd').attr('title')).addClass('msg-error'); $('#get_datesorteo').focus(); status=false;
      }else{ $("#msg_datesorteo").html("").removeClass('msg-error');}
	
	  if(!status) return false;
	  
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