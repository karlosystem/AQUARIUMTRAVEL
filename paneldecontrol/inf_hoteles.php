<?php
@ob_start();
@session_start();
require_once("inc.load.lib.php");
$UserLoadTemp = new cls_tbl_administrador();
$InfoUser = $UserLoadTemp->fetch_user_info($administrador->gettxt_usuario());
$CUser = (int)$InfoUser['pk_administrador'];
$UserLoad = new cls_tbl_administrador($CUser);

$cls_module = new cls_tbl_modulo();
$IdMod = $cls_module->IdModPermsForFile('List');
$ArrayModule = $cls_module->FilesModules($IdMod);

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();

$SQL = "SELECT pk_hoteles, fk_departamento, fk_cadena, int_estrellas, 
tbl_hoteles.int_status, tbl_hoteles.txt_image, tbl_hoteles.txt_datehoteles, 
tbl_hoteles.txt_dateadd, tbl_hoteles.txt_dateupdate,  mm_photoportada, tbl_departamento.txt_descripcion as departamento,
tbl_hoteles.txt_precio_simple, tbl_hoteles.txt_precio_doble,tbl_hoteles.txt_precio_triple, 
tbl_hoteles.txt_precio_nino, tbl_cadena.txt_nombre as cadena, txt_direccion FROM tbl_hoteles 
LEFT JOIN tbl_departamento ON tbl_hoteles.fk_departamento = tbl_departamento.pk_departamento 
LEFT JOIN tbl_cadena       ON tbl_hoteles.fk_cadena = tbl_cadena.pk_cadena WHERE tbl_hoteles.pk_hoteles <> '' ORDER BY txt_datehoteles DESC;";

$hoteles = new cls_tbl_hoteles();
$resultado = $hoteles->lista($SQL);	  

$numFilas =  count($resultado);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <title>Cotizaciones - AquariumTravel</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
     <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="lib/file-uploader/css/jquery.fileupload.css">
  <link rel="stylesheet" href="lib/file-uploader/css/jquery.fileupload-ui.css">


  <script src="js/lib.admin.js"></script>
  <script language="javascript" src="js/library.js" type="text/javascript" charset="iso-8859-1" ></script>

  <script language="javascript">
  	var MyForm = 'frmhoteles';
  	var urlProcess = 'proc_hoteles.php';
  	var IsRowSlow = 'rowpaquete_';
  </script>

</head>

<body>

<section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
		<?php
			include("header.php");
		?>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
		<?php
			include("sidebar.php");
        ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Mantenimiento de Hoteles</h3>
        <!-- row -->

        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
            <table cellpadding="0" cellspacing="0" class="display table table-bordered" id="hidden-table-info">
                <h4><i class="fa fa-angle-right"></i> Hoteles</h4>
                <hr>
                <thead>
                <tr>                   
                    <th class="hidden-phone">Id</th>
                    <th class="hidden-phone">Hotel </th>
                    <th class="hidden-phone">Direccion</th>
                    <th class="hidden-phone">Ubicacion</th>
                    <th class="hidden-phone">Cadena</th>
                    <th class="hidden-phone">Imagen</th>
                    <th class="hidden-phone">Fotos</th>
                    <th class="hidden-phone">Estado</th>
                    <th class="hidden-phone">Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($numFilas==0)	
                {  
                ?>
                  <tr class="gradeA"> 
                    <td colspan="9">No existen registros</td> 
                  </tr>
                <?php }
                else
                  {
                  $cint=1;
                  foreach ($resultado  as $array)	{
                    $icono = "ico_estado".$array['int_status'].".gif";				
                    $language_id = $language[0]['id'];
                    $details_hoteles = cls_tbl_hoteles::get_hoteles_detail($array['pk_hoteles'],$language_id);
                    $name_hoteles = secure_sql($details_hoteles[0]['hoteles_txt_title']);
                    $resize_img = ADMIN_PHOTOBIG_HOTELES.$array['txt_image'];
                ?>
                <tr class="gradeA" id="rowpaquete_<?php print $array['pk_hoteles']?>">
                  <td><?php print $cint;?></td>                    
                  <td><?php echo  $name_hoteles?></td>
                  <td><?php echo $array['txt_direccion']?></td>
                  <td><?php echo $array['departamento']?></td>
                  <td><?php echo $array['cadena']?></td>
                  <td>
                    <img src="<?php print $resize_img?>"/> 
                  </td>
                  <td>
                  <?php
                    $paquetecls_create = new cls_tbl_hoteles($array['pk_hoteles']);
                    $countimg = (int)$paquetecls_create->counthoteles_list();
                    print $countimg;
								  ?>
                  </td>
                  <td id="idEstado<?php print $array['pk_hoteles']?>" style="vertical-align:middle">
								  <a href="javascript:UpdateStatus(<?php echo  $array['pk_hoteles']?>)">					
									  <img src="images/icons/<?php echo  $icono?>">
								  </a>
								  </td>
                  <td></td>
                </tr>
                <?php	
							$cint++;
              } 
            }
					 ?>
                </tbody>
            </table>

            </div>
            <br>
			<div class="row fileupload-buttonbar">
				<div class="col-lg-8">
				  <a href="frm_ticket.php" class="btn btn-success fileinput-button" role="button">
					<i class="glyphicon glyphicon-plus"></i>&nbsp;Nuevo Hotel
				  </a>
				</div>
            </div>
            
          </div>
        </div>

        </section>
        <?php
		include('footer.php');
	?>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/datatables.min.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */

      $(document).ready(function() {
        $('#hidden-table-info').dataTable({
        "pageLength": 50,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
      });

      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'desc']
        ]
      }).fnDestroy();


    });
  </script>
</body>

</html>
