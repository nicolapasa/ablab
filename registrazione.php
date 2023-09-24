<?php
session_start();
include("./autoloader.php");
//classe autenticazione
$db= new DB();

//version update del js cod
$versionUpdate=Utility::getDataxml();

?>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Ablab - Registrazione Software</title>
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
		  <link href="./assets/pages/css/registra.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
          <img src="./assets/layouts/layout/img/logo-bianco_m.jpg" alt="logo" class="logo-default" />
		  </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->


        <div class="content">
            <!-- BEGIN LOGIN FORM -->


	<div class="portlet box blue">
         <div class="portlet-title">
                <div class="caption">
                      <i class="fa fa-user"></i>ABLAB Registrazione
				</div>

          </div>
  <div class="portlet-body ">


 <form id="reg" class="form-horizontal" action="save_reg.php" method="post" enctype="multipart/form-data" >


<div class="row">
  <div class="col-md-6">
  <div class="form-group row">
  <label class="col-md-4 col-form-label bold">Nome struttura(dicitura che apparirà in referti):</label>
  <div class="col-md-8">
  <input type="text" class="form-control" name="nome_ref"  autocomplete=off />
  </div>
  </div>
  </div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ragione sociale(dicitura che apparirà in fattura):</label>
<div class="col-md-8">
<input type="text" class="form-control" name="nome"   />
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Referente:</label>
<div class="col-md-8">
<input type="text" class="form-control" name="referente"   />
</div>
</div>

</div>
<!-- codice univoco-->
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">
Codice Univoco:</label>
<div class="col-md-8">
<input type="text" class="form-control" id="cod" name="cod"  />
</div>
</div>
</div>
</div><!-- end row-->

<div class="row">
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">
Username:</label>
<div class="col-md-8">
<input type="text" class="form-control"  name="username"   autocomplete="off" />
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Password:</label>
<div class="col-md-8">
<input type="password" class="form-control"  name="password"  />
</div>
</div>
</div>
</div><!-- end row-->
<div class="row">

<!--nazione-->
<div class="col-md-12">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nazione:</label>
<div class="col-md-8">
<select name="nazione" class="form-control nazione">

<option value="Italia" selected="selected">Italia</option>
<?php


$row= $db->selectAll('nazioni', null, '  nome asc ');

foreach($row as $r){


$nomenazione=$r['nome'];

?><option value="<?php echo $nomenazione;?>" ><?php echo $nomenazione;?></option>
<?php
 }
?>
</select>
</div>
</div>
</div>
</div><!-- end row-->
<div class="row" id="select_localita">
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Provincia:</label>
<div class="col-md-8">
<select  name="provincia" class="form-control provincia" >
<option value="" selected="selected">seleziona la provincia</option>
<?php
$row= $db->selectAll('province', null, '  nomeprovincia asc ');

foreach($row as $r){

$idprovincia=$r['id'];
$nomeprovincia=$r['nomeprovincia'];

?>
<option value="<?php echo $nomeprovincia;?>"><?php echo $nomeprovincia;?></option>
<?php
 }
?>
</select>

</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Comune:</label>
<div class="col-md-8">
<select name="comune" class="form-control  comune" >
<option value="" selected="selected">seleziona il comune(prima la provincia)</option>
</select>
</div>
</div>
</div>
</div><!-- end row-->
<div class="row hide-text" id="text_localita">
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Provincia:</label>
<div class="col-md-8">
<input type="text" name="provincia_txt" class="form-control" >
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Comune:</label>
<div class="col-md-8">
<input type="text" name="comune_txt" class="form-control" >
</div>
</div>
</div>
</div><!-- end row-->
<div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Indirizzo:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="indirizzo"   />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cap:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="cap"   />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">
Indirizzo spedizione:</label>
<div class="col-md-8">
<textarea  class="form-control"  name="ind_spe"  > </textarea >
<span class="help-block">
solo se diverso da quello indicato
</span>
</div>
</div>
</div>

</div><!-- end row-->
<div class="row">
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Orari di apertura:</label>
<div class="col-md-8">
<textarea class="form-control"  name="orario" ><?php echo $orario;  ?> </textarea>
</div></div></div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Telefono:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="telefono"   />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cellulare:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="cell"   />
</div>
</div>
</div>

<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Fax:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="fax"   />
</div>
</div>
</div>

</div><!-- end row-->
<div class="row">
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Email refertazione:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="email"  />
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Email PEC:</label>
<div class="col-md-8">
<input class="form-control"  type="text" id="pec" name="pec"   />
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Email fatturazione Non PEC:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="email_fatt"   />
</div>
</div>
</div>
</div><!-- end row-->
<div class="row">
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Partita Iva:</label>
<div class="col-md-8">
<input class="form-control"  type="text" id="piva" name="piva"  />
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Codice Fiscale:</label>
<div class="col-md-8">
<input class="form-control"  type="text"  name="cf"   />
<span class="help-block">
se posseduto altrimenti digitare nuovamente la partita iva per proseguire
</span>
</div>
</div>
</div>
</div><!-- end row-->
<div class="row">
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Foto del profilo:</label>
 <div class="col-md-8">
 <input class="form-control"  type="file" name="foto" />
</div>
</div>
</div>
</div><!-- end row-->
<!-- Form actions -->
<input type="hidden" name="livello" value="struttura" >
							<div class="form-actions">
								<button type="submit" class="btn blue btn-block">
									<i class="fa fa-check-circle"></i>INVIA
								</button>
							</div>

							<!-- // Form actions END -->

</form>
<!-- // END row-app -->
 </div>
  </div>
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
   <script src="./assets/pages/scripts/form-validation.js" type="text/javascript"></script>
   <script src="./assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="./assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
         <script src="./assets/pages/scripts/form-input-mask.js" type="text/javascript"></script>
         <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="./assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
       <script src="./tinymce/js/tinymce/tinymce.min.js" type="text/javascript" ></script>
        <script src="./js/form.js?v=<?php echo $versionUpdate?>"></script>

        <!-- END THEME LAYOUT SCRIPTS -->

</body>
</html>
