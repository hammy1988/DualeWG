var xhr_updateuser;
var xhr_updatepassword;
var xhr_leaveflatshare;

var leavemember_sent = false;

$(document).ready(function() {

    $(".wgerrormessages").hide();
    $(".wgWaitWrapper").hide();

    $("#profileditbuttonstart").click(function (evt) {

        evt.preventDefault();   // unterdrückt die Funktionen von einem Button (Form-Interaktion)

            $(".profileinputhide").show();
            $(".profileinputprefilled").hide();

            $("#profileeditstart").hide();
            $("#passwordchange").hide();

            $("#profileusername_span").addClass("wgcurnotallowed");

            $("#profileeditend").show();
    });



    $("#profileditbuttonabort").click(function (evt) {  //Abbruch Button

        evt.preventDefault();

        $("#profilgivenname_input").val($("#profilgivenname_span").text().trim());
        $("#profilname_input").val($("#profilname_span").text().trim());
        $("#profilemail_input").val($("#profilemail_span").text().trim());

        $(".profileinputhide").hide();
        $(".profileinputprefilled").show();
        $("#passwordchange").show();
        $("#givennameerrorfield").hide();
        $("#nameerrorfield").hide();
        $("#emailerrorfield").hide();

        $("#profileeditstart").show();

        $("#profileusername_span").removeClass("wgcurnotallowed");

        $("#profileeditend").hide();

    });

    $("#profileditbuttonsave").click(function (evt) { //speicherbutton
        evt.preventDefault(); //Unterdrückt die Funktion eines Buttons

        let givenname = $('input[name=profilgivenname]').val();
        let name = $('input[name=profilname]').val();
        let email = $('input[name=profilemail]').val();

        $(".wgWaitWrapper").show();
        $("#profileditbuttonsave").addClass('wgwaitbutton');
        $("#profileditbuttonabort").addClass('wgwaitbutton');
        $("#givennameworkonfail").hide();
        $("#nameworkonfail").hide();
        $("#emailworkonfail").hide();
        
        let jsonData = {
            action: 'updateProfile',
            givenname: $("#profilgivenname_input").val(),
            name: $("#profilname_input").val(),
            email: $("#profilemail_input").val()
        }

        apiCall_UPDATE("user", $("#wgProfileUserId").val(), jsonData, wgprofilupdateCallback, xhr_updateuser)


    });

    $(".wguserleave").click(function(evt) {
        evt.preventDefault();
        wgProfileLeave("leaveFlatshare", $(this).attr("data-userid"));
    });


    $("#passwordchangesubmitbutton").click(function (evt) {

        $("#oldpassworderrorfield").hide();
        $("#newpassworderrorfield").hide();
        evt.preventDefault();
        wgPasswordchangeFormAjaxSubmit();
    });

    $("#oldpassword").on("keypress", function (evt) {
        if(evt.which === 13){
            $(this).attr("disabled", "disabled");
            wgPasswordchangeFormAjaxSubmit();
            $(this).removeAttr("disabled");
        }
    });

    $("#newpassword").on("keypress", function (evt) {
        if(evt.which === 13){
            $(this).attr("disabled", "disabled");
            wgPasswordchangeFormAjaxSubmit();
            $(this).removeAttr("disabled");
        }
    });

    $("#newpassword_confirmation").on("keypress", function (evt) {
        if(evt.which === 13){
            $(this).attr("disabled", "disabled");
            wgPasswordchangeFormAjaxSubmit();
            $(this).removeAttr("disabled");
        }
    });
});


