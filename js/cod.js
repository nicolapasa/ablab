function refreshPage() {
  window.location.href = window.location.href;
}

var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;',
  '':  '&egrave;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}


function submitForm(btn) {
       // disable the button
       btn.disabled = true;
       // submit the form
       btn.form.submit();
   }

tinymce.init({
  selector: 'textarea.editor',
  height: 150,
  theme: 'modern',
  content_style: ".mce-content-body {font-size:14px;}",
    entity_encoding : "raw",
  force_br_newlines : true,
  force_p_newlines : false,
  forced_root_block : '',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools  save'
  ],
  toolbar1: 'insertfile undo redo | styleselect| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons |  save',
  image_advtab: true,
 setup: function (ed) {
        ed.on('keyup', function (e) {



		//var testo=tinyMCE.activeEditor.getContent();
			var testo=encodeURIComponent(tinyMCE.activeEditor.getContent());
               var id = this.id;
			 var id_ref=  $('#'+id).prev().prev().val();
			// console.log(id);
		//console.log(id_ref);

			  $.ajax({
			   type: "POST",
			   url: "update_ref.php",
			   data: "campo="+id+"&value="+testo+"&id="+id_ref,
			   success: function(data){
			 console.log(data);
			   console.log('dato salvato');
			   }
			 });
    });


},
  save_onsavecallback: function() {
                        // USE THIS IN YOUR AJAX CALL
						//var testo=tinyMCE.activeEditor.getContent();
						var testo=encodeURIComponent(tinyMCE.activeEditor.getContent());
               var id = this.id;
			 var id_ref=  $('#'+id).prev().prev().val();

			  $.ajax({
			   type: "POST",
			   url: "update_ref.php",
			   data: "campo="+id+"&value="+testo+"&id="+id_ref,
			   success: function(data){
			console.log(data);
			   console.log('dato salvato');
			   }
			 });

        },
file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: './kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'KCFinder',
			width:700,
            height: 500,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    },
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
 tinymce.init({
  selector: 'textarea.editor2',
  height:500,
  theme: 'modern',
  content_style: ".mce-content-body {font-size:14px;}",
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons',
  image_advtab: true,
file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: './kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'KCFinder',
			width:700,
            height: 500,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    },
	relative_urls : 0,
remove_script_host : 0,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });




 $(function(){


	 $('.specie').change(function(){

		 var campo="<br><p><label>Nuova specie:</label><input type='text' name='specie_new' /></p><br>";
		 $('#newra').remove();
		 if($(this).val() == '0'){

			 $(this).after(campo);

		 }


	 });
	 $('.razza').change(function(){

		 var campo="<div id='newra'><br><p><label>Nuova razza:</label><input type='text' name='razza_new' /></p></div><br>";

		 if($(this).val() == '0'){

			 $(this).after(campo);

		 }
		 else{
			 $('#newra').remove();
		 }


	 });
	 $('.organo').change(function(){

		 var campo="<br><p><label>Nuovo organo:</label><input type='text' name='organo_new' /></p><br>";

		 if($(this).val() == '0'){

			 $(this).after(campo);

		 }


	 });

 });














