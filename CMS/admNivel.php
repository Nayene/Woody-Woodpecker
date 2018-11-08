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


    $botao = "Cadastrar";
    $sltStatus = 0;
    $host = "localhost";
    $database = "db_formularioFaleConosco";
    $user = "root";
    $password = "bcd127";

    //estabelece a conexão com o banco de dados MSQL, usando a biblioteca MSQLI
    if(!$conexao = mysqli_connect($host,$user,$password,$database))
       echo('erro na conexao com o bando de dados');

    //colocando as informacoes digitadas nas caixa
    if(isset($_POST['btnCadastrar'])){
        $txtNomeNivel = $_POST['txtNomeNivel'];
        $sltStatus = $_POST['sltStatus'];
        
        if($_POST['btnCadastrar'] == 'Cadastrar'){
             $sql ="INSERT INTO tbl_nivel
                (nomeNivel,status)VALUES('".$txtNomeNivel."','".$sltStatus."')";
            
        }else if($_POST['btnCadastrar']== 'Editar'){
            $sql = "UPDATE tbl_nivel SET
            nomeNivel='".$txtNomeNivel."',
            status ='".$sltStatus."'
            WHERE idNivel=".$_SESSION['idNivel'];
            
        }else if($modo == "ativo"){
            
            $idNivel = $_GET['idNivel'];
            $status = $_GET['status'];
            
            if($status == 1){
                $sql = "UPDATE tbl_nivel SET status==0 WHERE idNivel=".$idNivel;
            }
            
            if($status == 0){
                $sql = "UPDATE tbl_nivel SET status==1 WHERE idNivel=".$idNivel;
            }
            
            mysqli_query($conexao, $sql);
            header('location:admNivel.php');
            
        }
        
        mysqli_query($conexao,$sql);
        header('location:admNivel.php');
    }

    // criando o modo excluir 
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //se for igual a exluir
        if($modo == 'excluir'){
            $idNivel = $_GET['idNivel'];
            $sql = "DELETE FROM tbl_nivel WHERE idNivel=".$idNivel;
            
             //Executa  o script
            mysqli_query($conexao,$sql);
            //echo($sql);
            header('location:admNivel.php');
        //criando modo editar
        }else if( $modo == 'editar'){
            $botao = 'Editar';
            $idNivel = $_GET['idNivel'];

            $_SESSION['idNivel']= $idNivel;
            $sql = "SELECT * FROM tbl_nivel WHERE idNivel=".$idNivel;
            
            $select = mysqli_query($conexao,$sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $nomeNivel = $rsConsulta['nomeNivel'];
                $sltStatus= $rsConsulta ['status'];
            }
        }
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
                            Bem Vindo [xxxxxx xxx]
                            <div class="imgLogout">
                                <a href="../home.php"><img src="imagens/logout.png" alt="sair"></a>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- fim cabecario -->
                
                <!-- conteudo -->
                <form name="frmNivel" method="post" action="admNivel.php">
                <section class="caixa_sectionCMS">
                    <div class="titulo">
                        Area de Administração de Níveis de Usuários
                    </div>
                    <div class="sectionNiveis">
                        <div class="titulo">
                            Cadastro de Níveis
                        </div>
                        
                        <div class="caixa_nome">
                            <div class="informacao">
                                Nível: 
                            </div>
                            <p><input type="text" name="txtNomeNivel" placeholder="Digite um nivel" value="<?php echo(@$nomeNivel)?>"></p>
                        </div>
                        
                        <div class="caixa_nome">
                            <div class="informacao">
                                Modo: 
                            </div>
                            <select name="sltStatus">
                                <option <?php if($sltStatus == 0 ) echo("selected")?> value="0">Desativado
                                </option>
                                 <option <?php if($sltStatus == 1 ) echo("selected")?> value="1">Ativado</option>
                            </select>
                        </div>
                         
                        
                        <div class="caixa_sub"> 
                            <input type="submit" name="btnCadastrar" value="<?php echo($botao)?>">
                        </div>
                    </div>
                    <!-- termina cadastro de usuarios -->
                    
                    <!-- começa o crud --> 
                    <div class="titulo_crud">
                         Níveis
                    </div>
                    <div class="sectionCrudUsuarios">
                        <?php
                            $sql = "SELECT * FROM tbl_nivel ORDER BY idNivel DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsNivel=mysqli_fetch_array($select)){
                        ?>
                        <div class="tabela">
                            <div class="row_tabela"> 
                                <h4>Nivel:</h4>
                                <?php echo($rsNivel['nomeNivel'])?> 
                            </div>
                            
                            <div class="icon_tabela">
                                <a href="admNivel.php?modo=excluir&idNivel=<?php echo($rsNivel['idNivel'])?>"> 
                                    <img src="imagens/trash.png" alt="apagar"/> 
                                </a>
                                <a class="visualizar" href="admNivel.php?modo=editar&idNivel=<?php echo($rsNivel['idNivel'])?>">
                                    <img src="imagens/edit.png" alt="editar">  
                                </a>
                                <?php 
                                        if($rsNivel['status']== 1){
                                      ?> 
                                            <img src="imagens/ativado.png">
                                     <?php 
                                        }else if($rsNivel['status']==0){
                                       ?> 
                                            <img src="imagens/desabilitar.png">
                                     <?php
                                        }
                                    ?>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </section>
                </form>
                <!-- fim conteudo -->
                <footer class="footer">
                    Desenvolvido por Nayene Espindola
                </footer>
            </div>
        </div>
    </body>
</html>