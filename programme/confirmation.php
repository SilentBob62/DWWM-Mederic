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
    <div class="contenu">
        <div class="espace"></div>
        <div class="confirm ">les fichiers ont bien été créés</div>
        <div class="espace"></div>
    </div>';
    header('Refresh: 3; index.php');