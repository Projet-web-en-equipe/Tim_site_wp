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
            infoSection.style.transform = "translateY(0)"; // Réinitialise la position
        }
    }

    // Affiche automatiquement le premier cours si l'appareil n'est pas en mode mobile/tablette portrait
    if (coursItems.length > 0 && !isMobileOrTabletPortrait()) {
        const premierPostId = coursItems[0].getAttribute("data-id");
        afficherCours(premierPostId);
    } else {
        infoSection.style.display = "none";
    }

    // Ajoute un événement au clic pour chaque élément de cours
    coursItems.forEach(item => {
        item.addEventListener("click", () => {
            const postId = item.getAttribute("data-id");
            afficherCours(postId);
        });
    });

    // Ferme la section d'information quand on clique sur le bouton de fermeture
    closeBtn.addEventListener("click", () => {
        infoSection.style.display = "none";
    });

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
