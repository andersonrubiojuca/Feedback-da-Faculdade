<?php
$cabecalho_title="Ver estrutura";
include '../php/cabecalho-login.php';
privilegio(2);

$dados = $_SESSION;
$tipo = $_GET['tipo'];


    $conn = mysqli_connect("127.0.0.1", "root", "", "feedback");
    
    $sqlp = mysqli_query($conn, "SELECT * FROM `estrutura` WHERE `andamento` = ".$tipo);
    $sql = mysqli_fetch_array($sqlp);

    $protocolo = $sql['protocolo'];
    
?>
<section class="verificar container">
    <h2>Lista de problemas de estrutura:</h2>
    <p></p>
    
    <a href="ver-estrutura.php?tipo=3"><button type="button" class="btn btn-default navbar-btn">
        Não Resolvidos
        </button></a>
    <a href="ver-estrutura.php?tipo=2"><button type="button" class="btn btn-default navbar-btn">
        Em andamento
        </button></a>
    <a href="ver-estrutura.php?tipo=1"><button type="button" class="btn btn-default navbar-btn">
        Terminados
        </button></a>
    <?php
    if($sql == NULL) {
        echo '<p><b>Nenhum item aqui!</b></p>';
    } else {
        echo '<table>
        <tr>
            <td>Nome</td>
            <td>Problema</td>
            <td>Protocolo</td>
            <td>Responder</td>
        </tr>';
        
        echo '<tr>';
        echo '<td>' . $sql['nome'] . '</td>';
        echo '<td>' . $sql['problema'] . '</td>';
        echo '<td>' . $sql['protocolo'] . '</td>';
        echo <<<EOT
            <td><a href="#" onClick="window.open('Estado.php?protocolo=$protocolo', 'Estado', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400')"><button type="button"><span class="glyphicon glyphicon-edit"></span></button></a></td>
        EOT;
        echo '</tr>';
    
           
    while ($sql = mysqli_fetch_array($sqlp)){
        echo '<tr>';
        echo '<td>' . $sql['nome'] . '</td>';
        echo '<td>' . $sql['problema'] . '</td>';
        echo '<td>' . $sql['protocolo'] . '</td>';
        echo <<<EOT
            <td><a href="#" onClick="window.open('Estado.php?protocolo=$protocolo', 'Estado', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400')"><button type="button"><span class="glyphicon glyphicon-edit"></span></button></a></td>
        EOT;
        echo '</tr>';
    }
    
    echo '</table>';
    }
    mysqli_close($conn)
    ?>
    <p></p>
    
</section>
<?php
include_once '../php/rodape-adm.php';