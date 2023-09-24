var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#sec4');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
               rules: {
              cognome_proprietario: "required",

        	nome_proprietario: "required",

            email_pro: {
               required: true,
               email: true
            },

            provincia_pro: "required",

            comune_pro: "required",

            indirizzo_pro: "required",
			tel_pro: "required",

            cap_pro: {
            	required: true,
							minlength: 5,
							maxlength: 5,
						postalcodeIT: true
            },
            cod_pro:{
            required:true,
			minlength: 11,
		    maxlength: 16
                },

            specie : "required",
			razza: {
           required:'#specie:selected'
        },
            organo : "required",
			sesso : "required",
			integrita: {
      required: function(element) {
        return $("#sesso").val() !='Non applicabile';
      }
			},
			eta: {
			  required:true
			}
                },
//postalcodeIT
                invalidHandler: function (event, validator) {
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success1.show();
                    error1.hide();
					   form[0].submit(); // submit the form
                }
            });


    }

    var handleValidation2 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form2 = $('#sec4');
            var error2 = $('.alert-danger', form2);
           var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input


                rules: {
                   	cognome_proprietario: "required",

            	nome_proprietario: "required",

            		 specie : "required",
					razza: {
           required:'#specie:selected'
        },
            organo : "required",
			sesso : "required",
					integrita: {
      required: function(element) {
        return $("#sesso").val() !='Non applicabile';
      }
					},
			eta: {
			  required:true
			}
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success2.show();
                    error2.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
	//form sez1
	 var handleValidation3 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form3 = $('#sez3');
            var error3 = $('.alert-danger', form3);
            var success3 = $('.alert-success', form3);

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
               rules: {
             tipo: "required"

                },
//postalcodeIT
                invalidHandler: function (event, validator) {
                    success3.hide();
                    error3.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success3.show();
                    error3.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
 var handleValidation4 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form4 = $('#test');
            var error4 = $('.alert-danger', form4);
            var success4 = $('.alert-success', form4);

            form4.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
               rules: {
             cognome: "required"

                },
//postalcodeIT
                invalidHandler: function (event, validator) {
                    success4.hide();
                    error4.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success4.show();
                    error4.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
	var handleValidation5 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form5 = $('#form-3');
            var error5 = $('.alert-danger', form5);
            var success5 = $('.alert-success', form5);

            form5.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
               rules: {
             destinatario: "required",

			 proprietario: {
				 required: "#selpro:unchecked"
			 }

                },



//postalcodeIT
                invalidHandler: function (event, validator) {
                    success5.hide();
                    error5.show();
                    App.scrollTo(error5, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success5.show();
                    error5.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
	  var handleValidation6 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form6 = $('#profilo');
            var error6 = $('.alert-danger', form6);
            var success6 = $('.alert-success', form6);

            form6.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
              rules: {
        nome: "required",

        referente: "required",
        username:{
            required:true,
            remote:  {
            url:	"check_user2.php",
            type: "post",
             data: {
                  'id_admin': function() {
                    return $( "#id_admin" ).val();
                  }
                }
            }
         },

        password:"required",
          pec: {
         required: function(element) {
        return $("#cod").val() =='';
		 },
		   email: true
        },
		cod: {
			 required: function(element) {
        return $("#pec").val() =='';
		 }

		},
        email: {
           required: true
        },

        provincia: "required",

        comune: "required",

        indirizzo: "required",

        cap: {
        	required:true,
        		minlength: 5,
							maxlength: 5,
						postalcodeIT: true
        },

        telefono:{
        	required:true
        },

        piva:{
        required:true,
       minlength: 11,
							maxlength: 11
        },
        cf:{
            required: true,
							minlength: 11,
							maxlength: 16
            }



    },
//postalcodeIT
                invalidHandler: function (event, validator) {
                    success6.hide();
                    error6.show();
                    App.scrollTo(error6, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success6.show();
                    error6.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
	var handleValidation7 = function() {
        // for more info visit the official plugin documentation:
            // http://docs.jquery.com/Plugins/Validation

            var form7 = $('#reg');
            var error7 = $('.alert-danger', form7);
            var success7 = $('.alert-success', form7);

            form7.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
              rules: {
            nome: "required",

            referente: "required",
			   pec: {
         required: function(element) {
        return $("#cod").val() =='';
		 },
		   email: true
        },
		cod: {
			 required: function(element) {
        return $("#pec").val() =='';
		 }

		},
            username:{

            required:true,

            remote:  "check_user.php"

            },
            password:"required",
			   email: {
           required: true
             },

            provincia: "required",
            livello: "required",

            comune: "required",

            indirizzo: "required",

            cap: {
            		required: true,
							minlength: 5,
							maxlength: 5,
						postalcodeIT: true
            },

            telefono:{
            	required:true
            },

            piva:{
            required:true,
            minlength: 11,
			maxlength: 11,
      remote:  "check_piva_doppia.php"  
            },
            cf:{
               required: true,
							minlength: 11,
							maxlength: 16
                }



        },
//postalcodeIT
                invalidHandler: function (event, validator) {
                    success7.hide();
                    error7.show();
                    App.scrollTo(error7, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success7.show();
                    error7.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
	var handleValidation8 = function() {


            var form8 = $('#sec2');
            var error8 = $('.alert-danger', form8);
           var success8 = $('.alert-success', form8);

            form8.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input


                rules: {
                   	num_referto: "required"
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success8.hide();
                    error8.show();
                    App.scrollTo(error8, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                	     success8.show();
                    error8.hide();
					   form[0].submit(); // submit the form
                }
            });


    }
    var handleWysihtml5 = function() {
        if (!jQuery().wysihtml5) {

            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["../assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    return {
        //main function to initiate the module
        init: function () {

            handleWysihtml5();
			$.ajax({
			   type: "POST",
			   url: "check_dest.php",
			   success: function(data){

					if(data== 'clinica'){
						console.log('cli');
					  handleValidation2();

					}
					if(data== 'proprietario'){
						console.log('prop');
						   handleValidation1();

					}
			   }
			 });

        //  handleValidation3();
 handleValidation4();
 handleValidation5();
 handleValidation6();
  handleValidation7();
  handleValidation8();
        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});
