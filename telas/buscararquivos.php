<?php
require_once '../Classes/Selecao.php';

$objetos = new Selecao();
$busca = new Selecao();

$resultado = $busca->selecionarMangasPorNota();
foreach ($resultado as $listar) {
    $idManga[] = $listar['id_manga'];
    $mangaName[] = $listar['manga_name'];
    $yearPublication[] = $listar['year_publication'];
    $synopsis[] = $listar['synopsis'];
    $manga_critic_note[] = $listar['manga_critic_note'];
    $manga_link[] = $listar['manga_link'];
    $volumes[] = $listar['volumes'];
    $caminhoImgManga[] = $listar['name_img'];
}

$resultLivro = $busca->selecionarLivrosPorNota();
foreach ($resultLivro as $listar) {
    $idBook[] = $listar['id_book'];
    $bookName[] = $listar['book_name'];
    $yearPublication[] = $listar['year_publication'];
    $synopsis[] = $listar['synopsis'];
    $book_critic_note[] = $listar['critic_note'];
    $book_link[] = $listar['books_link'];
    $pageNumber[] = $listar['pages_number'];
    $caminhoImgLivro[] = $listar['name_img'];
}

$resultHq = $busca->selecionarHqPorNota();
foreach ($resultHq as $listar) {
    $idHq[] = $listar['id_hq'];
    $hqName[] = $listar['hq_name'];
    $yearPublication[] = $listar['year_publication'];
    $synopsis[] = $listar['synopsis'];
    $hq_critic_note[] = $listar['critic_note'];
    $hq_link[] = $listar['hq_link'];
    $pageNumber[] = $listar['pages_number'];
    $caminhoImgHq[] = $listar['name_img'];
}


   // Chamada da função
   $itensOrdenados = $busca->selecionarItens();
    
   // Visualizando o resultado

