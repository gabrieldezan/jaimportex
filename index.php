<?php

error_reporting(0);
date_default_timezone_set('America/Sao_Paulo');
$data_hora_atual = date("Y-m-d H:i:s");

include 'wdadmin/config.php';
include 'php/conexao.php';
include 'wdadmin/controllers/MontaUrlAmigavel.php';

$Conexao = conecta();

$vsSql = "SELECT * FROM informacoes_gerais";
$vrExecuta = mysqli_query($Conexao, $vsSql) or die("Erro ao efetuar a operação no banco de dados! <br> Arquivo:" . __FILE__ . "<br>Linha:" . __LINE__ . "<br>Erro:" . mysqli_error($Conexao));
$voResultadoConfiguracoes = mysqli_fetch_object($vrExecuta);

define("EMAIL_CONTATO", $voResultadoConfiguracoes->email_contato);

$getUrl = strip_tags(trim(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));
$Url = explode("/", $getUrl);

if ($Url[0] == "" || $Url[0] == "home") {
    $pagina = "home";
    $parametro = "";
} else if ($Url[0] == "quem-somos") {
    $pagina = "quem-somos";
    $parametro = "";
} else if ($Url[0] == "servicos") {
    $pagina = "servicos";
    $parametro = "";
} else if ($Url[0] == "servico") {
    $pagina = "servico";
    $parametro = $Url[1];
} else if ($Url[0] == "produtos") {
    $pagina = "produtos";
    $parametro = $Url[1];
    $numero_pagina = isset($Url[2]) ? $Url[2] : "1";
} else if ($Url[0] == "produto") {
    $pagina = "produto";
    $categoria = $Url[1];
    $parametro = $Url[2];
} else if ($Url[0] == "busca-produtos") {
    $pagina = "busca-produtos";
    $parametro = $Url[1];
    $numero_pagina = isset($Url[2]) ? $Url[2] : "1";
} else if ($Url[0] == "parceiros") {
    $pagina = "parceiros";
    $parametro = "";
} else if ($Url[0] == "blog") {
    $pagina = "blog";
    $parametro = "";
    $numero_pagina = isset($Url[1]) ? $Url[1] : "1";
} else if ($Url[0] == "post") {
    $pagina = "post";
    $parametro = $Url[1];
} else if ($Url[0] == "busca-blog") {
    $pagina = "busca-blog";
    $parametro = $Url[1];
    $numero_pagina = isset($Url[2]) ? $Url[2] : "1";
} else if ($Url[0] == "contato") {
    $pagina = "contato";
    $parametro = "";
} else if ($Url[0] == "politica-privacidade") {
    $pagina = "politica-privacidade";
    $parametro = "";
} else {
    $pagina = "404";
    $parametro = "";
}

if (file_exists("pages/$pagina.php")) {
    include "pages/$pagina.php";
} else {
    include "pages/404.php";
}