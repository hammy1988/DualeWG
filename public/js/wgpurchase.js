$(document).ready(function() {

    $("#newproductbutton").click(function(evt) {
        evt.preventDefault();
        $("#newproductbutton").hide();
        $("#wgaddpurchase").addClass("wgpurchaseaddshow");
    });

});
$(document).ready(function() {
    $("#purchasecancelbutton").click(function(evt) {
        evt.preventDefault();
        $("#newproductbutton").show();
        $("#wgaddpurchase").removeClass("wgpurchaseaddshow");
    });
});
