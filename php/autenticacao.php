<?php

include_once("utils/uuid.php");
include_once("dao/estruturaDAO.php");
include_once("model/estrutura.php");

$dados = $_POST;

$protocolo = UUID::gen_uuid();

$dados += ["protocolo" => $protocolo];


if($dados['tipo'] == 'estrutura'){
    $estrutura = new Estrutura();
    $estrutura($dados);

    $dao = new EstruturaDAO();
    $dao->adicionaEstrutura($estrutura);
} elseif ($dados['tipo'] == 'ouvidoria') {
        $inserir = "INSERT INTO `ouvidoria`(`nome`,`email`,`telefone`,`curso`,`periodo`,`conteudo`,`protocolo`,`retorno`) VALUES('$dados[nome]', '$dados[email]', '$dados[tel]', '$dados[curso]', '$dados[periodo]', '$dados[conteudo]', '$protocolo', 'Aguarde o retorno')";
        $sql = mysqli_query($conn,$inserir) or die('Could not connect to MySQL: ' . mysqli_error($conn));
} else {
    echo"<script language='javascript' type='text/javascript'>alert('Erro: voltando ao início!');window.location.href='../index.php';</script>";
    include '../index.php';
}
                