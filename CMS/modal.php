<?php 

    //Inclui o arquivo que faz a conexao com o 
    //banco de dados
    require_once('conexao.php');
    
    //Chama a função que estabelece a coexao com o 
    //banco de dados
    $conexao = conexaoBD();
    
    $id = $_POST['idRegistro'];

    $sql = "select * from tbl_contato where id=".$id;
    
    $select = mysqli_query($conexao,$sql);

    if($rs=mysqli_fetch_array($select))
    {
        $nome= $rs["nome"];
        $telefone = $rs["telefone"];
        $celular = $rs["celular"];
        $email = $rs["email"];
        $sexo = $rs["sexo"];
        $sugestoes = $rs["sugestoes"];
        $profissao = $rs["profissao"];
        $mensagem = $rs["mensagem"];
        
    }
?>

<html>
    <head>
        <title>Modal</title>
        <script src="js/jquery.js"></script>
        
        <script>
            $(document).ready(function(){
               $('.fechar').click(function(){ /*FUNCTION PARA FECHAR A MODAL*/
                  $('#container').fadeOut(400);
               });
            });
        </script>
    </head>
    <body>
        <div class="caixa_telamodal">
            
            <div class="caixa_modalSelecionado">
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Nome: </div>
                    <div class="modal_banco"><?php echo($nome) ?> </div>
                </div>
                
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Telefone: </div>
                    <div class="modal_banco"><?php echo($telefone) ?> </div>
                </div>
                
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Celular: </div>
                    <div class="modal_banco"><?php echo($celular) ?> </div>
                </div>
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Email: </div>
                    <div class="modal_banco"><?php echo($email) ?> </div>
                </div>
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Sexo: </div>
                    <div class="modal_banco"><?php echo($sexo) ?> </div>
                </div>
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Profissão: </div>
                    <div class="modal_banco"><?php echo($sugestoes) ?> </div>
                </div>
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Assunto: </div>
                    <div class="modal_banco"><?php echo($profissao) ?> </div>
                </div>
                <div class="row_tabelaModal"> 
                    <div class="modal_item">Mensagem: </div>
                    <textarea> <?php echo($mensagem) ?></textarea>
                    
                </div>
                
                <a href="#" class="fechar">
                    <img src="../imagens/exit.png">
                </a>
            </div>    
        
           
         </div>
    </body>
</html>