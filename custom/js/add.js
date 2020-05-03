var manageBrandTable;

$(document).ready(function () {

    // submit brand form function
    $("#submitBrandForm").unbind('submit').bind('submit', function () {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        var user = $("#cretaeusername").val();
        var role = $("#role").val();
        var pass = $("#motpass").val();
        var cpass = $("#cpass").val();
        var txt_mail = $("#txtmail").val();

        if (role == "") {
            $("#role").after('<p class="text-danger">Ce champ est requis !</p>');
            $('#role').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#role").find('.text-danger').remove();
            // success out for form 
            $("#role").closest('.form-group').addClass('has-success');
        }
        if (user == "") {
            $("#cretaeusername").after('<p class="text-danger">Ce champ est requis !</p>');
            $('#cretaeusername').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#cretaeusername").find('.text-danger').remove();
            // success out for form 
            $("#cretaeusername").closest('.form-group').addClass('has-success');
        }
        if (pass == "") {
            $("#motpass").after('<p class="text-danger">Ce champ est requis !</p>');
            $('#motpass').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#motpass").find('.text-danger').remove();
            // success out for form 
            $("#motpass").closest('.form-group').addClass('has-success');
        }
        if (cpass == "") {
            $("#cpass").after('<p class="text-danger">Ce champ est requis !</p>');
            $('#cpass').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#cpass").find('.text-danger').remove();
            // success out for form 
            $("#cpass").closest('.form-group').addClass('has-success');
        }

        if (txt_mail == "") {
            $("#txtmail").after('<p class="text-danger">Ce champ est requis !</p>');

            $('#txtmail').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#txtmail").find('.text-danger').remove();
            // success out for form 
            $("#txtmail").closest('.form-group').addClass('has-success');
        }

        if (user && pass && cpass && txt_mail && role) {
            if (pass === cpass) {
                var form = $(this);
                // button loading
                $("#createBrandBtn").button('loading');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        // button loading
                        $("#createBrandBtn").button('reset');
                        if (response.success == true) {
                            // reset the form text
                            $("#submitBrandForm")[0].reset();
                            // remove the error text
                            $(".text-danger").remove();
                            // remove the form error
                            $('.form-group').removeClass('has-error').removeClass('has-success');
                            $('#add-brand-messages').html('<div class="alert alert-'+response.color+'">' +
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
            } else {
                $("#cpass").after('<p class="text-danger">Invalide !</p>');
                $('#cpass').closest('.form-group').addClass('has-error');
                $("#motpass").after('<p class="text-danger">Invalide !</p>');
                $('#motpass').closest('.form-group').addClass('has-error');
                $('#add-brand-messages').html('<div class="alert alert-danger">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Les mots de passe ne correspondent pas !</div>');
            }
        }
        return false;
    }); // /submit brand form function

});
