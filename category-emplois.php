<?php get_header(); ?>

<main>
    <h1 id="titre"><?php single_cat_title() ?></h1>
    <div class="content-wrapper">
        <section id="carrousel">

            <?php
            // Récupérer l'objet de la catégorie en cours
            $category = get_queried_object();
            $args = array(
                'category_name' => $category->slug, // Utilisez le slug de la catégorie actuelle
                'posts_per_page' => -1
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="banniere" data-id="<?php the_ID(); ?>">
                        <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png" ?>" alt="placeholder">
                        <h2><?php echo preg_replace('/\s*\(.*?\)\s*/', '', substr(get_the_title(), 7)); ?></h2>
                    </div>

                    <div id="post-content-<?php the_ID(); ?>" style="display: none;">
                        <h1><?php the_title(); ?></h1>
                        <div><?php the_content(); ?></div>
                    </div>
            <?php
                endwhile;
            else :
                echo '<p>Aucun cours disponible pour le moment.</p>';
            endif;

            wp_reset_postdata();
            ?>

        </section>

        <section id="info">
            <button id="close-info" class="close-btn"></button>
            <h1 id="cours-name"></h1>
            <div class="text"></div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
