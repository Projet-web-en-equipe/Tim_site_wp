window.addEventListener("load", () => {
  /*je ne veux pas que le toast load à chaque fois que je retourne sur la mape
  donc grâce à sessionStorage, on enregistre si la variable est true ou false
   si on ferme la fenêtre et on en ouvre une nouvelle, toutes les animations sont resetées
   et joueront une fois, et ainsi de suite*/

  /*https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage
  
  The read-only sessionStorage property accesses a session Storage object for the current origin. sessionStorage is similar to localStorage; the difference is that while data in localStorage doesn't expire, data in sessionStorage is cleared when the page session ends.
  */

  /*variables pour calisser le sessionStorage dedans dans le event load. */
  const toastVisible = sessionStorage.getItem("toastShown");
  const arrierePlanVisible = sessionStorage.getItem("ArrierePlanMontre");
  const ctnAnimationVisible = sessionStorage.getItem(
    "AnimationTexteDebutMontre"
  );
  /*************************************************************/
  /*je gère la visibilité de l'animation du texte du debut ici */
  /*************************************************************/

  if (!ctnAnimationVisible) {
    setTimeout(() => {
      const ctnAnimationDebut = document.getElementById("ctnAnim");
      ctnAnimationDebut.classList.add("ctnAnim");
      // Indiquer que l'animation du texte du debut a été montré dans cette session
      sessionStorage.setItem("AnimationTexteDebutMontre", "true");
    }, 0);
  } else {
    // Si l'animation du texte du debut a déjà été montré, le masquer immédiatement
    const ctnAnimationDebut = document.getElementById("ctnAnim");
    ctnAnimationDebut.style.visibility = "hidden"; // Rendre invisible
    ctnAnimationDebut.style.opacity = "0"; // Masquer visuellement
  }

  /*************************************************************/
  /*je gère la visibilité de l'arrière plan de début ici */
  /*************************************************************/

  if (!arrierePlanVisible) {
    setTimeout(() => {
      const arrierePlan = document.getElementById("arrierePlan");
      arrierePlan.classList.add("montrerArrierePlan");

      // Indiquer que l'arrière plan a été montré dans cette session
      sessionStorage.setItem("ArrierePlanMontre", "true");
    }, 0);
  } else {
    // Si l'arrière plan a déjà été montré, le masquer immédiatement
    const arrierePlan = document.getElementById("arrierePlan");
    arrierePlan.style.visibility = "hidden"; // Rendre invisible
    arrierePlan.style.opacity = "0"; // Masquer visuellement
  }

  /*************************************************************/
  /*je gère la visibilité du hot toast de début ici */
  /*************************************************************/

  if (!toastVisible) {
    // seulement si je ne l'ai pas encore montré pour la session.
    // je montre le toast, juste après l'animation de bienvenue, et d'eric qui tombe du ciel
    setTimeout(() => {
      const toast = document.getElementById("hot-toast");
      toast.classList.add("montrerToast"); // je veux juste que le tout se montre quand je veux, je rajoute la class

      // je mets dans session storage que je viens de montrer l'animation une fois, donc pas besoin de le refaire
      sessionStorage.setItem("toastShown", "true");
    }, 8000); // j'attends 8 secondes avant de monter le toast au beurre de peanut
  } // fin if !toastVisible
}); // fin de window
