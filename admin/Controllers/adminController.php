<?php
require_once __DIR__ . '/../Views/adminComponent.php';
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
require_once __DIR__ . '/../Models/params.php';
    class adminController{
        protected $adminComponent;
        public function __construct()
        {
            $this->adminComponent = new adminComponent();
        }
        public function authDisplay(){
            $this->adminComponent->auth();
        }
        public function dashboard(){
            $this->adminComponent->head('Dashboard', 'admin dashboard for wasfati');
            $this->adminComponent->navbar();
            $this->adminComponent->dashboard();
        }
        public function mentoring(){
            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page='';
            }
            switch ($page){
                case 'recipes':
                    $data=$this->getRecipes();
                    break;
                case 'news':
                    $data=$this->getNews();
                    break;
                case 'ingredients':
                    $data=$this->getIngredients();
                    break;
                case 'diaporama':
                    $data=$this->getDiaporama();
                    break;
                case 'newsPage':
                    $data=$this->getNewsPage();
                    break;
                case 'users':
                    $data=$this->getUsers();
                    break;
                case 'params':
                    $data=$this->getParams();
                    break;
                case 'saison':
                    $data=$this->getSaison();
                    break;
                case 'categories':
                    $data=$this->getCategories();
                    break;
                default:
                    $data=$this->getRecipes();
                    break;

            }
            $this->adminComponent->head('mentoring', 'admin mentoring page for wasfati');
            $this->adminComponent->navbar();
            $this->adminComponent->mentoring($data, $page);
        }
        public function loginHandler()
    {
        $email = strip_tags(trim($_POST['email']));
        $password = strip_tags(trim($_POST['password']));
        $userModel = new userModel();
        $user = $userModel->login($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: indexDisplay');
        } else {
            header('Location: authDisplay');
        }
    }
    public function logoutHandler()
    {
        session_start();
        session_destroy();
        header('Location: indexDisplay');
    }
    public function validation(){
        if(isset($_POST['type'])){
            $type=$_POST['type'];
        }else{
            $type='';
        }
        switch ($type){
            case 'recipes':
                $data=$this->validerRecette();
                break;
            case 'users':
                $data=$this->validerUser();
                break;
        }
    }
    public function delete(){
        if(isset($_POST['type'])){
            $type=$_POST['type'];
        }else{
            $type='';
        }
        switch ($type){
            case 'recipes':
                $data=$this->deleteRecipe();
                break;
            case 'users':
                $data=$this->deleteUser();
                break;
            case 'news':
                $data=$this->deleteNews();
                break;
            case 'newsPage':
                $data=$this->deleteNewsPage();
                break;
            case 'diaporama':
                $data=$this->deleteDiaporama();
                break;
            case 'ingredients':
                $data=$this->deleteIngredient();
                break;
            case 'categories':
                $data=$this->deleteCategory();
                break;
            case 'saison':
                $data=$this->deleteSaison();
                break;
            case 'params':
                $data=$this->deleteParams();
                break;

        }
    }
    // get recipes
    public function getRecipes()
    {
        $Model = new recipeModel();
        $recipes = $Model->getRecipes();
        return $recipes;
    }
    //get fete
    public function getFete()
    {
        $Model = new recipeModel();
        $fetes = $Model->getFete();
        return $fetes;
    }
    // get nurition
    public function getIngredients()
    {
        $Model = new ingredientModel();
        $ingredients = $Model->getIngredients();
        return $ingredients;
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
    
    //get news
    public function getNews()
    {
        $Model = new newsModel();
        $news = $Model->getNews();
        return $news;
    }
    //get users
    public function getUsers()
    {
        $Model = new userModel();
        $users = $Model->getUsers();
        return $users;
    }
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
        $userID = null;
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
    public function uploadFile($uploadFile)
    {
        $model = new filesModel();
        return $model->uploadFile($uploadFile);
    }
    public function validerRecette()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new recipeModel();
            $model->validateRecipe($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function validerUser()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new userModel();
            $model->validateUser($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteRecipe()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new recipeModel();
            $model->deleteRecipe($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteUser()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new userModel();
            $model->deleteUser($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteNews()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new newsModel();
            $model->deleteNews($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteNewsPage()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new newsPageModel();
            $model->deleteNewsPage($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteSaison()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new saisonModel();
            $model->deleteSaison($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteIngredient()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new ingredientModel();
            $model->deleteIngredient($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteCategory()
    {
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new categoryModel();
            $model->deleteCategory($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }  
    public function deleteDiaporama(){
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new diaporamaModel();
            $model->deleteDiaporama($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }
    public function deleteParams(){
        if(isset($_POST['id'])){
            $id = intval($_POST['id']);
            $model = new paramsModel();
            $model->deleteParams($id);
            header('Location: index.php');
        }else{
            header('Location: index.php');
        }
    }

}
?>