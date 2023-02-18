<?php
class popOut
{
    public function addRecipe($type)
    {
?>
        <div class="popout">
            <form action="index.php?action=addRecipe" class="popout-container" method="post" enctype="multipart/form-data">
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
                    <option value="1">entree</option>
                    <option value="2">plat</option>
                    <option value="3">boisson</option>
                    <option value="4">dessert</option>
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
                    <button type="submit" class="prm-btn" id="validate-btn">
                        ajouter
                    </button>
                </div>
            </form>
        </div>
    <?php
    }
    public function addIngredient($type)
    {
    ?>
        <div class="popout">
            <form action="index.php?action=addIngredient" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="titre" class="H6">titre</label>
                <input type="text" name="titre" id="titre">
                <label for="saison" class="H6">origin saison</label>
                <input type="number" name="saison" id="saison">
                <label for="dispoSaison" class="H6">dispoSaison</label>
                <input type="text" name="dispoSaison" id="dispoSaison">
                <label for="infonutritionnelle" class="H6">infonutritionnelle</label>
                <input type="text" name="infonutritionnelle" id="infonutritionnelle">
                <label for="healthy" class="H6">healthy</label>
                <input type="checkbox" name="healthy" id="healthy" value="1">
                <label for="image" class="H6">image</label>
                <input type="file" name="image" id="image">
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
    <?php
    }
    public function addCategorie($type)
    {
    ?>
        <div class="popout">
            <form action="index.php?action=addCategorie" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="titre" class="H6">titre</label>
                <input type="text" name="titre" id="titre">
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
    <?php
    }
    public function addFete($type)
    {
    ?>
        <div class="popout">
            <form action="index.php?action=addRecipe" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="titre" class="H6">titre</label>
                <input type="text" name="titre" id="titre">
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
    <?php
    }
    public function addNewsPage($type)
    {
    ?>
        <div class="popout">
            <form action="index.php?action=addNewsPage" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="newsID" class="H6">newsID</label>
                <input type="number" name="newsID" id="newsID" default='0'> 
                <label for="recetteID" class="H6">recetteID</label>
                <input type="number" name="recetteID" id="recetteID" default='0'>
                <label for="url" class="H6">url</label>
                <input type="text" name="url" id="url">
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
    <?php
    }
    public function addDiaporama($type)
    {
    ?>
        <div class="popout">
            <form action="index.php?action=addDiaporama" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="newsID" class="H6">newsID</label>
                <input type="number" name="newsID" id="newsID" default='0'>
                <label for="recetteID" class="H6">recetteID</label>
                <input type="number" name="recetteID" id="recetteID" default='0'>
                <label for="url" class="H6">url</label>
                <input type="text" name="url" id="url">
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
<?php
    }
    public function addParams($type){
        ?>
        <div class="popout">
            <form action="index.php?action=addParams" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="cle" class="H6">cle</label>
                <input type="text" name="cle" id="cle">
                <label for="valeur" class="H6">valeur</label>
                <input type="text" name="valeur" id="valeur">
                <div class="horizantale-container">
                    <button class="Secondary-btn" id="close-popout">
                        annuler
                    </button>
                    <button type="submit" class="prm-btn" id="validate-btn">
                        ajouter
                    </button>
                </div>
            </form>
        <?php
    }
    public function addNews($type){
        ?>
            <div class="popout">
            <form action="index.php?action=addNews" class="popout-container" method="post" enctype="multipart/form-data">
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
        <?php
    }
    public function addUser($type){
        ?>
        <div class="popout">
            <form action="index.php?action=addUser" class="popout-container" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?php echo $type ?>">
                <h3 class="H4">Ajouter <?php echo $type ?></h3>
                <label for="nom" class="H6">nom</label>
                <input type="text" name="nom" id="nom">
                <label for="prenom" class="H6">prenom</label>
                <input type="text" name="prenom" id="prenom">
                <label for="email" class="H6">email</label>
                <input type="text" name="email" id="email">
                <label for="dateNaissance" class="H6">dateNaissance</label>
                <input type="date" name="dateNaissance" id="dateNaissance">
                <label for="sexe" class="H6">sexe</label>
                <select name="sexe" id="sexe">
                    <option value="homme">homme</option>
                    <option value="femme">femme</option>
                </select>

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
        <?php
    }
}
?>