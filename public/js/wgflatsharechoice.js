var xhr_flatchoice;
var wgbearertoken;

$(document).ready(function() {

    $("#wgsearch").on("input", function(e) {
        if ($("#wgsearch").val().length == 0) {
            emptyWGSearchInput = true;
            wgsearchCallback(JSON.parse('[]'));
        } else {
            emptyWGSearchInput = false;
            xhr_flatchoice = apiCall_GET("flatshare", wgsearchCallback, xhr_flatchoice, "q=" +  encodeURIComponent($("#wgsearch").val()));
        }
    });

});

function wgsearchChangeListener() {

}

function wgsearchCallback(data) {

    var wgsearchoutput;

    if (data.length == 0) {
        wgsearchoutput = $("<span>", { class: "wgsearchnooutput"}).text("Keine WG gefunden.");
    } else {
        wgsearchoutput = $("<ul>", { class: "wgsearchoutput" });

        for (let i = 0; i < data.length; i++) {
            wgsearchoutput.append(
                $("<li>", { class: "wgsearchrow" }).append(
                    $("<input>", { type: "radio", name: "wgsearchjoinchoice", id: "id_" + data[i].name + "_" + data[i].tagid, value: data[i].id })
                ).append(
                    $("<label>", { for: "id_" + data[i].name + "_" + data[i].tagid }).text(data[i].name + "#" + data[i].tagid)
                )
            );
        }
    }

    $("#wgsearchresult").html(wgsearchoutput);
}
