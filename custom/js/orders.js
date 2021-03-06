var manageOrderTable;

$(document).ready(function () {

    var divRequest = $(".div-request").text();
    $("#formCheque").hide();
    // top nav bar 
    $("#navOrders").addClass('active');

    if (divRequest == 'add') {
        // add order	
        // top nav child bar 
        $('#topNavAddOrders').addClass('active');

        // create order form function
        $("#createOrderForm").unbind('submit').bind('submit', function () {
            //var form = $(this);

            $('.form-group').removeClass('has-error').removeClass('has-success');
            $('.text-danger').remove();

            var orderDate = $("#orderDate").val();
            var clientName = $("#clientName").val();
            var clientContact = $("#clientContact").val();
            var paid = $("#paid").val();
            var discount = $("#discount").val();
            var paymentType = $("#paymentType").val();
            var paymentStatus = $("#paymentStatus").val();

            // form validation 
            if (orderDate == "") {
                $("#orderDate").after('<p class="text-danger"> La date de vente est requise !</p>');
                $('#orderDate').closest('.form-group').addClass('has-error');
            } else {
                $('#orderDate').closest('.form-group').addClass('has-success');
            } // /else

            if (clientName == "") {
                $("#clientName").after('<p class="text-danger">Le nom du client est requis !</p>');
                $('#clientName').closest('.form-group').addClass('has-error');
            } else {
                $('#clientName').closest('.form-group').addClass('has-success');
            } // /else

            if (clientContact == "") {
                $("#clientContact").after('<p class="text-danger"> Le contact du client est requis ! </p>');
                $('#clientContact').closest('.form-group').addClass('has-error');
            } else {
                $('#clientContact').closest('.form-group').addClass('has-success');
            } // /else

            if (paid == "") {
                $("#paid").after('<p class="text-danger"> Le montant payé est requis !</p>');
                $('#paid').closest('.form-group').addClass('has-error');
            } else {
                $('#paid').closest('.form-group').addClass('has-success');
            } // /else

            if (discount == "") {
                $("#discount").after('<p class="text-danger"> La remise est requise !</p>');
                $('#discount').closest('.form-group').addClass('has-error');
            } else {
                $('#discount').closest('.form-group').addClass('has-success');
            } // /else

            if (paymentType == "") {
                $("#paymentType").after('<p class="text-danger"> Veuillez choisir le type de paiement !</p>');
                $('#paymentType').closest('.form-group').addClass('has-error');
            } else {
                $('#paymentType').closest('.form-group').addClass('has-success');
            } // /else

            if (paymentStatus == "") {
                $("#paymentStatus").after('<p class="text-danger"> Veuillez choisir le statut du paiement !</p>');
                $('#paymentStatus').closest('.form-group').addClass('has-error');
            } else {
                $('#paymentStatus').closest('.form-group').addClass('has-success');
            } // /else


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
            }  // for

            for (var x = 0; x < quantity.length; x++) {
                if (quantity[x].value) {
                    validateQuantity = true;
                } else {
                    validateQuantity = false;
                }
            } // for       	

            var ratev = document.getElementsByName('ratev[]');
            var validateRate;
            for (var x = 0; x < ratev.length; x++) {
                var ratevId = ratev[x].id;
                if (ratev[x].value == '') {
                    $("#" + ratevId + "").after('<p class="text-danger"> Rate Field is required!! </p>');
                    $("#" + ratevId + "").closest('.form-group').addClass('has-error');
                } else {
                    $("#" + ratevId + "").closest('.form-group').addClass('has-success');
                }
            }  // for

            for (var x = 0; x < ratev.length; x++) {
                if (ratev[x].value) {
                    validateRate = true;
                } else {
                    validateRate = false;
                }
            } // for       	


            if (orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
                if (validateProduct == true && validateQuantity == true && validateRate == true) {
                    // create order button
                    $("#createOrderBtn").button('loading');
                   
                    var form = $(this);
                    var formData = new FormData(this);
                    //console.log(formData);exit();
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
                            // reset button
                            $("#createOrderBtn").button('reset');

                            $(".text-danger").remove();
                            $('.form-group').removeClass('has-error').removeClass('has-success');

                            if (response.success == true) {

                                // create order button
                                $(".success-messages").html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        ' <br /> <br /> <a target="_blank" href="imprimer.php?tf=' + response.order_id + '&ty=fact" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimer </a>' +
                                        '<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Une Nouvelle Commande </a>' +
                                        '</div>');

                                $("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

                                // disabled te modal footer button
                                $(".submitButtonFooter").addClass('div-hide');
                                // remove the product row
                                $(".removeProductRowBtn").addClass('div-hide');

                            } else {
                                alert(response.messages);
                            }
                        } // /response
                    }); // /ajax
                } // if array validate is true
            } // /if field validate is true


            return false;
        }); // /create order form function	

    } else if (divRequest == 'manord') {
        // top nav child bar 
        $('#topNavManageOrders').addClass('active');

        manageOrderTable = $("#manageOrderTable").DataTable({
            'ajax': 'php_action/fetchOrder.php',
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

    } else if (divRequest == 'editOrd') {

        // edit order form function
        $("#editOrderForm").unbind('submit').bind('submit', function () {
            // alert('ok');
            var form = $(this);

            $('.form-group').removeClass('has-error').removeClass('has-success');
            $('.text-danger').remove();

            var orderDate = $("#orderDate").val();
            var clientName = $("#clientName").val();
            var clientContact = $("#clientContact").val();
            var paid = $("#paid").val();
            var discount = $("#discount").val();
            var paymentType = $("#paymentType").val();
            var paymentStatus = $("#paymentStatus").val();

            // form validation 
            if (orderDate == "") {
                $("#orderDate").after('<p class="text-danger"> La date de vente est requise !</p>');
                $('#orderDate').closest('.form-group').addClass('has-error');
            } else {
                $('#orderDate').closest('.form-group').addClass('has-success');
            } // /else

            if (clientName == "") {
                $("#clientName").after('<p class="text-danger">Le nom du client est requis !</p>');
                $('#clientName').closest('.form-group').addClass('has-error');
            } else {
                $('#clientName').closest('.form-group').addClass('has-success');
            } // /else

            if (clientContact == "") {
                $("#clientContact").after('<p class="text-danger"> Le contact du client est requis ! </p>');
                $('#clientContact').closest('.form-group').addClass('has-error');
            } else {
                $('#clientContact').closest('.form-group').addClass('has-success');
            } // /else

            if (paid == "") {
                $("#paid").after('<p class="text-danger"> Le montant payé est requis !</p>');
                $('#paid').closest('.form-group').addClass('has-error');
            } else {
                $('#paid').closest('.form-group').addClass('has-success');
            } // /else

            if (discount == "") {
                $("#discount").after('<p class="text-danger"> La remise est requise !</p>');
                $('#discount').closest('.form-group').addClass('has-error');
            } else {
                $('#discount').closest('.form-group').addClass('has-success');
            } // /else

            if (paymentType == "") {
                $("#paymentType").after('<p class="text-danger"> Veuillez choisir le type de paiement !</p>');
                $('#paymentType').closest('.form-group').addClass('has-error');
            } else {
                $('#paymentType').closest('.form-group').addClass('has-success');
            } // /else

            if (paymentStatus == "") {
                $("#paymentStatus").after('<p class="text-danger"> Veuillez choisir le statut du paiement !</p>');
                $('#paymentStatus').closest('.form-group').addClass('has-error');
            } else {
                $('#paymentStatus').closest('.form-group').addClass('has-success');
            } // /else


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
            }  // for

            for (var x = 0; x < quantity.length; x++) {
                if (quantity[x].value) {
                    validateQuantity = true;
                } else {
                    validateQuantity = false;
                }
            } // for       	


            var ratev = document.getElementsByName('ratev[]');
            var validateRate;
            for (var x = 0; x < ratev.length; x++) {
                var ratevId = ratev[x].id;
                if (ratev[x].value == '') {
                    $("#" + ratevId + "").after('<p class="text-danger"> Rate Field is required!! </p>');
                    $("#" + ratevId + "").closest('.form-group').addClass('has-error');
                } else {
                    $("#" + ratevId + "").closest('.form-group').addClass('has-success');
                }
            }  // for

            for (var x = 0; x < ratev.length; x++) {
                if (ratev[x].value) {
                    validateRate = true;
                } else {
                    validateRate = false;
                }
            } // for       	



            if (orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
                if (validateProduct == true && validateQuantity == true && validateRate == true) {

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            // reset button
                            $("#editOrderBtn").button('reset');

                            $(".text-danger").remove();
                            $('.form-group').removeClass('has-error').removeClass('has-success');

                            if (response.success == true) {

                                // create order button
                                $(".success-messages").html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                $("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

                                // disabled te modal footer button
                                $(".editButtonFooter").addClass('div-hide');
                                // remove the product row
                                $(".removeProductRowBtn").addClass('div-hide');


                                $(".success-messages").delay(500).show(10, function () {
                                    $(this).delay(800).hide(10, function () {
                                        location.replace("http://localhost:81/kabostock/orders.php?o=manord");
                                    });
                                }); // /.alert	


                            } else {
                                alert(response.messages);
                            }
                        } // /response
                    }); // /ajax
                } // if array validate is true
            } // /if field validate is true


            return false;
        }); // /edit order form function	
    }

}); // /documernt


