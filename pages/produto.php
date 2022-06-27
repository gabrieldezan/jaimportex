<?php
$vsSqlProduto = "
    SELECT
        vp.descricao,
        vp.imagem,
        vp.valor,
        vp.detalhes,
        CONCAT(vp.url_amigavel, '-', vp.id_vitrine_produto) AS url_produto,
        vs.url_amigavel AS url_categoria,
        vs.id_vitrine_subgrupo,
        vs.descricao AS categoria
    FROM
        vitrine_produto vp
        INNER JOIN vitrine_subgrupo vs ON vp.id_vitrine_subgrupo = vs.id_vitrine_subgrupo
    WHERE
        vp.status = 1 AND
        vs.status = 1 AND
        CONCAT(vp.url_amigavel, '-', vp.id_vitrine_produto) = '$parametro' AND
        vs.url_amigavel = '$categoria'
    ORDER BY
        vp.id_vitrine_produto DESC
";
$vrsExecutaProduto = mysqli_query($Conexao, $vsSqlProduto) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
$vrsQntProduto = mysqli_num_rows($vrsExecutaProduto);

if ($vrsQntProduto > 0) {
    $voResultadoProduto = mysqli_fetch_object($vrsExecutaProduto);
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
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoProduto->detalhes)), 0, strrpos(substr(strip_tags(trim($voResultadoProduto->detalhes)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:title" content="<?php echo $voResultadoProduto->descricao . " - " . $voResultadoConfiguracoes->titulo ?>"/>
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoProduto->detalhes)), 0, strrpos(substr(strip_tags(trim($voResultadoProduto->detalhes)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/blog_postagens/" . $voResultadoPost->imagem ?>"/>
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "produtos/" . $categoria . "/" . $parametro ?>"/>
            <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
            <title><?php echo $voResultadoProduto->descricao . " - " . $voResultadoConfiguracoes->titulo ?></title>
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
                    <h2 class="title"><?php echo $voResultadoProduto->descricao ?></h2>
                    <ul class="breadcrumb-nav">
                        <li><a href="<?php echo URL ?>">Home</a></li>
                        <li>Produtos</li>
                        <li><a href="<?php echo URL . "produtos/" . $voResultadoProduto->url_categoria ?>"><?php echo $voResultadoProduto->categoria ?></a></li>
                        <li class="active"><?php echo $voResultadoProduto->descricao ?></li>
                    </ul>
                </div>
            </section>

            <section class="product-details-area soft-blue-bg section-gap">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="product-gallery-wrap mb-md-gap-50">
                                <div class="product-main-slider">
                                    <div class="image">
                                        <img src="<?php echo URL . "wdadmin/uploads/vitrine_produtos/" . $voResultadoProduto->imagem ?>" title="<?php echo $voResultadoProduto->descricao ?>" alt="<?php echo $voResultadoProduto->descricao ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-summery">
                                <a class="cat" href="<?php echo URL . "produtos/" . $voResultadoProduto->url_categoria ?>"><?php echo $voResultadoProduto->categoria ?></a>
                                <h4 class="title"><?php echo $voResultadoProduto->descricao ?></h4>
                                <p class="price"><?php echo $voResultadoProduto->valor ?></p>
                                <p class="short-desc"><?php echo $voResultadoProduto->detalhes ?></p>
                                <div class="cart-form">
                                    <a href="<?php echo "https://api.whatsapp.com/send?l=pt_BR&phone=" . str_replace(array("(", ")", "+", "-", " "), "", $voResultadoConfiguracoes->whatsapp) ?>" target="_blank" class="main-btn">
                                        <i class="fab fa-whatsapp"></i>
                                        Peça pelo whatsapp
                                    </a>
                                </div>
                            </div>
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
} else {
    include "pages/404.php";
}