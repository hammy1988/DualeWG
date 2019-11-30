var xhr_createflat;

$(document).ready(function() {

    $(".wgWaitWrapper").hide();


    $("#createWG").click(function(evt) {
        evt.preventDefault();
        let flatsharename = $('input[name=wgname]', '#wgcreateinput').val();

        $("#wgcreatenamefail").hide();

        if (flatsharename == "") {
            $("#wgcreatenamefail").show();
        } else {

            $(".wgCreateWrapper").hide();
            $(".wgCreateSuccessWrapper").hide();
            $(".wgWaitWrapper").show();

            let jsonData = {
                name: flatsharename
            };

            apiCall_STORE('flatshare', jsonData, wgcreateCallback, xhr_createflat);

        }

    });

});


function wgcreateCallback(data) {

    let responseData = data.responseData;
    let status = data.status;

    console.log(data);

    if (status == "success") {

        $("#wgcreatesuccessflatsharename").text(responseData.name + "#" + responseData.tagid);

        $(".wgCreateWrapper").hide();
        $(".wgWaitWrapper").hide();
        $(".wgCreateSuccessWrapper").show();


    } else if (status == "error") {

        // Fehlerbehandlung

        $(".wgWaitWrapper").hide();
        $(".wgCreateSuccessWrapper").hide();

        if (responseData.status == 422) {
            let errorJSON = responseData.responseJSON.errors;

            let errorText = "Fehler:\n"
            for (var err in errorJSON) {

                if (err == 'name') {
                    $("#wgcreatefail").html(errorJSON[err]);
                } else {
                    console.log(err);
                }

                errorText += "  - " + err + ": " + errorJSON[err] + "\n";
            }
            console.error(errorText)
        } else {
            $("#wgcreatefail").text("Da hat etwas nicht geklappt. Probiere es noch einmal.");
        }

        $("#wgcreatefail").show();
        $(".wgCreateWrapper").show();


    }

}
