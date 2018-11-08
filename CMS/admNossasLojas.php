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
    
    if(isset($_POST['btnCadastrar'])){
        $nomeLoja = $_POST['nomeLoja'];
        $cidadeLoja = $_POST['cidadeLoja'];
        $bairroLoja = $_POST['bairroLoja'];
        $estadoLoja = $_POST['estadoLoja'];
        $endereco = $_POST['endereco'];
        $sltStatus = $_POST['sltStatus'];
        $maps = $_POST['maps'];
    
        if($_POST['btnCadastrar'] == 'Cadastrar'){
            $sql = "INSERT INTO tbl_nossaslojas (nomeLoja,cidadeLoja,bairroLoja,estadoLoja,endereco,status,maps)VALUES('".$nomeLoja."','".$cidadeLoja."','".$bairroLoja."','".$estadoLoja."','".$endereco."','".$sltStatus."','".$maps."')";
        }else if($_POST['btnCadastrar']== 'Editar'){
            $sql = "UPDATE tbl_nossaslojas SET  
            nomeLoja='".$nomeLoja."',
            cidadeLoja='".$cidadeLoja."',
            bairroLoja='".$bairroLoja."',
            estadoLoja='".$estadoLoja."',
            endereco='".$endereco."',
            status ='".$sltStatus."',
            maps ='".$maps."'
            WHERE idLoja=".$_SESSION['idLoja'];
            
        }
            
        mysqli_query($conexao,$sql);
        //echo($sql);
        header('location:admNossasLojas.php');
    }


    // criando o modo excluir 
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //se for igual a exluir
        if($modo == 'excluir'){
            $idLoja = $_GET['idLoja'];
            $sql = "DELETE FROM tbl_nossaslojas WHERE idLoja=".$idLoja;
            
             //Executa  o script
            mysqli_query($conexao,$sql);
            header('location:admNossasLojas.php');
        //criando modo editar
        }else if( $modo == 'editar'){
            $botao = 'Editar';
            $idLoja = $_GET['idLoja'];
            
            $_SESSION['idLoja']= $idLoja;
            $sql = "SELECT * FROM tbl_nossaslojas WHERE idLoja=".$idLoja;
            
            $select = mysqli_query($conexao,$sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $nomeLoja = $rsConsulta['nomeLoja'];
                $cidadeLoja = $rsConsulta['cidadeLoja'];
                $bairroLoja = $rsConsulta['bairroLoja'];
                $estadoLoja = $rsConsulta['estadoLoja'];
                $endereco = $rsConsulta['endereco'];
                $maps = $rsConsulta['maps'];
                $sltStatus= $rsConsulta ['status'];
            }
        }else if($modo == "ativo"){
            
            $idLoja = $_GET['idLoja'];
            $status = $_GET['status'];
            
            if($status == 1){
                $sql = "UPDATE tbl_nossaslojas SET status==0 WHERE idLoja=".$idLoja;
            }
            
            if($status == 0){
                $sql = "UPDATE tbl_nossaslojas SET status==1 WHERE idLoja=".$idLoja;
            }
            
            mysqli_query($conexao, $sql);
            header('location:admNossasLojas.php');
            
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
                        Area de Administração de Lojas
                    </div>
                    <div class="sectionLojas">
                        <form name="frmLojas" method="post" action="admNossasLojas.php" >
                            <div class="titulo">
                                Cadastro de Lojas
                            </div>

                            <div class="caixa_nome">
                                <div class="informacao">
                                   Loja: 
                                </div>
                                <p><input type="text" name="nomeLoja" placeholder="Nome da Loja " value="<?php echo(@$nomeLoja)?>"> </p>
                            </div>
                            
                            <div class="caixa_nome">
                                <div class="informacao">
                                    End.: 
                                </div>
                                <p><input type="text" name="endereco" placeholder="Rua, N°da Loja" value="<?php echo(@$endereco)?>">
                            </div>
                            
                            <div class="caixa_nome">
                                <div class="informacao">
                                    Bairro: 
                                </div>
                                <p><input  type="text" name="bairroLoja" placeholder="Bairro Da Loja" value="<?php echo(@$bairroLoja)?>"></p>
                            </div>
                            <div class="caixa_nome">
                                <div class="informacao">
                                    Cidade: 
                                </div>
                                <p><input type="text" name="cidadeLoja" placeholder="Cidade da Loja " value="<?php echo(@$cidadeLoja)?>"> </p>
                            </div>
                            <div class="caixa_nome">
                                <div class="informacao">
                                    Estado: 
                                </div>
                                <p><input type="text" name="estadoLoja" placeholder="Estado da Loja" value="<?php echo(@$estadoLoja)?>">
                            </div>
                            
                             <div class="caixa_nome">
                                <div class="informacao">
                                    Mapa: 
                                </div>
                                <p><input type="text" name="maps" placeholder="Copie somente o http do Mapa" value="<?php echo(@$maps)?>">
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
                         Lojas 
                    </div>
                    <div class="sectionCrudAutores">
                        <?php
                            $sql = "SELECT * FROM tbl_nossaslojas ORDER BY idLoja DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsLojas=mysqli_fetch_array($select)){
                        ?>
                        <div class="tabela">
                            <div class="row_tabela"> 
                                <div class="item">
                                    <h4>Nome:</h4> 
                                    <?php echo($rsLojas['nomeLoja'])?> 
                                </div>
                                <div class="item">
                                    <h4>Local:</h4> 
                                    <?php echo($rsLojas['cidadeLoja'])?> 
                                </div>
                            </div>
                            
                             <div class="icon_tabela">
                                 <a href="admNossasLojas.php?modo=editar&idLoja=<?php echo($rsLojas['idLoja'])?>">
                                    <img src="imagens/edit.png">  
                                </a>
                                 <a href="admNossasLojas.php?modo=excluir&idLoja=
                                     <?php echo($rsLojas['idLoja'])?>"> 
                                      <img src="imagens/trash.png" alt="apagar"/> 
                                </a>
                                 <?php 
                                
                                    if($rsLojas['status']== 1){
                                  ?> 
                                        <img src="imagens/ativado.png">
                                 <?php 
                                    }else if($rsLojas['status']==0){
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