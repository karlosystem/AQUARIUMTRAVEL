<?php
include("header.php");
?>
<div class="container_12">
  <!-- Dashboard icons -->
  <div class="grid_12">
    <?php
    $SQL = "SELECT * FROM [|PREFIX|]webgrupos WHERE int_estado='1'";
    $grupos   = new cls_tbl_grupo();
    $resultado = $grupos->lista($SQL);
    $numFilas =  count($resultado);
    if ($numFilas == 0) {
    } else {
      foreach ($resultado  as $array) {

        $SQL_Mod = "SELECT * FROM [|PREFIX|]webmodulos WHERE fk_grupo='" . $array['pk_grupo'] . "' AND int_estado='1'";
        $modulos   = new cls_tbl_modulo();
        $rowModulo = $modulos->lista($SQL_Mod);
        foreach ($rowModulo  as $array_mod) {
    ?>

          <a href="<?php print $array_mod['txt_include'] ?>" class="dashboard-module">
            <img alt="<?php echo $array_mod['txt_nombre']; ?>" src="<?php echo ADMIN_MODULOS . $array_mod['txt_imagen']; ?>" alt="edit" />
            <span><?php echo $array_mod['txt_nombre']; ?></span>
          </a>

        <?php
        }
        ?>

      <?php
      } #else
      ?>

    <?php
    } #else
    ?>

    <div style="clear: both"></div>
  </div> <!-- End .grid_7 -->

  <div style="clear:both;"></div>

  <div class="grid_12">
    <div class="module">
      <h2><span>Reporte 05</span></h2>
      <div class="module-body">
        <canvas id="Reporte05" width="100%" height="40"></canvas>
      </div>
    </div>
    <div style="clear: both"></div>
  </div>

  <div style="clear:both;"></div>

  <div class="grid_6">
    <div class="module">
      <h2><span>Reporte 06</span></h2>
      <div class="module-body">
        <canvas id="Reporte06" width="100%" height="40"></canvas>
      </div>
    </div>
  </div>

  <div class="grid_6">
    <div class="module">
      <h2><span>Reporte 07</span></h2>
      <div class="module-body">
        <canvas id="Reporte07" width="100%" height="40"></canvas>
      </div>
    </div>
  </div>

  <div style="clear:both;"></div>
  <!-- Settings-->

  <div class="grid_6">
    <div class="module">
      <h2><span>Reporte 01</span></h2>
      <div class="module-body">
        <canvas id="Reporte01" width="100%" height="40"></canvas>
      </div>
    </div>
  </div>

  <div class="grid_6">
    <div class="module">
      <h2><span>Reporte 02</span></h2>
      <div class="module-body">
        <canvas id="Reporte02" width="100%" height="40"></canvas>
      </div>
    </div>
  </div>
  <div style="clear:both;"></div>

  <div class="grid_12">
    <div class="grid_6">
      <div class="module">
        <h2><span>Reporte 03</span></h2>
        <div class="module-body">
          <canvas id="Reporte03" width="100%" height="40"></canvas>
        </div>
      </div>
    </div>

    <div class="grid_6">
      <div class="module">
        <h2><span>Reporte 04</span></h2>
        <div class="module-body">
          <canvas id="Reporte04" width="100%" height="40"></canvas>
        </div>
      </div>
    </div>
  </div>


  <div style="clear:both;"></div>
</div> <!-- End .container_12 -->
<div style="clear:both;"></div>



<?php
include("footer.php");
?>

<?php
$SQL = "SELECT * FROM vw_cotizaciones_anio";
$grafico01   = new cls_tbl_reportes();
$resultado = $grafico01->lista_cotizaciones_anio($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $anio[] = $array['anio'];
    $cantidad[] = $array['cantidad'];
  }
}
?>

<?php
$SQL = "Select * from vw_cotizaciones_mes_2023";
$grafico02   = new cls_tbl_reportes();
$resultado = $grafico02->lista_cotizaciones_mes_2023($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $mes[] = $array['mes'];
    $cantidadMes[] = $array['cantidad'];
  }
}
?>

