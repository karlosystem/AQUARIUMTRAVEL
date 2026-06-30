<?php
class cls_tbl_reportes
{

  function lista_cotizaciones_anio($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_cotizaciones_anio");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['anio'] = $rs['anio'];
      $arreglo[$i]['cantidad'] = $rs['cantidad'];
      $i++;
    }
    return $arreglo;
  }

  function lista_cotizaciones_mes_2023($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_cotizaciones_mes_2023");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['mes'] = $rs['mes'];
      $arreglo[$i]['cantidad'] = $rs['cantidad'];
      $i++;
    }
    return $arreglo;
  }

  function lista_top_10_paquetes_mes_actual($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_top_10_paquete_solicitado_mes_actual");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['paquete'] = $rs['paquete'];
      $arreglo[$i]['cantidad'] = $rs['cantidad'];
      $i++;
    }
    return $arreglo;
  }

  function lista_top_10_categorias_mas_visto($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_categorias_top10_mas_visto");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['categoria'] = $rs['categoria'];
      $arreglo[$i]['int_visto'] = $rs['int_visto'];
      $i++;
    }
    return $arreglo;
  }

  function lista_top_20_paquetes_mas_visto($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_paquetes_top20_mas_visto");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['paquete'] = $rs['paquete'];
      $arreglo[$i]['int_visto'] = $rs['int_visto'];
      $i++;
    }
    return $arreglo;
  }

  function lista_pasajes_top10_mas_visto($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_pasajes_top10_mas_visto");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['pasaje'] = $rs['pasaje'];
      $arreglo[$i]['int_visto'] = $rs['int_visto'];
      $i++;
    }
    return $arreglo;
  }

  function lista_historico_contacto($sql = "")
  {
    if (!tep_not_null($sql)) {
      $sql = $GLOBALS['CONNECT_DB']->Query("Select * from vw_contactos_historico");
    } else {
      $sql = $GLOBALS['CONNECT_DB']->Query($sql);
    }
    $i = 0;
    while ($rs = $GLOBALS['CONNECT_DB']->Fetch($sql)) {
      $arreglo[$i]['anio'] = $rs['anio'];
      $arreglo[$i]['cantidad'] = $rs['cantidad'];
      $i++;
    }
    return $arreglo;
  }
} // fin de la clase
