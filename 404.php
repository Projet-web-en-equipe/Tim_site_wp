<?php get_header(); ?>
<div id="erreur_404" class="global">
    <section>
        <h2 id="titre404">Erreur 404</h2>
        <span></span>
        <p>Vous essayez d'accéder à une page qui n'existe pas et par conséquent...ÉRIC S'EST NOYÉ !!!</p >
        <span></span>
        <p>Revenez à la page d'accueil à l'aide de l'icône du TIM</p>
        <span></span>

        <!-- Bouton pour retourner à la page d'accueil -->
        <span></span>
        <a href="#entete"> <a href="<?php //echo get_bloginfo('url'); ?>"> <?php //echo get_bloginfo('name'); ?></a> </a>
           
        <!-- Ajouter le menu avec toutes les catégories -->
        <!-- <div id="liensCatFooter">
            <?php //wp_nav_menu(array("container" => "nav", "menu" => "principal")); ?>
        </div> -->

    </section>
        
        <!-- Image de la librairie médias -->
        <!-- Image temporaire -->
        <a href="<?php echo get_bloginfo('url'); ?>"><img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/EricD.png"></a> 
        
</div>

<!-- Pied de page -->
<!-- Récupérer le footer php -->
<?php get_footer(); ?>

