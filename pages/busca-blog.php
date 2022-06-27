<?php
$filtro = str_replace("-", "|", url_amigavel($parametro));

// definir o numero de itens por pagina
$itens_por_pagina = 10;

// pegar a pagina atual
$pagina = intval($numero_pagina - 1 . "0");

//verifica se a página é menor que 0
if ($pagina < 0) {
    include "pages/404.php";
} else {

// pega a quantidade total de objetos no banco de dados
    $vsSqlTotal = "
        SELECT
            titulo,
            imagem,
            url_amigavel,
            DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada
        FROM
            blog_postagem
        WHERE
            data_publicacao < '$data_hora_atual' AND
            url_amigavel REGEXP '$filtro'
        ORDER BY
            data_publicacao DESC
    ";
    $vrsExecutaTotal = mysqli_query($Conexao, $vsSqlTotal) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
    $viNumRowsTotal = mysqli_num_rows($vrsExecutaTotal);
    $voResultadoTotal = mysqli_fetch_object($vrsExecutaTotal);

// puxar produtos do banco
    $vsSqlBusca = "
        $vsSqlTotal
        LIMIT $pagina, $itens_por_pagina
    ";
    $vrsExecutaBusca = mysqli_query($Conexao, $vsSqlBusca) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
    $viNumRowsBusca = mysqli_num_rows($vrsExecutaBusca);

// definir numero de páginas
    $num_paginas = ceil($viNumRowsTotal / $itens_por_pagina);
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <?php
            // HEAD
            include 'php/head.php';
            ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:title" content="<?php echo "Busca de blog - " . $voResultadoConfiguracoes->titulo ?>"/>
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "busca-blog/" . $filtro ?>"/>
            <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
            <title><?php echo "Busca de blog - " . $voResultadoConfiguracoes->titulo ?></title>
        </head>

        <body>

            <?php
            // PRELOADER
            include 'php/preloader.php';

            // MENU
            include 'php/menu.php';
            ?>

            <section class="page-title-area">
                <div class="container">
                    <h2 class="title"><?php echo 'Resultados de "' . $filtro . '"' ?></h2>
                    <ul class="breadcrumb-nav">
                        <li><a href="<?php echo URL ?>">Home</a></li>
                        <li><a href="<?php echo URL . "blog" ?>">Blog</a></li>
                        <li class="active">Busca de blog</li>
                    </ul>
                </div>
            </section>

            <section class="blog-area section-gap">
                <div class="container">
                    <div class="blog-grid-items row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <?php
                            /* CONSULTA POSTS */
                            if ($viNumRowsBusca > 0) {
                                ?>
                                <div class="row">
                                    <?php
                                    /* CONSULTA POSTS */
                                    while ($voResultadoBusca = mysqli_fetch_object($vrsExecutaBusca)) {
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-8">
                                            <div class="latest-news-box mt-30">
                                                <div class="post-thumb">
                                                    <a href="<?php echo URL . "post/" . $voResultadoBusca->url_amigavel ?>">
                                                        <img src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoBusca->imagem ?>" title="<?php echo $voResultadoBusca->titulo ?>" alt="<?php echo $voResultadoBusca->titulo ?>">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <ul class="post-meta">
                                                        <li><i class="fal fa-calendar-alt"></i> <?php echo $voResultadoBusca->data_publicacao_formatada ?></li>
                                                    </ul>
                                                    <h4 class="title">
                                                        <a href="<?php echo URL . "post/" . $voResultadoBusca->url_amigavel ?>"><?php echo $voResultadoBusca->titulo ?></a>
                                                    </h4>
                                                    <a href="<?php echo URL . "post/" . $voResultadoBusca->url_amigavel ?>" class="read-more-btn">Ver Mais <i class="fal fa-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <ul class="page-pagination blog-pagination mt-80">
                                    <li><a href="<?php echo URL . "busca-blog/" . $filtro ?>"><i class="fal fa-arrow-left"></i></a></li>
                                    <?php
                                    $limite = 10;

                                    if ($num_paginas <= $limite) {
                                        $minimo = 0;
                                        $maximo = $num_paginas;
                                    } else if ($numero_pagina < $limite) {
                                        $minimo = 0;
                                        $maximo = $limite;
                                    } else if ($numero_pagina > ($num_paginas - 9)) {
                                        $minimo = $num_paginas - $limite;
                                        $maximo = $num_paginas;
                                    } else {
                                        $minimo = $numero_pagina - 6;
                                        $maximo = $numero_pagina + 5;
                                    }

                                    for ($i = $minimo; $i < $maximo; $i++) {
                                        $estilo = "";
                                        if ($numero_pagina == $i + 1)
                                            $estilo = "active";
                                        ?>
                                        <li><a href="<?php echo URL . "busca-blog/" . $filtro . "/" ?><?php echo $i + 1 ?>" class="<?php echo $estilo ?>"><?php echo $i + 1 ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo URL . "busca-blog/" . $filtro . "/" . $num_paginas ?>"><i class="fal fa-arrow-right"></i></a></li>
                                </ul>
                                <?php
                            } else {
                                ?>
                                <div class="text-center">
                                    <h2 class="mb-30">
                                        Nenhum resultado encontrado!
                                    </h2>
                                    <a href="<?php echo URL . "blog" ?>" class="main-btn">
                                        Voltar a página inicial do blog
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                        // COLUNA DIREITA BLOG
                        include 'php/coluna-direita-blog.php';
                        ?>

                    </div>
                </div>
            </section>

            <div class="back-to-top">
                <a href="#"> <i class="fas fa-arrow-up"></i> </a>
            </div>

            <?php
            // RODAPÉ
            include 'php/rodape.php';

            // CSS
            include 'php/css.php';

            // SCRIPTS
            include 'php/scripts.php';
            ?>

        </body>
    </html>
    <?php
}