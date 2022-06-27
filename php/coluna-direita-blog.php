<div class="col-lg-4 col-md-12 col-sm-12">
    <div class="blog-sidebar">
        <div class="widget search-widget">
            <h4 class="widget-title">Busque no blog</h4>
            <form>
                <input type="hidden" id="vsUrl" name="vsUrl" value="<?php echo URL ?>" />
                <input id="campo_buscar_blog" name="campo_buscar_blog" type="text" placeholder="Procure aqui...">
                <button id="botao_buscar_blog" type="button"><i class="fal fa-search"></i></button>
            </form>
        </div>
        <div class="widget news-feed-widget">
            <h4 class="widget-title">Posts Mais vistos</h4>
            <div class="news-feed-items">
                <?php
                $vsSqlBlogMaisVisitados = "
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
                    LIMIT 4
                ";
                $vrsExecutaBlogMaisVisitados = mysqli_query($Conexao, $vsSqlBlogMaisVisitados) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                while ($voResultadoBlogMaisVisitados = mysqli_fetch_object($vrsExecutaBlogMaisVisitados)) {
                    ?>
                    <div class="news-feed-item">
                        <h4 class="title"><a href="<?php echo URL . "post/" . $voResultadoBlogMaisVisitados->url_amigavel ?>"><?php echo $voResultadoBlogMaisVisitados->titulo ?></a></h4>
                        <span><i class="fal fa-calendar-alt"></i><?php echo $voResultadoBlogMaisVisitados->data_publicacao_formatada ?></span>
                        <a href="<?php echo URL . "post/" . $voResultadoBlogMaisVisitados->url_amigavel ?>">
                            <img src="<?php echo URL . "wdadmin/uploads/blog_postagens/" . $voResultadoBlogMaisVisitados->imagem ?>" title="<?php echo $voResultadoBlogMaisVisitados->titulo ?>" alt="<?php echo $voResultadoBlogMaisVisitados->titulo ?>">
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="widget social-links">
            <h4 class="widget-title">Acompanhe-nos nas redes sociais</h4>
            <ul>
                <?php
                $vsSqlRedesSociais = "SELECT titulo, link, icone FROM redes_sociais ORDER BY id_redes_sociais";
                $vrsExecutaRedesSociais = mysqli_query($Conexao, $vsSqlRedesSociais) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
                while ($voResultadoRedesSociais = mysqli_fetch_object($vrsExecutaRedesSociais)) {
                    ?>
                    <li><a href="<?php echo $voResultadoRedesSociais->link ?>"><i title="<?php echo $voResultadoRedesSociais->titulo ?>" class="<?php echo $voResultadoRedesSociais->icone ?>"></i></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>