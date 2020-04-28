<?php 
class Affichage
{
public static function AffichageListe()
{
$ = Manager::getList();
?>
<div class="ligne">
</div>
<?php
foreach ($ as $elt) {
?>
<div class="ligne">
</div>
<?php
}
}

public static function AffichageDetail($id)
{
$ = Manager::findById($id);
?>
<div class="ligne">
</div>

<div class="ligne">
</div>
<?php
}
}