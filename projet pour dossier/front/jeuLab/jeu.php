<?php

$_SESSION['nom']=$_POST["nom"];
echo'

<body id="niveau1">
    <div class="terrain">
        <img src="image/solMarquageDegat.png" alt="" srcset="">
        <div id="player">
            <div class="hautPerso">
                <div class="orbite">
                    <div class="oeil">
                        <div id="gauche" class="pupille"></div>
                    </div>
                </div>
                <div class="espace"></div>
                <div class="orbite">
                    <div class="oeil">
                        <div id="droite" class="pupille"></div>
                    </div>
                </div>
            </div>
            <div class="basPerso">
                <div class="bouche"></div>
            </div>
        </div>
        <div class="obstacle black bar">&nbsp;</div>

        <div class="obstacle black line1">&nbsp;</div>
        <div class="obstacle black line2">&nbsp;</div>
        <div class="obstacle black line3">&nbsp;</div>
        <div class="obstacle black line4">&nbsp;</div>
        <div class="obstacle black line5">&nbsp;</div>
        <div class="obstacle black line6">&nbsp;</div>
        <div class="obstacle black line7">&nbsp;</div>
        <div class="obstacle black line8">&nbsp;</div>
        <div class="obstacle black line9">&nbsp;</div>
        <div class="obstacle black line10">&nbsp;</div>
        <div class="obstacle black line11">&nbsp;</div>
        <div class="obstacle black line12">&nbsp;</div>
        <div class="obstacle black line13">&nbsp;</div>
        <div class="obstacle black line14">&nbsp;</div>
        <div class="obstacle black line15">&nbsp;</div>
        <div class="obstacle black line16">&nbsp;</div>
        <div class="obstacle black line17">&nbsp;</div>
        <div class="obstacle black line18">&nbsp;</div>

        <div class="obstacle redFonce   "><img id="imageBoutonRouge" src="image/interrupteurRouge.png" alt="" srcset=""> </div>
        <div class="obstacle red square2 mechant"><img id="imagePorteRouge" src="image/porteRouge.png" alt="" srcset=""> </div>
        <div class="obstacle red square3 mechant"><img src="image/MonstreRouge.png" alt="" srcset=""></div>
        <div class="obstacle red square4 mechant"><img src="image/MonstreRouge.png" alt="" srcset=""></div>
        <div class="obstacle red square5 mechant"><img src="image/MonstreRouge.png" alt="" srcset=""></div>
        <div class="obstacle red square6 mechant"><img src="image/MonstreRouge.png" alt="" srcset=""></div>



        <div class="obstacle blueFonce"><img id="imageBoutonBleu" src="image/interrupteurBleu.png" alt="" srcset=""></div>

        <div class="invisibleBleu"></div>
        <div class="invisibleBleu"></div>
        <div class="invisibleBleu"></div>

        <div class="obstacle blue square12"><img id="imagePorteBleu" src="image/porteBleu.png" alt="" srcset=""></div>


        <div id="piece1" class="obstacle or piece1">PO</div>
        <div id="piece2" class="obstacle or piece2">PO</div>
        <div id="piece3" class="obstacle or piece3">PO</div>
        <div id="piece4" class="obstacle or piece4">PO</div>

        <div class="deco">
            <div id="mur1" class="mur"> <img src="image/murAffiche.png" alt="" srcset=""> </div>
            <div id="mur2" class="mur"> <img src="image/mur.png" alt="" srcset=""> </div>
            <div id="mur3" class="mur"> <img src="image/mur.png" alt="" srcset=""> </div>
            <div id="mur4" class="mur"> <img src="image/murAffiche2.png" alt="" srcset=""> </div>
            <div id="mur5" class="mur"><img src="image/murSang.png" alt="" srcset=""></div>
            <div id="mur6" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
            <div id="mur7" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
            <div id="mur8" class="mur"><img src="image/murDistributeurPlante.png" alt="" srcset=""></div>
            <div id="mur9" class="mur"><img src="image/murSang.png" alt="" srcset=""></div>
            <div id="mur10" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
            <div id="mur11" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
            <div id="mur12" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
            <div id="mur13" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
            <div id="mur14" class="mur"><img src="image/mur.png" alt="" srcset=""></div>
        </div>

        <div id="key1" class="obstacle key">
            <div id="rond1" class="rond silver">
                <div id="rondNoir1" class="rondCentre black"></div>
            </div>
            <div id="tige1" class="tige silver"></div>
        </div>

        <div id="" class="obstacle bois porte1">
            <img src="image/porte.png" alt="" srcset="">
        </div>
    </div>';
    
