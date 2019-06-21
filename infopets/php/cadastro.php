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

$login = $_POST['login'];
$senha = MD5($_POST['senha']);

$connect = mysqli_connect('localhost','u794024087_okdg','okdgpuc');
$db = mysqli_select_db($connect,'u794024087_infop');

$query_select = "SELECT login FROM usuarios WHERE login = '$login'";
$select = executar($query_select);

$array = mysqli_fetch_array($select);
$logarray = $array['login'];

  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='cadastro.html';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='../cadastro.html';</script>";
        die();

      }else{
        $query = "INSERT INTO usuarios (login,senha) VALUES ('$login','$senha')";
        $insert = executar($query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='../index.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='../cadastro.html'</script>";
        }
      }
    }
?>