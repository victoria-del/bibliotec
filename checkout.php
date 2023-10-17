<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number,email, total_products, total_price) VALUES(?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number,$email,  $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'Seu agendamento ocorreu corretamente!';
   }else{
      $message[] = 'Sua estante esta vazia!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="icon" type="image/x-icon" href="images/flat.png">

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Agendar</title>
   

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="../images/flat.png">


   <link rel="stylesheet" href="css/style.css">

</head>
<body style="background-image: url(images/fundo.png)">
   
<?php include 'components/user_header.php'; ?>

<section class="checkout">

   <form action="" method="POST">

   <h3>Seus livros agendados</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= ''.$fetch_cart['price'].''. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Sua estante está vazia!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">Total de dias para ler : <span><?= $grand_total ?></span></div>
      </div>

      <h3>Faça o seu agendamento!</h3>

      <div class="flex">
         <div class="inputBox">
            <span>  Seu nome :</span>
            <input type="text" name="name"  class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>  Seu RM:</span>
            <input type="number" name="number"  class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>  Seu email:</span>
            <input type="email" name="email"  class="box" maxlength="50" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn1 <?= ($grand_total > 1)?'':'disabled'; ?>" value="agendar">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="javascript/script2.js"></script>

</body>
</html>