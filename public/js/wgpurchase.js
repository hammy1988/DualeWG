var xhr_purchaseadd;
var xhr_purchasepaid;

var purchaseadd_sent = false;
var purchasepaid_sent = false;

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

    $(".purchaseboughtbutton").click(function(evt) {
        evt.preventDefault();

        if (purchasepaid_sent == false) {
            let purchaseid = $(this).attr("data-purchaseid");
            wgPurchaseBought(purchaseid);
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


        var responseText = $("<div>", { class: "wgtr", id: ("purchaserownotpaid_" + responseData.id) }).append(
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


        $(".purchaseboughtbutton").unbind("click");
        $(".purchaseboughtbutton").click(function(evt) {
            evt.preventDefault();

            if (purchasepaid_sent == false) {
                let purchaseid = $(this).attr("data-purchaseid");
                wgPurchaseBought(purchaseid);
            }
        });


    } else if (status == "error") {

        // Fehlerbehandlung


    }


    purchaseadd_sent = false;

}

function wgPurchaseBought(purchaseid) {

    let jsonData = {
        action: "paidPurchase",
    }

    apiCall_UPDATE("purchase", purchaseid, jsonData, wgPurchaseBoughtCallback, xhr_purchasepaid);

}

function wgPurchaseBoughtCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {


        $("#purchaserownotpaid_" + responseData.id).remove();

        var responseText = $("<div>", { class: "wgtr" }).append(
            $("<div>", { class: "wgtd"}).append(
                responseData.name
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                responseData.count
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                responseData.user_id
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                wgDateTimeFormat(responseData.paid_at.date)
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                $("<a>", { href:"#",class:"purchasedeletebutton", "data-purchaseid": responseData.id }).append(
                    $("<span>",{class:"fad fa-times-circle"})
                )
            )
        );

        $(".wgboughtitemlist.wgtable .wgtitle").after(responseText);

    } else if (status == "error") {

        // Fehlerbehandlung


    }


    purchaseadd_sent = false;

}




