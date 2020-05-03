var manageCategoriesTable;
$(document).ready(function () {
// active top navbar categories
    $("#navBil").addClass("active");
    $("#topNavDep").addClass("active");
    manageCategoriesTable = $('#manageCategoriesTable').DataTable({
        'ajax': 'php_action/fetchDepenses.php',
        'order': [],
//        'language': {
//            'url': "chemin vers le fichier json"
//        },
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
    }); // manage categories Data Table

    // on click on submit categories form modal
    $('#addCategoriesModalBtn').unbind('click').bind('click', function () {
// reset the form text
        $("#submitCategoriesForm")[0].reset();
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // submit categories form function
        $("#submitCategoriesForm").unbind('submit').bind('submit', function () {

            var date = $("#dateDepenses").val();
            var libelle = $("#libDepenses").val();
            var montant = $("#montantDepenses").val();
            var type = $("#typeDepenses").val();
            if (date == "") {
                $("#dateDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#dateDepenses').closest('.form-group').addClass('has-error');
            } else {
// remov error text field
                $("#dateDepenses").find('.text-danger').remove();
                // success out for form 
                $("#dateDepenses").closest('.form-group').addClass('has-success');
            }

            if (type == "") {
                $("#typeDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#typeDepenses').closest('.form-group').addClass('has-error');
            } else {
// remov error text field
                $("#typeDepenses").find('.text-danger').remove();
                // success out for form 
                $("#typeDepenses").closest('.form-group').addClass('has-success');
            }


            if (type === "Autre") {
                var typea = $("#AutretypeDepenses").val();
                if (typea == "") {
                    $("#AutretypeDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                    $('#AutretypeDepenses').closest('.form-group').addClass('has-error');
                } else {
// remov error text field
                    $("#AutretypeDepenses").find('.text-danger').remove();
                    // success out for form 
                    $("#AutretypeDepenses").closest('.form-group').addClass('has-success');
                }
            }

            if (libelle == "") {
                $("#libDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#libDepenses').closest('.form-group').addClass('has-error');
            } else {
// remov error text field
                $("#libDepenses").find('.text-danger').remove();
                // success out for form 
                $("#libDepenses").closest('.form-group').addClass('has-success');
            }
            if (montant == "") {
                $("#montantDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                $('#montantDepenses').closest('.form-group').addClass('has-error');
            } else {
// remov error text field
                $("#montantDepenses").find('.text-danger').remove();
                // success out for form 
                $("#montantDepenses").closest('.form-group').addClass('has-success');
            }

            if (date && libelle && montant && type) {
                var form = $(this);
                // button loading
                $("#createCategoriesBtn").button('loading');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        // button loading
                        $("#createCategoriesBtn").button('reset');
                        if (response.success == true) {
                            // reload the manage member table 
                            manageCategoriesTable.ajax.reload(null, false);
                            // reset the form text
                            $("#submitCategoriesForm")[0].reset();
                            // remove the error text
                            $(".text-danger").remove();
                            // remove the form error
                            $('.form-group').removeClass('has-error').removeClass('has-success');
                            $('#add-categories-messages').html('<div class="alert alert-success">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                    '</div>');
                            $(".alert-success").delay(500).show(10, function () {
                                $(this).delay(3000).hide(10, function () {
                                    $(this).remove();
                                });
                            }); // /.alert
                        }  // if

                    } // /success
                }); // /ajax	
            } // if

            return false;
        }); // submit categories form function
    }); // /on click on submit categories form modal	

}); // /document

// edit categories function
function editCategories(categoriesId = null) {
    if (categoriesId) {
        // remove the added categories id 
        $('#editCategoriesId').remove();
        // reset the form text
        $("#editCategoriesForm")[0].reset();
        // reset the form text-error
        $(".text-danger").remove();
        // reset the form group errro		
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // edit categories messages
        $("#edit-categories-messages").html("");
        // modal spinner
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.edit-categories-result').addClass('div-hide');
        //modal footer
        $(".editCategoriesFooter").addClass('div-hide');
        $.ajax({
            url: 'php_action/fetchSelectedDepenses.php',
            type: 'post',
            data: {categoriesId: categoriesId},
            dataType: 'json',
            success: function (response) {

                // modal spinner
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.edit-categories-result').removeClass('div-hide');
                //modal footer
                $(".editCategoriesFooter").removeClass('div-hide');
                // set the categories name
                $("#editDateDepenses").val(response.date);
                $("#editLibDepenses").val(response.libelle);
                $("#editMontantDepenses").val(response.montant);
                if (response.type !== "Facture" && response.type !== "Personnel" && response.type !== "Loyer" && response.type !== "Achat Produits") {
                    $("#editautreType").show();
                    $("#editAutretypeDepenses").val(response.type);
                    var au = "Autre";
                    $("#edittypeDepenses").val(au);
                } else {
                    $("#edittypeDepenses").val(response.type);
                    $("#editautreType").hide();
                }
                $(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="' + response.id + '" />');
                // submit of edit categories form
                $("#editCategoriesForm").unbind('submit').bind('submit', function () {
                    var date = $("#editDateDepenses").val();
                    var libelle = $("#editLibDepenses").val();
                    var montant = $("#editMontantDepenses").val();
                    var type = $("#edittypeDepenses").val();
                    if (type === "Autre") {
                        var typea = $("#editAutretypeDepenses").val();
                        if (typea == "") {
                            $("#editAutretypeDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                            $('#editAutretypeDepenses').closest('.form-group').addClass('has-error');
                        } else {
                            // remov error text field
                            $("#editAutretypeDepenses").find('.text-danger').remove();
                            // success out for form 
                            $("#editAutretypeDepenses").closest('.form-group').addClass('has-success');
                        }
                    }


                    if (date == "") {
                        $("#editDateDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editDateDepenses').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editDateDepenses").find('.text-danger').remove();
                        // success out for form 
                        $("#editDateDepenses").closest('.form-group').addClass('has-success');
                    }
                    if (type == "") {
                        $("#edittypeDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#edittypeDepenses').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#edittypeDepenses").find('.text-danger').remove();
                        // success out for form 
                        $("#edittypeDepenses").closest('.form-group').addClass('has-success');
                    }

                    if (libelle == "") {
                        $("#editLibDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editLibDepenses').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editLibDepenses").find('.text-danger').remove();
                        // success out for form 
                        $("#editLibDepenses").closest('.form-group').addClass('has-success');
                    }

                    if (montant == "") {
                        $("#editMontantDepenses").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editMontantDepenses').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editMontantDepenses").find('.text-danger').remove();
                        // success out for form 
                        $("#editMontantDepenses").closest('.form-group').addClass('has-success');
                    }

                    if (date && libelle && montant && type) {
                        var form = $(this);
                        // button loading
                        $("#editCategoriesBtn").button('loading');
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                // button loading
                                $("#editCategoriesBtn").button('reset');
                                if (response.success == true) {
                                    // reload the manage member table 
                                    manageCategoriesTable.ajax.reload(null, false);
                                    // remove the error text
                                    $(".text-danger").remove();
                                    // remove the form error
                                    $('.form-group').removeClass('has-error').removeClass('has-success');
                                    $('#edit-categories-messages').html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');
                                    $(".alert-success").delay(500).show(10, function () {
                                        $(this).delay(3000).hide(10, function () {
                                            $(this).remove();
                                        });
                                    }); // /.alert
                                }  // if

                            } // /success
                        }); // /ajax	
                    } // if


                    return false;
                }); // /submit of edit categories form

            } // /success
        }); // /fetch the selected categories data

    } else {
        alert('Oops!! Refresh the page');
}
} // /edit categories function

// remove categories function
function removeCategories(categoriesId = null) {

    $.ajax({
        url: 'php_action/fetchSelectedDepenses.php',
        type: 'post',
        data: {categoriesId: categoriesId},
        dataType: 'json',
        success: function (response) {

            // remove categories btn clicked to remove the categories function
            $("#removeCategoriesBtn").unbind('click').bind('click', function () {
                // remove categories btn
                $("#removeCategoriesBtn").button('loading');
                $.ajax({
                    url: 'php_action/removeDepenses.php',
                    type: 'post',
                    data: {categoriesId: categoriesId},
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            // remove categories btn
                            $("#removeCategoriesBtn").button('reset');
                            // close the modal 
                            $("#removeCategoriesModal").modal('hide');
                            // update the manage categories table
                            manageCategoriesTable.ajax.reload(null, false);
                            // udpate the messages
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
                            // close the modal 
                            $("#removeCategoriesModal").modal('hide');
                            // udpate the messages
                            $('.remove-messages').html('<div class="alert alert-success">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                    '</div>');
                            $(".alert-success").delay(500).show(10, function () {
                                $(this).delay(3000).hide(10, function () {
                                    $(this).remove();
                                });
                            }); // /.alert
                        } // /else

                    } // /success function
                }); // /ajax function request server to remove the categories data
            }); // /remove categories btn clicked to remove the categories function

        } // /response
    }); // /ajax function to fetch the categories data
} // remove categories function