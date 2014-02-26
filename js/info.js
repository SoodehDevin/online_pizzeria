$(document).ready(function(){
    var tipdiv = $("div#info div.tip");

    $("#info").hover(function() {
        tipdiv.slideDown();
    }, function() {
        tipdiv.slideUp();
    });
});