const SwipeManager = (() => {
    let touchStartY = 0;
    let touchEndY = 0;
    let touchStartTime = 0;
    let isSwiping = false;
    let swipeEventsActive = false; // Garde la trace de l'état de swipe activé ou désactivé

    // Constantes pour déterminer les seuils de swipe
    const SWIPE_THRESHOLD = 0.5; // 50% de la hauteur
    const SPEED_THRESHOLD = 0.5; // en pixels/ms

    // Vérifie si l'appareil est en mode mobile/tablette portrait
    function isMobileOrTabletPortrait() {
        return window.innerWidth <= 1024 && window.innerHeight > window.innerWidth;
    }

    // Gestionnaire pour le début du swipe
    function handleTouchStart(e) {
        touchStartY = e.touches[0].clientY;
        touchStartTime = Date.now();
        isSwiping = true;
    }

    // Gestionnaire pour le mouvement de swipe
    function handleTouchMove(e, infoSection) {
        if (isSwiping) {
            touchEndY = e.touches[0].clientY;
            const distanceY = touchEndY - touchStartY;
            if (distanceY > 0) {
                infoSection.style.transform = `translateY(${distanceY}px)`;
            }
        }
    }

    // Gestionnaire pour la fin du swipe, vérifie si le swipe dépasse les seuils
    function handleTouchEnd(infoSection) {
        if (isSwiping) {
            const touchDuration = Date.now() - touchStartTime;
            const swipeDistance = touchEndY - touchStartY;
            const infoHeight = infoSection.offsetHeight;
            const swipeSpeed = swipeDistance / touchDuration;

            // Masque la section si le swipe est suffisamment long ou rapide
            if (swipeDistance > infoHeight * SWIPE_THRESHOLD || swipeSpeed > SPEED_THRESHOLD) {
                infoSection.style.transition = "transform 0.3s ease";
                infoSection.style.transform = `translateY(${infoHeight}px)`;
                setTimeout(() => {
                    infoSection.style.display = "none";
                    infoSection.style.transform = "translateY(0)";
                    infoSection.style.transition = "none";
                }, 300);
            } else {
                // Sinon, remet la section en place
                infoSection.style.transition = "transform 0.3s ease";
                infoSection.style.transform = "translateY(0)";
                setTimeout(() => {
                    infoSection.style.transition = "none";
                }, 300);
            }
            isSwiping = false;
        }
    }

    // Active ou désactive les événements de swipe en fonction de l'orientation de l'appareil
    function handleSwipeEvents(infoSection) {
        if (isMobileOrTabletPortrait() && !swipeEventsActive) {
            // Ajoute les événements de swipe
            infoSection.addEventListener("touchstart", handleTouchStart);
            infoSection.addEventListener("touchmove", (e) => handleTouchMove(e, infoSection));
            infoSection.addEventListener("touchend", () => handleTouchEnd(infoSection));
            swipeEventsActive = true;
            console.log("Swipe activé en mode mobile/tablette portrait");
        } else if (!isMobileOrTabletPortrait() && swipeEventsActive) {
            // Retire les événements de swipe
            infoSection.removeEventListener("touchstart", handleTouchStart);
            infoSection.removeEventListener("touchmove", (e) => handleTouchMove(e, infoSection));
            infoSection.removeEventListener("touchend", () => handleTouchEnd(infoSection));
            swipeEventsActive = false;
            console.log("Swipe désactivé en mode desktop");
        }
    }

    // Retourne la méthode handleSwipeEvents pour usage externe
    return { handleSwipeEvents };
})();
