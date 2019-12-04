var xhr_purchaseadd;

var purchaseadd_sent = false;

$(document).ready(function() {

    $("#newproductbutton").click(function(evt) {
        evt.preventDefault();
        $("#newproductbutton").hide();
        $("#wgaddpurchase").addClass("wgpurchaseaddshow");
    });


    $("#purchasecancelbutton").click(function(evt) {
        evt.preventDefault();
        $("#newproductbutton").show();
        $("#wgaddpurchase").removeClass("wgpurchaseaddshow");
    });



    $("#purchaseaddbutton").click(function(evt) {
        evt.preventDefault();

        if (purchaseadd_sent == false) {
            wgPurchaseAdd();
        }
    });

});

function wgPurchaseAdd() {

    purchaseadd_sent = true;

    let name = $("#purchaseaddname_input").val();
    let count = $("#purchaseaddcount_input").val();

    let jsonData = {
        name: name,
        count: count,
    }

    apiCall_STORE("purchase", jsonData, wgPurchaseAddCallback, xhr_purchaseadd);


}
function wgPurchaseAddCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        console.log(responseData);

        var responseText = $("<div>", { class: "wgtr wgtitle" }).append(
            $("<div>", { class: "wgtd"}).append(
                responseData.name
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                responseData.count
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                wgDateTimeFormat(responseData.created_at)
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                $("<a>", { href:"#",class:"purchaseboughtbutton", "data-purchaseid": responseData.id }).append(
                    $("<span>",{class:"fad fa-cart-arrow-down"})
                )
            ).append(
                $("<a>", { href:"#",class:"purchasedeletebutton", "data-purchaseid": responseData.id }).append(
                    $("<span>",{class:"fad fa-times-circle"})
                )
            )
        );

        $(".wgpurchaseitemlist.wgtable").append(responseText);


    } else if (status == "error") {

        // Fehlerbehandlung


    }


    purchaseadd_sent = false;

}




