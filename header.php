<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php print $title_header_page; ?></title>
  <meta name="description" content="<?php print $description_header_page; ?>" />

  <link rel="stylesheet" href="<?php echo _URL ?>css/menu.css" type="text/css">
  <link rel="stylesheet" href="<?php echo _URL ?>css/menu_vertical.css" type="text/css">

  <link rel="stylesheet" href="<?php echo _URL ?>css/camera.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/facebox.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/vmsite-ltr.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/custom.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/stylesheet.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/botones.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/buttons.css" type="text/css" />

  <script src="<?php echo _URL ?>js/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo _URL ?>js/jquery.noConflict.js" type="text/javascript"></script>

  <script type='text/javascript' src='<?php echo _URL ?>js/jquery.mobile.customized.min.js'></script>
  <script type='text/javascript' src='<?php echo _URL ?>js/jquery.easing.1.3.js'></script>
  <script type='text/javascript' src='<?php echo _URL ?>js/camera.min.js'></script>

  <link rel="stylesheet" href="<?php echo _URL ?>css/position.css" type="text/css" media="screen,projection" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/layout.css" type="text/css" media="screen,projection" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/print.css" type="text/css" media="Print" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/virtuemart.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/products.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo _URL ?>css/personal.css" type="text/css" />

  <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative; z-index:9999;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" &nbsp;alt="" /></a>
    </div>
<![endif]-->
  <script type="text/javascript" src="<?php echo _URL ?>js/slides.min.jquery.js"></script>
  <script type="text/javascript" src="<?php echo _URL ?>js/jquery_carousel_lite.js"></script>
  <script type="text/javascript" src="<?php echo _URL ?>js/jquery.jqzoom-core.js"></script>
  <script type="text/javascript" src="<?php echo _URL ?>js/jqtransform.js"></script>
  <script type="text/javascript" src="<?php echo _URL ?>js/script.js"></script>


  <!--[if IE 8]>
<link href="<?php echo _URL ?>css/ie8only.css" rel="stylesheet" type="text/css" />
<![endif]-->

  <!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo _URL ?>js/html5.js"></script>
<![endif]-->


  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-46318306-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();
  </script>

  <!--menu superfish horizontal modificado (NO PIRATEAR)-->
  <link rel="stylesheet" type="text/css" href="<?php echo _URL ?>css/superfish.css" media="screen">

  <script type="text/javascript" src="<?php echo _URL ?>js/hoverIntent.js"></script>
  <script type="text/javascript" src="<?php echo _URL ?>js/superfish.js"></script>
  <script type="text/javascript">
    var $uu = jQuery.noConflict();
    $uu(function() {
      $uu('ul.sf-menu').superfish();
    });
  </script>

</head>

<body class="first">
  <div class="body-top">
    <div class="main">
      <header>
        <div id="header">
          <div class="logoheader">
            <h5 style="color:#000040" id="logo">
              <a href="<?php echo _URL ?>index.php">
                <img src="<?php echo _URL ?>images/logo.jpg" alt="Paquetes Turisticos Nacionales e Internacionales Todo Incluido">
              </a>
              <div align="center" style="margin-left:0px; width:950px; font-size:16px; margin-top:5px; ">Horario de Atencion: Lunes a Viernes de 10:00 a.m a 19:30 Hrs | Sáb 10:00 a.m a 14:00 Hrs</div>
            </h5>
          </div>


          <div class="row-head">
            <div class="relative">
              <div id="topmenu">
                <div class="moduletable-nav">

                  <div class="blue">
                    <div id="slatenav">
                      <ul>
                        <li><a href="<?php echo _URL ?>index.php" title="Inicio">Inicio</a></li>
                        <li><a href="<?php echo _URL ?>contenido.php?cid=2" title="Nosotros">Nosotros</a></li>
                        <li><a href="<?php echo _URL ?>cotizaciones.php" title="Cotizaciones">Cotizaciones</a></li>
                        <li><a href="<?php echo _URL ?>pasajes-en-oltursa.html" title="Comprar Pasajes con OLTURSA">Oltursa</a></li>
                        <li><a href="<?php echo _URL ?>contenido.php?cid=4" title="Politica de Compras">Politica de Compras</a></li>
                        <li><a href="<?php echo _URL ?>tickets.php" title="Tickets Aereos">Vuelos Baratos</a></li>
                        <li><a href="<?php echo _URL ?>contactenos.php" title="Contactenos">Cont&aacute;ctenos</a></li>
                      </ul>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>

          <div class="moduletable_LoginForm">
            <div class="poping_links">
              <a href="<?php echo _URL ?>contactenos.php" target="_self">
                <img src="<?php echo _URL ?>images/llamenos.jpg">
              </a>
            </div>
          </div>
        </div> <!-- END header -->
      </header>