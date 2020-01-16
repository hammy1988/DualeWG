var xhr_appointmentcalendarload;
var xhr_appointmentlistload;

var xhr_appointmentsave;
appointmentsave_sent = false;


$(document).ready(function() {

    loadSiteContent();

    $(".wgappointmentAddButton span.fa").click(function(evt) {
        evt.preventDefault();
        showAppointmentOverlay();
    });

    $(".wgappointmentCloseButton span.fa").click(function (evt) {
        evt.preventDefault();
        hideAppointmentOverlay();
    });
    $("#appointmenteditbuttonabort").click(function (evt) {
        evt.preventDefault();
        hideAppointmentOverlay();
    });

    $("#appointmentfullday_input").click(function() {
        if ($(this).prop("checked")) {
            $(".wgfulldayrows").hide();
        } else {
            $(".wgfulldayrows").css("display", "flex");
        }
    });
    $("#appointmentrecurringchk_input").click(function() {
        if ($(this).prop("checked")) {
            $(".wgrecuuringrows").css("display", "flex");
        } else {
            $(".wgrecuuringrows").hide();
        }
    });

    $("#appointmentditbuttonsave").click(function(evt) {
        evt.preventDefault();

        if (appointmentsave_sent == false) {
            wgAppointmentSave();
        }
    });

});

function showAppointmentOverlay() {
    $("body").addClass("wgShowOverlay");
    $("#appointmentOverlayAdd").addClass("wgShowOverlayWrapper");
}
function hideAppointmentOverlay() {
    $("body").removeClass("wgShowOverlay");
    $("#appointmentOverlayAdd").removeClass("wgShowOverlayWrapper");
}

function loadSiteContent() {

    $("#appointmentListShow").hide();
    $("#appointmentListLoad").show();
    apiCall_INDEX("appointment", wgAppointmentlistLoadCallback, xhr_appointmentlistload);

}

function wgAppointmentlistLoadCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        var appointmentList = $("<div>", { id: "wgappointmentlistContainer", class: "wgappointmentlistWrapper" });


        Object.keys(responseData).sort(function( a,b ) {
            return responseData[a].start_at.localeCompare( responseData[b].start_at );
        }).forEach(function( i ) {

            let appointmentTitle = $("<div>", { class: "wgappointmentTitleWrapper" }).append(
                $("<span>", { class: "wgappointmentTitle" }).text(
                    responseData[i].title
                )
            );

            if (responseData[i].recurring > -1) {
                appointmentTitle.append(
                    $("<span>", { class: "wgappointmentRecurring" }).append(
                        $("<span>", { class: "fa fa-sync" })
                    )
                )
            }

            let appointmentFooterText = moment.utc(responseData[i].start_at).local().format("L") + " ";

            if (responseData[i].fullday == true) {
                appointmentFooterText += "(ganztägig)";
            } else {
                appointmentFooterText += "(" + moment.utc(responseData[i].start_at).local().format("LT") +  " bis "  + moment.utc(responseData[i].end_at).local().format("LT") + ")";
            }

            let appointmentFooter = $("<div>", { class: "wgappointmentFooterWrapper" }).append(
                $("<span>", { class: "wgappointmentFooter" }).text(
                    appointmentFooterText
                )
            );


            appointmentList.append(
                $("<div>", { class: "wgappointmentObject" }).append(
                    appointmentTitle
                ).append(
                    $("<div>", { class: "wgappointmentDescriptionWrapper" }).append(
                        $("<span>", { class: "wgappointmentDescription" }).text(
                            responseData[i].description.replace("\n", "<br />")
                        )
                    )
                ).append(
                    appointmentFooter
                )
            );
        });
        $("#appointmentListShow").html(appointmentList);
        $("#appointmentListLoad").hide();
        $("#appointmentListShow").show();

    } else if (status == "error") {

        // Fehlerbehandlung


    }



}


function wgAppointmentSave() {
    appointmentsave_sent = true;

    let appotitle = $("#appointmenttitle_input").val();
    let appodesc = $("#appointmentdesc_input").val();
    let appodate = $("#appointmentdate_input").val();
    let appostartat = "00:00";
    let appoendat = "00:00";
    let appofullday = 1;
    let apporecurring = -1;

    if ($("#appointmentfullday_input").prop("checked")) {
        appofullday = 1;
    } else {
        appofullday = 0;
        appostartat = $("#appointmentstartat_input").val();
        appoendat = $("#appointmentendat_input").val();
    }
    if ($("#appointmentrecurringchk_input").prop("checked")) {
        apporecurring = parseInt($("#appointmentrecurring_input option:selected").val());
    }

    let jsonData = {
        title: appotitle,
        desc: appodesc,
        start_at: appodate + " " + appostartat,
        end_at: appodate + " " + appoendat,
        fullday: appofullday,
        recurring: apporecurring,
    }

    apiCall_STORE("appointment", jsonData, wgAppointmentSaveCallback, xhr_appointmentsave);

}


function wgAppointmentSaveCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        $("#appointmenttitle_input").val("");
        $("#appointmentdesc_input").val("");
        $("#appointmentdate_input").val("");
        $("#appointmentstartat_input").val("");
        $("#appointmentendat_input").val("");
        $("#appointmentfullday_input").prop("checked", true);
        $(".wgfulldayrows").hide();
        $("#appointmentrecurringchk_input").prop("checked", false);
        $(".wgrecuuringrows").hide();

        hideAppointmentOverlay();

        loadSiteContent();

    } else if (status == "error") {
        // Fehlerbehandlung
    }


    appointmentsave_sent = false;

}
