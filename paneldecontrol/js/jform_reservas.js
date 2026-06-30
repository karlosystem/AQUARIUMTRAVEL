// JavaScript Document
(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;
		
		
  if(jQuery.trim($('#get_vendedor').val())==""){$("#msg_vendedor").html($('#get_vendedor').attr('title')).addClass('msg-error'); $('#get_vendedor').focus(); status=false;
  }else{ $("#msg_vendedor").html("").removeClass('msg-error');}
  
  
  
  

  if(jQuery.trim($('#txt_nota').val())==""){$("#msg_nota").html($('#txt_nota').attr('title')).addClass('msg-error'); $('#txt_nota').focus(); status=false;
  }else{ $("#msg_nota").html("").removeClass('msg-error');}
  
  
  
  if(jQuery.trim($('#getfk_estado').val())==""){$("#msg_estado").html($('#getfk_estado').attr('title')).addClass('msg-error'); $('#getfk_estado').focus(); status=false;
  }else{ $("#msg_estado").html("").removeClass('msg-error');}
  
	
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