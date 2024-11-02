<?php 

function coffeeShop_files(){

    wp_enqueue_script('menu',get_theme_file_uri('/js/fermetureMenus.js'), array(),NULL,true);
    wp_enqueue_script('animation',get_theme_file_uri('/js/animation.js'), array(),NULL,true);
    wp_enqueue_script('animPerso',get_theme_file_uri('/js/animPerso.js'), array(),NULL,true);
    wp_enqueue_script('codeAccueil',get_theme_file_uri('/js/codeAccueilTEST.js'), array(),NULL,true);
    wp_enqueue_script('codeCanvas',get_theme_file_uri('/js/codeCanvas.js'), array(),NULL,true);
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/4f23b00084.js', array(), NULL, true);

    wp_enqueue_style('font1','//use.typekit.net/hez6hsh.css' );
    wp_enqueue_style('font2','//use.typekit.net/nih6pil.css' );
    wp_enqueue_style('fermer', '//fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=close');
    wp_enqueue_style('visible', '//fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=visibility');
    wp_enqueue_style('coffeShop_main_styles', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts','coffeeShop_files');

function ajout_au_theme(){

}
add_action('after_setup_theme','ajout_au_theme');