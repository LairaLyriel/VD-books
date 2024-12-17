// ---------------------- Carrossel de Banners ----------------------
let slideIndex = 0;

function mostrarSlides(slides) {
    slides.forEach((slide, index) => {
        slide.style.display = (index === slideIndex) ? 'block' : 'none';
    });
}

function moverSlide(n, slides) {
    slideIndex = (slideIndex + n + slides.length) % slides.length;
    mostrarSlides(slides);
}

// Inicializa os slides de banners
const bannerSlides = document.querySelectorAll('.carrossel-slide');
mostrarSlides(bannerSlides);

// Configura o intervalo para mudar os slides automaticamente (banners)
setInterval(() => {
    moverSlide(1, bannerSlides);
}, 5000);

// ---------------------- Exibir Livros com Carrossel ----------------------
let slideIndexLivros = 0;

function definirLivrosPorVez() {
    if (window.innerWidth <= 480) {
        return 1; // 1 livro em telas muito pequenas
    } else if (window.innerWidth <= 600) {
        return 2; // 2 livros em telas pequenas
    } else if (window.innerWidth <= 800) {
        return 3; // 3 livros em telas médias
    } else if (window.innerWidth <= 1000) {
        return 4; // 4 livros em telas um pouco maiores
    } else if (window.innerWidth <= 1200) {
        return 5; // 5 livros em telas grandes
    }
    return 6; // 6 livros por vez em telas muito grandes
}

const livroSlides = document.querySelectorAll('.carrossel-slide-livro');
let livrosPorVez = definirLivrosPorVez();
const totalSlides = livroSlides.length;

function mostrarSlidesLivros() {
    livroSlides.forEach((slide) => {
        slide.classList.remove('visible', 'slide-in', 'slide-out');
        slide.style.opacity = 0; 
    });

    for (let i = 0; i < livrosPorVez; i++) {
        let index = (slideIndexLivros + i) % totalSlides; 
        livroSlides[index].classList.add('visible', 'slide-in');
        setTimeout(() => {
            livroSlides[index].style.opacity = 1; 
        }, 50);
    }
}

function moverSlideLivros(n) {
    livroSlides.forEach((slide) => {
        slide.classList.remove('slide-in');
        slide.classList.add('slide-out');
    });

    slideIndexLivros = (slideIndexLivros + n + totalSlides) % totalSlides;

    setTimeout(() => {
        mostrarSlidesLivros();
    }, 300);
}

// Inicializa o carrossel
mostrarSlidesLivros();

// Evento de redimensionamento
window.addEventListener('resize', () => {
    livrosPorVez = definirLivrosPorVez();
    mostrarSlidesLivros();
});

// Eventos dos botões
document.getElementById("btnProximo").addEventListener("click", () => {
    moverSlideLivros(1);
});

document.getElementById("btnVoltar").addEventListener("click", () => {
    moverSlideLivros(-1);
});
