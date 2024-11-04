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

function resetPos(){
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
  //ajouter la valeur du deltaY au zoom
  //deltaY est positif quand le scroll est vers le haut et negatif vers le bas
  leCanvas.zoom -= event.deltaY / 10000;
  leCanvas.html.style.transform = "scale(" + leCanvas.zoom * 100 + "%)";
  leCanvas.width = 900 * leCanvas.zoom;
  leCanvas.height = 900 * leCanvas.zoom;
  ////////////////
  resetPos();
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
//addeventlistener pour detecter comment le canvas bouge selon la souris/doigt
if (!mobile) {
  //addeventlistener pour desktop
  window.addEventListener("mousemove", (e) => {
    console.log(leCanvas.x)
    if (!leCanvas.lock) {
      //si les limites du x du canvas sont a l'exterieurs de la page
      if (leCanvas.x < 0 || leCanvas.x + leCanvas.width > window.innerWidth) {
        //deplace le x du canvas selon la pos de la souris - son ancienne pos
        leCanvas.x += (e.clientX - exPosX) / 2;
        //limite le deplacement du canvas aux limites + un petit margin
        if (leCanvas.x >= 0 + posExtreme + (leCanvas.width - 900) && leCanvas.x + leCanvas.width + posExtreme > window.innerWidth) {
          leCanvas.x = 0 + posExtreme + (leCanvas.width - 900);
        }
        if (leCanvas.x + leCanvas.width + posExtreme <= window.innerWidth) {
          leCanvas.x = window.innerWidth - leCanvas.width - posExtreme;
        }
      }
      //si les limites du y du canvas sont a l'exterieurs de la page
      if (leCanvas.y < 0 || leCanvas.y + leCanvas.height > window.innerHeight) {
        //deplace le y du canvas selon la pos de la souris - son ancienne pos
        leCanvas.y += (e.clientY - exPosY) / 2;
        //limite le deplacement du canvas aux limites + un petit margin
        if (leCanvas.y >= 0 + posExtreme + (leCanvas.height - 900)) {
          leCanvas.y = 0 + posExtreme + (leCanvas.height - 900);
        }
        if (leCanvas.y + leCanvas.height + posExtreme <= window.innerHeight) {
          leCanvas.y = window.innerHeight - leCanvas.height - posExtreme;
        }
      }
      //applique les changement de positions du canvas avec le style
      leCanvas.html.style.left = leCanvas.x + "px";
      leCanvas.html.style.top = leCanvas.y + "px";
    }
    //sauvegarde les anciennes pos de la souris
    exPosX = e.clientX;
    exPosY = e.clientY;
  });
} else {
  //addeventlistener pour mobile
  window.addEventListener("touchmove", (e) => {
    if (!leCanvas.lock) {
      //detecte et garde le premier doigt qui a toucher l'ecran
      var touch = e.touches[0] || e.changedTouches[0];
      posX = touch.clientX;
      posY = touch.clientY;
      //si les limites du x du canvas sont a l'exterieurs de la page
      if (leCanvas.x < 0 || leCanvas.x + leCanvas.width > window.innerWidth) {
        //deplace le x du canvas selon la pos du doigt - son ancienne pos
        leCanvas.x += (posX - exPosX) / 2;
        //limite le deplacement du canvas aux limites + un petit margin
        if (leCanvas.x >= 0 + posExtreme) {
          leCanvas.x = 0 + posExtreme;
        }
        if (leCanvas.x + leCanvas.width + posExtreme <= window.innerWidth) {
          leCanvas.x = window.innerWidth - leCanvas.width - posExtreme;
        }
      }
      //si les limites du y du canvas sont a l'exterieurs de la page
      if (leCanvas.y < 0 || leCanvas.y + leCanvas.height > window.innerHeight) {
        //deplace le y du canvas selon la pos du doigt - son ancienne pos
        leCanvas.y += (posY - exPosY) / 2;
        //limite le deplacement du canvas aux limites + un petit margin
        if (leCanvas.y >= 0 + posExtreme) {
          leCanvas.y = 0 + posExtreme;
        }
        if (leCanvas.y + leCanvas.height + posExtreme <= window.innerHeight) {
          leCanvas.y = window.innerHeight - leCanvas.height - posExtreme;
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
}