<?php get_header(); ?>

<main>
    <h1 id="titre"><?php single_cat_title() ?></h1>
    <nav class="nav-filtre">
        <?php
        $parent_category = get_category_by_slug('cours');
        ?>
        <input type="checkbox" id="touch">
        <label for="touch">
            <span id="selected-category">Toutes les sessions</span>
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
                        <li><a href="#" data-category-id="<?php echo $child_category->term_id; ?>"><?php echo $shortened_name; ?></a></li>
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
    <section id="carrousel">
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
        ?>
        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <div class="banniere" data-id="<?php the_ID(); ?>">
                    <div class="image-container">
                        <img src="<?= "https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/placeholder.png"; ?>" alt="placeholder">
                        <h2><?php the_title(); ?></h2>
                    </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.nav-filtre a');
        const selectedCategoryLabel = document.getElementById('selected-category');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const categoryId = this.getAttribute('data-category-id');
                const categoryName = this.textContent;
                fetchContent(categoryId);
                selectedCategoryLabel.textContent = categoryName;
            });
        });

        function fetchContent(categoryId) {
            fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=filter_category&category_id=${categoryId}`)
                .then(response => response.text())
                .then(data => {
                    const carrousel = document.querySelector('#carrousel');
                    carrousel.innerHTML = data;
                    carrousel.classList.add('custom-carrousel-class'); // Réappliquez une classe spécifique si nécessaire.
                    initializePostClickEvents();
                })
                .catch(error => console.error('Error:', error));
        }


        function initializePostClickEvents() {
            const posts = document.querySelectorAll('.banniere');
            posts.forEach(post => {
                post.addEventListener('click', function() {
                    const postId = this.getAttribute('data-id');
                    const postContent = document.getElementById(`post-content-${postId}`);
                    document.getElementById('cours-name').textContent = postContent.querySelector('h1').textContent;
                    document.querySelector('#info .text').innerHTML = postContent.querySelector('div').innerHTML;
                });
            });
        }

        initializePostClickEvents();
    });
</script>

<?php get_footer(); ?>