<?php
$SQL = "Select * from vw_top_10_paquete_solicitado_mes_actual";
$grafico03   = new cls_tbl_reportes();
$resultado = $grafico03->lista_top_10_paquetes_mes_actual($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $mesAct[] = $array['cantidad'];
    $paquete[] = $array['paquete'];
  }
}
?>

<?php
$SQL = "Select * from vw_categorias_top10_mas_visto";
$grafico04   = new cls_tbl_reportes();
$resultado = $grafico04->lista_top_10_categorias_mas_visto($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $categoria[] = $array['categoria'];
    $int_visto[] = $array['int_visto'];
  }
}
?>

<?php
$SQL = "Select * from vw_paquetes_top20_mas_visto";
$grafico05   = new cls_tbl_reportes();
$resultado = $grafico05->lista_top_20_paquetes_mas_visto($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $paqueteMax[] = $array['paquete'];
    $int_vistoMax[] = $array['int_visto'];
  }
}
?>


<?php
$SQL = "Select * from vw_pasajes_top10_mas_visto";
$grafico06   = new cls_tbl_reportes();
$resultado = $grafico06->lista_pasajes_top10_mas_visto($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $pasaje[] = $array['pasaje'];
    $int_vistoPas[] = $array['int_visto'];
  }
}
?>

<?php
$SQL = "Select * from vw_contactos_historico";
$grafico07   = new cls_tbl_reportes();
$resultado = $grafico07->lista_historico_contacto($SQL);
$numFilas =  count($resultado);
if ($numFilas > 0) {
  foreach ($resultado  as $array) {
    $anioCont[] = $array['anio'];
    $cantCont[] = $array['cantidad'];
  }
}
?>

<script>
  //Reporte Grafico 01
  var ctx = document.getElementById('Reporte01').getContext('2d');
  var Reporte01 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($anio); ?>,
      datasets: [{
        data: <?php echo json_encode($cantidad); ?>,
        label: 'Cantidad de Cotizaciones por Año',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });

  //Reporte Grafico 02
  var ctx = document.getElementById('Reporte02').getContext('2d');
  var Reporte02 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($mes); ?>,
      datasets: [{
        data: <?php echo json_encode($cantidadMes); ?>,
        label: 'Cantidad de Cotizaciones por meses en el año 2023',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });

  //Reporte Grafico 03
  var ctx = document.getElementById('Reporte03').getContext('2d');
  var Reporte03 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($paquete); ?>,
      datasets: [{
        data: <?php echo json_encode($mesAct); ?>,
        label: 'top 10 Paquete solicitado del mes actual',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });

  //Reporte Grafico 04
  var ctx = document.getElementById('Reporte04').getContext('2d');
  var Reporte04 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($categoria); ?>,
      datasets: [{
        data: <?php echo json_encode($int_visto); ?>,
        label: 'Historico - Top 10 categorias más vistos',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });

  //Reporte Grafico 05
  var ctx = document.getElementById('Reporte05').getContext('2d');
  var Reporte05 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($paqueteMax); ?>,
      datasets: [{
        data: <?php echo json_encode($int_vistoMax); ?>,
        label: 'Historico - Top 20 Paquetes Turisticos más vistos',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });


  //Reporte Grafico 06
  var ctx = document.getElementById('Reporte06').getContext('2d');
  var Reporte05 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($pasaje); ?>,
      datasets: [{
        data: <?php echo json_encode($int_vistoPas); ?>,
        label: 'Historico - Top 10 Pasajes Aereos más vistos',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });

  //Reporte Grafico 07
  var ctx = document.getElementById('Reporte07').getContext('2d');
  var Reporte05 = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($anioCont); ?>,
      datasets: [{
        data: <?php echo json_encode($cantCont); ?>,
        label: 'Historico - Top 10 Pasajes Aereos más vistos',
        backgroundColor: colorRGB,
        borderColor: colorRGB,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        legend: {
          display: false,
        },

      }
    }
  });


  function generarNumero(numero) {
    return (Math.random() * numero).toFixed();
  }

  function colorRGB() {
    var color = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    return "rgb" + color;
  }
</script>