// ---------------------- Exibir Editoras com Carrossel ----------------------
let slideIndexEditoras = 0;
const editoraSlides = document.querySelectorAll('.carrossel-slide-editora');
const totalSlidesEditoras = editoraSlides.length;

// Função que define o número de editoras por vez com base no tamanho da tela
function definirEditorasPorVezSite() {
    if (window.innerWidth <= 480) {
        return 1; // 1 editora em telas muito pequenas
    } else if (window.innerWidth <= 600) {
        return 2; // 2 editoras em telas pequenas
    } else if (window.innerWidth <= 800) {
        return 3; // 3 editoras em telas médias
    } else if (window.innerWidth <= 1000) {
        return 4; // 4 editoras em telas grandes
    }
    return 4; // Mantém 4 editoras em telas maiores (pode ajustar se necessário)
}

// Inicializa o número de editoras por vez
let editorasPorVez = definirEditorasPorVezSite();

// Função para mostrar os slides das editoras
function mostrarSlidesEditoras() {
    // Atualiza o número de editoras a serem exibidas de acordo com a largura da tela
    editorasPorVez = definirEditorasPorVezSite();

    // Esconder todas as editoras
    editoraSlides.forEach((slide) => {
        slide.classList.remove('visible', 'slide-in', 'slide-out');
        slide.style.opacity = 0; 
    });

    // Mostrar as editoras de acordo com a posição do índice
    for (let i = 0; i < editorasPorVez; i++) {
        let index = (slideIndexEditoras + i) % totalSlidesEditoras;
        editoraSlides[index].classList.add('visible', 'slide-in');
        setTimeout(() => {
            editoraSlides[index].style.opacity = 1; 
        }, 50);
    }
}

// Função para avançar o slide automaticamente
function moverSlideEditoras() {
    editoraSlides.forEach((slide) => {
        slide.classList.remove('slide-in');
        slide.classList.add('slide-out');
    });

    // Atualizar o índice do slide
    slideIndexEditoras = (slideIndexEditoras + editorasPorVez) % totalSlidesEditoras;

    setTimeout(() => {
        mostrarSlidesEditoras();
    }, 300);
}

// Adicionar um listener para redimensionamento da tela e ajustar os slides
window.addEventListener('resize', () => {
    editorasPorVez = definirEditorasPorVezSite();
    mostrarSlidesEditoras();
});

// Inicializa o carrossel
mostrarSlidesEditoras();

// Muda o slide automaticamente a cada 5 segundos
setInterval(moverSlideEditoras, 5000);
