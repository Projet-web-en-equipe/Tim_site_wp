document.addEventListener("DOMContentLoaded", () => {
    const coursItems = document.querySelectorAll(".banniere");
    const infoSection = document.getElementById("info");
    const coursName = document.getElementById("cours-name");
    const coursText = document.querySelector(".text");
    const closeBtn = document.getElementById("close-info");

    // Variables pour garder la largeur et hauteur précédentes de la fenêtre
    let previousWidth = window.innerWidth;
    let previousHeight = window.innerHeight;

    // Fonction pour vérifier si l'appareil est en mode mobile/tablette portrait
    function isMobileOrTabletPortrait() {
        return window.innerWidth <= 1024 && window.innerHeight > window.innerWidth;
    }

// Affiche les informations du cours en fonction de l'ID du post
function afficherCours(postId) {
    const postContent = document.getElementById(`post-content-${postId}`);
    if (postContent) {
        coursName.innerHTML = postContent.querySelector("h1").innerText;
        coursText.innerHTML = postContent.querySelector("div").innerHTML;

        infoSection.style.display = "block";

        // Applique l'animation uniquement si l'appareil est en mode mobile/tablette portrait
        if (isMobileOrTabletPortrait()) {
            infoSection.style.transform = "translateY(100%)"; // Commence en bas
            setTimeout(() => {
                infoSection.style.transition = "transform 0.3s ease";
                infoSection.style.transform = "translateY(0)"; // Anime vers le haut
                infoSection.classList.add("info-visible"); // Ajoute la classe
            }, 10); // Petit délai pour permettre le rendu initial
        } else {
            // Réinitialise les styles pour un affichage instantané sur bureau
            infoSection.style.transition = "none";
            infoSection.style.transform = "none";
        }
    }
}

    // Affiche automatiquement le premier cours si l'appareil n'est pas en mode mobile/tablette portrait
    if (coursItems.length > 0 && !isMobileOrTabletPortrait()) {
        const premierPostId = coursItems[0].getAttribute("data-id");
        afficherCours(premierPostId);
    }

    // Ajoute un événement au clic pour chaque élément de cours
    coursItems.forEach(item => {
        item.addEventListener("click", () => {
            const postId = item.getAttribute("data-id");
            afficherCours(postId);
        });
    });

    // Ferme la section d'information quand on clique sur le bouton de fermeture
    // closeBtn.addEventListener("click", () => {
    //     const infoHeight = infoSection.offsetHeight;

    //     // Ajoute une transition pour l'animation
    //     infoSection.style.transition = "transform 0.3s ease";
    //     infoSection.style.transform = `translateY(${infoHeight}px)`; // Fait descendre l'élément hors de l'écran

    //     // Après l'animation, masque la section
    //     setTimeout(() => {
    //         infoSection.style.display = "none";
    //         infoSection.style.transform = "translateY(0)"; // Réinitialise la position pour un affichage futur
    //         infoSection.style.transition = "none"; // Réinitialise la transition
    //         infoSection.classList.remove("info-visible"); // Retire la classe
    //     }, 300); // Correspond à la durée de la transition (0.3s)
    // });

    // Vérifie les changements de taille d'écran à intervalles réguliers
    setInterval(() => {
        const currentWidth = window.innerWidth;
        const currentHeight = window.innerHeight;

        // Si la taille a changé, met à jour et adapte l'affichage
        if (currentWidth !== previousWidth || currentHeight !== previousHeight) {
            previousWidth = currentWidth;
            previousHeight = currentHeight;

            if (currentWidth <= 1024) {
                console.log("Mode mobile ou tablette activé :", currentWidth, "x", currentHeight);
            } else {
                console.log("Mode bureau activé :", currentWidth, "x", currentHeight);
            }

            // Masque la section d'info en mode portrait mobile/tablette
            if (isMobileOrTabletPortrait()) {
                infoSection.style.display = "none";
            } else if (coursItems.length > 0) {
                const premierPostId = coursItems[0].getAttribute("data-id");
                afficherCours(premierPostId);
            }

            // Active ou désactive les événements de swipe en fonction de la taille
            SwipeManager.handleSwipeEvents(infoSection);
        }
    }, 500);

    // Initialise les événements de swipe au chargement de la page
    SwipeManager.handleSwipeEvents(infoSection);
});