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
        <meta property="og:title" content="<?php echo "Política de Privacidade - " . $voResultadoConfiguracoes->titulo ?>"/>
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "politica-privacidade" ?>"/>
        <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
        <title><?php echo "Política de Privacidade - " . $voResultadoConfiguracoes->titulo ?></title>
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
                <h2 class="title">Política de Privacidade</h2>
                <ul class="breadcrumb-nav">
                    <li><a href="<?php echo URL ?>">Home</a></li>
                    <li class="active">Política de Privacidade</li>
                </ul>
            </div>
        </section>

        <section class="pt-100 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="feature-text-block">
                            <?php echo $voResultadoConfiguracoes->politicas_privacidade ?>
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