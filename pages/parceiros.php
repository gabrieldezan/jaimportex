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
        <meta property="og:title" content="<?php echo "Parceiros - " . $voResultadoConfiguracoes->titulo ?>"/>
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "parceiros" ?>"/>
        <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
        <title><?php echo "Parceiros - " . $voResultadoConfiguracoes->titulo ?></title>
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
                <h2 class="title">Parceiros</h2>
                <ul class="breadcrumb-nav">
                    <li><a href="<?php echo URL ?>">Home</a></li>
                    <li class="active">Parceiros</li>
                </ul>
            </div>
        </section>

        <section class="team-area team-section-extra-padding soft-blue-bg">
            <div class="container">
                <div class="row team-members">
                    <?php
                    $vsSqlParceiros = "SELECT titulo, imagem, link FROM informacoes WHERE id_conteudo_personalizado = 5 ORDER BY id_informacoes DESC";
                    $vrsExecutaParceiros = mysqli_query($Conexao, $vsSqlParceiros) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoParceiros = mysqli_fetch_object($vrsExecutaParceiros)) {
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="team-member-three mb-30">
                                <div class="member-inner">
                                    <img src="<?php echo URL . "wdadmin/uploads/informacoes/" . $voResultadoParceiros->imagem ?>" title="<?php echo $voResultadoParceiros->titulo ?>" alt="<?php echo $voResultadoParceiros->titulo ?>">
                                    <div class="team-content">
                                        <?php if ($voResultadoParceiros->link != null || !empty($voResultadoParceiros->link)) { ?>
                                            <h5 class="name"><a href="<?php echo $voResultadoParceiros->link ?>"><?php echo $voResultadoParceiros->titulo ?></a></h5>
                                        <?php } else { ?>
                                            <h5 class="name"><?php echo $voResultadoParceiros->titulo ?></h5>
                                        <?php } ?>
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