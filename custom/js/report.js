$(document).ready(function () {
    $("#navBil").addClass("active");
    $("#topNavbil").addClass("active");
    
    $("#getOrderReportForm").unbind('submit').bind('submit', function () {

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
                    mywindow.document.write('<html><head><title>LISTE VENTES</title>');
                    mywindow.document.write('<link href="assests/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

//                    mywindow.print();
//                    mywindow.close();
                } // /success
            });	// /ajax

        } // /else

        return false;
    });


    $("#getOrderBilanForm").unbind('submit').bind('submit', function (e) {
        e.preventDefault();
        var startDate = $("#dateDebut").val();
        var endDate = $("#dateFin").val();

        if (startDate == "" || endDate == "") {
            if (startDate == "") {
                $("#startDate").closest('.form-group').addClass('has-error');
                $("#startDate").after('<p class="text-danger">The Start Date is required</p>');
            } else {
                $(".form-group").removeClass('has-error');
                $(".text-danger").remove();
            }

            if (endDate == "") {
                $("#endDate").closest('.form-group').addClass('has-error');
                $("#endDate").after('<p class="text-danger">The End Date is required</p>');
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
                    mywindow.document.write('<html><head><title>BILAN DES VENTES</title>');
                    mywindow.document.write('<link href="assests/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

//                    mywindow.print();
//                    mywindow.close();
                } // /success
            });	// /ajax

        } // /else

        return false;
    });

});