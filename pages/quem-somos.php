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
        <meta property="og:title" content="<?php echo "Quem Somos - " . $voResultadoConfiguracoes->titulo ?>"/>
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "quem-somos" ?>"/>
        <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
        <title><?php echo "Quem Somos - " . $voResultadoConfiguracoes->titulo ?></title>
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
                <h2 class="title">Quem Somos</h2>
                <ul class="breadcrumb-nav">
                    <li><a href="<?php echo URL ?>">Home</a></li>
                    <li class="active">Quem Somos</li>
                </ul>
            </div>
        </section>

        <section class="about-intro-video">
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
                                <div class="section-title text-left mb-20">
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
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="experience-section">
            <div class="container">
                <div class="row justify-content-center mt-60">
                    <?php
                    $vsSqlMVV = "SELECT texto_missao, imagem_missao, icone_missao, texto_visao, imagem_visao, icone_visao, texto_valores, imagem_valores, icone_valores FROM missao_visao_valores";
                    $vrsExecutaMVV = mysqli_query($Conexao, $vsSqlMVV) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoMVV = mysqli_fetch_object($vrsExecutaMVV)) {
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-8 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="feature-box mt-30">
                                <img src="<?php echo URL . "wdadmin/uploads/missao_visao_valores/" . $voResultadoMVV->imagem_missao ?>" alt="">
                                <div class="feature-overlay">
                                    <div class="content">
                                        <h5 class="title">Missão</h5>
                                        <p><?php echo $voResultadoMVV->texto_missao ?></p>
                                        <i class="<?php echo $voResultadoMVV->icone_missao ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-lg-4 col-md-6 col-sm-8 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="feature-box mt-30">
                                <img src="<?php echo URL . "wdadmin/uploads/missao_visao_valores/" . $voResultadoMVV->imagem_visao ?>" alt="">
                                <div class="feature-overlay">
                                    <div class="content">
                                        <h5 class="title">Visão</h5>
                                        <p><?php echo $voResultadoMVV->texto_visao ?></p>
                                        <i class="<?php echo $voResultadoMVV->icone_visao ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-lg-4 col-md-6 col-sm-8 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="feature-box mt-30">
                                <img src="<?php echo URL . "wdadmin/uploads/missao_visao_valores/" . $voResultadoMVV->imagem_valores ?>" alt="">
                                <div class="feature-overlay">
                                    <div class="content">
                                        <h5 class="title">Valores</h5>
                                        <p><?php echo $voResultadoMVV->texto_valores ?></p>
                                        <i class="<?php echo $voResultadoMVV->icone_valores ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <?php
                    }
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