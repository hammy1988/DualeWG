var xhr_appointmentcalendarload;
var xhr_appointmentlistload;
var xhr_appointmentdelete;
var xhr_appointmentedit;

var xhr_appointmentsave;
appointmentsave_sent = false;

appointmentdelete_sent = false;
appointmentedit_sent = false;


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

    var ModulAppointmentCalendarDateNow = new Date();
    var ModulAppointmentCalendarDateNowMonth = ModulAppointmentCalendarDateNow.getMonth() + 1;
    var ModulAppointmentCalendarDateNowYear = ModulAppointmentCalendarDateNow.getYear() + 1900;
    $("#calendarShow").hide();
    $("#calendarLoad").show();
    $("#showCalHere").append(AppointmentCreateCalendar(ModulAppointmentCalendarDateNowMonth, ModulAppointmentCalendarDateNowYear));
    $("#calendarLoad").hide();
    $("#calendarShow").show();

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
                let apprecurringtext = "(täglich)";
                if (responseData[i].recurring == 1) {
                    apprecurringtext = "(wöchentlich)";
                }
                if (responseData[i].recurring == 2) {
                    apprecurringtext = "(monatlich)";
                }
                if (responseData[i].recurring == 3) {
                    apprecurringtext = "(jährlich)";
                }
                appointmentTitle.append(
                    $("<span>", { class: "wgappointmentRecurring" }).append(
                        $("<span>", { class: "fa fa-sync" })
                    ).append(
                        $("<span>", { class: "wgappointmentrectext" }).text(
                            apprecurringtext
                        )
                    )
                );
            }

            appointmentTitle.append(
                $("<div>", { class: "wgappointmenteditbuttons" }).append(
                    $("<a>", { class: "wgappointmenteditbutton", "data-appointmentid": responseData[i].id, href: "#" }).append(
                        $("<span>", { class: "fa fa-pencil" })
                    )
                ).append(
                    $("<a>", { class: "wgappointmentdeletebutton", "data-appointmentid": responseData[i].id, href: "#" }).append(
                        $("<span>", { class: "fa fa-trash" })
                    )
                )
            );

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

        setButtonFunctions();

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


function setButtonFunctions() {


    $(".wgappointmenteditbutton").unbind("click");
    $(".wgappointmenteditbutton").click(function(evt) {
        evt.preventDefault();

        if (appointmentedit_sent == false) {
            let appointmentid = $(this).attr("data-appointmentid");
            wgAppointmentEdit(appointmentid);
        }
    });
    $(".wgappointmentdeletebutton").unbind("click");
    $(".wgappointmentdeletebutton").click(function(evt) {
        evt.preventDefault();

        if (appointmentdelete_sent == false) {
            let appointmentid = $(this).attr("data-appointmentid");
            wgAppointmentDelete(appointmentid);
        }
    });


}


function wgAppointmentEdit(appointmentid) {
alert("edit " + appointmentid);
}



function wgAppointmentDelete(appointmentid) {

    appointmentdelete_sent = true;

    apiCall_DESTROY("appointment", appointmentid, wgAppointmentDeleteCallback, xhr_appointmentdelete);

}


function wgAppointmentDeleteCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        loadSiteContent();


    } else if (status == "error") {


    }


    appointmentdelete_sent = false;

}



























/* ########### */


