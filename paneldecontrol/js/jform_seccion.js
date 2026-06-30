(function() {
   $("#btn_save").click(function(e){
	  
       var submitButton = $("#btn_save");
	   var $this = this; var status=true;
       
	   //Titulo del banner
	  if(jQuery.trim($('#txt_title').val())==""){$("#msg_seccion").html($('#txt_title').attr('title')).addClass('msg-error'); $('#txt_titlevideo').focus(); status=false;
      }else{ $("#msg_seccion").html("").removeClass('msg-error');}
	  
	  
      var MathNumber = /^([0-9])*$/ ;
	  
	  if (jQuery.trim($('#txt_order').val())=='' || !MathNumber.test(jQuery.trim($("#txt_order").val()))   ) {
		$("#msg_order").html($('#txt_order').attr('title')).addClass('msg-error'); $('#txt_order').focus(); status=false;																						      }else{
		$("#msg_order").html("").removeClass('msg-error');	
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