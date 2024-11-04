<?php get_header(); ?>
<div id="erreur_404" class="global">
    <section>
        <h2>Erreur 404</h2>
        <span></span>
        <h4>Vous essayez d'accéder à une page qui n'existe pas...ÉRIC S'EST NOYÉ MAN!</h4>
        <span></span>
        <h4>Pour revenir à la page d'accueil, cliquez sur le lien suivant :</h4>
        <span></span>

        <!-- Bouton pour retourner à la page d'accueil -->
        <span></span>
        <a href="#entete"><button id="retourAccueil"> <a href="<?php echo get_bloginfo('url'); ?>"> <?php echo get_bloginfo('name'); ?></a> </button></a>

        <!-- Récupérer le formulaire de recherche -->
        <span></span>
        <?php  get_search_form(); ?>  

        
        <!-- Ajouter le menu avec toutes les catégories -->
        <div id="liensCatFooter">
            <?php wp_nav_menu(array("container" => "nav", "menu" => "principal")); ?>
        </div>

    </section>
        
        <!-- Image de la librairie médias -->
        <a href="<?php echo get_bloginfo('url'); ?>"><img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/04/logoIntra.png"></a>
        
</div>

<!-- Pied de page -->
<!-- Récupérer le footer php -->
<?php get_footer(); ?>

