<?php get_header(); ?>

<main>
    <!-- Titre suivi de l'icône représentative qui apparait dans le menu nav -->
    <h1 id="titre"><?php single_cat_title(); ?><i class="fa-solid fa-ice-cream"></i></h1>

    <!-- Navigation pour les filtres -->
    <nav class="nav-filtre">
        <?php
        // Récupérer la catégorie principale courante
        $current_category = get_queried_object();
        ?>
        <input type="checkbox" id="touch">
        <label for="touch">
            <span id="selected-category">
                <?php
                // Récupérer la catégorie enfant sélectionnée dans l'URL
                $selected_child_slug = isset($_GET['child_category']) ? sanitize_text_field($_GET['child_category']) : '';

                // Si une sous-catégorie est sélectionnée, afficher son nom
                if ($selected_child_slug) {
                    $selected_category = get_category_by_slug($selected_child_slug);
                    echo esc_html($selected_category ? $selected_category->name : 'Tous les projets');
                } else {
                    echo 'Tous les projets'; // Valeur par défaut
                }
                ?>
            </span>
            <div class="fleche"></div>
        </label>
        <ul class="slide">
            <?php if ($current_category): ?>
                <li><a href="#" data-category-id="<?php echo $current_category->term_id; ?>" data-category-slug="">Tous les projets</a></li>
                <?php
                // Récupérer les projets
                $child_categories_args = array(
                    'child_of' => $current_category->term_id,
                    'hide_empty' => false
                );
                $child_categories = get_categories($child_categories_args);

                if (!empty($child_categories)) :
                    foreach ($child_categories as $child_category) :
                ?>
                        <li>
                            <a href="#" data-category-id="<?php echo $child_category->term_id; ?>" data-category-slug="<?php echo $child_category->slug; ?>">
                                <?php echo substr(esc_html($child_category->name), 10); ?>
                            </a>
                        </li>
                <?php
                    endforeach;
                else :
                    echo '<li>Aucune projets</li>';
                endif;
                ?>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Wrapper pour les contenus -->
    <div class="content-wrapper">
        <?php
        // Récupérer la catégorie actuelle et le filtre
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
                ?>
                    <div class="banniere" data-id="<?php the_ID(); ?>">
                        <div class="image-container">
                            <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png"; ?>" alt="placeholder">
                            <h2><?php the_title(); ?></h2>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </section>

            <!-- Changer la couleur du fond selon la page selon sa couleur de survol dans le menu -->
            <section id="info" data-active-id="" style="background-image: url('https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_projets.jpg');">

                <button id="close-info" class="close-btn"></button>
                <h1 id="cours-name"></h1>
                <div class="text"></div>
                <?php
                // Réinitialiser la boucle pour le contenu dans les templates
                while ($query->have_posts()) : $query->the_post();
                ?>
                    <template id="post-content-<?php the_ID(); ?>">
                        <h1><?php the_title(); ?></h1>
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