extensiones_img = new Array(".jpg", ".jpeg", ".gif");

(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;
	  
	  /*
	  if ($("#file_upads").val() !='' && !isExtension($("#file_upads").val(),extensiones_img)  ) {
		$("#msg_fileupload").html($('#file_upads').attr('title')).addClass('msg-error'); $('#file_upads').focus(); status=false;   
	  }else{
		$("#msg_fileupload").html("").removeClass('msg-error');  
	  }
	  */
	  
	  if (jQuery.trim($('#sle_position').val())=='' || $('#sle_position').val()=='0') {
		$("#msg_position").html($('#sle_position').attr('title')).addClass('msg-error'); $('#sle_position').focus(); status=false;																						      }else{
		$("#msg_position").html("").removeClass('msg-error');	
	  }
	  
	  var MathNumber = /^([0-9])*$/ ;
	  
	  if (jQuery.trim($('#txt_order').val())=='' || !MathNumber.test(jQuery.trim($("#txt_order").val()))   ) {
		$("#msg_order").html($('#txt_order').attr('title')).addClass('msg-error'); $('#txt_order').focus(); status=false;																						      }else{
		$("#msg_order").html("").removeClass('msg-error');	
	  }
	  
	  
	  if ($('#chk_ispopup').attr('checked')) {
	    if(jQuery.trim($('#txt_wpopup').val())=='' || jQuery.trim($('#txt_hpopup').val())=='' || !MathNumber.test(jQuery.trim($("#txt_wpopup").val())) || !MathNumber.test(jQuery.trim($("#txt_hpopup").val())) ){
		  $("#msg_dimensionpoup").html("Ingrese un ancho y alto mayores a cero").addClass('msg-error'); 
		  status=false;
		}
		else{
		 $("#msg_dimensionpoup").html("").removeClass('msg-error');	
		}
	  }else{
		$("#msg_dimensionpoup").html("").removeClass('msg-error');	
	  }
	  
	  
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

function ChangePosition(valrb){

 	if(!valrb || typeof valrb=='undefined'){var valrb=0;}
    
	$("#row_opcadicional1").hide(); 
	$("#row_opcadicional2").hide();

	switch(valrb){
	 	case '1': $("#hwidth").val('710');  $("#hheight").val('403');	break;
		case '2': $("#hwidth").val('650');  $("#hheight").val('332');	break;
		case '2': $("#hwidth").val('230');  $("#hheight").val('413');	break;
	}

 }

function StatusPopUp(MyVal){
 if(!MyVal || typeof MyVal == 'undefined'){var MyVal;}
 if(MyVal=='1' || MyVal==true){
  	$("#whpopup").show();
 }
 else{
    $("#whpopup").hide();	
 }
}

function RbText(MyVal){
 	if(!MyVal || typeof MyVal == 'undefined'){var MyVal;}
	if(MyVal==4){
     $('#get_bgcolor').removeAttr("disabled");
	}else{
	  $('#get_bgcolor').attr("disabled", true);
	  $('#get_bgcolor').val('');
	}
}