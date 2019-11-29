var xhr_requestanswer;

$(document).ready(function() {

    $(".wgcontrolaccept").click(function(evt) {
        evt.preventDefault();
        wgRequest("acceptFlatshare", $(this).attr("data-userid"));
    });

    $(".wgcontroldenied").click(function(evt) {
        evt.preventDefault();
        wgRequest("deniedFlatshare", $(this).attr("data-userid"));
    });

});

function wgRequest(actionStr, userid) {

    let jsonData = {
        action: actionStr
    }
    apiCall_UPDATE("user", userid, jsonData, wgrequestCallback, xhr_requestanswer)

}

function wgrequestCallback(data) {

    let responseData = data.responseData;
    let status = data.status;


    if (status == "success") {

        console.log(responseData);
        $("#wgcontroluserrequest_" + responseData.id).remove();

    } else if (status == "error") {

        // Fehlerbehandlung

    }
}