function AppointmentCreateCalendar(showMonth, showYear) {

    var monthNames = new Array("Januar", "Februar", "März", "April", "Mai", "Juni",
        "Juli", "August", "September", "Oktober", "November", "Dezember");
    var weekdayNames = new Array("Mo", "Di", "Mi", "Do", "Fr", "Sa", "So");

    // aktuelles Datum für die spätere Hervorhebung ermitteln
    var datetimeNow = new Date();
    var thisMonth = datetimeNow.getMonth() + 1;
    var thisYear = datetimeNow.getYear() + 1900;
    var thisDay = datetimeNow.getDate();
    var thisDate = new Date(thisYear + "-" + thisMonth + "-" + thisDay);

    // ermittle Wochentag des ersten Tags im Monat halte diese Information in Start fest
    var startCol = new Date(showYear, showMonth - 1, 1).getDay();

    if (startCol > 0) {
        startCol--;
    } else {
        startCol = 6;
    }

    // die meisten Monate haben 31 Tage...
    var stopDayCounter = 31;

    // ...April (4), Juni (6), September (9) und November (11) haben nur 30 Tage...
    if (showMonth == 4 || showMonth == 6 || showMonth == 9 || showMonth == 11)--stopDayCounter;

    // ...und der Februar nur 28 Tage...
    if (showMonth == 2) {
        stopDayCounter = stopDayCounter - 3;
        // ...außer in Schaltjahren
        if (showYear % 4 == 0) stopDayCounter++;
        if (showYear % 100 == 0) stopDayCounter--;
        if (showYear % 400 == 0) stopDayCounter++;
    }

    var CalendarHTMLTable = $("<div>", { class: "AppointCalenderTable" })

    // schreibe Tabellenüberschrift
    var Monthhead = monthNames[showMonth - 1] + " " + showYear;
    var CalendarHTMLTableHeader = $("<div>", { class: "AppointCalenderTableHeader" }).append(
        $("<div>", { class: "AppointCalenderTableHeaderLeftWrapper" }).append(
            $("<a>", { class: "AppointCalenderTableHeaderLeft", id: "AppointCalendarGoLeft" , href: "#" }).append(
                $("<span>", { class: "fa fa-arrow-circle-o-left" })
            )
        )
    ).append(
        $("<div>", { class: "AppointCalenderTableHeaderCaption" }).text(Monthhead)
    ).append(
        $("<div>", { class: "AppointCalenderTableHeaderRightWrapper" }).append(
            $("<a>", { class: "AppointCalenderTableHeaderRight", id: "AppointCalendarGoRight", href: "#" }).append(
                $("<span>", { class: "fa fa-arrow-circle-o-right" })
            )
        )
    );



    // schreibe Tabellenkopf
    var CalendarHTMLRowCaption = $("<div>", { class: "AppointCalenderRow AppointCalenderRowCaption" });
    for (var i = 0; i <= 6; i++) {
        var CalendarHTMLCell = $("<div>", { class: "AppointCalenderCell" }).append(
            $("<span>").text(weekdayNames[i])
        );
        CalendarHTMLRowCaption.append(CalendarHTMLCell);
    }
    CalendarHTMLTable.append(CalendarHTMLRowCaption);

    // ermittle Tag und schreibe Zeile
    var showDay = 1;
    var eventObjCounter = 0;

    for (var i = 0; i <= 5; i++) {

        var CalendarHTMLRow = $("<div>", { class: "AppointCalenderRow" })


        for (var j = 0; j <= 6; j++) {

            var CalendarHTMLCell;

            var showDate = new Date(showYear + "-" + showMonth + "-" + showDay);

            // Zellen vor dem Start-Tag in der ersten Zeile und Zeilen nach dem Stop-Tag werden leer aufgefüllt
            if (((i == 0) && (j <= 5) && (j < startCol)) || (showDay > stopDayCounter)) {

                CalendarHTMLCell = $("<div>", { class: "AppointCalenderCell" }).append(
                    $("<span>").html("&nbsp;")
                );

            } else {
                // normale Zellen werden mit der Tageszahl befüllt und mit der Klasse Kalendertag markiert

                var calendarClassName = 'AppointCalenderCell AppointCalenderCellDay'

                // und der aktuelle Tag (heute) wird noch einmal speziell mit der Klasse "heute" markiert
                if ((showYear == thisYear) && (showMonth == thisMonth) && (showDay == thisDay)) {
                    calendarClassName = calendarClassName + ' AppointCalenderCellToday';
                }


                CalendarHTMLCell = $("<div>", { class: calendarClassName }).append(
                    $("<span>").text(showDay)
                );

                showDay++;
            }
            CalendarHTMLRow.append(CalendarHTMLCell);

        }
        CalendarHTMLTable.append(CalendarHTMLRow);

    }

    return CalendarHTMLTableHeader.add(CalendarHTMLTable);
}