function wgprofilupdateCallback(data) {

    let responseData = data.responseData;
    let status = data.status;


    if (status == "success") {

        $("#profilgivenname_span").text(responseData.givenname);
        $("#profilname_span").text(responseData.name);
        $("#profilemail_span").text(responseData.email);
        $("#profilupdatedat_span").text(wgDateTimeFormat(responseData.updated_at));

        $("#profilgivenname_input").val($("#profilgivenname_span").text().trim());
        $("#profilname_input").val($("#profilname_span").text().trim());
        $("#profilemail_input").val($("#profilemail_span").text().trim());

        $(".profileinputhide").hide();
        $(".profileinputprefilled").show();

        $("#profileeditstart").show();

        $("#profileusername_span").removeClass("wgcurnotallowed");

        $("#profileeditend").hide();
        $("#passwordchange").show();
        $("#givennameerrorfield").hide();
        $("#nameerrorfield").hide();
        $("#emailerrorfield").hide();
        $(".wgWaitWrapper").hide();
        $("#profileditbuttonsave").removeClass('wgwaitbutton');
        $("#profileditbuttonabort").removeClass('wgwaitbutton');


    } else if (status == "error") {

        // Fehlerbehandlung
        if (responseData.status == 422) {
            let errorJSON = responseData.responseJSON.errors;

            let errorText = "Fehler:\n"
            for (var err in errorJSON) {
                errorText += "  - " + err + ": " + errorJSON[err] + "\n";
            }
            console.error(errorText)

            for (var err in errorJSON) {

                var errTextShow = "";

                for (let i = 0; i < errorJSON[err].length; i++) {
                    errTextShow += errorJSON[err][i];
                    if (i < (errorJSON[err].length - 1)) {
                        errTextShow += "<br />";
                    }
                }

                if (err == 'givenname') {
                    $("#givennameerrorfield").html(errTextShow);
                    $("#givennameerrorfield").show();
                } else if (err == 'name') {
                    $("#nameerrorfield").html(errTextShow);
                    $("#nameerrorfield").show();
                } else if (err == 'email') {
                    $("#emailerrorfield").html(errTextShow);
                    $("#emailerrorfield").show();

                } else {
                    console.error("Fehler: " + responseData.status + " - " + responseData.statusText);
                }
                $(".wgWaitWrapper").hide();
                $("#profileditbuttonsave").removeClass('wgwaitbutton');
                $("#profileditbuttonabort").removeClass('wgwaitbutton');
            }
        }
    }
}

    function wgProfileLeave(actionStr, userid) {

        if (!(leavemember_sent)) {

            leavemember_sent = true;

            $(".wguserleave").addClass("wgleavedisable");

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
                $("#wgProfileMain").remove();
                $("#wgProfileFlatshareLeaveSuccess").show();
            }

        } else if (status == "error") {

            // Fehlerbehandlung
            leavemember_sent = false;

            $(".wguserleave").removeClass("wgleavedisable");
        }


    }

    function wgPasswordchangeFormAjaxSubmit() {

        let oldpassword = $('input[name=oldpassword]', '#wgpasswortchangeinput').val();
        let newpassword = $('input[name=newpassword]', '#wgpasswortchangeinput').val();
        let newpassword_confirmation = $('input[name=newpassword_confirmation]', '#wgpasswortchangeinput').val();


        let jsonData = {
            action: 'updatePassword',
            oldpassword: oldpassword,
            newpassword: newpassword,
            newpassword_confirmation: newpassword_confirmation,
        };

        apiCall_UPDATE("user", $("#wgProfileUserId").val(), jsonData, wgpasswordupdateCallback, xhr_updatepassword)

    }


    function wgpasswordupdateCallback(data) {

        let responseData = data.responseData;
        let status = data.status;


        if (status == "success") {

            console.log(responseData);


        } else if (status == "error") {

            console.error(responseData);

            // Fehlerbehandlung
            if (responseData.status == 422) {
                let errorJSON = responseData.responseJSON.errors;

                let errorText = "Fehler:\n"
                for (var err in errorJSON) {
                    errorText += "  - " + err + ": " + errorJSON[err] + "\n";
                }
                console.error(errorText)

                for (var err in errorJSON) {

                    if (err == 'oldpassword') {

                        $("#oldpassworderrorfield").html(errorJSON[err]);
                        $("#oldpassworderrorfield").show();

                    } else if (err == 'newpassword') {

                        $("#newpassworderrorfield").html(errorJSON[err]);
                        $("#newpassworderrorfield").show();


                    }
                    console.log(err);

                }
            }
                else {
                console.error("Fehler: " + responseData.status + " - " + responseData.statusText);
            }

        }
    }
