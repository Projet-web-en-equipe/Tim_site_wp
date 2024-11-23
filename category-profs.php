<?php get_header(); ?>

<main>
    <h1 id="titre"><?php single_cat_title() ?></h1>
    <nav class="nav-filtre">
        <?php
        $parent_category = get_category_by_slug('profs');
        ?>
        <input type="checkbox" id="touch">
        <label for="touch">
            <span id="selected-category">Tous les types</span>
            <div class="fleche"></div>
        </label>
        <ul class="slide">
            <?php if ($parent_category): ?>
                <li><a href="#" data-category-id="<?php echo $parent_category->term_id; ?>">Toutes les sessions</a></li>
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
                        <li><a href="#" data-category-id="<?php echo $child_category->term_id; ?>" data-category-slug="<?php echo $child_category->slug; ?>"><?php echo $shortened_name; ?></a></li>
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
    $category = get_queried_object();
    $child_category_slug = isset($_GET['child_category']) ? sanitize_text_field($_GET['child_category']) : '';

    if ($child_category_slug) {
        $args = array(
            'category_name' => $child_category_slug,
            'posts_per_page' => -1
        );
    } else {
        $args = array(
            'category_name' => $category->slug,
            'posts_per_page' => -1
        );
    }

    $query = new WP_Query($args);

    $console_logs = [];

    if ($query->have_posts()) :
        echo '<section id="carrousel">';
        while ($query->have_posts()) : $query->the_post();

            $post_title = sanitize_title(get_the_title());
            $current_year = date('Y');
            $current_month = date('m');
            $base_url = "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/";
            $base_path = ABSPATH . "wp-content/uploads/";

            $image_lowpoly = $base_url . "$current_year/$current_month/low-" . $post_title . ".jpg";
            $image_original = $base_url . "$current_year/$current_month/og-" . $post_title . ".jpg";

            $file_lowpoly = $base_path . "$current_year/$current_month/low-" . $post_title . ".jpg";
            $file_original = $base_path . "$current_year/$current_month/og-" . $post_title . ".jpg";

            $placeholder = $base_url . "2024/10/placeholder.png";

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
                <div class="image-container">
                    <img class="image-original" src="<?php echo esc_url($image_lowpoly); ?>" alt="lowpoly_<?php echo esc_attr($post_title); ?>">
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
        echo '<h1>Aucun cours disponible pour le moment.</h1>';
    endif;

    wp_reset_postdata();
    ?>
    </section>
</div>
</main>

<script>
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