// print order function
function printOrder(orderId = null) {
    if (orderId) {

        $.ajax({
            url: 'php_action/printOrder.php',
            type: 'post',
            data: {orderId: orderId},
            dataType: 'text',
            success: function (response) {

                var mywindow = window.open('', 'GESTION DE PRODUITS', 'height=400,width=600');
                mywindow.document.write('<html><head><title>FACTURE CLIENT </title>');
                mywindow.document.write('<link href="assests/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>');
                mywindow.document.write('</head><body>');
                mywindow.document.write(response);
                mywindow.document.write('</body></html>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10


            }// /success function
        }); // /ajax function to fetch the printable order
    } // /if orderId
} // /print order function

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
        url: 'php_action/fetchProductData.php',
        type: 'post',
        dataType: 'json',
        success: function (response) {
            $("#addRowBtn").button("reset");

            var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
                    '<td>' +
                    '<div class="form-group">' +
                    '<select class="form-control" name="productName[]" id="productName' + count + '" onchange="getProductData(' + count + ')" >' +
                    '<option value="">~~Choisir~~</option>';
            // console.log(response);
            $.each(response, function (index, value) {
                tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
            });

            tr += '</select>' +
                    '</div>' +
                    '</td>' +
                    '<td style="padding-left: 1em">' +
                    '<input type="text" name="ratea[]" id="ratea' + count + '" autocomplete="off" disabled="true" class="form-control" />' +
                    '<input type="hidden" name="rateaValue[]" id="rateaValue' + count + '" autocomplete="off" class="form-control" />' +
                    '</td>' +
                    '<td style="">' +
                    '<div class="form-group" style="padding-left: 1em">' +
                    '<input type="text" name="ratev[]" id="ratev' + count + '" autocomplete="off" class="form-control" onchange="getTotal(' + count + ')" onkeyup="getTotal(' + count + ')"/>' +
                    ' </div>' +
                    ' </td>' +
                    '<td> ' +
                    '<div class="form-group" style="padding-left: 1.5em">' +
                    '   <input type="number" name="quantity[]" id="quantity' + count + '" onchange="getTotal(' + count + ')" onkeyup="getTotal(' + count + ')" autocomplete="off" class="form-control" min="1" />' +
                    '</div>' +
                    '</td>' +
                    '<td style="padding-left: 12px">' +
                    '<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control" disabled="true" />' +
                    '<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control" />' +
                    ' </td>' +
                    '<td>' +
                    '       <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(' + count + ')"><i class="glyphicon glyphicon-trash"></i></button>' +
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

function removeProductRow(row = null) {
    if (row) {
        $("#row" + row).remove();

        subAmount();
    } else {
        alert('Erreur! Veuillez rafraîchir la page !');
}
}

// select on product data
function getProductData(row = null) {
    if (row) {
        var productId = $("#productName" + row).val();

        if (productId == "") {
            $("#ratea" + row).val("");
            $("#quantity" + row).val("");
            $("#total" + row).val("");

        } else {
            $.ajax({
                url: 'php_action/fetchSelectedProduct.php',
                type: 'post',
                data: {productId: productId},
                dataType: 'json',
                success: function (response) {
                    $("#ratea" + row).val(response.ratea);
                    $("#rateaValue" + row).val(response.ratea);

                    $("#quantity" + row).val(1);

                } // /success
            }); // /ajax function to fetch the product data	
        }

    } else {
        alert("Pas d'entrée ! Veuillez rafraîchir la page !");
}
} // /select on product data

// table total
function getTotal(row = null) {
    if (row) {
        var total = Number($("#ratev" + row).val()) * Number($("#quantity" + row).val());
        total = total.toFixed(2);
        $("#total" + row).val(total);
        $("#totalValue" + row).val(total);
        subAmount();

    } else {
        alert("Pas d'entrée ! Veuillez rafraîchir la page !");
}
}

function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#productTable tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);

        totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
        //alert(remis);
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
    // total amount
    $("#totalAmount").val(totalSubAmount);
    $("#totalAmountValue").val(totalSubAmount);

    // sub total
    var totalAmount = (Number($("#totalAmount").val()) / 1.18);
    totalAmount = totalAmount.toFixed(2);
    $("#subTotal").val(totalAmount);
    $("#subTotalValue").val(totalAmount);

    // vat
    var vat = (Number($("#subTotal").val()) / 100) * 18;
    vat = vat.toFixed(2);
    $("#vat").val(vat);
    $("#vatValue").val(vat);


    var discount = $("#discount").val();
    if (discount) {
        var grandTotal = Number($("#totalAmount").val()) - Number(discount);
        grandTotal = grandTotal.toFixed(2);
        $("#grandTotal").val(grandTotal);
        $("#grandTotalValue").val(grandTotal);
    } else {
        $("#grandTotal").val($("#totalAmount").val());
        $("#grandTotalValue").val($("#totalAmount").val());
    } // /else discount	

    var paidAmount = $("#paid").val();
    if (paidAmount) {
        paidAmount = Number($("#grandTotal").val()) - Number(paidAmount);
        paidAmount = paidAmount.toFixed(2);
        $("#due").val(paidAmount);
        $("#dueValue").val(paidAmount);
    } else {
        $("#due").val($("#grandTotal").val());
        $("#dueValue").val($("#grandTotal").val());
    } // else

} // /sub total amount

function discountFunc() {
    var prd = $("#discountp").val();
    $("#discount").val((prd / 100) * $("#totalAmount").val())

    var discount = $("#discount").val();
    var totalAmount = Number($("#totalAmount").val());
    totalAmount = totalAmount.toFixed(2);

    var grandTotal;
    if (totalAmount) {
        grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
        grandTotal = grandTotal.toFixed(2);

        $("#grandTotal").val(grandTotal);
        $("#grandTotalValue").val(grandTotal);
    } else {
    }

    var paid = $("#paid").val();

    var dueAmount;
    if (paid) {
        dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
        dueAmount = dueAmount.toFixed(2);

        $("#due").val(dueAmount);
        $("#dueValue").val(dueAmount);
    } else {
        $("#due").val($("#grandTotal").val());
        $("#dueValue").val($("#grandTotal").val());
    }

} // /discount function

function paidAmount() {
    var grandTotal = $("#grandTotal").val();

    if (grandTotal) {
        var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
        dueAmount = dueAmount.toFixed(2);
        $("#due").val(dueAmount);
        $("#dueValue").val(dueAmount);
    } // /if
} // /paid amoutn function

function resetOrderForm() {
    // reset the input field
    $("#reset").click();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error 
    $(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form

function formCheque() {
    if ($("#paymentType").val() == "1") {
        $("#formCheque").show(1000);
    } else {
        $("#formCheque").hide();
    }
}

// remove order from server
function removeOrder(orderId = null) {
    if (orderId) {
        $("#removeOrderBtn").unbind('click').bind('click', function () {
            $("#removeOrderBtn").button('loading');

            $.ajax({
                url: 'php_action/removeOrder.php',
                type: 'post',
                data: {orderId: orderId},
                dataType: 'json',
                success: function (response) {
                    $("#removeOrderBtn").button('reset');

                    if (response.success == true) {

                        manageOrderTable.ajax.reload(null, false);
                        // hide modal
                        $("#removeOrderModal").modal('hide');
                        // success messages
                        $("#success-messages").html('<div class="alert alert-success">' +
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
                        // error messages
                        $(".removeOrderMessages").html('<div class="alert alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert	          
                    } // /else

                } // /success
            });  // /ajax function to remove the order

        }); // /remove order button clicked


    } else {
        alert("Erreur ! Veuillez rafraîchir la page !");
}
}
// /remove order from server

// Payment ORDER
function paymentOrder(orderId = null) {
    if (orderId) {

        $("#orderDate").datepicker();

        $.ajax({
            url: 'php_action/fetchOrderData.php',
            type: 'post',
            data: {orderId: orderId},
            dataType: 'json',
            success: function (response) {

                // due 
                $("#due").val(response.order[10]);

                // pay amount 
                $("#payAmount").val(response.order[10]);

                var paidAmount = response.order[9]
                var dueAmount = response.order[10];
                var grandTotal = response.order[8];

                // update payment
                $("#updatePaymentOrderBtn").unbind('click').bind('click', function () {
                    var payAmount = $("#payAmount").val();
                    var paymentType = $("#paymentType").val();
                    var paymentStatus = $("#paymentStatus").val();
                    var paymentDate = $("#datePayment").val();

                    if (paymentDate == "") {
                        $("#datePayment").after('<p class="text-danger">field is required</p>');
                        $("#datePayment").closest('.form-group').addClass('has-error');
                    } else {
                        $("#datePayment").closest('.form-group').addClass('has-success');
                    }
                    if (payAmount == "") {
                        $("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#payAmount").closest('.form-group').addClass('has-error');
                    } else {
                        $("#payAmount").closest('.form-group').addClass('has-success');
                    }

                    if (paymentType == "") {
                        $("#paymentType").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#paymentType").closest('.form-group').addClass('has-error');
                    } else {
                        $("#paymentType").closest('.form-group').addClass('has-success');
                    }

                    if (paymentStatus == "") {
                        $("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#paymentStatus").closest('.form-group').addClass('has-error');
                    } else {
                        $("#paymentStatus").closest('.form-group').addClass('has-success');
                    }

                    if (payAmount && paymentType && paymentStatus && paymentDate) {
                        $("#updatePaymentOrderBtn").button('loading');
                        $.ajax({
                            url: 'php_action/editPayment.php',
                            type: 'post',
                            data: {
                                orderId: orderId,
                                payAmount: payAmount,
                                paymentType: paymentType,
                                paymentStatus: paymentStatus,
                                paidAmount: paidAmount,
                                grandTotal: grandTotal,
                                paymentDate: paymentDate
                            },
                            dataType: 'json',
                            success: function (response) {
                                $("#updatePaymentOrderBtn").button('loading');

                                // remove error
                                $('.text-danger').remove();
                                $('.form-group').removeClass('has-error').removeClass('has-success');

                                $("#paymentOrderModal").modal('hide');

                                $("#success-messages").html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                // remove the mesages
                                $(".alert-success").delay(500).show(10, function () {
                                    $(this).delay(3000).hide(10, function () {
                                        $(this).remove();
                                    });
                                }); // /.alert	

                                // refresh the manage order table
                                manageOrderTable.ajax.reload(null, false);

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



// List Payment ORDER
function listPaymentOrder(orderId = null) {
    if (orderId) {
        $.ajax({
            url: 'php_action/fetchPaymentData.php',
            type: 'post',
            data: {orderId: orderId},
            success: function (response) {
                
                $("#resultatAjax").html(response);
                
            } // /success
        }); // fetch order data
    } else {
        alert("Erreur ! Veuillez rafraîchir la page !");
}
}
