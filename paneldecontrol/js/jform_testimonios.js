// JavaScript Document
(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;

	  if(jQuery.trim($('#get_datetestimonio').val())=="" || $('#get_datetestimonio').val()=='0000-00-00' ){$("#msg_datetestimonio").html($('#get_datetestimonio').attr('title')).addClass('msg-error'); $('#get_datetestimonio').focus(); status=false;
      }else{ $("#msg_datetestimonio").html("").removeClass('msg-error');}
	
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