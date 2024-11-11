<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Techniques d'intégration Multimédia Maisonneuve</title>
  <?php wp_head(); ?>

</head>

<body>
  <header>
    <div id="burger">
      <div class="barre"></div>
      <div class="barre"></div>
      <div class="barre"></div>
    </div>
    <div id="logo">
      <a href="<?php echo home_url(); ?>">
        <img src="https://gftnth00.mywhc.ca/tim14/wp-content/uploads/2024/10/timMobile.png" alt="TIM Logo" />
      </a>
    </div>


    <section id="nav-menu">
      <!-- <nav>
        <ul>
          <li>
            <a href="<?php //echo get_category_link(get_category_by_slug('projets')->term_id); ?>">Projets <i class="fa-duotone fa-ice-cream"></i></a>
          </li>
          <li>
            <a href="<?php //echo get_category_link(get_category_by_slug('cours')->term_id); ?>">Cours
              <i
                class="fa-duotone fa-solid fa-ferris-wheel"
                style="
                    --fa-primary-color: #ff5733;
                    --fa-secondary-color: #3333ff;
                  "></i>
            </a>
          </li>
          <li>
            <a href="<?php //echo get_category_link(get_category_by_slug('profs')->term_id); ?>">Profs
              <i
                class="fa-duotone fa-solid fa-lighthouse"
                style="
                    --fa-primary-color: #ff5733;
                    --fa-secondary-color: #3333ff;
                  "></i>
            </a>
          </li>
          
          <li>
            <a href="<?php //echo get_category_link(get_category_by_slug('evenements')->term_id); ?>">Évènements
              <i
                class="fa-duotone fa-calendar-days"
                style="
                    --fa-primary-color: #ff5733;
                    --fa-secondary-color: #3333ff;
                  "></i>
            </a>
          </li>
          <li>
            <a href="<?php //echo get_category_link(get_category_by_slug('emplois')->term_id); ?>">Futur
              <i
                class="fa-duotone fa-solid fa-briefcase-arrow-right"
                style="
                    --fa-primary-color: #ff5733;
                    --fa-secondary-color: #3333ff;
                  "></i>
            </a>
          </li>
          <li>
            <a href="<?php //echo get_category_link(get_category_by_slug('vie-etudiante')->term_id); ?>">Vie Étudiante
              <i
                class="fa-duotone fa-solid fa-campfire"
                style="
                    --fa-primary-color: #ff5733;
                    --fa-secondary-color: #3333ff;
                  "></i>
            </a>
          </li>
        </ul>
      </nav> -->
      <nav>
        <?php echo do_shortcode('[category_menu]'); ?>
      </nav>
      
    </section>


  </header>