var xhr_flatchoice;
var xhr_writeuser;
var xhr_getflat;

$(document).ready(function() {

    $(".wgWaitWrapper").hide();

    $("#wgsearch").on("input", function(e) {
        $("#wgsearchfail").hide();
        $("#wgsearchselectfail").hide();
        if ($("#wgsearch").val().length == 0) {
            emptyWGSearchInput = true;
            wgsearchCallback({"status": "success", "responseData": [] });
        } else {
            emptyWGSearchInput = false;
            xhr_flatchoice = apiCall_INDEX("flatshare", wgsearchCallback, xhr_flatchoice, "q=" +  encodeURIComponent($("#wgsearch").val()));
        }
    });

    $("#joinInWG").click(function(evt) {
        evt.preventDefault();
        let flatshareid = $('input[name=wgsearchjoinchoice]:checked', '#wgsearchresult').val();

        if (flatshareid === undefined) {
            $("#wgsearchselectfail").show();
        } else {

            $(".wgJoinSearchWrapper").hide();
            $(".wgJoinSuccessWrapper").hide();
            $(".wgWaitWrapper").show();

            let jsonData = {
                action: 'updateFlatshare',
                flatshareid: flatshareid
            };

            apiCall_UPDATE('user', $("#wgJoinUserId").val(), jsonData, wgjoinCallback, xhr_writeuser);

        }
    });

});

function wgsearchCallback(data) {

    let wgsearchoutput;

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        if (responseData.length == 0 || responseData.length === 'undefined') {
            wgsearchoutput = $("<span>", {class: "wgsearchnooutput"}).text("Keine WG gefunden.");
        } else {
            wgsearchoutput = $("<ul>", {class: "wgsearchoutput"});

            for (let i = 0; i < responseData.length; i++) {
                wgsearchoutput.append(
                    $("<li>", {class: "wgsearchrow"}).append(
                        $("<input>", {
                            type: "radio",
                            name: "wgsearchjoinchoice",
                            id: "id_" + responseData[i].name + "_" + responseData[i].tagid,
                            value: responseData[i].id
                        })
                    ).append(
                        $("<label>", {for: "id_" + responseData[i].name + "_" + responseData[i].tagid}).text(responseData[i].name + "#" + responseData[i].tagid)
                    )
                );
            }
        }
    } else if (status == "error") {
        wgsearchoutput = $("<span>", {class: "wgsearchnooutput"}).text("Fehler bei der Abfrage.");
    }

    $("#wgsearchresult").html(wgsearchoutput);
}


function wgjoinCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    if (status == "success") {

        apiCall_SHOW('flatshare', responseData.flatshare_id, wgjoingetflatshareCallback, xhr_getflat);


    } else if (status == "error") {

        $(".wgWaitWrapper").hide();
        $(".wgJoinSuccessWrapper").hide();
        $("#wgsearchfail").show();
        $(".wgJoinSearchWrapper").show();


    }

}


function wgjoingetflatshareCallback(data) {

    let status = data.status;
    let responseData = data.responseData;

    $("#wgsearchsuccessflatsharename").text(responseData.name + "#" + responseData.tagid);


    $(".wgJoinSearchWrapper").hide();
    $(".wgWaitWrapper").hide();
    $(".wgJoinSuccessWrapper").show();

}


