var manageBrandTable;

$(document).ready(function () {
    // top bar active
    $('#navPersonnel').addClass('active');

    // manage brand table
    manageBrandTable = $("#manageBrandTable").DataTable({
        'ajax': 'php_action/fetchPersonnel.php',
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

    // add product modal btn clicked
    $("#addProductModalBtn").unbind('click').bind('click', function () {
        // // product form reset
        $("#submitBrandForm")[0].reset();
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        $("#personnelImage").fileinput({
            overwriteInitial: true,
            maxFileSize: 2500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
        });

        // submit brand form function
        $("#submitBrandForm").unbind('submit').bind('submit', function () {

            var personnelImage = $("#personnelImage").val();
            var nom_prenom = $("#nom_prenom").val();
            var cni = $("#cni").val();
            var fonction_personnel = $("#fonctionPersonnel").val();
            var date_fonction = $("#dateFonction").val();
            var contact = $("#contact").val();
            var salaire = $("#salaire").val();

            if (salaire == "") {
                $("#salaire").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#salaire').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#salaire").find('.text-danger').remove();
                // success out for form 
                $("#salaire").closest('.form-group').addClass('has-success');
            }
            if (contact == "") {
                $("#contact").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#contact').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#contact").find('.text-danger').remove();
                // success out for form 
                $("#contact").closest('.form-group').addClass('has-success');
            }
            if (cni == "") {
                $("#cni").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#cni').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#cni").find('.text-danger').remove();
                // success out for form 
                $("#cni").closest('.form-group').addClass('has-success');
            }
            if (personnelImage == "") {
                $("#personnelImage").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#personnelImage').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#personnelImage").find('.text-danger').remove();
                // success out for form 
                $("#personnelImage").closest('.form-group').addClass('has-success');
            }
            if (nom_prenom == "") {
                $("#nom_prenom").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#nom_prenom').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#nom_prenom").find('.text-danger').remove();
                // success out for form 
                $("#nom_prenom").closest('.form-group').addClass('has-success');
            }
            if (fonction_personnel == "") {
                $("#fonctionPersonnel").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#fonctionPersonnel').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#fonctionPersonnel").find('.text-danger').remove();
                // success out for form 
                $("#fonctionPersonnel").closest('.form-group').addClass('has-success');
            }

            if (date_fonction == "") {
                $("#dateFonction").after('<p class="text-danger">Ce champ est requis !</p>');

                $('#dateFonction').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#dateFonction").find('.text-danger').remove();
                // success out for form 
                $("#dateFonction").closest('.form-group').addClass('has-success');
            }

            if (personnelImage && nom_prenom && fonction_personnel && date_fonction && cni && contact && salaire) {

                $("#createBrandBtn").button('loading');

                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        // button loading
                        $("#createBrandBtn").button('reset');

                        if (response.success == true) {

                            $("#createBrandBtn").button('reset');

                            $("#submitBrandForm")[0].reset();

                            $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                            $('#add-brand-messages').html('<div class="alert alert-success">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                    '</div>');

                            $(".alert-success").delay(500).show(10, function () {
                                $(this).delay(1000).hide(10, function () {
                                    $(this).remove();
                                });
                            }); // /.alert

                            // reload the manage student table
                            manageBrandTable.ajax.reload(null, true);
                            // remove text-error 
                            $(".text-danger").remove();
                            // remove from-group error
                            $(".form-group").removeClass('has-error').removeClass('has-success');

                        }  // if

                    } // /success
                }); // /ajax	
            } // if

            return false;
        }); // /submit brand form function
    }); // /add product modal btn clicked

});

