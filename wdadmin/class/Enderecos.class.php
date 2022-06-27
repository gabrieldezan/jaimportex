<?php

require_once "Conexao.class.php";

class Enderecos extends Conexao {
    /* =============== VARIAVEIS =============== */

    private $id_enderecos;
    private $titulo;
    private $endereco;
    private $cidade;
    private $estado;
    private $pais;
    private $mapa;
    private $link;
    private $status;
    private $telefone;
    private $whatsapp;
    private $retorno_dados;

    /* =============== FUNÇÃO SALVA DADOS =============== */

    public function salva_dados() {
        try {

            $pdo = parent::getDB();

            if ($this->id_enderecos === "") {
                $salva_dados = $pdo->prepare('
                    INSERT INTO enderecos (
                        titulo,
                        endereco,
                        cidade,
                        estado,
                        pais,
                        mapa,
                        link,
                        status, 
                        telefone,
                        whatsapp
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    );
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->endereco",
                    "$this->cidade",
                    "$this->estado",
                    "$this->pais",
                    "$this->mapa",
                    "$this->link",
                    "$this->status",
                    "$this->telefone",
                    "$this->whatsapp"
                ));
                $this->setRetorno_dados($pdo->lastInsertId());
            } else {
                $salva_dados = $pdo->prepare('
                    UPDATE enderecos SET 
                        titulo = ?,
                        endereco = ?,
                        cidade = ?,
                        estado = ?,
                        pais = ?,
                        mapa = ?,
                        link = ?,
                        status = ?, 
                        telefone = ?,
                        whatsapp = ?
                    WHERE 
                        id_enderecos = ?;
                ');
                $salva_dados->execute(array(
                    "$this->titulo",
                    "$this->endereco",
                    "$this->cidade",
                    "$this->estado",
                    "$this->pais",
                    "$this->mapa",
                    "$this->link",
                    "$this->status",
                    "$this->telefone",
                    "$this->whatsapp",
                    "$this->id_enderecos"
                ));
                $this->setRetorno_dados($this->id_enderecos);
            }
            return true;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO CONSULTA DADOS =============== */

    public function consulta_dados() {

        try {
            $pdo = parent::getDB();

            $consulta_dados = $pdo->prepare("
                SELECT
                    id_enderecos,
                    titulo,
                    endereco,
                    CONCAT(cidade, '-', estado) AS cidade_estado,
                    CASE status
                        WHEN 1 THEN 'success'
                        WHEN 0 THEN 'danger'
                    END AS status_class,
                    CASE status
                        WHEN 1 THEN 'Ativo'
                        WHEN 0 THEN 'Inativo'
                    END AS status
                FROM
                    enderecos
            ");
            $consulta_dados->execute();
            if ($consulta_dados->rowCount() > 0):
                $this->setRetorno_dados(json_encode($consulta_dados->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== FUNÇÃO EDITA DADOS =============== */

    public function edita_dados() {

        try {
            $pdo = parent::getDB();

            $edita_dados = $pdo->prepare("
                SELECT
                    titulo,
                    endereco,
                    cidade,
                    estado,
                    pais,
                    mapa,
                    link,
                    status,
                    telefone,
                    whatsapp
                FROM
                    enderecos
                WHERE
                    id_enderecos =  ?
            ");
            $edita_dados->execute(array(
                "$this->id_enderecos"
            ));
            if ($edita_dados->rowCount() > 0):
                $this->setRetorno_dados(json_encode($edita_dados->fetchAll()));
                return true;
            else:
                return false;
            endif;
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
            return false;
        }
    }

    /* =============== GETTERS E SETTERS =============== */

    function getId_enderecos() {
        return $this->id_enderecos;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getPais() {
        return $this->pais;
    }

    function getMapa() {
        return $this->mapa;
    }

    function getLink() {
        return $this->link;
    }

    function getStatus() {
        return $this->status;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getWhatsapp() {
        return $this->whatsapp;
    }

    function getRetorno_dados() {
        return $this->retorno_dados;
    }

    function setId_enderecos($id_enderecos) {
        $this->id_enderecos = $id_enderecos;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setMapa($mapa) {
        $this->mapa = $mapa;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setWhatsapp($whatsapp) {
        $this->whatsapp = $whatsapp;
    }

    function setRetorno_dados($retorno_dados) {
        $this->retorno_dados = $retorno_dados;
    }

}
