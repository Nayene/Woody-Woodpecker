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
    $host = "localhost";
    $database = "db_formularioFaleConosco";
    $user = "root";
    $password = "bcd127";
    $sltStatus = 0;

    //estabelece a conexão com o banco de dados MSQL, usando a biblioteca MSQLI
    if(!$conexao = mysqli_connect($host,$user,$password,$database))
       echo('erro na conexao com o bando de dados');
    
    if(isset($_POST['btnCadastrar'])){
        $txtNomeAutor = $_POST['txtNomeAutor'];
        $txtBiografia = $_POST['txtBiografia'];
        $dataNascimento = $_POST['dataNascimento'];
        $dataFalecimento = $_POST['dataFalecimento'];
        $cidadeNascimento = $_POST['cidadeNascimento'];
        $foto = $_POST['foto'];
         $sltStatus = $_POST['sltStatus'];
        
        if($_POST['btnCadastrar'] == 'Cadastrar'){
            $sql = "INSERT INTO tbl_autores (nomeAutor,biografia,dataNascimento,dataFalecimento,cidadeNascimento,foto,status)VALUES('".$txtNomeAutor."','".$txtBiografia."','".$dataNascimento."','".$dataFalecimento."','".$cidadeNascimento."','".$foto."','".$sltStatus."')";
        }else if($_POST['btnCadastrar']== 'Editar'){
            if($foto== ""){
                $sql = "UPDATE tbl_autores SET  
                nomeAutor='".$txtNomeAutor."',
                biografia='".$txtBiografia."',
                dataNascimento='".$dataNascimento."',
                dataFalecimento='".$dataFalecimento."',
                cidadeNascimento='".$cidadeNascimento."',
                status ='".$sltStatus."'
                WHERE idAutor=".$_SESSION['idAutor'];
            }else{
                $sql = "UPDATE tbl_autores SET  
                nomeAutor='".$txtNomeAutor."',
                biografia='".$txtBiografia."',
                dataNascimento='".$dataNascimento."',
                dataFalecimento='".$dataFalecimento."',
                cidadeNascimento='".$cidadeNascimento."',
                foto='".$foto."', 
                status ='".$sltStatus."'
                WHERE idAutor=".$_SESSION['idAutor'];
            }
            
        }
            
        mysqli_query($conexao,$sql);
        //echo($sql);
        header('location:admAutores.php');
    }


    // criando o modo excluir 
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        //se for igual a exluir
        if($modo == 'excluir'){
            $idAutor = $_GET['idAutor'];
            $sql = "DELETE FROM tbl_autores WHERE idAutor=".$idAutor;
            
             //Executa  o script
            mysqli_query($conexao,$sql);
            header('location:admAutores.php');
        //criando modo editar
        }else if( $modo == 'editar'){
            $botao = 'Editar';
            $idAutor = $_GET['idAutor'];
            
            $_SESSION['idAutor']= $idAutor;
            $sql = "SELECT * FROM tbl_autores WHERE idAutor=".$idAutor;
            
            $select = mysqli_query($conexao,$sql);

            if($rsConsulta = mysqli_fetch_array($select)){
                $nomeAutor = $rsConsulta['nomeAutor'];
                $biografia = $rsConsulta['biografia'];
                $dataNascimento = $rsConsulta['dataNascimento'];
                $dataFalecimento = $rsConsulta['dataFalecimento'];
                $cidadeNascimento= $rsConsulta ['cidadeNascimento'];
                $sltStatus= $rsConsulta ['status'];
                $foto = $rsConsulta['foto'];
            }
        }else if($modo == "ativo"){
            
            $idAutor = $_GET['idAutor'];
            $status = $_GET['status'];
            
            if($status == 1){
                $sql = "UPDATE tbl_autores SET status==0 WHERE idAutor=".$idAutor;
            }
            
            if($status == 0){
                $sql = "UPDATE tbl_autores SET status==1 WHERE idAutor=".$idAutor;
            }
            
            mysqli_query($conexao, $sql);
            header('location:admAutores.php');
            
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
                        Area de Administração de Autores
                    </div>
                    <div class="sectionAutores">
                         <form name="frmFoto" method="post" action="upload.php" id="frmFoto" enctype="multipart/form-data">
                             <div class="titulo">
                                Cadastro de Autores
                            </div>
                             <div class="caixa_nome_autores">
                                <div class="informacao_autores_top">
                                    Foto Perfil: 
                                </div>
                                <p><input class="file" type="file" name="filefoto" id="foto" > </p>
                                            
                            </div>  
                            <div id="visualizar">
                                <img src="<?php echo($foto)?>">
                             </div>
                             
                           
                        </form>
                        <form name="frmConteudo" method="post" action="admAutores.php" class="form" >
                            

                            <div class="caixa_nome_autores">
                                <div class="informacao_autores">
                                    Nome: 
                                </div>
                                <p><input type="text" name="txtNomeAutor" placeholder="Digite um nome" value="<?php echo(@$nomeAutor)?>"> </p>
                            </div>
                             
                            <div class="caixa_nome_autores">
                                <div class="informacao_autores">
                                    Cidade Nasc.: 
                                </div>
                                <p><input  type="text" name="cidadeNascimento" placeholder="Cidade" value="<?php echo(@$cidadeNascimento)?>"></p>
                            </div>

                             <div class="caixa_nome_autores">
                                <div class="informacao_autores">
                                    Data Nascimento: 
                                </div>
                                <p><input class="date" type="date" name="dataNascimento"  value="<?php echo(@$dataNascimento)?>">
                            </div>

                             <div class="caixa_nome_autores">
                                <div class="informacao_autores">
                                    Data Falecimento: 
                                </div>
                                <p><input class="date" type="date" name="dataFalecimento" value="<?php echo(@$dataFalecimento)?>"></p>
                            </div>
                            <div class="caixa_nome_autores">
                                <div class="informacao_autores_top">
                                    Biografia: 
                                </div>
                                <p><textarea  name="txtBiografia" placeholder="Digite sua Biografia"><?php echo(@$biografia)?></textarea> </p>
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
                         Autores 
                    </div>
                    
                    <div class="sectionCrudAutores">
                        <?php
                            $sql = "SELECT * FROM tbl_autores ORDER BY idAutor DESC";
                        
                           //executa o script no banco e guarda o retorno na variavel select
                            $select = mysqli_query($conexao,$sql);
                        
                            // PARA PEGAR AS INFORMAÇÕES 
                            // criar um nova variavel para receber as informaçoes do select
                            while($rsAutores=mysqli_fetch_array($select)){
                        ?>
                        <div class="tabela">
                            <div class="row_tabela"> 
                                <div class="fotoau">
                                    <img id="foto" src="<?php echo($rsAutores['foto'])?>">
                                </div>
                                <div class="item">
                                    <h4>Nome:</h4> 
                                    <?php echo($rsAutores['nomeAutor'])?> 
                                </div>
                                <div class="item">
                                    <h4>Origem:</h4> 
                                    <?php echo($rsAutores['cidadeNascimento'])?> 
                                </div>
                            </div>
                            
                             <div class="icon_tabela">
                                <a href="admAutores.php?modo=editar&idAutor=<?php echo($rsAutores['idAutor'])?>">
                                    <img src="imagens/edit.png">  
                                </a>
                                 <a href="admAutores.php?modo=excluir&idAutor=
                                      <?php echo($rsAutores['idAutor'])?>"> 
                                      <img src="imagens/trash.png" alt="apagar"/> 
                                 </a>
                                <?php 
                                
                                    if($rsAutores['status']== 1){
                                  ?> 
                                        <img src="imagens/ativado.png">
                                 <?php 
                                    }else if($rsAutores['status']==0){
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