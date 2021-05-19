<?php
    include_once("../database.php");
    require_once("DAO.php");

class EstruturaDAO{
    use DAO;
    

    private function getEstrutura(array $dados){
        $estru = new Estrutura();
        $estru($dados);

        return $estru;
    }

    public function adicionaEstrutura(Estrutura $dados){
        $tnome = "";
        $vnome = "";

        if($dados->getNome()){
            $tnome = "nome, ";
            $vnome = "'" . $dados->getNome() . "', ";
        }

        $sql = "
                INSERT INTO chamados($tnome setor, sala, problema, protocolo) VALUES(
                    $vnome
                    '" . $dados->getLocal() . "', 
                    '" . $dados->getSala() . "', 
                    '" . $dados->getProblema() . "', 
                    '" . $dados->getProtocolo() . "'
                );
            ";

        $this->conn($sql);
    }

    public function listarTodos(){
        $sql = "SELECT * FROM chamados;";

        $dados = $this->conn($sql);

        foreach($dados as &$dado){
            $dado = $this->getEstrutura($dado);
        }

        return $dados;
    }

    public function procurar(int $id){
        $sql = "SELECT * FROM chamados WHERE id = " . $id . ";";

        $dados = $this->conn($sql);

        if(!isset($dados)){
            $estrutura = $this->getEstrutura($dados);
            return $estrutura;
        }
    }

    //mecher
    public function procurarProtocolo(String $prot){
        $sql = "SELECT * FROM chamados WHERE protocolo = '" . $prot . "';";


        $conn = mysqli_connect($this->banco['endereco'], $this->banco['login'], $this->banco['senha'], $this->banco['banco']);
        $dados = mysqli_query($conn,$sql) or die('Could not connect to MySQL: ' . mysqli_error($conn));

        if(mysqli_num_rows($dados) > 0){
            return $dados;
        }
    }

    public function remover(int $id){
        $sql = "DELETE FROM estrutura WHERE id = " . $id . ";";

        $dados = $this->conn($sql);
    }

    public function resposta(Estrutura $dados){
        $sql = "UPDATE chamados SET andamento = 2, resposta = '" . $dados->getRetorno()
                . "' WHERE id = " . $dados->getId() . ";";

        return $this->conn($sql);
    }

    public function termina(Estrutura $dados){
        $sql = "UPDATE chamados SET andamento = 3, resposta = " . $dados->getRetorno()
                . "WHERE id = " . $dados->getId() . ";";

        return $this->conn($sql);
    }


}