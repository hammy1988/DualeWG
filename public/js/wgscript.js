var emptyWGSearchInput = true;
moment.locale("de");

$(document).ready(function() {

    wgWaitSpinnerColorChanger();

    $("#wgLogoutButton").click(function(evt) {
        evt.preventDefault();
        document.getElementById('logout-form').submit();
    });

    console[console.info ? 'info' : 'log'](
        "Willkommen auf der Dualen WG Seite ♥\n" +
        "Die Seite ist nun geladen, und du darfst Sachen machen ツ\n\n" +
        "https://www.dualewg.de/\n\n" +
        "Viel Spaß wünschen Andi, Luca, Basti, Martin und Ölf\n"+
        "Creative Informatics (VInf)"
    );
});

function apiCall_INDEX(api, callback, xhr, query = '') {


    let url = "/api/" + api;
    if (query.length > 0) {
        url += "?" + query;
    }
    if (xhr !== undefined) {
        xhr.abort();
    }

    xhr = $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        headers: {
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){

            let callbackData = {
                "status": "success",
                "responseData": data,
            }

            callback(callbackData);

        },
        error: function(data) {

            let callbackData;

            if (data.statusText == "abort") {
                callbackData = {
                    "status": "abort",
                    "responseData": data,
                }
            } else {
                callbackData = {
                    "status": "error",
                    "responseData": data,
                }
            }


            callback(callbackData);
        }
    });

    return xhr;
}

function apiCall_SHOW(api, id, callback, xhr) {

    let url = "/api/" + api + "/" + id;

    if (xhr !== undefined) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        headers: {
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){

            let callbackData = {
                "status": "success",
                "responseData": data,
            }

            callback(callbackData);
        },
        error: function(data) {

            let callbackData;

            if (data.statusText == "abort") {
                callbackData = {
                    "status": "abort",
                    "responseData": data,
                }
            } else {
                callbackData = {
                    "status": "error",
                    "responseData": data,
                }
            }


            callback(callbackData);

        }
    });

    return xhr;

}

function apiCall_UPDATE(api, id, data, callback, xhr) {

    let url = "/api/" + api + "/" + id;


    if (xhr !== undefined) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "PUT",
        dataType: "json",
        data: data,
        url: url,
        headers: {
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){

            let callbackData = {
                "status": "success",
                "responseData": data,
            }

            callback(callbackData);
        },
        error: function(data) {

            let callbackData;

            if (data.statusText == "abort") {
                callbackData = {
                    "status": "abort",
                    "responseData": data,
                }
            } else {
                callbackData = {
                    "status": "error",
                    "responseData": data,
                }
            }


            callback(callbackData);
        }

    });
}

function apiCall_STORE(api, data, callback, xhr) {

    let url = "/api/" + api;


    if (xhr !== undefined) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "POST",
        dataType: "json",
        data: data,
        url: url,
        headers: {
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){

            let callbackData = {
                "status": "success",
                "responseData": data,
            }

            callback(callbackData);
        },
        error: function(data) {

            let callbackData;

            if (data.statusText == "abort") {
                callbackData = {
                    "status": "abort",
                    "responseData": data,
                }
            } else {
                callbackData = {
                    "status": "error",
                    "responseData": data,
                }
            }


            callback(callbackData);
        }

    });
}


function apiCall_DESTROY(api, id, callback, xhr) {

    let url = "/api/" + api + "/" + id;


    if (xhr !== undefined) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "DELETE",
        dataType: "json",
        url: url,
        headers: {
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){

            let callbackData = {
                "status": "success",
                "responseData": data,
            }

            callback(callbackData);
        },
        error: function(data) {

            let callbackData;

            if (data.statusText == "abort") {
                callbackData = {
                    "status": "abort",
                    "responseData": data,
                }
            } else {
                callbackData = {
                    "status": "error",
                    "responseData": data,
                }
            }


            callback(callbackData);
        }

    });
}

function wgDateTimeFormat(conUTCDateTime) {

    return moment.utc(conUTCDateTime).local().format("L LT");

}


function wgWaitSpinnerColorChanger() {

    var spinner = $(".wgwaitspinner");

    spinner.each(function() {
        if ($(this).hasClass("wgColorChange")) {
            $(this).removeClass("wgColorChange");
        } else {
            $(this).addClass("wgColorChange");
        }
    });

    setTimeout(wgWaitSpinnerColorChanger, 5000);

}
