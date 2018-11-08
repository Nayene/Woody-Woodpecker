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
    // declarando a variavel igual a 0 para que ela exista no where para carregar os niveis 
    $stlNivel = 0 ;
    $sltStatus = 0;
    $host = "localhost";
    $database = "db_formularioFaleConosco";
    $user = "root";
    $password = "bcd127";

    //estabelece a conexão com o banco de dados MSQL, usando a biblioteca MSQLI
    if(!$conexao = mysqli_connect($host,$user,$password,$database))
       echo('erro na conexao com o bando de dados');
    
    if(isset($_POST['btnCadastrar'])){
        $txtNomeUser = $_POST['txtNomeUser'];
        $txtLoginUser = $_POST['txtLoginUser'];
        $txtSenhaUser = $_POST['txtSenhaUser'];
        $stlNivel = $_POST['stlNivel'];
        $sltStatus = $_POST['sltStatus'];
        
        if($_POST['btnCadastrar'] == 'Cadastrar'){
            $sql = "INSERT INTO tbl_usuarios (nomeUsuario,loginUsuario,senha,idNivel,status)VALUES('".$txtNomeUser."','".$txtLoginUser."','".$txtSenhaUser."','".$stlNivel."','".$sltStatus."')";
        }else if($_POST['btnCadastrar']== 'Editar'){
            $sql = "UPDATE tbl_usuarios SET  nomeUsuario='".$txtNomeUser."',loginUsuario='".$txtLoginUser."',senha='".$txtSenhaUser."',idNivel='".$stlNivel."', status ='".$sltStatus."'
            WHERE idUsuario=".$_SESSION['idUsuario'];
            
        }
            
        mysqli_query($conexao,$sql);
        //echo($sql);
        header('location:admCadastroUsuarios.php');
    }


    // criando o modo excluir 
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //se for igual a exluir
        if($modo == 'excluir'){
            $idUsuario = $_GET['idUsuario'];
            $sql = "DELETE FROM tbl_usuarios WHERE idUsuario=".$idUsuario;
            
             //Executa  o script
            mysqli_query($conexao,$sql);
            header('location:admCadastroUsuarios.php');
        //criando modo editar
        }else if( $modo == 'editar'){
            $botao = 'Editar';
            $idUsuario = $_GET['idUsuario'];

            $_SESSION['idUsuario']= $idUsuario;
            $sql= " SELECT tbl_usuarios.nomeUsuario , 
            tbl_usuarios.loginUsuario, 
            tbl_usuarios.senha, 
            tbl_nivel.idNivel , 
            tbl_nivel.nomeNivel,
            tbl_usuarios.status
            FROM tbl_nivel , 
            tbl_usuarios
            WHERE tbl_nivel.idNivel = tbl_usuarios.idNivel
             and tbl_usuarios.idUsuario =".$idUsuario;
            
            $select = mysqli_query($conexao,$sql);
            // pegando todos os campos para editar e salvar
            if($rsConsulta = mysqli_fetch_array($select)){
                $nomeUsuario = $rsConsulta['nomeUsuario'];
                $loginUsuario = $rsConsulta['loginUsuario'];
                $senha = $rsConsulta['senha'];
                $stlNivel = $rsConsulta['idNivel'];
                $nomeNivel= $rsConsulta ['nomeNivel'];
                $sltStatus= $rsConsulta ['status'];
            }
            //fazendo o ativar e desativar
        }else if($modo == "ativo"){
            
            $idUsuario = $_GET['idUsuario'];
            $status = $_GET['status'];
            
            if($status == 1){
                $sql = "UPDATE tbl_usuarios SET status==0 WHERE idUsuario=".$idUsuario;
            }
            
            if($status == 0){
                $sql = "UPDATE tbl_usuarios SET status==1 WHERE idUsuario=".$idUsuario;
            }
            
            mysqli_query($conexao, $sql);
            header('location:admCadastroUsuarios.php');
            
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
                    <div class="titulo">
                        Area de Administração de Usuários
                    </div>
                    <div class="sectionUsuarios">
                        <form name="frmCadastroUsuarios" method="post" action="admCadastroUsuarios.php">
                            <div class="titulo">
                                Cadastro de Usuários
                            </div>

                            <div class="caixa_nome">
                                <div class="informacao">
                                    Nome: 
                                </div>
                                <p><input type="text" name="txtNomeUser" placeholder="Digite um nome" value="<?php echo(@$nomeUsuario)?>"> </p>
                            </div>

                             <div class="caixa_nome">
                                <div class="informacao">
                                    Login: 
                                </div>
                                <p><input type="text" name="txtLoginUser" placeholder="woody@gmail.com" value="<?php echo(@$loginUsuario)?>"> </p>
                            </div>

                             <div class="caixa_nome">
                                <div class="informacao">
                                    Senha: 
                                </div>
                                <p><input class="input_senha" type="password" name="txtSenhaUser" placeholder="*********" value="<?php echo(@$senha)?>"></p>
                            </div>

                             <div class="caixa_nome">
                                <div class="informacao">
                                    Nível: 
                                </div>
                                <div class="caixa_select"> 
                                    <select name="stlNivel">
                                       <?php
                                            if($modo == 'editar'){
                                        ?>
                                             <option value="<?php echo($stlNivel)?>"> <?php echo($nomeNivel)?> </option>
                                        <?php
                                            }
                                        else{
                                        ?>
                                            <option value="">  Selecione um item  </option>
                                        <?php
                                          }
                                        ?>
                                        
                                        
                                         <?php
                                                $sql = "SELECT * FROM tbl_nivel WHERE idNivel <> ".$stlNivel." ORDER BY idNivel DESC";
                                                

                                               //executa o script no banco e guarda o retorno na variavel select
                                                $select = mysqli_query($conexao,$sql);

                                                // PARA PEGAR AS INFORMAÇÕES 
                                                // criar um nova variavel para receber as informaçoes do select
                                                while($rsNivelUsuario=mysqli_fetch_array($select)){
                                            ?>
                                        <option value="<?php echo($rsNivelUsuario['idNivel'])?>"> 
                                            <?php echo($rsNivelUsuario['nomeNivel'])?> 
                                        </option>  
                                        <?php
                                                }
                                        ?>
                                    </select>
                                </div>
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
                        </form>
                    </div>
                    <!-- termina cadastro de usuarios -->
                    
                    <!-- começa o crud --> 
                    <div class="titulo_crud">
                         Usuários 
                    </div>
                    <div class="sectionCrudUsuarios">
                        <?php
                            $sql = "SELECT * FROM tbl_usuarios ORDER BY idUsuario DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsUsuarios=mysqli_fetch_array($select)){
                        ?>
                        <div class="tabela">
                            <div class="row_tabela"> 
                                <div class="item">
                                    <h4>Nome:</h4> 
                                    <?php echo($rsUsuarios['nomeUsuario'])?> 
                                </div>
                                <div class="item">
                                    <h4>Email:</h4> 
                                    <?php echo($rsUsuarios['loginUsuario'])?> 
                                </div>
                            </div>
                            
                            <div class="icon_tabela">
                                 <a href="admCadastroUsuarios.php?modo=editar&idUsuario=<?php echo($rsUsuarios['idUsuario'])?>">
                                    <img src="imagens/edit.png">  
                                </a>
                                 <a href="admCadastroUsuarios.php?modo=excluir&idUsuario=
                                        <?php echo($rsUsuarios['idUsuario'])?>"> 
                                        <img src="imagens/trash.png" alt="apagar"/> 
                                </a>
                                 <?php 
                                        if($rsUsuarios['status']== 1){
                                      ?> 
                                            <img src="imagens/ativado.png">
                                     <?php 
                                        }else if($rsUsuarios['status']==0){
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
                <!-- fim conteudo -->
                <footer class="footer">
                    Desenvolvido por Nayene Espindola
                </footer>
            </div>
        </div>
    </body>
</html>