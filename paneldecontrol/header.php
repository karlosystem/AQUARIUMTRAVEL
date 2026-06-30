<?php
@ob_start();
@session_start();
ini_set('memory_limit', '128M');
require_once("../init.php");
require_once("loadclass.php");

$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if (!$UserLoad->is_user_logged_in())
    header("Location: index.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Bienvenido: <?php print $UserLoad->getuser_name() ?> | <?php print $ArrayConf['conf_titlepage'] ?></title>

    <link rel="stylesheet" type="text/css" href="tabs/estiloutil.css">
    <link rel="stylesheet" type="text/css" href="css/pagination.css">

    <!-- CSS Reset -->
    <link rel="stylesheet" type="text/css" href="css/reset.css" />

    <!-- Fluid 960 Grid System - CSS framework -->
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />

    <!-- IE Hacks for the Fluid 960 Grid System -->
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css"  media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->

    <!-- Main stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />

    <!-- WYSIWYG editor stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/jquery.wysiwyg.css" media="screen" />

    <!-- Table sorter stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/tablesorter.css" media="screen" />

    <!-- Thickbox stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/thickbox.css" media="screen" />

    <!-- Themes. Below are several color themes. Uncomment the line of your choice to switch to different color. All styles commented out means blue theme. -->
    <link rel="stylesheet" type="text/css" href="css/theme-blue.css" media="screen" />

    <!-- JQuery engine script-->
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

    <!-- JQuery WYSIWYG plugin script -->
    <script type="text/javascript" src="js/jquery.wysiwyg.js"></script>

    <!-- JQuery tablesorter plugin script-->
    <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>

    <!-- JQuery pager plugin script for tablesorter tables -->


    <!-- JQuery password strength plugin script -->
    <script type="text/javascript" src="js/jquery.pstrength-min.1.2.js"></script>

    <script type="text/javascript" src="<?php print _URL ?>adapter/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="js/Chart.min.js"></script>


    <script language="javascript" src="js/library.js" type="text/javascript" charset="iso-8859-1"></script>
    <div id="AjaxLoading" style="position: absolute; top: 0px; left: 617px; ">
        <img src="images/ajax-loader.gif">&nbsp; Cargando ... Espere por favor ...
    </div>

</head>

<body>
    <!-- Header -->
    <div id="header">
        <!-- Header. Status part -->
        <div id="header-status">
            <div class="container_12">
                <div class="grid_8">
                    &nbsp;
                </div>
                <div class="grid_4">
                    <a href="index.php?ToDo=logout" id="logout">
                        Salir
                    </a>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div> <!-- End #header-status -->

        <!-- Header. Main part -->
        <div id="header-main">
            <div class="container_12">
                <div class="grid_12">
                    <div id="logo">
                        <ul id="nav">
                            <li id="current"><a href="home.php">PRINCIPAL</a></li>
                        </ul>
                    </div><!-- End. #Logo -->
                </div><!-- End. .grid_12-->
                <div style="clear: both;"></div>
            </div><!-- End. .container_12 -->
        </div> <!-- End #header-main -->
        <div style="clear: both;"></div>
        <!-- Sub navigation -->
        <div id="subnav">
            <div class="container_12">
                <div class="grid_12">
                    <ul>
                        <li><a href="#"><?php print $ArrayConf['conf_titlepage'] ?></a></li>
                        <li><a href="#">Usuario: <?php print $UserLoad->getuser_name() ?></a></li>

                    </ul>

                </div><!-- End. .grid_12-->
            </div><!-- End. .container_12 -->
            <div style="clear: both;"></div>
        </div> <!-- End #subnav -->
    </div> <!-- End #header -->