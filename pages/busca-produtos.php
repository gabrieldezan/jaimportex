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
            vp.descricao,
            vp.imagem,
            vp.valor,
            CONCAT(vp.url_amigavel, '-', vp.id_vitrine_produto) AS url_produto,
            vs.url_amigavel AS url_categoria,
            vs.id_vitrine_subgrupo,
            vs.descricao AS categoria
        FROM
            vitrine_produto vp
            INNER JOIN vitrine_subgrupo vs ON vp.id_vitrine_subgrupo = vs.id_vitrine_subgrupo
        WHERE
            vp.descricao REGEXP '$filtro' AND
            vp.status = 1 AND
            vs.status = 1
        ORDER BY
            vp.id_vitrine_produto DESC
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
            <meta property="og:title" content="<?php echo "Busca de produtos - " . $voResultadoConfiguracoes->titulo ?>"/>
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "busca-produtos/" . $parametro ?>"/>
            <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
            <title><?php echo "Busca de produtos - " . $voResultadoConfiguracoes->titulo ?></title>
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
                        <li>Produtos</li>
                        <li class="active">Busca de produtos</li>
                    </ul>
                </div>
            </section>

            <section class="product-area soft-blue-bg section-gap">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <?php
                            // FORM BUSCA PRODUTOS
                            include 'php/form-busca-produtos.php';

                            /* CONSULTA PRODUTOS */
                            if ($viNumRowsBusca > 0) {
                                ?>
                                <div class="row entry-products">
                                    <?php
                                    while ($voResultadoBusca = mysqli_fetch_object($vrsExecutaBusca)) {
                                        ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="product-item mt-30">
                                                <div class="product-thumb">
                                                    <img src="<?php echo URL . "wdadmin/uploads/vitrine_produtos/" . $voResultadoBusca->imagem ?>" title="<?php echo $voResultadoBusca->descricao ?>" alt="<?php echo $voResultadoBusca->descricao ?>">
                                                    <div class="product-overlay">
                                                        <ul>
                                                            <li><a href="<?php echo URL . "produto/" . $voResultadoBusca->url_categoria . "/" . $voResultadoBusca->url_produto ?>"><i class="fal fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h5 class="title"><a href="<?php echo URL . "produto/" . $voResultadoBusca->url_categoria . "/" . $voResultadoBusca->url_produto ?>"><?php echo $voResultadoBusca->descricao ?></a></h5>
                                                    <?php if ($voResultadoBusca->valor != null || !empty($voResultadoBusca->valor)) { ?>
                                                        <p class="price"><?php echo "R$ " . $voResultadoBusca->valor ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <ul class="page-pagination blog-pagination mt-80">
                                    <li><a href="<?php echo URL . "busca-produtos/" . $filtro ?>"><i class="fal fa-arrow-left"></i></a></li>
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
                                        <li><a href="<?php echo URL . "busca-produtos/" . $filtro . "/" ?><?php echo $i + 1 ?>" class="<?php echo $estilo ?>"><?php echo $i + 1 ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo URL . "busca-produtos/" . $filtro . "/" . $num_paginas ?>"><i class="fal fa-arrow-right"></i></a></li>
                                </ul>
                                <?php
                            } else {
                                ?>
                                <div class="text-center">
                                    <h2 class="mb-30">
                                        Nenhum resultado encontrado!
                                    </h2>
                                    <a href="<?php echo URL ?>" class="main-btn">
                                        Voltar a página inicial
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
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