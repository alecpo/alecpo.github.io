<?php
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

$login = $_POST['dono'];
$nome = $_POST['nome'];
$especie = $_POST['especie'];
$nascimento = $_POST['nascimento'];
$raca = $_POST['raca'];

$id_user = "SELECT * FROM usuarios WHERE login = '$login'";
$select = executar($id_user);
$row = mysqli_fetch_assoc($select);
$variavel = intval($row['id']);
$senha = $row['senha'];

$cadastra = "INSERT INTO pet (id_pet, id_dono, nome, especie, nascimento, raca) 
 VALUES (DEFAULT, $variavel, '$nome', '$especie', '$nascimento', '$raca')";
$insert = executar($cadastra);

if($insert){

    echo"<script language='javascript' type='text/javascript'>alert('Pet cadastrado com sucesso! ');</script>";

}else{
    echo"<script language='javascript' type='text/javascript'>alert('erro ao cadastrar o pet ');window.location.href='https://infopets.000webhostapp.com/php/login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="author:" content="O.K.D.G - www.haresoft.com.br">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>cadastro_2</title>

    </head>
    <body>        
        <form name="form1" method="POST" action="login.php">                  
           <input id="login" name="login" type="hidden" value="<?php echo $login;?>" required="">
           <input id="senha" name="senha" type="hidden" value="<?php echo $senha;?>" required="">
           <input id="entrar" name="entrar" type="hidden" value="Enviar" required="">        
           <script language="JavaScript">document.forms["form1"].submit();</script>
        </form>
    </body>

</html>