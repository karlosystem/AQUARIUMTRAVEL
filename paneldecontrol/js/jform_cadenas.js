(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;
		
		
  if(jQuery.trim($('#get_txtnombre').val())==""){$("#msg_descripcion").html($('#get_txtnombre').attr('title')).addClass('msg-error'); $('#get_txtnombre').focus(); status=false;
  }else{ $("#msg_descripcion").html("").removeClass('msg-error');}
  
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