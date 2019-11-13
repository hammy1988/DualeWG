$(document).ready(function() {
    apiCall_GET("flatshare", ttest, "q=Er");
    apiCall_GET("flatshare", ttest, "q=re");
    apiCall_GET("flatshare", ttest, "q=erst");
});


function ttest(data) {
    console.log("antwort");
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        console.log("  - " + data[i].name)
    }
    console.log("antwort ende");
}
