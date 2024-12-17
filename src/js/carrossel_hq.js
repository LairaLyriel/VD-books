// ---------------------- Exibir HQs com Carrossel ----------------------
let slideIndexHqsSite = 0;

function definirHqsPorVezSite() {
    if (window.innerWidth <= 480) {
        return 1; // 1 HQ em telas muito pequenas
    } else if (window.innerWidth <= 600) {
        return 2; // 2 HQs em telas pequenas
    } else if (window.innerWidth <= 800) {
        return 3; // 3 HQs em telas médias
    } else if (window.innerWidth <= 1000) {
        return 4; // 4 HQs em telas um pouco maiores
    } else if (window.innerWidth <= 1200) {
        return 5; // 5 HQs em telas grandes
    }
    return 6; // 6 HQs por vez em telas muito grandes
}

const hqSlidesSite = document.querySelectorAll('.carrossel-slide-hq');
let hqsPorVezSite = definirHqsPorVezSite();
const totalSlidesHqSite = hqSlidesSite.length;

function mostrarSlidesHqsSite() {
    hqSlidesSite.forEach((slide) => {
        slide.classList.remove('visible', 'slide-in', 'slide-out');
        slide.style.opacity = 0; 
    });

    for (let i = 0; i < hqsPorVezSite; i++) {
        let index = (slideIndexHqsSite + i) % totalSlidesHqSite; 
        hqSlidesSite[index].classList.add('visible', 'slide-in');
        setTimeout(() => {
            hqSlidesSite[index].style.opacity = 1; 
        }, 50);
    }
}

function moverSlideHqsSite(n) {
    hqSlidesSite.forEach((slide) => {
        slide.classList.remove('slide-in');
        slide.classList.add('slide-out');
    });

    slideIndexHqsSite = (slideIndexHqsSite + n + totalSlidesHqSite) % totalSlidesHqSite;

    setTimeout(() => {
        mostrarSlidesHqsSite();
    }, 300);
}

// Inicializa o carrossel
mostrarSlidesHqsSite();

// Evento de redimensionamento
window.addEventListener('resize', () => {
    hqsPorVezSite = definirHqsPorVezSite();
    mostrarSlidesHqsSite();
});

// Eventos dos botões
document.querySelector(".proximo-hq").addEventListener("click", () => {
    moverSlideHqsSite(1);
});

document.querySelector(".anterior-hq").addEventListener("click", () => {
    moverSlideHqsSite(-1);
});
