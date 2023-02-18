$(document).ready(function() {
    $('.rate>input').click(function(e) {
        let id = $(this).parent().find('input[name="id"]').val();
        let rate = $(this).val();
        data = {
            id: id,
            note: rate
        }
        $.post({
            url: "index.php?action=rateRecipe",
            data: data,
        });
    })

    $('#filter-btn').click(function(e) {
        e.preventDefault();
        $('.filter-container').toggleClass('active');
    });

    // Auth
    $('#login-switch').click(function(e) {
        e.preventDefault();
        $('.login').removeClass('active');
        $('.register').addClass('active');
    });
    $('#register-switch').click(function(e) {
        e.preventDefault();
        $('.login').addClass('active');
        $('.register').removeClass('active');
    });

    $('#search').click(function() {
        $.get({
            url: "/index.php?action=getIngredients",
            success: function(response) {
                let ingredients = JSON.parse(response);
                let ingredientsList = [];
                for (let i = 0; i < ingredients.length; i++) {
                    ingredientsList.push(ingredients[i].name);
                }
                $('#search').autocomplete({
                    source: ingredientsList
                });
            }
        });
    })

    $('#add-recipe').click(function(e) {
        e.preventDefault();
        $('.popout').toggleClass('active');
    }
    );
    $('#close-popout').click(function(e) {
        e.preventDefault();
        $('.popout').toggleClass('active');
    });
    $('#search,#fete').focus(function(e) {
        e.preventDefault();
        this.type='email';
    });
    $('#search,#fete').blur(function(e) {
        e.preventDefault();
        this.type='text';
    });
});
    