<?php
require_once __DIR__ . '/../Views/adminComponent.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/diaporama.php';
require_once __DIR__ . '/../Models/recipe.php';
require_once __DIR__ . '/../Models/ingredient.php';
require_once __DIR__ . '/../Models/Category.php';
require_once __DIR__ . '/../Models/news.php';
require_once __DIR__ . '/../Models/newsPage.php';
require_once __DIR__ . '/../Models/admin.php';
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
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $this->adminComponent->head('Login Page','auth page');
            $this->adminComponent->auth();
        }
        public function dashboard(){
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $this->adminComponent->head('Dashboard', 'admin dashboard for wasfati');
            $this->adminComponent->navbar();
            $this->adminComponent->dashboard();
        }
        public function mentoring(){
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
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

        $email = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));
        $adminModel = new adminModel();
        $admin = $adminModel->login($email, $password);
        if ($admin) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['admin'] = $admin;
            header('Location: index.php');
        } else {
            header('Location: index.php?action=authDisplay');
        }
    }
    public function logoutHandler()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php');
    }
    public function validation(){
        if(isset($_POST['type'])){
            $type=$_POST['type'];
        }else{
            $type='';
        }
        switch ($type){
            case 'users':
                $this->validerUser();
                break;
            case 'recipes':
                $this->validerRecette();
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
    public function getRecipes()
    {
        $Model = new recipeModel();
        $recipes = $Model->getRecipes();
        return $recipes;
    }
    public function getFete()
    {
        $Model = new recipeModel();
        $fetes = $Model->getFete();
        return $fetes;
    }
    public function getIngredients()
    {
        $Model = new ingredientModel();
        $ingredients = $Model->getIngredients();
        return $ingredients;
    }
    public function getCategories()
    {
        $Model = new categoryModel();
        $categories = $Model->getCategories();
        return $categories;
    }
    public function getDiaporama()
    {
        $Model = new diaporamaModel();
        $diaporama = $Model->getDiaporama();
        return $diaporama;
    }
    public function getNewsPage()
    {
        $Model = new newsPageModel();
        $news = $Model->getNewsPage();
        return $news;
    }
    public function getParams()
    {
        $Model = new paramsModel();
        $params = $Model->getParams();
        return $params;
    }
    public function getSaison()
    {
        $Model = new saisonModel();
        $saisons = $Model->getSaisons();
        return $saisons;
    }
    
    public function getNews()
    {
        $Model = new newsModel();
        $news = $Model->getNews();
        return $news;
    }
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
        $index = 1;
        $step['recetteID']=$id;
        foreach ($step as $value) {
            $step['etape']=$index;
            $step['description']=$value;
            $Model->addStep($step);
            $index += 1;
        }
        $ingredientModel = new ingredientModel();
        $composentModel = new composentModel();
        foreach ($ingredient as $value) {
            $input = explode(":", $value);
            $ingredient["titre"] = $input[0];
            $ingredient["imgPath"] = "";
            $ingredient["healthy"] = $input[3];
            $ingredientID = $ingredientModel->addIngredient($ingredient);
            $mode = $composentModel->addModeCuisson($input[1]);
            $composent['recetteID'] = $id;
            $composent['ingredientID'] = $ingredientID;
            $composent['quantite'] = $input[2];
            $composent['modeID'] = $mode;
            $composentModel->addComposent($composent);
        }
        foreach ($fetes as $value) {
            $feteID = $Model->addFete($value);
            $Model->addFeteRecipe($feteID, $id);
        }

        header('Location: index.php');
    }
    public function addNews(){
        if(!(isset($_POST['titre'])&&isset($_POST['description']))){
            header('Location: index.php');
        }
        $news['titre'] = strip_tags(trim($_POST['titre']));
        $news['description'] = strip_tags(trim($_POST['description']));
        $news['imgPath'] = $this->uploadFile($_FILES['image']);
        $news['videoPath'] = $this->uploadFile($_FILES['video']);
        $Model = new newsModel();
        $Model->addNews($news);
        header('Location: index.php?action=mentoring&page=news');
    }
    public function addIngredient(){
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $ingredient['titre'] = strip_tags(trim($_POST['titre']));
        $ingredient['originSaison'] = intval($_POST['saison']);
        $ingredient['dispoSaison'] = strip_tags(trim($_POST['dispoSaison']));
        $ingredient['infonutritionnelle'] = $_POST['infonutritionnelle'];
        $ingredient['imgPath'] = $this->uploadFile($_FILES['image']);
        $ingredient['healthy'] = intval($_POST['healthy']);
        $ingredient['dispoSaison']=explode(',', $ingredient['dispoSaison']);
        $ingredient['infonutritionnelle']=explode(',',$ingredient['infonutritionnelle']);
        $Model = new ingredientModel();
        $id=$Model->addIngredient($ingredient);
        $dipo['id']=$id;
        foreach ($ingredient['dispoSaison'] as $value) {
            $dipo['saison']=intval($value);
            $Model->addDispo($dipo);
        }
        $nurition['id']=$id;
        foreach ($ingredient['infonutritionnelle'] as $value) {
            $input=explode(':',$value);
            $nurition['titre']=$input[0];
            $nurition['description']=$input[1];
            $Model->addNutrition($nurition);
        }
        header('Location: index.php?action=mentoring&page=ingredients');
    }
    public function addNewsPage(){
        if(!isset($_POST['url'])){
            header('Location: index.php');
        }
        $page['newsID']=($_POST['newsID']);
        $page['recetteID']=($_POST['recetteID']);
        if($page['recetteID']==0){
            $page['recetteID']=null;
        }
        if($page['newsID']==0){
            $page['newsID']=null;
        }
        $page['url'] = strip_tags(trim($_POST['url']));
        $Model = new newsPageModel();
        $Model->addNewsPage($page);
        header('Location: index.php?action=mentoring&page=newsPage');
    }
    public function addDiaporama(){
        if(!isset($_POST['url'])){
            header('Location: index.php');
        }
        $page['newsID']=($_POST['newsID']);
        $page['recetteID']=($_POST['recetteID']);
        if($page['recetteID']==0){
            $page['recetteID']=null;
        }
        if($page['newsID']==0){
            $page['newsID']=null;
        }
        $page['url'] = strip_tags(trim($_POST['url']));
        $Model = new diaporamaModel();
        $Model->addDiaporama($page);
        header('Location: index.php?action=mentoring&page=diaporama');
    }
    public function addCategorie()
    {
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $titre = strip_tags(trim($_POST['titre']));
        $model= new categoryModel();
        $model->addCategory($titre);
        header('Location: index.php?action=mentoring&page=categories');
    }
    public function addFete()
    {
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $titre = strip_tags(trim($_POST['titre']));
        $model= new recipeModel();
        $model->addFete($titre);
        header('Location: index.php?action=mentoring&page=fetes');
    }
    public function addParams(){
        if(!(isset($_POST['cle']))){
            header('Location: index.php');
        }
        $param['cle'] = strip_tags(trim($_POST['cle']));
        $param['valeur'] = strip_tags(trim($_POST['valeur']));
        $Model = new paramsModel();
        $Model->addParams($param);
        header('Location: index.php?action=mentoring&page=params');
    }
    public function updateusers(){
        if(!(isset($_POST['email']))){
            header('Location: index.php');
        }
        $user['id']=$_POST['id'];
        $user['nom'] = strip_tags(trim($_POST['nom']));
        $user['prenom'] = strip_tags(trim($_POST['prenom']));
        $user['email'] = strip_tags(trim($_POST['email']));
        $user['dateNaissance'] = strip_tags(trim($_POST['dateNaissance']));
        $user['sexe']= strip_tags(trim($_POST['sexe']));
        $Model = new userModel();
        $Model->updateUser($user);
        header('Location: index.php?action=mentoring&page=users');
    }
    public function updaterecipes()
    {
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $recette['id']=$_POST['id'];
        $recette['titre'] = strip_tags(trim($_POST['titre']));
        $recette['categorieID'] = strip_tags(trim($_POST['categorieID']));
        $recette['state'] = intval(strip_tags(trim($_POST['state'])));
        $recette['imgPath'] = strip_tags(trim($_POST['imgPath']));
        $recette['videoPath'] = strip_tags(trim($_POST['videoPath']));

        $Model = new recipeModel();
        $Model->updateRecipe($recette);
        header('Location: index.php?action=mentoring&page=recipes');
    }
    public function updatesaison(){
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $saison['id']=$_POST['id'];
        $saison['titre'] = strip_tags(trim($_POST['titre']));
        $Model = new saisonModel();
        $Model->updateSaison($saison);
        header('Location: index.php?action=mentoring&page=saisons');
    }
    public function updateNews(){
        if(!(isset($_POST['titre'])&&isset($_POST['description']))){
            header('Location: index.php');
        }
        $news['id']=$_POST['id'];
        $news['titre'] = strip_tags(trim($_POST['titre']));
        $news['description'] = strip_tags(trim($_POST['description']));
        $news['imgPath'] = ($_POST['imgPath']);
        $news['videoPath'] = ($_POST['videoPath']);
        $Model = new newsModel();
        $Model->updateNews($news);
        header('Location: index.php?action=mentoring&page=news');
    }
    public function updateingredients(){
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $ingredient['id']=$_POST['id'];
        $ingredient['titre'] = strip_tags(trim($_POST['titre']));
        $ingredient['originSaison'] = intval($_POST['saison']);
        $ingredient['imgPath'] = ($_POST['imgPath']);
        $ingredient['healthy'] = intval($_POST['healthy']);
        $Model = new ingredientModel();
        $Model->updateIngredient($ingredient);
        header('Location: index.php?action=mentoring&page=ingredient');
    }
    public function updatecategories(){
        if(!(isset($_POST['titre']))){
            header('Location: index.php');
        }
        $categorie['id']=$_POST['id'];
        $categorie['titre'] = strip_tags(trim($_POST['titre']));
        $model= new categoryModel();
        $model->updateCategory($categorie);
        header('Location: index.php?action=mentoring&page=categories');
    }
    public function updateDiaporama(){
        if(!(isset($_POST['url']))){
            header('Location: index.php');
        }
        $page['id']=$_POST['id'];
        $page['newsID']=($_POST['newsID']);
        $page['recetteID']=($_POST['recetteID']);
        if($page['recetteID']==0){
            $page['recetteID']=null;
        }
        if($page['newsID']==0){
            $page['newsID']=null;
        }
        $page['url'] = strip_tags(trim($_POST['url']));
        $Model = new diaporamaModel();
        $Model->updateDiaporama($page);
        header('Location: index.php?action=mentoring&page=diaporama');
    }
    public function updateNewsPage(){
        if(!(isset($_POST['url']))){
            header('Location: index.php');
        }
        $page['id']=$_POST['id'];
        $page['newsID']=($_POST['newsID']);
        $page['recetteID']=($_POST['recetteID']);
        if($page['recetteID']==0){
            $page['recetteID']=null;
        }
        if($page['newsID']==0){
            $page['newsID']=null;
        }
        $page['url'] = strip_tags(trim($_POST['url']));
        $Model = new newsPageModel();
        $Model->updateNewsPage($page);
        header('Location: index.php?action=mentoring&page=newsPage');
    }
    public function updateParams(){
        if(!(isset($_POST['cle'])&&isset($_POST['valeur']))){
            header('Location: index.php');
        }
        $param['id']=$_POST['id'];
        $param['cle'] = strip_tags(trim($_POST['cle']));
        $param['valeur'] = strip_tags(trim($_POST['valeur']));
        $Model = new paramsModel();
        $Model->updateParams($param);
        header('Location: index.php?action=mentoring&page=params');
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
    public function getOnerecipes()
    {
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            $model = new recipeModel();
            $recipe = $model->getRecipe($id,null);
            return json_encode($recipe);
        }else{
            header('Location: index.php');
        }
    }
}
