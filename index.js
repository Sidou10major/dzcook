$(document).ready(function() {
    // Rating a recipe
    $('.rate>input').click(function(e) {
        e.preventDefault();
        let id = $(this).parent().find('input[name="id"]').val();
        console.log(id)
        let data = $(this).val();
        data = {
            id: id,
            note: data
        }
        $.post({
            url: "/index.php/rateRecipe",
            data: data,
            success: function(response) {
                location.reload();
            }
        });
    })

    // Filter
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

    //autocomplete search
    $('#search').click(function() {
        $.get({
            url: "/index.php/getIngredients",
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

    // toggle add recipe
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
    