<?php
$dados = $_POST;
            date_default_timezone_set('America/Sao_Paulo');
            $sabonete;
            $papeltoalha;
            $papelhigienico;
            $teste;
            $sexo;
            $lado;

            if($dados['tipo'] == 'estrutura'){
                $teste = 'ignore isso';
            } elseif ($dados['tipo'] == 'ouvidoria') {
                $teste = 'falei pra ignorar';
            } else {
                $teste = 'ERRO!';
            }

                $random = rand(00000, 99999);

                if($dados['tipo'] == 'estrutura'){
                    $operador = "1";
                } elseif ($dados['tipo'] == 'ouvidoria') {
                    $operador = "2";
                }

                $data = date('dmy');
                $protocolo = $operador . $data . $random;

                $conn = mysqli_connect("127.0.0.1", "root", "", "feedback");
                $sqlp = mysqli_query($conn, "SELECT * FROM `estrutura` WHERE `protocolo` = '" . $protocolo . "'");

                while (mysqli_num_rows($sqlp)){
                    $random = rand(00000, 99999);
                    $protocolo = $operador . $data . $random;
                    $conn = mysqli_connect("127.0.0.1", "root", "", "feedback");
                    $sqlp = mysqli_query($conn, "SELECT * FROM `estrutura` WHERE `protocolo` = '" . $protocolo . "'");
                }
                
                if(!empty($dados['Sabonetelíquido'])){
                    $sabonete = "TRUE";
                } else{
                    $sabonete = "FALSE";
                }
                if(!empty($dados['Papeltoalha'])){
                    $papeltoalha = "TRUE";
                } else{
                    $papeltoalha = "FALSE";
                }
                if(!empty($dados['PapelHigiênico'])){
                    $papelhigienico = "TRUE";
                } else{
                    $papelhigienico = "FALSE";
                }
                
                if(!empty ($dados['sexo']) && $dados['sexo'] == "Masculino"){
                    $sexo = "1";
                } elseif (!empty ($dados['sexo']) && $dados['sexo'] == "Feminino") {
                    $sexo = "2";
                } elseif (empty ($dados['sexo'])) {
                    $sexo = "NULL";
                }
                                
                if(!empty($dados['lado']) && $dados['lado'] == "Direito"){
                    $lado = "1";
                } elseif(!empty($dados['lado']) && $dados['lado'] == "Esquerdo"){
                    $lado = "2";
                } elseif (empty ($dados['lado'])) {
                    $lado = "NULL";
                }
                
                if (empty($dados['ban_local'])) {
                    $dados['ban_local'] = "NULL";
                }
                if(empty($dados['sala_corredor'])){
                    $dados['sala-corredor'] = "NULL";
                }

        if($dados['tipo'] == 'estrutura'){
                $inserir = "INSERT INTO `estrutura`(`nome`, `local`, `problema`, `ban_sexo`, `ban_local`, `lado`, `sala`, `sala_corredor`, `m_sabonete`, `m_papel_h`, `m_papel_t`, `protocolo`, `retorno`) VALUES('$dados[nome]', '$dados[local]', '$dados[problema]', $sexo, '$dados[ban_local]', $lado, '$dados[sala]', '$dados[sala_corredor]', $sabonete, $papelhigienico, $papeltoalha, '$protocolo', 'Aguarde o retorno')";
                $sql = mysqli_query($conn,$inserir) or die('Could not connect to MySQL: ' . mysqli_error($conn));
                } elseif ($dados['tipo'] == 'ouvidoria') {
                    $inserir = "INSERT INTO `ouvidoria`(`nome`,`email`,`telefone`,`curso`,`periodo`,`conteudo`,`protocolo`,`retorno`) VALUES('$dados[nome]', '$dados[email]', '$dados[tel]', '$dados[curso]', '$dados[periodo]', '$dados[conteudo]', '$protocolo', 'Aguarde o retorno')";
                    $sql = mysqli_query($conn,$inserir) or die('Could not connect to MySQL: ' . mysqli_error($conn));
                } else {
                    echo"<script language='javascript' type='text/javascript'>alert('Erro: voltando ao início!');window.location.href='../index.php';</script>";
                    include '../index.php';
                }
                