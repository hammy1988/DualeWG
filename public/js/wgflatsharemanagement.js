var xhr_requestanswer;
var xhr_removemember;
var xhr_leaveflatshare;
var xhr_changeadmin;
var xhr_crownclick;


var leavemember_sent = false;
var lastleavememberid = 0;

var removemember_sent = false;
var lastremovememberid = 0;

var requestanswer_sent = false;
var lastuseridrequest = 0;

var changeadmin_sent = false;
var lastuseridchangeadmin = 0;

var crownclick_sent = false;

$(document).ready(function() {

    $(".wguserleave").click(function(evt) {
        evt.preventDefault();
        wgLeave("leaveFlatshare", $(this).attr("data-userid"));
    });

    $(".wguserremove").click(function(evt) {
        evt.preventDefault();
        wgRemoveMember("removeFlatshareUser", $(this).attr("data-userid"));
    });
    $(".wgadminchange").click(function(evt) {
        evt.preventDefault();
        wgChangeAdmin("changeFlatshareAdmin", $(this).attr("data-userid"));
    });

    $(".wgrequestaccept").click(function(evt) {
        evt.preventDefault();
        wgRequest("acceptFlatshare", $(this).attr("data-userid"));
    });

    $(".wgrequestdenied").click(function(evt) {
        evt.preventDefault();
        wgRequest("deniedFlatshare", $(this).attr("data-userid"));
    });

    $("#wgCrown").click(function() {
        wgCrownClick("crownClick");
    });


});

function wgLeave(actionStr, userid) {

    if (!(removemember_sent) && !(leavemember_sent) && !(changeadmin_sent)) {

        leavemember_sent = true;
        lastleavememberid = userid;

        $("#wgremovefail_" + lastleavememberid).hide();

        $(".wguserremove").addClass("wgremovedisable");
        $(".wguserleave").addClass("wgleavedisable");
        $(".wgadminchange").addClass("wgchangeadmindisable");

        let jsonData = {
            action: actionStr
        };
        apiCall_UPDATE("user", userid, jsonData, wgleaveCallback, xhr_leaveflatshare)
    }

}

function wgleaveCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        if (responseData.flatsharejoin_at == null) {
            $("#wgFlatshareManagement").remove();
            $("#wgFlatshareLeaveSuccess").show();
        }

    } else if (status == "error") {

        // Fehlerbehandlung
        $("#wgremovefail_" + lastremovememberid).show();

        leavemember_sent = false;
        lastremovememberid = 0;

        $(".wguserremove").removeClass("wgremovedisable");
        $(".wguserleave").removeClass("wgleavedisable");
        $(".wgadminchange").removeClass("wgchangeadmindisable");
    }


}

function wgRemoveMember(actionStr, userid) {

    if (!(removemember_sent) && !(leavemember_sent) && !(changeadmin_sent)) {

        removemember_sent = true;
        lastremovememberid = userid;

        $("#wgremovefail_" + lastremovememberid).hide();

        $(".wguserremove").addClass("wgremovedisable");
        $(".wguserleave").addClass("wgleavedisable");
        $(".wgadminchange").addClass("wgchangeadmindisable");

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
    $(".wgadminchange").removeClass("wgchangeadmindisable");
}


function wgChangeAdmin(actionStr, userid) {

    if (!(removemember_sent) && !(leavemember_sent) && !(changeadmin_sent)) {

        changeadmin_sent = true;
        lastuseridchangeadmin = userid;

        $("#wgremovefail_" + lastuseridchangeadmin).hide();

        $(".wguserremove").addClass("wgremovedisable");
        $(".wguserleave").addClass("wgleavedisable");
        $(".wgadminchange").addClass("wgchangeadmindisable");

        let jsonData = {
            action: actionStr
        };
        apiCall_UPDATE("user", userid, jsonData, wgchangeAdminCallback, xhr_changeadmin)
    }

}

function wgchangeAdminCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        console.log(responseData);

            var responseText = $("<span>", { class: "wgresponsechangeadmin" }).append(
                $("<span>", { class: "fad fa-user-crown"})
            ).append(
                $("<span>").text(
                    "Der Benutzer wurde erfolgreich gekrönt"
                )
            );

            $(".wgFlatshareMemberList .wgUserActions:not(.wgFlatshareMemberList #wgUserCard_" + lastuseridchangeadmin + " .wgUserActions):not(.wgFlatshareMemberList #wgUserCard_" + $("#wgAuthUserId").val() + " .wgUserActions)").remove();
            $(".wgUserCrown").remove();
            $(".wgFlatshareRequestList .wgUserActions").remove();
            $(".wgFlatshareMemberList #wgUserCard_" + lastuseridchangeadmin + " .wgUserActions").html(responseText);


    } else if (status == "error") {

        // Fehlerbehandlung
        $("#wgremovefail_" + lastuseridchangeadmin).show();

    }


    changeadmin_sent = false;
    lastuseridchangeadmin = 0;
    $(".wguserremove").removeClass("wgremovedisable");
    $(".wguserleave").removeClass("wgleavedisable");
    $(".wgadminchange").removeClass("wgchangeadmindisable");
}



function wgRequest(actionStr, userid) {

    if (!(requestanswer_sent)) {

        requestanswer_sent = true;
        lastuseridrequest = userid;

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
                    $("<a>", { href: "#", class: "wgadminchange", "data-userid": ("" + responseData.id) }).append(
                        $("<span>", { class: "fad fa-users-crown" })
                    ).append(
                        " krönen"
                    )
                ).append(
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

            $(".wgadminchange").unbind( "click" );
            $(".wgadminchange").click(function(evt) {
                evt.preventDefault();
                wgChangeAdmin("changeFlatshareAdmin", $(this).attr("data-userid"));
            });
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


function wgCrownClick(actionStr) {

    if (!(crownclick_sent)) {

        crownclick_sent = true;

        let jsonData = {
            action: actionStr
        };
        apiCall_UPDATE("user", $("#wgAuthUserId").val(), jsonData, wgcrownCallback, xhr_crownclick)
    }

}


function wgcrownCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    console.log(responseData);
    console.log(status);

    if (status == "success") {

    } else if (status == "error") {

        // Fehlerbehandlung

    }


    crownclick_sent = false;
}
