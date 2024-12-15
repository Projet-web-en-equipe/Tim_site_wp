document.addEventListener("DOMContentLoaded", () => {
    const coursItems = document.querySelectorAll(".banniere");
    const infoSection = document.getElementById("info");
    const closeBtn = document.getElementById("close-info");
    const coursName = document.getElementById("cours-name");
    const coursText = document.querySelector(".text");

    let dernierPostClique = null;

    // Fonction pour afficher les informations d'un post
    function afficherCours(postId) {
        const template = document.getElementById(`post-content-${postId}`);
        if (template) {
            const clone = template.content.cloneNode(true);
            const newTitle = clone.querySelector("h1");
            const newText = clone.querySelector("div");

            coursName.innerHTML = newTitle.innerHTML;
            coursText.innerHTML = newText.innerHTML;

            if (isMobile()) {
                infoSection.style.display = "block";
                infoSection.style.transform = "translateY(100%)";
                infoSection.style.transition = "transform 0.3s ease-out";

                setTimeout(() => {
                    infoSection.style.transform = "translateY(0)";
                }, 10);
            } else {
                infoSection.style.display = "block";
                infoSection.style.transform = "translateY(0)"; // S'assure que la section est à sa place
            }
        }
        appliquerImg();
    }

    // Fonction pour fermer la section
    function fermerCours() {
        if (isMobile()) {
            infoSection.style.transform = "translateY(100%)";
            infoSection.addEventListener(
                "transitionend",
                () => {
                    infoSection.style.display = "none";
                },
                { once: true }
            );
        } else {
            infoSection.style.display = "none";
        }
    }

    // Détecte si l'écran est mobile ou tablette
    function isMobile() {
        return window.matchMedia("(max-width: 1024px)").matches;
    }

    // Réinitialise les fonctionnalités selon la taille de l'écran
    function onResize() {
        console.log(`Taille de l'écran changée : ${window.innerWidth}px`);
        
        if (isMobile()) {
            console.log("Mode tablette ou mobile activé");
            infoSection.style.display = "none"; // Réinitialise l'affichage en mobile/tablette
        } else {
            console.log("Mode desktop activé");

            // Réinitialise la position et l'affichage de la section
            infoSection.style.transform = "translateY(0)";
            if (dernierPostClique) {
                afficherCours(dernierPostClique);
            } else if (coursItems.length > 0) {
                const firstPostId = coursItems[0].getAttribute("data-id");
                afficherCours(firstPostId);
            }
        }
    }

    // Ajoute un événement au clic pour chaque bannière
    coursItems.forEach((item) => {
        item.addEventListener("click", () => {
            const postId = item.getAttribute("data-id");
            dernierPostClique = postId; // Enregistre le dernier post cliqué
            afficherCours(postId);
        });
    });

    // Ferme la section d'information au clic sur le bouton
    closeBtn.addEventListener("click", fermerCours);

    // Détecte les changements de taille d'écran
    window.addEventListener("resize", onResize);

    // Charge le contenu au démarrage
    onResize();
});
