<?php 
class ClientAffichage
{
public static function AffichageListeClient()
{
$clients = ClientManager::getList();
?>
<div class="ligne">
<div class="bloc titre">NomClient</div>
<div class="bloc titre">PrenomClient</div>
<div class="bloc titre">AdresseClient</div>
</div>
<?php
foreach ($clients as $elt) {
?>
<div class="ligne">
<div class="bloc contenu"><?php echo $elt->getNomClient() ?></div>
<div class="bloc contenu"><?php echo $elt->getPrenomClient() ?></div>
<div class="bloc contenu"><?php echo $elt->getAdresseClient() ?></div>
</div>
<?php
}
}

public static function AffichageDetailClient($id)
{
$clients = ClientManager::findById($id);
?>
<div class="ligne">
<div class="bloc titre">NomClient</div>
<div class="bloc titre">PrenomClient</div>
<div class="bloc titre">AdresseClient</div>
</div>

<div class="ligne">
<div class="bloc contenu"><?php echo "nomClient : " . $clients->getNomClient() ?></div>
<div class="bloc contenu"><?php echo "prenomClient : " . $clients->getPrenomClient() ?></div>
<div class="bloc contenu"><?php echo "adresseClient : " . $clients->getAdresseClient() ?></div>
</div>
<?php
}
}