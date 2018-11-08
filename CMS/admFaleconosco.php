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


    require_once('conexao.php'); /*INCLUI O ARQUIVO QUE FAZ A CONXAO COM O BANCO DE DADOS*/

    $conexao = conexaoBD(); /*CHAMA A FUNÇÃO QUE ESTABELECE A CONEXÃO COM O BANCO DE DADOS*/
    
   if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //Se modo for excluir
        if($modo == 'excluir'){
            
            $id = $_GET['id'];
            $sql = "delete from tbl_contato where id=".$id;
            
            //Executa no BD o script
            mysqli_query($conexao,$sql);

            //Redireciona para página inicial
            header('location:admFaleconosco.php');
        }   
   }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>CMS - Woody Woodpecker</title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                // function para abrir  a janela da modal 
                $(".visualizar").click(function(){
                    $("#container").fadeIn(200);
                });
            });
        
            function modal(id){ /*FUNÇÃO PARA RECEBER O ID DO REGISTRO E DESCARREGAR NA MODAL*/
                
                
                
                $.ajax({ /*SOMENTE O AJAX CONSEGUE FORÇAR O POST/GET PARA UMA PAGINA, SEM PRECISAR ATUALIZAR A PAGINA*/
                   
                    type: "POST",
                    url: "modal.php",
                    data: {idRegistro:id},
                    success: function(dados){
                       
                        $('#modal').html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
           <!-- CODIGO PARA GERAR A TELA DA MODAL NO NAVEGADOR -->
        <div id="container">
            <div id="modal">
                    
            </div>
        </div>
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
                        <div class="titulo">
                            Area de Administração de Fale Conosco
                        </div>
                    <div class="sectionFaleconosco">
                        <!-- select no bancoooo -->
                        <?php
                            $sql = "select * from tbl_contato ORDER BY id DESC";
                    
                            //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);

                            // convertem resultado do banco em um formato conhecido para o php extrair as informações 
                            while($rsContato=mysqli_fetch_array($select)){
                            ?>
                        <div class="tabela">
                            <div class="row_tabela">
                                <div class="item">
                                    <h4>Nome:</h4>
                                    <?php echo($rsContato['nome'])?> 
                                </div>
                                <div class="item"> 
                                    <h4>Email:</h4>
                                    <?php echo($rsContato['email'])?>
                                </div>
                            </div>
                            
                            <div class="icon_tabela">
                               <a href="admFaleconosco.php?modo=excluir&id=<?php echo($rsContato['id'])?>">
                                   <img src="imagens/trash.png"/>
                                </a> 
                                <a onclick="modal(<?php echo($rsContato['id'])?>);" class="visualizar"><img src="imagens/search.png">  </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                          
                    </div>
                </section>
                
                <footer class="footer">
                    Desenvolvido por Nayene Espindola
                </footer>
            </div>
        </div>
    </body>
</html>