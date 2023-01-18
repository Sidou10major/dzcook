<?php
require_once __DIR__ . '/../Views/userComponent.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/diaporama.php';
require_once __DIR__ . '/../Models/recipe.php';
require_once __DIR__ . '/../Models/ingredient.php';
require_once __DIR__ . '/../Models/Category.php';
require_once __DIR__ . '/../Models/news.php';
require_once __DIR__ . '/../Models/newsPage.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/files.php';
require_once __DIR__ . '/../Models/composent.php';
class userController
{
    protected $userComponents;
    public function __construct()
    {
        $this->userComponents = new userComponents();
    }
    public function authDisplay()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $this->userComponents->head("Auth page", "a page for auth");
        $this->userComponents->navbar();
        $this->userComponents->auth();
        $this->userComponents->footer();
    }
    public function profileDisplay()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $profile = $this->getProfile();
        $this->userComponents->head("Profile Page", "a page for profile");
        $this->userComponents->navbar();
        $this->userComponents->profile($profile);
        $this->userComponents->footer();
    }
    public function indexDisplay()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $this->userComponents->head("Home page", "a page for home");
        $this->userComponents->navbar();
        $this->userComponents->swipper($this->getDiaporama());
        $this->userComponents->categories($this->getCategories());
        $this->userComponents->footer();
    }
    public function detailDisplay()
    {
        $type = $_GET['type'];
        $recipeID = $_GET['id'];
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $id = null;
        if(isset($_SESSION['user'])){
            $id = $_SESSION['user']['userID'];
        }
        if ($type == "news") {
            $data = $this->getNewsById(intval($recipeID));
        } else if ($type == "recettes") {
            $data = $this->getRecipeById(intval($recipeID), $id);
        }
        $this->userComponents->head($data['titre'], $data['description']);
        $this->userComponents->navbar();
        $this->userComponents->detailPage($data);
        $this->userComponents->footer();
    }
    public function listDisplay()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $params = $_GET['type'];
        $filter = [];
        if (isset($_GET['difficulte'])) {
            $filter['difficulte'] = $_GET['difficulte'];
        }
        if (isset($_GET['timePreparation'])) {
            $filter['timePreparation'] = intval($_GET['timePreparation']);
        }
        if (isset($_GET['timeRepo'])) {
            $filter['timeRepo'] = intval($_GET['timeRepo']);
        }
        if (isset($_GET['timeCuisson'])) {
            $filter['timeCuisson'] = intval($_GET['timeCuisson']);
        }
        if (isset($_GET['typePlat'])) {
            $filter['typePlat'] = $_GET['typePlat'];
        }
        if (isset($_GET['saison'])) {
            $filter['saison'] = $_GET['saison'];
        }
        if (isset($_GET['note'])) {
            $filter['note'] = intval($_GET['note']);
        }
        if (isset($_GET['calories'])) {
            $filter['calories'] = intval($_GET['calories']);
        }
        if (isset($_GET['healthy'])) {
            $filter['healthy'] = $_GET['healthy'];
        }
        if (isset($_GET['fete'])) {
            $filter['fete'] = $_GET['fete'];
        }
        if (isset($_POST['ingredients'])) {
            $filter['ingredients'] = explode(',', $_POST['ingredients']);
        }
        switch ($params) {
            case 'news':
                $data = $this->getNewsPage();
                break;
            case 'recettes':
                $data = $this->getRecipes();
                break;
            case 'nutrition':
                $data = $this->getIngredients();
                break;
        }
        $data = $this->filterRecipes($data, $filter);
        $this->userComponents->head("list page", "a page for list");
        $this->userComponents->navbar();
        $this->userComponents->listView($data, $params, $filter, $data);
        $this->userComponents->footer();
    }
    public function contactDisplay()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $this->userComponents->head("Contact page", "a page for contact");
        $this->userComponents->navbar();
        $this->userComponents->contact();
        $this->userComponents->footer();
    }

    public function loginHandler()
    {
        $email = strip_tags(trim($_POST['email']));
        $password = strip_tags(trim($_POST['password']));
        $userModel = new userModel();
        $user = $userModel->login($email, $password);
        if ($user) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }

            $_SESSION['user'] = $user;
            header('Location: index.php?action=indexDisplay');
        } else {
            header('Location: index.php?action=authDisplay');
        }
    }
    public function logoutHandler()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION)) session_destroy();
        header('Location: index.php?action=indexDisplay');
    }
    public function registerHandler()
    {
        $user['email'] = strip_tags(trim($_POST['email']));
        $user['password'] = strip_tags(trim($_POST['password']));
        $user['nom'] = strip_tags(trim($_POST['nom']));
        $user['prenom'] = strip_tags(trim($_POST['prenom']));
        $user['dateNaissance'] = strip_tags(trim($_POST['date']));
        $user['sexe'] = strip_tags(trim($_POST['sexe']));
        $user['pdp'] = strip_tags(trim($_POST['pdp']));
        $userModel = new userModel();
        $user = $userModel->register($user);
        if ($user) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }

            $_SESSION['user'] = $user;
            header('Location: index.php?action=indexDisplay');
        } else {
            header('Location: index.php?action=authDisplay');
        }
    }
    // get recipes
    public function getRecipes()
    {
        $Model = new recipeModel();
        $recipes = $Model->getRecipesFiltered();
        return $recipes;
    }
    // get recipe by id
    public function getRecipeById($id, $userID)
    {
        $id = strip_tags(trim($id));
        $Model = new recipeModel();
        $recipe = $Model->getRecipe($id, $userID);
        return $recipe;
    }
    // get nurition
    public function getIngredients()
    {
        $Model = new ingredientModel();
        $ingredients = $Model->getIngredients();
        return $ingredients;
    }
    // get profile
    public function getProfile()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $id = strip_tags(trim($_SESSION['user']['userID']));
        $Model = new userModel();
        $user = $Model->getUserById($id);
        return $user;
    }
    // get categories
    public function getCategories()
    {
        $Model = new categoryModel();
        $categories = $Model->getCategories();
        return $categories;
    }
    // get diaporama
    public function getDiaporama()
    {
        $Model = new diaporamaModel();
        $diaporama = $Model->getDiaporama();
        return $diaporama;
    }
    //get news by id
    public function getNewsById($id)
    {
        $id = strip_tags(trim($id));
        $Model = new newsModel();
        $news = $Model->getNewsById($id);
        return $news;
    }
    //get newsPage
    public function getNewsPage()
    {
        $Model = new newsPageModel();
        $news = $Model->getNewsPage();
        return $news;
    }
    //get params
    public function getParams()
    {
        $Model = new paramsModel();
        $params = $Model->getParams();
        return $params;
    }
    //get saison
    public function getSaison()
    {
        $Model = new saisonModel();
        $saisons = $Model->getSaisons();
        return $saisons;
    }
    //get fete
    public function getFete()
    {
        $Model = new recipeModel();
        $fetes = $Model->getFete();
        return $fetes;
    }
    //add recipe
    public function addRecipe()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(!(isset($_POST['titre'])&&isset($_POST['description'])&&isset($_POST['tempsPreparation'])&&isset($_POST['tempsRepo'])&&isset($_POST['tempsCuisson'])&&isset($_POST['categorie'])&&isset($_POST['calories'])&&isset($_POST['difficulte']))){
            header('Location: index.php?action=profileDisplay');
        }
        $titre = strip_tags(trim($_POST['titre']));
        $description = strip_tags(trim($_POST['description']));
        $timePreparation = intval($_POST['tempsPreparation']);
        $timeRepo = intval($_POST['tempsRepo']);
        $timeCuisson = intval($_POST['tempsCuisson']);
        $imgPath = $this->uploadFile($_FILES['image']);
        $videoPath = $this->uploadFile($_FILES['video']);
        $categorieID = intval($_POST['categorie']);
        $calories = intval($_POST['calories']);
        $difficulte = strip_tags(trim($_POST['difficulte']));
        $userID = ($_SESSION['user']['userID']);
        $step = explode(",", $_POST['steps']);
        $ingredient = explode(",", $_POST['ingredients']);
        $fetes = explode(",", $_POST['fete']);
        $Model = new recipeModel();
        $id = $Model->addRecipe($titre, $categorieID, $difficulte, $timePreparation, $timeRepo, $timeCuisson, $imgPath, $videoPath, $calories, $description, $userID);
        // create recipe steps
        $index = 1;
        foreach ($step as $value) {
            $Model->addStep($id, $index, $value);
            $index += 1;
        }
        $ingredientModel = new ingredientModel();
        $composentModel = new composentModel();
        // create recipe ingredients
        foreach ($ingredient as $value) {
            $input = explode(":", $value);
            $ingredient["titre"] = $input[0];
            $ingredient["imgPath"] = "";
            $ingredient["healthy"] = $input[3];
            $ingredientID = $ingredientModel->addIngredient($ingredient);
            $mode = $composentModel->addModeCuisson($input[1]);
            // add to composent
            $composent['recetteID'] = $id;
            $composent['ingredientID'] = $ingredientID;
            $composent['quantite'] = $input[2];
            $composent['modeID'] = $mode;
            $composentModel->addComposent($composent);
        }
        // create recipe fetes
        foreach ($fetes as $value) {
            $feteID = $Model->addFete($value);
            $Model->addFeteRecipe($feteID, $id);
        }

        header('Location: index.php');
    }

    public function rateRecipe()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        $id = strip_tags(trim($_POST['id']));
        $note = intval(strip_tags(trim($_POST['note'])));
        $userID = $_SESSION['user']['userID'];
        $Model = new recipeModel();
        $recipe = $Model->rateRecipe($id, $note, $userID);
        return $recipe;
    }

    public function filterRecipes($result, $filter)
    {
        // Filter by categorie

        if (isset($filter['typePlat'])) {
            foreach ($result as $key => $value) {
                if ($value['categorie'] != $filter['typePlat']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by saison
        if (isset($filter['saison'])) {
            foreach ($result as $key => $value) {
                $found = false;
                foreach ($value['saison'] as $saison) {
                    if ($saison['titre'] == $filter['saison']) {
                        $found = true;
                    }
                }
                if (!$found) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by tempsPreparation
        if (isset($filter['tempsPreparation']) && $filter['tempsPreparation'] != 0) {
            foreach ($result as $key => $value) {
                if ($value['timePreparation'] > $filter['timePreparation']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by tempsRepo
        if (isset($filter['timeRepo']) && $filter['timeRepo'] != 0) {
            foreach ($result as $key => $value) {
                if ($value['tempsRepo'] > $filter['timeRepo']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by tempsCuisson
        if (isset($filter['timeCuisson']) && $filter['timeCuisson'] != 0) {
            foreach ($result as $key => $value) {
                if ($value['tempsCuisson'] > $filter['timeCuisson']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by difficulte
        if (isset($filter['difficulte'])) {
            foreach ($result as $key => $value) {
                if ($value['difficulte'] !== $filter['difficulte']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by calories

        if (isset($filter['calories']) && $filter['calories'] != 0) {
            foreach ($result as $key => $value) {
                if ($value['calories'] > $filter['calories']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by rate
        if (isset($filter['note']) && $filter['note'] != 0) {
            foreach ($result as $key => $value) {
                if ($value['rate'] < $filter['note']) {
                    unset($result[$key]);
                }
            }
        }
        // Filter Healthy
        if (isset($filter['healthy']) && $filter['healthy'] == 1) {
            foreach ($result as $key => $value) {
                if ($value['healthy'] == 0) {
                    unset($result[$key]);
                }
            }
        }

        //Filter Fete
        if (isset($filter['fete'])) {
            foreach ($result as $key => $value) {
                $found = false;
                if ($filter['fete'] == "all") {
                    if (count($value['fete']) > 0) {
                        $found = true;
                    }
                } else {
                    foreach ($value['fete'] as $fete) {
                        if ($fete['titre'] == $filter['fete']) {
                            $found = true;
                            break;
                        }
                    }
                }
                if (!$found) {
                    unset($result[$key]);
                }
            }
        }
        // Filter by ingredients
        if (isset($filter['ingredients'])) {
            foreach ($result as $key => $value) {
                $found = 0;
                foreach ($value['ingredients'] as $ingredient) {
                    if (in_array($ingredient['titre'], $filter['ingredients'])) {
                        $found = $found + 1;
                    }
                }
                if (count($value['ingredients']) == 0) {
                    unset($result[$key]);
                } else if ($found < 0.7 * count($value['ingredients'])) {
                    unset($result[$key]);
                }
            }
        }
        return $result;
    }
    public function getFeteRecipes()
    {
        $Model = new recipeModel();
        $recipes = $Model->getFeteRecipes();
        return $recipes;
    }
    public function uploadFile($uploadFile)
    {
        $model = new filesModel();
        return $model->uploadFile($uploadFile);
    }
}
?>