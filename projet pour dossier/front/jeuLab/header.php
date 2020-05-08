<?php
$nom=(isset($_SESSION['nom']))? $_SESSION['nom']:'';

if(isset($_GET[ 'piece' ] )) { $_SESSION['piece'] = $_GET['piece'];}
$piece=(isset($_SESSION['piece']))?(int) $_SESSION['piece']:0;
echo'<body class="fontEcran">
    <div class="content colonne">
        <header>
        </header>';

