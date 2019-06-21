<?php

$login = $_POST['login'];    
$botao = $_POST['entrar'];

if($botao == "Entrar"){
    $senha = md5($_POST['senha']);        
}else{
    $senha = $_POST['senha'];
    echo "<script language='javascript' type='text/javascript'>alert(NAO EH de index);</script>";
}

function conectar(){

    $config = parse_ini_file('config.ini'); 
    $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
    if ($mysqli->connect_errno) {
        // Escreva aqui tudo que você quer que aconteça quando der merda na conexão
        echo "Falha ao conectar com o banco de dados: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        return false;
    }

    return $mysqli;

}


function executar($sql_code){

    $conexao = conectar();
    if(!$conexao)
        return false; // se a conexão der errado

    $resultado = $conexao->query($sql_code) or die($conexao->error);

    return $resultado;

}

$tudo = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
$select = executar($tudo);
$row = mysqli_fetch_assoc($select);//esse valor é alterado, só eh usado ate a linha 45
$idDono = intval($row['id']);

$registros = "SELECT * FROM pet WHERE id_dono = $idDono ";
$select1 = executar($registros);
$row = mysqli_fetch_assoc($select1);
$total = mysqli_num_rows($select1);

if($botao == "Entrar"){
    if($idDono > 0){
        echo"<script language='javascript' type='text/javascript'>alert('Bem vindo de volta !');</script>";
    }else{
        echo"<script language='javascript' type='text/javascript'>alert('Usuário ou senha inválido !');window.location.href='../index.html'</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="author:" content="O.K.D.G - www.haresoft.com.br">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/home.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Info Pets - HOME</title>

    </head> 
    <body>


        <div class="listaPetsBlock" >
            <h2>Seus PETS</h2>
            <?php
            // se o número de resultados for maior que zero, mostra os dados
            if($total > 0) {
                // inicia o loop que vai mostrar todos os dados
                do {
                    $nome = $row['nome'];
                    $raca = $row['raca'];
                    $nascimento = $row['nascimento'];
            ?> 
            <div class="listaPets media" >
                <?php
                    if($row['raca'] == "Cachorro"){
                ?>
                <img class="mr-3" src="../img/login/dog.png">
                <?php
                    }else{
                ?>
                <img class="mr-3" src="../img/login/cat.png">
                <?php
                    }
                ?>        
                <div class="media-body">
                    <b><a id="aNomePet" href="#" data-toggle="modal" data-target="#exampleModal"><?=$nome?></a></b>
                    <!-- AQUI -->
                    <!-- Modal -->
                    <!-- Modal -->                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Informações sobre este pet</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div align="center" class="modal-body">
                                    <?php
                                        $registros = "SELECT * FROM pet WHERE id_dono = $idDono ";
                                        $select1 = executar($registros);
                                        $row = mysqli_fetch_assoc($select1);
                                    ?>
                                    <label>Nome</label>
                                    <p><?=$nome?></p>
                                    <label>Raça</label>
                                    <p><?=$raca?></p>
                                    <label>Nascimento</label>
                                    <p><?=$nascimento?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<script>
function exibeInfoPet() {
alert("Informações!");
}
</script>-->

            <?php
                                        // finaliza o loop que vai mostrar os dados
                }while($row = mysqli_fetch_assoc($select1));
                // fim do if 
            }
            ?>
        </div>
        <br/><br/>
        <section>
            <div id="div0">
                <img src="../img/home/clinica_vet_img1.jpg" class="div1">
                <img src="../img/home/novidades_img2.jpg" class="div1">
                <img src="../img/home/adocao_img3.jpg" class="div1">
                <img src="../img/home/produtos_img4.jpg" class="div1">
            </div>
        </section>
        <form class=""  method="POST" action="cadastro_pet1.php">
            <input type="hidden" name="dono" value="<?php echo $login;?>"><br><br>
            <input type="submit" name="enviar" class="btnCadastrar btn btn-success" value="Cadastrar Pet">
        </form>
        <footer class="footer_home">
            <b><p>&copy; Info Pets 2017 Todos os direitos reservados</p></b>           
        </footer>
    </body>

</html>
<?php
// tira o resultado da busca da memória
mysqli_free_result($select1);
?>