
<?php
   require_once("CMS/conexao.php");
    require_once("login.php");
    $db=conexaoBD();
    
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
    
	<!-- link do slide -->
	<link rel="stylesheet" type="text/css" href="engine0/style.css" />
	<script src="engine0/jquery.js"></script>
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
                    <form name="frmLogin" method="post" action="home.php">
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
            <!-- começa a home -->
            <section class="section_conteudo">
                <div class="slide">
                    <!-- começo slide --> 
                    <div id="wowslider-container0">
                    <div class="ws_images"><ul>
                        <li><img src="data0/images/capa-VIRTUAL.png" alt="slider" title="Bem Vindo" id="wows0_0"/></li>
                        <li><img src="data0/images/Carol%20Logo.png" alt="imagem slider" title="Leitura" id="wows0_1"/></li>
                        <li><img src="imagens/SLIDE3.png" alt="imagem slider" title="Cultura" id="wows0_2"/></li>
                        <li><img src="data0/images/ideas-2410-6.jpg" alt="imagem slider" title="Redes Sociais" id="wows0_3"/></li>
                    </ul></div>
                    </div>	
                    <script  src="engine0/wowslider.js"></script>
                    <script  src="engine0/script.js"></script>
                    <!-- final slide -->
                </div>
        
                
                <div class="caixa_conteudo">
                    <!-- menu que vai integrar com o bda -->
                    <div class="menu_lateral">
                        <div class="divMenu_lateral"></div>
                        <div class="divMenu_lateral"></div>
                    </div>
                    <!-- area do conteudo de livros  -->
                    <div class="conteudo">
                        <div class="conteudo_caixaLivros">
                            <!-- area dos icons das redes sociais -->
                            <div class="icons">
                                <img src="imagens/facebook%20(1).png" alt="facebook">
                                <img src="imagens/instagram.png" alt="instagram">
                                <img src="imagens/youtube.png" alt="youtube">
                            </div>
                            
                          <!-- onde o livro fica a mostra -->
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            <!-- onde o livro fica a mostra -->
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            <!-- onde o livro fica a mostra -->
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            <!-- onde o livro fica a mostra -->
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>
                                    Detalhes</h6>
                            </div>
                            
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                            
                            <div class="caixa_livros">
                                <div class="foto_livro"><img src="data0/images/livro.png" alt="livro"></div>
                                <div class="titulo_livro">O TÚNEL DO TEMPO</div>
                                <div class="descricao"><h4>Descrição:</h4>'Túnel do Tempo' é uma viagem aos primórdios do Espiritismo....</div>
                                <div class="h7">Preço:R$25,OO</div>
                                <h6>Detalhes</h6>
                            </div>
                        </div>
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