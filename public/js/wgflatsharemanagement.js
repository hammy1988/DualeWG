var xhr_requestanswer;
var xhr_removemember;
var xhr_leaveflatshare;


var removemember_sent = false;
var lastremovememberid = 0;

var requestanswer_sent = false;
var lastuseridrequest = 0;

$(document).ready(function() {

    $(".wguserleave").click(function(evt) {
        evt.preventDefault();
        wgRemoveMember("leaveFlatshare", $(this).attr("data-userid"));
    });

    $(".wguserremove").click(function(evt) {
        evt.preventDefault();
        wgRemoveMember("removeFlatshareUser", $(this).attr("data-userid"));
    });

    $(".wgrequestaccept").click(function(evt) {
        evt.preventDefault();
        wgRequest("acceptFlatshare", $(this).attr("data-userid"));
    });

    $(".wgrequestdenied").click(function(evt) {
        evt.preventDefault();
        wgRequest("deniedFlatshare", $(this).attr("data-userid"));
    });


});

function wgRemoveMember(actionStr, userid) {

    if (!(removemember_sent)) {

        removemember_sent = true;
        lastremovememberid = userid

        $("#wgremovefail_" + lastremovememberid).hide();

        $(".wguserremove").addClass("wgremovedisable");
        $(".wguserleave").addClass("wgleavedisable");

        let jsonData = {
            action: actionStr
        };
        apiCall_UPDATE("user", userid, jsonData, wgremoveMemberCallback, xhr_removemember)
    }

}

function wgremoveMemberCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        console.log(responseData);

        if (responseData.flatsharejoin_at == null) {
            var responseText = $("<span>", { class: "wgresponsedenied" }).append(
                $("<span>", { class: "fad fa-heart-broken"})
            ).append(
                $("<span>").text(
                    "Der Benutzer wurde aus der WG entfernt"
                )
            );


            $(".wgFlatshareRequestList #wgUserCard_" + lastremovememberid).remove();

            $(".wgFlatshareMemberList #wgUserCard_" + lastremovememberid + " .wgUserInfos").remove();
            $(".wgFlatshareMemberList #wgUserCard_" + lastremovememberid + " .wgUserActions").html(responseText);
        }

    } else if (status == "error") {

        // Fehlerbehandlung
        $("#wgremovefail_" + lastremovememberid).show();

    }


    removemember_sent = false;
    lastremovememberid = 0;
    $(".wguserremove").removeClass("wgremovedisable");
    $(".wguserleave").removeClass("wgleavedisable");
}



function wgRequest(actionStr, userid) {

    if (!(requestanswer_sent)) {

        requestanswer_sent = true;
        lastuseridrequest = userid

        $("#wgrequestfail_" + lastuseridrequest).hide();

        $(".wgrequestaccept").addClass("wgrequestdisable");
        $(".wgrequestdenied").addClass("wgrequestdisable");

        let jsonData = {
            action: actionStr
        };
        apiCall_UPDATE("user", userid, jsonData, wgrequestCallback, xhr_requestanswer)
    }

}

function wgrequestCallback(data) {

    let responseData = data.responseData;
    let status = data.status;



    if (status == "success") {

        var responseText;
        if (responseData.flatsharejoin_at == null) {
            responseText = $("<span>", { class: "wgresponsedenied" }).append(
                $("<span>", { class: "fad fa-heart-broken"})
            ).append(
                $("<span>").text(
                "Die Anfrage wurde abgelehnt"
                )
            );
        } else {
            var newcard = $("<li>", { id: ("wgUserCard_" + responseData.id),class: "wgUserCard" }).append(
                $("<div>", { class: "wgUserTitle" }).append(
                    $("<span>", { class: "wgUserGivenname" }).text(
                        responseData.givenname
                    )
                ).append("\n").append(
                    $("<span>", { class: "wgUserName" }).text(
                        responseData.name
                    )
                ).append("\n").append(
                    $("<span>", { class: "wgUserUsername" }).text(
                        "(" + responseData.username + ")"
                    )
                )
            ).append(
                $("<div>", { class: "wgUserInfos" }).append(
                    $("<span>").text(
                        "In der WG seit: "
                    )
                ).append(
                    $("<span>").text(
                        wgDateTimeFormat(responseData.flatsharejoin_at.date)
                    )
                )
            ).append(
                $("<div>", { class: "wgUserActions" }).append(
                    $("<a>", { href: "#", class: "wguserremove", "data-userid": ("" + responseData.id) }).append(
                        $("<span>", { class: "fad fa-user-times" })
                    ).append(
                        " entfernen"
                    )
                )
            );

            responseText = $("<span>", { class: "wgresponseacceped" }).append(
                $("<span>", { class: "fad fa-heart"})
            ).append(
                $("<span>").text(
                "Die Anfrage wurde bestätigt"
                )
            );

            $(".wgFlatshareMemberList").append(newcard);

            $(".wguserremove").unbind( "click" );
            $(".wguserremove").click(function(evt) {
                evt.preventDefault();
                wgRemoveMember("removeFlatshareUser", $(this).attr("data-userid"));
            });

        }

        $(".wgFlatshareRequestList #wgUserCard_" + lastuseridrequest + " .wgUserActions").html(responseText);

    } else if (status == "error") {

        // Fehlerbehandlung
        $("#wgrequestfail_" + lastuseridrequest).show();

    }


    requestanswer_sent = false;
    lastuseridrequest = 0;
    $(".wgrequestaccept").removeClass("wgrequestdisable");
    $(".wgrequestdenied").removeClass("wgrequestdisable");
}