function editBrands(brandId = null) {
    if (brandId) {
        // remove hidden brand id text
        $('#brandId').remove();
        // remove text-error 
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        // modal spinner
        $('.div-loading').removeClass('div-hide');
        // modal div
        $('.div-result').addClass('div-hide');
        // modal loading
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.edit-brand-result').addClass('div-hide');
        // modal footer
        $('.editBrandFooter').addClass('div-hide');

        $.ajax({
            url: 'php_action/fetchSelectedPersonnel.php',
            type: 'post',
            data: {persoId: brandId},
            dataType: 'json',
            success: function (response) {
                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.edit-brand-result').removeClass('div-hide');
                // modal footer
                $('.editBrandFooter').removeClass('div-hide');
                // modal spinner
                $('.div-loading').addClass('div-hide');
                // modal div
                $('.div-result').removeClass('div-hide');


                $("#getProductImage").attr('src', 'kabostock/' + response.photo);

                $("#editProductImage").fileinput({
                });

                // brand id 
                $(".editPersoFooter").after('<input type="hidden" name="id" id="id" value="' + response.id + '" />');
                $(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="' + response.id + '" />');

                // setting the brand name value 
                $('#editnom_prenom').val(response.nom_prenom);
                $('#editcni').val(response.cni);
                $('#editfonctionPersonnel').val(response.fonction);
                $('#editdateFonction').val(response.date_fonction);
                $('#editcontact').val(response.contact);
                $('#editsalaire').val(response.salaire);

                // update brand form 
                $('#editBrandForm').unbind('submit').bind('submit', function () {

                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');

                    var nom = $('#editnom_prenom').val(),
                            cni = $('#editcni').val(),
                            fonct = $('#editfonctionPersonnel').val(),
                            dateF = $('#editdateFonction').val(),
                            cont = $('#editcontact').val(),
                            salaire = $('#editsalaire').val();

                    if (salaire == "") {
                        $("#editsalaire").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editsalaire').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editsalaire").find('.text-danger').remove();
                        // success out for form 
                        $("#editsalaire").closest('.form-group').addClass('has-success');
                    }
                    if (cont == "") {
                        $("#editcontact").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editcontact').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editcontact").find('.text-danger').remove();
                        // success out for form 
                        $("#editcontact").closest('.form-group').addClass('has-success');
                    }
                    if (cni == "") {
                        $("#editcni").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editcni').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editcni").find('.text-danger').remove();
                        // success out for form 
                        $("#editcni").closest('.form-group').addClass('has-success');
                    }
                    if (nom == "") {
                        $("#editnom_prenom").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editnom_prenom').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editnom_prenom").find('.text-danger').remove();
                        // success out for form 
                        $("#editnom_prenom").closest('.form-group').addClass('has-success');
                    }

                    if (fonct == "") {
                        $("#editfonctionPersonnel").after('<p class="text-danger">Ce champ est requis !</p>');

                        $('#editfonctionPersonnel').closest('.form-group').addClass('has-error');
                    } else {
                        // remove error text field
                        $("#editfonctionPersonnel").find('.text-danger').remove();
                        // success out for form 
                        $("#editfonctionPersonnel").closest('.form-group').addClass('has-success');
                    }
                    if (dateF == "") {
                        $("#editdateFonction").after('<p class="text-danger">Ce champ est requis !</p>');

                        $('#editdateFonction').closest('.form-group').addClass('has-error');
                    } else {
                        // remove error text field
                        $("#editdateFonction").find('.text-danger').remove();
                        // success out for form 
                        $("#editdateFonction").closest('.form-group').addClass('has-success');
                    }

                    if (nom && fonct && dateF && cni && cont && salaire) {
                        var form = $(this);
                        // submit btn
                        $('#editBrandBtn').button('loading');

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {

                                if (response.success == true) {
                                    console.log(response);
                                    // submit btn
                                    $('#editBrandBtn').button('reset');

                                    // reload the manage member table 
                                    manageBrandTable.ajax.reload(null, false);
                                    // remove the error text
                                    $(".text-danger").remove();
                                    // remove the form error
                                    $('.form-group').removeClass('has-error').removeClass('has-success');

                                    $('#edit-brand-messages').html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');

                                    $(".alert-success").delay(500).show(10, function () {
                                        $(this).delay(3000).hide(10, function () {
                                            $(this).remove();
                                        });
                                    }); // /.alert
                                } // /if

                            }// /success
                        });	 // /ajax												
                    } // /if

                    return false;
                }); // /update brand form


                // update the product image				
                $("#updateProductImageForm").unbind('submit').bind('submit', function () {
                    // form validation
                    var productImage = $("#editProductImage").val();

                    if (productImage == "") {
                        $("#editProductImage").closest('.center-block').after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editProductImage').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProductImage").find('.text-danger').remove();
                        // success out for form 
                        $("#editProductImage").closest('.form-group').addClass('has-success');
                    }	// /else

                    if (productImage) {
                        // submit loading button
                        $("#editProductImageBtn").button('loading');

                        var form = $(this);
                        var formData = new FormData(this);

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {

                                if (response.success == true) {
                                    // submit loading button
                                    $("#editProductImageBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                                    // shows a successful message after operation
                                    $('#edit-productPhoto-messages').html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');

                                    // remove the mesages
                                    $(".alert-success").delay(500).show(10, function () {
                                        $(this).delay(3000).hide(10, function () {
                                            $(this).remove();
                                        });
                                    }); // /.alert

                                    // reload the manage student table
                                    manageBrandTable.ajax.reload(null, true);

                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'php_action/fetchPersoImageUrl.php?i=' + brandId,
                                        type: 'post',
                                        success: function (response) {
                                            $("#getProductImage").attr('src', response);
                                        }
                                    });

                                    // remove text-error 
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group").removeClass('has-error').removeClass('has-success');

                                } // /if response.success

                            } // /success function
                        }); // /ajax function
                    }	 // /if validation is ok 					

                    return false;
                }); // /update the product image


            } // /success
        }); // ajax function

    } else {
        alert('Erreur !!! Veuillez rafraîchir la page !');
}
} // /edit brands function

function removeBrands(brandId = null) {
    if (brandId) {
        $('#removeBrandId').remove();
        $.ajax({
            url: 'php_action/fetchSelectedPersonnel.php',
            type: 'post',
            data: {persoId: brandId},
            dataType: 'json',
            success: function (response) {
                $('.removeBrandFooter').after('<input type="hidden" name="removePersoId" id="removePersoId" value="' + response.id + '" /> ');

                // click on remove button to remove the brand
                $("#removeBrandBtn").unbind('click').bind('click', function () {
                    // button loading
                    $("#removeBrandBtn").button('loading');

                    $.ajax({
                        url: 'php_action/removePersonnel.php',
                        type: 'post',
                        data: {removePersoId: brandId},
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            // button loading
                            $("#removeBrandBtn").button('reset');
                            if (response.success == true) {

                                // hide the remove modal 
                                $('#removeMemberModal').modal('hide');

                                // reload the brand table 
                                manageBrandTable.ajax.reload(null, false);

                                $('.remove-messages').html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                $(".alert-success").delay(500).show(10, function () {
                                    $(this).delay(3000).hide(10, function () {
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
