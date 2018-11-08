
<?php

    $host ="localhost";
    $database ="db_formularioFaleConosco";
    $user="root";
    $password ="bcd127";

    //estabelece a conexão com o banco de dados MSQL, usando a biblioteca MSQLI
    if(!$conexao = mysqli_connect($host,$user,$password,$database))
       echo('erro na conexao com o bando de dados');
    
    // colocando os valores digitados na caixa de texto
    if(isset($_POST['btnEnviar'])){
        $txtNome = $_POST['txtNome'];
        $txtEmail = $_POST['txtEmail'];
        $txtTelefone = $_POST['txtTelefone'];
        $txtCelular = $_POST['txtCelular'];
        $sltSexo = $_POST['sltSexo'];
        $sltProfissao = $_POST['sltProfissao'];
        $sltAssunto = $_POST['sltAssunto'];
        $txtMensagem = $_POST['txtMensagem'];
        
        // inserindo os dados no banco de dados
         $sql ="INSERT INTO tbl_contato
                (nome, telefone, celular,email,sexo, sugestoes, profissao, mensagem)
                VALUES('".$txtNome."','".$txtTelefone."', '".$txtCelular."','".$txtEmail."', '".$sltSexo."' ,'".$sltAssunto."','".$sltProfissao."','".$txtMensagem."')
                ";

         //executa no bd o script
        mysqli_query($conexao,$sql);
        header('location:faleConosco.php');
    }

      
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Woody Woodpecker</title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <script src="jquery/jquery-1.10.1.min.js"></script>
        <script src="jquery/jquery.maskedinput.js"></script>
        <script>
            // Função de máscara para telefone e celular
            $(document).ready(function() {
                $("#txtTelefone").mask("(99) 9999-9999");
                $("#txtCelular").mask("(99) 99999-9999");
            });
            
            // validar com a tabela ascii
            function Validar(caracter, blockType, campo){
               //para começar com o campo branco 
                document.getElementById(campo).style="background-color:#fff;" ;
                
                if(window.event){
                    //guarda o ascii da letra digitada pelo usuario
                    var letra = caracter.charCode; 
                  
                }else{
                    //guarda o ascii da letra digitada pelo usuario 
                    var letra = caracter.which;
                    
               }
                // verifica se o tipo de bloqueio é para numeros ou caracteres 
                //se for tipo numero, ele bloqueia os numeros 
                if(blockType =='number'){
                    
                    //bloqueio de numeros
                    if(letra >= 48 && letra <=57){
                        // mudando a cor quando for numero 
                         document.getElementById(campo).style="background-color:red; "; 
                        //cancela a ação da tecla
                        return false;
                      }  
                //se for tipo caracter ele bloqueia letra 
                }else if(blockType == 'caracter'){
                    
                    //bloqueio de letras 
                    if (letra < 48 || letra > 57 ){
                         // mudando a cor quando for letra 
                        document.getElementById(campo).style="background-color:red; ";
                        return false;
                    }
                }
                
                }
        </script>
    </head>
    <body >
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
                    <!-- area da conta -->
                    <form method="post" action="login.php">
                    <div class="caixa_cadastro">
                        <div class="caixaText_cadastro">
                            Usuário: 
                            <p><input class="input_cadastro"  name="txtUsuario" size="20" value=""></p>
                        </div>
                        <div class="caixaText_cadastro">
                            Senha: 
                            <p><input class="input_cadastro" type="password" name="txtSenha" size="15" value=""></p>
                        </div>
                        <input id="botaoOK"type="submit" name="txtBotao" value="OK">
                    </div>
                    </form>
                </div>
            </header>
        <!-- começa o frm do fale conosco interagindo com o bda -->
        <section class="tela_faleConosco">
            <form name="frmFaleConosco" method="post" action="faleConosco.php">
            <div class="caixa_formulario">
                <div id="titulo_faleConosco">
                    <h1 style="font-size:36px">Fale Conosco</h1> <br>Nós vamos saber suas sugestões, e reclamções, nos informe seus dados.
                </div>
                
                <div class="caixa_row">
                    <div class="assunto">
                        Nome:
                    </div>
                    <div class="caixa_input">
                        <input type="text" placeholder="Digite seu nome" id="nome" name="txtNome" onkeypress="return Validar(event,'number',this.id);" required>
                    </div>
                </div>
                
                <div class="caixa_row">
                    <div class="assunto">
                        Email:
                    </div>
                    <div class="caixa_input">
                        <input type="email" placeholder="Ex: woody@gmail.com" name="txtEmail" required>
                    </div>
                </div>
                
                
                 <div class="caixa_left">
                    <div class="assunto_left">
                        Telefone:
                    </div>
                    <div class="caixa_input_left">
                        <input class="telefone" placeholder="Ex: 11 95363-9586" name="txtTelefone" id="txtTelefone"  required >
                    </div>
                </div>
                
                 <div class="caixa_left">
                    <div class="assunto_left">
                        Celular:
                    </div>
                    <div class="caixa_input_left">
                        <input class="telefone" placeholder="Ex: 11 95363-9586" name="txtCelular" id="txtCelular" required  >
                    </div>
                </div>
                
                  <div class="caixa_left">
                    <div class="assunto_left">
                        Sexo:
                    </div>
                    <div class="caixa_input_left">
                         <select id="select_left" name="sltSexo" >
                          <option value="f">Feminino</option>
                          <option value="m">Masculino</option>
                        </select>
                    </div>
                </div>
              
                <div class="caixa_row">
                    <div class="assunto">
                        Profissão:
                    </div>
                    <div class="caixa_input">
                        <select name="sltProfissao" >
                          <option value="1">Enfermagem</option>
                          <option value="2">Técnico de informatica</option>
                        </select>
                      </div>
                </div>
                
                <div class="caixa_row">
                    <div class="assunto">
                        Assunto:
                    </div>
                    <div class="caixa_input" >
                        <select name="sltAssunto" >
                          <option value="sugestao">Sugestão</option>
                          <option value="reclamacao">Reclamação</option>
                          <option value="avaliacao">Avaliação</option>
                        </select>
                      </div>
                </div>
                
                <div class="caixa_row">
                    <div class="assunto">
                        Mensagem:
                    </div>
                    <div class="caixa_input">
                        <textarea placeholder="Digite sua mensagem..." style="height:100px" name="txtMensagem"></textarea>
                    </div>
                </div>
                <div class="caixa_row">
                       <a href="home.php"><img src="imagens/logout.png" id="logout" alt="logout"></a> 
                        <input type="submit" value="Enviar" name="btnEnviar">
                </div>
            </div>
            </form>
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
    </body>
</html>