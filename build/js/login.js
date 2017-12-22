function login_submit(){
    $("#login_button").fadeOut(1000);
   $("#login_spinner").fadeIn(100);
    var base_url = window.location.origin + "/newtra/";
//    var base_url = window.location.origin;
    var form_data =  $('#login_form').serialize();

    $.ajax({
            type: "POST",
            url: base_url+"ajax/login",
            data: form_data,
            dataType: "json",
            success: function(data) {
                if(data.status){
                    $('#login_error').hide();
                    $('#login_success').html(data.message);
                    $(location).attr('href',base_url+data.redirect_url);
                }else{
                    $('#login_error').html(data.message);
                    $("#login_spinner").hide();
                    $("#login_button").fadeIn();
                }
            }
        });
    return false;
}