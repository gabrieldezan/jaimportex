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
        <meta property="og:title" content="<?php echo $voResultadoConfiguracoes->titulo ?>"/>
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL ?>"/>
        <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
        <title><?php echo $voResultadoConfiguracoes->titulo ?></title>
    </head>

    <body>

        <?php
        // PRELOADER
        include 'php/preloader.php';

        // MENU
        include 'php/menu.php';
        ?>

        <section class="banner-slider banner-slider-one banner-slider-active">
            <?php
            $vsSqlBanner = "SELECT titulo, imagem, descricao, link FROM banner ORDER BY id_banner DESC";
            $vrsExecutaBanner = mysqli_query($Conexao, $vsSqlBanner) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
            while ($voResultadoBanner = mysqli_fetch_object($vrsExecutaBanner)) {
                ?>
                <div class="single-banner">
                    <div class="container-fluid container-1470">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="banner-text">
                                    <div class="banner-content">
                                        <h1 data-animation="fadeInLeft" data-delay="0.6s" class="title">
                                            <?php echo $voResultadoBanner->titulo ?>
                                        </h1>
                                        <p data-animation="fadeInLef t" data-delay=".9s">
                                            <?php echo $voResultadoBanner->descricao ?>
                                        </p>
                                        <?php if ($voResultadoBanner->link != null || !empty($voResultadoBanner->link)) { ?>
                                            <?php if ($voResultadoBanner->link_nova_aba == 1) { ?>
                                                <a target="_blank" data-animation="fadeInUp" data-delay="1.1s" class="main-btn rounded-btn icon-right small-size" href="<?php echo $voResultadoBanner->link ?>">
                                                    Ver Mais <i class="fal fa-long-arrow-right"></i>
                                                </a>
                                                <?php
                                            } else if ($voResultadoBanner->link_nova_aba == 0) {
                                                ?>
                                                <a data-animation="fadeInUp" data-delay="1.1s" class="main-btn rounded-btn icon-right small-size" href="<?php echo $voResultadoBanner->link ?>">
                                                    Ver Mais <i class="fal fa-long-arrow-right"></i>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 d-lg-block">
                                <div class="banner-img" data-animation="fadeInRight" data-delay="0.5s">
                                    <img src="<?php echo URL . "wdadmin/uploads/banners_slideshow/" . $voResultadoBanner->imagem ?>" alt="Banner">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </section>

        <section class="about-intro-video section-gap-bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                    $vsSqlQuemSomos = "SELECT texto, imagem FROM sobre";
                    $vrsExecutaQuemSomos = mysqli_query($Conexao, $vsSqlQuemSomos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoQuemSomos = mysqli_fetch_object($vrsExecutaQuemSomos)) {
                        ?>
                        <div class="col-lg-6 col-md-10">
                            <div class="intro-video-with-shape mb-md-gap-50">
                                <img src="<?php echo URL . "wdadmin/uploads/sobre/" . $voResultadoQuemSomos->imagem ?>" title="Quem Somos" alt="Quem Somos">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-10">
                            <div class="feature-text-block">
                                <div class="section-title mb-20">
                                    <?php
                                    $vsSqlTituloQuemSomos = "SELECT titulo, subtitulo, imagem FROM titulos_personalizados WHERE id_titulos_personalizados = 1";
                                    $vrsExecutaTituloQuemSomos = mysqli_query($Conexao, $vsSqlTituloQuemSomos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                    while ($voResultadoTituloQuemSomos = mysqli_fetch_object($vrsExecutaTituloQuemSomos)) {
                                        ?>
                                        <img src="<?php echo URL . "wdadmin/uploads/titulos_personalizados/" . $voResultadoTituloQuemSomos->imagem ?>">
                                        <span><?php echo $voResultadoTituloQuemSomos->titulo ?></span>
                                        <h2 class="title"><?php echo $voResultadoTituloQuemSomos->subtitulo ?></h2>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php echo $voResultadoQuemSomos->texto ?>
                                <a class="main-btn mt-30" href="<?php echo URL . "quem-somos" ?>">Ver Mais <i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="portfolio-area portfolio-area-shape primary-bg section-gap">
            <div class="container">
                <div class="portfolio-top-title mb-60">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="section-title mb-45">
                                <?php
                                $vsSqlTituloServicos = "SELECT titulo, subtitulo, imagem FROM titulos_personalizados WHERE id_titulos_personalizados = 2";
                                $vrsExecutaTituloServicos = mysqli_query($Conexao, $vsSqlTituloServicos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoTituloServicos = mysqli_fetch_object($vrsExecutaTituloServicos)) {
                                    ?>
                                    <img src="<?php echo URL . "wdadmin/uploads/titulos_personalizados/" . $voResultadoTituloServicos->imagem ?>">
                                    <span class="text-white"><?php echo $voResultadoTituloServicos->titulo ?></span>
                                    <h2 class="title text-white"><?php echo $voResultadoTituloServicos->subtitulo ?></h2>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="portfolio-arrow"></div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-items portfolio-slider-one row">
                    <?php
                    $vsSqlServicos = "SELECT titulo, descricao, imagem, icone, url_amigavel FROM servicos WHERE status = 1";
                    $vrsExecutaServicos = mysqli_query($Conexao, $vsSqlServicos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoServicos = mysqli_fetch_object($vrsExecutaServicos)) {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="service-item-eight mb-30">
                                <div class="service-img">
                                    <a href="<?php echo URL . "servico/" . $voResultadoServicos->url_amigavel ?>">
                                        <img src="<?php echo URL . "wdadmin/uploads/servicos/" . $voResultadoServicos->imagem ?>" title="<?php echo $voResultadoServicos->titulo ?>" alt="<?php echo $voResultadoServicos->titulo ?>">
                                    </a>
                                </div>
                                <div class="services-overlay">
                                    <div class="icon"><i class="<?php echo $voResultadoServicos->icone ?>"></i></div>
                                    <h4 class="title"><a href="<?php echo URL . "servico/" . $voResultadoServicos->url_amigavel ?>"><?php echo $voResultadoServicos->titulo ?></a></h4>
                                    <p><?php echo substr(strip_tags(trim($voResultadoServicos->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoServicos->descricao)), 0, 137), ' ')) . '...'; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="brand-section pt-100 pb-100">
            <div class="container">
                <div class="section-title text-center mb-60">
                    <?php
                    $vsSqlTituloParceiros = "SELECT titulo, subtitulo, imagem FROM titulos_personalizados WHERE id_titulos_personalizados = 3";
                    $vrsExecutaTituloParceiros = mysqli_query($Conexao, $vsSqlTituloParceiros) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoTituloParceiros = mysqli_fetch_object($vrsExecutaTituloParceiros)) {
                        ?>
                        <img src="<?php echo URL . "wdadmin/uploads/titulos_personalizados/" . $voResultadoTituloParceiros->imagem ?>">
                        <span><?php echo $voResultadoTituloParceiros->titulo ?></span>
                        <h2 class="title"><?php echo $voResultadoTituloParceiros->subtitulo ?></h2>
                        <?php
                    }
                    ?>
                </div>
                <div class="brand-slider row">
                    <?php
                    $vsSqlParceiros = "SELECT titulo, imagem, link FROM informacoes WHERE id_conteudo_personalizado = 5 ORDER BY id_informacoes DESC";
                    $vrsExecutaParceiros = mysqli_query($Conexao, $vsSqlParceiros) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoParceiros = mysqli_fetch_object($vrsExecutaParceiros)) {
                        ?>
                        <div class="col">
                            <div class="brand-item">
                                <?php if ($voResultadoParceiros->link != null || !empty($voResultadoParceiros->link)) { ?>
                                <a target="_blank" href="<?php echo $voResultadoParceiros->link ?>">
                                        <img src="<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoParceiros->imagem ?>" title="<?php echo $voResultadoParceiros->titulo ?>" alt="<?php echo $voResultadoParceiros->titulo ?>">
                                    </a>
                                <?php } else { ?>
                                    <img src="<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoParceiros->imagem ?>" title="<?php echo $voResultadoParceiros->titulo ?>" alt="<?php echo $voResultadoParceiros->titulo ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <?php
        $vsSqlChamadaContato = "SELECT titulo, imagem, link FROM informacoes WHERE id_conteudo_personalizado = 1 ORDER BY id_informacoes DESC LIMIT 1";
        $vrsExecutaChamadaContato = mysqli_query($Conexao, $vsSqlChamadaContato) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
        while ($voResultadoChamadaContato = mysqli_fetch_object($vrsExecutaChamadaContato)) {
            ?>
            <section class="call-to-action" style="background-image: url(<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoChamadaContato->imagem ?>);">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="section-title white-color">
                                <?php
                                $vsSqlTituloChamadaContato = "SELECT titulo, imagem FROM titulos_personalizados WHERE id_titulos_personalizados = 4";
                                $vrsExecutaTituloChamadaContato = mysqli_query($Conexao, $vsSqlTituloChamadaContato) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoTituloChamadaContato = mysqli_fetch_object($vrsExecutaTituloChamadaContato)) {
                                    ?>
                                    <img src="<?php echo URL . "wdadmin/uploads/titulos_personalizados/" . $voResultadoTituloChamadaContato->imagem ?>" title="<?php echo $voResultadoTituloChamadaContato->titulo ?>" alt="<?php echo $voResultadoTituloChamadaContato->titulo ?>">
                                    <span><?php echo $voResultadoTituloChamadaContato->titulo ?></span>
                                    <?php
                                }
                                ?>
                                <h2 class="title">
                                    <?php echo $voResultadoChamadaContato->titulo ?>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 botao-ver-mais">
                            <a href="<?php echo $voResultadoChamadaContato->link ?>" class="main-btn rounded-btn mt-md-gap-30">Fale conosco <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
        ?>

<!--        <section class="latest-news section-gap">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-8">
                        <div class="section-title">
                            <?php
                            $vsSqlTituloBlog = "SELECT titulo, subtitulo, imagem FROM titulos_personalizados WHERE id_titulos_personalizados = 5";
                            $vrsExecutaTituloBlog = mysqli_query($Conexao, $vsSqlTituloBlog) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                            while ($voResultadoTituloBlog = mysqli_fetch_object($vrsExecutaTituloBlog)) {
                                ?>
                                <img src="<?php echo URL . "wdadmin/uploads/titulos_personalizados/" . $voResultadoTituloBlog->imagem ?>">
                                <span><?php echo $voResultadoTituloBlog->titulo ?></span>
                                <h2 class="title"><?php echo $voResultadoTituloBlog->subtitulo ?></h2>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 botao-ver-mais">
                        <a href="<?php echo URL . "blog" ?>" class="main-btn rounded-btn mt-md-gap-30">Ver todos <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php
                    $vsSqlNoticiasHome = "
                        SELECT
                            titulo,
                            texto,
                            imagem,
                            url_amigavel,
                            DATE_FORMAT(data_publicacao, '%d/%m/%Y') AS data_publicacao_formatada
                        FROM
                            blog_postagem
                        WHERE
                            data_publicacao < '$data_hora_atual'
                        ORDER BY
                            data_publicacao DESC
                        LIMIT 3
                    ";
                    $vrsExecutaNoticiasHome = mysqli_query($Conexao, $vsSqlNoticiasHome) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoNoticiasHome = mysqli_fetch_object($vrsExecutaNoticiasHome)) {
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-8 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="latest-news-box mt-30">
                                <div class="post-thumb">
                                    <a href="<?php echo URL . "post/" . $voResultadoNoticiasHome->url_amigavel ?>">
                                        <img src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoNoticiasHome->imagem ?>" title="<?php echo $voResultadoNoticiasHome->titulo ?>" alt="<?php echo $voResultadoNoticiasHome->titulo ?>">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li><i class="fal fa-calendar-alt"></i> <?php echo $voResultadoNoticiasHome->data_publicacao_formatada ?></li>
                                    </ul>
                                    <h4 class="title">
                                        <a href="<?php echo URL . "post/" . $voResultadoNoticiasHome->url_amigavel ?>"><?php echo $voResultadoNoticiasHome->titulo ?></a>
                                    </h4>
                                    <a href="<?php echo URL . "post/" . $voResultadoNoticiasHome->url_amigavel ?>" class="read-more-btn">Ver Mais <i class="fal fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>-->

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