<?php
    $login = $_POST['dono'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8"> <!--Caracter Especial -->
    <meta name="description" content="cadastro de pet - Infopets"> <!--descrição do site, que vai aparecer por exemplo na pesquisa do google-->
    <meta name="publisher" content=""><!--link do perfil google-->
    <meta name="author" content="Infopets">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Cadastro de PET</title><!--No maximo 16 caracteres-->
    </head>
  <body>
    <form class=""  method="POST" action="cadastro_pet2.php"> <!-- action : uma vez que cv clique em ok, qual pagina recebera as informações do pos proessamento .
      method: como as informações serao recebidas, como serao processadas-->
      <fieldset> <!--fieldset : areas tipo are pessoa, informação de cobranças email-->
        <legend>.Cadastro do PET.</legend><!-- nome do fieldset, não pode usr o <p> -->
        
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" placeholder="Nome"><br><br>

        <label for="especie">Especie:</label><br>
        <input type="text" name="especie" placeholder="Especie"><br><br>
            
        <label for="nascimento">Nascimento:</label><br>
        <input type="text" name="nascimento" placeholder="dd/mm/aaaa"><br><br>      

        <label for="raca">Raça:</label><br>
        <select class="" name="raca" > <!--se tivesse multiple="multiple" poderia selecionar varios utilizando o ctrl -->
         <option value="Cachorro" selected="selected">Cachorro</option>
         <option value="Gato" >Gato</option>
        </select><br><br>
        
        <input type="hidden" name="dono" value="<?php echo $login;?>"><br><br>

        <input type="reset" name="limpar" value="Limpar">
        <input type="submit" name="enviar" value="Enviar">
        
      </fieldset>
    </form>
  </body>
</html>
