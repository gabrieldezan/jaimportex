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
        <meta property="og:title" content="<?php echo "Serviços - " . $voResultadoConfiguracoes->titulo ?>"/>
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "servicos" ?>"/>
        <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
        <title><?php echo "Serviços - " . $voResultadoConfiguracoes->titulo ?></title>
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
                <h2 class="title">Serviços</h2>
                <ul class="breadcrumb-nav">
                    <li><a href="<?php echo URL ?>">Home</a></li>
                    <li class="active">Serviços</li>
                </ul>
            </div>
        </section>

        <section class="service-section-two section-gap-top pb-90">
            <div class="container">
                <div class="row service-items justify-content-center">
                    <?php
                    $vsSqlServicos = "SELECT titulo, descricao, imagem, icone, url_amigavel FROM servicos WHERE status = 1";
                    $vrsExecutaServicos = mysqli_query($Conexao, $vsSqlServicos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoServicos = mysqli_fetch_object($vrsExecutaServicos)) {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-12">
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