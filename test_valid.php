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
        <link href="./assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
        <link href="./assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/dropzone.css">
		   <!-- END PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="./assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="./assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="./assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="./assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
<link id="url_path" href="<?php echo __ROOT__;?>"  rel="path" />
</head>

<body>


<form action="test_valid.php" method="get" id="test" >

<div class="form-group">
<label class="control-label">Cognome Proprietario:</label>

<input class="form-control" type="text"  name="cognome" placeholder="cognome proprietario" 
value="" /> 
</div>
	<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>
									SALVA E AVANTI
								</button>
</form>




        <!-- BEGIN CORE PLUGINS -->
        <script src="./assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		          <script src="./assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
       <script src="./assets/global/plugins/jquery-validation/js/localization/messages_it.js" type="text/javascript"></script>
    
     
	   <script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    
    
        <script src="./assets/global/plugins/moment.min.js" type="text/javascript"></script>
              <script src="./assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
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

    <script src="./assets/global/plugins/uniform/jquery.uniform.js" type="text/javascript"></script>

	
        <script src="./assets/global/scripts/app.min.js" type="text/javascript"></script>
      
		    <script src="./assets/pages/scripts/table-datatables-scroller.js" type="text/javascript"></script>
     
  
   <script src="./assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="./assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
         <script src="./assets/pages/scripts/form-input-mask.js" type="text/javascript"></script>
		     <script src="./assets/pages/scripts/table-datatables-fixedheader.js" type="text/javascript"></script>
    
        <script src="./assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="./editor/jscripts/tiny_mce/jquery.tinymce.js" type="text/javascript" ></script>
	
	  <script src="./assets/pages/scripts/form-validation.js" type="text/javascript"></script>
	   
<script src="./js/cod.js"></script>

   
</body>
</html>