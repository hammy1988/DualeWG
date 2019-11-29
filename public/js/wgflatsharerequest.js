var xhr_deleterequest;

$(document).ready(function() {

    $("#delWgRequest").click(function(evt) {
        evt.preventDefault();

        let jsonData = {
            action: "deleteFlatshare"
        }

        apiCall_UPDATE("user", $(this).attr("data-userid"), jsonData, wgdelrequestCallback, xhr_deleterequest)

    });

});

function wgdelrequestCallback(data) {

    let responseData = data.responseData;
    let status = data.status;


    if (status == "success") {

        window.location.replace("/");

    } else if (status == "error") {

        // Fehlerbehandlung

    }
}
