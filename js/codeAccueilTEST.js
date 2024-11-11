////////////////VARIABLES DE DEPART//////////////////

//variable du canvas
var leCanvas = {
  html: document.querySelector("canvas"),
  x: 0,
  y: 0,
  width: 900,
  height: 900,
  lock: true,
  zoom: 1,
};
//les anciennes positions de la souris/doigt
var exPosX;
var exPosY;
//bool declarant si le site est sur mobile ou desktop
var mobile;
//delimiter le margin du canvas quand il est deplaceable
var posExtreme = 50;

///////////////CODE DE DEPART//////////////////////

//trouver la position de depart du canvas
leCanvas.x = window.innerWidth / 2 - leCanvas.width / 2;
leCanvas.y = window.innerHeight / 2 - leCanvas.height / 2;
//appliquer la position de depart au canvas en css
leCanvas.html.style.left = leCanvas.x + "px";
leCanvas.html.style.top = leCanvas.y + "px";
//aller chercher la bonne taille du canvas
leCanvas.width = leCanvas.html.getBoundingClientRect().width;
leCanvas.height = leCanvas.html.getBoundingClientRect().height;
//bien placer le canvas dependament de la taille de l'ecran
if (window.innerWidth < leCanvas.width + posExtreme / 2) {
  var taille = window.innerWidth - posExtreme / 2;
  leCanvas.zoom = taille / leCanvas.width;
  leCanvas.html.style.transform = "scale(" + leCanvas.zoom * 100 + "%)";
  leCanvas.width = leCanvas.html.getBoundingClientRect().width;
  leCanvas.height = leCanvas.html.getBoundingClientRect().height;

}
//si le canvas est plus haut que la taille de l'ecran: 
//faire en sorte qu'on voit juste le top du canvas
if (leCanvas.height > window.innerHeight) {
  leCanvas.y = posExtreme;
  leCanvas.html.style.top = leCanvas.y + "px";
}
//detecter si la page est host sur mobile et declarer dans la bool mobile
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
  mobile = true;
} else {
  mobile = false;
}

function resetPos() {
  leCanvas.x = window.innerWidth / 2 - leCanvas.width / leCanvas.zoom / 2;
  leCanvas.y = window.innerHeight / 2 - leCanvas.height / leCanvas.zoom / 2;
  leCanvas.html.style.left = leCanvas.x + "px";
  leCanvas.html.style.top = leCanvas.y + "px";
}

///////////////////ADDEVENTLISTENER TOWN/////////////////////////////

