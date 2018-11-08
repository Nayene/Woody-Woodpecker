<?php
    require_once("CMS/conexao.php");
    require_once("login.php");
    $host = "localhost";
    $database = "db_formularioFaleConosco";
    $user = "root";
    $password = "bcd127";

    //estabelece a conexão com o banco de dados MSQL, usando a biblioteca MSQLI
    if(!$conexao = mysqli_connect($host,$user,$password,$database))
       echo('erro na conexao com o bando de dados');
    if(isset($_POST['txtBotao'])){
        $txtUsuario = $_POST["txtUsuario"];
        $txtSenha = $_POST["txtSenha"];
        
        login($txtUsuario,$txtSenha);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Woody Woodpecker</title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
    </head>
    <body>
        <div class="tela">
            <!-- menu -->
            <header class="header">
                <div class="caixa_header">
                    <div class="caixa_logo"></div>
                    <nav class="caixa_menu">
                         <div class="menu"><a href="home.php">HOME</a></div>
                        <div class="menu"><a href="livroMes.php">LIVRO DO MÊS</a></div>
                        <div class="menu"><a href="autores.php">AUTORES</a></div>
                        <div class="menu"><a href="sobre.php">SOBRE</a></div>
                        <div class="menu"><a href="promocoes.php">PROMOÇÕES</a></div>
                    </nav>
                    <form method="post" action="sobre.php" name="frmLogin">
                        <div class="caixa_cadastro">
                            <div class="caixaText_cadastro">
                                Usuário: 
                                <p><input class="input_cadastro"  name="txtUsuario" size="20" value=""></p>
                            </div>
                            <div class="caixaText_cadastro">
                                Senha: 
                                <p><input class="input_cadastro" type="password" name="txtSenha" size="15" value=""></p>
                            </div>
                            <input id="botaoOK"type="submit" name="txtBotao" value="OK">
                        </div>
                    </form>
                </div>
            </header>
            <!-- começa o conteudo de sobre -->
            <section class="section_conteudo">
                <div id="caixa_imgSobre"> 
                    <img src="imagens/logoBranco.png" alt="Logo Woody Woodpecker"/>
                </div>
                <div id="conteudo_sobre">
                    <?php
                            $sql = "SELECT * FROM tbl_sobre ORDER BY idSobre DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsSobre=mysqli_fetch_array($select)){
                            $status = $rsSobre['status'];
                                if($status){
                        ?>
                    <div id="texto_sobre"> 
                        <h1>Nossa História</h1><br>
                        <?php echo($rsSobre['nossaHistoria'])?> 
                        
                       
                    </div>
                    <div class="texto_sobre_2">
                        <h1>Nossa Missão</h1>
                        <?php echo($rsSobre['nossaMissao'])?> 
                    </div>
                    
                    <div class="texto_sobre_2">
                        <h1>Nossa Livraria</h1>
                        <?php echo($rsSobre['nossaLivraria'])?> 
                    </div>
                    
                    <div class="sobre_lojas">
                         <img src="CMS/<?php echo($rsSobre['foto'])?>">
                    </div>
                    
                    <div class="texto_sobre_3">
                        <h1>Nossas Criações</h1>
                         <?php echo($rsSobre['nossasCriacoes'])?> 
                    </div>
                     <?php
                            }
                        }
                    ?>
                </div>
            </section>
            
             <!-- rodapé -->
            <footer>
                <div class="caixa_informacoes">
                    <div class="caixa_footer">
                        <!-- direciona para a tela do fale conosco -->
                        <h3>
                            <a href="faleConosco.php" > FALE CONOSCO</a> 
                        </h3>
                        <h5>
                            (11)95450-3968 <br> (11)4144-5263 <br>  SENAI- Jandira
                        </h5>
                    </div>
                    <div class="caixa_footer">
                        <!-- direciona para a tela noosas lojas -->
                       <h3>
                           <a href="nossasLojas.php">NOSSAS LOJAS </a>
                        </h3>
                        <h5>
                            Rua Elton Silva, 905 <br> Centro, Jandira - SP, 06600-025
                        </h5>
                    </div>
                    <div class="caixa_footer">
                        <h3>ESCREVA-NOS </h3>
                        <h5>woody_woodpecker@gmail.com <br>nayene.manu@gmail.com</h5>
                    </div>
                </div>
                    © 2018 Woody Woodpecker
            </footer>
        </div>
    </body>
</html>