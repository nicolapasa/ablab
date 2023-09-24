function invia() {
	if ((confirm('Confermi di voler ricevere la fornitura materiale? Ricordati che verrà inclusa nella fatturazione mensile insieme ai campioni inviati! Di routine	verrà inviata una fornitura standard, comprensiva di materiale di consumo per citologia, istologia e microbiologia. Per richiesta forniture pack, forniture emo o forniture micro contattare il laboratorio e consultare il listino prezzi'))) {
	document.forn.action='save.php';
	document.forn.submit();
	}
	}

 $(document).ready(function(){ 

/*	 $('html').bind('keypress', function(e)
			 {
			    if(e.keyCode == 13)
			    {
			       return false;
			    }
			 });	 */
	 
	 $('textarea.editor').tinymce({
			// Location of TinyMCE script
			script_url : './editor/jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true


		});	 
$('.add').click(function(){
	
	var add="<input type='file' name='allegati[]' placeholder='allegati' />";
	$(this).before(add);
	
});
$(".struttura").change(function(){
	var opzione =  $(this).val();
	
	$.ajax({
	   type: "GET",
	   url: "popola_prop.php",
	   data: "opzione="+opzione,
	   success: function(data){
	   $(".prop").empty();
	     $(".prop").html(data);
	   }
	 });
	});
$('.prop').change(function(){
	$('#selpro').prop('checked', false);
});
$(".provincia").change(function(){
var opzione =  $(this).val();
$.ajax({
   type: "GET",
   url: "popola_sel.php",
   data: "opzione="+opzione,
   success: function(data){
   $(".comune").empty();
     $(".comune").html(data);
   }
 });
});
$(".provincia_pro").change(function(){
	var opzione =  $(this).val();
	$.ajax({
	   type: "GET",
	   url: "popola_sel.php",
	   data: "opzione="+opzione,
	   success: function(data){
	   $(".comune_pro").empty();
	     $(".comune_pro").html(data);
	   }
	 });
	});


$(".specie").change(function(){
	var opzione =  $(this).val();
	$.ajax({
	   type: "GET",
	   url: "popola_razza.php",
	   data: "opzione="+opzione,
	   success: function(data){
	   $(".razza").empty();
	     $(".razza").html(data);
	   }
	 });
	});



$("input[type='checkbox']").each(function(){
	
	 var id=	$(this).attr('id');	
	 var check= $(this).attr('checked');	
	 
	  
	 if((id== 'opt4' || id== 'opt5')  && check === 'checked'){
		 $("#punti").css('display', 'block'); 
		 }
		  if((id== 'opt4' || id== 'opt5')  && check != 'checked'){
		 	$("#punti").css('display', 'none'); 	
		 }
		  if((id== 'opt4')  && check === 'checked'){
			    $('#opt5').prop("checked", false);
			    $('#opt5').prop("disabled", true);
		 }	
		 if((id== 'opt5')  && check === 'checked'){
			    $('#opt4').prop("checked", false);
			    $('#opt4').prop("disabled", true);
		}	
	  
});

	

$("input[type='checkbox']").change(function(){
	//quando selezione uno dei margini l'altro va disabilitato
	 var id=	$(this).attr('id');	
	 var check= $(this).attr('checked');	
	 
 if((id== 'opt4')  && check === 'checked'){
	    $('#opt5').prop("checked", false);

 }	
 if((id== 'opt5')  && check === 'checked'){
	    $('#opt4').prop("checked", false);
	 
}	
	 
if((id== 'opt4' || id== 'opt5')  && check === 'checked'){
$("#punti").css('display', 'block'); 
}
 if((id== 'opt4' || id== 'opt5')  && check != 'checked'){
	$("#punti").css('display', 'none'); 	
}

	  
});
$("input[type='radio']").change(function(){
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito
	
	 var id=	$(this).attr('id');	
	 var check= $(this).attr('checked');	

	 if((id <9 || id > 15)   && check === 'checked' ){
		 // svuoto
		    $('#opt3').prop("checked", false);
		    $('#opt4').prop("checked", false);
		    $('#opt5').prop("checked", false);
		    $('#opt6').prop("checked", false);
	
	 }
	 
});	 
$("input[type='radio']").each(function(){
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito
	
	 var id=	$(this).attr('id');	
	 var check= $(this).attr('checked');	

	 if((id <9 || id > 15)   && check === 'checked' ){
		 // svuoto
		    $('#opt3').prop("checked", false);
		    $('#opt4').prop("checked", false);
		    $('#opt5').prop("checked", false);
		    $('#opt6').prop("checked", false);
	
	 }
	 
});	

   
	$("#sez2").validate({
        rules: {
        	tipo: "required"

             
       
        },
        messages: {
        	
        	tipo: {
        		 required: "devi selezionare almeno uno degli esami"
        		
        	}
        }   
     });




 });