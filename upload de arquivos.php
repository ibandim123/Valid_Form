<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
  </head>

  <body>
    <?php 
  
     if(isset($_POST['Enviar'])) {
        //Extensões permitidas para upload
        $formatosPermitidos = array("png", "jpeg", "jpg", "gif");
       // Path info das extensões
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

        if(in_array($extensao, $formatosPermitidos)) {
          //Criando pasta para armazenar arquivo de upload
          $pasta = "arquivos/";
          //Especificando
          $temporario = $_FILES['arquivo']['tmp_name'];
          //Adicionando um novo nome e gravando sua extensão
          $novoNome = uniqid().".$extensao";
          
          //Se o upload for bem sucessido ou não
          if(move_uploaded_file($temporario, $pasta.$novoNome)) {
            $mensagem = "Upload feito com sucesso!";
          } else {
            $mensagem = "Erro, não foi possível fazer o upload";
          }
        } else {
          $mensagem = "Formato inválido";
        }
        echo $mensagem;      
      }
    
      
    ?>
    <section class="d-flex justify-content-center">
      <form
        method="POST"
        action="<?php echo $_SERVER['PHP_SELF']; ?>"
        class="d-flex flex-column"
        enctype="multipart/form-data"
      >
        <h1>Enviar um arquivo!</h1>
        <input type="file" name="arquivo" />
        <input type="submit" value="Enviar" name="Enviar" />
      </form>
      <footer>
        <script
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
          crossorigin="anonymous"
        ></script>
      </footer>
    </section>
  </body>
</html>


