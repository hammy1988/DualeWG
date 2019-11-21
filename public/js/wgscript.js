
var emptyWGSearchInput = true;

function apiCall_GET(api, callback, xhr, query = '') {

    let url = "/api/" + api;
    if (query.length > 0) {
        url += "?" + query
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
                callback(data);
            }
        }
    });

    return xhr;
}

function apiCall_PUT(api, id, data) {

    let url = "/api/" + api + "/" + id;

    $.ajax({
        type: "PUT",
        dataType: "json",
        url: url,
        headers: {
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){
            console.log(data);
        }
    });
}
