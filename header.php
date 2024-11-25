<!DOCTYPE html>
<html lang="en">
  
<!-- Récupérer les images de fond pour chaque page catégorie -->
<?php
// Vérifier si nous sommes sur une page de catégorie
if (is_category()) {
    // Récupérer l'objet de la catégorie
    $category = get_queried_object();
    $category_slug = isset($category->slug) ? $category->slug : ''; // Définit la valeur par défaut si null

    // Définir l'URL de l'image de fond
    if ($category_slug == 'cours') {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_cours.jpg';
    } else if ($category_slug == 'futur') {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_futur.jpg';
    } else if ($category_slug == 'projets') {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_projets.jpg';
    } else if ($category_slug == 'evenements') {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_evenements.jpg';
    } else if ($category_slug == 'vie_etudiante') {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_vie_etudiante.jpg';
    } else if ($category_slug == 'profs') {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly_profs.jpg';
    } else {
        $bg_img_url = 'https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/bg_lowPoly.jpg'; // Image par défaut
    }
} else {
    $bg_img_url = ''; // Pas d'image de fond si ce n'est pas une page catégorie
}
?>



<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Techniques d'intégration Multimédia Maisonneuve</title>
  <?php wp_head(); ?>
</head>

<body class="<?php echo is_front_page() ? 'accueil' : (is_category() ? 'category-' . $category_slug : ''); ?>"> <!-- Classe dynamique ajoutée ici -->
  <header class="<?php echo is_front_page() ? 'accueil' : (is_category() ? 'category' : ''); ?>">
    <!-- Je dois absolument avoir le header et le footer en position absolute. Pour l'accueil
 le header doit être par dessus le canvas... mais pour les pages category, je change la class
 et je remets en flex normal. -->
    <div id="burger">
      <div class="barre"></div>
      <div class="barre"></div>
      <div class="barre"></div>
    </div>
    <div id="logo">
      <a href="<?php echo home_url(); ?> ">
        <img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/11/TIMLogo.png" alt="TIM Logo" />
      </a>
    </div>

    <section id="nav-menu">
      <nav>
        <?php echo do_shortcode('[category_menu]'); ?>
      </nav>
    </section>
  </header>
