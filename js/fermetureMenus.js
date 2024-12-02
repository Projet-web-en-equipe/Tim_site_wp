document.addEventListener("DOMContentLoaded", () => {
  //stock pour le footer. à noter: la gestion de l'ouverture et la fermeture du footer
  // est fait avec un checkbox html et scss
  // const checkAPropos = document.getElementById("checkAPropos"); // on va get le checker du footer
  const labelForAPropos = document.querySelector('label[for="checkAPropos"]'); // son label aussi
  const footerAPropos = labelForAPropos.querySelector(".footer-apropos"); // ensuite le footer également

  const labelForSocials = document.querySelector('label[for="checkSocials"]'); // son label aussi
  const footerSocials = labelForSocials.querySelector(".footer-socials"); // ensuite le footer également

  //stock pour le nav
  const navMenu = document.getElementById("nav-menu"); // on va get l'air du navMenu
  const burger = document.getElementById("burger"); // pareil pour le menu burger
  const barres = document.querySelectorAll("#burger .barre"); // et les barres

  //bool pour savoir si ce qui a ete clicker est le footer
  var isFoot = false;

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

  // function pour fermer le footer en clickant en dehors de son aire.
  // autre gestion car checkbox

  function fermerFooters(event) {
    // Check for "À propos" footer
    if (event.target === footerAPropos || event.target === labelForAPropos) {
      return;
    } else if (
      /* if (
      !footerAPropos.contains(event.target) &&
      document.getElementById("checkAPropos").checked
    ) {
      document.getElementById("checkAPropos").checked = false;
    }*/

      // Check for "Socials" footer
      event.target === footerSocials ||
      event.target === labelForSocials
    ) {
      return;
    }

    if (
      !footerAPropos.contains(event.target) &&
      document.getElementById("checkAPropos").checked
    ) {
      document.getElementById("checkAPropos").checked = false;
    }

    if (
      document.getElementById("checkAPropos").checked &&
      !footerSocials.contains(event.target)
    ) {
      console.log("checker false");
      document.getElementById("checkSocials").checked = false;
    }

    /*if (
      !footerSocials.contains(event.target) &&
      document.getElementById("checkSocials").checked
    ) {
      document.getElementById("checkSocials").checked = false;
    }*/

    //fermeture du nav si le menu est ouvert et si le click est dehors de son aire et du burger
    if (
      navMenu.classList.contains("active") &&
      !navMenu.contains(event.target) &&
      !burger.contains(event.target)
    ) {
      fermerMenu();
    }
  }

  function testFooter(e) {
    if (e.target.classList.length > 0) {
      e.target.classList.forEach((element) => {
        //console.log(element);
        if (element == "unDesCheckbox") {
          isFoot = true;
          console.log("foot");
        }
      });
    }

    if (!isFoot) {
      document.getElementById("checkAPropos").checked = false;
      document.getElementById("checkSocials").checked = false;
    }
    isFoot = false;
  }

  //rajout du event listener dans le document pour fermer les menus et
  document.addEventListener("click", testFooter);
});
