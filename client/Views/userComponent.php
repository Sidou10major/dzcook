<?php
class userComponents
{
    

    public function head($title, $description)
    {
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="pragma" content="no cache" />
            <title><?php echo $title ?></title>
            <meta name="description" content=<?php echo $description ?> />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="style.php">
            <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
            <script src="index.js"></script>
        </head>
    <?php
    }

    public function navbar()
    {
    ?>
        <nav>
            <a href=""><object data="Utils/Logo.jpg" class="nav-logo"></object></a>

            <ul class="menu">
                <li><a href="index.php?action=indexDisplay">Accueil</a></li>
                <li><a href="index.php?action=listDisplay&type=news">News</a></li>
                <li><a href="index.php?action=listDisplay&type=recettes">Idées de recette</a></li>
                <li>Recette
                    <ul class="sub-menu">
                        <li><a href="index.php?action=listDisplay&type=recettes&healthy=1">Healthy</a></li>
                        <li><a href="index.php?action=listDisplay&type=recettes&saison=hiver">Saison</a></li>
                        <li><a href="index.php?action=listDisplay&type=recettes&fete=all">Fête</a></li>
                    </ul>
                </li>
                <li><a href="index.php?action=listDisplay&type=nutrition">Nutrition</a></li>
                <li><a href="index.php?action=contactDisplay">Contact</a></li>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <li><a href="index.php?action=profileDisplay">profile</a></li>
                <?php
                }
                ?>
            </ul>

