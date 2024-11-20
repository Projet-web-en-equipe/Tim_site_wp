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

            <section id="info" data-active-id="">
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
            echo '<h1>Information à venir.</h1>';
        endif;

        wp_reset_postdata();
        ?>
    </div>
</main>

<?php get_footer(); ?>
