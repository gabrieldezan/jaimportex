<header class="header-one sticky-header">
    <div class="header-topbar d-none d-sm-block">
        <div class="container-fluid align-items-center justify-content-between container-1470">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm-auto col-12">
                    <ul class="contact-info text-center">
                        <li><a href="<?php echo "mailto:" . $voResultadoConfiguracoes->email ?>"><i class="fal fa-envelope"></i> <?php echo $voResultadoConfiguracoes->email ?></a></li>
                        <?php
                        $vsSqlWhatsapp = "SELECT telefone, whatsapp FROM enderecos ORDER BY id_enderecos";
                        $vrsExecutaWhatsapp = mysqli_query($Conexao, $vsSqlWhatsapp) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                        while ($voResultadoWhatsapp = mysqli_fetch_object($vrsExecutaWhatsapp)) {
                            ?>
                            <li><a target="_blank" href="<?php echo "https://api.whatsapp.com/send?l=pt_BR&phone=" . str_replace(array("(", ")", "+", "-", " "), "", $voResultadoWhatsapp->whatsapp) ?>"><i class="fab fa-whatsapp"></i> <?php echo $voResultadoWhatsapp->whatsapp ?></a></li>
                            <?php if ($voResultadoWhatsapp->telefone != null || !empty($voResultadoWhatsapp->telefone)) { ?>
                                <li><a href="<?php echo "tel:" . str_replace(array("(", ")", "+", "-", " "), "", $voResultadoWhatsapp->telefone) ?>"><i class="fal fa-phone"></i> <?php echo $voResultadoWhatsapp->telefone ?></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-sm-auto col-12">
                    <div class="social-icon text-center">
                        <ul>
                            <?php
                            $vsSqlRedesSociais = "SELECT titulo, link, icone FROM redes_sociais ORDER BY id_redes_sociais";
                            $vrsExecutaRedesSociais = mysqli_query($Conexao, $vsSqlRedesSociais) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                            while ($voResultadoRedesSociais = mysqli_fetch_object($vrsExecutaRedesSociais)) {
                                ?>
                                <li><a target="_blank" href="<?php echo $voResultadoRedesSociais->link ?>"><i title="<?php echo $voResultadoRedesSociais->titulo ?>" class="<?php echo $voResultadoRedesSociais->icone ?>"></i></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navigation">
        <div class="container-fluid d-flex align-items-center justify-content-between container-1470">
            <div class="header-left">
                <div class="site-logo">
                    <a href="<?php echo URL ?>">
                        <img src="<?php echo URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_principal ?>" title="<?php echo $voResultadoConfiguracoes->nome_empresa ?>" alt="<?php echo $voResultadoConfiguracoes->nome_empresa ?>">
                    </a>
                </div>
            </div>
            <div class="header-right d-flex align-items-center justify-content-end">
                <div class="site-nav-menu">
                    <ul class="primary-menu">
                        <li>
                            <a class="nav-link" href="<?php echo URL ?>">Home</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo URL . "quem-somos" ?>">Quem Somos</a>
                        </li>
                        <li>
                            <a href="<?php echo URL . "servicos" ?>">Serviços</a>
                            <ul class="submenu">
                                <?php
                                $vsSqlServicos = "SELECT titulo, url_amigavel FROM servicos WHERE status = 1";
                                $vrsExecutaServicos = mysqli_query($Conexao, $vsSqlServicos) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoServicos = mysqli_fetch_object($vrsExecutaServicos)) {
                                    ?>
                                    <li><a href="<?php echo URL . "servico/" . $voResultadoServicos->url_amigavel ?>"><?php echo $voResultadoServicos->titulo ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li>
                            <a class="cursor-pointer">Produtos</a>
                            <ul class="submenu">
                                <?php
                                $vsSqlProdutosCategorias = "SELECT descricao, url_amigavel FROM vitrine_subgrupo WHERE status = 1";
                                $vrsExecutaProdutosCategorias = mysqli_query($Conexao, $vsSqlProdutosCategorias) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                                while ($voResultadoProdutosCategorias = mysqli_fetch_object($vrsExecutaProdutosCategorias)) {
                                    ?>
                                    <li><a href="<?php echo URL . "produtos/" . $voResultadoProdutosCategorias->url_amigavel ?>"><?php echo $voResultadoProdutosCategorias->descricao ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo URL . "parceiros" ?>">Parceiros</a>
                        </li>
<!--                        <li>
                            <a class="nav-link" href="<?php echo URL . "blog" ?>">Blog</a>
                        </li>-->
                        <li>
                            <a class="nav-link" href="<?php echo URL . "contato" ?>">Contato</a>
                        </li>
                        <div id="google_translate_element" class="boxTradutor"></div>
                        <li>
                            <a class="nav-link linguas" href="javascript:trocarIdioma('pt')">
                                <img src="<?php echo URL . "assets/img/brasil.webp" ?>" class="img-round">
                                <span>Português</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link linguas" href="javascript:trocarIdioma('de')">
                                <img src="<?php echo URL . "assets/img/alemao.webp" ?>" class="img-round">
                                <span>Alemão</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link linguas" href="javascript:trocarIdioma('es')">
                                <img src="<?php echo URL . "assets/img/espanhol.webp" ?>" class="img-round">
                                <span>Espanhol</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link linguas" href="javascript:trocarIdioma('en')">
                                <img src="<?php echo URL . "assets/img/ingles.webp" ?>" class="img-round">
                                <span>Inglês</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link linguas" href="javascript:trocarIdioma('fr')">
                                <img src="<?php echo URL . "assets/img/frances.webp" ?>" class="img-round">
                                <span>Francês</span>
                            </a>
                        </li>
                    </ul>
                    <a href="#" class="nav-close"><i class="fal fa-times"></i></a>
                </div>
                <div class="header-extra d-flex align-items-center">
                    <div class="nav-toggler">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>