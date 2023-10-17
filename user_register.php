<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email existente!';
   }else{
      if($pass != $cpass){
         $message[] = 'as senhas não coincidem!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'cadastro feito com sucesso, faça login!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cadastre-se</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="icon" type="image/x-icon" href="images/flat.png">

   <link rel="stylesheet" href="css/style.css">

</head>
<body style="background-image: url(images/fundo.png)">
   
<?php include 'components/user_header.php'; ?>

<div class="container">
        <div class="img">
            <img src="images/background.svg" alt="">
        </div>
        <div class="login-container">
			<form action="" method="post">
				<img class="avatar" src="images/avatar.svg">
				<h2 class="title">BEM VINDO!</h2>
            <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
                <div class="input-div one">
           		   <div class="i">
					  <i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5> Nome </h5>
                          <input type="text" name="name" class="input"  required   >
           		   </div>
           		</div>
                   <div class="input-div one">
           		   <div class="i">
                      <i class="fas fa-envelope"></i>         		   </div>
           		   <div class="div">
           		   		<h5> Email </h5>
                          <input type="email" name="email" required  class="input" oninput="this.value = this.value.replace(/\s/g, '')">

           		   </div>
           		</div>
                   <div class="input-div one">
           		   <div class="i">
                      <i class="fas fa-user-secret"></i> </div>
           		   <div class="div">
           		   		<h5> RM </h5>
                          <input type="text" class="input" name="rm" required >          		   </div>
           		</div>
           		<div class="input-div password">
           		   <div class="i"> 
                      <i class="fas fa-lock-open"></i>
           		   </div>
           		   <div class="div">
           		    	<h5> Senha Institucional</h5>
                        <input type="password" name="pass" required class="input"  oninput="this.value = this.value.replace(/\s/g, '')">

            	   </div>
            	</div>
                <div class="input-div password">
           		   <div class="i"> 
                      <i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5> Confirme a senha</h5>
                        <input type="password" name="cpass" required  class="input"  oninput="this.value = this.value.replace(/\s/g, '')">
            	   </div>
			</div>

            	<a href="user_login.php"> Já tem uma conta?, clique aqui</a>
                <br>
                <input type="submit" name="submit" value="Cadastre-se" class="btn">
            </form>
			
        </div>
    </div>
    <script type="text/javascript" src="javascript/script.js"></script>

<script src="js/script.js"></script>

</body>
</html>