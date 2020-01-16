var xhr_purchaseadd;
var xhr_purchasepaid;
var xhr_purchasedelete;
var xhr_purchasebuyagain;

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

    $(".purchasebuyagainbutton").unbind("click");
    $(".purchasebuyagainbutton").click(function(evt) {
        evt.preventDefault();
        $("#newproductbutton").hide();
        $("#wgaddpurchase").addClass("wgpurchaseaddshow");


        apiCall_SHOW("purchase", $(this).attr("data-purchaseid"), wgBuyAgainCallback, xhr_purchasebuyagain)

        $("html, body").animate({
            scrollTop: 0
        }, 500);
    });

}

function wgBuyAgainCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        $("#purchaseaddname_input").val(responseData.name);
        $("#purchaseaddcount_input").val(responseData.count);


    } else if (status == "error") {


        // Fehlerbehandlung

    }


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

        $("#purchaseaddname_input").val("");
        $("#purchaseaddcount_input").val("");

        $("#nameerrorfield").hide();
        $("#counterrorfield").hide();

        var responseText = $("<div>", { class: "wgtr", id: ("purchaserownotpaid_" + responseData.id) }).append(
            $("<div>", { class: "wgtd boughtproductname"}).append(
                responseData.name
            )
        ).append(
            $("<div>", { class: "wgtd boughtproductcount", style:"text-align:center"}).append(
                responseData.count
            )
        ).append(
            $("<div>", { class: "wgtd", style:"text-align:center"}).append(
                wgDateTimeFormat(responseData.created_at)
            )
        ).append(
            $("<div>", { class: "wgtd", style:"text-align:right"}).append(
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


        $("#nameerrorfield").hide();
        $("#counterrorfield").hide();

        // Fehlerbehandlung
        if (responseData.status == 422) {
            let errorJSON = responseData.responseJSON.errors;

            let errorText = "Fehler:\n"
            for (var err in errorJSON) {
                errorText += "  - " + err + ": " + errorJSON[err] + "\n";
            }
            console.error(errorText)

            for (var err in errorJSON) {

                var errTextShow = "";

                for (let i = 0; i < errorJSON[err].length; i++) {
                    errTextShow += errorJSON[err][i];
                    if (i < (errorJSON[err].length - 1)) {
                        errTextShow += "<br />";
                    }
                }

                if (err == 'name') {
                    $("#nameerrorfield").html(errTextShow);
                    $("#nameerrorfield").show();
                } else if (err == 'count') {
                    $("#counterrorfield").html(errTextShow);
                    $("#counterrorfield").show();
                }  else {
                    console.error("Fehler: " + responseData.status + " - " + responseData.statusText);
                }
            }
        }

    }


    purchaseadd_sent = false;

}

function wgPurchaseBought(purchaseid) {

    let jsonData = {
        action: "paidPurchase",
    }

    apiCall_UPDATE("purchase", purchaseid, jsonData, wgPurchaseBoughtCallback, xhr_purchasepaid);

}

var responseDataBeforeGetID;
function wgPurchaseBoughtCallback(data) {

    let responseData = data.responseData;
    let status = data.status;


    if (status == "success") {

        responseDataBeforeGetID = responseData;

        apiCall_SHOW("user", responseDataBeforeGetID.user_id,wgPurchaseBoughtCallbackUser, xhr_purchasepaid)


    } else if (status == "error") {

        // Fehlerbehandlung


    }


}

function wgPurchaseBoughtCallbackUser(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {


        $("#purchaserownotpaid_" + responseDataBeforeGetID.id).remove();



        var responseText = $("<div>", { class: "wgtr", id: ("purchaserowpaid_" + responseDataBeforeGetID.id) }).append(
            $("<div>", { class: "wgtd"}).append(
                responseDataBeforeGetID.name
            )
        ).append(
            $("<div>", { class: "wgtd", style:"text-align:center"} ).append(
                responseDataBeforeGetID.count
            )
        ).append(
            $("<div>", { class: "wgtd"}).append(
                responseData.username
            )
        ).append(
            $("<div>", { class: "wgtd", style:"text-align:center"}).append(
                wgDateTimeFormat(responseDataBeforeGetID.paid_at.date)
            )
        ).append(
            $("<div>", { class: "wgtd", style:"text-align:right"}).append(
                $("<a>", { href:"#",class:"purchasebuyagainbutton", "data-purchaseid": responseDataBeforeGetID.id, "data-purchaselist": "paid" }).append(
                    $("<span>",{class:"fad fa-sync"})
                )
            ).append(
                $("<a>", { href:"#",class:"purchasedeletebutton", "data-purchaseid": responseDataBeforeGetID.id}).append(
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

    console.log("callback: " + purchaselastdeletelist);

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




