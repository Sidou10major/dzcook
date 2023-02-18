<?php
require_once __DIR__ . '/popout.php';
class adminComponent
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
            <script src="https://code.jquery.com/jquery-3.6.3.min.js" ></script>
            <script src="index.js"></script>

        </head>
    <?php
    }
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
                <li><a href="index.php?action=mentoring&page=diaporama">Params</a></li>
                <li><a href="index.php?action=mentoring&page=params">Config</a></li>
            </ul>
            <div class="call-action">
                <a href="/dzcook/client/index.php" target="_blank" class="secondary-btn">Visiter Site</a>
                <?php
                if (isset($_SESSION['admin'])) {
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
        $popout = new Popout();
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
                            foreach ($list[0] as $key => $value) {
                                echo "<th scope='col'>" . $key . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $key => $value) {
                            echo "<tr>";
                            echo "<form method='post' action='index.php?action=update".$type."'>";
                            foreach ($value as $key => $valuee) {
                                if (!is_array($valuee)) {
                                    echo "<td><input type='text' name='".$key."' value='" . $valuee . "'></input></td>";
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
                                <button type="submit" class="Secondary-btn edit" data-id="<?php echo  $value['id'] ?>" data-type="<?php echo $type ?>">Modifier</button>
                            </td>
                            <td>
                                <button class="Secondary-btn delete" data-id="<?php echo $value['id'] ?>" id="supprimer" data-type="<?php echo $type ?>">Supprimer</button>
                            </td>
                        <?php
                            echo '</form>';
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
                            console.log(type);
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
                    btns = document.querySelectorAll('.edit');
                    btns.forEach(element => {
                        element.addEventListener('click', function(e) {
                            
                            <?php echo $type?>;
                
                            <?php echo $type?>;
                            
                        })
                    });
                </script>
                <?php
                switch ($type) {
                    case 'recipes':
                        $popout->addRecipe($type);
                        break;
                    case 'ingredients':
                        $popout->addIngredient($type);
                        break;
                    case 'params':
                        $popout->addParams($type);
                        break;
                    case 'news':
                        $popout->addNews($type);
                        break;
                    case 'newsPage':
                        $popout->addNewsPage($type);
                        break;
                    case 'diaporama':
                        $popout->addDiaporama($type);
                        break;
                    case 'users':
                        $popout->addUser($type);
                        break;
                    case 'categories':
                        $popout->addCategorie($type);
                        break;
                }
                ?>
            </div>
        </div>
    <?php
    }
    public function auth()
    {
    ?>
        <div class="horizontale-container">
            <div class="form">
                <form method="post" action="index.php?action=loginHandler" class="login">
                    <h3>Connecter-vous</h3>
                    <div class="verticale-container">
                        <label for="username">username</label>
                        <input type="text" name="username" placeholder="username">
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