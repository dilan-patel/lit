$(document).ready(function() {

    $("#hideLoginForm").click(function() {
        //Hides the login form, displays the registration form.
        $("#lg").hide();
        $("#rg").fadeIn();
    });
    $("#hideRegisterForm").click(function() {
        //Hides the registration form, displays the login form.
        $("#rg").hide();
        $("#lg").fadeIn();
    });

});