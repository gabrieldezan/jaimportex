<?php
$vsSqlPost = "
    SELECT
        id_blog_postagem,
        titulo,
        imagem,
        texto,
        DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada,
        url_amigavel
    FROM
        blog_postagem
    WHERE
        url_amigavel = '$parametro'
";
$vrsExecutaPost = mysqli_query($Conexao, $vsSqlPost) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
$vrsQntPost = mysqli_num_rows($vrsExecutaPost);

if ($vrsQntPost > 0) {
    $voResultadoPost = mysqli_fetch_object($vrsExecutaPost);

    $vsSqlView = "UPDATE blog_postagem SET visualizacoes = visualizacoes+1 WHERE url_amigavel= '$parametro'";
    mysqli_query($Conexao, $vsSqlView) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));

    $vsSqlPostGaleria = "SELECT descricao, imagem FROM blog_postagem_galeria WHERE id_blog_postagem = '$voResultadoNoticia->id_blog_postagem'";
    $vrsExecutaPostGaleria = mysqli_query($Conexao, $vsSqlPostGaleria) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
    $vrsQntPostGaleria = mysqli_num_rows($vrsExecutaPostGaleria);
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
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoPost->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoPost->texto)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:title" content="<?php echo $voResultadoPost->titulo . " - " . $voResultadoConfiguracoes->titulo ?>"/>
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoPost->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoPost->texto)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/blog_postagens/" . $voResultadoPost->imagem ?>"/>
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "post/" . $parametro ?>"/>
            <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
            <title><?php echo $voResultadoPost->titulo . " - " . $voResultadoConfiguracoes->titulo ?></title>
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
                    <h2 class="title"><?php echo $voResultadoPost->titulo ?></h2>
                    <ul class="breadcrumb-nav">
                        <li><a href="<?php echo URL ?>">Home</a></li>
                        <li><a href="<?php echo URL . "blog" ?>">Blog</a></li>
                        <li class="active"><?php echo $voResultadoPost->titulo ?></li>
                    </ul>
                </div>
            </section>

            <section class="blog-area section-gap">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="blog-dteails-content">
                                <figure class="mb-0">
                                    <img src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoPost->imagem ?>" title="<?php echo $voResultadoPost->titulo ?>" alt="<?php echo $voResultadoPost->titulo ?>">
                                </figure>
                                <div class="p-20">
                                    <h3 class="title">
                                        <?php echo $voResultadoPost->titulo ?>
                                    </h3>
                                    <ul class="post-meta">
                                        <li><i class="fal fa-calendar-alt"></i><?php echo $voResultadoPost->data_publicacao_formatada ?></li>
                                    </ul>
                                    <?php echo $voResultadoPost->texto ?>
                                    <div class="post-footer mt-40 mb-40">
                                        <div class="justify-content-between">
                                            <div class="social-share">
                                                <h5>Compartilhe nas redes sociais</h5>
                                                <ul>
                                                    <li><a href="<?php echo "https://api.whatsapp.com/send?text=Leia mais em: https://" . $_SERVER['HTTP_HOST'] . URL . "noticia/" . $categoria . "/" . $parametro ?>" onclick="window.open(this.href, 'windowName', 'width=600, height=400, left=24, top=24, scrollbars, resizable'); return false;" rel="nofollow" target="blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                                                    <li><a href="<?php echo "http://www.facebook.com/sharer.php?u=https://" . $_SERVER['HTTP_HOST'] . URL . "noticia/" . $categoria . "/" . $parametro ?>&title=<?php echo $voResultadoNoticia->titulo ?>" onclick="window.open(this.href, 'windowName', 'width=600, height=400, left=24, top=24, scrollbars, resizable'); return false;" rel="nofollow" target="blank" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                                                    <li><a href="<?php echo "http://twitter.com/share?url=https://" . $_SERVER['HTTP_HOST'] . URL . "noticia/" . $categoria . "/" . $parametro ?>&title=<?php echo $voResultadoNoticia->titulo ?>" onclick="window.open(this.href, 'windowName', 'width=600, height=400, left=24, top=24, scrollbars, resizable'); return false;" rel="nofollow" target="blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="<?php echo "http://pinterest.com/pin/create/button/?url=https://" . $_SERVER['HTTP_HOST'] . URL . "noticia/" . $categoria . "/" . $parametro ?>&amp;media=<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoNoticia->imagem ?>&amp;description=<?php echo substr(strip_tags(trim($voResultadoNoticia->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoNoticia->texto)), 0, 140), ' ')) . '...'; ?>" onclick="window.open(this.href, 'windowName', 'width=600, height=400, left=24, top=24, scrollbars, resizable'); return false;" rel="nofollow" target="blank" title="Pinterest"><i class="fab fa-pinterest-p"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
} else {
    include "pages/404.php";
}