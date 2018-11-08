<?php
    session_start();
      
   

    // para nao conseguir entrar pela url sem a variavel de sessao
    if(!isset($_SESSION['nome'])){
         header('location:../home.php');
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header('location:../home.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>CMS - Woody Woodpecker</title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
    </head>
    <body>
        <div class="telaCMS">
            <div class="caixa_cms">
                <header class="header">
                    <div class="caixa_cabecario">
                        <div class="tituloCMS">
                            CMS - Sistema De Gerenciamento Do Site 
                        </div>
                        <div class="logoCMS"> 
                            <img src="../imagens/logoPreto.png" alt="Logo" width="300" height="75%">
                        </div>
                    </div>
                    
                    <div class="caixa_menu">
                        <div class="menu_icon">
                            <a href="admConteudo.php"> <img src="imagens/conteudo.png" alt="conteudo"></a>
                            <h2>Adm. de Conteudo</h2>
                        </div>
                        
                        <div class="menu_icon">
                            <a href="admFaleconosco.php"><img src="imagens/falecon.png" alt="fale conosco"></a>
                            <h2>Adm. Fale Conosco</h2>
                        </div>
                        
                        <div class="menu_icon">
                            <img src="imagens/pro.png" alt="produtos">
                            <h2>Adm. de Produtos</h2>
                        </div>
                        
                        <div class="menu_icon">
                             <a href="admUsuario.php"><img src="imagens/usuarios.png" alt="usuarios"></a>
                            <h2>Adm. de Usuários</h2>
                        </div>
                        
                        <div class="mensagem">
                            Bem Vindo <?php
                                echo($_SESSION['nome']);
                            ?>
                            <div class="imgLogout">
                                <a href="admConteudo.php?logout=sim"><img src="imagens/logout.png" alt="sair"></a>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="caixa_sectionCMS">
                    <a href="admAutores.php">
                    <div class="caixaPagina">
                        <div class="imgPagina">
                            <img src="imagens/settings.png" alt="EDITAR">
                        </div>
                        <div class="nomePagina"> 
                             Autores 
                        </div>
                    </div>
                    </a>
                    <a href="admLivroMes.php">
                        <div class="caixaPagina">
                            <div class="imgPagina">
                                <img src="imagens/settings.png" alt="EDITAR">
                            </div>
                            <div class="nomePagina"> Livro do Mês </div>
                        </div>
                    </a>
                    <a href="admPromocao.php">
                        <div class="caixaPagina">
                            <div class="imgPagina">
                                <img src="imagens/settings.png" alt="EDITAR">
                            </div>
                            <div class="nomePagina"> Promoções </div>
                        </div>
                    </a>
                    <a href="admNossasLojas.php">
                        <div class="caixaPagina">
                            <div class="imgPagina">
                                <img src="imagens/settings.png" alt="EDITAR">
                            </div>
                            <div class="nomePagina"> Nossas Lojas </div>
                        </div>
                    </a>
                    
                    <a href="admSobre.php">
                        <div class="caixaPagina">
                            <div class="imgPagina">
                                <img src="imagens/settings.png" alt="EDITAR">
                            </div>
                            <div class="nomePagina"> Sobre </div>
                        </div>
                   </a>
                </section>
                
                <footer class="footer">
                    Desenvolvido por Nayene Espindola
                </footer>
            </div>
        </div>
    </body>
</html>