<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'senha institucional ou email incorretos!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Bibliotecário</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="icon" type="image/x-icon" href="../images/flat.png">

   <link rel="stylesheet" href="../css/adminstyle.css">


</head>
<body style="background-image: url(../images/fundo.png)">
   
<?php include '../components/admin_header.php'; ?>

<div class="container">
        <div class="img">
            <img src="../images/fundob.svg" alt="">
        </div>
        <div class="login-container">
			<form action="" method="post">
				<img class="avatar" src="../images/avatarb.svg">
				<h2 class="title">Olá, Bibliotecário.</h2>
           
               
                   <div class="input-div one">
           		   <div class="i">
                      <i class="fas fa-user"></i>         		   </div>
           		   <div class="div">
           		   		<h5> Nome </h5>
                          <input type="text" name="name" required   class="input" oninput="this.value = this.value.replace(/\s/g, '')">

           		   </div>
           		</div>
   
           		<div class="input-div password">
           		   <div class="i"> 
                      <i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5> Senha Institucional</h5>
                        <input type="password" name="pass" required class="input"  oninput="this.value = this.value.replace(/\s/g, '')">

            	   </div>
            	</div>

            	<a href="register_admin.php"> Não tem uma conta?, clique aqui</a>
                <br>
                <input type="submit" name="submit" value="Entrar" class="btn">
            </form>
			
        </div>
    </div>
    <script type="text/javascript" src="../javascript/script.js"></script>

</html>
