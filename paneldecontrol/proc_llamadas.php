<?php
@ob_start();
@session_start();

require_once("../init.php");
require_once("loadclass.php");

$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if (!$UserLoad->is_user_logged_in())
	header("Location: index.php");


$id = (int)(tep_not_null($_GET['id'])) ? $_GET['id'] : $_POST['id'];
$op = (int)(tep_not_null($_GET['op'])) ? $_GET['op'] : $_POST['op'];


$cnt_llamadas = new cls_tbl_llamadas($id);

$cnt_llamadas->settxt_nombre($_POST['get_txtnombre']);
$cnt_llamadas->settxt_destino($_POST['get_txtdestino']);

$thisdateviaje = stripslashes_deep($_POST['getdate_viaje_salida']);
if (tep_not_null($thisdateviaje) && $thisdateviaje != '00-00-0000')
	$thisdateviaje = Date::convert($thisdateviaje, 'm-d-Y H:i:s', 'Y-m-d H:i:s');

//echo $thisdateviaje;
//exit();

$cnt_llamadas->settxt_fecha($thisdateviaje); #fecha de la noticia

$cnt_llamadas->settxt_email($_POST['get_txtemail']);
$cnt_llamadas->settxt_telefono1($_POST['get_txtTelefono01']);
$cnt_llamadas->settxt_telefono2($_POST['get_txtTelefono02']);
$cnt_llamadas->settxt_tipo($_POST['get_tipo']);
$cnt_llamadas->settxt_personal($_POST['get_personal']);
$cnt_llamadas->setint_status($_POST['getfk_estado']);
$cnt_llamadas->settxt_observacion($_POST['txt_nota']);

switch ($op) {
	case 1:	//guardar
		$cnt_llamadas->guarda();
		$idsec = $cnt_llamadas->getid_llamada();
		break;
	case 2: //Actualizar	
		$cnt_llamadas->setid_llamada($id);
		$sorteo_borrar = new cls_tbl_llamadas($id);
		$cnt_llamadas->actualiza();

		break;
	case 3: //Eliminar	
		$cnt_llamadas = new cls_tbl_llamadas($id);
		$cnt_llamadas->elimina();

		break;
	case 4: //Estado	
		$cnt_llamadas = new cls_tbl_llamadas($id);
		@$cnt_llamadas->estado();
		break;

	case 5: //Activar check
		if (!empty($_POST["chkreserva"])) {
			foreach ($_POST["chkreserva"] as $valor) {
				if ($_POST["chkreserva"]) {
					$sorteo = new cls_tbl_llamadas($valor);
					@$sorteo->estado("1");
				}
			}		// foreach
		}
		break;

	case 6: //Desactivar check
		if (!empty($_POST["chkreserva"])) {
			foreach ($_POST["chkreserva"] as $id => $valor) {
				if ($_POST["chkreserva"]) {
					$sorteo = new cls_tbl_llamadas($valor);
					@$sorteo->estado("0");
				}
			}		// foreach
		}
		break;

	case 7: //Remover check
		if (!empty($_POST["chkreserva"])) {
			foreach ($_POST["chkreserva"] as $id => $valor) {
				if ($_POST["chkreserva"]) {
					$sorteo = new cls_tbl_llamadas($valor);
					$sorteo->elimina();
				}
			}		// foreach
		}
		break;
}


if (($op == 1) || ($op == 2) || ($op == 3) ||  ($op == 5) ||   ($op == 6) ||  ($op == 7)) {
	header("location: inf_llamadas.php");
} else if ($op != 4) {
	unset($_SESSION['webuser']);
	header("location: index.php");
}
