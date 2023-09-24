
	 $(".nazione").change(function(){
		var opzione =  $(this).val();
	//se non italia allora cambio campi comune e provincia in text
		 if(opzione!='Italia'){
			 $('#text_localita').removeClass('hide-text');
			 $('#select_localita').addClass('hide_select');
			/* $("input[name=comune_txt]").attr('required', true);
			 $("input[name=provincia_txt]").attr('required', true);
			 $(".provincia").attr('required', false);	
			 $(".comune").attr('required', false);	*/
		 }
		 else{
			$('#select_localita').removeClass('hide_select');
			$('#text_localita').addClass('hide-text');
		/*	$("input[name=comune_txt]").attr('required', false);
			$("input[name=provincia_txt]").attr('required', false);
			$(".provincia").attr('required', true);	
			$(".comune").attr('required', true);	*/
		 }
		   
	
		});
	 
	 
	 $(".provincia").change(function(){
		 var opzione =  $(this).val();
		 	console.log(opzione);
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


	 $("#piva").change(function(){

      var piva=$(this).val();
			console.log(piva);

			$.ajax({
 		    type: "GET",
 		    url: "check_piva_doppia.php",
 		    data: "piva="+piva,
 		    success: function(data){
 				console.log(data);
				if(data!='true') alert("PARTITA IVA GIA CODIFICATA DAL SISTEMA, CONTATTARE IL LABORATORIO AL NUM 0187626259 ");
 		    }
 		  });



	 })
