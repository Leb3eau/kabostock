$(function () {
    $("#depensesId").hide();
    
    function dep(){
        if($("#dateDebut").val().trim()=="" || $("#dateFin").val().trim()==""){
            $("#depensesId").hide();
        }else {
            $("#depensesId").show(500);
        }
    }
    
   $("#dateDebut").change(function (){
        dep();
   });
   $("#dateFin").change(function (){
        dep();
   });
});


