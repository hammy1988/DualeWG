var xhr_appointmentcalendarload;
var xhr_appointmentlistload;




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
