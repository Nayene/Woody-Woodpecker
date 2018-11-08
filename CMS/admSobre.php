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
        $nossaHistoria = $_POST['nossaHistoria'];
        $nossaMissao = $_POST['nossaMissao'];
        $nossaLivraria = $_POST['nossaLivraria'];
        $nossasCriacoes = $_POST['nossasCriacoes'];
        $foto = $_POST['foto'];
        $sltStatus = $_POST['sltStatus'];
        
        if($_POST['btnCadastrar'] == 'Cadastrar'){
            $sql = "INSERT INTO tbl_sobre (nossaHistoria,nossaMissao,nossaLivraria,nossasCriacoes,foto,status)VALUES('".$nossaHistoria."','".$nossaMissao."','".$nossaLivraria."','".$nossasCriacoes."','".$foto."','".$sltStatus."')";
        }else if($_POST['btnCadastrar']== 'Editar'){
            if($foto== ""){
                $sql = "UPDATE tbl_sobre SET                       
                nossaHistoria='".$nossaHistoria."',
                nossaMissao='".$nossaMissao."',
                nossaLivraria='".$nossaLivraria."',
                nossasCriacoes='".$nossasCriacoes."',
                status ='".$sltStatus."'
                WHERE idSobre=".$_SESSION['idSobre'];
            }else{
                $sql = "UPDATE tbl_sobre SET                       
                nossaHistoria='".$nossaHistoria."',
                nossaMissao='".$nossaMissao."',
                nossaLivraria='".$nossaLivraria."',
                nossasCriacoes='".$nossasCriacoes."',
                foto='".$foto."',
                status ='".$sltStatus."'
                WHERE idSobre=".$_SESSION['idSobre'];
            }
        }
            
        mysqli_query($conexao,$sql);
        //echo($sql);
        header('location:admSobre.php');
    }


    // criando o modo excluir 
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //se for igual a exluir
        if($modo == 'excluir'){
            $idSobre = $_GET['idSobre'];
            $sql = "DELETE FROM tbl_sobre WHERE idSobre=".$idSobre;
            
             //Executa  o script
            mysqli_query($conexao,$sql);
            header('location:admSobre.php');
        //criando modo editar
        }else if( $modo == 'editar'){
            $botao = 'Editar';
            $idSobre = $_GET['idSobre'];
            
            $_SESSION['idSobre']= $idSobre;
            $sql = "SELECT * FROM tbl_sobre WHERE idSobre=".$idSobre;
            
            $select = mysqli_query($conexao,$sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $nossaHistoria = $rsConsulta['nossaHistoria'];
                $nossaMissao = $rsConsulta['nossaMissao'];
                $nossaLivraria = $rsConsulta['nossaLivraria'];
                $nossasCriacoes = $rsConsulta['nossasCriacoes'];
                $foto= $rsConsulta ['foto'];
                $sltStatus= $rsConsulta ['status'];
            }
        }else if($modo == "ativo"){
            
            $idSobre = $_GET['idSobre'];
            $status = $_GET['status'];
            
            if($status == 1){
                $sql = "UPDATE tbl_sobre SET status==0 WHERE idSobre=".$idSobre;
            }
            
            if($status == 0){
                $sql = "UPDATE tbl_sobre SET status==1 WHERE idSobre=".$idSobre;
            }
            
            mysqli_query($conexao, $sql);
            header('location:admSobre.php');
            
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>CMS - Woody Woodpecker</title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
       
        <script>
            $(document).ready(function(){
            // para testar se esta chamando o jquery
            // alert('ok'); 
            // na ação do live, do elemento file, que significa ao ser carregado com um arquivo (foto) será acionado
            
            $('#foto').live('change',function(){
                //coloca um gif animado para o usuario
                $('#visualizar').html("<img src='img/ajax-loader.gif'>");
                
                setTimeout(function(){
                    
                    //forçando um submitno formulario do upload para conseguir realizar upload da foto sem um click do botão
                 $('#frmFoto').ajaxForm({
                     // passando um parametro para o ajax, (quero que vc mostre dentro da div)
                     target:'#visualizar'
                 }).submit(); 
                    
                },2000);   
            });
        });
            
        </script>
        
        
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
                        Area de Administração Sobre a Livraria
                    </div>
                    <div class="sectionAutores">
                         <form name="frmFoto" method="post" action="upload.php" id="frmFoto" enctype="multipart/form-data">
                             <div class="titulo">
                                Cadastro de Conteúdo Sobre
                            </div>
                             <div class="caixa_nome_autores">
                                <div class="informacao_autores_top">
                                    Foto Loja: 
                                </div>
                                <p><input class="file" type="file" name="filefoto" id="foto" > </p>
                                            
                            </div>  
                            <div id="visualizar">
                                <img src="<?php echo($foto)?>">
                            </div>
                             
                           
                        </form>
                        
                        <form name="frmConteudo" method="post" action="admSobre.php" >
                           <div class="caixa_nome_sobre">
                                <div class="informacao">
                                    Nossa Historia:
                                </div>
                                <br>
                                    <textarea class="textareaSobre"  name="nossaHistoria" placeholder="Digite a História da Livraria"><?php echo(@$nossaHistoria)?></textarea>
                            </div>
                            
                            <div class="caixa_nome_sobre">
                                <div class="informacao">
                                    Nossa Missão:
                                </div>
                                <br>
                                    <textarea class="textareaSobre"  name="nossaMissao" placeholder="Fale sobre a Missão da Livraria"><?php echo(@$nossaMissao)?></textarea>
                            </div>
                            
                            <div class="caixa_nome_sobre">
                                <div class="informacao">
                                    Nossa Livraria:
                                </div>
                                <br>
                                    <textarea class="textareaSobre"  name="nossaLivraria" placeholder="Digite sobre a Livraria"><?php echo(@$nossaLivraria)?></textarea>
                            </div>
                            
                            <div class="caixa_nome_sobre">
                                <div class="informacao">
                                    Nossas Criações:
                                </div>
                                <br>
                                    <textarea class="textareaSobre"  name="nossasCriacoes" placeholder="Fale sobre as Criações"><?php echo(@$nossasCriacoes)?></textarea>
                            </div>
                            
                              <div class="caixa_nome_sobre">
                                <div class="informacao">
                                    Modo:
                                </div>
                                <select name="sltStatus">
                                        <option <?php if($sltStatus == 0 ) echo("selected")?> value="0">Desativado
                                        </option>
                                        <option <?php if($sltStatus == 1 ) echo("selected")?> value="1">Ativado</option>
                                </select>
                            </div>
                             
                            
                            <div class="caixa_nome">
                                <p><input type="hidden" name="foto" value=""> </p>
                            </div>
                            <div class="caixa_sub"> 
                                <input type="submit" name="btnCadastrar" value="<?php echo($botao)?>">
                            </div>
                        </form>
                        
                       
                    </div>
                    <!-- termina cadastro de usuarios -->
                    
                    <!-- começa o crud --> 
                    <div class="titulo_crud">
                         Sobre
                    </div>
                    
                    <div class="sectionCrudSobre">
                        <?php
                            $sql = "SELECT * FROM tbl_sobre ORDER BY idSobre DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsSobre=mysqli_fetch_array($select)){
                        ?>
                        <div class="tabela">
                            <div class="row_tabela"> 
                                <div class="fotoau">
                                    <img id="foto" src="<?php echo($rsSobre['foto'])?>">
                                </div>
                               
                                
                            </div>
                            
                             <div class="icon_tabela">
                                <a href="admSobre.php?modo=editar&idSobre=<?php echo($rsSobre['idSobre'])?>">
                                    <img src="imagens/edit.png">  
                                </a>
                                <a href="admSobre.php?modo=excluir&idSobre=
                                        <?php echo($rsSobre['idSobre'])?>"> 
                                        <img src="imagens/trash.png" alt="apagar"/> 
                                </a>
                                 
                                <?php 
                                
                                    if($rsSobre['status']== 1){
                                  ?> 
                                        <img src="imagens/ativado.png">
                                 <?php 
                                    }else if($rsSobre['status']==0){
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