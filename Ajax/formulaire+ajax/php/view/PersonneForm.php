<?php

//on recupere l'action à mener (ajout/modif/suppression)
$act = $_GET["act"];
if ($act != "ajout")
{
// on recupere l'id de la personne à modifier ou à supprimer via le $_GET
    $id = $_GET["id"];
    $p = PersonneManager::getById($id);
}
?>
<div class="formulaire center">
    <form action="index.php?action=PersonneAction&act=<?php echo $act; ?>" method="POST">
        <fieldset>
            <legend><i class="fas fa-address-card"></i>Vos coordonnées</legend>
            <label for="nom">Votre nom*</label>
            <!--on renseigne la value dans l'input si on est en modif ou suppr -->
            <input type="text" name="nom" id="nom" maxlength="30" required <?php if ($act != "ajout")
{
    echo 'value ="' . $p->getNom() . '"';
}
?> >
            <!--  on met l'id dans un champ caché pour qu'il soit renseigné dans le $_POST au moment de la validation du formulaire  -->
            <?php if ($act != "ajout")
{
    echo '<input type="text" name="idPersonne" id="idPersonne" hidden value ="' . $p->getIdPersonne() . '" >';
}
?>

            <label for="prenom">Votre prenom*</label>
            <input type="text" name="prenom" id="prenom"required <?php if ($act != "ajout")
{
    echo 'value ="' . $p->getPrenom() . '"';
}
?> >

            <label for="dateNaissance">Votre date de naissance*</label>
            <input type="date" name="dateNaissance" id="dateNaissance"required <?php if ($act != "ajout")
{
    echo 'value ="' . $p->getDateNaissance() . '"';
}
?> >

        </fieldset>
            <div class="btn">
                <button type="submit" name="modifier"> <?php if ($act == "ajout")
{
    echo 'Ajouter';
}
elseif ($act == "modif")
{
    echo 'Modifier';
}
else
{
    echo "Supprimer";
}
?></button>
            <a href="index.php?action=accueil">    <button type="reset" name="annuler" class="annule"> Annuler</button></a>
            </div>
        </fieldset>
    </form>
</div>