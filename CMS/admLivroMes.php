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
        $tituloLivro = $_POST['tituloLivro'];
        $descricao = $_POST['descricao'];
        $precoLivro = $_POST['precoLivro'];
        $foto = $_POST['foto'];
        $sltStatus = $_POST['sltStatus'];
        
        if($_POST['btnCadastrar'] == 'Cadastrar'){
            $sql = "INSERT INTO tbl_livromes (tituloLivro,descricao,precoLivro,foto,status)VALUES('".$tituloLivro."','".$descricao."','".$precoLivro."','".$foto."','".$sltStatus."')";
        }else if($_POST['btnCadastrar']== 'Editar'){
            if($foto== ""){
                $sql = "UPDATE tbl_livromes SET  
                tituloLivro='".$tituloLivro."',
                descricao='".$descricao."',
                precoLivro='".$precoLivro."',
                status ='".$sltStatus."'
                WHERE idLivroMes=".$_SESSION['idLivroMes'];
             }else{
                $sql = "UPDATE tbl_livromes SET  
                tituloLivro='".$tituloLivro."',
                descricao='".$descricao."',
                precoLivro='".$precoLivro."',
                foto='".$foto."',
                status ='".$sltStatus."'
                WHERE idLivroMes=".$_SESSION['idLivroMes'];
             }
        }
        
    
            
        mysqli_query($conexao,$sql);
        //echo($sql);
        header('location:admLivroMes.php');
    }

        if(isset($_GET['modo'])){
            $modo = $_GET['modo'];
        
        //criando modo editar
        if( $modo == 'editar'){
            $botao = 'Editar';
            $idLivroMes = $_GET['idLivroMes'];
            
            $_SESSION['idLivroMes']= $idLivroMes;
            $sql = "SELECT * FROM tbl_livromes WHERE idLivroMes=".$idLivroMes;
            
            $select = mysqli_query($conexao,$sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $tituloLivro= $rsConsulta['tituloLivro'];
                $descricao = $rsConsulta['descricao'];
                $precoLivro = $rsConsulta['precoLivro'];
                $foto = $rsConsulta['foto'];
                $sltStatus= $rsConsulta ['status'];
            }
        }else if($modo == "ativo"){
            
            $idLivroMes = $_GET['idLivroMes'];
            $status = $_GET['status'];
            
            if($status == 1){
                $sql = "UPDATE tbl_livromes SET status==0 WHERE idLivroMes=".$idLivroMes;
            }
            
            if($status == 0){
                $sql = "UPDATE tbl_livromes SET status==1 WHERE idLivroMes=".$idLivroMes;
            }
            
            mysqli_query($conexao, $sql);
            header('location:admLivroMes.php');
            
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
                        Area de Administração de Livro do Mês
                    </div>
                    <div class="sectionAutores">
                         <form name="frmFoto" method="post" action="upload.php" id="frmFoto" enctype="multipart/form-data">
                             <div class="titulo">
                                Cadastro do Livro do mês
                            </div>
                             <div class="caixa_nome_autores">
                                <div class="informacao_autores_top">
                                    Foto Livro: 
                                </div>
                                <p><input class="file" type="file" name="filefoto" id="foto" > </p>
                                            
                            </div>  
                            <div id="visualizar">
                                <img src="<?php echo($foto)?>">
                             </div>
                             
                           
                        </form>
                        <form name="frmConteudo" method="post" action="admLivroMes.php"  class="form">
                            
                            <div class="caixa_nome">
                                <div class="informacao">
                                    Titulo: 
                                </div>
                                <p><input type="text" name="tituloLivro" placeholder="Digite um nome" value="<?php echo(@$tituloLivro)?>"> </p>
                            </div>
                             
                            
                            <div class="caixa_nome_sobre">
                                <div class="informacao">
                                    Descrição:
                                </div>
                             
                                    <textarea class="textareaMes"  name="descricao" placeholder="Fale sobre as Criações"><?php echo(@$descricao)?></textarea>
                            </div>

                             <div class="caixa_nome">
                                <div class="informacao">
                                    Preço Livro: 
                                </div>
                                <p><input type="text" name="precoLivro"  value="<?php echo(@$precoLivro)?>">
                            </div>
                            <div class="caixaModo">
                                <div class="modo">
                                    Modo: 
                                </div>
                                <select name="sltStatus">
                                        <option <?php if($sltStatus == 0 ) echo("selected")?> value="0">Desativado
                                        </option>
                                        <option <?php if($sltStatus == 1 ) echo("selected")?> value="1">Ativado</option>
                                </select>
                            </div>
                            
                            
                            <div class="caixa_nome_autores">
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
                         Livro Mês 
                    </div>
                    
                    <div class="sectionCrudAutores">
                        <?php
                            $sql = "SELECT * FROM tbl_livromes ORDER BY idLivroMes DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsLivroMes=mysqli_fetch_array($select)){
                        ?>
                        <div class="tabela">
                            <div class="row_tabela"> 
                                <div class="fotoau">
                                    <img id="foto" src="<?php echo($rsLivroMes['foto'])?>">
                                </div>
                                <div class="item">
                                    <h4>Titulo:</h4> 
                                    <?php echo($rsLivroMes['tituloLivro'])?> 
                                </div>
                                <div class="item">
                                    <h4>Preço:</h4> 
                                    <?php echo($rsLivroMes['precoLivro'])?> 
                                </div>
                            </div>
                            
                             <div class="icon_tabela">
                                 <?php 
                                        if($rsLivroMes['status']== 1){
                                      ?> 
                                            <img src="imagens/ativado.png">
                                     <?php 
                                        }else if($rsLivroMes['status']==0){
                                       ?> 
                                            <img src="imagens/desabilitar.png">
                                     <?php
                                        }
                                     ?>
                            <a href="admLivroMes.php?modo=editar&idLivroMes=<?php echo($rsLivroMes['idLivroMes'])?>">
                                <img src="imagens/edit.png">  
                            </a>
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