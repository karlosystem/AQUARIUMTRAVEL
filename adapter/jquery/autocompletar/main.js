// JavaScript Document
$().ready(function() {

	function findValueCallback(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	
	$("#palabra").autocomplete("busq_producto.php?op=1",
	{	width: 198,
		selectFirst: false
	});
	

	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
});
