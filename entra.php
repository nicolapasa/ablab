<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Ablab - Login Software</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="./assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="./assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="./assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
       <link href="./assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
		  <link href="./assets/pages/css/login.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
                               <img src="./assets/layouts/layout/img/logo-bianco_m.jpg" alt="logo" class="logo-default" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
		
	
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="login.php" method="post">
                <h3 class="form-title ">ABLAB Login</h3>
					<?php 
		if(isset($_GET['error'])){
			
			?>
			<div class="alert alert-danger">
			Problemi di autenticazione. Inserisci nuovamente la username e la password
			</div>
			
			<?php
			
		}
		
		
	 if(isset($_GET)){
              
              	if($_GET['req']=='ok'){
                    echo '<div class="alert2 green" >La sua registrazione è completata, username e password le sono state inviate alla email indicata, attenda la conferma da parte di ABLAB prima di effettuare il login per connettersi al software</div>';
                   }
                   if($_GET['mail']=='ok'){
                   	echo '<div class="alert2 green" >La password sarà recapitata alla email fornita all\'atto della registrazione.</div>';
                   }
                   if($_GET['err']=='si'){
                   	echo '<div class="alert2 red" >Autenticazione fallita, se avete dimenticato la password potete utilizzare il form di recupero password</div>';
                   }
                    
              }?>
               
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="user" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="pass" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-block uppercase">Login</button>
                 
                  		
				</div> 
<div class="alert alert-custom">
	
	Utilizza il tuo account all'area clienti per entrare, altrimenti registrati gratuitamente qui sotto
	
</div>	<a href="registrazione.php" class="btn btn-info">registrazione nuovo utente <i class="fa fa-pencil"></i> </a>
              	<div class="separator"></div>				
         	<a href="lost_password.php" class="btn btn-info">Password smarrita? <i class="fa fa-pencil"></i> </a>
            </form>
            <!-- END LOGIN FORM -->
            
          
        </div>
        <div class="copyright">2018 &copy; Nicola Pasa
                <a href="http://nicolapasa.com" title="" target="_blank">Siti web e software</a></div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
       <!-- BEGIN CORE PLUGINS -->
        <script src="./assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
              <script src="./assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
       <script src="./assets/global/plugins/jquery-validation/js/localization/messages_it.js" type="text/javascript"></script>
    
        <script src="./assets/global/plugins/moment.min.js" type="text/javascript"></script>
              <script src="./assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
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
         <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="./assets/global/scripts/app.min.js" type="text/javascript"></script>
        
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="./assets/pages/scripts/form-validation.js" type="text/javascript"></script>     <script src="./assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="./assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
         <script src="./assets/pages/scripts/form-input-mask.js" type="text/javascript"></script>
         <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="./assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
       <script src="./tinymce/js/tinymce/tinymce.min.js" type="text/javascript" ></script>
      
        <!-- END THEME LAYOUT SCRIPTS -->
   
</body>
</html>