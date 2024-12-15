<?php
// Fonction pour modifier le titre selon les critères donnés
function modifier_titre_post($title) {
    // Vérifie si les 3 premiers caractères contiennent un chiffre
    if (preg_match('/^\d/', $title)) {
        // Supprime les 8 premiers caractères
        $title = substr($title, 8);
        
        // Supprime tout ce qui est dans les parenthèses à la fin du titre
        $title = preg_replace('/\s?\(.*\)$/', '', $title);
    }
    return $title;
}
?>

<?php get_header(); ?>

<main>
    <!-- Titre suivi de l'icône représentative qui apparait dans le menu nav -->
    <h1 id="titre"><?php echo modifier_titre_post(single_cat_title('', false)); ?><i class="fa-solid fa-ferris-wheel"></i></h1>

    <!-- Navigation pour les filtres -->
    <div class="nav-filtre">
        <?php
        $current_category = get_queried_object();
        ?>
        <input type="checkbox" id="touch">
        <label for="touch">
            <span id="selected-category">
                <?php
                $selected_child_slug = isset($_GET['child_category']) ? sanitize_text_field($_GET['child_category']) : '';

                if ($selected_child_slug) {
                    $selected_category = get_category_by_slug($selected_child_slug);
                    echo esc_html($selected_category ? substr($selected_category->name, 8) : 'Tous les cours');
                } else {
                    echo 'Tous les cours';
                }
                ?>
            </span>
            <div class="fleche-filtre"></div>
        </label>

        <ul class="slide">
            <?php if ($current_category): ?>
                <li><a href="#" data-category-id="<?php echo $current_category->term_id; ?>" data-category-slug="">Tous les cours</a></li>
                <?php
                $child_categories_args = array(
                    'child_of' => $current_category->term_id,
                    'hide_empty' => false
                );
                $child_categories = get_categories($child_categories_args);

                if (!empty($child_categories)) :
                    foreach ($child_categories as $child_category) :
                        if (strpos($child_category->slug, 'session') !== false) : // Vérifie "session" dans le slug
                            $category_name = str_replace('cours - ', '', $child_category->name); // Enlève "cours - "
                ?>
                            <li>
                                <a href="#" data-category-id="<?php echo $child_category->term_id; ?>" data-category-slug="<?php echo $child_category->slug; ?>">
                                    <?php echo substr(esc_html($child_category->name), 8); ?>
                                </a>
                            </li>
                <?php
                        endif;
                    endforeach;
                else :
                    echo '<li>Aucune sous-catégorie disponible</li>';
                endif;
                ?>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Wrapper pour les contenus -->
    <div class="content-wrapper">
        <?php
        $child_category_slug = isset($_GET['child_category']) ? sanitize_text_field($_GET['child_category']) : '';

        $args = array(
            'category_name' => $child_category_slug ? $child_category_slug : $current_category->slug,
            'posts_per_page' => -1
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
        ?>
            <section id="carrousel">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post_slug = get_post_field('post_name', get_the_ID());

                    // URL du placeholder
                    $placeholder_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png';

                    // Recherche de l'image "og-{slug}" dans la médiathèque
                    $og_image_args = array(
                        'post_type' => 'attachment',
                        'post_status' => 'inherit',
                        'posts_per_page' => 1,
                        'meta_query' => array(
                            array(
                                'key' => '_wp_attached_file',
                                'value' => "og-{$post_slug}",
                                'compare' => 'LIKE'
                            )
                        )
                    );
                    $og_image_query = new WP_Query($og_image_args);
                    $og_image_url = $og_image_query->have_posts() ? wp_get_attachment_url($og_image_query->posts[0]->ID) : $placeholder_url;

                    // Recherche de l'image "low-{slug}" dans la médiathèque
                    $low_image_args = array(
                        'post_type' => 'attachment',
                        'post_status' => 'inherit',
                        'posts_per_page' => 1,
                        'meta_query' => array(
                            array(
                                'key' => '_wp_attached_file',
                                'value' => "low-{$post_slug}",
                                'compare' => 'LIKE'
                            )
                        )
                    );
                    $low_image_query = new WP_Query($low_image_args);
                    $low_image_url = $low_image_query->have_posts() ? wp_get_attachment_url($low_image_query->posts[0]->ID) : $placeholder_url;
                ?>
                    <div class="banniere" data-id="<?php the_ID(); ?>">
                        <div class="image-container">
                            <img class="image-hover" src="<?php echo esc_url($og_image_url); ?>" alt="Image survolée de <?php echo esc_attr(get_the_title()); ?>">
                            <img class="image-low" src="<?php echo esc_url($low_image_url); ?>" alt="Image originale de <?php echo esc_attr(get_the_title()); ?>">
                            <h2><?php echo modifier_titre_post(get_the_title()); ?></h2> <!-- Modifie le titre ici -->
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </section>

            <!-- Changer la couleur du fond selon la page -->
            <section id="info" data-active-id="" style="background-image: url('https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_cours.jpg');">
                <button id="close-info" class="close-btn"></button>
                <h1 id="cours-name"></h1>
                <div class="text"></div>
                <?php
                while ($query->have_posts()) : $query->the_post();
                ?>
                    <template id="post-content-<?php the_ID(); ?>">
                        <h1><?php echo modifier_titre_post(get_the_title()); ?></h1> <!-- Modifie le titre ici également -->
                        <div><?php the_content(); ?></div>
                    </template>
                <?php
                endwhile;
                ?>
            </section>
        <?php
        else :
            echo '<h1>Aucun contenu disponible pour cette catégorie.</h1>';
        endif;

        wp_reset_postdata();
        ?>
    </div>
</main>

<script>
    // Gestion des filtres dynamiques
    document.querySelectorAll('.nav-filtre ul.slide li a').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var categorySlug = this.getAttribute('data-category-slug');
            var url = new URL(window.location.href);
            url.searchParams.set('child_category', categorySlug);
            window.location.href = url.toString();
        });
    });
</script>

<?php get_footer(); ?>
