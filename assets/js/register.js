$(document).ready(function(){
    // on click sign up, hide login, show registration
    $('#signup').click(function () {
        $('#first').slideUp("slow", function () {
            $('#second').slideDown("slow");
        });
    });
    // on click sign in, show login, hide registration
    $('#signin').click(function () {
        $('#second').slideUp("slow", function () {
            $('#first').slideDown("slow");
        });
    });
});