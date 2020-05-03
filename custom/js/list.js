var manageOrderTable;

$(document).ready(function () {

    var dt = $("#dr").val();

    if (dt === 'ben') {
        $("#navBil").addClass("active");
        $("#topNavListeAchat").addClass("active");

    } else if (dt === 'four') {
        $("#navBil").addClass("active");
        $("#topNavBenFour").addClass("active");
    } else if (dt === 'cr_four') {
        $("#navRestauration").addClass("active");
        $("#topNavcreances_four").addClass("active");
    } else if (dt === 'cr_clt') {
        $("#navRestauration").addClass("active");
        $("#topNavcreances_clt").addClass("active");
    }

    manageOrderTable = $("#manageOrderTable").DataTable({
        'ajax': 'php_action/fetchFourPay.php',
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



    $("#getListeAchat").unbind('submit').bind('submit', function () {

        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();

        if (startDate == "" || endDate == "") {
            if (startDate == "") {
                $("#startDate").closest('.form-group').addClass('has-error');
                $("#startDate").after('<p class="text-danger">Ce champ est requis !</p>');
            } else {
                $(".form-group").removeClass('has-error');
                $(".text-danger").remove();
            }

            if (endDate == "") {
                $("#endDate").closest('.form-group').addClass('has-error');
                $("#endDate").after('<p class="text-danger">Ce champ est requis !</p>');
            } else {
                $(".form-group").removeClass('has-error');
                $(".text-danger").remove();
            }
        } else {
            $(".form-group").removeClass('has-error');
            $(".text-danger").remove();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'text',
                success: function (response) {
                    var mywindow = window.open('', 'GESTION DE PRODUITS', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>LISTE ACHATS</title>');
                    mywindow.document.write('<link href="assests/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

                } // /success
            });	// /ajax

        } // /else

        return false;
    });


}); // /documernt


// print order function
function printOrder(orderId = null) {
    if (orderId) {

        $.ajax({
            url: 'php_action/printPaiementFour.php',
            type: 'post',
            data: {orderId: orderId},
            dataType: 'text',
            success: function (response) {

                var mywindow = window.open('', 'GESTION DE PRODUITS', 'height=400,width=600');
                mywindow.document.write('<html><head><title>FACTURE DE COMMANDE </title>');
                mywindow.document.write('<link href="assests/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>');
                mywindow.document.write('</head><body>');
                mywindow.document.write(response);
                mywindow.document.write('</body></html>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10

//                mywindow.print();
//                mywindow.close();

            }// /success function
        }); // /ajax function to fetch the printable order
    } // /if orderId
} // /print order function

// select on product data
function getProductData(row = null) {
    if (row) {
        var productId = $("#productName" + row).val();

        if (productId == "") {
            $("#rate" + row).val("");
            $("#quantity" + row).val("");
            $("#total" + row).val("");

        } else {
            $.ajax({
                url: 'php_action/fetchSelectedProduct.php',
                type: 'post',
                data: {productId: productId},
                dataType: 'json',
                success: function (response) {
                    if ($("#type_order" + row).val() == "sur_place") {
                        $("#rate" + row).val(response.ratevp);
                        $("#rateValue" + row).val(response.ratevp);
                    } else if ($("#type_order" + row).val() == "emporte") {
                        $("#rate" + row).val(response.rateve);
                        $("#rateValue" + row).val(response.rateve);
                    }

                    $("#quantity" + row).val(1);

                    var total = Number($("#rateValue" + row).val()) * 1;
                    total = total.toFixed(2);
                    $("#total" + row).val(total);
                    $("#totalValue" + row).val(total);

                    subAmount();
                } // /success
            }); // /ajax function to fetch the product data	
        }

    } else {
        alert("Pas d'entrée ! Veuillez rafraîchir la page !");
}
} // /select on product data


function resetOrderForm() {
    // reset the input field
    $("#reset").click();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error 
    $(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// Payment ORDER
function paymentOrder(orderId = null) {
    if (orderId) {

        $.ajax({
            url: 'php_action/fetchPayData.php',
            type: 'post',
            data: {orderId: orderId},
            dataType: 'json',
            success: function (response) {

                // due 
                $("#total").val(response.order[5]);
                $("#due").val(response.order[7]);
                $("#payAmount").val(response.order[7]);

                // update payment
                $("#updatePaymentOrderBtn").unbind('click').bind('click', function () {
                    var payAmount = $("#payAmount").val();
                    var paymentDate = $("#payDate").val();

                    if (payAmount == "") {
                        $("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
                        $("#payAmount").closest('.form-group').addClass('has-error');
                    } else {
                        $("#payAmount").closest('.form-group').addClass('has-success');
                    }

                    if (paymentDate == "") {
                        $("#payDate").after('<p class="text-danger">The Pay Date field is required</p>');
                        $("#payDate").closest('.form-group').addClass('has-error');
                    } else {
                        $("#payDate").closest('.form-group').addClass('has-success');
                    }


                    if (payAmount && paymentDate) {
                        $("#updatePaymentOrderBtn").button('loading');
                        $.ajax({
                            url: 'php_action/editPaymentFour.php',
                            type: 'post',
                            data: {
                                orderId: orderId,
                                payAmount: payAmount,
                                paymentDate: paymentDate
                            },
                            dataType: 'json',
                            success: function (response) {
                                $("#updatePaymentOrderBtn").button('loading');

                                // remove error
                                $('.text-danger').remove();
                                $('.form-group').removeClass('has-error').removeClass('has-success');

                                //$("#paymentOrderModal").modal('hide');
                                $("#updatePaymentOrderBtn").button('reset');

                                $("#success-messages").html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                // remove the mesages
                                $(".alert-success").delay(500).show(10, function () {
                                    $(this).remove();
                                    $("#closeFermer").click();
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