$(function()
{
	jQuery.validator.addMethod( "money",  function(value, element) {
        var isValidMoney = /^\d{0,12}(\.\d{0,2})?$/.test(value);
        return this.optional(element) || isValidMoney;
    }, "Insert ");


});



 $(document).ready(function(){







 $('#nome_esame2').keyup(function(){

	      var id = $(this).attr('id');
			 var testo=  $(this).val();
			 var id_ref=  $('#'+id).prev().val();
			// console.log(id);
		//console.log(id_ref);

			  $.ajax({
			   type: "POST",
			   url: "update_ref.php",
			   data: "campo="+id+"&value="+testo+"&id="+id_ref,
			   success: function(data){
			 console.log(data);
			   console.log('dato salvato');
			   }
			 });


 });


  $('#dialog').modal();

 //funzione upload multiplo con progress bar
	 $(document).on('change','#pci',function(){
	 var formData = new FormData($("#sec2")[0]);
	   var bar = $('.progress-bar');
    var now = $('.progress-bar').attr('aria-valuenow');
   console.log('now='+now);
   	var status= $('#status');

$.ajax({
    url: "upload.php",
    type: "POST",
    data : formData,
    processData: false,
    contentType: false,
	beforeSend: function() {

       $('#msg').html('Attendi il completamento del caricamento dei files prima di andare avanti......');
	   status.empty();
            var percentVal = '0%';
            bar.attr('style', 'width: '+percentVal);

            now=percentVal;
        },
	 xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);

									   var percentVal = percentComplete + '%';
			                          console.log('perc'+	 percentVal );
                                      bar.attr('style', 'width: '+percentVal);
                                      now=percentVal;
			                          status.html(percentVal + ' completato');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (data) {
                             $('#msg').html(data);

                        }

});

});
	/*
	 *
	 * solo una volta appena si loggano
	 */
/**
toastr.options = {
	 "closeButton": true,
 "positionClass": "toast-top-center",
   "timeOut": "50000"

}
		$.ajax({
			   type: "POST",
			   url: "check_log.php",
			   success: function(data){
				 if(data=='ok') // alert('AbLab si rinnova, consulta il nuovo listino!');
				 toastr.info('AbLab si rinnova, consulta il nuovo listino!');
			   }
			 });*/



$('.add').click(function(){

	var add="<input type='file' name='allegati[]' placeholder='allegati' />";
	$(this).before(add);

});

//delete generico da testare
$('.delete').click(function(){

	var id=$(this).attr('id');
	var t=$(this).prev().val();
	if(confirm('attenzione stai per eliminare un record, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete.php",
			   data: "id="+id+"&tabella="+t,
			   success: function(data){

			  alert('record cancellato');
			   refreshPage();
			   }
			 });

	//	location.reload();
	}
});





$('.delete_ref').click(function(){

	var id=$(this).attr('id');
var id_scheda=$(this).prev().val();
  console.log(id_scheda);
	if(confirm('attenzione stai per eliminare il referto, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_ref.php",
			   data: "id="+id+"&id_scheda="+id_scheda,
			   success: function(data){

			  alert('record cancellato');
			   refreshPage();
			   }
			 });

	//	location.reload();
	}
});


$('.delete_tab').click(function(){

	var id=$(this).prev().val();
	var t=$(this).prev().prev().val();
	if(confirm('attenzione stai per eliminare un record, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_tab.php",
			   data: "id="+id+"&tabella="+t,
			   success: function(data){

			  alert('record cancellato');
			  refreshPage();
			   }
			 });


	}
});
$('.delete_doc').click(function(){

var id=$(this).attr('id');


	if(confirm('attenzione stai per eliminare un documento, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete.php",
			   data: "id="+id+"&tabella=doc",
			   success: function(data){

			  alert('documento cancellato');
			  	 refreshPage();
			   }
			 });


	}
});

$('.delete_utente').click(function(){

	var id=$(this).attr('id');

	if(confirm('attenzione stai per eliminare una clinica, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_utente.php",
			   data: "id="+id,
			   success: function(data){
				  console.log(data);
			  alert('clinica correttamente cancellata');
			   refreshPage();
			   }
			 });


	}
});

$('.delete_esa').click(function(){

	var id=$(this).attr('id');

	if(confirm('attenzione stai per eliminare la scheda, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_scheda.php",
			   data: "id="+id,
			   success: function(data){
				   		  alert('scheda cancellata');
					 refreshPage();

			   }
			 });


	}
});
$('.delete_error').click(function(){

	var id=$(this).attr('id');


		$.ajax({
			   type: "POST",
			   url: "delete_error.php",
			   data: "id="+id,
			   success: function(data){
				   		  console.log('errore cancellato');
		 refreshPage();

			   }
			 });



});

