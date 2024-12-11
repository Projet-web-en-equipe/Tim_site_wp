<?php get_header(); ?>

<main>
    <h1 id="titre"><?php single_cat_title(); ?><i class="fa-solid fa-campfire"></i></h1>
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
                    // Définir l'URL de l'image selon le slug du post
                    $slug = get_post_field('post_name', get_post()); // Récupère le slug du post
                    if ($slug == 'jean-sebastien-et-eric') {
                        $image_url = '<img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/12/vie-etudiante-icone-jean-sebastien-et-eric.png" alt="jean-sebastien-et-eric">';
                    } elseif ($slug == 'horaire-typique') {
                        $image_url = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 32l0 32L48 64C21.5 64 0 85.5 0 112l0 48 448 0 0-48c0-26.5-21.5-48-48-48l-48 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32L160 64l0-32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192L0 192 0 464c0 26.5 21.5 48 48 48l352 0c26.5 0 48-21.5 48-48l0-272z"/></svg>';
                    } elseif ($slug == 'locaux-disponibles') {
                        $image_url = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 32C60.7 32 32 60.7 32 96l0 288 64 0L96 96l384 0 0 288 64 0 0-288c0-35.3-28.7-64-64-64L96 32zM224 384l0 32L32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32l512 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-128 0 0-32c0-17.7-14.3-32-32-32l-128 0c-17.7 0-32 14.3-32 32z"/></svg>';
                    } elseif ($slug == 'comite-etudiant-tim') {
                        $image_url = '<img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/TIMLogo.png" alt="tim-logo">';
                    } else {
                        $image_url = '<img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png" alt="placeholder">'; // Image par défaut
                    }
                ?>
                    <div class="banniere" data-id="<?php the_ID(); ?>">
                        <div class="image-container">
                            <?php echo $image_url; ?> <!-- Afficher le SVG ou l'image -->
                            <h2><?php the_title(); ?></h2>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </section>

            <!-- Changer la couleur du fond selon la page -->
            <section id="info" data-active-id="" style="background-image: url('https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_vie_etudiante.jpg');">

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