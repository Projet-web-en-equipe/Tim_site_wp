document.addEventListener("DOMContentLoaded", () => {
    const coursItems = document.querySelectorAll(".banniere");
    const infoSection = document.getElementById("info");
    const closeBtn = document.getElementById("close-info");
    const coursName = document.getElementById("cours-name");
    const coursText = document.querySelector(".text");

    // Fonction pour afficher les informations d'un post
    function afficherCours(postId) {
        // Récupère le template correspondant au post
        const template = document.getElementById(`post-content-${postId}`);
        if (template) {
            // Injecte le contenu dans la section #info
            const clone = template.content.cloneNode(true);
            const newTitle = clone.querySelector("h1");
            const newText = clone.querySelector("div");

            // Met à jour les éléments dynamiques
            coursName.innerHTML = newTitle.innerHTML;
            coursText.innerHTML = newText.innerHTML;

            // Affiche la section info
            infoSection.style.display = "block";
        }
    }

    // Affiche automatiquement le premier cours
    if (coursItems.length > 0) {
        const premierPostId = coursItems[0].getAttribute("data-id");
        afficherCours(premierPostId);
    }

    // Ajoute un événement au clic pour chaque bannière
    coursItems.forEach(item => {
        item.addEventListener("click", () => {
            const postId = item.getAttribute("data-id");
            afficherCours(postId);
        });
    });

    // Ferme la section d'information
    closeBtn.addEventListener("click", () => {
        infoSection.style.display = "none";
    });
});