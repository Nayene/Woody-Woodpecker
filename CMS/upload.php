<?php


    if(isset($_POST)){
        
    $arquivo = $_FILES['filefoto']['name'];
    $tamanho_arquivo = $_FILES['filefoto']['size'];
    $tamanho_arquivo = round($tamanho_arquivo/1024);
    $ext_arquivo = strrchr($arquivo,".");
    $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
    $nome_arquivo = md5(uniqid(time()).$nome_arquivo);
    $diretorio_arquivo ="arquivos/";
    $arquivos_permitidos = array (".jpg",".png",".jpeg");

    if(in_array($ext_arquivo,$arquivos_permitidos)){
        if($tamanho_arquivo <= 2000){
            $arquivo_tmp = $_FILES['filefoto']['tmp_name'];
            $foto = $diretorio_arquivo.$nome_arquivo.$ext_arquivo;
            
            if(move_uploaded_file($arquivo_tmp,$foto)){
                echo("<img src='".$foto."'>");
                
                echo("
                    <script>
                        frmConteudo.foto.value='".$foto."';
                    </script>
                ");
            }else{
                echo("Não foi possivel enviar o arquivo para o servidor ");
            }
        }else{
            echo("Tamanho de arquivo invalido");
        }
    }else{
        echo("Extenção invalida");
    }
}
?>