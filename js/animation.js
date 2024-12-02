document.addEventListener("DOMContentLoaded", () => {
    const coursItems = document.querySelectorAll(".banniere");
    const infoSection = document.getElementById("info");
    const closeBtn = document.getElementById("close-info");
    const coursName = document.getElementById("cours-name");
    const coursText = document.querySelector(".text");

    let touchStartY = 0; // Position initiale du toucher
    let touchMoveY = 0; // Position actuelle pendant le glissement

    // Fonction pour afficher les informations d'un post avec une animation de slide-in
    function afficherCours(postId) {
        const template = document.getElementById(`post-content-${postId}`);
        if (template) {
            const clone = template.content.cloneNode(true);
            const newTitle = clone.querySelector("h1");
            const newText = clone.querySelector("div");

            // Met à jour les éléments dynamiques
            coursName.innerHTML = newTitle.innerHTML;
            coursText.innerHTML = newText.innerHTML;

            // Anime l'ouverture de la section
            infoSection.style.display = "block";
            infoSection.style.transform = "translateY(100%)";
            infoSection.style.transition = "transform 0.3s ease-out";

            setTimeout(() => {
                infoSection.style.transform = "translateY(0)";
            }, 10);
        }
    }

    // Fonction pour fermer la section avec une animation de slide-out
    function fermerCours() {
        infoSection.style.transform = "translateY(100%)";

        infoSection.addEventListener(
            "transitionend",
            () => {
                infoSection.style.display = "none";
            },
            { once: true }
        );
    }

    // Gestion des événements tactiles
    infoSection.addEventListener("touchstart", (e) => {
        touchStartY = e.touches[0].clientY; // Enregistre la position de départ
    });

    infoSection.addEventListener("touchmove", (e) => {
        touchMoveY = e.touches[0].clientY; // Enregistre la position actuelle

        // Calcul de la distance glissée et translation de l'élément
        const deltaY = touchMoveY - touchStartY;
        if (deltaY > 0) {
            infoSection.style.transform = `translateY(${deltaY}px)`;
        }
    });

    infoSection.addEventListener("touchend", () => {
        const deltaY = touchMoveY - touchStartY;

        // Récupère la hauteur de la section
        const sectionHeight = infoSection.offsetHeight;

        if (deltaY > sectionHeight / 2) {
            // Si on a glissé plus de 50% de la hauteur, fermer la section
            fermerCours();
        } else {
            // Sinon, revenir à la position initiale
            infoSection.style.transform = "translateY(0)";
        }

        // Réinitialise les valeurs tactiles
        touchStartY = 0;
        touchMoveY = 0;
    });

    // Affiche automatiquement le premier cours
    if (coursItems.length > 0) {
        const premierPostId = coursItems[0].getAttribute("data-id");
        afficherCours(premierPostId);
    }

    // Ajoute un événement au clic pour chaque bannière
    coursItems.forEach((item) => {
        item.addEventListener("click", () => {
            const postId = item.getAttribute("data-id");
            afficherCours(postId);
        });
    });

    // Ferme la section d'information au clic sur le bouton
    closeBtn.addEventListener("click", fermerCours);
});
