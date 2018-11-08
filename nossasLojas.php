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
    if(isset($_GET['localizacao'])){
         $sql = "SELECT maps FROM tbl_nossaslojas WHERE idLoja=".$_GET['localizacao'];
        
        $select = mysqli_query($conexao,$sql);
        $rsmaps = mysqli_fetch_array($select);
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
                    <form method="post" action="nossasLojas.php" name="frmLogin">
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
            <!-- começa o conteudo das lojas -->
            <section class="section_conteudoLojas">
                <!-- div a esquerda com caixa de pesquisa-->
                <div id="conteudo_lojas">
                     
                    <div class="caixa_pesquisaLoja">
                        Pesquise uma Loja:
                        <!-- caixa de pesquisa -->
                        <input class=caixa_inputPesquisa name="pesquisaLoja" placeholder="pesquisar..."><br>
                        <input id="btn_pesquisar" type="button" value="Procurar">
                        
                        <?php
                                $sql = "SELECT * FROM tbl_nossaslojas ORDER BY idLoja DESC";

                               //executa o script no banco e guarda o retorno na variavel select
                                $select = mysqli_query($conexao,$sql);

                                // PARA PEGAR AS INFORMAÇÕES 
                                // criar um nova variavel para receber as informaçoes do select
                                while($rsLojas=mysqli_fetch_array($select)){
                                    $status = $rsLojas['status'];
                                    if($status){
                            ?>
                       <a href="nossasLojas.php?localizacao=<?php echo($rsLojas['idLoja'])?>"> 
                           <div class="caixa_locais">
                            <div class="img_local">
                                <img src="imagens/iconlocal.png" alt="icon local">
                            </div>
                            <div class="local">
                                <?php echo($rsLojas['nomeLoja'].'-'.$rsLojas['endereco'].'-'. $rsLojas['bairroLoja'].'-'.$rsLojas['cidadeLoja'].'-'.$rsLojas['estadoLoja'])?> 
                            </div>
                            
                        </div>
                        </a>
                        <?php
                             }
                        }
                        ?>
                    </div>
                    <!-- caixa do maps , link do google maps -->
                    <div class="caixa_maps">
                        <iframe src="<?php echo($rsmaps['maps'])?>" width="800" height="800"  style="border:0" allowfullscreen></iframe>
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