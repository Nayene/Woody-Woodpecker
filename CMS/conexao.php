<?php
    function conexaoBD(){
    $host = "localhost";
    $database = "db_formularioFaleConosco";
    $user= "root";
    $password = "bcd127";

    // conexão com o banco de dados 
    
    if(!$conexao = mysqli_connect($host,$user,$password,$database))
        echo('ERRO na conexão com o BANCO DE DADOS');
    
        
        return $conexao;
    }
?>