
$(document).ready(function() {
    $('#refreshCap').click(function(evt){
        evt.preventDefault();
        console.log("test");
        $.ajax({
            type:'GET',
            url:'refreshcaptcha',
            success:function(data){
                $(".captcha .captchImg").html(data.captcha);
            }
        });
    });
});
