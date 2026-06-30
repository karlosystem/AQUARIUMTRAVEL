var p = jQuery.noConflict();
p(document).ready(function(){
	 p("#btn_submit").removeAttr('disabled');
	 p('#FormRegister').submit(function(e) {
    //$('#btn_reguser').click(function(e) {
		Register();
		e.preventDefault();
		
	});
	
});

function Register()
{




	hideshow('ImgLoadingRegister',1);
	error(0,'');
	
	var submitButton = p("#btn_submit");
	btnText = p(submitButton).attr("value");
	filtermail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	if(p.trim(p("#txt_nombres").val())==''){
		 error(1,"Ingrese su nombre respectivo!");hideshow('ImgLoadingRegister',0);return(false);
	}
	
		if(p.trim(p("#txt_apellidos").val())==''){
			error(1,"Ingrese su apellido respectivo!");hideshow('ImgLoadingRegister',0);return(false);	
		}
		   if (p("#txt_email").val()=='' || !filtermail.test(p("#txt_email").val())){
			   error(1,"Ingrese un e-mail valido");hideshow('ImgLoadingRegister',0);
			   return(false);
		   }
		   
		   	if(p.trim(p("#txt_telefono").val())==''){
					error(1,"Ingrese un numero de telefono o celular!");hideshow('ImgLoadingRegister',0);return(false);	
				}
		   
				if(p.trim(p("#txt_fecha_salida").val())==''){
					error(1,"Ingrese la fecha de salida, click en el icono de calendario!");hideshow('ImgLoadingRegister',0);return(false);	
				}
			   
			   if(p.trim(p("#txt_cantidad_adultos").val())==''){
					error(1,"Ingrese la cantidad de personas adultas a viajar!");hideshow('ImgLoadingRegister',0);return(false);	
				}
				
				if(p.trim(p("#txt_mensaje").val())==''){
					error(1,"Ingrese alguna anotacion adicional!");hideshow('ImgLoadingRegister',0);return(false);	
				}

					if(p("#get_captcha").val()==''){
						error(1,"La Longitud del codigo de seguridad no es valido, intente de nuevo!");hideshow('ImgLoadingRegister',0);
						return(false);
					}

	
	
	p.ajax({
		type: "POST",
		url: "control_reservas.php",
		data: p('#FormRegister').serialize(),
		dataType: "json",
		        beforeSend : function (){
				p(submitButton).attr("value", "Validando...");
        		p(submitButton).attr("disabled", "true");
				},success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				p("#btn_submit").attr("value", "Enviado");
				success(1,msg.txt);
				setTimeout(function(){
	               //success(1,msg.txt);
				   p("#btn_submit").attr("value", btnText);
				   p("#btn_submit").removeAttr('disabled');
				   p('#FormRegister').get(0).reset()
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
				   p("#btn_submit").attr("value", btnText);
				   p("#btn_submit").removeAttr('disabled');
				   //$('#FormRegister').get(0).reset()
                }, 100);
			}
			
			hideshow('ImgLoadingRegister',0);
		}
	});

}


function hideshow(el,act)
{
	if(act) p('#'+el).css('visibility','visible');
	else p('#'+el).css('visibility','hidden');
}

function error(act,txt)
{
	p("#message_form").addClass('error_');
	hideshow('message_form',act);
	if(txt) p('#message_form').html(txt);
}

function success(act,txt)
{
	p("#message_form").addClass('success_');
	hideshow('message_form',act);
	if(txt) p('#message_form').html(txt);
}
