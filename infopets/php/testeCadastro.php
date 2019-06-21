<?php

$login = $_POST['dono'];
$nome = $_POST['nome'];
$especie = $_POST['especie'];
$nascimento = $_POST['nascimento'];
$raca = $_POST['raca'];

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

$id_user = "SELECT id FROM usuarios WHERE login = '$login'";
$select = executar($id_user);
$row = mysqli_fetch_assoc($select);
$variavel = intval($row['id']);

$cadastra = "INSERT INTO pet (id_pet, id_dono, nome, especie, nascimento, raca) 
 VALUES (DEFAULT, $variavel, '$nome', '$especie', '$nascimento', '$raca')";
$insert = executar($cadastra);

if($insert){
    
    echo"<script language='javascript' type='text/javascript'>alert('Pet cadastrado com sucesso! ');</script>";

}else{
  echo"<script language='javascript' type='text/javascript'>alert('erro ao cadastrar o pet ');window.location.href='../index.html'</script>";
}
?>