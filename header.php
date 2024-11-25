<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Techniques d'intégration Multimédia Maisonneuve</title>
  <?php wp_head(); ?>
</head>

<body>
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