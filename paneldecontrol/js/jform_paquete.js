
(function () {
	$("#btn_save").click(function (e) {

		var submitButton = $("#btn_save");
		var $this = this; var status = true;

		if (jQuery.trim($('#sle_category').val()) == "") {
			$("#msg_category").html($('#sle_category').attr('title')).addClass('msg-error'); $('#sle_category').focus(); status = false;
		} else { $("#msg_category").html("").removeClass('msg-error'); }

		// if (jQuery.trim($('#name_paquete[2]').val()) == "") {
		// 	$("#msg_paquete").html($('#name_paquete[]').attr('title')).addClass('msg-error'); $('#name_paquete[]').focus(); status = false;
		// } else { $("#msg_paquete").html("").removeClass('msg-error'); }

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