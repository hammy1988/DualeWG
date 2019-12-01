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

        $(".wgWaitWrapper").hide();
        $(".wgCreateSuccessWrapper").hide();
        $("#wgcreatefail").show();
        $(".wgCreateWrapper").show();

    }

}
