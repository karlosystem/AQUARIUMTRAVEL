(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;

	  if(jQuery.trim($('#get_datenoticia').val())=="" || $('#get_datenoticia').val()=='0000-00-00' ){$("#msg_datenoticia").html($('#get_datenoticia').attr('title')).addClass('msg-error'); $('#get_datenoticia').focus(); status=false;
      }else{ $("#msg_datenoticia").html("").removeClass('msg-error');}
	
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