$('.elimina_mod_esame').click(function(){

	var id=$(this).attr('id');

	if(confirm('attenzione stai per archiviare esame, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_esame.php",
			   data: "id="+id,
			   success: function(data){
				   //alert(data);
				   		  alert('esame cancellato');
					 refreshPage();

			   }
			 });


	}
});
$('.delete_topic').click(function(){

	var id=$(this).attr('id');

	if(confirm('attenzione stai per eliminare la discussione, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_topic.php",
			   data: "id="+id,
			   success: function(data){
						  alert('discussione cancellata');
				 refreshPage();
			   }
			 });


	}
});
$('.deleteFoto').click(function(){

	var id=$(this).prev().val();

	if(confirm('attenzione stai per eliminare la foto, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "deleteFotoRef.php",
			   data: "id="+id,
			   success: function(data){
						  alert('foto cancellata');
			 refreshPage();
			   }
			 });


	}
});
$('.delete_post').click(function(){

	var id=$(this).attr('id');

	if(confirm('attenzione stai per eliminare il post, vuoi continuare?')){
		$.ajax({
			   type: "POST",
			   url: "delete_post.php",
			   data: "id="+id,
			   success: function(data){
					  alert('post cancellato');
			 $('.fileupload-preview').empty();
			   }
			 });


	}
});
$('.upExp').change(function(){

	var id=$(this).prev().val();

	$.ajax({
			   type: "POST",
			   url: "update_scheda.php",
			   data: "id="+id,
			   success: function(data){
				//alert(data);
					 refreshPage();
			   }
			 });



});
$(".nazione").change(function(){
	var opzione =  $(this).val();
//se non italia allora cambio campi comune e provincia in text
	 if(opzione!='Italia'){
		 $('#text_localita').removeClass('hide_input');
		 $('#select_localita').addClass('hide_select');
	 }
	 else{
		$('#select_localita').removeClass('hide_select');
		$('#text_localita').addClass('hide_input');
	 }
	   

	});


