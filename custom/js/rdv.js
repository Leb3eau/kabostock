var manageBrandTable;

$(document).ready(function () {
    // top bar active
    $('#navRDV').addClass('active');

    // manage brand table
    manageBrandTable = $("#manageBrandTable").DataTable({
        'ajax': 'php_action/fetchrdv.php',
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



        // submit brand form function
        $("#submitBrandForm").unbind('submit').bind('submit', function () {

            var clt = $("#clt").val();
            var contact = $("#contact").val();
            var desc = $("#desc").val();
            var lieu = $("#lieu").val();
            var daterdv = $("#daterdv").val();
            var heure = $("#heure").val();

            if (clt == "") {
                $("#clt").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#clt').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#clt").find('.text-danger').remove();
                // success out for form 
                $("#clt").closest('.form-group').addClass('has-success');
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
            if (desc == "") {
                $("#desc").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#desc').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#desc").find('.text-danger').remove();
                // success out for form 
                $("#desc").closest('.form-group').addClass('has-success');
            }
            if (lieu == "") {
                $("#lieu").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#lieu').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#lieu").find('.text-danger').remove();
                // success out for form 
                $("#lieu").closest('.form-group').addClass('has-success');
            }
            if (daterdv == "") {
                $("#daterdv").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#daterdv').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#daterdv").find('.text-danger').remove();
                // success out for form 
                $("#daterdv").closest('.form-group').addClass('has-success');
            }

            if (heure == "") {
                $("#heure").after('<p class="text-danger">Ce champ est requis !</p>');

                $('#heure').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#heure").find('.text-danger').remove();
                // success out for form 
                $("#heure").closest('.form-group').addClass('has-success');
            }

            if (heure && daterdv && lieu && desc && clt && contact) {

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
            url: 'php_action/fetchSelectedRdv.php',
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

                // brand id 
                $(".editCategoriesFooter").after('<input type="hidden" name="id" id="id" value="' + response.id + '" />');

                // setting the brand name value 
                $('#editclt').val(response.client);
                $('#editdesc').val(response.description);
                $('#editlieu').val(response.lieu);
                $('#editdaterdv').val(response.date);
                $('#editcontact').val(response.contact);
                $('#editheure').val(response.heure);

                // update brand form 
                $('#editCategoriesForm').unbind('submit').bind('submit', function () {

                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');

                    var clt = $("#editclt").val();
                    var contact = $("#editcontact").val();
                    var desc = $("#editdesc").val();
                    var lieu = $("#editlieu").val();
                    var daterdv = $("#editdaterdv").val();
                    var heure = $("#editheure").val();

                    if (clt == "") {
                        $("#editclt").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editclt').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editclt").find('.text-danger').remove();
                        // success out for form 
                        $("#editclt").closest('.form-group').addClass('has-success');
                    }
                    if (contact == "") {
                        $("#editcontact").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editcontact').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editcontact").find('.text-danger').remove();
                        // success out for form 
                        $("#editcontact").closest('.form-group').addClass('has-success');
                    }
                    if (desc == "") {
                        $("#editdesc").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editdesc').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editdesc").find('.text-danger').remove();
                        // success out for form 
                        $("#editdesc").closest('.form-group').addClass('has-success');
                    }
                    if (lieu == "") {
                        $("#editlieu").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editlieu').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editlieu").find('.text-danger').remove();
                        // success out for form 
                        $("#editlieu").closest('.form-group').addClass('has-success');
                    }
                    if (daterdv == "") {
                        $("#editdaterdv").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editdaterdv').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editdaterdv").find('.text-danger').remove();
                        // success out for form 
                        $("#editdaterdv").closest('.form-group').addClass('has-success');
                    }

                    if (heure == "") {
                        $("#editheure").after('<p class="text-danger">Ce champ est requis !</p>');

                        $('#editheure').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editheure").find('.text-danger').remove();
                        // success out for form 
                        $("#editheure").closest('.form-group').addClass('has-success');
                    }

                    if (heure && daterdv && lieu && desc && clt && contact) {
                        var form = $(this);
                        // submit btn
                        $('#editCategoriesBtn').button('loading');

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {

                                if (response.success == true) {
                                    console.log(response);
                                    // submit btn
                                    $('#editCategoriesBtn').button('reset');

                                    // reload the manage member table 
                                    manageBrandTable.ajax.reload(null, false);
                                    // remove the error text
                                    $(".text-danger").remove();
                                    // remove the form error
                                    $('.form-group').removeClass('has-error').removeClass('has-success');

                                    $('.remove-messages').html('<div class="alert alert-success">' +
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


// Payment ORDER
function reporter(orderId = null) {
    if (orderId) {
        $.ajax({
            url: 'php_action/fetchRdvData.php',
            type: 'post',
            data: {orderId: orderId},
            dataType: 'json',
            success: function (response) {
                // due 
                $("#date_actu").val(response.order[5]);
                $("#heure_actu").val(response.order[6]);

                // update payment
                $("#updatePaymentOrderBtn").unbind('click').bind('click', function () {
                    var d = $("#newDate").val();
                    var h = $("#newHeure").val();

                    if (h == "") {
                        $("#newHeure").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#newHeure").closest('.form-group').addClass('has-error');
                    } else {
                        $("#newHeure").closest('.form-group').addClass('has-success');
                    }

                    if (d == "") {
                        $("#newDate").after('<p class="text-danger">The Pay Date field is required</p>');
                        $("#newDate").closest('.form-group').addClass('has-error');
                    } else {
                        $("#newDate").closest('.form-group').addClass('has-success');
                    }

                    if (h && d) {
                        $("#updatePaymentOrderBtn").button('loading');
                        $.ajax({
                            url: 'php_action/reporterRdv.php',
                            type: 'post',
                            data: {
                                orderId: orderId,
                                nh: h,
                                nd: d
                            },
                            dataType: 'json',
                            success: function (response) {
                                $("#updatePaymentOrderBtn").button('loading');

                                // remove error
                                $('.text-danger').remove();
                                $('.form-group').removeClass('has-error').removeClass('has-success');

                                //$("#paymentOrderModal").modal('hide');
                                $("#updatePaymentOrderBtn").button('reset');

                                $(".remove-messages").html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                // remove the mesages
                                $(".alert-success").delay(2000).show(10, function () {
                                    $(this).remove();
                                }); // /.alert	
                                $("#closeFermer1").click();

                                // refresh the manage order table
                                manageBrandTable.ajax.reload(null, false);

                            } //

                        });
                    } // /if

                    return false;
                }); // /update payment			

            } // /success
        }); // fetch order data
    } else {
        alert("Erreur ! Veuillez rafraîchir la page !");
}
}

function removeBrands(brandId = null) {
    if (brandId) {
        $('#removeBrandId').remove();
        $.ajax({
            url: 'php_action/fetchSelectedRdv.php',
            type: 'post',
            data: {persoId: brandId},
            dataType: 'json',
            success: function (response) {
                $('.removeBrandFooter').after('<input type="hidden" name="rdvId" id="removePersoId" value="' + response.id + '" /> ');

                // click on remove button to remove the brand
                $("#removeBrandBtn").unbind('click').bind('click', function () {
                    // button loading
                    $("#removeBrandBtn").button('loading');

                    $.ajax({
                        url: 'php_action/removerdv.php',
                        type: 'post',
                        data: {rdvId: brandId},
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

function terminer(brandId = null) {
    if (brandId) {
        $('#removeBrandId').remove();
        $.ajax({
            url: 'php_action/fetchSelectedRdv.php',
            type: 'post',
            data: {persoId: brandId},
            dataType: 'json',
            success: function (response) {
                $('.removeBrandFooter').after('<input type="hidden" name="rdvId" id="removePersoId" value="' + response.id + '" /> ');

                // click on remove button to remove the brand
                $("#terBrandBtn").unbind('click').bind('click', function () {
                    // button loading
                    $("#terBrandBtn").button('loading');

                    $.ajax({
                        url: 'php_action/terminerRdv.php',
                        type: 'post',
                        data: {rdvId: brandId},
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            // button loading
                            $("#terBrandBtn").button('reset');
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