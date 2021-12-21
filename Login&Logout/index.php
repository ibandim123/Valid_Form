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
  
  <?php
    // Conexão
    require_once 'db_connect.php';
    // Sessão
    session_start();
    // Botão de envio
    if(isset($_POST['btn-entrar'])) {
      $erros = array();
      $login = mysqli_escape_string($connect, $_POST['login']);
      $senha = mysqli_escape_string($connect, $_POST['senha']);

      // Validações
      if(empty($login) or empty($senha)) {
        $erros[] = "<li> O campo de login/senha precisa ser preenchidos</li>";
      } else {
        $sql = "SELECT login FROM usuarios WHERE login = '$login'";
        $resultado = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($resultado) > 0 ) {
          $senha = md5($senha);
          $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";  
          $resultado = mysqli_query($connect, $sql);
           
          if(mysqli_num_rows($resultado) == 1 ) {
            
            $dados = mysqli_fetch_array($resultado);
            $_SESSION['logado'] = true;
            $_SESSION['id_usuario'] = $dados['id'];
            $_SESSION['nome_usuario'] = $dados['nome'];
            header('Location: home.php');

          } else {
            $erros[] = "<li>A senha está incorreta</li>";
          }
        } else {
          $erros[] = "<li>Usuário inexistente</li>";
        }
      }
      
    }

    if(!empty($erros)) {
      foreach($erros as $erro) {
        echo $erro;
      }
    }
  ?>

  <body>
    <section class="d-flex justify-content-center">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="d-flex flex-column mt-5">
        <h1>Acessar Login</h1>
        <label for="login" class="form-label pt-3">Nome:</label>
        <input type="text" name="login" placeholder="Nome" autocomplete="off" class="form-control" >
        <label for="senha" class="form-label pt-3">Senha:</label>
        <input type="password"  name="senha" id="" autocomplete="off" class="form-control">
        <small class="pt-1">Esqueci a minha senha!</small>
        <input type="submit" value="Login" name="btn-entrar" class="btn btn-primary mt-3">
      </form>
    </section>
   
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
