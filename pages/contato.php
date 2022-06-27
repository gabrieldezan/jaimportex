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
        <meta property="og:title" content="<?php echo "Contato - " . $voResultadoConfiguracoes->titulo ?>"/>
        <meta property="og:description" content="<?php echo substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, strrpos(substr(strip_tags(trim($voResultadoConfiguracoes->descricao)), 0, 197), ' ')) . '...'; ?>"/>
        <meta property="og:image" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>"/>
        <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . URL . "contato" ?>"/>
        <meta property="og:site_name" content="<?php echo $voResultadoConfiguracoes->nome_empresa ?>"/>
        <title><?php echo "Contato - " . $voResultadoConfiguracoes->titulo ?></title>
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
                <h2 class="title">Contato</h2>
                <ul class="breadcrumb-nav">
                    <li><a href="<?php echo URL ?>">Home</a></li>
                    <li class="active">Contato</li>
                </ul>
            </div>
        </section>

        <section class="contact-info-section section-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-info-items mb-md-gap-50">
                            <div class="contact-info-item text-center">
                                <i class="fal fa-phone"></i>
                                <h5 class="title">Telefones</h5>
                                <?php
                                $vsSqlWhatsapp = "SELECT whatsapp, telefone FROM enderecos ORDER BY id_enderecos";
                                $vrsExecutaWhatsapp = mysqli_query($Conexao, $vsSqlWhatsapp) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoWhatsapp = mysqli_fetch_object($vrsExecutaWhatsapp)) {
                                    ?>
                                    <p><a target="_blank" href="<?php echo "https://api.whatsapp.com/send?l=pt_BR&phone=" . str_replace(array("(", ")", "+", "-", " "), "", $voResultadoWhatsapp->whatsapp) ?>"><i class="fab fa-whatsapp"></i> <?php echo $voResultadoWhatsapp->whatsapp ?></a></p>
                                    <?php if ($voResultadoWhatsapp->telefone !== null || !empty($voResultadoWhatsapp->telefone)) { ?>
                                        <p><a target="_blank" href="<?php echo "tel:" . str_replace(array("(", ")", "-", " "), "", $voResultadoWhatsapp->telefone) ?>"><i class="fal fa-phone"></i> <?php echo $voResultadoWhatsapp->telefone ?></a></p>
                                    <?php } ?>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="contact-info-item text-center">
                                <i class="fal fa-envelope"></i>
                                <h5 class="title">E-Mail</h5>
                                <p><a href="<?php echo "mailto:" . $voResultadoConfiguracoes->email ?>"><?php echo $voResultadoConfiguracoes->email ?></a></p>
                            </div>
                            <div class="contact-info-item text-center">
                                <i class="fal fa-map"></i>
                                <h5 class="title">Localizações</h5>
                                <?php
                                $vsSqlEnderecos = "SELECT endereco, cidade, estado, pais, link FROM enderecos WHERE status = 1 ORDER BY id_enderecos";
                                $vrsExecutaEnderecos = mysqli_query($Conexao, $vsSqlEnderecos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoEnderecos = mysqli_fetch_object($vrsExecutaEnderecos)) {
                                    ?>
                                    <p><a href="<?php echo $voResultadoEnderecos->link ?>" target="_blank"><?php echo $voResultadoEnderecos->endereco ?><br/><?php echo $voResultadoEnderecos->cidade . " - " . $voResultadoEnderecos->estado . " - " . $voResultadoEnderecos->pais ?></a></p>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="contact-info-item text-center">
                                <i class="fal fa-globe"></i>
                                <h5 class="title">Redes Sociais</h5>
                                <ul>
                                    <?php
                                    $vsSqlRedesSociais = "SELECT titulo, link, icone FROM redes_sociais ORDER BY id_redes_sociais";
                                    $vrsExecutaRedesSociais = mysqli_query($Conexao, $vsSqlRedesSociais) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                    while ($voResultadoRedesSociais = mysqli_fetch_object($vrsExecutaRedesSociais)) {
                                        ?>
                                        <li><a target="_blank"  href="<?php echo $voResultadoRedesSociais->link ?>"><i title="<?php echo $voResultadoRedesSociais->titulo ?>" class="<?php echo $voResultadoRedesSociais->icone ?>"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-map-three">
                            <?php
                            $vsSqlMapa = "SELECT mapa FROM enderecos WHERE status = 1 ORDER BY id_enderecos LIMIT 1";
                            $vrsExecutaMapa = mysqli_query($Conexao, $vsSqlMapa) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                            while ($voResultadoMapa = mysqli_fetch_object($vrsExecutaMapa)) {
                                ?>
                                <?php echo $voResultadoMapa->mapa ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-map-section section-gap soft-blue-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="section-title text-left mb-45">
                            <?php
                            $vsSqlTituloContato = "SELECT titulo, subtitulo, imagem FROM titulos_personalizados WHERE id_titulos_personalizados = 6";
                            $vrsExecutaTituloContato = mysqli_query($Conexao, $vsSqlTituloContato) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                            while ($voResultadoTituloContato = mysqli_fetch_object($vrsExecutaTituloContato)) {
                                ?>
                                <img src="<?php echo URL . "wdadmin/uploads/titulos_personalizados/" . $voResultadoTituloContato->imagem ?>">
                                <span><?php echo $voResultadoTituloContato->titulo ?></span>
                                <h2 class="title"><?php echo $voResultadoTituloContato->subtitulo ?></h2>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-area">
                            <form method="post" id="form_contato">
                                <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>">
                                <input type="hidden" id="vsEmailContato" name="vsEmailContato" value="<?php echo EMAIL_CONTATO ?>">
                                <input type="hidden" id="vsNomeEmpresa" name="vsNomeEmpresa" value="<?php echo $voResultadoConfiguracoes->nome_empresa ?>">
                                <div class="input-group">
                                    <input type="text" id="vsNome" name="vsNome" placeholder="Nome">
                                    <div class="icon"><i class="fal fa-user"></i></div>
                                </div>
                                <div class="input-group mt-20">
                                    <input type="email" id="vsEmail" name="vsEmail" placeholder="E-Mail">
                                    <div class="icon"><i class="fal fa-envelope"></i></div>
                                </div>
                                <div class="input-group mt-20">
                                    <input type="tel" id="vsTelefone" name="vsTelefone" placeholder="Telefone">
                                    <div class="icon"><i class="fal fa-phone"></i></div>
                                </div>
                                <div class="input-group mt-20">
                                    <input type="text" id="vsAssunto" name="vsAssunto" placeholder="Assunto">
                                    <div class="icon"><i class="fal fa-pencil"></i></div>
                                </div>
                                <div class="input-group textarea-group mt-20">
                                    <textarea id="vsMensagem" name="vsMensagem" cols="30" rows="10" placeholder="Escreva sua mensagem"></textarea>
                                    <div class="icon"><i class="fal fa-edit"></i></div>
                                </div>
                                <div class="input-group mt-20">
                                    <button id="botao_enviar_mensagem" class="main-btn" type="submit">Enviar</button>
                                </div>
                            </form>
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

        <script src="<?php echo URL . "wdadmin/js/jquery.mask.min.js" ?>" rel="stylesheet"></script>
        <script src="<?php echo URL . "wdadmin/assets/plugins/sweetalert/sweetalert.min.js" ?>"></script>
        <link href="<?php echo URL . "wdadmin/assets/plugins/sweetalert/sweetalert.min.css" ?>" rel="stylesheet">
        <script src="<?php echo URL . "wdadmin/js/contato.min.js" ?>"></script>

    </body>
</html>