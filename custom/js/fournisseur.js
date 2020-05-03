var manageBrandTable;

$(document).ready(function() {
	// top bar active
        
	$('#navGestionStock').addClass('active');
	$('#navBrand').addClass('active');
	
	// manage brand table
	manageBrandTable = $("#manageBrandTable").DataTable({
		'ajax': 'php_action/fetchProvider.php',
		'order': [],
        'language': {
            decimal: " ",
            processing: "Traitements en cours ...",
            search: "Rechercher &nbsp;:",
            lengthMenu: "Voir _MENU_ lignes",
            info: "Voir de _START_ &agrave; _END_ sur _TOTAL_ lignes",
            infoEmpty: "Voir de 0 &agrave; 0 sur 0 ligne",
            infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix: " ",
            thousands: " ",
            loadingRecords: "Chargement en cours ...",
            emptyTable: "Aucune donnée disponible dans le tableau",
            paginate: {
                first: "Premier",
                previous: "Pr&eacute;c&eacute;dent",
                next: "Suivant",
                last: "Dernier",
            },
            aria: {
                sortAscending: ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre d&eacute;croissant",
            }
        }		
	});

	// submit brand form function
	//submitBrandForm est le id de champs form dans le provider.php
	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var brandName = $("#brandName").val();
		var brandStatus = $("#brandStatus").val();
		var brandCont = $("#contactFourn").val();
		var brandRCCM=$("#RCCM").val();
	    var brandCC=$("#CC").val();
	    var brandSiege_social=$("#Siege_social").val();
	    var brandEmail=$("#Email").val();
	    var brandNom_Livreur=$("#Nom_Livreur").val();
	    var brandNumero_Livreur=$("#Numero_Livreur").val();
	    var brandAdresse_Postale=$("#Adresse_Postale").val();

		if(brandName == "") {
			$("#brandName").after('<p class="text-danger">Le nom du fournisseur est requis !</p>');
			$('#brandName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandName").find('.text-danger').remove();
			// success out for form 
			$("#brandName").closest('.form-group').addClass('has-success');	  	
		}
		if(brandCont == "") {
			$("#contactFourn").after('<p class="text-danger">Le contact fournisseur est requis !</p>');
			$('#contactFourn').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#contactFourn").find('.text-danger').remove();
			// success out for form 
			$("#contactFourn").closest('.form-group').addClass('has-success');	  	
		}

		if(brandStatus == "") {
			$("#brandStatus").after('<p class="text-danger">Le statut est requis !</p>');

			$('#brandStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandStatus").find('.text-danger').remove();
			// success out for form 
			$("#brandStatus").closest('.form-group').addClass('has-success');	  	
		}
		if(brandRCCM == "") {
			$("#RCCM").after('<p class="text-danger">Le RCCM est requis !</p>');

			$('#RCCM').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#RCCM").find('.text-danger').remove();
			// success out for form 
			$("#RCCM").closest('.form-group').addClass('has-success');	  	
		}
		if(brandCC == ""){
			$("#CC").after('<p class="text-danger">Le CC est requis !</p>');

			$('#CC').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#CC").find('.text-danger').remove();
			// success out for form 
			$("#CC").closest('.form-group').addClass('has-success');	  	
		}
		if(brandSiege_social == ""){
			$("#Siege_social").after('<p class="text-danger">Le Siege_social est requis !</p>');

			$('#Siege_social').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Siege_social").find('.text-danger').remove();
			// success out for form 
			$("#Siege_social").closest('.form-group').addClass('has-success');	  	
		}

		if(brandEmail == ""){
			$("#Email").after('<p class="text-danger">Le Email est requis !</p>');

			$('#Email').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Email").find('.text-danger').remove();
			// success out for form 
			$("#Email").closest('.form-group').addClass('has-success');	  	
		}

		if(brandNom_Livreur == ""){
			$("#Nom_Livreur").after('<p class="text-danger">Le Nom_Livreur est requis !</p>');

			$('#Nom_Livreur').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Nom_Livreur").find('.text-danger').remove();
			// success out for form 
			$("#Nom_Livreur").closest('.form-group').addClass('has-success');	  	
		}
		if(brandNumero_Livreur == ""){
			$("#Numero_Livreur").after('<p class="text-danger">Le Numero_Livreur est requis !</p>');

			$('#Numero_Livreur').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Numero_Livreur").find('.text-danger').remove();
			// success out for form 
			$("#Numero_Livreur").closest('.form-group').addClass('has-success');	  	
		}
		if(brandAdresse_Postale == ""){
			$("#Adresse_Postale").after('<p class="text-danger">Le Adresse_Postale est requis !</p>');

			$('#Adresse_Postale').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#Adresse_Postale").find('.text-danger').remove();
			// success out for form 
			$("#Adresse_Postale").closest('.form-group').addClass('has-success');	  	
		}


		if(brandName && brandStatus && brandCont && brandRCCM && brandCC && brandSiege_social && brandEmail && brandNom_Livreur && brandNumero_Livreur && brandAdresse_Postale ) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageBrandTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit brand form function

});
/*pour remplir les champs a l'edition de formulaire*/
function editBrands(brandId = null){
	if(brandId){
		// remove hidden brand id text
		$('#brandId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedProvider.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
                            
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');

				// setting the brand name value 
				$('#editBrandName').val(response.four_name);
				// setting the brand status value
				$('#ContactFournisseur').val(response.four_contact);
				$('#editRCCM').val(response.RCCM);
				$('#editCC').val(response.CC);
				$('#editSiege_social').val(response.Siege_social);
				$('#editEmail').val(response.Email);
				$('#editNom_Livreur').val(response.Nom_Livreur);
				$('#editNumero_Livreur').val(response.Numero_Livreur);
				$('#editAdresse_Postale').val(response.Adresse_Postale);
				$('#editBrandStatus').val(response.four_active);
/*alert(response.RCCM);*/
				
				// brand id 
				$(".editBrandFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+response.four_id+'" />');

				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var brandName =   $('#editBrandName').val();
					var brandStatus = $('#editBrandStatus').val();
					var brandCont =   $('#ContactFournisseur').val();
					var brandRCCM=    $("#editRCCM").val();
				    var brandCC=      $("#editCC").val();
				    var brandSiege_social=$("#editSiege_social").val();
				    var brandEmail=    $("#editEmail").val();
				    var brandNom_Livreur=$("#editNom_Livreur").val();
				    var brandNumero_Livreur=$("#editNumero_Livreur").val();
				    var brandAdresse_Postale=$("#editAdresse_Postale").val();

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">La désignation est requise !</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form 
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}

					if(brandStatus == "") {
						$("#editBrandStatus").after('<p class="text-danger">Le statut est requis !</p>');

						$('#editBrandStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editBrandStatus").find('.text-danger').remove();
						// success out for form 
						$("#editBrandStatus").closest('.form-group').addClass('has-success');	  	
					}
					if(brandCont == "") {
						$("#editBrandStatus").after('<p class="text-danger">Le contact est requis !</p>');

						$('#editBrandStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editBrandStatus").find('.text-danger').remove();
						// success out for form 
						$("#editBrandStatus").closest('.form-group').addClass('has-success');	  	
					}
					if(brandRCCM == "") {
			$("#editRCCM").after('<p class="text-danger">Le RCCM est requis !</p>');

			$('#editRCCM').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editRCCM").find('.text-danger').remove();
			// success out for form 
			$("#editRCCM").closest('.form-group').addClass('has-success');	  	
		}
		if(brandCC == ""){
			$("#editCC").after('<p class="text-danger">Le CC est requis !</p>');

			$('#editCC').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editCC").find('.text-danger').remove();
			// success out for form 
			$("#editCC").closest('.form-group').addClass('has-success');	  	
		}
		if(brandSiege_social == ""){
			$("#editSiege_social").after('<p class="text-danger">Le Siege_social est requis !</p>');

			$('#editSiege_social').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editSiege_social").find('.text-danger').remove();
			// success out for form 
			$("#editSiege_social").closest('.form-group').addClass('has-success');	  	
		}

		if(brandEmail == ""){
			$("#editEmail").after('<p class="text-danger">Le Email est requis !</p>');

			$('#editEmail').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editEmail").find('.text-danger').remove();
			// success out for form 
			$("#editEmail").closest('.form-group').addClass('has-success');	  	
		}

		if(brandNom_Livreur == ""){
			$("#editNom_Livreur").after('<p class="text-danger">Le Nom_Livreur est requis !</p>');

			$('#editNom_Livreur').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editNom_Livreur").find('.text-danger').remove();
			// success out for form 
			$("#editNom_Livreur").closest('.form-group').addClass('has-success');	  	
		}
		if(brandNumero_Livreur == ""){
			$("#editNumero_Livreur").after('<p class="text-danger">Le Numero_Livreur est requis !</p>');

			$('#editNumero_Livreur').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editNumero_Livreur").find('.text-danger').remove();
			// success out for form 
			$("#editNumero_Livreur").closest('.form-group').addClass('has-success');	  	
		}
		if(brandAdresse_Postale == ""){
			$("#editAdresse_Postale").after('<p class="text-danger">Le Adresse_Postale est requis !</p>');

			$('#editAdresse_Postale').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#editAdresse_Postale").find('.text-danger').remove();
			// success out for form 
			$("#editAdresse_Postale").closest('.form-group').addClass('has-success');	  	
		}

					if(brandName && brandStatus && brandCont && brandRCCM && brandCC && brandSiege_social && brandEmail && brandNom_Livreur && brandNumero_Livreur && brandAdresse_Postale) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageBrandTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('Erreur !!! Veuillez rafraîchir la page !');
	}
} // /edit brands function

function removeBrands(brandId = null) {
	if(brandId) {
		$('#removeBrandId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedProvider.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				$('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.four_id+'" /> ');

				// click on remove button to remove the brand
				$("#removeBrandBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBrandBtn").button('loading');

					$.ajax({
						url: 'php_action/removeProvider.php',
						type: 'post',
						data: {brandId : brandId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBrandBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the brand table 
								manageBrandTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('Erreur !!! Veuillez rafraîchir la page !');
	}
} // /remove brands function