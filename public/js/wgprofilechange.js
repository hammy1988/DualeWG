
$(document).ready(function() {

    $("#givennamechange").click(function () {
        $("#profilgivenname_show").hide();
        $("#profilgivenname_input").show();
        console.log("Wir haben geklickt!");
    });

    $("#namechange").click(function () {
        $("#profilname_show").hide();
        $("#profilname_input").show();
        console.log("Wir haben geklickt!");
    });

    $("#emailchange").click(function () {
        $("#email_show").hide();
        $("#email_input").show();
        console.log("Wir haben geklickt!");
    });

});
