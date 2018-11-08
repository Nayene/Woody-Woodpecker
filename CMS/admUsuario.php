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
        <script src="js/jquery.js"></script>
        
    </head>
    <body>
           <!-- CODIGO PARA GERAR A TELA DA MODAL NO NAVEGADOR -->
        <div id="container">
            <div id="modal">
                    
            </div>
        </div>
        <div class="telaCMS">
            <div class="caixa_cms">
                <!-- cabecario -->
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
                <!-- fim cabecario -->
                
                <!-- conteudo -->
                <section class="caixa_sectionCMS">
                    <div class="caixa_cad">
                        <a href="admCadastroUsuarios.php"> 
                            <img src="imagens/user.png">
                            <h2> Cadastro de Usuários</h2>
                        </a>
                    </div>
                    
                    <div class="caixa_ni">
                        <a href="admNivel.php"> 
                            <img src="imagens/levels.png">
                            <h2> Cadastro de Níveis</h2>
                        </a>
                    </div>
                    
                </section>
                <!-- fim conteudo -->
                <footer class="footer">
                    Desenvolvido por Nayene Espindola
                </footer>
            </div>
        </div>
    </body>
</html>