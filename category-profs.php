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

        if ($query->have_posts()) :
            echo '<section id="carrousel">';
            while ($query->have_posts()) : $query->the_post();
        ?>
                <div class="banniere" data-id="<?php the_ID(); ?>">
                    <!-- Image temporaire de Martin -->
                    <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/low_martin.jpg"; ?>" alt="lowpoly_martin">
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
        ?>
    </div>
</main>

<?php get_footer(); ?>
