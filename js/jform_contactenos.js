var $hb = jQuery.noConflict();

$hb(document).ready(function(){
	 $hb("#btn_submit").removeAttr('disabled');
	 $hb('#form5').submit(function(e) {
    //$('#btn_reguser').click(function(e) {
		Contactenos();
		e.preventDefault();
		
	});
	
});

function valEmail(valor){
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(valor))    {
        return false;
    }else{
        return true;
    }
}


function Contactenos()
{
	hideshow('ImgLoadingContact',1);
	error(0,'');
	var MathNumber = /^([0-9])*$/ ;
	
	var submitButton = $hb("#btn_submit");
	btnText = $hb(submitButton).attr("value");

	var MyNombres = $hb("#txt_nombres").val();
	var MyEmail = $hb("#txt_email").val();
	var MyTelefono = $hb("#txt_telefono").val();
	var MyMensaje = $hb("#txt_mensaje").val();


	if(MyNombres==''){error(1,$hb('#txt_nombres').attr('title'));hideshow('ImgLoadingContact',0);return(false);}
	if(!valEmail(MyEmail) ){error(1,$hb('#txt_email').attr('title'));hideshow('ImgLoadingContact',0);return(false);}
	if(MyTelefono==''){error(1,$hb('#txt_telefono').attr('title'));hideshow('ImgLoadingContact',0);return(false);}
	if(MyMensaje==''){error(1,$hb('#txt_mensaje').attr('title'));hideshow('ImgLoadingContact',0);return(false);}

	$hb.ajax({
		type: "POST",
		url: "control_contactenos.php",
		data: $hb('#form5').serialize(),
		dataType: "json",
		        beforeSend : function (){
				$hb(submitButton).attr("value", "Validando Datos...");
        		$hb(submitButton).attr("disabled", "true");
				},success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				$hb("#btn_submit").attr("value", "Enviado !");
				success(1,msg.txt);
				setTimeout(function(){
	               //success(1,msg.txt);
				   $hb("#btn_submit").attr("value", btnText);
				   $hb("#btn_submit").removeAttr('disabled');
				   $hb('#form5').get(0).reset()
                }, 750);


				setTimeout(function(){
      				location.href= 'index.php';
			    },3000);
				//window.location=msg.txt;
			}
			else if(parseInt(msg.status)==0)
			{
				//$("#btn_sendmail").attr("value", "Registrado");
				error(1,msg.txt);
				setTimeout(function(){
	               //success(1,msg.txt);
				   $hb("#btn_submit").attr("value", btnText);
				   $hb("#btn_submit").removeAttr('disabled');
				   //$('#FormRegister').get(0).reset()
                }, 100);
			}
			
			hideshow('ImgLoadingContact',0);
		}
	});

}


function hideshow(el,act)
{
	if(act) $hb('#'+el).css('visibility','visible');
	else $hb('#'+el).css('visibility','hidden');
}

function error(act,txt)
{
	$hb("#message_formcontact").addClass('error_');
	hideshow('message_formcontact',act);
	if(txt) $hb('#message_formcontact').html(txt);
}

function success(act,txt)
{
	$hb("#message_formcontact").addClass('success_');
	hideshow('message_formcontact',act);
	if(txt) $hb('#message_formcontact').html(txt);
}
