<?php get_header(); ?>

<main>
    <h1 id="titre"><?php single_cat_title(); ?></h1>
    <div class="content-wrapper">
        <?php
        // Récupérer l'objet de la catégorie en cours
        $category = get_queried_object();
        $args = array(
            'category_name' => $category->slug, // Utilisez le slug de la catégorie actuelle
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);

        // Tableau pour stocker les logs
        $console_logs = [];

        if ($query->have_posts()) :
            echo '<section id="carrousel">';
            while ($query->have_posts()) : $query->the_post();

                // Formatage pour le titre du post
                $post_title = sanitize_title(get_the_title());

                // Année et mois actuels
                $current_year = date('Y');
                $current_month = date('m');

                // Base URL pour les images
                $base_url = "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/";
                $base_path = ABSPATH . "wp-content/uploads/";

                // Génération des chemins des images
                $image_lowpoly = $base_url . "$current_year/$current_month/low-" . $post_title . ".jpg";
                $image_original = $base_url . "$current_year/$current_month/og-" . $post_title . ".jpg";

                $file_lowpoly = $base_path . "$current_year/$current_month/low-" . $post_title . ".jpg";
                $file_original = $base_path . "$current_year/$current_month/og-" . $post_title . ".jpg";

                // Placeholder si l'image n'existe pas
                $placeholder = $base_url . "2024/10/placeholder.png";

                // Vérification de l'existence des fichiers
                if (file_exists($file_lowpoly)) {
                    $console_logs[] = "File exists: $file_lowpoly";
                } else {
                    $console_logs[] = "File does not exist: $file_lowpoly";
                    $image_lowpoly = $placeholder;
                }

                if (file_exists($file_original)) {
                    $console_logs[] = "File exists: $file_original";
                } else {
                    $console_logs[] = "File does not exist: $file_original";
                    $image_original = $placeholder;
                }
        ?>
                <div class="banniere" data-id="<?php the_ID(); ?>">
                    <!-- Conteneur d'images -->
                    <div class="image-container">
                        <!-- Image low poly -->
                        <img class="image-original" src="<?php echo esc_url($image_lowpoly); ?>" alt="lowpoly_<?php echo esc_attr($post_title); ?>">
                        <!-- Photo originale en dessous pour le hover -->
                        <img class="image-hover" src="<?php echo esc_url($image_original); ?>" alt="og_<?php echo esc_attr($post_title); ?>">
                    </div>
                    <h2><?php the_title(); ?></h2>
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
            echo '<h1>Information à venir.</h1>';
        endif;

        wp_reset_postdata();

        // Injecter les logs dans la console du navigateur
        if (!empty($console_logs)) {
            echo "<script>";
            foreach ($console_logs as $log) {
                echo "console.log(" . json_encode($log) . ");";
            }
            echo "</script>";
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
