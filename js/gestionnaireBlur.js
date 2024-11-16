// je vais checker si la variable est dans sessionStorage
const animationBienvenueAJoue = sessionStorage.getItem(
  "animationBienvenueAJoue"
);
let filter = !animationBienvenueAJoue; // je declare le filtre si l'animation a pas joué

//je mets le filtre selon le true or false de la variable filtre
document.querySelector(".conteneurBlur").style.filter = filter
  ? "blur(10px)"
  : "none";

if (!animationBienvenueAJoue) {
  // si l'animation a pas encore joué, fais l'animation, ensuite met le filtre à false
  // je déclare true dans sessionStorage et j'enlève le filtre.
  window.addEventListener("load", () => {
    setTimeout(() => {
      filter = false; // Set filter to false after animation completes
      sessionStorage.setItem("animationBienvenueAJoue", "true");
      document.querySelector(".conteneurBlur").style.filter = "none";
    }, 5500); //après 5.5 secondes
  });
}

// maintenant même affaire avec le bienvenu au tim
const cntAnimPlayed = sessionStorage.getItem("cntAnimAJoue");

if (cntAnimAJoue) {
  document.getElementById("ctnAnim").style.display = "none";
} else {
  window.addEventListener("load", () => {
    setTimeout(() => {
      document.getElementById("ctnAnim").style.display = "none";
      sessionStorage.setItem("cntAnimAJoue", "true");
    }, 8000);
  });
}
