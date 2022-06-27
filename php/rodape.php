<div class="cookie-container">
    <center>
        Para sua segurança, atualizamos nossa <a href="<?php echo URL . "politica-privacidade" ?>" target="_blank">política de privacidade</a>. Ao continuar navegando, entendemos que você está ciente e de acordo com elas.&nbsp;
        <button class="cookie-btn">
            Aceitar
        </button>
    </center>
</div>
<footer class="footer-area footer-area-two" style="background-image: url(assets/img/footer-bg.webp);">
    <div class="container">
        <div class="row footer-widgets">
            <div class="col-lg-4 col-md-12">
                <div class="widget about-widget">
                    <div class="logo">
                        <img src="<?php echo URL . "wdadmin/uploads/informacoes_gerais/" . $voResultadoConfiguracoes->logo_secundaria ?>" alt="">
                    </div>
                    <?php
                    $vsSqlTextoRodape = "SELECT texto FROM sobre";
                    $vrsExecutaTextoRodape = mysqli_query($Conexao, $vsSqlTextoRodape) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                    while ($voResultadoTextoRodape = mysqli_fetch_object($vrsExecutaTextoRodape)) {
                    ?>
                        <p><?php echo substr(strip_tags(trim($voResultadoTextoRodape->texto)), 0, strrpos(substr(strip_tags(trim($voResultadoTextoRodape->texto)), 0, 350), ' ')) . '...'; ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="widget nav-widget">
                    <h4 class="widget-title">Páginas</h4>
                    <div class="footer-list">
                        <ul>
                            <li><a href="<?php echo URL ?>"><i class="fal fa-angle-right"></i> Home</a></li>
                            <li><a href="<?php echo URL . "quem-somos" ?>"><i class="fal fa-angle-right"></i> Quem Somos</a></li>
                            <li><a href="<?php echo URL . "servicos" ?>"><i class="fal fa-angle-right"></i> Serviços</a></li>
                            <li><a href="<?php echo URL . "parceiros" ?>"><i class="fal fa-angle-right"></i> Parceiros</a></li>
                            <!--<li><a href="<?php echo URL . "blog" ?>"><i class="fal fa-angle-right"></i> Blog</a></li>-->
                            <li><a href="<?php echo URL . "contato" ?>"><i class="fal fa-angle-right"></i> Contato</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="widget contact-widget">
                    <h4 class="widget-title">Contatos</h4>
                    <ul>
                        <li><a href="<?php echo "mailto:" . $voResultadoConfiguracoes->email ?>"><i class="far fa-envelope"></i> <?php echo $voResultadoConfiguracoes->email ?></a></li>
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
            </div>
        </div>
        <div class="footer-copyright">
            <div class="row">
                <div class="col-lg-8 align-self-end">
                    <p><?php echo "Copyright © " . date("Y ") . $voResultadoConfiguracoes->nome_empresa . ". Todos direitos reservados | " ?><a href="<?php echo URL . "politica-privacidade" ?>">Política de Privacidade</a>.</p>
                </div>
                <div class="col-lg-4">
                    <div class="logo-wd">
                        <a target="_blank" href="https://webdezan.com.br">
                            <img src="<?php echo URL . "assets/img/logo-wd.webp" ?>" title="Web Dezan - Agência Digital" alt="Web Dezan - Agência Digital">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>