$(".provincia").change(function(){
var opzione =  $(this).val();
$.ajax({
   type: "GET",
   url: "popola_sel.php",
   data: "opzione="+opzione,
   success: function(data){
	   console.log(data);
   $(".comune").empty();
     $(".comune").html(data);
   }
 });
});
$(".provincia_pro").change(function(){
	var opzione =  $(this).val();
	var tipo='pro';
	$.ajax({
	   type: "GET",
	   url: "popola_sel.php",
	   data: "opzione="+opzione+"&tipo="+tipo,
	   success: function(data){
	   $(".comune_pro").empty();
	     $(".comune_pro").html(data);
	   }
	 });
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
	console.log('cia');
	$('#selpro').prop('checked', false).removeAttr('checked');
	$('span.checked').attr('class', '');
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




$("#sez1 input[type='checkbox']").each(function(){

	 var id=	$(this).attr('id');
		 var check= $(this).prop('checked');


	 if((id== 'opt4' || id== 'opt5')  && check === true){
		 $("#punti").css('display', 'block');
		 }
		  if((id== 'opt4' || id== 'opt5')  && check != true){
		 	$("#punti").css('display', 'none');
		 }
		  if((id== 'opt4')  && check === true){
			    $('#opt5').prop("checked", false);
			    $('#opt5').prop("disabled", true);
		 }
		 if((id== 'opt5')  && check === true){
			    $('#opt4').prop("checked", false);
			    $('#opt4').prop("disabled", true);
		}

});



$("#sez1 input[type='checkbox']").change(function(){
	//quando selezione uno dei margini l'altro va disabilitato
	 var id=	$(this).attr('id');
	 var check= $(this).prop('checked');


 if((id== 'opt4')  && check === true){
	    $('#opt5').prop("checked", false);

 }
 if((id== 'opt5')  && check === true){
	    $('#opt4').prop("checked", false);

}

if((id== 'opt4' || id== 'opt5')  && check === true){
$("#punti").css('display', 'block');
}
 if((id== 'opt4' || id== 'opt5')  && check != true){
	$("#punti").css('display', 'none');
}


});

$("#sez1 .esame").on({
        change: function(){
			 var id=	$(this).attr('id');
		  var check= $(this).prop('checked');
		    console.log(id);
       if( (id==39 || id==40 || id==41 ) && check === true){
$("#hide").removeClass("hide");
}
else{
	$("#hide").addClass("hide");
}
        },
        each: function(){
			 var id=	$(this).attr('id');
		  var check= $(this).prop('checked');
       if( (id==39 || id==40 || id==41 ) && check === true){
$("#hide").removeClass("hide");
}
else{
	$("#hide").addClass("hide");
}
        }
    });
	/*jjj*/
$("#sez1 input[type='radio']").change(function(){
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito

	 var id=	$(this).attr('id');
     var check= $(this).prop('checked');

	 if((id <9 || id > 15)   && check === true ){
		 // svuoto
		    $('#opt3').prop("checked", false);
		    $('#opt4').prop("checked", false);
		    $('#opt5').prop("checked", false);
		    $('#opt6').prop("checked", false);

	 }

});
$("#sez1 input[type='radio']").each(function(){
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito

	 var id=	$(this).attr('id');
 var check= $(this).prop('checked');

	 if((id <9 || id > 15)   && check === true  ){
		 // svuoto
		    $('#opt3').prop("checked", false);
		    $('#opt4').prop("checked", false);
		    $('#opt5').prop("checked", false);
		    $('#opt6').prop("checked", false);

	 }

});



  $("#ref input[type='checkbox']").change(function(){
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito

	 var id=	$(this).attr('id');
     var check= $(this).prop('checked');


	 if(check === true ){
		 // svuoto
		    $('#idref_'+id).prop("disabled", false);
		    $('#da_'+id).prop("disabled", false);
		

	 }
	 else{
		   $('#idref_'+id).prop("disabled", true);
		    $('#da_'+id).prop("disabled", true);
		
	 }

});
function conta() {
	var c=0;
		  $(".check").each(function(){ //ciclo i record
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito


     var check= $(this).prop('checked');
		 if(check === true ) c++;
		  });
		 return c;

};
$('.up').click(function(){
	var c=0;
	  $(".check").each(function(){ //ciclo i record
	//gestione disabilitazione esami speciali da 9 a 15 non disabilito

	 var id=	$(this).attr('id');
     var check= $(this).prop('checked');

      var cont = conta();
	  console.log(cont);
	 if(check === true ){

		 // svuoto
		var idreferto =   $('#idref_'+id).val();
		var dataAr=    $('#da_'+id).val();
		var tipo=  $('#tipo_'+id).val();
		var id_cat=  $('#id_cat_'+id).val();
		console.log('id  '+id);
		console.log('id_cat  '+id_cat);
		console.log('id referto '+idreferto);
		console.log('data '+dataAr);
	
		
		 var anno_core=$('#ANNO_CORE').html();
		$.ajax({
	   type: "POST",
	   url: "save_ref.php",
	   data: "id_scheda="+id+"&idref="+idreferto+"&data="+dataAr+"&anno="+anno_core+"&tipo="+tipo+"&id_cat="+id_cat,
	   success: function(data){
	 console.log('record aggiornato, id '+data);
	   }
	 });
	 c++;
		if(cont==c) {
			alert('referti inseriti');
			 refreshPage();
		}

	 }


});	//fine ciclo

//location.reload();
});

$('.pagata').change(function(){
	 	var id=$(this).attr('id');
		 var check= $(this).prop('checked');
          		 var value='';
	 if(check==true) {
	 value='s';}
	 else{

		 value='n';
	 }

	 $.ajax({
	   type: "POST",
	   url: "up_fat.php",
	   data: "id="+id+"&value="+value,
	   success: function(data){
		   console.log(data);
	    refreshPage();
	   }
	 });

 });
//sconto_tmp
  $('.val_temp').change(function(){


  var sconto=$('#sconto_tmp').val();
    var spe_tra=$('#spe_tra_tmp').val();

      var id=$('#id_tmp').val();
	   var dest=$('#dest_temp').val();
	   var impo=$('#impo_temp').val();
	  // alert(spe_tra);
		$.ajax({
	   type: "POST",
	   url: "up_fat_temp.php",
	   data: "dest="+dest+"&id="+id+"&sconto="+sconto+"&spe_tra="+spe_tra+"&imponibile="+impo,
	   success: function(data){

	 console.log(data);
	   refreshPage();
	   }

	 });


});


$referti_temp=[];
/*check se referto duplicato*/
$('.prot').change(function(){




	  var idref=$(this).val();
	  var id=$(this).attr('id');
	  var anno_core=$('#ANNO_CORE').html();
	//check se ho già inserito un dato 
    var check_double=$referti_temp.find(element => element == idref);
	console.log(check_double);
	if (check_double!=idref){
		$referti_temp.push(idref);
	}
	else{
		bootbox.alert('protocollo già inserito');
		$('#'+id).val("");
	}


	  //devo vedere anche l'anno
		$.ajax({
	   type: "POST",
	   url: "check_ref.php",
	   data: "idref="+idref+"&anno="+anno_core,
	   success: function(data){
		//console.log('data'+data);
		   if(data ==='s'){
	  bootbox.alert('protocollo già inserito');
	 $('#'+id).val("");
	   }
	}
	 });


});
//gestione tabelle referti

$('.add_record').click(function(){

	var tab= $(this).prev().val();

	 console.log(tab);

	$.ajax({
	   type: "POST",
	   url: "add_record.php",
	   data: "tab="+tab,
	   success: function(data){
	// console.log(data);
	    $('#t'+tab).append(data);
	   }
	 });



});
$('.del_tab').click(function(){
	var id=$(this).attr('id');
	 console.log(id);
	$.ajax({
	   type: "POST",
	   url: "del_tab.php",
	   data: "id="+id,
	   success: function(data){
	 console.log(data);
	    refreshPage();

	   }
	 });

	});
	$('.del_rec').click(function(){
		var id=$(this).prev().val();
		 console.log(id);
		$.ajax({
		   type: "POST",
		   url: "del_record.php",
		   data: "id="+id,
		   success: function(data){
		 console.log(data);
			refreshPage();
		   }
		 });
		
		
		});
$('.update_ordine_esami').click(function(){

   var numEsami=$('#contaEsami').val();
   var contaEsami=0;
    $('.ordine_esami').each(function(){


            var id=$(this).attr('id');
            var val=$(this).val();
            //  console.log(val);
             contaEsami++;
              $.ajax({
                 type: "POST",
                 url: "change_ord.php",
                 data: "id="+id+"&ord="+val,
                 success: function(data){
            //   console.log(data);

                 }


            });

    console.log(contaEsami);

    });

  if(contaEsami==numEsami){
        console.log("done");
      alert("ordine modificato aggiorna la pagina");
    }

  	});





	  $(".sesso").change(function(){

		     var opt=$(this).val();
		  $('.int').css('display', 'block');
		  if(opt=='Non applicabile') $('.int').css('display', 'none');

		 });


    //refresh dopo download XML
     $(".xml").click(function(){
       setTimeout(() => {  location.href = './index.php?req=fatture'; }, 3000);

        });



		//modal assegna 

		$('.assegna_referto').click(function(){
			var c=0;
			var array_ref=[];
			$(".check").each(function(){ //ciclo i record
		  //gestione disabilitazione esami speciali da 9 a 15 non disabilito
	  
		   var id=	$(this).attr('id');
		   var check= $(this).prop('checked');
	  
			var cont = conta();
			console.log(cont);
		   if(check === true ){
                array_ref.push(id);
              
		   }
		});
		  console.log(array_ref);
			// AJAX request
			$.ajax({
			 url: 'assegna_referto.php',
			 type: 'post',
			 data: {array_ref: array_ref},
			 success: function(response){ 
				console.log(response);
			   // Add response in Modal body
			   $('.modal-body').html(response);
		  
			   // Display Modal
			   $('#modal_assegna_referto').modal('show'); 
			 }
		   });
		  });

		  $('.close_modal').click(function(){
			
              $("#modal_assegna_referto").modal('hide');
		});

		$("#profilo .livello").change(function(){
               
            //hide some fields 
			var livello=$(this).val();
			console.log(livello);

			if (livello=='referti'){
              $('.fatt').hide();
				//hide all but some specific fields
			   $('.form-group').each(function(){
		            
                     if ( !$(this).hasClass('ref')) {
                        $(this).hide();
					 }  

			   });
			}
			else{
				$('.fatt').show();
				$('.form-group').each(function(){
					   $(this).show();

			  });
			}
			  
		});



		//rendi riassegnabile
		$(".delete_assegna_referto").click(function () {
			
			var id=	$(this).attr('id');
			$.ajax({
				type: "POST",
				url: "delete_tab.php",
				data: "id="+id+"&tabella=referti_assegnati",
				success: function(data){
		    console.log(data);
			refreshPage();
				}


		   });

		})
 });
