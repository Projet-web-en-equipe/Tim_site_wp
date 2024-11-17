<?php
get_header();
?>
 <div id="ctnAnim">
    <div id="ctnTitre">
        <h1 class="titreH2 anim1">Bienvenue</h1>
        <h1 class="titreH2 anim2">au</h1>
        <h1 class="titreH1 anim3">TIM</h1>
        <h3 class="titreH3 anim4">Maisonneuve</h3>
    </div>
</div>

<body>
    <div class="conteneurBlur">
        <div id="hot-toast">
            <p>Vous pouvez intéragir avec l'île! </p>
            <p> Faites un click pour découvrir le point d'intérêt, un 2ème click pour y rentrer!</p>
            <div class="borderGauche"></div>
            <div class="borderDroitt"></div>
        </div>
        <div class="nuage">
        </div>
        <div class="unOiseaux">
            <div class="bird"></div>
            <div class="bird"></div>
            <div class="bird"></div>
        </div>  
        <?php echo do_shortcode('[le_canvas]')?>
    </div>
</body>


<?php
get_footer();
?>