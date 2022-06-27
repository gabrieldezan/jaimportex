<?php
$vsSqlServico = "
    SELECT
        id_servicos,
        titulo,
        descricao,
        imagem
    FROM
        servicos
    WHERE
        status = 1 AND
        url_amigavel = '$parametro'
";
$vrsExecutaServico = mysqli_query($Conexao, $vsSqlServico) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
$vrsQntServico = mysqli_num_rows($vrsExecutaServico);
if ($vrsQntServico > 0) {
    $voResultadoServico = mysqli_fetch_object($vrsExecutaServico);
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
            <meta name="description" content="<?php echo substr(strip_tags(trim($voResultadoServico->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoServico->descricao)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:title" content="<?php echo $voResultadoServico->titulo . " - " . $voResultadoConfiguracoes->titulo ?>"/>
            <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoServico->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoServico->descricao)), 0, 197), ' ')) . '...'; ?>"/>
            <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/servicos/" . $voResultadoServico->imagem ?>"/>
            <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "servico/" . $parametro ?>"/>
            <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
            <title><?php echo $voResultadoServico->titulo . " - " . $voResultadoConfiguracoes->titulo ?></title>
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
                    <h2 class="title"><?php echo $voResultadoServico->titulo ?></h2>
                    <ul class="breadcrumb-nav">
                        <li><a href="<?php echo URL ?>">Home</a></li>
                        <li><a href="<?php echo URL . "servicos" ?>">Serviços</a></li>
                        <li class="active"><?php echo $voResultadoServico->titulo ?></li>
                    </ul>
                </div>
            </section>

            <section class="case-details-area section-gap">
                <div class="container">
                    <div class="case-details-thumb">
                        <img src="<?php echo URL . "wdadmin/uploads/servicos/" . $voResultadoServico->imagem ?>" title="<?php echo $voResultadoServico->titulo ?>" alt="<?php echo $voResultadoServico->titulo ?>">
                    </div>
                    <div class="case-details-content mt-10 pb-20 text-justify">
                        <h2><?php echo $voResultadoServico->titulo ?></h2>
                        <?php echo $voResultadoServico->descricao ?>
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