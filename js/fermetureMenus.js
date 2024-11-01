document.addEventListener("DOMContentLoaded", () => {
  //stock pour le footer. à noter: la gestion de l'ouverture et la fermeture du footer
  // est fait avec un checkbox html et scss
  const checkFoot = document.getElementById("checkFoot"); // on va get le checker du footer
  const labelForFooter = document.querySelector('label[for="checkFoot"]'); // son label aussi
  const footer = labelForFooter.querySelector("footer"); // ensuite le footer également

  //stock pour le nav
  const navMenu = document.getElementById("nav-menu"); // on va get l'air du navMenu
  const burger = document.getElementById("burger"); // pareil pour le menu burger
  const barres = document.querySelectorAll("#burger .barre"); // et les barres

  // fonction pour toggle la classe active (ouvrir le menu)
  function basculerMenu() {
    navMenu.classList.toggle("active"); // je rajoute la classe active
    barres.forEach((barre) => barre.classList.toggle("active")); // on toggle active aux barres aussi
  }

  // fonction pour enlever la classe active (fermer le menu)
  function fermerMenu() {
    navMenu.classList.remove("active"); // j'enlève la classe active de navMenu
    barres.forEach((barre) => barre.classList.remove("active")); // j'enlève la classe active des barres aussi
  }

  // maintenant gestion du click sur le burger avec stopPropagation();

  /*
  https://developer.mozilla.org/en-US/docs/Web/API/Event/stopPropagation
  
  The stopPropagation() method of the Event interface prevents further propagation of the current event in the capturing and bubbling phases. It does not, however, prevent any default behaviors from occurring; for instance, clicks on links are still processed. If you want to stop those behaviors, see the preventDefault() method. It also does not prevent propagation to other event-handlers of the current element. If you want to stop those, see stopImmediatePropagation().
  
  */
  burger.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent the click from propagating to the document listener
    basculerMenu(); // j'ouvre le menu
  });

  // function pour fermer le footer en clickant en dehors de son aire.
  // autre gestion car checkbox

  function fermerMenus(event) {
    // Si on click sur le checkbox ou le label, fais rien
    if (event.target === checkFoot || event.target === labelForFooter) {
      return;
    }

    // si on click ailleurs et le checkbox est checked
    if (!footer.contains(event.target) && checkFoot.checked) {
      checkFoot.checked = false; // on met sa à false ce qui fermera le menu
    }

    //fermeture du nav si le menu est ouvert et si le click est dehors de son aire et du burger
    if (
      navMenu.classList.contains("active") &&
      !navMenu.contains(event.target) &&
      !burger.contains(event.target)
    ) {
      fermerMenu();
    }
  }

  //rajout du event listener dans le document pour fermer les menus et
  document.addEventListener("click", fermerMenus);
});
