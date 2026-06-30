var disableLoadingIndicator;
disableLoadingIndicator = false;

function ShowLoadingIndicator() {
	if (typeof(disableLoadingIndicator) != 'undefined' && disableLoadingIndicator) {
		return;
	}
	var windowWidth = $(window).width();
	var scrollTop;
	if(self.pageYOffset) {
		scrollTop = self.pageYOffset;
	}
	else if(document.documentElement && document.documentElement.scrollTop) {
		scrollTop = document.documentElement.scrollTop;
	}
	else if(document.body) {
		scrollTop = document.body.scrollTop;
	}
	$('#AjaxLoading').css('position', 'absolute');
	$('#AjaxLoading').css('top', scrollTop+'px');
	$('#AjaxLoading').css('left', parseInt((windowWidth-150)/2)+"px");
	$('#AjaxLoading').show();
	$('body').css('cursor', 'wait');
	//$('#AjaxLoading').css('display','block');
}

function HideLoadingIndicator() {
	$('#AjaxLoading').hide();
	$('body').css('cursor', 'default');
	//$('#AjaxLoading').css('display','none');
}


function checkAll(chkbox) 
{ 
	for (var i=0;i < chkbox.form.elements.length;i++) 
	{ 
		var elemento = chkbox.form.elements[i]; 
		if (elemento.type == "checkbox") 
		{ 
			elemento.checked = chkbox.checked 
		} 
	} 
}


function isExtension(file,extensiones_permitidas){
extension = (file.substring(file.lastIndexOf("."))).toLowerCase();
permitida = false;

for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      }
 
if (!permitida) {
return(false);
}else{
return(true);
}

}


function registrar(Params)
{
if(!Params)
var Params = "";

eval("document."+MyForm+".action='"+urlProcess+"?op=1"+Params+"'");
eval("document."+MyForm+".submit();");	
}

function editar(Params)
{
if(!Params)
var Params = "";

eval("document."+MyForm+".action='"+urlProcess+"?op=2"+Params+"'");
eval("document."+MyForm+".submit();");	
}


function RemoveImgAlbum(id,FileName,ParamAdtional){
 	
	if(!id)
	var id = 0 ;
	
	if(!ParamAdtional)
	var ParamAdtional=0;
	
	var IsRemove = confirm("¿ Esta seguro de eliminar esta imagen:\n'"+FileName+"' ?");
	if(IsRemove)
	 {
			jQuery.ajax({
				type: "POST",
				url: urlProcess,
				data: "idphoto="+id+"&op=8&"+ParamAdtional,
				beforeSend : function (){
				ShowLoadingIndicator();
				//$("#"+IsRowSlow+""+id).fadeOut("slow");
				},
				success: function(datos)
						 {	
						 $("#"+IsRowSlow+""+id).fadeOut("slow");
						 HideLoadingIndicator();
						 }
			})	 
	 }
	
}

function eliminar(id,message,Params)
{	
    var MsgElement ;
	MsgElement = message;
	
	if(!Params)
    var Params = "";


	var IsRemove = confirm("¿ Esta seguro de eliminar este registro:\n"+MsgElement+" ?")	
	if (IsRemove) 
	{   
	jQuery.ajax({
		type: "POST",
		url: urlProcess,
		data: "id="+id+"&op=3"+Params,
		beforeSend : function (){
		ShowLoadingIndicator();
		//$("#"+IsRowSlow+""+id).fadeOut("slow");
		},
		success: function(datos)
				 {	
				 $("#"+IsRowSlow+""+id).fadeOut("slow");
				 HideLoadingIndicator();
				 }
	})
	}/*IF REMOVE*/
}


function RemoveImages(id,FileName,ParamAdtional){
 	
	if(!id)
	var id = 0 ;
	
	if(!ParamAdtional)
	var ParamAdtional=0;
	
	var IsRemove = confirm("¿ Esta seguro de eliminar esta imagen:\n'"+id+"' ?");
	if(IsRemove)
	 {
			jQuery.ajax({
				type: "POST",
				url: urlProcess,
				data: "idphoto="+id+"&op=10&"+ParamAdtional,
				beforeSend : function (){
				ShowLoadingIndicator();
				//$("#"+IsRowSlow+""+id).fadeOut("slow");
				},
				success: function(datos)
						 {	
						 $("#"+IsRowSlow+""+id).fadeOut("slow");
						 HideLoadingIndicator();
						 }
			})	 
	 }
	
}

function UpdateStatus(id,Params)
{

    var div = "#idEstado"+id;
	if(!Params)
    var Params = "";
	
	jQuery.ajax({
		type: "GET",
		url: urlProcess,
		data: "id="+id+"&op=4"+Params,
		success: function(datos)
				 {	jQuery(div).html(datos); }
	})
}
function activar_todos(Params)
{
	if(!Params)
    var Params = "";
	
eval("document."+MyForm+".action='"+urlProcess+"?op=6"+Params+"'");
eval("document."+MyForm+".submit();");	
}

function desactivar_todos(Params)
{
	if(!Params)
    var Params = "";
	
eval("document."+MyForm+".action='"+urlProcess+"?op=7"+Params+"'");
eval("document."+MyForm+".submit();");	
}

function eliminar_todos(Params)
{
	if(!Params)
    var Params = "";
	
eval("document."+MyForm+".action='"+urlProcess+"?op=5"+Params+"'");
eval('document.'+MyForm+'.submit();');	
}

function open_window(tupagina,w,h,namepopup) 
{ 
   var altura_popup=h; 
   var H = (screen.height - altura_popup) / 2; 
   var anchura_popup=w; 
   var L = (screen.width - anchura_popup) / 2; 
   if(!namepopup){
   var namepopup = 'popup';
   }
   pop_up = window.open(tupagina,namepopup,"status=no,scrollbars=yes,resizable=no,height="+altura_popup+",width="+anchura_popup+",top="+H+",left="+L); 
}
