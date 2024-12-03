document.addEventListener("DOMContentLoaded", () => {
  //stock pour le footer. à noter: la gestion de l'ouverture et la fermeture du footer
  // est fait avec un checkbox html et scss
  // const checkAPropos = document.getElementById("checkAPropos"); // on va get le checker du footer
  const labelForAPropos = document.querySelector('label[for="checkAPropos"]'); // son label aussi
  const footerAPropos = labelForAPropos.querySelector(".footer-apropos"); // ensuite le footer également

  const labelForSocials = document.querySelector('label[for="checkSocials"]'); // son label aussi
  const footerSocials = labelForSocials.querySelector(".footer-socials"); // ensuite le footer également

  const checkAPropos = document.getElementById("checkAPropos");
  const checkSocials = document.getElementById("checkSocials");

  //stock pour le nav
  const navMenu = document.getElementById("nav-menu"); // on va get l'air du navMenu
  const burger = document.getElementById("burger"); // pareil pour le menu burger
  const barres = document.querySelectorAll("#burger .barre"); // et les barres

  //bool qui detecte quand un checkbox est checked
  var footProposChecked = false;
  var footSuisChecked = false;

  // fonction pour toggle la classe active (ouvrir le menu)
  function basculerMenu() {
    navMenu.classList.toggle("active"); // je rajoute la classe active
    burger.classList.toggle("active");
    barres.forEach((barre) => barre.classList.toggle("active")); // on toggle active aux barres aussi
  }

  // fonction pour enlever la classe active (fermer le menu)
  function fermerMenu() {
    navMenu.classList.remove("active"); // j'enlève la classe active de navMenu
    burger.classList.remove("active");
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

  //checkSocials.addEventListener("click", clickFooter);
  //checkAPropos.addEventListener("click", clickFooter);

  // function pour fermer le footer en clickant en dehors de son aire.
  // autre gestion car checkbox

  function fermerFooter(e) {
    fermerMenu();
    if (e.target == checkAPropos || e.target == checkSocials) {
      return;
    } else if (e.target.id == "footProp" || trouverParents(e.target)) {
      if (!footProposChecked) {
        checkAPropos.checked = false;
        checkSocials.checked = false;
        footProposChecked = false;
        footSuisChecked = false;
      }
      footProposChecked = !footProposChecked;
    } else if (e.target.id == "footSoc" || trouverParents(e.target)) {
      if (!footSuisChecked) {
        checkAPropos.checked = false;
        checkSocials.checked = false;
        footProposChecked = false;
        footSuisChecked = false;
      }
      footSuisChecked = !footSuisChecked;
    } else {
      checkAPropos.checked = false;
      checkSocials.checked = false;
      footProposChecked = false;
      footSuisChecked = false;
    }
  }

  //fonction qui permet de trouver tout les parents d'un element et verifier si le id footProp ou footSoc est dans ses parents
  //https://gomakethings.com/how-to-get-all-parent-elements-with-vanilla-javascript/#:~:text=Get%20all%20parents%20%23&text=var%20getParents%20%3D%20function%20(elem),parent%20array%20return%20parents%3B%20%7D%3B
  function trouverParents(element) {
    var parents = [];
    var bool = false;
    for (; element && element !== document; element = element.parentNode) {
      parents.push(element);
    }
    parents.forEach(parent => {
      if (parent.id == "footProp" || parent.id == "footSoc") {
        bool = true;
      }
    });
    return bool;
  }

  //rajout du event listener dans le document pour fermer les menus et
  document.addEventListener("click", fermerFooter);
});
