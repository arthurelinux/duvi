<?php
require_once('functions/verifica-rementente.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head><meta charset="gb18030">
    <!-- Meta tags Obrigatórias -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Love Gifts!</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
         
  </head>
  <body class="mobile">
    <div class="containerCliente">
        <div style="display:flex;flex-direction:column; align-items:center; padding-top:10px">
          <img  style="width: 50%" src="assets/Logo_COMPACTA-min.png">
          <img  style="width: 100%; padding-top:10px; padding-bottom:40px" src="assets/Cliente/ARTE_TITULO_-min.png">
</div>
  
        <?php
     
          require_once('functions/conexao.php');
        $contador = 0;
        $usuario = $_SESSION['email'];

        $result_usuarios =" SELECT * FROM codigos ORDER BY id DESC";
        $resultado_usuarios = mysqli_query($conn, $result_usuarios);
        while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
            
          if($usuario == $row_usuario['email'] and  $row_usuario['enviado'] == 1 ){    
            $data = $row_usuario['compra'];
            $data = implode("/",array_reverse(explode("-",$data)));
            $contador++;

?>
          <div class="cardVideo" style="background-image: url('assets/Cliente/CAIXA_Lista-min.png');background-size: 100%;background-repeat: no-repeat;height:200px;">
        
            <label style="padding-top:35px;padding-left:70px ; "><strong>Presente para <?=$row_usuario['destinatario']?></strong></label>
            <label style="padding-left:10px ;">Data:<?=$data;?></label>
            <div style="padding: 0 15px;" class="form-inline">
                <form method="POST" action="move/upload.php" enctype="multipart/form-data" >
                <input type="text" name="destinatario" value="<?=$row_usuario['codigo']?>" style="display: none;">
                <input type="text" name="id2" value="<?=$row_usuario['id']?>" style="display: none;">
          
                    <!--<div class="custom-file">
                        <input type="file" name="arquivo" class="file_multi_video custom-file-input form-control" accept="video/*" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Selecione o Video</label>
                    </div> -->
                    <input type="file" id="myFile" name="arquivo"  accept="video/*" id="validatedCustomFile" name="MAX_FILE_SIZE" value="30000" required>
                  
                    <div class="mt-3">
                      <button type="submit" class="btn btn-dark btn-block">Enviar Mensagem</button>
                    </div>
                    <p style="font-size:11px"><strong>Aten&ccedil;&atilde;o:</strong> Ap&oacute;s envio da mensagem n&atilde;o ser&aacute; poss&iacute;vel substituir o v&iacute;deo.</p>
                </form>
            </div>
          </div>
          
          <?php
          
          } 
        }
        
        if($contador == 0){
            echo "<div style='background-color:#FFF; padding:5px 15px; border-radius:5px; box-shadow: 2px 4px 6px #a9a9a9;'><h5>Seu vídeo já foi enviado com sucesso! </h5></div>";
        }
          ?>

        
 <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <H1>Vídeo enviado com sucesso!</H1>
      </div>
    </div>
  </div>
</div>
            <script>
                    $(document).on("change", ".file_multi_video", function(evt) {
                  var $source = $('#video_here');
                 // $('#destinatario<?=$row_usuario['id']?>').append(` >`);
                  $source[0].src = URL.createObjectURL(this.files[0]);
                  $source.parent()[0].load();
                });
                <?php
        if(!empty($_SESSION['enviado'])):
                                    echo $_SESSION['enviado'];
                                endif;
                                 ?>
                setTimeout(function(){ $('#modal').remove();<?=$_SESSION['enviado'] ='';?> }, 5000);
                
              </script>
            
            <!-- JavaScript (Opcional) -->
            <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
            </div>
        </div>
    </div>
     <input type="button" onclick="location.href='functions/logout.php?i=remetente'" value="Sair" class="btnPrimary"/>
 </body>
</html>

