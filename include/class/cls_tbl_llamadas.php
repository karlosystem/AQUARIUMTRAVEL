<?php

class cls_tbl_llamadas
{
  var $id;
  var $txt_fecha;
  var $txt_hora;
  var $txt_nombre;
  var $txt_destino;
  var $txt_telefono01;
  var $txt_telefono02;
  var $txt_email;
  var $txt_tipo;
  var $txt_personal;
  var $txt_observacion;
  var $fecha_alta;
  var $fk_estado;

  function cls_tbl_llamadas($id = 0)
  {
    if ($id != 0) {
      $sql = "SELECT id, fecha, hora, nombre, destino, telefono1, telefono2, email, observacion, personal, fecha_alta, fk_estado, tipo FROM [|PREFIX|]llamadas WHERE id = '" . $id . "' ORDER BY id DESC";

      $fila = $GLOBALS['CONNECT_DB']->Query($sql);
      $fila = $GLOBALS['CONNECT_DB']->Fetch($fila);

      $this->setid_llamada($fila['id']);
      $this->settxt_fecha($fila['fecha']);
      $this->settxt_hora($fila['hora']);
      $this->settxt_nombre($fila['nombre']);
      $this->settxt_destino($fila['destino']);
      $this->settxt_telefono1($fila['telefono1']);
      $this->settxt_telefono2($fila['telefono2']);
      $this->settxt_email($fila['email']);
      $this->settxt_tipo($fila['tipo']);
      $this->settxt_observacion($fila['observacion']);
      $this->settxt_personal($fila['personal']);
      $this->setint_status($fila['fk_estado']);
    } else {
      $this->setid_llamada('');
      $this->settxt_fecha('');
      $this->settxt_hora('');
      $this->settxt_nombre('');
      $this->settxt_destino('');
      $this->settxt_telefono1('');
      $this->settxt_telefono2('');
      $this->settxt_email('');
      $this->settxt_tipo('');
      $this->settxt_observacion('');
      $this->settxt_personal('');
      $this->setint_status('');
    }
  }

  function setid_llamada($id)
  {
    $this->id = $id;
  }
  function getid_llamada()
  {
    return $this->id;
  }

  function settxt_fecha($txt_fecha)
  {
    $this->txt_fecha = $txt_fecha;
  }
  function gettxt_fecha()
  {
    return $this->txt_fecha;
  }

  function settxt_hora($txt_hora)
  {
    $this->txt_hora = $txt_hora;
  }
  function gettxt_hora()
  {
    return $this->txt_hora;
  }

  function settxt_nombre($txt_nombre)
  {
    $this->txt_nombre = $txt_nombre;
  }
  function gettxt_nombre()
  {
    return $this->txt_nombre;
  }

  function settxt_destino($txt_destino)
  {
    $this->txt_destino = $txt_destino;
  }
  function gettxt_destino()
  {
    return $this->txt_destino;
  }

  function settxt_telefono1($txt_telefono1)
  {
    $this->txt_telefono01 = $txt_telefono1;
  }
  function gettxt_telefono1()
  {
    return $this->txt_telefono01;
  }

  function settxt_telefono2($txt_telefono2)
  {
    $this->txt_telefono02 = $txt_telefono2;
  }
  function gettxt_telefono2()
  {
    return $this->txt_telefono02;
  }

  function settxt_email($txt_email)
  {
    $this->txt_email = $txt_email;
  }
  function gettxt_email()
  {
    return $this->txt_email;
  }

  //
  function settxt_tipo($txt_tipo)
  {
    $this->txt_tipo = $txt_tipo;
  }
  function gettxt_tipo()
  {
    return $this->txt_tipo;
  }

  function settxt_observacion($txt_observacion)
  {
    $this->txt_observacion = $txt_observacion;
  }
  function gettxt_observacion()
  {
    return $this->txt_observacion;
  }

  function settxt_personal($txt_personal)
  {
    $this->txt_personal = $txt_personal;
  }
  function gettxt_personal()
  {
    return $this->txt_personal;
  }

  function setint_status($int_status)
  {
    $this->fk_estado = $int_status;
  }
  function getint_status()
  {
    return $this->fk_estado;
  }

  function elimina()
  {
    $sql = "DELETE FROM tbl_llamadas WHERE id = '" . $this->getid_llamada() . "'";
    $GLOBALS['CONNECT_DB']->Query($sql);
  }

  function actualiza()
  {
    $array_modify = array(
      "fecha" => $this->gettxt_fecha(),
      "hora" => $this->gettxt_hora(),
      "nombre" => $this->gettxt_nombre(),
      "destino" => $this->gettxt_destino(),
      "telefono01" => $this->gettxt_telefono1(),
      "telefono02" => $this->gettxt_telefono2(),
      "email" => $this->gettxt_email(),
      "tipo" => $this->gettxt_tipo(),
      "observacion" => $this->gettxt_observacion(),
      "personal" => $this->gettxt_personal(),
      "fk_estado" => $this->getint_status()
    );
    $array_where = array("id" => $this->getid_llamada());
    update($array_modify, "tbl_llamadas", $array_where);
  }


  function guarda()
  {

    $array_content = array(
      "fecha" => $this->gettxt_fecha(),
      "hora" => $this->gettxt_hora(),
      "nombre" => $this->gettxt_nombre(),
      "destino" => $this->gettxt_destino(),
      "telefono01" => $this->gettxt_telefono1(),
      "telefono02" => $this->gettxt_telefono2(),
      "email" => $this->gettxt_email(),
      "tipo" => $this->gettxt_tipo(),
      "observacion" => $this->gettxt_observacion(),
      "personal" => $this->gettxt_personal(),
      "fk_estado" => $this->getint_status()
    );
    insert($array_content, "tbl_llamadas") or die(mysql_error());
    $id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setid_llamada($id);
  }

  function IsExistLLamada()
  {
    $SQL = "SELECT * FROM tbl_llamadas WHERE id='" . $this->getid_llamada() . "' ";
    $QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
    $Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
    if ($Count == 0)
      return false;
    else
      return true;
  }

  function lista($sql = "")
  {

    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("SELECT id, fecha, hora, nombre, destino, telefono1, telefono2, email, observacion, personal, fecha_alta, fk_estado, tipo FROM [|PREFIX|]llamadas ORDER BY id DESC");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }

    $i = 0;
    while ($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['id'] = $Fetch['id'];
      $arreglo[$i]['fecha'] = $Fetch['fecha'];
      $arreglo[$i]['hora'] = $Fetch['hora'];
      $arreglo[$i]['nombre'] = $Fetch['nombre'];
      $arreglo[$i]['destino'] = $Fetch['destino'];
      $arreglo[$i]['telefono01'] = $Fetch['telefono01'];
      $arreglo[$i]['telefono02'] = $Fetch['telefono02'];
      $arreglo[$i]['email'] = $Fetch['email'];
      $arreglo[$i]['tipo'] = $Fetch['tipo'];
      $arreglo[$i]['observacion'] = $Fetch['observacion'];
      $arreglo[$i]['personal'] = $Fetch['personal'];
      $arreglo[$i]['fecha_alta'] = $Fetch['fecha_alta'];
      $arreglo[$i]['fk_estado'] = $Fetch['fk_estado'];
      $i++;
    }

    return $arreglo;
  }
}