?>
<!-- CABEÇALHO COM LINKS -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros - VBooks</title>
    <link rel="stylesheet" href="../src/css/principal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <!-- NAV-BAR DO VBOOKS -->
    <header class="container-nav">
        <div class="box-nav">
            <a href="/" aria-label="Voltar para a página inicial">
                <img src="../src/img/img-principais/logo_atualizada.png" alt="Logo do site">
            </a>
            <div class="search-container">
                <input type="text" placeholder="Buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-solid fa-x" aria-label="Fechar busca"></i>
            </div>
            <nav class="nav-links">
                <a href="/livros">Livros</a>
                <a href="/mangas">Mangás</a>
                <a href="/hqs">HQ's</a>
            </nav>
            <div class="user-flex">
                <i class="fa-solid fa-circle-user"></i>
                <p>@Renan</p>
            </div>
        </div>
    </header>

    <!-- CARROSSEL PRINCIPAL -->
    <section class="carrossel-principal">
        <div class="carrossel-container">
            <div class="carrossel-slide">
                <img src="../src/img/img-carrosel/img1.png" alt="Slide 1">
            </div>
            <div class="carrossel-slide">
                <img src="../src/img/img-carrosel/img2.png" alt="Slide 2">
            </div>
            <div class="carrossel-slide">
                <img src="../src/img/img-carrosel/img3.png" alt="Slide 3">
            </div>
            <div class="carrossel-slide">
                <img src="../src/img/img-carrosel/img4.png" alt="Slide 4">
            </div>
        </div>
    </section>

   <!-- FRASES SOBRE A EMPRESA -->
    <section class="info-empresa">
        <div class="info-item">
            <i class="fa-solid fa-book-open"></i> 
            <h3>Milhões de Títulos</h3>
            <p>Uma vasta coleção de livros de todo o mundo.</p>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-shield-alt"></i> 
            <h3>Site Seguro</h3>
            <p>Navegue com confiança, sua segurança é nossa prioridade.</p>
        </div>
        <div class="info-item">
            <i class="fa-solid fa-magnifying-glass"></i>
            <h3>Facilidade de Navegação</h3>
            <p>Encontre o que procura de forma rápida e simples.</p>
        </div>
    </section>

  <!-- CARROSSEL DE MAIS AVALIADOS -->
  <section class="carrossel-livros">
    <div class="header-carrossel">
        <h2>Mais Avaliados</h2>
        <button class="ver-todos">Ver todos</button>
    </div>
    <div class="carrossel-container-livros">
        <button class="carrossel-button anterior-livro" onclick="moverSlideLivros(-1)">&#10094;</button>
        <div class="carrossel-wrapper-livros">
        <?php 
            // Obtém todos os itens já ordenados por média de nota
            
            // Limite para exibir os primeiros 15 itens
            $limite = min(15, count($itensOrdenados));
            
            for ($i = 0; $i < $limite && $i < count($itensOrdenados); $i++) { 
                $item = $itensOrdenados[$i]; // Obter item atual
            ?>
                <div class="carrossel-slide-livro">
                    <div class="card-hq">
                        <button class="add-lista-hq">+</button>
                        <img src="<?= isset($item['name_img']) ? $item['name_img'] : 'default.jpg'; ?>" alt="Capa">
                        <div class="info-hq">
                            <p class="nome-hq">
                                <?= $item['manga_name'] ?? $item['book_name'] ?? $item['hq_name'] ?? 'Título Indisponível'; ?>
                            </p>
                            <p class="nota-hq">
                                <?= $item['manga_critic_note'] ?? $item['critic_note'] ?? 'N/A'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carrossel-button proximo-livro" onclick="moverSlideLivros(1)">&#10095;</button>
    </div>
</section>

<!-- CARROSSEL DE LIVROS DO SITE -->
<section class="carrossel-livros-site">
    <div class="header-carrossel-site">
        <h2>Livros do Site</h2>
        <button class="ver-todos-site">Ver todos</button>
    </div>
    <div class="carrossel-container-livros-site">
        <button class="carrossel-button anterior-livro-site">&#10094;</button>
        <div class="carrossel-wrapper-livros-site">
        <?php for ($i = 0; $i < 7 && $i < count($resultLivro); $i++) { ?>
    <!-- Seu código aqui para processar cada $resultLivro[$i] -->

                <div class="carrossel-slide-livro-site">
                    <div class="card-livro-site">
                        <button class="add-lista-site">+</button>
                        <img src="<?= $caminhoImgLivro[$i]; ?>" alt="Capa do Livro">
                        <div class="info-livro-site">
                            <p class="nome-site"><?= $bookName[$i]; ?></p>
                            <p class="nota-site"><?= $book_critic_note[$i]; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carrossel-button proximo-livro-site">&#10095;</button>
    </div>
</section>

<!-- CARROSSEL DE MANGÁS -->
<section class="carrossel-manga">
    <div class="header-carrossel-manga">
        <h2>Mangás do Site</h2>
        <button class="ver-todos-manga">Ver todos</button>
    </div>
    <div class="carrossel-container-manga">
        <button class="carrossel-button anterior-manga">&#10094;</button>
        <div class="carrossel-wrapper-manga">
        <?php for ($i = 0; $i < 7 && $i < count($resultado); $i++) { ?>
                <div class="carrossel-slide-manga">
                    <div class="card-manga">
                        <button class="add-lista-manga">+</button>
                        <img src="<?= $caminhoImgManga[$i]; ?>" alt="Capa do Mangá">
                        <div class="info-manga">
                            <p class="nome-manga"><?= $mangaName[$i]; ?></p>
                            <p class="nota-manga"><?= $manga_critic_note[$i]; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carrossel-button proximo-manga">&#10095;</button>
    </div>
</section>

<!-- CARROSSEL DE HQS -->
<section class="carrossel-hq">
    <div class="header-carrossel-hq">
        <h2>HQs do Site</h2>
        <button class="ver-todos-hq">Ver todos</button>
    </div>
    <div class="carrossel-container-hq">
        <button class="carrossel-button anterior-hq">&#10094;</button>
        <div class="carrossel-wrapper-hq">
        <?php for ($i = 0; $i < 7 && $i < count($resultHq); $i++) { ?>
                <div class="carrossel-slide-hq">
                    <div class="card-hq">
                        <button class="add-lista-hq">+</button>
                        <img src="<?= $caminhoImgHq[$i]; ?>" alt="Capa da HQ">
                        <div class="info-hq">
                            <p class="nome-hq"><?= $hqName[$i]; ?></p>
                            <p class="nota-hq"><?= $hq_critic_note[$i]; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carrossel-button proximo-hq">&#10095;</button>
    </div>
</section>



<!-- CARROSSEL DE EDITORAS -->
<section class="carrossel-editoras">
    <div class="header-carrossel-editoras">
        <h2>Editoras de Destaque</h2>
    </div>
    <div class="carrossel-container-editoras">
        <div class="carrossel-wrapper-editoras">
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://panini.com.br/home-planetmanga">
                        <img src="../src/img/img-editoras/planet_manga.png" alt="Planet Mangá">
                    </a>
                </div>
            </div>
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://www.amazon.com.br/Livros/b?node=6740748011">
                        <img src="../src/img/img-editoras/panimi.png" alt="Panini">
                    </a>
                </div>
            </div>
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://www.marvel.com/comics">
                        <img src="../src/img/img-editoras/marvel_comics.png" alt="Marvel Comics">
                    </a>
                </div>
            </div>
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://www.dc.com/comics">
                        <img src="../src/img/img-editoras/dc.png" alt="Dc Comics">
                    </a>
                </div>
            </div>
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://www.editoradodireito.com.br/?msclkid=904d2ce7b68a15d62d804a1734d674ec">
                        <img src="../src/img/img-editoras/saraiva.png" alt="Saraiva">
                    </a>
                </div>
            </div>
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://www.amazon.com.br/Livros/b?node=6740748011">
                        <img src="../src/img/img-editoras/amazon.png" alt="Amazon">
                    </a>
                </div>
            </div>
            <div class="carrossel-slide-editora">
                <div class="card-editora">
                    <a href="https://www.editoraarqueiro.com.br/">
                        <img src="../src/img/img-editoras/arqueiro.jpg" alt="Arqueiro">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- RODAPÉ -->
    <footer class="rodape">
    <div class="conteudo-rodape">
        <div class="logo-rodape">
            <img src="../src/img/img-principais/logo_vbooks.png" alt="Logo do site">
        </div>
        <div class="frase-rodape">
            <p>“Um leitor vive milhões de vidas antes de morrer. 
                Um homem que nunca lê vive apenas uma.” - George R. R. Martin</p>
        </div>
    </div>
    <div class="redes-sociais">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
    </div>
    <p>&copy; 2024 VBooks - Toda pirataria da Boa.</p>
</footer>
    <script src="../src/js/carrossel.js"></script>
    <script src="../src/js/carrossel_livros.js"></script>
    <script src="../src/js/carrossel_manga.js"></script>
    <script src="../src/js/carrossel_hq.js"></script>
    <script src="../src/js/carrossel_editoras.js"></script>
</body>
</html>