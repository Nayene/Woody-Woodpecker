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
                    <form method="post" action="livroMes.php" name="frmLogin">
                    <div class="caixa_cadastro">
                        <div class="caixaText_cadastro">
                            Usuário: 
                            <p><input class="input_cadastro"  name="txtUsuario" size="20" value=""></p>
                        </div>
                        <div class="caixaText_cadastro">
                            Senha: 
                            <p><input class="input_cadastro" type="password" name="txtSenha" size="15" value=""></p>
                        </div>
                        <input id="botaoOK" type="submit" name="txtBotao" value="OK">
                    </div>
                    </form>
                </div>
            </header>
            <!-- começa o conteudo dos livros destacados -->
            <section class="section_livroMes">
                <div id="conteudo_livroMes">
                    <div class="caixa_livroDestaque">
                        Livro Destaque do Mês
                        <!-- bola DESTAQUES-->
                        <div class="caixa_livroMes"> DESTAQUES</div>
                    </div>
                    
                    <!-- LIVROS DESTACADOS -->
                    <div class="livrosDestaques">
                        <?php
                            $sql = "SELECT * FROM tbl_livromes ORDER BY idLivroMes DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsLivroMes=mysqli_fetch_array($select)){
                                $status = $rsLivroMes['status'];
                                if($status){
                        ?>
                        <div class="caixa_livros2">
                                <div id="foto2">
                                    <img src="CMS/<?php echo($rsLivroMes['foto'])?>" alt="livro">
                                </div>
                                <div class="titulo_livro2">
                                    <?php echo($rsLivroMes['tituloLivro'])?> 
                                </div>
                                <div class="descricao2">
                                    <h4>Descrição:</h4>
                                     <?php echo($rsLivroMes['descricao'])?> 
                                </div>
                                <div class="h7">
                                    Preço:R$<?php echo($rsLivroMes['precoLivro'])?> 
                                </div>
                                
                        </div>
                        <?php
                                }
                            }
                        ?>  
                    </div>
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