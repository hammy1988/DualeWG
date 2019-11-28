var emptyWGSearchInput = true;

$(document).ready(function() {

    wgWaitSpinnerColorChanger();

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

            if (!(emptyWGSearchInput)) {
                let callbackData = {
                    "status": "success",
                    "responseData": data,
                }

                callback(callbackData);
            }
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



function wgWaitSpinnerColorChanger() {

    var spinner = $("#wgwaitspinner");

    if (spinner.hasClass("wgColorChange")) {
        spinner.removeClass("wgColorChange");
    } else {
        spinner.addClass("wgColorChange");
    }

    setTimeout(wgWaitSpinnerColorChanger, 5000);

}