//addeventlistener pour replacer le canvas quand la taille de la page change
window.addEventListener("resize", resetPos);
//addeventlistener qui detect quand l'utilisateur scroll sur la carte
window.addEventListener('wheel', function (event) {
  if (perso.surIle) {
    //ajouter la valeur du deltaY au zoom
    //deltaY est positif quand le scroll est vers le haut et negatif vers le bas
    if(leCanvas.zoom >= 0.5 && leCanvas.zoom <= 1.5){
      leCanvas.zoom -= event.deltaY / 10000;
    }
    if(leCanvas.zoom > 1.5){
      leCanvas.zoom = 1.5;
    } else if(leCanvas.zoom < 0.5){
      leCanvas.zoom = 0.5;
    } 
    leCanvas.html.style.transform = "scale(" + leCanvas.zoom * 100 + "%)";
    leCanvas.width = leCanvas.html.getBoundingClientRect().width;
    leCanvas.height = leCanvas.html.getBoundingClientRect().height;
    ////////////////
    resetPos();
  }
});
//addeventlistener qui detecte le maintient d'un clic et unlock le canvas
leCanvas.html.addEventListener("mousedown", () => {
  leCanvas.lock = false;
});
//addeventlistener qui detecte le relachement d'un clic et lock le canvas
window.addEventListener("mouseup", () => {
  leCanvas.lock = true;
});
//addeventlistener qui detecte le maintient d'un doigt et unlock le canvas
leCanvas.html.addEventListener("touchstart", (e) => {
  leCanvas.lock = false;
  exPosX = e.touches[0].clientX;
  exPosY = e.touches[0].clientY;
});
//addeventlistener qui detecte le relachement d'un doigt et lock le canvas
window.addEventListener("touchend", () => {
  leCanvas.lock = true;
});
//addeventlistener pour detecter comment le canvas bouge selon la souris
window.addEventListener("mousemove", (e) => {
  //si le canvas est maintenu par la souris
  if (!leCanvas.lock) {
    //si les extremites x du canvas sortent de la page + un margin posExtreme
    if (leCanvas.html.getBoundingClientRect().x <= posExtreme || leCanvas.html.getBoundingClientRect().x + leCanvas.html.getBoundingClientRect().width >= window.innerWidth - posExtreme) {
      //modifier la position du x selon la position de la souris - l'ancienne position de la souris
      leCanvas.x += (e.clientX - exPosX) / 2
      //limiter le deplacement x du canvas s'il va trop loin vers les extremites
      if (leCanvas.x >= (leCanvas.html.getBoundingClientRect().width - 900) / 2 + posExtreme) {
        leCanvas.x = (leCanvas.html.getBoundingClientRect().width - 900) / 2 + posExtreme
      } else if (leCanvas.x <= window.innerWidth - 900 - (((leCanvas.html.getBoundingClientRect().width - 900)) / 2) - posExtreme) {
        leCanvas.x = window.innerWidth - 900 - (((leCanvas.html.getBoundingClientRect().width - 900)) / 2) - posExtreme;
      }
    }
    //si les extremites y du canvas sortent de la page + un margin posExtreme
    if (leCanvas.html.getBoundingClientRect().y <= posExtreme || leCanvas.html.getBoundingClientRect().y + leCanvas.html.getBoundingClientRect().height >= window.innerHeight - posExtreme) {
      //modifier la position du y selon la position de la souris - l'ancienne position de la souris
      leCanvas.y += (e.clientY - exPosY) / 2
      //limiter le deplacement y du canvas s'il va trop loin vers les extremites
      if (leCanvas.y >= (leCanvas.html.getBoundingClientRect().height - 900) / 2 + posExtreme) {
        leCanvas.y = (leCanvas.html.getBoundingClientRect().height - 900) / 2 + posExtreme
      } else if (leCanvas.y <= window.innerHeight - 900 - (((leCanvas.html.getBoundingClientRect().height - 900)) / 2) - posExtreme) {
        leCanvas.y = window.innerHeight - 900 - (((leCanvas.html.getBoundingClientRect().height - 900)) / 2) - posExtreme;
      }
    }
    //appliquer le deplacement avec css
    leCanvas.html.style.left = leCanvas.x + "px"
    leCanvas.html.style.top = leCanvas.y + "px"
  }
  //sauvegarder l'ancienne pos de la souris
  exPosX = e.clientX;
  exPosY = e.clientY;
});
//addeventlistener pour detecter comment le canvas bouge selon la pso du doigt
window.addEventListener("touchmove", (e) => {
  //si le canvas est maintenu par un ou plusieurs doigts
  if (!leCanvas.lock) {
    //detecte et garde le premier doigt qui a toucher l'ecran
    var touch = e.touches[0] || e.changedTouches[0];
    posX = touch.clientX;
    posY = touch.clientY;
    //si les extremites x du canvas sortent de la page + un margin posExtreme
    if (leCanvas.html.getBoundingClientRect().x <= posExtreme || leCanvas.html.getBoundingClientRect().x + leCanvas.html.getBoundingClientRect().width >= window.innerWidth - posExtreme) {
      //modifier la position du x selon la position du doigt - l'ancienne position du doigt
      leCanvas.x += (posX - exPosX) / 2
      //limiter le deplacement x du canvas s'il va trop loin vers les extremites
      if (leCanvas.x >= (leCanvas.html.getBoundingClientRect().width - 900) / 2 + posExtreme) {
        leCanvas.x = (leCanvas.html.getBoundingClientRect().width - 900) / 2 + posExtreme
      } else if (leCanvas.x <= window.innerWidth - 900 - (((leCanvas.html.getBoundingClientRect().width - 900)) / 2) - posExtreme) {
        leCanvas.x = window.innerWidth - 900 - (((leCanvas.html.getBoundingClientRect().width - 900)) / 2) - posExtreme;
      }
    }
    //si les extremites y du canvas sortent de la page + un margin posExtreme
    if (leCanvas.html.getBoundingClientRect().y <= posExtreme || leCanvas.html.getBoundingClientRect().y + leCanvas.html.getBoundingClientRect().height >= window.innerHeight - posExtreme) {
      //modifier la position du y selon la position du doigt - l'ancienne position du doigt
      leCanvas.y += (posY - exPosY) / 2
      //limiter le deplacement y du canvas s'il va trop loin vers les extremites
      if (leCanvas.y >= (leCanvas.html.getBoundingClientRect().height - 900) / 2 + posExtreme) {
        leCanvas.y = (leCanvas.html.getBoundingClientRect().height - 900) / 2 + posExtreme
      } else if (leCanvas.y <= window.innerHeight - 900 - (((leCanvas.html.getBoundingClientRect().height - 900)) / 2) - posExtreme) {
        leCanvas.y = window.innerHeight - 900 - (((leCanvas.html.getBoundingClientRect().height - 900)) / 2) - posExtreme;
      }
    }

    //applique les changement de positions du canvas avec le style
    leCanvas.html.style.left = leCanvas.x + "px";
    leCanvas.html.style.top = leCanvas.y + "px";
  }
  //sauvegarde les anciennes pos du doigt
  exPosX = posX;
  exPosY = posY;
});