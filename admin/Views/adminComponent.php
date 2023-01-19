<?php

class adminComponent
{
    // Contante attribute that hold the keywords of our website
    const KEYS = "dz, algerian, food, admin";

    // All the views has a function Head that hold the title and description
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
            <meta name="keywords" content=<?php echo self::KEYS ?> />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <link rel="stylesheet" href="style.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
            <script src="index.js"></script>

        </head>
    <?php
    }
    // All the views has a function navbar that hold the navbar
    public function navbar()
    {
    ?>
        <nav>
            <a href="index.php"><object data="Utils/svg/Logo.svg" class="nav-logo"></object></a>
            <ul class="menu">
                <li><a href="index.php?action=dashboard">Dashboard</a></li>
                <li><a href="index.php?action=mentoring&page=recipes">Recette</a></li>
                <li><a href="index.php?action=mentoring&page=news">News</a></li>
                <li><a href="index.php?action=mentoring&page=ingredients">Ingredients</a></li>
                <li><a href="index.php?action=mentoring&page=newsPage">NewsPage</a></li>
                <li><a href="index.php?action=mentoring&page=users">Users</a></li>
                <li><a href="index.php?action=mentoring&page=categories">Categories</a></li>
                <li><a href="index.php?action=mentoring&page=params">Params</a></li>
            </ul>
            <div class="call-action">
                <a href="index.php" target="_blank" class="secondary-btn">Visiter Site</a>

                <a href="?index.php?action=logout" class="prm-btn">Se deconnecter</a>
            </div>
        </nav>
    <?php
    }
    public function dashboard()
    {
    ?>
        <div class="dashboard-container">
            <div class="card-container">
                <img src="Utils/test.jfif" alt="Logo" class="card-img">
                <h5 class="card-title">Gestion des recettes</h5>
                <a href="index.php?action=mentoring&page=recipes" class="prm-btn">lire la suite >></a>
            </div>

            <div class="card-container">
                <img src="Utils/test.jfif" alt="Logo" class="card-img">
                <h5 class="card-title">Gestion des News</h5>
                <a href="index.php?action=mentoring&page=news" class="prm-btn">lire la suite >></a>
            </div>

            <div class="card-container">
                <img src="Utils/test.jfif" alt="Logo" class="card-img">
                <h5 class="card-title">La gestion des utilisateurs</h5>
                <a href="index.php?action=mentoring&page=users" class="prm-btn">lire la suite >></a>
            </div>

            <div class="card-container">
                <img src="Utils/test.jfif" alt="Logo" class="card-img">
                <h5 class="card-title">Gestion de la nutrition</h5>
                <a href="index.php?action=mentoring&page=ingredients" class="prm-btn">lire la suite >></a>
            </div>

            <div class="card-container">
                <img src="Utils/test.jfif" alt="Logo" class="card-img">
                <h5 class="card-title">Gestion du Paramètres</h5>
                <a href="index.php?action=mentoring&pgae=params" class="prm-btn">lire la suite >></a>
            </div>
        </div>

    <?php
    }
    public function mentoring($list, $type)
    {
        // table with filter 
    ?>
        <div class="view-container">
            <div class="verticale-container">
                <h3 class="title">Gestion des Mentoring</h3>
                <input type="button" value="Ajouter <?php echo $type ?>" class="prm-btn" id="add-form">
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <?php
                            foreach ($list as $key => $value) {
                                echo "<th scope='col'>" . $key . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $key => $value) {
                            // for each value
                            echo "<tr>";
                            foreach ($value as $key => $valuee) {
                                if (!is_array($valuee)) {
                                    echo "<td>" . $valuee . "</td>";
                                } else {
                                    echo "<td>";
                                    echo "";
                                    echo "</td>";
                                }
                            }
                        ?>
                            <?php
                            if ($type == "users" || $type == "recipes") {
                            ?>
                                <td>
                                    <button class="Secondary-btn valider" data-id="<?php echo $value['id'] ?>" data-type="<?php echo $type ?>">Valider</button>
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                                <button class="Secondary-btn" data-id="<?php echo  $value['id'] ?>" data-type="<?php echo $type ?>">Modifier</button>
                            </td>
                            <td>
                                <button class="Secondary-btn delete" data-id="<?php echo $value['id'] ?>" id="supprimer" data-type="<?php echo $type ?>">Supprimer</button>
                            </td>
                        <?php
                            echo "</tr>";
                        }
                        ?>
                </table>
                <script>
                    btns = document.querySelectorAll('.valider');
                    btns.forEach(element => {
                        element.addEventListener('click', function(e) {
                            let dataId = element.getAttribute('data-id');
                            let type = element.getAttribute('data-type');
                            $.ajax({
                                url: "index.php?action=validation",
                                type: "POST",
                                data: {
                                    id: dataId,
                                    type: type
                                },
                                success: function(data) {
                                    if (data) {
                                        alert('success');
                                    }
                                    location.reload();
                                }
                            })
                        })
                    });
                    btns = document.querySelectorAll('.delete');
                    btns.forEach(element => {
                        element.addEventListener('click', function(e) {
                            let dataId = element.getAttribute('data-id');
                            let type = element.getAttribute('data-type');
                            $.ajax({
                                url: "index.php?action=delete",
                                type: "POST",
                                data: {
                                    id: dataId,
                                    type: type
                                },
                                success: function(data) {
                                    if(data){
                                        alert('success');
                                    }
                                    location.reload();
                                }
                            })
                        })
                    });
                </script>
                <div class="popout">
                    <form action="index.php?action=addLogic" class="popout-container" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="<?php echo $type ?>">
                        <h3 class="H4">Ajouter <?php echo $type ?></h3>
                        <label for="titre" class="H6">titre</label>
                        <input type="text" name="titre" id="titre">
                        <label for="description" class="H6">description</label>
                        <input type="text" name="description" id="description">
                        <label for="image" class="H6">image</label>
                        <input type="file" name="image" id="image">
                        <label for="video" class="H6">video</label>
                        <input type="file" name="video" id="video">
                        <?php
                        if ($type == 'recipes') {
                        ?>
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
                        <?php
                        }
                        ?>
                        <div class="horizantale-container">
                            <button class="Secondary-btn" id="close-popout">
                                annuler
                            </button>
                            <button type="submit" class="prm-btn" id="validate-btn">
                                ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    public function auth()
    {
    ?>
        <div class="admin-auth">
            <object data="Utils/svg/Logo.svg" class="auth-logo"></object>
            <div class="form">
                <form method="post" action="loginHandler" class="login">
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
                </form>
            </div>
        </div>
<?php
    }
}
?>