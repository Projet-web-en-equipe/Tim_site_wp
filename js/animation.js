document.addEventListener("DOMContentLoaded", () => {
    const coursItems = document.querySelectorAll(".banniere");
    const infoSection = document.getElementById("info");
    const coursName = document.getElementById("cours-name");
    const coursText = document.querySelector(".text");
    const closeBtn = document.getElementById("close-info");

    // Fonction pour afficher un cours dans la section info
    function afficherCours(postId) {
        const postContent = document.getElementById(`post-content-${postId}`);
        if (postContent) {
            coursName.innerHTML = postContent.querySelector("h1").innerText;
            coursText.innerHTML = postContent.querySelector("div").innerHTML;
            infoSection.style.display = "block";
        }
    }

    // Fonction pour détecter si on est en mode mobile
    function isMobile() {
        return window.innerWidth <= 768; // Ajustez la largeur selon le besoin
    }

    // Afficher par défaut le premier cours si ce n'est pas en mode mobile
    if (coursItems.length > 0 && !isMobile()) {
        const premierPostId = coursItems[0].getAttribute("data-id");
        afficherCours(premierPostId);
    } else {
        infoSection.style.display = "none"; // Cacher la section info par défaut en mode mobile
    }

    // Ajouter un événement pour chaque élément pour afficher le cours correspondant
    coursItems.forEach(item => {
        item.addEventListener("click", () => {
            const postId = item.getAttribute("data-id");
            afficherCours(postId);
        });
    });

    // Bouton pour fermer la section d'information
    closeBtn.addEventListener("click", () => {
        infoSection.style.display = "none";
    });

    // Réajuster l'affichage lors du redimensionnement de la fenêtre
    window.addEventListener("resize", () => {
        if (isMobile()) {
            infoSection.style.display = "none";
        } else if (coursItems.length > 0) {
            const premierPostId = coursItems[0].getAttribute("data-id");
            afficherCours(premierPostId);
        }
    });
});
