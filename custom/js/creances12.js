var manageCategoriesTable;

$(document).ready(function () {
    // active top navbar categories
    var dt = $("#dr").val(),
            table,
            type = "";

    $("#navRestauration").addClass("active");

    if (dt === 'cr_four') {
        $("#topNavcreances_four").addClass("active");
        table = "four";
    } else if (dt === 'cr_clt') {
        $("#topNavcreances_clt").addClass("active");
        table = "clt";
    }

    manageCategoriesTable = $('#manageOrderTable').DataTable({
        'ajax': 'php_action/fetch' + table + '.php?t=' + type,
        'order': []
    }); // manage categories Data Table

    $("#type").change(function () {
        type = $(this).val();
        $('#manageOrderTable').DataTable({
            'ajax': 'php_action/fetch' + table + '.php?t=' + type,
            'order': []
        }); // manage categories Data Table
    });

}); // /document