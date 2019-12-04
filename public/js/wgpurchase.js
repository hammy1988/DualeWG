var xhr_purchaseadd;
var xhr_purchasepaid;
var xhr_purchasedelete;

var purchaseadd_sent = false;
var purchasepaid_sent = false;

var purchasedelete_sent = false;
var purchaselastdeletelist = -1;

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

    wgPurchaseReloadButtons();


});

function wgPurchaseReloadButtons() {

    $(".purchaseboughtbutton").unbind("click");
    $(".purchaseboughtbutton").click(function(evt) {
        evt.preventDefault();

        if (purchasepaid_sent == false) {
            let purchaseid = $(this).attr("data-purchaseid");
            wgPurchaseBought(purchaseid);
        }
    });

    $(".purchasedeletebutton").unbind("click");
    $(".purchasedeletebutton").click(function(evt) {
        evt.preventDefault();

        if (purchasedelete_sent == false) {
            let purchaseid = $(this).attr("data-purchaseid");
            if ($(this).attr("data-purchaselist") == "notpaid") {
                purchaselastdeletelist = 0;
            } else if ($(this).attr("data-purchaselist") == "paid") {
                purchaselastdeletelist = 1;
            }
            wgPurchaseDelete(purchaseid);
        }
    });
}

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
                $("<a>", { href:"#",class:"purchasedeletebutton", "data-purchaseid": responseData.id, "data-purchaselist": "notpaid" }).append(
                    $("<span>",{class:"fad fa-trash-alt"})
                )
            )
        );

        $(".wgpurchaseitemlist.wgtable").append(responseText);


        wgPurchaseReloadButtons();


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

        var responseText = $("<div>", { class: "wgtr", id: ("purchaserowpaid_" + responseData.id) }).append(
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
                $("<a>", { href:"#",class:"purchasedeletebutton", "data-purchaseid": responseData.id, "data-purchaselist": "paid" }).append(
                    $("<span>",{class:"fad fa-trash-alt"})
                )
            )
        );

        $(".wgboughtitemlist.wgtable .wgtitle").after(responseText);

        wgPurchaseReloadButtons();

    } else if (status == "error") {

        // Fehlerbehandlung


    }


    purchasedelete_sent = false;

}

function wgPurchaseDelete(purchaseid) {

    apiCall_DESTROY("purchase", purchaseid, wgPurchaseDeleteCallback, xhr_purchasedelete);

}

function wgPurchaseDeleteCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    console.log("callsback: " + purchaselastdeletelist);

    if (status == "success") {

        console.log(responseData);
        if (purchaselastdeletelist == 0) {
            $("#purchaserownotpaid_" + responseData.id).remove();
        } else if (purchaselastdeletelist == 1) {
            $("#purchaserowpaid_" + responseData.id).remove();
        }

    } else if (status == "error") {

        // Fehlerbehandlung


    }

    purchasedelete_sent = false;

}




