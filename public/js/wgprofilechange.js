var xhr_updateuser;

$(document).ready(function() {

    $("#profileditbuttonstart").click(function (evt) {

        evt.preventDefault();   // unterdrückt die Funktionen von einem Button (Form-Interaktion)

            $(".profileinputhide").show();
            $(".profileinputprefilled").hide();

            $("#profileeditstart").hide();

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

        $("#profileeditstart").show();

        $("#profileusername_span").removeClass("wgcurnotallowed");

        $("#profileeditend").hide();

    });

    $("#profileditbuttonsave").click(function (evt) { //speicherbutton
        evt.preventDefault(); //Unterdrückt die Funktion eines Buttons

            let givenname = $('input[name=profilgivenname]').val();

            $("#givennameworkonfail").hide();

            if (givenname == "") {
                $("#givennameworkonfail").show();
            } else {

                let jsonData = {
                    action: 'updateProfile',
                    givenname: $("#profilgivenname_input").val(),
                    name: $("#profilname_input").val(),
                    email: $("#profilemail_input").val()
                }

                apiCall_UPDATE("user", $("#wgProfileUserId").val(), jsonData, wgprofilupdateCallback, xhr_updateuser)

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



    } else if (status == "error") {

        // Fehlerbehandlung

    }
}
