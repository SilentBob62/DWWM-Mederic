<?php
echo'

    <div class="content">
        <form method="POST" action="generate.php">
            <div class="formulaire blackTransparent border">
                <div class="donnee">
                    <label class="vert" for="table">Nom de la table</label>
                    <input name="table" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="idTable">Id de la table</label>
                    <input name="idTable" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="classe">Nom de la classe</label>
                    <input name="classe" type="text">
                    <div class="message"></div>
                </div>
                <div class="bas">
                    <div class="espace"></div>
                    <div class="bouton">
                        <input class="button" type="submit" value="OK">
                    </div>
                    <div class="bouton">
                        <div class="button"><a href="index">retour</a></div>
                    </div>
                    <div class="espace"></div>
                </div>
            </div>
        </form>
    </div>
';
