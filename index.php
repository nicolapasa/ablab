<?php
include("./bootstrap.php");


?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
<head>
        <meta charset="utf-8" />
        <title>AbLab | Gestionale </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="nicola pasa" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
       <link href="./assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
         <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="./assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
  <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="./assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
            <link href="./assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

        <link href="./assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/dropzone.css">
		   <!-- END PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="./assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="./assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
		   <link href="./assets/pages/css/blog.min.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="./assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="./assets/layouts/layout/css/custom.css?v=<?php echo $versionUpdate?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

    <!-- END HEAD -->
<link id="url_path" href="<?php echo URL_GEN;?>"  rel="path" />
</head>


    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="index.php">
                      <img src="./assets/layouts/layout/img/logo_top.png" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <?php include('navbar.php');?>

            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->

                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                <?php include('menu.php');?>

                    <!-- END SIDEBAR MENU -->

                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->

                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                    <?php include('breadcrumb.php');?>

                    </div>
                    <!-- END PAGE BAR -->
                    <!--  begin content page -->
					<div id="alert"></div>
<?php
        include('modal_assegna.php');
		include('core.php');


?>

                    <!-- end content page -->
                    </div>
        </div>
        </div>
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2016 &copy; Nicola Pasa
                <a href="http://nicolapasa.com" title="" target="_blank">Siti web e software</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="./assets/global/plugins/respond.min.js"></script>
<script src="./assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->

        <script src="./assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
      <!--  <script src="./assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>-->
        <script src="./assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
		   <script src="./assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
              <script src="./assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
       <script src="./assets/global/plugins/jquery-validation/js/localization/messages_it.js" type="text/javascript"></script>

        <script src="./assets/global/plugins/moment.min.js" type="text/javascript"></script>
              <script src="./assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		    <script src="./assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.it.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
        <script src="./assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

		<!--
    <script src="./assets/global/plugins/uniform/jquery.uniform.js" type="text/javascript"></script>

	 END PAGE LEVEL PLUGINS -->
        <script src="./assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
		    <script src="./assets/pages/scripts/table-datatables-scroller.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
   <script src="./assets/pages/scripts/form-validation.js" type="text/javascript"></script>
   <script src="./assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
        <script src="./assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
         <script src="./assets/pages/scripts/form-input-mask.js" type="text/javascript"></script>
		     <script src="./assets/pages/scripts/table-datatables-fixedheader.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
          <script src="./assets/pages/scripts/table-datatables-colreorder.js" type="text/javascript"></script>
     	<!-- BEGIN PAGE LEVEL SCRIPTS -->

	           <!-- BEGIN THEME GLOBAL SCRIPTS -->
			   	<?php if($_GET['req']=='stat'){ ?>
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script src="./js/stat.js"></script>

				<?php }?>

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->

		    <script src="./assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>

        <script src="./assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
       <script src="./tinymce/js/tinymce/tinymce.min.js" type="text/javascript" ></script>
<script src="./js/cod.js?v=<?php echo $versionUpdate?>"></script>

        <!-- END THEME LAYOUT SCRIPTS -->

</body>
</html>
