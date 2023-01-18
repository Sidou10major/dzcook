$(document).ready(function () {
    // toggle add recipe
    $('#add-form').click(function(e) {
        e.preventDefault();
        $('.popout').toggleClass('active');
    }
    );
    $('#close-popout').click(function(e) {
        e.preventDefault();
        $('.popout').toggleClass('active');
    });
    

});