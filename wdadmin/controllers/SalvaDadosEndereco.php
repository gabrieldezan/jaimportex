<?php

require_once "../class/Enderecos.class.php";

$Enderecos = new Enderecos();
$Enderecos->setId_enderecos($_POST['inputIdEnderecos']);
$Enderecos->setTitulo($_POST['inputTitulo']);
$Enderecos->setEndereco($_POST['inputEndereco']);
$Enderecos->setCidade($_POST['inputCidade']);
$Enderecos->setEstado($_POST['inputEstado']);
$Enderecos->setPais($_POST['inputPais']);
$Enderecos->setMapa($_POST['inputMapa']);
$Enderecos->setLink($_POST['inputLink']);
$Enderecos->setStatus($_POST['inputStatus']);
$Enderecos->setTelefone($_POST['inputTelefone']);
$Enderecos->setWhatsapp($_POST['inputWhatsapp']);

if ($Enderecos->salva_dados()):
    print $Enderecos->getRetorno_dados();
else:
    print 0;
endif;