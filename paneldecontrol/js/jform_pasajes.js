var $p = jQuery.noConflict();
(function() {
   $p("#btn_save").click(function(e){
	  
	  var submitButton = $p("#btn_save");
      var $this = this; var status=true;

	  if(jQuery.trim($p('#get_datepasaje').val())=="" || $p('#get_datepasaje').val()=='0000-00-00' ){$p("#msg_datepasaje").html($p('#get_datepasaje').attr('title')).addClass('msg-error'); $p('#get_datepasaje').focus(); status=false;
      }else{ $p("#msg_datepasaje").html("").removeClass('msg-error');}
	
	  if(!status) return false;
	  
      if(status) {
		  $p(submitButton).attr("value", "Por favor espere...");
		  $p(submitButton).attr("disabled", "true");
			
		if(IsAction==0){
		editar();
		}else{
		registrar();
		}
	  }
	  
  
   });

})(jQuery);

function RbText(MyVal){
 	if(!MyVal || typeof MyVal == 'undefined'){var MyVal;}
	if(MyVal==4){
      $p('#get_bgcolor').removeAttr("disabled");
	}else{
	  $p('#get_bgcolor').attr("disabled", true);
	  $p('#get_bgcolor').val('');
	}
}