<?php
echo'

    <div id="contenu" class="contenu">
        <form method="POST" action="generate.php">
            <div id="formulaire" class="formulaire blackTransparent border">
            <div class="donnee">
                    <label class="vert" for="projet">Projet</label>
                    <input name="projet" type="text" value="">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="host">Host</label>
                    <input name="host" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="port">Port</label>
                    <input name="port" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="login">Login</label>
                    <input name="login" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="MDP">Mot De Passe</label>
                    <input name="MDP" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="BDD">Nom de la Base de données</label>
                    <input name="BDD" type="text">
                    <div class="message"></div>
                </div>
                <div class="donnee">
                    <label class="vert" for="nbTable">nombre de table</label>
                    <input  id="nbTable" name="nbTable" type="number">
                    <div class="message">
                        <div class="validerNombre" id="validerNombre">valider</div>
                    </div>
                </div> 
            </div>  
        </form>
        <script src="generate.js"></script>
    </div>
';