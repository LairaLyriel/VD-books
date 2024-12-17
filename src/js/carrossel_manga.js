// ---------------------- Exibir Mangás com Carrossel ----------------------
let slideIndexMangaSite = 0;

function definirMangasPorVezSite() {
    if (window.innerWidth <= 480) {
        return 1; // 1 mangá em telas muito pequenas
    } else if (window.innerWidth <= 600) {
        return 2; // 2 mangás em telas pequenas
    } else if (window.innerWidth <= 800) {
        return 3; // 3 mangás em telas médias
    } else if (window.innerWidth <= 1000) {
        return 4; // 4 mangás em telas um pouco maiores
    } else if (window.innerWidth <= 1200) {
        return 5; // 5 mangás em telas grandes
    }
    return 6; // 6 mangás por vez em telas muito grandes
}

const mangaSlidesSite = document.querySelectorAll('.carrossel-slide-manga');
let mangasPorVezSite = definirMangasPorVezSite();
const totalSlidesMangaSite = mangaSlidesSite.length;

function mostrarSlidesMangaSite() {
    mangaSlidesSite.forEach((slide) => {
        slide.classList.remove('visible', 'slide-in', 'slide-out');
        slide.style.opacity = 0; 
    });

    for (let i = 0; i < mangasPorVezSite; i++) {
        let index = (slideIndexMangaSite + i) % totalSlidesMangaSite; 
        mangaSlidesSite[index].classList.add('visible', 'slide-in');
        setTimeout(() => {
            mangaSlidesSite[index].style.opacity = 1; 
        }, 50);
    }
}

function moverSlideMangaSite(n) {
    mangaSlidesSite.forEach((slide) => {
        slide.classList.remove('slide-in');
        slide.classList.add('slide-out');
    });

    slideIndexMangaSite = (slideIndexMangaSite + n + totalSlidesMangaSite) % totalSlidesMangaSite;

    setTimeout(() => {
        mostrarSlidesMangaSite();
    }, 300);
}

// Inicializa o carrossel
mostrarSlidesMangaSite();

// Evento de redimensionamento
window.addEventListener('resize', () => {
    mangasPorVezSite = definirMangasPorVezSite();
    mostrarSlidesMangaSite();
});

// Eventos dos botões
document.querySelector(".proximo-manga").addEventListener("click", () => {
    moverSlideMangaSite(1);
});

document.querySelector(".anterior-manga").addEventListener("click", () => {
    moverSlideMangaSite(-1);
});
