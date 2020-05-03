var manageBrandTable, manageBrandTable1;

$(document).ready(function () {
// top bar active
    $('#navG_Client').addClass('active');
    // manage brand table
    manageBrandTable = $("#manageBrandTable").DataTable({
        'ajax': 'php_action/fetchGClt.php',
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

    var clt = $("#clt").val();
    if (clt != "") {
        manageBrandTable1 = $("#manageBrandTable1").DataTable({
            'ajax': 'php_action/fetchGClt_1.php?clt=' + clt,
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
    }


// add product modal btn clicked
    $("#addProductModalBtn").unbind('click').bind('click', function () {
// // product form reset
        $("#submitBrandForm")[0].reset();
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $("#pjImage").fileinput({
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
            //defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            //allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF", "PDF", "pdf"]
        });
        // submit brand form function
        $("#submitBrandForm").unbind('submit').bind('submit', function () {

            var pj = $("#pjImage").val();
            var nom_prenom = $("#nom_prenom").val();
            var nom_fichier = $("#nom_fichier").val();
            if (pj == "") {
                $("#pjImage").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#pjImage').closest('.form-group').addClass('has-error');
            } else {
// remov error text field
                $("#pjImage").find('.text-danger').remove();
                // success out for form 
                $("#pjImage").closest('.form-group').addClass('has-success');
            }
            if (nom_fichier == "") {
                $("#nom_fichier").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#nom_fichier').closest('.form-group').addClass('has-error');
            } else {
// remov error text field
                $("#nom_fichier").find('.text-danger').remove();
                // success out for form 
                $("#nom_fichier").closest('.form-group').addClass('has-success');
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
            if (nom_prenom && nom_fichier && pj) {

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

}
);

function removeFic(brandId = null) {
    if (brandId) {
        $.ajax({
            url: 'php_action/removeFig.php',
            type: 'post',
            data: {removePersoId: brandId},
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    // reload the brand table 
                    manageBrandTable1.ajax.reload(null, false);

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

    } else {
        alert('Erreur !!! Veuillez rafraîchir la page !');
}
} // /remove brands function



function addFic(brandId = null) {
    if (brandId) {
        //$('#cltId').remove();
        $.ajax({
            url: 'php_action/fetchSelectedGClt.php',
            type: 'post',
            data: {persoId: brandId},
            dataType: 'json',
            success: function (response) {
                $('#add-Fic-messages').after('<input type="hidden" name="cltId" id="cltId" value="' + response.id + '" /> ');
                $("#nfic").html(response.nom_prenom);


                // click on remove button to remove the brand
                $("#submitFicForm").unbind('submit').bind('submit', function () {

                    var fic = $("#pjFic").val();
                    var nomfic = $("#nom_fichier1").val();


                    if (nomfic == "") {
                        $("#nom_fichier1").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#nom_fichier1').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#nom_fichier11").find('.text-danger').remove();
                        // success out for form 
                        $("#nom_fichier1").closest('.form-group').addClass('has-success');
                    }

                    if (fic == "") {
                        $("#pjFic").after('<p class="text-danger">Ce champ est requis !</p>');

                        $('#pjFic').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#pjFic").find('.text-danger').remove();
                        // success out for form 
                        $("#pjFic").closest('.form-group').addClass('has-success');
                    }
                    //exit();
                    if (fic && nomfic) {

                        $("#createficBtn").button('loading');

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
                                $("#createficBtn").button('reset');

                                if (response.success == true) {

                                    $("#createficBtn").button('reset');

                                    $("#submitFicForm")[0].reset();

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                                    $('.remove-messages').html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');

                                    $("#closeclt").click();
                                    
                                    $(".alert-success").delay(1000).show(10, function () {
                                        $(this).delay(1000).hide(10, function () {
                                            $(this).remove();
                                        });
                                    }); // /.alert

                                    // reload the manage student table
                                    manageBrandTable1.ajax.reload(null, true);
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

            } // /success
        }); // /ajax

        $('#add-Fic-messages').after();
    } else {
        alert('Erreur !!! Veuillez rafraîchir la page !');
}
} // /remove brands function
function removeBrands(brandId = null) {
    if (brandId) {
        $('#removeBrandId').remove();
        $.ajax({
            url: 'php_action/fetchSelectedGClt.php',
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
                        url: 'php_action/removeGClt.php',
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