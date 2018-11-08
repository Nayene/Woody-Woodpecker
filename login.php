<?php

    function login($txtUsuario,$txtSenha){
        require_once("CMS/conexao.php");
        $db = conexaoBD();
        $sqlLogin="select * from tbl_usuarios where loginUsuario='".$txtUsuario."' and senha='".$txtSenha."' and status = 1";
        $login = mysqli_query($db,$sqlLogin);
        
        if($rsLogin = mysqli_fetch_array($login)){
            session_start();
            $_SESSION['nome'] = $rsLogin['nomeUsuario']; 
            header('location:CMS/admConteudo.php');
        }else{
            echo('<script>alert("Login Inválido")</script>');
        }
    }
?>