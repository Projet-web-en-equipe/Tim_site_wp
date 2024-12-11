<?php get_header(); ?>

<main>
    <!-- Titre suivi de l'icône représentative qui apparait dans le menu nav -->
    <h1 id="titre"><?php single_cat_title(); ?><i class="fa-solid fa-ferris-wheel"></i></h1>

    <!-- Navigation pour les filtres -->
    <nav class="nav-filtre">
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
                                    <?php echo esc_html($category_name); ?>
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

    </nav>

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
                // Initialisation des catégories à vérifier
                $required_categories = array('cours - 3d', 'cours - design', 'cours - jeu', 'cours - vidéo', 'cours - web', 'cours - autre');
                $processed_courses = array();

                while ($query->have_posts()) : $query->the_post();
                    $categories = get_the_category();
                    $current_course = null;

                    foreach ($categories as $category) {
                        if (in_array(strtolower($category->name), $required_categories)) {
                            $current_course = strtolower($category->name);
                            $processed_courses[] = $current_course; // Ajouter au tableau des cours affichés
                            break;
                        }
                    }
                ?>
                    <div class="banniere" data-id="<?php the_ID(); ?>">
                        <div class="image-container">
                            <?php
                            if ($current_course === 'cours - 3d') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M234.5 5.7c13.9-5 29.1-5 43.1 0l192 68.6C495 83.4 512 107.5 512 134.6l0 242.9c0 27-17 51.2-42.5 60.3l-192 68.6c-13.9 5-29.1 5-43.1 0l-192-68.6C17 428.6 0 404.5 0 377.4L0 134.6c0-27 17-51.2 42.5-60.3l192-68.6zM256 66L82.3 128 256 190l173.7-62L256 66zm32 368.6l160-57.1 0-188L288 246.6l0 188z" />
                                </svg>
                            <?php elseif ($current_course === 'cours - design') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z" />
                                </svg>
                            <?php elseif ($current_course === 'cours - jeu') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M192 64C86 64 0 150 0 256S86 448 192 448l256 0c106 0 192-86 192-192s-86-192-192-192L192 64zM496 168a40 40 0 1 1 0 80 40 40 0 1 1 0-80zM392 304a40 40 0 1 1 80 0 40 40 0 1 1 -80 0zM168 200c0-13.3 10.7-24 24-24s24 10.7 24 24l0 32 32 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-32 0 0 32c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-32-32 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l32 0 0-32z" />
                                </svg>
                            <?php elseif ($current_course === 'cours - vidéo') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M0 128C0 92.7 28.7 64 64 64l256 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2l0 256c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1l0-17.1 0-128 0-17.1 14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z" />
                                </svg>
                            <?php elseif ($current_course === 'cours - web') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M432 64L208 64c-8.8 0-16 7.2-16 16l0 16-64 0 0-16c0-44.2 35.8-80 80-80L432 0c44.2 0 80 35.8 80 80l0 224c0 44.2-35.8 80-80 80l-16 0 0-64 16 0c8.8 0 16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zM0 192c0-35.3 28.7-64 64-64l256 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 192zm64 32c0 17.7 14.3 32 32 32l192 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 192c-17.7 0-32 14.3-32 32z" />
                                </svg>
                            <?php elseif ($current_course === 'cours - autre') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                </svg>
                            <?php else : ?>
                                <img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png" alt="placeholder">
                            <?php endif; ?>
                            
                            <h2>
                                <?php
                                // Récupérer le titre du post
                                $title = get_the_title();

                                // Vérifier si les 8 premiers caractères contiennent un chiffre
                                if (preg_match('/\d/', substr($title, 0, 8))) {
                                    // Si les 8 premiers caractères contiennent un chiffre, les supprimer
                                    $title = substr($title, 8);
                                }

                                // Vérifier si le texte entre parenthèses contient un chiffre
                                if (preg_match('/\([^)]*\d[^)]*\)/', $title)) {
                                    // Si le texte entre parenthèses contient un chiffre, supprimer ce texte
                                    $title = preg_replace('/\([^)]*\)/', '', $title);
                                }

                                // Afficher le titre modifié
                                echo esc_html($title);
                                ?>
                            </h2>


                        </div>
                    </div>
                <?php endwhile; ?>
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

    // Gestion du bouton "close"
    document.getElementById('close-info').addEventListener('click', function() {
        var infoSection = document.getElementById('info');
        infoSection.style.display = 'none'; // Cache la section info
    });
</script>

<?php get_footer(); ?>