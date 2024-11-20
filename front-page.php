<?php
get_header();
?>
<!-- une div vide pour gérer l'animation de l'arrière plan différemment -->
<div id="arrierePlan"></div>
<!-- la class de ctnAnim sera rajouté et enlevé avec sessionStorage -->
<div id="ctnAnim">
    <div id="ctnTitre">
        <h1 class="titreH2 anim1">Bienvenue</h1>
        <h1 class="titreH2 anim2">au</h1>
        <h1 class="titreH1 anim3">TIM</h1>
        <h3 class="titreH3 anim4">Maisonneuve</h3>
    </div>

</div>

<body>

    <div id="hot-toast">
        <p>Vous pouvez intéragir avec l'île! </p>
        <p> Faites un click pour découvrir le point d'intérêt, un 2ème click pour y rentrer!</p>
        <div class="borderGauche"></div>
        <div class="borderDroit"></div>
    </div>
    <!-- <div class="nuage">
        <img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/nuage2.png" alt="nuage">

    </div>
    <div class="nuage2">
        <img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/nuageCrop.png" alt="nuage">
-->
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