            <div class="call-action">
                <div class="social-media">
                    <a href="<?php echo $GLOBALS['facebook'] ?>">
                        <img src="Utils/facebook.png" alt="facebook">
                    </a>
                    <a href="<?php echo $GLOBALS['instagram'] ?>"><img src="Utils/instagram.png" alt="instagram"></a>
                    <a href="<?php echo $GLOBALS['linkedin'] ?>"><img src="Utils/linkedin.png" alt="linkedin" class="linkedin"></a>
                </div>

                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <a href="index.php?action=logoutHandler" class="prm-btn">Logout</a>
                <?php
                } else {
                ?>
                    <a href="index.php?action=authDisplay" class="prm-btn">S'identifier</a>
                <?php
                }
                ?>
            </div>
        </nav>

    <?php
    }
    public function footer()
    {
    ?>
        <footer>
            <div>
                <object data="Utils/Logo.jpg" class="footer-logo"></object>
            </div>
            <div>
                <p class="H6">
                    Menu
                </p>
                <div class="footer-menu">
                    <ul>
                        <li><a href="index.php?action=indexDisplay">Accueil</a></li>
                        <li><a href="index.php?action=listDisplay&type=news">News</a></li>
                        <li><a href="index.php?action=listDisplay&type=recettes">Idées de recette</a></li>
                        <li><a href="index.php?action=listDisplay&type=recettes&Healthy=1">Healthy</a></li>
                    </ul>
                    <ul>
                        <li><a href="index.php?action=listDisplay&type=recettes&saison=hiver">Saison</a></li>
                        <li><a href="index.php?action=listDisplay&type=recettes&fete=all">Fêtes</a></li>
                        <li><a href="index.php?action=listDisplay&type=nutrition">Nutrition</a></li>
                        <li><a href="index.php?action=contactDisplay">contact us</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <p class="H6">Social Media</p>
                <div class="footer-social-media">
                    <a href="<?php echo $GLOBALS['facebook'] ?>"><img src="Utils/facebook.png" alt="facebook">dzcook</a>
                    <a href="<?php echo $GLOBALS['instagram'] ?>"><img src="Utils/instagram.png" alt="instagram">Dz_cook</a>
                    <a href="<?php echo $GLOBALS['linkedin'] ?>"><img src="Utils/linkedin.png" alt="linkedin" class="linkedin">Dz Cook</a>
                </div>
            </div>
        </footer>
    <?php
    }

    public function card($Card, $type)
    {
    ?>
        <div class="card-container">
            <img src="<?php echo $Card['imgPath'] ?>" alt="Logo" class="card-img">
            <div class="card-body">
                <h5 class="card-header"><?php echo $Card['titre'] ?></h5>
                <p class="card-content"><?php if (isset($Card['description'])) echo $Card['description'] ?></p>
                <p class="card-content">
                    <?php
                    if ($type == 'nutrition') {
                        foreach ($Card['nutrition'] as $info) {
                            echo $info['titre'] . ': ' . $info['description'] . '<br>';
                        }
                    }
                    ?>
                </p>
            </div>
            <?php
            if ($type != 'nutrition') {
            ?>
                <a href="index.php?action=detailDisplay&type=<?php if ($type == 'news') {
                                                                    echo $Card['type'] . '&id=' . $Card['id'];
                                                                } else {
                                                                    echo $type . '&id=' . $Card['id'];
                                                                } ?>" class="prm-btn">lire la suite</a>
            <?php
            } else if ($Card['healthy'] == 1) {
            ?>
                <p class="Secondary-btn"><?php echo "Healthy"  ?></p>
            <?php
            }

            ?>
        </div>
    <?php
    }

    public function swipper($List)
    {
    ?>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-pause="hover">
            <div class="carousel-inner">
                <?php
                $index = 0;
                foreach ($List as $Card) {
                    if ($index == 0) {
                        $index++;
                ?>
                        <div class="carousel-item active" data-bs-interval="5000">
                            <div class="swiper-item">
                                <img src="<?php echo $Card['imgPath'] ?>" alt="testImg" class="swiper-item-img">
                                <div class="swiper-item-body">
                                    <div class="swiper-item-text">
                                        <h3><?php echo $Card['titre'] ?></h3>
                                        <p><?php echo $Card['description'] ?></p>
                                    </div>
                                    <a href="<?php echo $Card['url'] ?>" target="_blank" class="prm-btn">afficher la suite</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="swiper-item">
                                <img src="<?php echo $Card['imgPath'] ?>" alt="testImg" class="swiper-item-img">
                                <div class="swiper-item-body">
                                    <div class="swiper-item-text">
                                        <h3><?php echo $Card['titre'] ?></h3>
                                        <p><?php echo $Card['description'] ?></p>
                                    </div>
                                    <a href="<?php echo $Card['url'] ?>" target="_blank" class="prm-btn">afficher la suite</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
    <?php
    }

    public function categories($List)
    {
    ?>
        <div class="categories">
            <?php
            foreach ($List as $category) {
            ?>
                <div class="category">
                    <div class="category-header">
                        <h3>
                            <?php echo $category['titre'] ?>
                        </h3>
                        <a href="index.php?action=listDisplay&type=recettes&typePlat=<?php echo $category['titre'] ?>">voir tout<img src="Utils/svg/arrowRightExtend.svg" alt=""></a>
                    </div>
                    <div class="category-body">
                        <div class="list-view">
                            <?php
                            foreach ($category['recipes'] as $Card) {
                                $this->card($Card, 'recettes');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    }
    public function detailPage($data)
    {
    ?>
        <!-- Recipe Page -->
        <div>
            <!-- Title & description & Image -->
            <div class="horizontale-container">
                <div class="header-container">
                    <div class="header"> <!-- header -->
                        <p><?php echo $data['titre'] ?></p>
                        <p><?php if (isset($data['difficulte'])) echo $data['difficulte']; ?></p>
                        <?php if (isset($data['calories'])) {
                        ?>
                            <p><?php echo $data['calories'] ?> <img src="Utils/svg/calorie.svg" alt=""></p>
                        <?php
                        }
                        ?>
                        <?php if (isset($data['rate'])) {
                        ?>
                            <p><?php echo intval($data['rate']) ?> <img src="Utils/svg/star.svg" alt=""></p>
                        <?php
                        }
                        ?>
                    </div>
                    <p> <!---- description -->
                        <?php echo $data['description'] ?>
                    </p>
                    <?php if (isset($data['tempsPreparation'])) {
                    ?>
                        <ul>
                            <li class="H6">temps de preparation : &nbsp;</span><?php echo $data['tempsPreparation'] ?> min <img src="Utils/svg//time.svg" alt=""></li>
                            <li class="H6">temps de repos : &nbsp;</span><?php echo $data['tempsRepo'] ?> min <img src="Utils/svg//time.svg" alt=""></li>
                            <li class="H6">temps de cuisson : &nbsp;</span><?php echo $data['tempsCuisson'] ?> min <img src="Utils/svg//time.svg" alt=""></li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
                <img src="<?php echo $data['imgPath'] ?>" alt="RecipeImg">
            </div>
            <!-- Video & details -->
            <div class="verticale-container">
                <div class="horizontale-container">
                    <?php if (isset($data['ingredients'])) {
                    ?>
                        <div>
                            <p class="H6">Ingrédients</p>
                            <ul>
                                <?php
                                foreach ($data['ingredients'] as $ingredient) {
                                ?>
                                    <li><?php echo $ingredient['titre'] . ":" . $ingredient['quantite'] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                    <?php if (isset($data['steps'])) {
                    ?>
                        <div>
                            <p class="H6">Etapes</p>
                            <ol>
                                <?php
                                foreach ($data['steps'] as $step) {
                                ?>
                                    <li><?php echo $step['instruction'] ?></li>
                                <?php
                                }
                                ?>
                            </ol>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if (isset($data['videoPath'])) {
                ?>
                    <video controls>
                        <source src="<?php echo $data['videoPath'] ?>" type="video/mp4">
                    </video>
                <?php
                }
                ?>
            </div>
            <?php

            if (isset($_SESSION['user'])) {
            ?>
                <div class="rate-container">
                    <p class="H6">Noté cette recette</p>
                    <form class="rate" action="">
                        <input type="text" name="id" value="<?php echo $data['recetteID'] ?>" hidden>
                        <input type="radio" id="star5" name="rate" value="5" <?php if ($data['userRate'] == 5) echo 'checked' ?> />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" <?php if ($data['userRate'] == 4) echo 'checked' ?> />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" <?php if ($data['userRate'] == 3) echo 'checked' ?> />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" <?php if ($data['userRate'] == 2) echo 'checked' ?> />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" <?php if ($data['userRate'] == 1) echo 'checked' ?> />
                        <label for="star1" title="text">1 star</label>
                        </from>
                </div>
                <script>
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
                            success: function(response) {
                                location.reload();
                            }
                        });
                    })
                </script>
            <?php
            }
            ?>
        </div>
    <?php
    }
    public function listView($List, $type, $filter, $search)
    {

    ?>
        <div class="list-container">
            <div class="list-header">
                <p class="H4">Liste des <?php echo $type ?></p>
                <?php if ($type == 'recettes') {
                ?>
                    <div class="list-filter">
                        <form action="index.php?action=listDisplay&type=<?php echo $type ?>" method="post" class="search-container">
                            <div class="search">
                                <img src="Utils/svg/search.svg" alt="">
                                <input type="text" name="ingredients" placeholder="ingredient1,ingredient2..." id="search" multiple list="search-List">
                                <datalist id="search-List">
                                    <?php
                                    foreach ($List as $data) {
                                        foreach ($data['ingredients'] as $ingredient) {
                                    ?>
                                            <option value="<?php echo $ingredient['titre'] ?>">
                                        <?php
                                        }
                                    }
                                        ?>
                                </datalist>
                                <button id="filter-btn">filtrer <img src="../..Utils/svg/filter.svg" alt=""></button>
                            </div>
                            <button class="prm-btn" id="search-btn" type="submit">Search</button>
                        </form>
                        <form action="index.php" class="filter-container">
                            <input type="hidden" name="action" value="listDisplay">
                            <input type="hidden" name="type" value="<?php echo $type ?>">
                            <div class="filter">
                                <div class="filter-item">
                                    <p class="H6">Difficulté</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="facile" name="difficulte" value="facile">
                                        <label for="facile">Facile</label><br>
                                        <input type="checkbox" id="moyen" name="difficulte" value="moyen">
                                        <label for="moyen">Moyen</label><br>
                                        <input type="checkbox" id="difficile" name="difficulte" value="difficile">
                                        <label for="difficile">Difficile</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Temps de préparation</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="moins-15" name="timePreparation" value="15">
                                        <label for="moins-15">Moins de 15 min</label><br>
                                        <input type="checkbox" id="15-30" name="timePreparation" value="30">
                                        <label for="15-30">Moins de 30 min</label><br>
                                        <input type="checkbox" id="30-45" name="timePreparation" value="345">
                                        <label for="30-45">Moins de 45 min</label><br>
                                        <input type="checkbox" id="45-60" name="timePreparation" value="60">
                                        <label for="45-60">Moins de 60 min</label><br>
                                        <input type="checkbox" id="plus-60" name="timePreparation" value="999">
                                        <label for="plus-60">tous</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Temps de Repo</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="moins-15" name="timeRepo" value="15">
                                        <label for="moins-15">Moins de 15 min</label><br>
                                        <input type="checkbox" id="15-30" name="timeRepo" value="30">
                                        <label for="15-30">Moins de 30 min</label><br>
                                        <input type="checkbox" id="30-45" name="timeRepo" value="45">
                                        <label for="30-45">Moins de 45 min</label><br>
                                        <input type="checkbox" id="45-60" name="timeRepo" value="60">
                                        <label for="45-60">Moins de 60 min</label><br>
                                        <input type="checkbox" id="plus-60" name="timeRepo" value="999">
                                        <label for="plus-60">tous</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Temps de cuisson</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="moins-15" name="timeCuisson" value="15">
                                        <label for="moins-15">Moins de 15 min</label><br>
                                        <input type="checkbox" id="15-30" name="timeCuisson" value="30">
                                        <label for="15-30">Moins de 30 min</label><br>
                                        <input type="checkbox" id="30-45" name="timeCuisson" value="45">
                                        <label for="30-45">Moins de 45 min</label><br>
                                        <input type="checkbox" id="45-60" name="timeCuisson" value="60">
                                        <label for="45-60">Moins de 60 min</label><br>
                                        <input type="checkbox" id="plus-60" name="timeCuisson" value="999">
                                        <label for="plus-60">tous</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Type de plat</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="entree" name="typePlat" value="entree">
                                        <label for="entree">Entrée</label><br>
                                        <input type="checkbox" id="plat" name="typePlat" value="plat">
                                        <label for="plat">Plat</label><br>
                                        <input type="checkbox" id="dessert" name="typePlat" value="dessert">
                                        <label for="dessert">Dessert</label><br>
                                        <input type="checkbox" id="boisson" name="typePlat" value="boisson">
                                        <label for="boisson">boisson</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Saison</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="printemps" name="saison" value="printemps">
                                        <label for="printemps">printemps</label><br>
                                        <input type="checkbox" id="été" name="saison" value="ete">
                                        <label for="été">été</label><br>
                                        <input type="checkbox" id="automne" name="saison" value="automne">
                                        <label for="automne">automne</label><br>
                                        <input type="checkbox" id="hiver" name="saison" value="hiver">
                                        <label for="hiver">hiver</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Notation</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="1" name="note" value="1">
                                        <label for="1">1 star</label><br>
                                        <input type="checkbox" id="2" name="note" value="2">
                                        <label for="2">2 stars</label><br>
                                        <input type="checkbox" id="3" name="note" value="3">
                                        <label for="3">3 stars</label><br>
                                        <input type="checkbox" id="4" name="note" value="4">
                                        <label for="4">4 stars</label><br>
                                        <input type="checkbox" id="5" name="note" value="5">
                                        <label for="5">5 stars</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">calories</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="moins-200" name="calories" value="200">
                                        <label for="moins-200">Moins de 200</label><br>
                                        <input type="checkbox" id="200-400" name="calories" value="400">
                                        <label for="200-400">Moins de 400</label><br>
                                        <input type="checkbox" id="400-600" name="calories" value="600">
                                        <label for="400-600">Moins de 600</label><br>
                                        <input type="checkbox" id="600-800" name="calories" value="800">
                                        <label for="600-800">Moins de 800</label><br>
                                        <input type="checkbox" id="plus-800" name="calories" value="999000">
                                        <label for="plus-800">Tous</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">Fête</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="aid al fitr" name="fete" value="aid al fitr">
                                        <label for="aid al fitr">aid al fitr</label><br>
                                        <input type="checkbox" id="aid al adha" name="fete" value="aid al adha">
                                        <label for="aid al adha">aid al adha</label><br>
                                        <input type="checkbox" id="all" name="fete" value="all">
                                        <label for="all">Tous</label><br>
                                    </div>
                                </div>
                                <div class="filter-item">
                                    <p class="H6">healthy</p>
                                    <div class="filter-item-content">
                                        <input type="checkbox" id="healthy" name="healthy" value="1">
                                        <label for="healthy">healthy</label><br>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="prm-btn" value="Appliquer">
                            </div>
                        </form>
                    </div>

                    <?php
                    $keys = array_keys($filter);
                    foreach ($keys as $key) {
                        if ($filter[$key] != "") {
                    ?>
                            <button class="secondary-btn"><?php if (is_array($filter[$key])) {
                                                                echo $key;
                                                            } else {
                                                                echo $key . '' . $filter[$key];
                                                            } ?></button>
                <?php
                        }
                    }
                } ?>

            </div>
            <div class="list-grid">
                <?php
                foreach ($List as $Card) {
                    $this->card($Card, $type);
                }
                ?>
            </div>
        </div>
    <?php
    }
    public function profile($profile)
    {
    ?>
        <div class="profile">
            <div class="profile-header">
                <img src="Utils/assets/pdp.jpg" alt="pdp">
                <div class="horizontale-container">
                    <div class="profile-info">
                        <p class="H4"><?php echo $profile['nom'] . " " . $profile['prenom'] ?></p>
                        <p class="H6"><?php echo $profile['email'] ?></p>
                        <p><span class="H6">Sexe: </span>&nbsp;<?php echo $profile['sexe'] ?></p>
                        <p><span class="H6">Date de naissance: </span>&nbsp;<?php echo $profile['dateNaissance'] ?></p>
                    </div>
                    <input type="button" value="editer">
                </div>
            </div>
            <div class="profile-body">
                <div class="verticale-container">
                    <div class="category-header">
                        <p class="H6">
                            Mes recettes
                        </p>
                        <input type="button" value="ajouter une recette" class="secondary-btn" id="add-recipe">
                    </div>
                    <div class="category-body">
                        <div class="list-view">
                            <?php
                            foreach ($profile['recettes'] as $Card) {
                                $this->card($Card, 'recettes');
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="popout">
                    <form action="index.php?action=addRecipe" class="popout-container" method="post" enctype="multipart/form-data" id="add-recipe">
                        <h3 class="H4">Ajouter recette</h3>
                        <label for="titre" class="H6">titre</label>
                        <input type="text" name="titre" id="titre">
                        <label for="description" class="H6">description</label>
                        <input type="text" name="description" id="description">
                        <label for="image" class="H6">image</label>
                        <input type="file" name="image" id="image">
                        <label for="video" class="H6">video</label>
                        <input type="file" name="video" id="video">
                        <label for="tempsPreparation" class="H6">temps de preparation</label>
                        <input type="number" name="tempsPreparation" id="tempsPreparation" min="0">
                        <label for="tempsRepo" class="H6">temps de Repos</label>
                        <input type="number" name="tempsRepo" id="tempsRepo" min="0">
                        <label for="tempsCuisson" class="H6">temps de cuisson</label>
                        <input type="number" name="tempsCuisson" id="tempsCuisson" min="0">
                        <label for="difficulte" class="H6">difficulte</label>
                        <select name="difficulte" id="difficulte">
                            <option value="facile">facile</option>
                            <option value="moyen">moyen</option>
                            <option value="difficile">difficile</option>
                        </select>
                        <label for="categorie" class="H6">categorie</label>
                        <select name="categorie" id="categorie">
                            <option value="1">plat</option>
                        </select>
                        <label for="calories" class="H6">calories</label>
                        <input type="number" name="calories" id="calories" min="0">
                        <label for="steps" class="H6">steps</label>
                        <input type="text" name="steps" id="steps" placeholder="step1,step2,step3...">
                        <label for="ingredients" class="H6">ingredients</label>
                        <input type="text" name="ingredients" id="ingredients" placeholder="ing1:mode:nb:healthy,ingredient2:modeCuisson:nb..." multiple list="ingredient-list">
                        <datalist id="ingredient-list">
                        </datalist>
                        <label for="fete" class="H6">fete</label>
                        <input type="text" name="fete" id="fete" placeholder="fete1,fete2,fete3..." multiple list="fete-list">
                        <datalist id="fete-list">
                            <option value="noel">
                            <option value="halloween">
                            <option value="anniversaire">
                            <option value="ramadan">
                            <option value="eid">
                        </datalist>
                        <div class="horizantale-container">
                            <button class="Secondary-btn" id="close-popout">
                                annuler
                            </button>
                            <button class="prm-btn" id="validate-btn">
                                ajouter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="verticale-container">
                    <div class="horizontale-container">
                        <p class="H6">
                            Les recettes favorisées
                        </p>
                    </div>
                    <div class="category-body">
                        <div class="list-view">
                            <?php
                            foreach ($profile['recettefav'] as $Card) {
                                $this->card($Card, 'recettes');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    public function auth()
    {
    ?>
        <div class="horizontale-container">
            <object data="Utils/Logo.jpg" class="auth-logo"></object>
            <div class="form">
                <form method="post" action="index.php?action=loginHandler" class="active login">
                    <h3>Connecter-vous</h3>
                    <div class="verticale-container">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="verticale-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>
                    <input type="submit" value="Se connecter" class="prm-btn">
                    <p>vous n'avez pas de compte? <span id="login-switch">S'inscrire</span></p>
                </form>
                <form method="post" action="index.php?action=registerHandler" class="register">
                    <h3>S'inscrire</h3>
                    <div class="horizontale-container">
                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" placeholder="votre nom">
                        </div>
                        <div>
                            <label for="prenom">prenom</label>
                            <input type="text" name="prenom" placeholder="votre prenom">
                        </div>
                    </div>
                    <div class="verticale-container">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="verticale-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>
                    <div class="verticale-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>
                    <div class="verticale-container">
                        <label for="pdp">photo de profile</label>
                        <input type="file" name="pdp" id="pdp" accept=".png,.jpg" disabled>
                    </div>
                    <div class="verticale-container">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" id="sexe">
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                        </select>
                    </div>

                    <div class="verticale-container">
                        <label for="date">Date de naissance</label>
                        <input type="date" name="date" id="date">
                    </div>
                    <input type="submit" value="S'inscrire" class="prm-btn">
                    <p>vous avez deja un compte? <span id="register-switch">S'identifier</span></p>
                </form>
            </div>
        </div>
    <?php
    }
    public function contact()
    {
    ?>
        <div class="horizontale-container">
            <div class="contact-header">
                <object data="Utils/Logo.jpg" class="auth-logo"></object>
            </div>
            <div class="contact-body">
                <h1>Contactez-nous</h1>
                <div class="verticale-container">
                    <div class="horizantale-container">
                        <a href="https://www.facebook.com/">
                            <object data="Utils/facebook.png" class="social-media-icon"></object>
                            Dz Cook
                        </a>
                    </div>
                    <div class="horizantale-container">
                        <a href="https://www.instagram.com/">
                            <object data="Utils/instagram.png" class="social-media-icon"></object>
                            Dz_Cook
                        </a>
                    </div>
                    <div class="horizantale-container">
                        <a href="https://www.linkedin.com/">
                            <object data="Utils/linkedin.png" class="social-media-icon"></object>
                            Dz Cook
                        </a>
                    </div>
                    <div class="horizantale-container">
                        <a href="mailto:js_boudaoud@esi.dz">
                            <object data="Utils/gmail.png" class="social-media-icon"></object>
                            js_boudaoud@esi.dz
                        </a>
                    </div>
                    <div class="horizantale-container">
                        <a href="tel:+213 659 182 608">
                            <object data="Utils/phone.png" class="social-media-icon"></object>
                            +213 659 182 608
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}
?>