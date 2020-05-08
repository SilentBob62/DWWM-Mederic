<?php
echo'
<div class="imageGameOver"><img src="image/gameover.png" alt=""></div>';
session_destroy();
header('Refresh: 3; index.php');