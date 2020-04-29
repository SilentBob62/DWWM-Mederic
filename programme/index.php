<?php
echo'<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="generate.css">
</head>

<body>
    <header class="black borderBottom">
        <div class="logo">
            <img src="" alt="">
        </div>
        <div class="titre vert">
            <h1>Generateur CRUD</h1>
        </div>
    </header>
    <div class="content">
        <form method="POST" action="generate.php">
            <div class="formulaire blackTransparent border">
            <div class="donnee">
                    <label class="vert" for="projet">Projet</label>
                    <input name="projet" type="text">
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
                    <div class="espace"></div>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <div class="piedDePage black borderTop">
            <div class="logo"></div>
            <div class="signature vert">Realisé par SilentB0B</div>
        </div>
    </footer>
</body>

</html>';