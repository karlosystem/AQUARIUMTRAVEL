// JavaScript Document
(function () {
  $("#btn_save").click(function (e) {

    var submitButton = $("#btn_save");
    var $this = this; var status = true;


    if (jQuery.trim($('#get_txtnombre').val()) == "") {
      $("#msg_nombre").html($('#get_txtnombre').attr('title')).addClass('msg-error'); $('#get_txtnombre').focus(); status = false;
    } else { $("#msg_nombre").html("").removeClass('msg-error'); }

    if (jQuery.trim($('#getdate_viaje_salida').val()) == "") {
      $("#msg_fecha").html($('#getdate_viaje_salida').attr('title')).addClass('msg-error'); $('#getdate_viaje_salida').focus(); status = false;
    } else { $("#msg_fecha").html("").removeClass('msg-error'); }

    if (jQuery.trim($('#get_txtdestino').val()) == "") {
      $("#msg_destino").html($('#get_txtdestino').attr('title')).addClass('msg-error'); $('#get_txtdestino').focus(); status = false;
    } else { $("#msg_destino").html("").removeClass('msg-error'); }

    if (jQuery.trim($('#get_txtTelefono01').val()) == "") {
      $("#msg_telefono01").html($('#get_txtTelefono01').attr('title')).addClass('msg-error'); $('#get_txtTelefono01').focus(); status = false;
    } else { $("#msg_telefono01").html("").removeClass('msg-error'); }

    if (jQuery.trim($('#get_tipo').val()) == "") {
      $("#msg_tipo").html($('#get_tipo').attr('title')).addClass('msg-error'); $('#get_tipo').focus(); status = false;
    } else { $("#msg_tipo").html("").removeClass('msg-error'); }


    if (jQuery.trim($('#get_personal').val()) == "") {
      $("#msg_personal").html($('#get_personal').attr('title')).addClass('msg-error'); $('#get_personal').focus(); status = false;
    } else { $("#msg_personal").html("").removeClass('msg-error'); }

    if (jQuery.trim($('#getfk_estado').val()) == "") {
      $("#msg_estado").html($('#getfk_estado').attr('title')).addClass('msg-error'); $('#getfk_estado').focus(); status = false;
    } else { $("#msg_estado").html("").removeClass('msg-error'); }


    if (!status) return false;

    if (status) {
      $(submitButton).attr("value", "Por favor espere...");
      $(submitButton).attr("disabled", "true");

      if (IsAction == 0) {
        editar();
      } else {
        registrar();
      }
    }



  });

})(jQuery);