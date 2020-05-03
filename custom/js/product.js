var manageProductTable;
$(document).ready(function () {
    // top nav bar 
    $('#navGestionStock').addClass('active');
    $('#navProduct').addClass('active');

    // manage product data table
    if (so) {
        if (sto == "min") {
            manageProductTable = $('#manageProductTable').DataTable({
                'ajax': 'php_action/fetchProductmin.php',
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
        } else if (sto == "rupture") {
            manageProductTable = $('#manageProductTable').DataTable({
                'ajax': 'php_action/fetchProductrupt.php',
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
    } else {
        manageProductTable = $('#manageProductTable').DataTable({
            'ajax': 'php_action/fetchProduct.php',
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
        $("#submitProductForm")[0].reset();

        // remove text-error 
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');

        // submit product form
        $("#submitProductForm").unbind('submit').bind('submit', function () {

            // form validation



            // array validation
            var productName = document.getElementsByName('productName[]');
            var validateProduct;
            for (var x = 0; x < productName.length; x++) {
                var productNameId = productName[x].id;
                if (productName[x].value == '') {
                    $("#" + productNameId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
                    $("#" + productNameId + "").closest('.form-group').addClass('has-error');
                } else {
                    $("#" + productNameId + "").closest('.form-group').addClass('has-success');
                }
            } // for

            for (var x = 0; x < productName.length; x++) {
                if (productName[x].value) {
                    validateProduct = true;
                } else {
                    validateProduct = false;
                }
            } // for       		   	
 
            // array validation
            var quantity = document.getElementsByName('quantity[]');
            var validateQuantity;
            for (var x = 0; x < quantity.length; x++) {
                var quantityId = quantity[x].id;
                if (quantity[x].value == '') {
                    $("#" + quantityId + "").after('<p class="text-danger"> Quantity Field is required!! </p>');
                    $("#" + quantityId + "").closest('.form-group').addClass('has-error');
                } else {
                    $("#" + quantityId + "").closest('.form-group').addClass('has-success');
                }
            } // for

            for (var x = 0; x < quantity.length; x++) {
                if (quantity[x].value) {
                    validateQuantity = true;
                } else {
                    validateQuantity = false;
                }
            } // for       		   	

            
            // array validation
            var rate = document.getElementsByName('ratea[]');
            var validateRate;
            for (var x = 0; x < rate.length; x++) {
                var rateId = rate[x].id;
                if (rate[x].value == '') {
                    $("#" + rateId + "").after('<p class="text-danger"> Le prix est requis ! </p>');
                    $("#" + rateId + "").closest('.form-group').addClass('has-error');
                } else {
                    $("#" + rateId + "").closest('.form-group').addClass('has-success');
                }
            } // for

            for (var x = 0; x < rate.length; x++) {
                if (rate[x].value) {
                    validateRate = true;
                } else {
                    validateRate = false;
                }
            } // for       		   	



            var type = $("#paymentType").val();
            var mode = $("#paymentStatus").val();
            var brandName = $("#brandName").val();
            var dateLivraison = $("#datelivraison").val();
            var bonLivraison = $("#bonLivraison").val();


            if (type == "") {
                $("#paymentType").after('<p class="text-danger">le nombre de carton est requis</p>');
                $('#paymentType').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#paymentType").find('.text-danger').remove();
                // success out for form 
                $("#paymentType").closest('.form-group').addClass('has-success');
            }	// /else

            if (mode == "") {
                $("#paymentStatus").after('<p class="text-danger">le nombre de carton est requis</p>');
                $('#paymentStatus').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#paymentStatus").find('.text-danger').remove();
                // success out for form 
                $("#paymentStatus").closest('.form-group').addClass('has-success');
            }	// /else

            if (brandName == "") {
                $("#brandName").after('<p class="text-danger">Brand Name field is required</p>');
                $('#brandName').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#brandName").find('.text-danger').remove();
                // success out for form 
                $("#brandName").closest('.form-group').addClass('has-success');
            }	// /else
            if (dateLivraison == "") {
                $("#datelivraison").after('<p class="text-danger">date livraison field is required</p>');
                $('#datelivraison').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#datelivraison").find('.text-danger').remove();
                // success out for form 
                $("#datelivraison").closest('.form-group').addClass('has-success');
            }	// /else
            if (bonLivraison == "") {
                $("#bonLivraison").after('<p class="text-danger">Bon livraison field is required</p>');
                $('#bonLivraison').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#bonLivraison").find('.text-danger').remove();
                // success out for form 
                $("#bonLivraison").closest('.form-group').addClass('has-success');
            }	// /else


            if (brandName && dateLivraison && bonLivraison && type && mode) {
                if (validateProduct == true && validateQuantity == true && validateRate == true) {
                    // submit loading button
                    $("#createProductBtn").button('loading');

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
                            console.log(response);
                            if (response.success == true) {
                                // submit loading button
                                $("#createProductBtn").button('reset');

                                $("#submitProductForm")[0].reset();

                                $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                                // shows a successful message after operation
                                $('#add-product-messages').html('<div class="alert alert-success">' +
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
                                manageProductTable.ajax.reload(null, true);

                                // remove text-error 
                                $(".text-danger").remove();
                                // remove from-group error
                                $(".form-group").removeClass('has-error').removeClass('has-success');

                            } else {
                                $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                                // shows a successful message after operation
                                $('#add-product-messages').html('<div class="alert alert-danger">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                            }


                        } // /success function
                    }); // /ajax function
                }	 // /if validation is ok 					
            }	 // /if validation is ok 					

            return false;
        }); // /submit product form

    }); // /add product modal btn clicked


    // remove product 	

}); // document.ready fucntion

function editProduct(productId = null) {

    if (productId) {
        $("#productId").remove();
        // remove text-error 
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        // modal spinner
        $('.div-loading').removeClass('div-hide');
        // modal div
        $('.div-result').addClass('div-hide');
        $.ajax({
            url: 'php_action/fetchSelectedProduct.php',
            type: 'post',
            data: {productId: productId},
            dataType: 'json',
            success: function (response) {
                // modal spinner
                $('.div-loading').addClass('div-hide');
                // modal div
                $('.div-result').removeClass('div-hide');

                // product id 
                $(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="' + response.product_id + '" />');

                // product name
                $("#editproductName").val(response.produit_id);
                // quantity
                $("#editquantity").val(response.quantity);
                // ratea
                $("#editratea").val(response.ratea);
                $("#editpaymentStatus").val(response.payment_mode);
                $("#editpaymentType").val(response.payment_type);
                // brand name
                $("#editbrandName").val(response.four_id);
                // category name
                $("#editdatelivraison").val(response.date_livraison);
                // status
                $("#editProductStatus").val(response.active);

                // update the product data function
                $("#editProductForm").unbind('submit').bind('submit', function () {

                    // form validation
                    var productName = $("#editproductName").val();
                    var type = $("#editpaymentType").val();
                    var mode = $("#editpaymentStatus").val();
                    var quantity = $("#editquantity").val();
                    var ratea = $("#editratea").val();
                    var brandName = $("#editbrandName").val();
                    var dateLivraison = $("#editdatelivraison").val();
                    var productStatus = $("#editProductStatus").val();


                    if (productStatus == "") {
                        $("#editProductStatus").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editProductStatus').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProductStatus").find('.text-danger').remove();
                        // success out for form 
                        $("#editProductStatus").closest('.form-group').addClass('has-success');
                    }	// /else
                    if (type == "") {
                        $("#editpaymentType").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editpaymentType').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editpaymentType").find('.text-danger').remove();
                        // success out for form 
                        $("#editpaymentType").closest('.form-group').addClass('has-success');
                    }	// /else
                    if (mode == "") {
                        $("#editpaymentStatus").after('<p class="text-danger">Ce champ est requis !</p>');
                        $('#editpaymentStatus').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editpaymentStatus").find('.text-danger').remove();
                        // success out for form 
                        $("#editpaymentStatus").closest('.form-group').addClass('has-success');
                    }	// /else
                    if (productName == "") {
                        $("#editproductName").after('<p class="text-danger">Product Name field is required</p>');
                        $('#editproductName').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editproductName").find('.text-danger').remove();
                        // success out for form 
                        $("#editproductName").closest('.form-group').addClass('has-success');
                    }	// /else

                    if (quantity == "") {
                        $("#editquantity").after('<p class="text-danger">Quantity field is required</p>');
                        $('#editquantity').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editquantity").find('.text-danger').remove();
                        // success out for form 
                        $("#editquantity").closest('.form-group').addClass('has-success');
                    }	// /else


                    if (ratea == "") {
                        $("#editratea").after('<p class="text-danger">Veuillez renseigner le prix d\'achat</p>');
                        $('#editratea').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editratea").find('.text-danger').remove();
                        // success out for form 
                        $("#editratea").closest('.form-group').addClass('has-success');
                    }	// /else

                    if (brandName == "") {
                        $("#editbrandName").after('<p class="text-danger">Brand Name field is required</p>');
                        $('#editbrandName').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editbrandName").find('.text-danger').remove();
                        // success out for form 
                        $("#editbrandName").closest('.form-group').addClass('has-success');
                    }	// /else
                    if (dateLivraison == "") {
                        $("#editdatelivraison").after('<p class="text-danger">date livraison field is required</p>');
                        $('#editdatelivraison').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editdatelivraison").find('.text-danger').remove();
                        // success out for form 
                        $("#editdatelivraison").closest('.form-group').addClass('has-success');
                    }	// /else


                    if (productName && quantity && ratea && brandName && dateLivraison && productStatus && mode && type) {
                        // submit loading button
                        $("#editProductBtn").button('loading');

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
                                console.log(response);
                                if (response.success == true) {
                                    // submit loading button
                                    $("#editProductBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                                    // shows a successful message after operation
                                    $('#edit-product-messages').html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');

                                    // remove the mesages
                                    $(".alert-success").delay(500).show(10, function () {
                                        $(this).delay(3000).hide(50, function () {
                                            $(this).remove();
                                            $("#btnClose").click();
                                        });
                                    }); // /.alert

                                    // reload the manage student table
                                    manageProductTable.ajax.reload(null, true);

                                    // remove text-error 
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group").removeClass('has-error').removeClass('has-success');

                                } // /if response.success

                            } // /success function
                        }); // /ajax function
                    }	 // /if validation is ok 					

                    return false;
                }); // update the product data function

                // update the product image				
                $("#updateProductImageForm").unbind('submit').bind('submit', function () {
                    // form validation
                    var productImage = $("#editProductImage").val();

                    if (productImage == "") {
                        $("#editProductImage").closest('.center-block').after('<p class="text-danger">Product Image field is required</p>');
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
                                console.log(response);
                                if (response.success == true) {
                                    // submit loading button
                                    $("#editProductImageBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                                    // shows a successful message after operation
                                    $('#edit-productPhoto-messages').html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');

                                    $(".alert-success").delay(500).show(10, function () {
                                        $(this).delay(3000).hide(50, function () {
                                            $(this).remove();
                                            $("#btnClose").click();
                                        });

                                    }); // /.alert

                                    // reload the manage student table
                                    manageProductTable.ajax.reload(null, true);

                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'php_action/fetchProductImageUrl.php?i=' + productId,
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

            } // /success function
        }); // /ajax to fetch product image


    } else {
        alert("Erreur ! Veuillez rafraîchir la page !");
}
} // /edit product function

// remove product 
function removeProduct(productId = null) {
    if (productId) {
        // remove product button clicked
        $("#removeProductBtn").unbind('click').bind('click', function () {
            // loading remove button
            $("#removeProductBtn").button('loading');
            $.ajax({
                url: 'php_action/removeProduct.php',
                type: 'post',
                data: {productId: productId},
                dataType: 'json',
                success: function (response) {
                    // loading remove button
                    $("#removeProductBtn").button('reset');
                    if (response.success == true) {
                        // remove product modal
                        $("#removeProductModal").modal('hide');

                        // update the product table
                        manageProductTable.ajax.reload(null, false);

                        // remove success messages
                        $(".remove-messages").html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    } else {

                        // remove success messages
                        $(".removeProductMessages").html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert

                    } // /error
                } // /success function
            }); // /ajax fucntion to remove the product
            return false;
        }); // /remove product btn clicked
    } // /if productid
} // /remove product function

function clearForm(oForm) {
    // var frm_elements = oForm.elements;									
    // console.log(frm_elements);
    // 	for(i=0;i<frm_elements.length;i++) {
    // 		field_type = frm_elements[i].type.toLowerCase();									
    // 		switch (field_type) {
    // 	    case "text":
    // 	    case "password":
    // 	    case "textarea":
    // 	    case "hidden":
    // 	    case "select-one":	    
    // 	      frm_elements[i].value = "";
    // 	      break;
    // 	    case "radio":
    // 	    case "checkbox":	    
    // 	      if (frm_elements[i].checked)
    // 	      {
    // 	          frm_elements[i].checked = false;
    // 	      }
    // 	      break;
    // 	    case "file": 
    // 	    	if(frm_elements[i].options) {
    // 	    		frm_elements[i].options= false;
    // 	    	}
    // 	    default:
    // 	        break;
    //     } // /switch
    // 	} // for
}


function getProduitData(edit = "") {

    var productId = $("#" + edit + "productName").val();

    if (productId == "") {
        $("#" + edit + "ratevp").val("");
        $("#" + edit + "rateve").val("");
    } else {
        $.ajax({
            url: 'php_action/fetchSelectedQualities.php',
            type: 'post',
            data: {categoriesId: productId},
            dataType: 'json',
            success: function (response) {
                $("#" + edit + "ratevp").val(response.ratevp);
                $("#" + edit + "rateve").val(response.rateve);
            }
        });
}
}

function calculNbreBouteilles(edit = "") {
    var nbre = $("#" + edit + "nbre").val(),
            carton = $("#" + edit + "carton").val();

    var bts = Number(nbre) * Number(carton);

    $("#" + edit + "quantity").val(bts);

}


function removeProductRow(row = null) {
    if (row) {
        $("#row" + row).remove();
    } else {
        alert('Erreur! Veuillez rafraîchir la page !');
}
}


function addRow() {
    $("#addRowBtn").button("loading");

    var tableLength = $("#productTable tbody tr").length;

    var tableRow;
    var arrayNumber;
    var count;

    if (tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr('id');
        arrayNumber = $("#productTable tbody tr:last").attr('class');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }

    $.ajax({
        url: 'php_action/fetchProduitData.php',
        type: 'post',
        dataType: 'json',
        success: function (response) {
            $("#addRowBtn").button("reset");
            //<tr id="row' + count + '" class="' + arrayNumber + '">' +

            var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
                    '<td style="">' +
                    '<div class="form-group">' +
                    '<select class="form-control" id="productName' + count + '" name="productName[]">' +
                    '<option value="">~~Choisir~~</option> ';
            // console.log(response);
            $.each(response, function (index, value) {
                tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
            });

            tr += '</select>' +
                    '</div>' +
                    '</td>' +
                    '<td style="padding-left: 5%">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control" id="quantity' + count + '" placeholder="Quantité" name="quantity[]" autocomplete="off">' +
                    '</div>' +
                    ' </td>' +
                    '<td  style="padding-left: 5%">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control" id="ratea' + count + '" placeholder="Prix d\'achat unitaire" name="ratea[]" autocomplete="off">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="col-sm-1" style="">' +
                    '<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(' + count + ')"><i class="glyphicon glyphicon-minus"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
            if (tableLength > 0) {
                $("#productTable tbody tr:last").after(tr);
            } else {
                $("#productTable tbody").append(tr);
            }

        } // /success
    });	// get the product data

} // /add row
