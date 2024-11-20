<?php

function enqueue_script_style()
{

    // Charge le script d'animation uniquement sur la page d'accueil
    if (is_front_page()) {
        // wp_enqueue_script('animationFooter', get_theme_file_uri('/js/animationFooter.js'), array(), NULL, true);
        wp_enqueue_script('gestionHotToasts', get_theme_file_uri('/js/gestionHotToasts.js'), array(), NULL, true);
        wp_enqueue_script('gestionnaireBlur', get_theme_file_uri('/js/gestionnaireBlur.js'), array(), NULL, true);    } else {
        // Charge le script d'animation uniquement sur le autres pages
        wp_enqueue_script('animation', get_theme_file_uri('/js/animation.js'), array(), NULL, true);
        wp_enqueue_script('fermetureInfo', get_theme_file_uri('/js/fermetureInfo.js'), array(), NULL, true);
    }

    // Charge les scripts dans tout les pages
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/1afe500f9a.js', array(), NULL, true);
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


function register_category_menu()
{
    register_nav_menu('category-menu', __('Menu Catégories'));
}
add_action('init', 'register_category_menu');

function display_category_menu()
{
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
            case 'futur':
                $icon_class = 'fa-briefcase-arrow-right';
                break;
            case 'vie-etudiante':
                $icon_class = 'fa-campfire';
                break;
            default:
                $icon_class = 'fa-star';
        }

        // Affiche chaque lien de catégorie avec chaque lettre dans un span et l'icône dans un span spécial
        echo '<li class="menu-item">';
        echo '<a href="' . get_category_link($category->term_id) . '" class="effetVague effetCouleur' . ucfirst($category->slug) . '">';
        
        // Ajoute chaque lettre de la catégorie dans un <span>
        $letters = preg_split('//u', $category->name, -1, PREG_SPLIT_NO_EMPTY); // Découpe chaque caractère, y compris les espaces
        foreach ($letters as $letter) {
            if ($letter === ' ') {
                echo '<span class="space">&nbsp;</span>'; // Traite les espaces avec une classe spéciale
            } else {
                echo '<span>' . htmlentities($letter, ENT_QUOTES, 'UTF-8') . '</span>';
            }
        }
        
        

        // Ajoute l'icône dans un span avec la classe dernierSpan
        echo '<span class="dernierSpan"><i class="fa-solid ' . $icon_class . '"></i></span>';
        
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
}



function category_menu_shortcode()
{
    ob_start();
    display_category_menu();
    return ob_get_clean();
}
add_shortcode('category_menu', 'category_menu_shortcode');

function filter_category()
{
    // Check if category_id is set and is a valid integer
    if (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) {
        $category_id = intval($_GET['category_id']);
        $args = array(
            'cat' => $category_id,
            'posts_per_page' => -1
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $category_cours = get_category_by_slug("cours");
?>
                <div class="banniere" data-id="<?php the_ID(); ?>">
                    <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png" ?>" alt="placeholder">
                    <h2>
                        <?php
                        if (has_category($category_cours->term_id)) {
                            echo preg_replace('/\s*\(.*?\)\s*/', '', substr(get_the_title(), 7));
                        } else {
                            the_title();
                        }
                        ?>
                    </h2>
                </div>
                <div id="post-content-<?php the_ID(); ?>" style="display: none;">
                    <h1><?php the_title(); ?></h1>
                    <div><?php the_content(); ?></div>
                </div>
<?php
            endwhile;
        else :
            echo '<p>Aucun article disponible pour le moment.</p>';
        endif;

        wp_reset_postdata();
    } else {
        echo '<p>Catégorie non valide.</p>';
    }

    die();
}

add_action('wp_ajax_filter_category', 'filter_category_callback');
add_action('wp_ajax_nopriv_filter_category', 'filter_category_callback');

function filter_category_callback() {
    $category_id = intval($_GET['category_id']);
    
    $args = array(
        'cat' => $category_id,
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="banniere" data-id="<?php the_ID(); ?>">
                <div class="image-container">
                    <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png"; ?>" alt="placeholder">
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        echo '<h1>Aucun cours disponible pour le moment.</h1>';
    }
    wp_reset_postdata();
    wp_die(); // Terminate the function properly.
}
