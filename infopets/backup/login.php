<?php 
  $login = $_POST['login'];
  $entrar = $_POST['entrar'];
  $senha = md5($_POST['senha']);
  $connect = mysqli_connect('localhost','id2735915_okdgteste','okdgpuc');
  $db = mysqli_select_db($connect,'id2735915_teste1');
    if (isset($entrar)) {
            
      $verifica = mysqli_query($connect,"SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        if (mysqli_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.html';</script>";
          die();
        }else{
          setcookie("login",$login);
          header("Location:home.html");
        }
    }
?>