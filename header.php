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
        <ul>
          <li>
            <a href="<?php echo get_category_link(get_category_by_slug('projets')->term_id); ?>" class="effetVague effetCouleurProjets">
              <span>P</span><span>r</span><span>o</span><span>j</span><span>e</span><span>t</span><span>s</span>
              <span class="dernierSpan"><i class="fa-solid fa-ice-cream"></i></a></span>
          </li>
          <li>
            <a href="<?php echo get_category_link(get_category_by_slug('cours')->term_id); ?>" class="effetVague effetCouleurCours">
              <span>C</span><span>o</span><span>u</span><span>r</span><span>s</span>
              <span class="dernierSpan"><i class="fa-solid fa-ferris-wheel"></i></span>
            </a>
          </li>
          <li>
            <a href="<?php echo get_category_link(get_category_by_slug('profs')->term_id); ?>" class="effetVague effetCouleurProfs">
              <span>P</span><span>r</span><span>o</span><span>f</span><span>s</span>
              <span class="dernierSpan"><i class="fa-solid fa-lighthouse"></i></span>
            </a>
          </li>
          <li>
            <a href="<?php echo get_category_link(get_category_by_slug('evenements')->term_id); ?>" class="effetVague effetCouleurEvenements">
              <span>É</span><span>v</span><span>è</span><span>n</span><span>e</span><span>m</span><span>e</span><span>n</span><span>t</span><span>s</span>
              <span class="dernierSpan"><i class="fa-solid fa-calendar-days"></i></span>
            </a>
          </li>
          <li>
            <a href="<?php echo get_category_link(get_category_by_slug('emplois')->term_id); ?>" class="effetVague effetCouleurFutur">
              <span>F</span><span>u</span><span>t</span><span>u</span><span>r</span>
              <span class="dernierSpan"><i class="fa-solid fa-sailboat"></i></span>
            </a>
          </li>
          <li>
            <a href="<?php echo get_category_link(get_category_by_slug('vie-etudiante')->term_id); ?>" class="effetVague effetCouleurEtudiants">
              <span>V</span><span>i</span><span>e </span><span class="espace"></span><span>É</span><span>t</span><span>u</span><span>d</span><span>i</span><span>a</span><span>n</span><span>t</span><span>e</span>
              <span class="dernierSpan"><i class="fa-solid fa-campfire"></i></span>
            </a>
          </li>
        </ul>
      </nav>
    </section>
  </header>