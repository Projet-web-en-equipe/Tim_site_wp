<?php get_header(); ?>

<main>
    <h1 id="titre"><?php single_cat_title(); ?></h1>

    <?php
    // Récupérer l'objet de la catégorie parente "Cours"
    $parent_category = get_category_by_slug('cours');
    $category = get_queried_object();
    $child_category_slug = isset($_GET['child_category']) ? sanitize_text_field($_GET['child_category']) : '';

    if ($child_category_slug) {
        // Si un slug de sous-catégorie est fourni, afficher les posts de cette sous-catégorie
        $args = array(
            'category_name' => $child_category_slug,
            'posts_per_page' => -1
        );
    } else {
        // Sinon, afficher les posts de la catégorie parente
        $args = array(
            'category_name' => $category->slug,
            'posts_per_page' => -1
        );
    }

    $query = new WP_Query($args);

    // Afficher le filtre seulement si des articles existent pour la catégorie
    if ($query->have_posts() && $parent_category) :
    ?>
        <nav class="nav-filtre">
            <label for="touch"><span>Les sessions</span></label>
            <input type="checkbox" id="touch">
            <ul class="slide">
                <li><a href="<?php echo get_category_link($parent_category->term_id); ?>">Toutes les sessions</a></li>
                <?php
                $child_categories_args = array(
                    'child_of' => $parent_category->term_id,
                    'hide_empty' => false
                );
                $child_categories = get_categories($child_categories_args);

                if (!empty($child_categories)) :
                    foreach ($child_categories as $child_category) :
                        $shortened_name = substr($child_category->name, 8);
                ?>
                        <li><a href="?child_category=<?php echo $child_category->slug; ?>"><?php echo $shortened_name; ?></a></li>
                <?php
                    endforeach;
                else :
                    echo '<li>Aucune catégorie</li>';
                endif;
                ?>
            </ul>
        </nav>
    <?php endif; ?>

    <div class="content-wrapper">
        <?php
        if ($query->have_posts()) :
            echo '<section id="carrousel">';
            while ($query->have_posts()) : $query->the_post();
        ?>
                <div class="banniere" data-id="<?php the_ID(); ?>">
                    <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png"; ?>" alt="placeholder">
                    <h2><?php echo preg_replace('/\s*\(.*?\)\s*/', '', substr(get_the_title(), 7)); ?></h2>
                </div>

                <div id="post-content-<?php the_ID(); ?>" style="display: none;">
                    <h1><?php the_title(); ?></h1>
                    <div><?php the_content(); ?></div>
                </div>
        <?php
            endwhile;
            echo '</section>';

            echo '<section id="info">
                    <button id="close-info" class="close-btn"></button>
                    <h1 id="cours-name"></h1>
                    <div class="text"></div>
                  </section>';
        else :
            echo '<h1>Aucun cours disponible pour le moment.</h1>';
        endif;

        wp_reset_postdata();
        ?>
    </div>
</main>

<?php get_footer(); ?>
