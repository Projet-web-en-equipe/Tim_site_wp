window.addEventListener("load", () => {
  // je ne veux pas que le toast load à chaque fois que je retourne sur la mape
  // donc grâche a sessionStorage, on enregistre si la variable est true or false
  //si on ferme la fenêtre et on en ouvre une nouvelle, toutes les animations sont resetées
  // et joueront une fois, et ainsi de suite

  /*https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage
  
  The read-only sessionStorage property accesses a session Storage object for the current origin. sessionStorage is similar to localStorage; the difference is that while data in localStorage doesn't expire, data in sessionStorage is cleared when the page session ends.
  */
  const toastVisible = sessionStorage.getItem("toastShown");

  if (!toastVisible) {
    // seulement si je ne l'ai pas encore montré pour la session.
    // je montre le toast, juste après l'animation de bienvenue, et d'eric qui tombe du ciel
    setTimeout(() => {
      const toast = document.getElementById("hot-toast");
      toast.classList.add("montrerToast"); //je veux juste que le tout se montre quand je veux, je rajoute la class

      // je mets dans session storage que je viens de montrer l'animation une fois, donc pas besoin de le refaire
      sessionStorage.setItem("toastShown", "true");
    }, 8000); // j'attends 8 secondes avant de monter le toast au beurre de peanut
  }
});
