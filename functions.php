<?php

function enqueue_script_style()
{

    // Charge le script d'animation uniquement sur la page d'accueil
    if (is_front_page()) {
        wp_enqueue_script('animPerso', get_theme_file_uri('/js/animPerso.js'), array(), NULL, true);
        wp_enqueue_script('codeAccueil', get_theme_file_uri('/js/codeAccueil.js'), array(), NULL, true);
        wp_enqueue_script('codeCanvas', get_theme_file_uri('/js/codeCanvas.js'), array(), NULL, true);
    } else {
    // Charge le script d'animation uniquement sur le autres pages
        wp_enqueue_script('animation', get_theme_file_uri('/js/animation.js'), array(), NULL, true);
        wp_enqueue_script('fermetureInfo', get_theme_file_uri('/js/fermetureInfo.js'), array(), NULL, true);
    }

    // Charge les scripts dans tout les pages
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/4f23b00084.js', array(), NULL, true);
    wp_enqueue_script('menu', get_theme_file_uri('/js/fermetureMenus.js'), array(), NULL, true);

    // Charge les styles dans tout les pages
    wp_enqueue_style('font1', '//use.typekit.net/hez6hsh.css');
    wp_enqueue_style('font2', '//use.typekit.net/nih6pil.css');
    wp_enqueue_style('fermer', '//fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=close');
    wp_enqueue_style('visible', '//fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=visibility');
    wp_enqueue_style('coffeShop_main_styles', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_script_style');

// function ajout_au_theme() {}
// add_action('after_setup_theme', 'ajout_au_theme');


function register_category_menu() {
    register_nav_menu('category-menu', __('Menu Catégories'));
}
add_action('init', 'register_category_menu');

function display_category_menu() {
    // Récupère uniquement les catégories parent (parent = 0 signifie pas de parent)
    $args = array(
        'parent' => 0,
        'exclude' => 1 // Exclut la catégorie avec l'ID 1 (généralement "Uncategorized")
    );
    $categories = get_categories($args);

    echo '<ul class="category-menu custom-nav">';
    foreach ($categories as $category) {
        // Définir une classe d'icône spécifique pour chaque catégorie
        $icon_class = '';
        switch ($category->slug) {
            case 'projets':
                $icon_class = 'fa-ice-cream';
                break;
            case 'cours':
                $icon_class = 'fa-ferris-wheel';
                break;
            case 'profs':
                $icon_class = 'fa-lighthouse';
                break;
            case 'evenements':
                $icon_class = 'fa-calendar-days';
                break;
            case 'emplois':
                $icon_class = 'fa-briefcase-arrow-right';
                break;
            case 'vie-etudiante':
                $icon_class = 'fa-campfire';
                break;
            default:
                $icon_class = 'fa-star';  // Icône par défaut si aucune correspondance
        }

        // Affiche chaque lien de catégorie avec son icône spécifique
        echo '<li class="menu-item">';
        echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name;
        echo ' <i class="fa-duotone ' . $icon_class . '"></i></a>';  // Ajout de l'icône
        echo '</li>';
    }
    echo '</ul>';
}



function category_menu_shortcode() {
    ob_start();
    display_category_menu();
    return ob_get_clean();
}
add_shortcode('category_menu', 'category_menu_shortcode');
